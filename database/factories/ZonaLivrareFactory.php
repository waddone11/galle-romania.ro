<?php

namespace Database\Factories;

use App\Models\ZonaLivrare;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ZonaLivrare>
 */
class ZonaLivrareFactory extends Factory
{
    protected $model = ZonaLivrare::class;

    public function definition(): array
    {
        $judet = $this->faker->randomElement(['Prahova', 'Ilfov', 'Bucuresti']);

        return [
            'judet'        => $judet,
            'localitati'   => $this->faker->randomElements(['Ploiesti', 'Campina', 'Buftea', 'Voluntari', 'Otopeni', 'Sector 1', 'Sector 2'], 3),
            'cost_livrare' => $this->faker->randomFloat(2, 50, 300),
            'nota'         => ['ro' => $this->faker->sentence(8), 'de' => null, 'en' => null],
            'is_active'    => true,
            'ordine'       => $this->faker->numberBetween(0, 20),
        ];
    }
}
