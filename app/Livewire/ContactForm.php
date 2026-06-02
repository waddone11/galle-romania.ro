<?php

namespace App\Livewire;

use App\Enums\ComandaStatus;
use App\Models\Lead;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('required|string|max:120')]
    public string $nume = '';

    #[Validate('nullable|string|max:120')]
    public ?string $firma = null;

    #[Validate('required|email|max:120')]
    public string $email = '';

    #[Validate('nullable|string|max:30')]
    public ?string $telefon = null;

    #[Validate('nullable|string|max:80')]
    public ?string $serviciu = null;

    #[Validate('required|string|max:2000')]
    public string $mesaj = '';

    public bool $submitted = false;

    public function submit(): void
    {
        $this->validate();

        $lead = new Lead;
        $lead->nume = $this->nume;
        $lead->firma = $this->firma;
        $lead->email = $this->email;
        $lead->telefon = $this->telefon;
        $lead->serviciu = $this->serviciu;
        $lead->mesaj = $this->mesaj;
        $lead->status = ComandaStatus::Nou->value;
        $lead->source = 'contact_form';
        $lead->save();

        $this->submitted = true;
        $this->reset(['nume', 'firma', 'email', 'telefon', 'serviciu', 'mesaj']);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
