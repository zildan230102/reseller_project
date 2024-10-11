<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Cache\RateLimiter; // Correct RateLimiter import

class Login extends Component
{
    public $email, $password, $remember = false; // Set a default value for remember

    // Render the login form and extend the layout
    public function render()
    {
        return view('livewire.auth.login')
            ->extends('layouts.app')  // Extending the layout
            ->section('content');     // Define the section for content
    }

    // Validation rules
    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    // Login function with RateLimiter injection
    public function loginUser(RateLimiter $rateLimiter)
    {
        // Validate input
        $this->validate();

        // Create a throttle key using the email and the request IP address
        $throttleKey = strtolower($this->email) . '|' . request()->ip();

        // Check if the user has too many login attempts
        if ($rateLimiter->tooManyAttempts($throttleKey, 5)) {
            // Add an error if too many attempts have been made
            $this->addError('email', __('auth.throttle', [
                'seconds' => $rateLimiter->availableIn($throttleKey),
            ]));
            return;
        }

        // Attempt to log the user in
        if (!Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            // If login fails, increment the rate limiter for the throttle key
            $rateLimiter->hit($throttleKey);

            // Add an error for failed login
            $this->addError('email', __('auth.failed'));
            return null;
        }

        // Clear rate limiting if login is successful
        $rateLimiter->clear($throttleKey);

        // Redirect to the intended page after successful login
        return redirect()->intended('/dashboard');
    }
}
