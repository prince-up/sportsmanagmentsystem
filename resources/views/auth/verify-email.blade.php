<x-layouts.guest>
    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Verify your email</h2>
    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Check your inbox for a verification link.</p>

    @if (session('status') === 'verification-link-sent')
        <div class="mt-4 rounded-2xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-950 dark:text-emerald-200">A new verification link has been sent.</div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mt-6">
        @csrf
        <button class="btn-primary" type="submit">Resend verification email</button>
    </form>
</x-layouts.guest>