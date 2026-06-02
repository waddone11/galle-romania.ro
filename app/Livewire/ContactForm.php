<?php

namespace App\Livewire;

use App\Enums\ComandaStatus;
use App\Livewire\Concerns\HasSpamProtection;
use App\Models\Lead;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    use HasSpamProtection;

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

    /** @return array<string, string> */
    protected function messages(): array
    {
        return [
            'nume.required' => 'Te rugam sa-ti scrii numele.',
            'nume.max' => 'Numele este prea lung (max. 120 caractere).',
            'email.required' => 'Avem nevoie de o adresa de email ca sa-ti raspundem.',
            'email.email' => 'Adresa de email nu pare valida.',
            'mesaj.required' => 'Scrie-ne cateva randuri despre ce ai nevoie.',
            'mesaj.max' => 'Mesajul este prea lung (max. 2000 caractere).',
        ];
    }

    /** @return array<string, string> */
    protected function validationAttributes(): array
    {
        return [
            'nume' => 'nume',
            'firma' => 'firma',
            'email' => 'email',
            'telefon' => 'telefon',
            'serviciu' => 'serviciu',
            'mesaj' => 'mesaj',
        ];
    }

    public function submit(): void
    {
        if (! $this->passesSpamGuard('contact-form')) {
            return;
        }

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
