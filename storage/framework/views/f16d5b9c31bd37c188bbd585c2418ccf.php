<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => '',
    'value' => 0,
    'icon'  => 'chart',
    'color' => 'violet',
    'hint'  => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'label' => '',
    'value' => 0,
    'icon'  => 'chart',
    'color' => 'violet',
    'hint'  => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $palette = [
        'green'  => ['bg-green-100 dark:bg-green-500/10',  'text-green-600 dark:text-green-300',  'from-emerald-500 to-green-600'],
        'emerald' => ['bg-emerald-100 dark:bg-emerald-500/10','text-emerald-600 dark:text-emerald-300','from-green-500 to-emerald-600'],
        'amber'   => ['bg-amber-100 dark:bg-amber-500/10',    'text-amber-600 dark:text-amber-300',    'from-amber-500 to-orange-600'],
        'rose'    => ['bg-rose-100 dark:bg-rose-500/10',      'text-rose-600 dark:text-rose-300',      'from-rose-500 to-red-600'],
    ][$color] ?? ['bg-violet-100','text-violet-600','from-violet-500 to-fuchsia-600'];

    $iconPaths = [
        'chart' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
        'check' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        'clock' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
        'alert' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
    ];
?>

<div class="card p-5 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 group">
    <div class="flex items-start justify-between gap-3">
        <div>
            <p class="text-xs uppercase tracking-wider font-semibold text-slate-500 dark:text-slate-400"><?php echo e($label); ?></p>
            <p class="mt-2 text-3xl font-extrabold text-slate-900 dark:text-white tabular-nums"><?php echo e($value); ?></p>
            <?php if($hint): ?>
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400"><?php echo e($hint); ?></p>
            <?php endif; ?>
        </div>
        <div class="w-11 h-11 rounded-2xl <?php echo e($palette[0]); ?> flex items-center justify-center shrink-0
                    group-hover:scale-110 transition">
            <svg class="w-6 h-6 <?php echo e($palette[1]); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($iconPaths[$icon] ?? $iconPaths['chart']); ?>" />
            </svg>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\activity-tracker\resources\views/components/kpi-card.blade.php ENDPATH**/ ?>