<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status' => 'pending']));

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

foreach (array_filter((['status' => 'pending']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $map = [
        'done'    => ['bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-300', 'M5 13l4 4L19 7'],
        'pending' => ['bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-300',         'M12 8v4l3 3'],
    ];
    [$classes, $icon] = $map[$status] ?? $map['pending'];
?>

<span class="badge <?php echo e($classes); ?>">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="<?php echo e($icon); ?>" />
    </svg>
    <?php echo e(ucfirst($status)); ?>

</span><?php /**PATH C:\laragon\www\activity-tracker\resources\views/components/status-pill.blade.php ENDPATH**/ ?>