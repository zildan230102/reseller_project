<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Cache\RateLimiter; // Correct RateLimiter import

class Login extends Component
{
    public $email, $password, $remember = false;
    public function render()
    {
        return view('livewire.auth.login')
            ->extends('layouts.app') 
            ->section('content');  
    }

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function loginUser(RateLimiter $rateLimiter)
    {

        $this->validate();
        $throttleKey = strtolower($this->email) . '|' . request()->ip();

        if ($rateLimiter->tooManyAttempts($throttleKey, 5)) {
            $this->addError('email', __('auth.throttle', [
                'seconds' => $rateLimiter->availableIn($throttleKey),
            ]));
            return;
        }

        if (!Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            $rateLimiter->hit($throttleKey);
            $this->addError('email', __('auth.failed'));
            return null;
        }

        $rateLimiter->clear($throttleKey);
        return redirect()->intended('dashboard');
    }
}
