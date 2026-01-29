<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Show the registration form.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle user sign in (authentication).
     * Validates credentials and creates session.
     * Accepts either username or student ID for login.
     */
    public function signIn(Request $request)
    {
        // Validate input with strict rules to prevent SQL injection
        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9_]+$/'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
        ], [
            'username.regex' => 'Username/Student ID can only contain letters, numbers, and underscores.',
        ]);

        // Sanitize username to prevent XSS
        $usernameOrStuId = $this->sanitizeInput($credentials['username']);
        $password = $credentials['password'];

        // Check credentials using Laravel's Auth system (password is hashed)
        if ($this->checkSignIn($usernameOrStuId, $password)) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            return redirect()->intended(route('home'))
                ->with('success', 'Welcome back, '.Auth::user()->username.'!');
        }

        // Authentication failed
        return back()
            ->withInput($request->only('username'))
            ->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ]);
    }

    /**
     * Check if user credentials are valid.
     * Uses Laravel's Auth::attempt which automatically hashes and compares passwords.
     * Determines if input is username or stuId based on whether it's numeric.
     */
    private function checkSignIn(string $usernameOrStuId, string $password): bool
    {
        // Determine field type: if all numeric, it's stuId; otherwise, it's username
        $field = ctype_digit($usernameOrStuId) ? 'stuId' : 'username';

        return Auth::attempt([
            $field => $usernameOrStuId,
            'password' => $password,
        ]);
    }

    /**
     * Handle user registration.
     * Validates all fields, sanitizes input, and creates user with hashed password.
     */
    public function register(Request $request)
    {
        // Comprehensive validation with security rules
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z0-9_]+$/',  // Alphanumeric and underscore only
                'unique:users,username',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:255',
                'confirmed',  // Requires password_confirmation field
            ],
            'stuId' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9]+$/',  // Numeric only for student ID
            ],
            'class' => [
                'required',
                'string',
                'max:20',
                'regex:/^[a-zA-Z0-9]+$/',  // Alphanumeric only
            ],
            'gender' => [
                'required',
                'in:male,female,other',  // Strict enum validation
            ],
        ], [
            'username.regex' => 'Username can only contain letters, numbers, and underscores.',
            'stuId.regex' => 'Student ID can only contain numbers.',
            'class.regex' => 'Class can only contain letters and numbers.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        // Sanitize all string inputs to prevent XSS
        $sanitizedData = [
            'username' => $this->sanitizeInput($validated['username']),
            'password' => Hash::make($validated['password']),  // Hash password - never store plain text!
            'stuId' => $this->sanitizeInput($validated['stuId']),
            'class' => $this->sanitizeInput($validated['class']),
            'gender' => $validated['gender'],  // Already validated against enum
        ];

        // Create user with sanitized and hashed data
        $user = User::create($sanitizedData);

        // Log the user in after registration
        Auth::login($user);

        // Regenerate session for security
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('success', 'Account created successfully! Welcome, '.$user->username.'!');
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Sanitize input to prevent XSS attacks.
     * Removes HTML tags and encodes special characters.
     */
    private function sanitizeInput(string $input): string
    {
        // Remove any HTML tags
        $input = strip_tags($input);

        // Convert special characters to HTML entities
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

        // Trim whitespace
        $input = trim($input);

        return $input;
    }
}
