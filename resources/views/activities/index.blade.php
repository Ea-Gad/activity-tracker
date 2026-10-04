<x-app-layout>
    @php $title = 'Activities'; @endphp

    <div class="space-y-5">
        {{-- Toolbar --}}
        <div class="card p-4 flex flex-wrap items-end gap-3">
            <form method="GET" class="flex-1 flex flex-wrap gap-3 items-end min-w-[240px]">
                <div class="flex-1 min-w-[200px]">
                    <label class="label">Search</label>
                    <input type="text" name="q" value="{{ request('q') }}" class="input" placeholder="Search activities...">
                </div>
                <div>
                    <label class="label">Category</label>
                    <select name="category" class="input">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn-primary">Filter</button>
            </form>

            @can('create', \App\Models\Activity::class)
                <a href="{{ route('activities.create') }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Activity
                </a>
            @endcan
        </div>

        {{-- Grid of cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @forelse($activities as $activity)
                <a href="{{ route('activities.show', $activity) }}"
                   class="card p-5 hover:shadow-lg hover:-translate-y-0.5 transition-all block group">
                    <div class="flex items-start gap-3">
                        <x-activity-icon :category="$activity->category" />
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 truncate">
                                {{ $activity->title }}
                            </h3>
                            <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400 mt-0.5">{{ $activity->category }}</p>
                        </div>
                    </div>

                    @if($activity->description)
                        <p class="mt-3 text-sm text-slate-600 dark:text-slate-300 line-clamp-2">{{ $activity->description }}</p>
                    @endif

                    <div class="mt-4 flex items-center justify-between">
                        @if($activity->latestUpdate)
                            <x-status-pill :status="$activity->latestUpdate->status" />
                        @else
                            <span class="badge bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">No updates</span>
                        @endif

                        @if(! $activity->is_active)
                            <span class="badge bg-slate-100 dark:bg-slate-800 text-slate-500">Inactive</span>
                        @endif
                    </div>
                </a>
            @empty
                <div class="col-span-full card p-12 text-center">
                    <p class="text-slate-500 dark:text-slate-400">No activities found.</p>
                </div>
            @endforelse
        </div>

        <div>{{ $activities->links() }}</div>
    </div>
</x-app-layout>