<?php

namespace App\Livewire\Auth;

use App\Livewire\Concerns\RedirectsAfterAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    use RedirectsAfterAuth;

    #[Validate('required|string|max:120')]
    public string $name = '';

    #[Validate('required|email|max:120|unique:users,email')]
    public string $email = '';

    #[Validate('required|string|min:8|max:120|confirmed')]
    public string $password = '';

    public string $password_confirmation = '';

    public function submit(): void
    {
        $this->validate();

        // `role` nu e mass-assignable — userul nou ramane pe default-ul 'client'.
        // Parola e hash-uita de cast-ul `hashed` de pe model.
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        Auth::login($user);
        session()->regenerate();

        $this->redirectForUser($user);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
