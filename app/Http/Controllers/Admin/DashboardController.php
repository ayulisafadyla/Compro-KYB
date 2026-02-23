<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategory = DB::table('categories')->count('id');
        $recentActivities = \App\Models\ActivityLog::with('user')->latest()->take(5)->get();

        // Trend Data (Last 7 Days)
        $days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $days->push(now()->subDays($i)->format('d M'));
        }

        // Fetch all categories that have products
        $categories = \App\Models\Category::has('products')->pluck('name')->toArray();
        $chartData = [];

        foreach ($categories as $catName) {
            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $count = \App\Models\Product::whereHas('category', function($q) use ($catName) {
                    $q->where('name', $catName);
                })
                ->whereDate('created_at', '<=', $date)
                ->count();
                $data[] = $count;
            }
            $chartData[$catName] = $data;
        }

        return view('admin.dashboard', compact('totalCategory', 'recentActivities', 'days', 'chartData', 'categories'));
    }
}
