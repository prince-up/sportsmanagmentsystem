<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'League Manager') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-950 text-white">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(34,197,94,0.20),_transparent_30%),linear-gradient(180deg,_#0f172a,_#020617)] px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto flex min-h-[calc(100vh-5rem)] max-w-6xl items-center">
            <div class="grid w-full gap-8 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="flex flex-col justify-center">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-300">Local Sports League Management</p>
                    <h1 class="mt-4 max-w-xl text-4xl font-semibold tracking-tight sm:text-5xl">Clean league operations for admins and team managers.</h1>
                    <p class="mt-4 max-w-xl text-base leading-7 text-slate-300">Use the app to manage squads, fixtures, standings, injuries, transfers, and season history without a heavy enterprise interface.</p>

                    <div class="mt-8 grid gap-3 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                            <p class="text-sm text-slate-400">Teams</p>
                            <p class="mt-2 text-lg font-semibold">Registration + QR profiles</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                            <p class="text-sm text-slate-400">Matches</p>
                            <p class="mt-2 text-lg font-semibold">Live scoring</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                            <p class="text-sm text-slate-400">Tables</p>
                            <p class="mt-2 text-lg font-semibold">Sortable standings</p>
                        </div>
                    </div>
                </div>

                <div class="card bg-white p-8 text-slate-900 shadow-soft dark:bg-slate-900 dark:text-white">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>