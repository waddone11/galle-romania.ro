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

    /**
     * @var array<string, array{de: string, en: string}>
     */
    private const TRANSLATIONS = [
        'stejar' => ['de' => 'Eiche',     'en' => 'Oak'],
        'fag' => ['de' => 'Buche',     'en' => 'Beech'],
        'carpen' => ['de' => 'Hainbuche', 'en' => 'Hornbeam'],
        'frasin' => ['de' => 'Esche',     'en' => 'Ash'],
        'salcam' => ['de' => 'Robinie',   'en' => 'Locust'],
    ];

    public function definition(): array
    {
        $nume = (string) array_rand(self::TRANSLATIONS);
        $translations = self::TRANSLATIONS[$nume];

        return [
            'nume' => [
                'ro' => ucfirst($nume),
                'de' => $translations['de'],
                'en' => $translations['en'],
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
