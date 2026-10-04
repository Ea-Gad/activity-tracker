<?php

namespace App\Http\Controllers;

use App\Services\ActivityService;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(ActivityService $service)
    {
        $today    = Carbon::today();
        $handover = $service->dailyHandover($today);
        $stats    = $service->statsForDate($today);

        return view('dashboard', compact('handover', 'stats', 'today'));
    }
}