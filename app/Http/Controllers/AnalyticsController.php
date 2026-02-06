<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function index()
    {
        // 1. Logins per day (last 30 days) - Optimized for Chart.js
        $loginsPerDay = UserLog::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total_logins')
        )
            ->where('action', 'login')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // 2. Active users last 7 days
        $activeUsers7 = UserLog::where('action', 'login')
            ->where('created_at', '>=', now()->subDays(7))
            ->distinct('user_id')
            ->count('user_id');

        // 3. Active users last 30 days
        $activeUsers30 = UserLog::where('action', 'login')
            ->where('created_at', '>=', now()->subDays(30))
            ->distinct('user_id')
            ->count('user_id');

        // 4. Most used apps
        // $appUsage = UserLog::select('app', DB::raw('count(*) as usage_count'))
        //     ->groupBy('app')
        //     ->orderByDesc('usage_count')
        //     ->get();

        // 5. Device usage (JSON parsing for Postgres)
        $deviceStats = UserLog::select(
            DB::raw("JSON_UNQUOTE(JSON_EXTRACT(meta, '$.device')) as device"),
            DB::raw("count(*) as count")
        )
            ->whereNotNull('meta')
            ->groupBy('device')
            ->get();


        // 6. Top IPs (JSON parsing for Postgres)
        $ipStats = UserLog::select(
            DB::raw("JSON_UNQUOTE(JSON_EXTRACT(meta, '$.ip')) as ip"),
            DB::raw("count(*) as count")
        )
            ->whereNotNull('meta')
            ->groupBy('ip')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        // 7. Recent logs
        $recentLogs = UserLog::latest()->take(10)->get();

        return view('analytics.index', compact(
            'loginsPerDay',
            'activeUsers7',
            'activeUsers30',
            'deviceStats',
            'ipStats',
            'recentLogs'
        ));
    }

    /**
     * Export User Logs to CSV
     */
    public function export(): StreamedResponse
    {
        $fileName = 'anveshika_user_logs_' . date('Y-m-d_H-i') . '.csv';

        // We use chunking if the table gets massive to avoid memory crashes
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        return response()->stream(function () {
            $file = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($file, ['ID', 'User ID', 'Name', 'Email', 'Mobile', 'Action', 'App', 'Created At']);

            // Use cursor to handle large datasets efficiently
            UserLog::latest()->cursor()->each(function ($log) use ($file) {
                fputcsv($file, [
                    $log->id,
                    $log->user_id,
                    $log->name,
                    $log->email,
                    $log->mobile,
                    $log->action,
                    $log->app,
                    $log->created_at->format('Y-m-d H:i:s')
                ]);
            });

            fclose($file);
        }, 200, $headers);
    }

    public function userLogs(Request $request)
    {
        $query = UserLog::where('user_id', Auth::id());

        // Optional: Filter by action if provided
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        $logs = $query->latest()
                      ->paginate(15)
                      ->withQueryString();

        return view('analytics.userlog', compact('logs'));
    }
}