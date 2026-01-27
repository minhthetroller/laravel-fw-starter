<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Sanitize input to prevent XSS attacks.
     */
    private function sanitizeInput(string $input): string
    {
        // Remove any HTML tags
        $sanitized = strip_tags($input);
        // Convert special characters to HTML entities
        $sanitized = htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');
        // Trim whitespace
        $sanitized = trim($sanitized);

        return $sanitized;
    }

    /**
     * Show the login form.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        // Sanitize username
        $credentials['username'] = $this->sanitizeInput($credentials['username']);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'))
                ->with('success', 'Welcome back, ' . Auth::user()->username . '!');
        }

        return back()
            ->withInput($request->only('username', 'remember'))
            ->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ]);
    }

    /**
     * Show the registration form.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Sanitize username
        $validated['username'] = $this->sanitizeInput($validated['username']);

        // Create user with hashed password (password hashing is automatic via casts)
        User::create([
            'username' => $validated['username'],
            'name' => $validated['username'], // Use username as name
            'email' => $validated['username'] . '@placeholder.com', // Placeholder email
            'password' => $validated['password'],
        ]);

        return redirect()->route('login')
            ->with('success', 'Registration successful! Please login to continue.');
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Check if username exists (for AJAX validation).
     */
    public function checkUsername(Request $request): \Illuminate\Http\JsonResponse
    {
        $username = $this->sanitizeInput($request->input('username', ''));

        $exists = User::where('username', $username)->exists();

        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Username is already taken.' : 'Username is available.',
        ]);
    }
}
