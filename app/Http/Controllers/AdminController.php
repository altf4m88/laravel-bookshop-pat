<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function input()
    {
        $userRole = Auth::user()->akses;

        return view('admin.input')
        ->with('userRole', $userRole);
    }

    public function report()
    {
        $userRole = Auth::user()->akses;

        return view('admin.report')
        ->with('userRole', $userRole);
    }
}
