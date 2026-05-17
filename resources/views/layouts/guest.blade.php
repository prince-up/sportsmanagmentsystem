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
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(34,197,94,0.22),_transparent_32%),linear-gradient(180deg,_#0f172a,_#020617)] px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto flex min-h-[calc(100vh-5rem)] max-w-6xl items-center">
            <div class="grid w-full gap-8 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="flex flex-col justify-center">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-300">Local Sports League Management</p>
                    <h1 class="mt-4 max-w-xl text-4xl font-semibold tracking-tight sm:text-5xl">Simple, practical league operations for teams, matches, and season tracking.</h1>
                    <p class="mt-4 max-w-xl text-base leading-7 text-slate-300">Built for a local league admin team: registrations, fixtures, standings, injuries, transfers, and reports in one place.</p>
                </div>

                <div class="card bg-white p-8 text-slate-900 shadow-soft dark:bg-slate-900 dark:text-white">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <x-chatbot title="Bhojpuri Help" greeting="नमस्ते! हमार Bhojpuri helper ह। Login, register, भा league बारे में पूछीं।" />
</body>
</html>