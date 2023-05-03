<?php

namespace App\Http\Controllers;

use App\Models\Clusters;
use App\Models\Databases;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DatabaseController extends Controller
{
    public function getAllDatabases() {
        $databases = Databases::get();
        $clusters = Clusters::get();

        return view('content.databases.list')
            ->with('databases', $databases)
            ->with('clusters', $clusters);
    }

    public function deleteDatabaseById(Request $request) {
        $databases = Databases::find($request->id);
        $databases->delete();
        return redirect('/databases');
    }

    public function createDatabase(Request $request) {
        $databases = new Databases();
        $databases->c_name = $request->c_name;
        $databases->db_name = $request->db_name;
        $databases->ip = $request->ip;
        $databases->port = $request->port;
        $databases->user = $request->user;
        $databases->password = $request->password;
        $databases->last_backup = $request->last_backup;
        $databases->period_hour = $request->period_hour . ' Hour';
        $databases->backup_max_count = $request->backup_max_count. ' Records';
        $databases->save();
        return redirect('/databases');
    }

    public function updateDatabaseById(Request $request) {
        $databases = Databases::find($request->u_databases_id);
        $databases->c_name = $request->uc_name;
        $databases->db_name = $request->udb_name;
        $databases->ip = $request->u_ip;
        $databases->port = $request->u_port;
        $databases->user = $request->u_user;
        $databases->password = $request->u_password;
        $databases->last_backup = $request->u_last_backup;
        $databases->period_hour = $request->u_period_hour. ' Hour';
        $databases->backup_max_count = $request->u_backup_max_count. ' Records';
        $databases->save();
        return redirect('/databases');
    }

    public function backupDatabaseById(Request $request){
        $databases = Databases::find($request->id);

        $db_name = $databases->db_name;
        $user = $databases->user;
        $password = $databases->password;
        $backup_max_count = $databases->backup_max_count;
        $last_backup = $databases->last_backup;
        $period_hour = explode(' ', $databases->period_hour)[0];
        $host = $databases->ip;
        $port = $databases->port;

        // Dosya adı için gün-ay-yıl_saat-dakika oluşturma
        $dateTimeNow = new DateTime();
        $backupDate = $dateTimeNow->format('d').'-'.$dateTimeNow->format('m').'-'.$dateTimeNow->format('Y');
        $backupTime = $dateTimeNow->format('H').'-'.$dateTimeNow->format('i');

        // Period hour hesaplama için last_backup ile şimdiki zamanın farkını alma
        $lastBackupFormated = new DateTime($last_backup);
        $dateTimeDiff = $dateTimeNow->diff($lastBackupFormated);

        if ($dateTimeDiff->i >= intval($period_hour) || $last_backup == null) {
            // veritabanına ait dosyaları bulma
            $backupPath = storage_path('app/public/backup');
            $files = File::glob($backupPath . '/*_' . $db_name . '_backup.tar.gz');
            $files = array_combine($files, array_map('filemtime', $files));
            arsort($files);

            // veritabanı yedek tutma sayısını kontrol etme ve 
            if (!empty($files) && count($files) >= intval($backup_max_count)) {
                $oldestFile = array_keys($files)[count($files) - 1];
                File::delete($oldestFile);
            }

            // veritabanı .sql dosyasını yedek alma
            $backupSqlFile = "app/public/backup/{$db_name}_backup.sql";
            $backupSqlFilePath = storage_path($backupSqlFile);
            $command = "mysqldump --user={$user} --password={$password} --host={$host} --port={$port} {$db_name} > {$backupSqlFilePath}";
            shell_exec($command);

            // yedeklenen veritabanını tar.gz olarak sıkıştırıp .sql yedek dosyasını silme
            $backupTarGzFile = "app/public/backup/{$backupDate}_{$backupTime}_{$db_name}_backup.tar.gz";
            $backupTarGzFileDir = "C:/Users/Emre/Desktop/backup/storage/app/public/backup";
            $backupTarGzFilePath = storage_path($backupTarGzFile);
            $command = "tar -czvf {$backupTarGzFilePath} --directory={$backupTarGzFileDir} {$db_name}_backup.sql";
            shell_exec($command);
            File::delete($backupSqlFilePath);

            // son yedek tarihini kaydetme
            $databases->last_backup = $dateTimeNow;
            $databases->save();
        
            return redirect('/databases')->with('status', "{$db_name} veritabanı yedeği alındı.");
        } else {
            return redirect('/databases')->with('status', "{$db_name} veritabanı yedeği alınmadı. Periyot zamanı dolmadı");
        }

    }

    public function notFound() {
        return view('content.databases.notFound');
    }
}
