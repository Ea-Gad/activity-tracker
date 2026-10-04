<x-app-layout>
    @php $title = 'Reports'; @endphp

    <div class="space-y-5">
        {{-- Filters --}}
        <form method="GET" class="card p-4 grid grid-cols-1 md:grid-cols-6 gap-3">
            <div>
                <label class="label">From</label>
                <input type="date" name="from" value="{{ $filters['from'] }}" class="input">
            </div>
            <div>
                <label class="label">To</label>
                <input type="date" name="to" value="{{ $filters['to'] }}" class="input">
            </div>
            <div>
                <label class="label">User</label>
                <select name="user_id" class="input">
                    <option value="">All Users</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" @selected(($filters['user_id'] ?? '') == $u->id)>{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label">Status</label>
                <select name="status" class="input">
                    <option value="">Any Status</option>
                    <option value="done" @selected(($filters['status'] ?? '') === 'done')>Done</option>
                    <option value="pending" @selected(($filters['status'] ?? '') === 'pending')>Pending</option>
                </select>
            </div>
            <div>
                <label class="label">Activity</label>
                <select name="activity_id" class="input">
                    <option value="">All Activities</option>
                    @foreach($activities as $a)
                        <option value="{{ $a->id }}" @selected(($filters['activity_id'] ?? '') == $a->id)>{{ $a->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2 items-end">
                <button class="btn-primary flex-1">Filter</button>
                <a href="{{ route('reports.export', $filters) }}" class="btn-ghost">CSV</a>
            </div>
        </form>

        {{-- Results --}}
        <div class="card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800 text-sm">
                    <thead class="bg-slate-50/70 dark:bg-slate-900/50">
                        <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Activity</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 hidden md:table-cell">Remark</th>
                            <th class="px-4 py-3">By</th>
                            <th class="px-4 py-3">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($updates as $u)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
                            <td class="px-4 py-3 whitespace-nowrap tabular-nums">{{ $u->activity_date->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <x-activity-icon :category="$u->activity->category" />
                                    <span class="font-medium text-slate-800 dark:text-slate-100">{{ $u->activity->title }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3"><x-status-pill :status="$u->status" /></td>
                            <td class="px-4 py-3 hidden md:table-cell max-w-md truncate text-slate-600 dark:text-slate-300">
                                {{ $u->remark ?? '—' }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-slate-800 dark:text-slate-100">{{ $u->performed_by_name }}</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $u->performed_by_role }}</div>
                            </td>
                            <td class="px-4 py-3 tabular-nums text-slate-600 dark:text-slate-300 whitespace-nowrap">
                                {{ $u->performed_at->format('H:i:s') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-16 text-center">
                                <div class="mx-auto w-16 h-16 rounded-2xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center mb-3">
                                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6M9 17h6M9 17H7a2 2 0 01-2-2v-6a2 2 0 012-2h2M15 17h2a2 2 0 002-2v-6a2 2 0 00-2-2h-2" />
                                    </svg>
                                </div>
                                <p class="text-slate-700 dark:text-slate-200 font-medium">No records match your filters</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Try widening the date range.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>{{ $updates->links() }}</div>
    </div>
</x-app-layout>