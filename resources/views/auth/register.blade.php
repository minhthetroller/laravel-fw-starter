@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="space-y-4" x-data="passwordStrength()">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-green-100 to-green-200 rounded-lg p-6 text-center shadow-md">
        <div class="flex justify-center mb-3">
            <div class="p-3 bg-green-500 rounded-full">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
        </div>
        <h2 class="text-2xl font-bold text-slate-800 mb-1">Create Account</h2>
        <p class="text-sm text-slate-600">Join us to get started</p>
    </div>

    {{-- Register Form --}}
    <div class="bg-white rounded-lg shadow-md p-5">
        <form method="POST" action="{{ route('register') }}" class="space-y-3">
            @csrf

            {{-- Username --}}
            <div>
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Choose a username"
                    required
                    autocomplete="username"
                    x-on:blur="checkUsername($event.target.value)"
                    class="@error('username') border-red-500 @enderror"
                >
                <template x-if="usernameMessage">
                    <p :class="usernameAvailable ? 'text-green-600 text-xs mt-1' : 'text-red-500 text-xs mt-1'" x-text="usernameMessage"></p>
                </template>
                @error('username')
                    <p class="error mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-slate-400 mt-1">3-30 chars, letters, numbers, underscores only.</p>
            </div>

            {{-- Password --}}
            <div>
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Create a strong password"
                    required
                    autocomplete="new-password"
                    x-model="password"
                    x-on:input="checkStrength()"
                    class="@error('password') border-red-500 @enderror"
                >
                @error('password')
                    <p class="error mt-1">{{ $message }}</p>
                @enderror

                {{-- Password Strength Bar --}}
                <div class="mt-2">
                    <div class="flex justify-between mb-1">
                        <span class="text-xs text-slate-500">Strength</span>
                        <span
                            class="text-xs font-medium"
                            :class="{
                                'text-red-500': strength <= 1,
                                'text-orange-500': strength === 2,
                                'text-yellow-500': strength === 3,
                                'text-green-500': strength >= 4
                            }"
                            x-text="strengthLabel"
                        ></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div
                            class="h-1.5 rounded-full transition-all duration-300"
                            :class="{
                                'bg-red-500': strength <= 1,
                                'bg-orange-500': strength === 2,
                                'bg-yellow-500': strength === 3,
                                'bg-green-500': strength >= 4
                            }"
                            :style="'width: ' + (strength * 25) + '%'"
                        ></div>
                    </div>

                    {{-- Password Requirements - Compact Grid --}}
                    <div class="mt-2 grid grid-cols-2 gap-1">
                        <div class="flex items-center text-xs" :class="hasMinLength ? 'text-green-600' : 'text-slate-400'">
                            <span x-text="hasMinLength ? '✓' : '✗'" class="mr-1"></span>
                            <span>8+ characters</span>
                        </div>
                        <div class="flex items-center text-xs" :class="hasUppercase ? 'text-green-600' : 'text-slate-400'">
                            <span x-text="hasUppercase ? '✓' : '✗'" class="mr-1"></span>
                            <span>1 uppercase</span>
                        </div>
                        <div class="flex items-center text-xs" :class="hasNumber ? 'text-green-600' : 'text-slate-400'">
                            <span x-text="hasNumber ? '✓' : '✗'" class="mr-1"></span>
                            <span>1 number</span>
                        </div>
                        <div class="flex items-center text-xs" :class="hasSpecial ? 'text-green-600' : 'text-slate-400'">
                            <span x-text="hasSpecial ? '✓' : '✗'" class="mr-1"></span>
                            <span>1 special char</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Confirm Password --}}
            <div>
                <label for="password_confirmation">Confirm password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Re-enter your password"
                    required
                    autocomplete="new-password"
                    x-model="passwordConfirmation"
                    x-on:input="checkMatch()"
                    class="@error('password_confirmation') border-red-500 @enderror"
                >
                <template x-if="passwordConfirmation.length > 0">
                    <p :class="passwordsMatch ? 'text-green-600 text-xs mt-1' : 'text-red-500 text-xs mt-1'">
                        <span x-text="passwordsMatch ? '✓ Passwords match' : '✗ Passwords do not match'"></span>
                    </p>
                </template>
                @error('password_confirmation')
                    <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow-md transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                :disabled="strength < 4 || !passwordsMatch"
            >
                Create Account
            </button>
        </form>

        {{-- Login Link --}}
        <div class="mt-4 pt-4 border-t border-slate-200 flex items-center justify-between">
            <span class="text-sm text-slate-500">Already have an account?</span>
            <a
                href="{{ route('login') }}"
                class="text-blue-600 hover:text-blue-700 font-medium text-sm"
            >
                Login →
            </a>
        </div>
    </div>

    {{-- Back to Home --}}
    <div class="text-center">
        <a href="{{ route('home') }}" class="text-sm text-slate-500 hover:text-slate-700">
            ← Back to Home
        </a>
    </div>
</div>

<script>
function passwordStrength() {
    return {
        password: '',
        passwordConfirmation: '',
        strength: 0,
        strengthLabel: 'Too Weak',
        hasMinLength: false,
        hasUppercase: false,
        hasNumber: false,
        hasSpecial: false,
        passwordsMatch: false,
        usernameAvailable: null,
        usernameMessage: '',

        checkStrength() {
            this.hasMinLength = this.password.length >= 8;
            this.hasUppercase = /[A-Z]/.test(this.password);
            this.hasNumber = /[0-9]/.test(this.password);
            this.hasSpecial = /[@$!%*?&#^()_\-+=\[\]{}|\\:";'<>,.\/~`]/.test(this.password);

            this.strength = [this.hasMinLength, this.hasUppercase, this.hasNumber, this.hasSpecial]
                .filter(Boolean).length;

            const labels = ['Too Weak', 'Weak', 'Fair', 'Good', 'Strong'];
            this.strengthLabel = labels[this.strength];

            this.checkMatch();
        },

        checkMatch() {
            this.passwordsMatch = this.password.length > 0 &&
                this.passwordConfirmation.length > 0 &&
                this.password === this.passwordConfirmation;
        },

        async checkUsername(username) {
            if (username.length < 3) {
                this.usernameMessage = '';
                this.usernameAvailable = null;
                return;
            }

            try {
                const response = await fetch('{{ route("check.username") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ username: username })
                });

                const data = await response.json();
                this.usernameAvailable = data.available;
                this.usernameMessage = data.message;
            } catch (error) {
                this.usernameMessage = 'Unable to check username availability';
                this.usernameAvailable = null;
            }
        }
    }
}
</script>
@endsection
