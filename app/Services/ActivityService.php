<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\ActivityUpdate;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ActivityService
{
    /**
     * Record a new update. Append-only for full audit trail.
     */
    public function recordUpdate(Activity $activity, User $user, array $data): ActivityUpdate
    {
        return DB::transaction(function () use ($activity, $user, $data) {
            return ActivityUpdate::create([
                'activity_id'       => $activity->id,
                'user_id'           => $user->id,
                'performed_by_name' => $user->name ?: 'Unknown',
                'performed_by_role' => $user->job_title ?: ($user->role ?: 'Support'),
                'status'            => $data['status'],
                'remark'            => $data['remark'] ?? null,
                'activity_date'     => $data['activity_date'] ?? Carbon::today(),
                'performed_at'      => now(),
            ]);
        });
    }

    /**
     * Handover view: for a given day, all activities and their latest update.
     */
    public function dailyHandover(Carbon $date)
    {
        return Activity::active()
            ->with([
                'latestUpdate.user',
                'updates' => fn ($q) => $q->whereDate('activity_date', $date)->latest('performed_at'),
            ])
            ->orderBy('category')
            ->orderBy('title')
            ->get()
            ->map(function (Activity $activity) {
                $todaysUpdates = $activity->updates;

                return [
                    'activity'         => $activity,
                    'latest'           => $todaysUpdates->first(),
                    'trail'            => $todaysUpdates,
                    'is_updated_today' => $todaysUpdates->isNotEmpty(),
                ];
            });
    }

    /**
     * Reporting query with filters.
     */
    public function report(array $filters)
    {
        return ActivityUpdate::query()
            ->with(['activity', 'user'])
            ->when($filters['from'] ?? null, fn ($q, $d) => $q->whereDate('activity_date', '>=', $d))
            ->when($filters['to'] ?? null, fn ($q, $d) => $q->whereDate('activity_date', '<=', $d))
            ->when($filters['user_id'] ?? null, fn ($q, $id) => $q->where('user_id', $id))
            ->when($filters['status'] ?? null, fn ($q, $s) => $q->where('status', $s))
            ->when($filters['activity_id'] ?? null, fn ($q, $id) => $q->where('activity_id', $id))
            ->orderByDesc('performed_at')
            ->paginate(50)
            ->withQueryString();
    }

    /**
     * KPI stats for a given date.
     */
    public function statsForDate(Carbon $date): array
    {
        $handover = $this->dailyHandover($date);

        return [
            'total'     => $handover->count(),
            'done'      => $handover->filter(fn ($r) => optional($r['latest'])->status === 'done')->count(),
            'pending'   => $handover->filter(fn ($r) => optional($r['latest'])->status === 'pending')->count(),
            'untouched' => $handover->where('is_updated_today', false)->count(),
        ];
    }
}