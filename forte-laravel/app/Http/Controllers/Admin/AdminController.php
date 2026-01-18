<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Report;
use App\Models\Sensor;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();
        $reports = Report::count();
        $sensors = Sensor::count();
        $pendingReports = Report::where('status','pending')->count();

        return view('admin.dashboard', compact('users','reports','sensors','pendingReports'));
    }
}
