<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
	'id',
	'title',
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
	'id',
	'title',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6">
	<div class="absolute inset-0 bg-slate-950/70" @click="open = false"></div>

	<div class="relative w-full max-w-3xl overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-950">
		<div class="flex items-center justify-between border-b border-slate-200 px-6 py-4 dark:border-slate-800">
			<div>
				<p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-600"><?php echo e($title); ?></p>
			</div>
			<button type="button" class="btn-secondary px-3 py-2" @click="open = false">Close</button>
		</div>

		<div class="max-h-[80vh] overflow-y-auto px-6 py-6">
			<?php echo e($slot); ?>

		</div>
	</div>
</div>
<?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views/components/modal.blade.php ENDPATH**/ ?>