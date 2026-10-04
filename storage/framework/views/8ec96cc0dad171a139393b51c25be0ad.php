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
    <?php $title = 'Handover · ' . $date->format('D, d M Y'); ?>

    <div class="space-y-6">
        
        <div class="card p-5">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <form method="GET" class="flex items-center gap-3">
                    <div>
                        <label class="label">Date</label>
                        <input type="date" name="date" value="<?php echo e($date->toDateString()); ?>"
                               class="input" onchange="this.form.submit()">
                    </div>
                    <div class="text-sm text-slate-500 dark:text-slate-400 mt-5"><?php echo e($date->format('l')); ?></div>
                </form>
                <div class="flex gap-2 flex-wrap">
                    <span class="badge bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-300">
                        Done · <?php echo e($stats['done']); ?>

                    </span>
                    <span class="badge bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-300">
                        Pending · <?php echo e($stats['pending']); ?>

                    </span>
                    <span class="badge bg-rose-100 dark:bg-rose-500/10 text-rose-700 dark:text-rose-300">
                        Not Updated · <?php echo e($stats['untouched']); ?>

                    </span>
                </div>
            </div>
        </div>

        
        <div class="space-y-3">
            <?php $__empty_1 = true; $__currentLoopData = $handover; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $a = $row['activity'];
                    $latest = $row['latest'];
                ?>
                <div class="card p-4 hover:shadow-md transition">
                    <div class="flex items-start gap-4">
                        <?php if (isset($component)) { $__componentOriginal249604c4661cb9e6c4ad1ab5d9217c95 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal249604c4661cb9e6c4ad1ab5d9217c95 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.activity-icon','data' => ['category' => $a->category]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('activity-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($a->category)]); ?>
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

                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <a href="<?php echo e(route('activities.show', $a)); ?>"
                                   class="font-semibold text-slate-900 dark:text-white hover:text-emerald-600 truncate">
                                    <?php echo e($a->title); ?>

                                </a>
                                <?php if($latest): ?>
                                    <?php if (isset($component)) { $__componentOriginal0f0f6d48f1e3fcafba02703e0b070890 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f0f6d48f1e3fcafba02703e0b070890 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-pill','data' => ['status' => $latest->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-pill'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($latest->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f0f6d48f1e3fcafba02703e0b070890)): ?>
<?php $attributes = $__attributesOriginal0f0f6d48f1e3fcafba02703e0b070890; ?>
<?php unset($__attributesOriginal0f0f6d48f1e3fcafba02703e0b070890); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f0f6d48f1e3fcafba02703e0b070890)): ?>
<?php $component = $__componentOriginal0f0f6d48f1e3fcafba02703e0b070890; ?>
<?php unset($__componentOriginal0f0f6d48f1e3fcafba02703e0b070890); ?>
<?php endif; ?>
                                <?php else: ?>
                                    <span class="badge bg-rose-100 dark:bg-rose-500/10 text-rose-700 dark:text-rose-300">Not updated</span>
                                <?php endif; ?>
                            </div>

                            <?php if($latest): ?>
                                <p class="text-sm text-slate-600 dark:text-slate-300"><?php echo e($latest->remark ?? '—'); ?></p>
                                <div class="mt-2 flex flex-wrap items-center gap-3 text-xs text-slate-500 dark:text-slate-400">
                                    <span class="flex items-center gap-1">
                                        <div class="w-5 h-5 rounded-full bg-gradient-to-br from-emerald-500 to-green-600
                                                    flex items-center justify-center text-white text-[9px] font-bold">
                                            <?php echo e(strtoupper(substr($latest->performed_by_name, 0, 1))); ?>

                                        </div>
                                        <?php echo e($latest->performed_by_name); ?>

                                    </span>
                                    <span>·</span>
                                    <span><?php echo e($latest->performed_by_role); ?></span>
                                    <span>·</span>
                                    <span class="tabular-nums"><?php echo e($latest->performed_at->format('H:i')); ?></span>
                                </div>
                            <?php else: ?>
                                <p class="text-sm text-rose-600 dark:text-rose-400 italic">No update recorded for this day.</p>
                            <?php endif; ?>
                        </div>

                        <button type="button"
                                onclick="openUpdateModal(<?php echo e($a->id); ?>, <?php echo \Illuminate\Support\Js::from($a->title)->toHtml() ?>)"
                                class="btn-ghost text-xs shrink-0">
                            Update
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="card p-12 text-center">
                    <p class="text-slate-500 dark:text-slate-400">No activities to show.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php echo $__env->make('partials.update-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\activity-tracker\resources\views/handover/index.blade.php ENDPATH**/ ?>