<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function index() {
        return view('content.databases.list');
    }

    public function notFound() {
        return view('content.databases.notFound');
    }
}
