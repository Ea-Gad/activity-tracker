<?php
    $user = auth()->user();
    $nav = [
        ['route' => 'dashboard',         'label' => 'Dashboard',  'icon' => 'home'],
        ['route' => 'handover.index',    'label' => 'Handover',   'icon' => 'clock'],
        ['route' => 'activities.index',  'label' => 'Activities', 'icon' => 'list'],
        ['route' => 'reports.index',     'label' => 'Reports',    'icon' => 'chart'],
    ];
    $icons = [
        'home'  => 'M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10',
        'clock' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
        'list'  => 'M4 6h16M4 12h16M4 18h16',
        'chart' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
    ];
?>

<aside class="hidden lg:flex lg:flex-col w-64 shrink-0 bg-slate-900 dark:bg-black text-slate-200">
    
    <div class="px-6 py-6 flex items-center gap-3 border-b border-white/5">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600
                    flex items-center justify-center shadow-lg shadow-emerald-500/30">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            </svg>
        </div>
        <div>
            <div class="font-bold text-white leading-tight">Tracker</div>
            <div class="text-[11px] text-slate-400 uppercase tracking-wider">Support Ops</div>
        </div>
    </div>

    
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $active = request()->routeIs($item['route']) || request()->routeIs($item['route'].'.*'); ?>
            <a href="<?php echo e(route($item['route'])); ?>"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                      <?php echo e($active
                         ? 'bg-gradient-to-r from-emerald-600/90 to-green-600/90 text-white shadow-lg shadow-emerald-500/20'
                         : 'text-slate-300 hover:bg-white/5 hover:text-white'); ?>">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($icons[$item['icon']]); ?>" />
                </svg>
                <span><?php echo e($item['label']); ?></span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>

    
    <div class="p-3 border-t border-white/5">
        <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-white/5">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-500 to-green-600
                        flex items-center justify-center text-white font-semibold text-sm shrink-0">
                <?php echo e(strtoupper(substr($user->name ?? 'U', 0, 1))); ?>

            </div>
            <div class="min-w-0 flex-1">
                <div class="text-sm font-medium text-white truncate"><?php echo e($user->name ?? 'Guest'); ?></div>
                <div class="text-[11px] text-slate-400 truncate"><?php echo e($user->job_title ?? ucfirst($user->role ?? '')); ?></div>
            </div>
        </div>
    </div>
</aside>


<div class="lg:hidden fixed bottom-0 left-0 right-0 bg-slate-900 text-slate-200 border-t border-white/10 z-40">
    <div class="grid grid-cols-4">
        <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $active = request()->routeIs($item['route']) || request()->routeIs($item['route'].'.*'); ?>
            <a href="<?php echo e(route($item['route'])); ?>"
               class="flex flex-col items-center gap-1 py-3 text-[11px] font-medium
                      <?php echo e($active ? 'text-emerald-400' : 'text-slate-400'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($icons[$item['icon']]); ?>" />
                </svg>
                <?php echo e($item['label']); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH C:\laragon\www\activity-tracker\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>