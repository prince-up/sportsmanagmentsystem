<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label', 'value', 'hint' => null, 'tone' => 'emerald']));

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

foreach (array_filter((['label', 'value', 'hint' => null, 'tone' => 'emerald']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $toneClasses = [
        'emerald' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300',
        'sky' => 'bg-sky-50 text-sky-700 dark:bg-sky-500/10 dark:text-sky-300',
        'amber' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-300',
        'rose' => 'bg-rose-50 text-rose-700 dark:bg-rose-500/10 dark:text-rose-300',
        'violet' => 'bg-violet-50 text-violet-700 dark:bg-violet-500/10 dark:text-violet-300',
    ];
?>

<div class="card p-5">
    <div class="flex items-center justify-between gap-4">
        <div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400"><?php echo e($label); ?></p>
            <p class="mt-2 text-3xl font-semibold tracking-tight text-slate-900 dark:text-white"><?php echo e($value); ?></p>
        </div>
        <div class="rounded-2xl px-3 py-2 text-sm font-semibold <?php echo e($toneClasses[$tone] ?? $toneClasses['emerald']); ?>">
            <?php echo e($slot ?? 'Live'); ?>

        </div>
    </div>
    <?php if($hint): ?>
        <p class="mt-4 text-sm text-slate-500 dark:text-slate-400"><?php echo e($hint); ?></p>
    <?php endif; ?>
</div><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views\components\stat-card.blade.php ENDPATH**/ ?>