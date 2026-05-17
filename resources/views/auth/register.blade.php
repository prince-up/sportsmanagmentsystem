<x-layouts.guest>
    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Create account</h2>
    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Register as a league admin or team manager.</p>

    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
        @csrf
        <div>
            <label class="label">Name</label>
            <input class="input" type="text" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div>
            <label class="label">Email</label>
            <input class="input" type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label class="label">Password</label>
            <input class="input" type="password" name="password" required>
        </div>
        <div>
            <label class="label">Confirm Password</label>
            <input class="input" type="password" name="password_confirmation" required>
        </div>
        <div class="flex items-center justify-between gap-3">
            <a class="text-sm font-medium text-brand-700 hover:text-brand-800" href="{{ route('login') }}">Already have an account?</a>
            <button class="btn-primary" type="submit">Register</button>
        </div>
    </form>
</x-layouts.guest>