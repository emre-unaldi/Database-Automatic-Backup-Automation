<?php

namespace App\Http\Controllers;
use App\Models\Clusters;
use App\Models\Databases;
use App\Models\Logs;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $databases = Databases::get();
        $clusters = Clusters::get();
        $users = User::get();
        $logs = Logs::get();

        return view('home')
            ->with('databases', $databases)
            ->with('clusters', $clusters)
            ->with('users', $users)
            ->with('logs', $logs);
    }
}
