<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{
    public function getAllLogs()
    {
        $logs = Logs::get();
        return view('content.logs.list')->with('logs', $logs);
    }

    public function clearLogs() {
        DB::table('logs')->truncate();
        return redirect()->back()->with('status', 'Loglar başarıyla temizlendi!');
    }

    public function notFound()
    {
        return view('content.logs.notFound');
    }
}
