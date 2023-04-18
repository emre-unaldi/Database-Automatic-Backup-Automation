<?php

namespace App\Http\Controllers;

use App\Models\Clusters;
use App\Models\Databases;
use Illuminate\Http\Request;

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
        $databases->period_hour = $request->period_hour;
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
        $databases->period_hour = $request->u_period_hour;
        $databases->save();
        return redirect('/databases');
    }

    public function notFound() {
        return view('content.databases.notFound');
    }
}
