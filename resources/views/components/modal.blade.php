@props([
	'id',
	'title',
])

<div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6">
	<div class="absolute inset-0 bg-slate-950/70" @click="open = false"></div>

	<div class="relative w-full max-w-3xl overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-950">
		<div class="flex items-center justify-between border-b border-slate-200 px-6 py-4 dark:border-slate-800">
			<div>
				<p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-600">{{ $title }}</p>
			</div>
			<button type="button" class="btn-secondary px-3 py-2" @click="open = false">Close</button>
		</div>

		<div class="max-h-[80vh] overflow-y-auto px-6 py-6">
			{{ $slot }}
		</div>
	</div>
</div>
