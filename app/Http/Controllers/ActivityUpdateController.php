<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityUpdateRequest;
use App\Models\Activity;
use App\Services\ActivityService;

class ActivityUpdateController extends Controller
{
    public function store(
        StoreActivityUpdateRequest $request,
        Activity $activity,
        ActivityService $service
    ) {
        $service->recordUpdate($activity, $request->user(), $request->validated());

        return back()->with('success', 'Update recorded for "' . $activity->title . '".');
    }
}