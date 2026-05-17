<x-layouts.guest>
    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Welcome back</h2>
    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Sign in to manage your league operations.</p>

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
        @csrf
        <div>
            <label class="label">Email</label>
            <input class="input" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div>
            <label class="label">Password</label>
            <input class="input" type="password" name="password" required>
        </div>
        <label class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
            <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
            Remember me
        </label>
        <div class="flex items-center justify-between gap-3">
            <a class="text-sm font-medium text-brand-700 hover:text-brand-800" href="{{ route('password.request') }}">Forgot password?</a>
            <button class="btn-primary" type="submit">Login</button>
        </div>
    </form>
</x-layouts.guest>