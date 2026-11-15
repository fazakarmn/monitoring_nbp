<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrder    = Project::count();
        $totalDone     = Project::where('status', 'done')->count();
        $totalOnGoing  = Project::where('status', 'on-going')->count();
        $totalPending  = Project::where('status', 'pending')->count();

        // Monthly order data for current year
        $year = now()->year;
        $monthlyData = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyData[] = Project::whereMonth('timeline_start', $m)
                ->whereYear('timeline_start', $year)
                ->count();
        }

        // Sales analytics data (2025–2030)
        $salesData  = [];
        $salesYears = [];
        for ($y = 2025; $y <= 2030; $y++) {
            $salesYears[] = $y;
            $salesData[]  = Project::whereYear('timeline_start', $y)->count();
        }

        $activities = ActivityLog::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalOrder', 'totalDone', 'totalOnGoing', 'totalPending',
            'monthlyData', 'salesData', 'salesYears', 'activities'
        ));
    }

    /**
     * Return monthly project count for a given year (AJAX).
     */
    public function chartData(Request $request)
    {
        $year = (int) $request->input('year', now()->year);

        $monthlyData = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyData[] = Project::whereMonth('timeline_start', $m)
                ->whereYear('timeline_start', $year)
                ->count();
        }

        return response()->json(['data' => $monthlyData]);
    }
}   