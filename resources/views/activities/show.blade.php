<x-app-layout>
    @php $title = $activity->title; @endphp

    <div class="space-y-6">
        {{-- Header --}}
        <div class="card p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div class="flex items-start gap-4">
                    <x-activity-icon :category="$activity->category" />
                    <div>
                        <p class="text-xs uppercase tracking-widest font-bold text-emerald-600 dark:text-emerald-400">{{ $activity->category }}</p>
                        <h2 class="mt-1 text-2xl font-extrabold text-slate-900 dark:text-white">{{ $activity->title }}</h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            Created by <span class="font-semibold">{{ $activity->creator?->name }}</span>
                            · {{ $activity->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="button"
                            onclick="openUpdateModal({{ $activity->id }}, @js($activity->title))"
                            class="btn-primary">+ Add Update</button>
                    @can('update', $activity)
                        <a href="{{ route('activities.edit', $activity) }}" class="btn-ghost">Edit</a>
                    @endcan
                </div>
            </div>

            @if($activity->description)
                <p class="mt-4 text-slate-600 dark:text-slate-300">{{ $activity->description }}</p>
            @endif
        </div>

        {{-- History --}}
        <div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3">Update History · {{ $activity->updates->count() }}</h3>

            <div class="relative pl-6 border-l-2 border-slate-200 dark:border-slate-800 space-y-4">
                @forelse($activity->updates as $u)
                    <div class="relative">
                        <span class="absolute -left-[31px] top-3 w-3 h-3 rounded-full
                                     {{ $u->status === 'done' ? 'bg-emerald-500' : 'bg-amber-500' }}
                                     ring-4 ring-white dark:ring-slate-950"></span>
                        <div class="card p-4">
                            <div class="flex items-start justify-between gap-3 flex-wrap">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <x-status-pill :status="$u->status" />
                                        <span class="text-xs text-slate-500 dark:text-slate-400 tabular-nums">
                                            {{ $u->activity_date->format('d M Y') }} · {{ $u->performed_at->format('H:i:s') }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-700 dark:text-slate-200">{{ $u->remark ?? '— no remark —' }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $u->performed_by_name }}</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">{{ $u->performed_by_role }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card p-12 text-center">
                        <p class="text-slate-500 dark:text-slate-400">No updates recorded yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('partials.update-modal')
</x-app-layout>