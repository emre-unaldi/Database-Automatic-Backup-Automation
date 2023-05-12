<?php

namespace App\Http\Controllers;

use App\Models\Clusters;
use App\Models\Databases;
use App\Models\Logs;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DatabaseController extends Controller
{
    public function getAllDatabases()
    {
        $databases = Databases::with('cluster')->get();
        $clusters = Clusters::get();

        return view('content.databases.list')
            ->with('databases', $databases)
            ->with('clusters', $clusters);
    }

    public function deleteDatabaseById(Request $request)
    {
        $databases = Databases::find($request->id);
        $databases->delete();
        return redirect('/databases');
    }

    public function createDatabase(Request $request)
    {
        $databases = new Databases();
        $isCluster = Clusters::where('cluster', $request->c_name)->first();

        // Check selected cluster
        if ($request->selectedCluster === 'false') {
            $databases->ip = $request->ip;
            $databases->port = $request->port;
            $databases->user = $request->user;
            $databases->password = $request->password;
        } else {
            $databases->c_id = $isCluster->id;
        }

        $databases->c_name = $request->c_name;
        $databases->db_name = $request->db_name;
        $databases->period_hour = ($request->period_hour ?? '0') . ' Hour';
        $databases->backup_max_count = ($request->backup_max_count ?? '0') . ' Records';
        $databases->save();
        return redirect('/databases');
    }

    public function updateDatabaseById(Request $request)
    {
        $databases = Databases::find($request->u_databases_id);
        $databases->c_name = $request->uc_name;
        $databases->db_name = $request->udb_name;
        $databases->ip = $request->u_ip;
        $databases->port = $request->u_port;
        $databases->user = $request->u_user;
        $databases->password = $request->u_password;
        $databases->period_hour = $request->u_period_hour . ' Hour';
        $databases->backup_max_count = $request->u_backup_max_count . ' Records';
        $databases->save();
        return redirect('/databases');
    }

    public function backupDatabaseById(Request $request)
    {
        // get database by id 
        $databases = Databases::find($request->id);

        // get last backup time and period
        $last_backup = $databases->last_backup;
        $period_hour = explode(' ', $databases->period_hour)[0];

        // get current date and time
        $dateTimeNow = new DateTime();

        // Get the difference between last_backup and current time for period hour calculation
        $lastBackupFormated = new DateTime($last_backup);
        $dateTimeDiff = $dateTimeNow->diff($lastBackupFormated);

        // Checking whether the backup is done manually or automatically
        if ($request->trigger === 'manual') {
            $periodCheck = true;
        } else {
            // period control
            $periodCheck = $dateTimeDiff->h >= intval($period_hour);
        }

        if ($periodCheck || $last_backup == null) {
            
            $logs = new Logs();

            // get database name, cluster name and max count backup
            $db_name = $databases->db_name;
            $c_name = $databases->c_name;
            $backup_max_count = $databases->backup_max_count;

            // Create day-month-year hour-minute for filename
            $backupDate = $dateTimeNow->format('d') . '-' . $dateTimeNow->format('m') . '-' . $dateTimeNow->format('Y');
            $backupTime = $dateTimeNow->format('H') . '-' . $dateTimeNow->format('i');

            // check if the database has a cluster and accordingly create variable
            $isCluster = $databases->cluster;
            if ($isCluster) {
                // get record with cluster
                $ip = $isCluster->ip;
                $port = $isCluster->port;
                $user = $isCluster->user;
                $password = $isCluster->password;
            } else {
                // get record with database
                $ip = $databases->ip;
                $port = $databases->port;
                $user = $databases->user;
                $password = $databases->password;
            }

            // find the files of the database
            $backupPath = storage_path('app/public/backup');
            $files = File::glob($backupPath . '/*_' . $db_name . '_backup.tar.gz');
            $files = array_combine($files, array_map('filemtime', $files));
            arsort($files);

            // check database backup hold count and delete file
            if (!empty($files) && count($files) >= intval($backup_max_count)) {
                $oldestFile = array_keys($files)[count($files) - 1];

                // delete file from FTP
                $ftpController = new FtpController();
                $request = new Request(['tarFile' => $oldestFile]);
                $ftpController->deleteFromFtp($request);

                File::delete($oldestFile);
            }

            // reading .sql file from database
            $backupSqlFile = "app/public/backup/{$db_name}_backup.sql";
            $backupSqlFilePath = storage_path($backupSqlFile);
            $command = "mysqldump --single-transaction --user={$user} --password={$password} --host={$ip} --port={$port} {$db_name}";
            $sqlReadBuffers = '';

            //run command
            $readSqlDatabase = popen($command, "r");
            // read all database data
            while(!feof($readSqlDatabase)) {
                $buffer = fgets($readSqlDatabase, 4096);
                $sqlReadBuffers .= $buffer;
            }
            pclose($readSqlDatabase);

            // $sqlReadBuffers -> if information is correct SQL text is incorrect "" empty string
            if ($sqlReadBuffers === "") {
                $info = ['message' => "Failed to run command to read database data {$db_name} ×", 'success' => false];
                $logs->message = $info['message'];
                $logs->status = $info['success'];
            } else {
                // create sql file with sql text
                $openSqlFile = fopen($backupSqlFilePath, "w+");
                fwrite($openSqlFile, $sqlReadBuffers);
                fclose($openSqlFile);

                    // sql file created check file size
                    if (file_exists($backupSqlFilePath)) {
                        if (filesize($backupSqlFilePath) > 0) {

                            // compress the backed up database as tar.gz and delete the .sql backup file
                            $backupTarGzFile = "app/public/backup/{$backupDate}_{$backupTime}_{$db_name}_backup.tar.gz";
                            $backupTarGzFilePath = storage_path($backupTarGzFile);
                            $backupTarGzFileDir = storage_path("app/public/backup");
                            $command = "tar -czvf {$backupTarGzFilePath} --directory={$backupTarGzFileDir} {$db_name}_backup.sql --force-local";
                            
                            // run command
                            $createBackupTarGzFile = popen($command, "w");
                            pclose($createBackupTarGzFile);

                            // tar.gz file created check file size
                            if (file_exists($backupTarGzFilePath)) {
                                if (filesize($backupTarGzFilePath) > 0) {
                                    // save the last backup date
                                    $databases->last_backup = $dateTimeNow;
                                    $databases->save();

                                    File::delete($backupSqlFilePath);

                                    // FTP file upload
                                    $ftpController = new FtpController();
                                    $request = new Request(['tarFile' => $backupTarGzFile]);
                                    $ftpController->uploadToFtp($request);

                                    $info = ['message' => "{$db_name} database sql file created and backup saved ✓", 'success' => true];
                                    $logs->message = $info['message'];
                                    $logs->status = $info['success'];
                                } else {
                                    $info = ['message' => "The database sql file {$db_name} was created but the backup could not be saved. The backup file was deleted because it was empty ×", 'success' => false];
                                    $logs->message = $info['message'];
                                    $logs->status = $info['success'];
                                    File::delete($backupTarGzFilePath);
                                }
                            } else {
                                $info = ['message' => "The database sql file {$db_name} was created but the backup could not be saved. The backup file cannot be found ×", 'success' => false];
                                $logs->message = $info['message'];
                                $logs->status = $info['success'];
                            }
                        } else {
                            $info = ['message' => "The sql query for database {$db_name} could not be saved to the file. The sql file was deleted because it was empty ×", 'success' => false];
                            $logs->message = $info['message'];
                            $logs->status = $info['success'];
                            File::delete($backupSqlFilePath);
                        }
                    } else {
                        $info = ['message' => "Failed to save sql query for database {$db_name} to file. Cannot find sql file ×", 'success' => false];
                        $logs->message = $info['message'];
                        $logs->status = $info['success'];
                    }
            }

            // created backup logs
            $logs->c_name = $c_name;
            $logs->db_name = $db_name;
            $logs->last_backup = $dateTimeNow;
            $logs->save();

            return redirect('/databases')->with('status', $info);
        } else {
            $info = ['message' => "{$databases->db_name} veritabanı yedeği alınmadı. Periyot zamanı dolmadı", 'success' => false];
            return redirect('/databases')->with('status', $info);
        }
    }

    public function notFound()
    {
        return view('content.databases.notFound');
    }
}
