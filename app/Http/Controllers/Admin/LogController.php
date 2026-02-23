<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ActivityLog;
use App\Models\LoginHistory;

class LogController extends Controller
{
    public function activity()
    {
        $activities = ActivityLog::with('user')->latest()->paginate(20);
        return view('admin.logs.activity', compact('activities'));
    }

    public function login()
    {
        $logins = LoginHistory::with('user')->latest()->paginate(20);
        return view('admin.logs.login', compact('logins'));
    }
}
