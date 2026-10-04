<?php

namespace App\Http\Controllers;

use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HandoverController extends Controller
{
    public function index(Request $request, ActivityService $service)
    {
        $date = $request->filled('date')
            ? Carbon::parse($request->input('date'))
            : Carbon::today();

        $handover = $service->dailyHandover($date);
        $stats    = $service->statsForDate($date);

        return view('handover.index', compact('handover', 'stats', 'date'));
    }
}