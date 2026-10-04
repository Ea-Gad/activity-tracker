<?php
    $user = auth()->user();
    $title = $title ?? match(true) {
        request()->routeIs('dashboard')         => 'Dashboard',
        request()->routeIs('handover.*')        => 'Handover View',
        request()->routeIs('activities.*')      => 'Activities',
        request()->routeIs('reports.*')         => 'Reports',
        default                                 => 'Activity Tracker',
    };
?>

<header class="sticky top-0 z-30 glass border-b border-slate-200 dark:border-slate-800">
    <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
        
        <div class="flex items-center gap-3 min-w-0">
            <h1 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white truncate"><?php echo e($title); ?></h1>
            <span class="hidden sm:inline-flex badge bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-300">
                <?php echo e(now()->format('D, d M')); ?>

            </span>
        </div>

        
        <div class="flex items-center gap-2">
            
            <button onclick="toggleTheme()" type="button"
                    class="w-9 h-9 rounded-xl flex items-center justify-center
                           bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition"
                    aria-label="Toggle theme">
                <svg class="w-5 h-5 text-slate-600 dark:text-slate-300 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg class="w-5 h-5 text-slate-600 dark:text-slate-300 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>

            
            <div class="relative" x-data="{ open: false }">
                <button onclick="this.nextElementSibling.classList.toggle('hidden')" type="button"
                        class="flex items-center gap-2 pl-1 pr-3 py-1 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-green-600
                                flex items-center justify-center text-white font-semibold text-xs">
                        <?php echo e(strtoupper(substr($user->name ?? 'U', 0, 1))); ?>

                    </div>
                    <span class="hidden sm:block text-sm font-medium text-slate-700 dark:text-slate-200"><?php echo e($user->name ?? 'Guest'); ?></span>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="hidden absolute right-0 mt-2 w-52 card p-2 z-50">
                    <a href="<?php echo e(route('profile.edit')); ?>"
                       class="block px-3 py-2 text-sm rounded-lg text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                        Profile
                    </a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                                class="w-full text-left px-3 py-2 text-sm rounded-lg text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-500/10">
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header><?php /**PATH C:\laragon\www\activity-tracker\resources\views/layouts/topbar.blade.php ENDPATH**/ ?>