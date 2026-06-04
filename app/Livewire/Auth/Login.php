<?php

namespace App\Livewire\Auth;

use App\Livewire\Concerns\RedirectsAfterAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    use RedirectsAfterAuth;

    #[Validate('required|email|max:120')]
    public string $email = '';

    #[Validate('required|string|max:120')]
    public string $password = '';

    public bool $remember = false;

    public function submit(): void
    {
        $this->validate();

        $key = $this->throttleKey();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            // Mesaj generic — nu dezvaluim daca emailul exista.
            $this->addError('email', __('Prea multe incercari. Reincearca peste un minut.'));

            return;
        }

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($key, 60);
            $this->addError('email', __('Email sau parola gresite.'));

            return;
        }

        RateLimiter::clear($key);
        session()->regenerate();

        $user = Auth::user();
        assert($user instanceof User);

        $this->redirectForUser($user);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    private function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email)).'|'.request()->ip();
    }
}
