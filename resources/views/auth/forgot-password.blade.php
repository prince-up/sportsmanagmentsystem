<x-layouts.guest>
    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Forgot password</h2>
    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">We will email a reset link to your inbox.</p>

    <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
        @csrf
        <div>
            <label class="label">Email</label>
            <input class="input" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="flex items-center justify-between gap-3">
            <a class="text-sm font-medium text-brand-700 hover:text-brand-800" href="{{ route('login') }}">Back to login</a>
            <button class="btn-primary" type="submit">Send reset link</button>
        </div>
    </form>
</x-layouts.guest>