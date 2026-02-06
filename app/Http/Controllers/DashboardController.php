<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{

public function index()
{
    $totalUsers = \App\Models\User::count();
    $totalRoles = \Spatie\Permission\Models\Role::count();
    $totalPermissions = \Spatie\Permission\Models\Permission::count();
    
    // Fetch real recent activity from your user_logs table
   $recentActivity = \App\Models\UserLog::latest()->take(2)->get();

    return view('admin.dashboard', compact(
        'totalUsers', 
        'totalRoles', 
        'totalPermissions', 
        'recentActivity'
    ));
}


}
