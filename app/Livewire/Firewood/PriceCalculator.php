<?php

namespace App\Livewire\Firewood;

use App\Models\Specie;
use App\Models\ZonaLivrare;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property-read Collection<int, Specie>      $species
 * @property-read Collection<int, ZonaLivrare> $zone
 * @property-read ?Specie                      $specie
 * @property-read ?ZonaLivrare                 $zona
 * @property-read float                        $pretLemn
 * @property-read float                        $costLivrare
 * @property-read float                        $total
 */
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

    /** @return Collection<int, Specie> */
    #[Computed]
    public function species(): Collection
    {
        return Specie::where('is_active', true)->orderBy('ordine')->get();
    }

    /** @return Collection<int, ZonaLivrare> */
    #[Computed]
    public function zone(): Collection
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
        $specie = $this->specie;
        $pret = $specie ? (float) $specie->pret_per_unitate : 0.0;

        return round($pret * max(0, $this->cantitate), 2);
    }

    #[Computed]
    public function costLivrare(): float
    {
        $zona = $this->zona;

        return $zona ? (float) $zona->cost_livrare : 0.0;
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
