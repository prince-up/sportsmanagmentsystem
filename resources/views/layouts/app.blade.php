<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'League Manager') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full" data-season-id="{{ $season->id ?? '' }}" data-user-id="{{ auth()->id() ?? '' }}" x-data="layoutShell">
<div class="min-h-full bg-[radial-gradient(circle_at_top,_rgba(34,197,94,0.12),_transparent_35%),linear-gradient(180deg,_rgba(248,250,252,1),_rgba(241,245,249,1))] dark:bg-none">
    <div class="mx-auto flex min-h-screen max-w-[1600px]">
        <aside class="hidden w-72 border-r border-slate-200 bg-white/80 px-6 py-6 backdrop-blur dark:border-slate-800 dark:bg-slate-950/80 lg:block">
            <div class="mb-8">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-600">Local League</p>
                <h1 class="mt-2 text-xl font-semibold text-slate-900 dark:text-white">Sports League Manager</h1>
            </div>

            <nav class="space-y-1 text-sm">
                <a class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('league.standings') }}">League Table</a>
                <a class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('teams.index') }}">Teams</a>
                <a class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('players.index') }}">Players</a>
                <a class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('matches.index') }}">Matches</a>
                <a class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('venues.index') }}">Venues</a>
                <a class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('seasons.index') }}">Seasons</a>
                <a class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('transfers.index') }}">Transfers</a>
                <a class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('injuries.index') }}">Injuries</a>
            </nav>

            <div class="mt-8 rounded-2xl bg-slate-900 p-4 text-slate-100 shadow-soft dark:bg-slate-900">
                <p class="text-sm font-medium text-slate-300">Active Season</p>
                <p class="mt-1 text-lg font-semibold">{{ $season->name ?? 'Season in progress' }}</p>
            </div>
        </aside>

        <div class="flex-1">
            <header class="sticky top-0 z-10 border-b border-slate-200 bg-white/80 backdrop-blur dark:border-slate-800 dark:bg-slate-950/80">
                <div class="flex items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                    <div>
                        <div class="flex items-center gap-3 lg:hidden">
                            <button type="button" class="btn-secondary px-3 py-2" @click="mobileNav = !mobileNav">Menu</button>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-brand-600">Local League</p>
                        </div>
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">@yield('page-title', 'Dashboard')</h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" x-data="themeToggle" @click="toggle()" class="btn-secondary">Toggle dark mode</button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn-primary" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="px-4 py-6 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950 dark:text-emerald-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 dark:border-rose-900/50 dark:bg-rose-950 dark:text-rose-200">
                        Please review the highlighted form fields.
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <x-chatbot />

    <div class="fixed inset-0 z-40 bg-slate-950/60 lg:hidden" x-cloak x-show="mobileNav" x-transition.opacity>
        <div class="absolute left-0 top-0 h-full w-80 max-w-[85vw] bg-white px-5 py-6 shadow-2xl dark:bg-slate-950">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-600">Local League</p>
                    <h1 class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">Sports League Manager</h1>
                </div>
                <button type="button" class="btn-secondary px-3 py-2" @click="mobileNav = false">Close</button>
            </div>

            <nav class="space-y-1 text-sm">
                <a @click="mobileNav = false" class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('dashboard') }}">Dashboard</a>
                <a @click="mobileNav = false" class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('league.standings') }}">League Table</a>
                <a @click="mobileNav = false" class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('teams.index') }}">Teams</a>
                <a @click="mobileNav = false" class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('players.index') }}">Players</a>
                <a @click="mobileNav = false" class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('matches.index') }}">Matches</a>
                <a @click="mobileNav = false" class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('venues.index') }}">Venues</a>
                <a @click="mobileNav = false" class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('seasons.index') }}">Seasons</a>
                <a @click="mobileNav = false" class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('transfers.index') }}">Transfers</a>
                <a @click="mobileNav = false" class="block rounded-xl px-3 py-2 font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-900" href="{{ route('injuries.index') }}">Injuries</a>
            </nav>
        </div>
    </div>
</div>
</body>
</html>