<?php

namespace App\Livewire\Firewood;

use App\Enums\ComandaStatus;
use App\Enums\SpecieUnitate;
use App\Livewire\Concerns\HasSpamProtection;
use App\Models\ComandaLemn;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OrderForm extends Component
{
    use HasSpamProtection;

    #[Validate('required|string|max:120')]
    public string $nume = '';

    #[Validate('required|string|max:30')]
    public string $telefon = '';

    #[Validate('nullable|email|max:120')]
    public ?string $email = null;

    #[Validate('required|string|max:120')]
    public string $localitate = '';

    #[Validate('nullable|integer|exists:species,id')]
    public ?int $specieId = null;

    #[Validate('required|numeric|min:0.5|max:100')]
    public float $cantitate = 1.0;

    #[Validate('required|string|in:ster,tona')]
    public string $unitate = 'ster';

    #[Validate('nullable|date|after_or_equal:today')]
    public ?string $data_dorita = null;

    #[Validate('nullable|string|max:2000')]
    public ?string $mesaj = null;

    #[Validate('accepted')]
    public bool $gdpr = false;

    public function mount(): void
    {
        $this->specieId = Specie::where('is_active', true)->where('status', 'disponibil')->value('id');
    }

    /** @return array<string, string> */
    protected function messages(): array
    {
        return [
            'gdpr.accepted' => 'Pentru a trimite comanda, trebuie sa fii de acord cu prelucrarea datelor.',
            'nume.required' => 'Te rugam sa-ti scrii numele.',
            'nume.max' => 'Numele este prea lung (max. 120 caractere).',
            'telefon.required' => 'Avem nevoie de un numar de telefon pentru confirmare.',
            'telefon.max' => 'Numarul de telefon este prea lung.',
            'email.email' => 'Adresa de email nu pare valida.',
            'localitate.required' => 'Spune-ne in ce localitate livram.',
            'cantitate.required' => 'Completeaza cantitatea dorita.',
            'cantitate.numeric' => 'Cantitatea trebuie sa fie un numar.',
            'cantitate.min' => 'Cantitatea minima este 0.5.',
            'cantitate.max' => 'Pentru cantitati mari, te rugam sa ne contactezi direct.',
            'data_dorita.after_or_equal' => 'Alege o data din viitor.',
            'mesaj.max' => 'Mesajul este prea lung (max. 2000 caractere).',
        ];
    }

    /** @return array<string, string> */
    protected function validationAttributes(): array
    {
        return [
            'nume' => 'nume',
            'telefon' => 'telefon',
            'email' => 'email',
            'localitate' => 'localitate',
            'cantitate' => 'cantitate',
            'data_dorita' => 'data dorita',
            'mesaj' => 'mesaj',
        ];
    }

    /** @return Collection<int, Specie> */
    public function species(): Collection
    {
        return Specie::where('is_active', true)->orderBy('ordine')->get();
    }

    public function submit(): void
    {
        if (! $this->passesSpamGuard('order-form')) {
            return;
        }

        $this->validate();

        $comanda = new ComandaLemn;
        $comanda->nume = $this->nume;
        $comanda->telefon = $this->telefon;
        $comanda->email = $this->email;
        $comanda->localitate = $this->localitate;
        $comanda->specie_id = $this->specieId;
        $comanda->cantitate = $this->cantitate;
        $comanda->unitate = SpecieUnitate::from($this->unitate)->value;
        $comanda->data_dorita = $this->data_dorita;
        $comanda->mesaj = $this->mesaj;
        $comanda->status = ComandaStatus::Nou->value;
        $comanda->source = 'order_form';
        $comanda->save();

        $this->submitted = true;
        $this->reset(['nume', 'telefon', 'email', 'localitate', 'cantitate', 'data_dorita', 'mesaj', 'gdpr']);
    }

    public function render()
    {
        return view('livewire.firewood.order-form', ['species' => $this->species()]);
    }
}
