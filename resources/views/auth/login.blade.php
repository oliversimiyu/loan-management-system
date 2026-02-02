<x-guest-layout>
    <h2 style="font-size: 1.5rem; font-weight: 700; color: #1e3a8a; margin-bottom: 0.5rem; text-align: center;">Welcome Back</h2>
    <p style="color: #6b7280; text-align: center; margin-bottom: 2rem; font-size: 0.9rem;">Sign in to access your loan management dashboard</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="form-group">
            <label for="remember_me" class="checkbox-label">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Remember me</span>
            </label>
        </div>

        <div style="margin-bottom: 1rem;">
            <button type="submit" class="btn-primary">
                🔐 Log in
            </button>
        </div>

        <div style="text-align: center;">
            @if (Route::has('password.request'))
                <a class="link-text" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        @if (Route::has('register'))
            <div style="text-align: center; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                <span style="color: #6b7280; font-size: 0.9rem;">Don't have an account? </span>
                <a class="link-text" href="{{ route('register') }}">Register here</a>
            </div>
        @endif
    </form>
</x-guest-layout>
