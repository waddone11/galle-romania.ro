<?php

namespace Database\Factories;

use App\Models\Proiect;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Proiect>
 */
class ProiectFactory extends Factory
{
    protected $model = Proiect::class;

    public function definition(): array
    {
        $titlu = $this->faker->catchPhrase();

        return [
            'titlu' => ['ro' => $titlu, 'de' => null, 'en' => null],
            'slug' => Str::slug($titlu).'-'.$this->faker->unique()->numberBetween(1, 9999),
            'descriere' => ['ro' => $this->faker->sentence(20), 'de' => null, 'en' => null],
            'continut' => ['ro' => $this->faker->paragraph(5), 'de' => null, 'en' => null],
            'locatie' => $this->faker->randomElement(['Ploiesti', 'Bucuresti', 'Buftea', 'Campina']),
            'an' => $this->faker->numberBetween(2020, 2025),
            'categorie' => $this->faker->randomElement(['forestier', 'peisagistica', 'compostare']),
            'is_published' => true,
            'ordine' => $this->faker->numberBetween(0, 100),
        ];
    }
}
