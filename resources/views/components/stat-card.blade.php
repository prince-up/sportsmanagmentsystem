@props(['label', 'value', 'hint' => null, 'tone' => 'emerald'])

@php
    $toneClasses = [
        'emerald' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300',
        'sky' => 'bg-sky-50 text-sky-700 dark:bg-sky-500/10 dark:text-sky-300',
        'amber' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-300',
        'rose' => 'bg-rose-50 text-rose-700 dark:bg-rose-500/10 dark:text-rose-300',
        'violet' => 'bg-violet-50 text-violet-700 dark:bg-violet-500/10 dark:text-violet-300',
    ];
@endphp

<div class="card p-5">
    <div class="flex items-center justify-between gap-4">
        <div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ $label }}</p>
            <p class="mt-2 text-3xl font-semibold tracking-tight text-slate-900 dark:text-white">{{ $value }}</p>
        </div>
        <div class="rounded-2xl px-3 py-2 text-sm font-semibold {{ $toneClasses[$tone] ?? $toneClasses['emerald'] }}">
            {{ $slot ?? 'Live' }}
        </div>
    </div>
    @if($hint)
        <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">{{ $hint }}</p>
    @endif
</div>