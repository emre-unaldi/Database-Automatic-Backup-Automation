<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function aws() {
        return view('content.databases.aws');
    }

    public function azure() {
        return view('content.databases.azure');
    }

    public function turkcelldc() {
        return view('content.databases.turkcelldc');
    }
}
