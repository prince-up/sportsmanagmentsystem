<x-layouts.guest>
    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Reset password</h2>

    <form method="POST" action="{{ route('password.store') }}" class="mt-6 space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <div>
            <label class="label">Email</label>
            <input class="input" type="email" name="email" value="{{ old('email', request('email')) }}" required>
        </div>
        <div>
            <label class="label">Password</label>
            <input class="input" type="password" name="password" required>
        </div>
        <div>
            <label class="label">Confirm Password</label>
            <input class="input" type="password" name="password_confirmation" required>
        </div>
        <button class="btn-primary" type="submit">Reset password</button>
    </form>
</x-layouts.guest>