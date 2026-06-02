<?php

namespace App\Livewire\Firewood;

use App\Models\Specie;
use App\Models\ZonaLivrare;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PriceCalculator extends Component
{
    public ?int $specieId = null;

    public float $cantitate = 1.0;

    public ?int $zonaId = null;

    public function mount(): void
    {
        $disponibila = Specie::where('is_active', true)->where('status', 'disponibil')->first();
        $this->specieId = $disponibila?->id;
        $this->zonaId = ZonaLivrare::where('is_active', true)->orderBy('ordine')->value('id');
    }

    #[Computed]
    public function species()
    {
        return Specie::where('is_active', true)->orderBy('ordine')->get();
    }

    #[Computed]
    public function zone()
    {
        return ZonaLivrare::where('is_active', true)->orderBy('ordine')->get();
    }

    #[Computed]
    public function specie(): ?Specie
    {
        return $this->specieId ? Specie::find($this->specieId) : null;
    }

    #[Computed]
    public function zona(): ?ZonaLivrare
    {
        return $this->zonaId ? ZonaLivrare::find($this->zonaId) : null;
    }

    #[Computed]
    public function pretLemn(): float
    {
        $pret = (float) ($this->specie?->pret_per_unitate ?? 0);

        return round($pret * max(0, $this->cantitate), 2);
    }

    #[Computed]
    public function costLivrare(): float
    {
        return (float) ($this->zona?->cost_livrare ?? 0);
    }

    #[Computed]
    public function total(): float
    {
        return round($this->pretLemn + $this->costLivrare, 2);
    }

    public function render()
    {
        return view('livewire.firewood.price-calculator');
    }
}
