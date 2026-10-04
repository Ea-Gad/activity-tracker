<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Activity::class, 'activity');
    }

    public function index(Request $request)
    {
        $activities = Activity::with('latestUpdate.user')
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->category))
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%' . $request->q . '%';
                $q->where(fn ($sub) => $sub->where('title', 'like', $term)
                    ->orWhere('description', 'like', $term));
            })
            ->orderBy('category')
            ->orderBy('title')
            ->paginate(20)
            ->withQueryString();

        $categories = Activity::distinct()->orderBy('category')->pluck('category');

        return view('activities.index', compact('activities', 'categories'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(StoreActivityRequest $request)
    {
        Activity::create($request->validated() + [
            'created_by' => $request->user()->id,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('activities.index')
            ->with('success', 'Activity created successfully.');
    }

    public function show(Activity $activity)
    {
        $activity->load([
            'updates.user' => fn ($q) => $q->latest('performed_at')->limit(100),
            'creator',
        ]);

        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('activities.create', compact('activity'));
    }

    public function update(StoreActivityRequest $request, Activity $activity)
    {
        $activity->update($request->validated() + [
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('activities.index')
            ->with('success', 'Activity updated.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Activity deleted.');
    }
}