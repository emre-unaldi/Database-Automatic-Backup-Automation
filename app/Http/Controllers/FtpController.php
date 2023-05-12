<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FtpController extends Controller
{
    public function uploadToFtp(Request $request)
    {
        $tarFile = $request->tarFile;  // yedek dosyasını al
        $fileName = basename($tarFile); // dosya ismini al
        $filePath = storage_path($tarFile); // dosyanın tam yolunu al
        $contents = file_get_contents($filePath); // dosyanın içeriğini al
        Storage::disk('ftp')->put($fileName, $contents); // FTP sunucusuna yükle

        if (Storage::disk('ftp')->exists($fileName)) {
            $info = ['message' => "Database {$fileName} backup file uploaded to FTP server ✓", 'success' => true];
        } else {
            $info = ['message' => "Database {$fileName} backup file upload to FTP server failed ×", 'success' => false];
        }
        
        return $info;
    }

    public function deleteFromFtp(Request $request)
    {
        $tarFile = $request->tarFile;  // silinecek yedek dosyasını al
        $fileName = basename($tarFile); // silinecek dosya adını al 
        Storage::disk('ftp')->delete($fileName); // dosyayı FTP'den sil

        if (Storage::disk('ftp')->exists($fileName)) {
            $info = ['message' => "Failed to delete file {$fileName} from FTP server ×", 'success' => false];
        } else {
            $info = ['message' => "File {$fileName} deleted from FTP server ✓", 'success' => true];
        }

        return $info;
    }
}
