<x-layouts.guest>
    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Confirm password</h2>
    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Re-enter your password to continue.</p>

    <form method="POST" action="{{ route('password.confirm') }}" class="mt-6 space-y-4">
        @csrf
        <div>
            <label class="label">Password</label>
            <input class="input" type="password" name="password" required autofocus>
        </div>
        <button class="btn-primary" type="submit">Confirm</button>
    </form>
</x-layouts.guest>