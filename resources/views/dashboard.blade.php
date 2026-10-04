<x-app-layout>
    <div class="space-y-6">
        {{-- Hero banner --}}
        <div class="card p-6 relative overflow-hidden">
            <div class="absolute -top-16 -right-16 w-64 h-64 rounded-full bg-gradient-to-br from-emerald-500/20 to-green-500/20 blur-3xl"></div>
            <div class="relative flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-widest font-bold text-emerald-600 dark:text-green-400">Today</p>
                    <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">
                        {{ $today->format('l, d F Y') }}
                    </h2>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Welcome back, <span class="font-semibold text-slate-700 dark:text-slate-200">{{ auth()->user()->name }}</span>.
                        {{ $stats['untouched'] > 0 ? "You have {$stats['untouched']} activities not updated today." : 'Everything is on track.' }}
                    </p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('handover.index') }}" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                        Handover
                    </a>
                    <a href="{{ route('reports.index') }}" class="btn-ghost">
                        Reports
                    </a>
                </div>
            </div>
        </div>

        {{-- KPI grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <x-kpi-card label="Total Activities" :value="$stats['total']"     icon="chart" color="green" />
            <x-kpi-card label="Done Today"      :value="$stats['done']"      icon="check" color="emerald" />
            <x-kpi-card label="Pending"         :value="$stats['pending']"   icon="clock" color="amber" />
            <x-kpi-card label="Not Updated"     :value="$stats['untouched']" icon="alert" color="rose" />
        </div>

        {{-- Progress bar --}}
        @php
            $pct = $stats['total'] > 0 ? round(($stats['done'] / $stats['total']) * 100) : 0;
        @endphp
        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Completion progress</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $stats['done'] }} of {{ $stats['total'] }} activities done</p>
                </div>
                <span class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 tabular-nums">{{ $pct }}%</span>
            </div>
            <div class="w-full h-2.5 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-emerald-500 to-green-600 transition-all duration-500"
                     style="width: {{ $pct }}%"></div>
            </div>
        </div>

        {{-- Handover --}}
        <div>
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Today's Activities</h3>
                <a href="{{ route('handover.index') }}" class="text-sm text-emerald-600 dark:text-emerald-400 hover:underline font-medium">
                    Open full handover →
                </a>
            </div>
            @include('partials.handover-table', ['handover' => $handover])
        </div>
    </div>

    @include('partials.update-modal')
</x-app-layout>