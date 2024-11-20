<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $var = 'syukran';
        return 'this is dash page $var';
    }

    public function report(){
        return 'this is report';
    }
}
