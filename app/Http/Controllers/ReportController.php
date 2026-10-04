<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index(Request $request, ActivityService $service)
    {
        $filters = $request->only(['from', 'to', 'user_id', 'status', 'activity_id']);

        $filters['from'] ??= Carbon::today()->subDays(6)->toDateString();
        $filters['to']   ??= Carbon::today()->toDateString();

        $updates    = $service->report($filters);
        $users      = User::orderBy('name')->get();
        $activities = Activity::orderBy('title')->get();

        return view('reports.index', compact('updates', 'users', 'activities', 'filters'));
    }

    public function export(Request $request, ActivityService $service)
    {
        $filters = $request->only(['from', 'to', 'user_id', 'status', 'activity_id']);

        $updates = $service->report($filters);

        $filename = 'activity-report-' . now()->format('Ymd-His') . '.csv';

        return response()->streamDownload(function () use ($updates) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Date', 'Activity', 'Category', 'Status', 'Remark', 'By', 'Role', 'Time']);
            foreach ($updates as $u) {
                fputcsv($out, [
                    $u->activity_date->toDateString(),
                    $u->activity->title,
                    $u->activity->category,
                    $u->status,
                    $u->remark,
                    $u->performed_by_name,
                    $u->performed_by_role,
                    $u->performed_at->toDateTimeString(),
                ]);
            }
            fclose($out);
        }, $filename);
    }
}