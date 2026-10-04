<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $title = 'Reports'; ?>

    <div class="space-y-5">
        
        <form method="GET" class="card p-4 grid grid-cols-1 md:grid-cols-6 gap-3">
            <div>
                <label class="label">From</label>
                <input type="date" name="from" value="<?php echo e($filters['from']); ?>" class="input">
            </div>
            <div>
                <label class="label">To</label>
                <input type="date" name="to" value="<?php echo e($filters['to']); ?>" class="input">
            </div>
            <div>
                <label class="label">User</label>
                <select name="user_id" class="input">
                    <option value="">All Users</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($u->id); ?>" <?php if(($filters['user_id'] ?? '') == $u->id): echo 'selected'; endif; ?>><?php echo e($u->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="label">Status</label>
                <select name="status" class="input">
                    <option value="">Any Status</option>
                    <option value="done" <?php if(($filters['status'] ?? '') === 'done'): echo 'selected'; endif; ?>>Done</option>
                    <option value="pending" <?php if(($filters['status'] ?? '') === 'pending'): echo 'selected'; endif; ?>>Pending</option>
                </select>
            </div>
            <div>
                <label class="label">Activity</label>
                <select name="activity_id" class="input">
                    <option value="">All Activities</option>
                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($a->id); ?>" <?php if(($filters['activity_id'] ?? '') == $a->id): echo 'selected'; endif; ?>><?php echo e($a->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="flex gap-2 items-end">
                <button class="btn-primary flex-1">Filter</button>
                <a href="<?php echo e(route('reports.export', $filters)); ?>" class="btn-ghost">CSV</a>
            </div>
        </form>

        
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
                    <?php $__empty_1 = true; $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
                            <td class="px-4 py-3 whitespace-nowrap tabular-nums"><?php echo e($u->activity_date->format('d M Y')); ?></td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <?php if (isset($component)) { $__componentOriginal249604c4661cb9e6c4ad1ab5d9217c95 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal249604c4661cb9e6c4ad1ab5d9217c95 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.activity-icon','data' => ['category' => $u->activity->category]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('activity-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($u->activity->category)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal249604c4661cb9e6c4ad1ab5d9217c95)): ?>
<?php $attributes = $__attributesOriginal249604c4661cb9e6c4ad1ab5d9217c95; ?>
<?php unset($__attributesOriginal249604c4661cb9e6c4ad1ab5d9217c95); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal249604c4661cb9e6c4ad1ab5d9217c95)): ?>
<?php $component = $__componentOriginal249604c4661cb9e6c4ad1ab5d9217c95; ?>
<?php unset($__componentOriginal249604c4661cb9e6c4ad1ab5d9217c95); ?>
<?php endif; ?>
                                    <span class="font-medium text-slate-800 dark:text-slate-100"><?php echo e($u->activity->title); ?></span>
                                </div>
                            </td>
                            <td class="px-4 py-3"><?php if (isset($component)) { $__componentOriginal0f0f6d48f1e3fcafba02703e0b070890 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f0f6d48f1e3fcafba02703e0b070890 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-pill','data' => ['status' => $u->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-pill'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($u->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f0f6d48f1e3fcafba02703e0b070890)): ?>
<?php $attributes = $__attributesOriginal0f0f6d48f1e3fcafba02703e0b070890; ?>
<?php unset($__attributesOriginal0f0f6d48f1e3fcafba02703e0b070890); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f0f6d48f1e3fcafba02703e0b070890)): ?>
<?php $component = $__componentOriginal0f0f6d48f1e3fcafba02703e0b070890; ?>
<?php unset($__componentOriginal0f0f6d48f1e3fcafba02703e0b070890); ?>
<?php endif; ?></td>
                            <td class="px-4 py-3 hidden md:table-cell max-w-md truncate text-slate-600 dark:text-slate-300">
                                <?php echo e($u->remark ?? '—'); ?>

                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-slate-800 dark:text-slate-100"><?php echo e($u->performed_by_name); ?></div>
                                <div class="text-xs text-slate-500 dark:text-slate-400"><?php echo e($u->performed_by_role); ?></div>
                            </td>
                            <td class="px-4 py-3 tabular-nums text-slate-600 dark:text-slate-300 whitespace-nowrap">
                                <?php echo e($u->performed_at->format('H:i:s')); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div><?php echo e($updates->links()); ?></div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\activity-tracker\resources\views/reports/index.blade.php ENDPATH**/ ?>