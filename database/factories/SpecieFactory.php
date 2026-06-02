<?php

namespace Database\Factories;

use App\Enums\SpecieStatus;
use App\Enums\SpecieUnitate;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Specie>
 */
class SpecieFactory extends Factory
{
    protected $model = Specie::class;

    public function definition(): array
    {
        $nume = $this->faker->randomElement(['stejar', 'fag', 'carpen', 'frasin', 'salcam']);

        return [
            'nume' => [
                'ro' => ucfirst($nume),
                'de' => match ($nume) {
                    'stejar' => 'Eiche',
                    'fag' => 'Buche',
                    'carpen' => 'Hainbuche',
                    'frasin' => 'Esche',
                    'salcam' => 'Robinie',
                },
                'en' => match ($nume) {
                    'stejar' => 'Oak',
                    'fag' => 'Beech',
                    'carpen' => 'Hornbeam',
                    'frasin' => 'Ash',
                    'salcam' => 'Locust',
                },
            ],
            'slug' => Str::slug($nume).'-'.$this->faker->unique()->numberBetween(1, 9999),
            'status' => $this->faker->randomElement(SpecieStatus::cases()),
            'descriere' => ['ro' => $this->faker->sentence(12), 'de' => null, 'en' => null],
            'pret_pornire' => $this->faker->randomFloat(2, 250, 900),
            'unitate' => SpecieUnitate::Ster,
            'pret_per_unitate' => $this->faker->randomFloat(2, 300, 700),
            'putere_calorica' => $this->faker->randomFloat(2, 3.5, 5.2),
            'is_active' => true,
            'ordine' => $this->faker->numberBetween(0, 100),
        ];
    }
}
