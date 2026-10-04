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
    <?php $title = 'Activities'; ?>

    <div class="space-y-5">
        
        <div class="card p-4 flex flex-wrap items-end gap-3">
            <form method="GET" class="flex-1 flex flex-wrap gap-3 items-end min-w-[240px]">
                <div class="flex-1 min-w-[200px]">
                    <label class="label">Search</label>
                    <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="input" placeholder="Search activities...">
                </div>
                <div>
                    <label class="label">Category</label>
                    <select name="category" class="input">
                        <option value="">All Categories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat); ?>" <?php if(request('category') === $cat): echo 'selected'; endif; ?>><?php echo e($cat); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <button class="btn-primary">Filter</button>
            </form>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\Activity::class)): ?>
                <a href="<?php echo e(route('activities.create')); ?>" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Activity
                </a>
            <?php endif; ?>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('activities.show', $activity)); ?>"
                   class="card p-5 hover:shadow-lg hover:-translate-y-0.5 transition-all block group">
                    <div class="flex items-start gap-3">
                        <?php if (isset($component)) { $__componentOriginal249604c4661cb9e6c4ad1ab5d9217c95 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal249604c4661cb9e6c4ad1ab5d9217c95 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.activity-icon','data' => ['category' => $activity->category]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('activity-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activity->category)]); ?>
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
                            <h3 class="font-semibold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 truncate">
                                <?php echo e($activity->title); ?>

                            </h3>
                            <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400 mt-0.5"><?php echo e($activity->category); ?></p>
                        </div>
                    </div>

                    <?php if($activity->description): ?>
                        <p class="mt-3 text-sm text-slate-600 dark:text-slate-300 line-clamp-2"><?php echo e($activity->description); ?></p>
                    <?php endif; ?>

                    <div class="mt-4 flex items-center justify-between">
                        <?php if($activity->latestUpdate): ?>
                            <?php if (isset($component)) { $__componentOriginal0f0f6d48f1e3fcafba02703e0b070890 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f0f6d48f1e3fcafba02703e0b070890 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-pill','data' => ['status' => $activity->latestUpdate->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-pill'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activity->latestUpdate->status)]); ?>
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
                            <span class="badge bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">No updates</span>
                        <?php endif; ?>

                        <?php if(! $activity->is_active): ?>
                            <span class="badge bg-slate-100 dark:bg-slate-800 text-slate-500">Inactive</span>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full card p-12 text-center">
                    <p class="text-slate-500 dark:text-slate-400">No activities found.</p>
                </div>
            <?php endif; ?>
        </div>

        <div><?php echo e($activities->links()); ?></div>
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
<?php endif; ?><?php /**PATH C:\laragon\www\activity-tracker\resources\views/activities/index.blade.php ENDPATH**/ ?>