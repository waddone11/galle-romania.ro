<?php

namespace Database\Factories;

use App\Enums\ComandaStatus;
use App\Enums\SpecieUnitate;
use App\Models\ComandaLemn;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ComandaLemn>
 */
class ComandaLemnFactory extends Factory
{
    protected $model = ComandaLemn::class;

    public function definition(): array
    {
        return [
            'nume' => $this->faker->name(),
            'telefon' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'localitate' => $this->faker->randomElement(['Ploiesti', 'Bucuresti', 'Buftea']),
            'specie_id' => Specie::factory(),
            'cantitate' => $this->faker->randomFloat(2, 1, 20),
            'unitate' => $this->faker->randomElement(SpecieUnitate::cases()),
            'data_dorita' => $this->faker->dateTimeBetween('now', '+30 days'),
            'mesaj' => $this->faker->optional()->sentence(),
            'status' => ComandaStatus::Nou,
            'source' => 'calculator',
        ];
    }
}
