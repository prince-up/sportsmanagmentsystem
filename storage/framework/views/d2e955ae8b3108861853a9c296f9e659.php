<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Local Sports League</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="h-full bg-slate-950 text-white" x-data="themeToggle">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(34,197,94,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(14,165,233,0.18),_transparent_25%),linear-gradient(180deg,_#0f172a,_#020617)]">
        <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-brand-300">Local League</p>
                <p class="mt-1 text-sm text-slate-400">Simple operations for small football and sports leagues</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" @click="toggle()" class="btn-secondary">Toggle theme</button>
                <a class="btn-secondary" href="<?php echo e(route('login')); ?>">Login</a>
                <a class="btn-primary" href="<?php echo e(route('register')); ?>">Register</a>
            </div>
        </header>

        <main class="mx-auto grid max-w-7xl gap-10 px-6 pb-16 pt-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:pt-10">
            <section class="flex flex-col justify-center">
                <span class="inline-flex w-fit items-center rounded-full border border-brand-400/30 bg-brand-500/10 px-4 py-2 text-sm font-medium text-brand-200">Realtime-ready league operations</span>
                <h1 class="mt-6 max-w-3xl text-5xl font-semibold tracking-tight text-white sm:text-6xl">Manage teams, fixtures, standings, and transfers in one clean local league portal.</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">Built for admins who want something practical, fast to use, and easy to maintain. It covers team registration, player records, match scheduling, live scores, league tables, venues, seasons, and reporting.</p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a class="btn-primary" href="<?php echo e(route('login')); ?>">Open dashboard</a>
                    <a class="btn-secondary" href="#features">Explore features</a>
                </div>

                <div class="mt-10 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-sm text-slate-400">League modules</p>
                        <p class="mt-2 text-2xl font-semibold text-white">8+</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-sm text-slate-400">Seeded teams</p>
                        <p class="mt-2 text-2xl font-semibold text-white">6</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-sm text-slate-400">Realtime</p>
                        <p class="mt-2 text-2xl font-semibold text-white">Reverb</p>
                    </div>
                </div>
            </section>

            <aside class="space-y-6">
                <div class="card p-6 text-slate-900 shadow-soft dark:text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Season snapshot</p>
                            <h2 class="mt-1 text-xl font-semibold">2026 Local League Season</h2>
                        </div>
                        <span class="rounded-full bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-700 dark:bg-brand-500/10 dark:text-brand-300">Active</span>
                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl bg-slate-100 p-4 dark:bg-slate-800">
                            <p class="text-sm text-slate-500 dark:text-slate-400">Auto fixtures</p>
                            <p class="mt-2 text-lg font-semibold">Round robin scheduling</p>
                        </div>
                        <div class="rounded-2xl bg-slate-100 p-4 dark:bg-slate-800">
                            <p class="text-sm text-slate-500 dark:text-slate-400">Standings</p>
                            <p class="mt-2 text-lg font-semibold">Points, GD, fair play</p>
                        </div>
                        <div class="rounded-2xl bg-slate-100 p-4 dark:bg-slate-800">
                            <p class="text-sm text-slate-500 dark:text-slate-400">Transfers</p>
                            <p class="mt-2 text-lg font-semibold">Market simulation</p>
                        </div>
                        <div class="rounded-2xl bg-slate-100 p-4 dark:bg-slate-800">
                            <p class="text-sm text-slate-500 dark:text-slate-400">Reports</p>
                            <p class="mt-2 text-lg font-semibold">PDF export</p>
                        </div>
                    </div>
                </div>

                <div id="features" class="card p-6 text-slate-900 shadow-soft dark:text-white">
                    <h2 class="text-lg font-semibold">What the app already handles</h2>
                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="font-medium">Teams</p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Logo, budget, coach, QR profile</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="font-medium">Players</p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Positions, injuries, ratings, transfers</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="font-medium">Matches</p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Live score, MVP, predictions</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="font-medium">Seasons</p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Active toggle and archive flow</p>
                        </div>
                    </div>
                </div>
            </aside>
        </main>
    </div>
</body>
</html><?php /**PATH C:\Users\lucky\OneDrive\Pictures\Desktop\sportmanagmentsystem\resources\views\welcome.blade.php ENDPATH**/ ?>