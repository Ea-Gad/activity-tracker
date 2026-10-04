<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800">
            <thead class="bg-slate-50/70 dark:bg-slate-900/50">
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                    <th class="px-4 py-3">Activity</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 hidden md:table-cell">Latest Remark</th>
                    <th class="px-4 py-3 hidden lg:table-cell">Updated By</th>
                    <th class="px-4 py-3 hidden sm:table-cell">Time</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
            @forelse($handover as $row)
                @php
                    $a      = $row['activity'];
                    $latest = $row['latest'];
                    $state  = ! $row['is_updated_today']
                        ? 'border-l-4 border-l-rose-500 bg-rose-50/40 dark:bg-rose-500/5'
                        : ($latest->status === 'done'
                            ? 'border-l-4 border-l-emerald-500'
                            : 'border-l-4 border-l-amber-500');
                @endphp
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition {{ $state }}">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <x-activity-icon :category="$a->category" />
                            <div class="min-w-0">
                                <a href="{{ route('activities.show', $a) }}"
                                   class="font-semibold text-sm text-slate-900 dark:text-white hover:text-emerald-600 dark:hover:text-emerald-400 truncate block">
                                    {{ $a->title }}
                                </a>
                                <span class="text-[11px] uppercase tracking-wide text-slate-500 dark:text-slate-400">{{ $a->category }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        @if($latest)
                            <x-status-pill :status="$latest->status" />
                        @else
                            <span class="badge bg-rose-100 dark:bg-rose-500/10 text-rose-700 dark:text-rose-300">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                          d="M12 9v2m0 4h.01M5.062 20h13.876c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.33 17c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Not updated
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 hidden md:table-cell text-sm text-slate-600 dark:text-slate-300 max-w-xs truncate">
                        {{ $latest->remark ?? '—' }}
                    </td>
                    <td class="px-4 py-3 hidden lg:table-cell">
                        @if($latest)
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-emerald-500 to-green-600
                                            flex items-center justify-center text-white text-[10px] font-bold">
                                    {{ strtoupper(substr($latest->performed_by_name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-semibold text-slate-800 dark:text-slate-100 truncate">{{ $latest->performed_by_name }}</div>
                                    <div class="text-[10px] text-slate-500 dark:text-slate-400 truncate">{{ $latest->performed_by_role }}</div>
                                </div>
                            </div>
                        @else
                            <span class="text-slate-400">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 hidden sm:table-cell text-sm text-slate-600 dark:text-slate-300 tabular-nums">
                        {{ $latest?->performed_at?->format('H:i') ?? '—' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button type="button"
                                onclick="openUpdateModal({{ $a->id }}, @js($a->title))"
                                class="btn-primary !px-3 !py-1.5 text-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Update
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-16 text-center">
                        <div class="mx-auto w-16 h-16 rounded-2xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center mb-3">
                            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <p class="text-slate-700 dark:text-slate-200 font-medium">No activities yet</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 mb-4">Create your first activity to start tracking.</p>
                        @can('create', \App\Models\Activity::class)
                            <a href="{{ route('activities.create') }}" class="btn-primary">+ New Activity</a>
                        @endcan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>