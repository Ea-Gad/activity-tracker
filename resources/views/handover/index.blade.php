<x-app-layout>
    @php $title = 'Handover · ' . $date->format('D, d M Y'); @endphp

    <div class="space-y-6">
        {{-- Date & stats --}}
        <div class="card p-5">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <form method="GET" class="flex items-center gap-3">
                    <div>
                        <label class="label">Date</label>
                        <input type="date" name="date" value="{{ $date->toDateString() }}"
                               class="input" onchange="this.form.submit()">
                    </div>
                    <div class="text-sm text-slate-500 dark:text-slate-400 mt-5">{{ $date->format('l') }}</div>
                </form>
                <div class="flex gap-2 flex-wrap">
                    <span class="badge bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-300">
                        Done · {{ $stats['done'] }}
                    </span>
                    <span class="badge bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-300">
                        Pending · {{ $stats['pending'] }}
                    </span>
                    <span class="badge bg-rose-100 dark:bg-rose-500/10 text-rose-700 dark:text-rose-300">
                        Not Updated · {{ $stats['untouched'] }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="space-y-3">
            @forelse($handover as $row)
                @php
                    $a = $row['activity'];
                    $latest = $row['latest'];
                @endphp
                <div class="card p-4 hover:shadow-md transition">
                    <div class="flex items-start gap-4">
                        <x-activity-icon :category="$a->category" />

                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <a href="{{ route('activities.show', $a) }}"
                                   class="font-semibold text-slate-900 dark:text-white hover:text-emerald-600 truncate">
                                    {{ $a->title }}
                                </a>
                                @if($latest)
                                    <x-status-pill :status="$latest->status" />
                                @else
                                    <span class="badge bg-rose-100 dark:bg-rose-500/10 text-rose-700 dark:text-rose-300">Not updated</span>
                                @endif
                            </div>

                            @if($latest)
                                <p class="text-sm text-slate-600 dark:text-slate-300">{{ $latest->remark ?? '—' }}</p>
                                <div class="mt-2 flex flex-wrap items-center gap-3 text-xs text-slate-500 dark:text-slate-400">
                                    <span class="flex items-center gap-1">
                                        <div class="w-5 h-5 rounded-full bg-gradient-to-br from-emerald-500 to-green-600
                                                    flex items-center justify-center text-white text-[9px] font-bold">
                                            {{ strtoupper(substr($latest->performed_by_name, 0, 1)) }}
                                        </div>
                                        {{ $latest->performed_by_name }}
                                    </span>
                                    <span>·</span>
                                    <span>{{ $latest->performed_by_role }}</span>
                                    <span>·</span>
                                    <span class="tabular-nums">{{ $latest->performed_at->format('H:i') }}</span>
                                </div>
                            @else
                                <p class="text-sm text-rose-600 dark:text-rose-400 italic">No update recorded for this day.</p>
                            @endif
                        </div>

                        <button type="button"
                                onclick="openUpdateModal({{ $a->id }}, @js($a->title))"
                                class="btn-ghost text-xs shrink-0">
                            Update
                        </button>
                    </div>
                </div>
            @empty
                <div class="card p-12 text-center">
                    <p class="text-slate-500 dark:text-slate-400">No activities to show.</p>
                </div>
            @endforelse
        </div>
    </div>

    @include('partials.update-modal')
</x-app-layout>