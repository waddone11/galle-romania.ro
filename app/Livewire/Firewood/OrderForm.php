<?php

namespace App\Livewire\Firewood;

use App\Enums\ComandaStatus;
use App\Enums\SpecieUnitate;
use App\Models\ComandaLemn;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OrderForm extends Component
{
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

    public bool $submitted = false;

    public function mount(): void
    {
        $this->specieId = Specie::where('is_active', true)->where('status', 'disponibil')->value('id');
    }

    /** @return Collection<int, Specie> */
    public function species(): Collection
    {
        return Specie::where('is_active', true)->orderBy('ordine')->get();
    }

    public function submit(): void
    {
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
        $this->reset(['nume', 'telefon', 'email', 'localitate', 'cantitate', 'data_dorita', 'mesaj']);
    }

    public function render()
    {
        return view('livewire.firewood.order-form', ['species' => $this->species()]);
    }
}
