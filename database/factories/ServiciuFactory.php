<?php

namespace Database\Factories;

use App\Enums\ServiciuAudienta;
use App\Enums\ServiciuCategorie;
use App\Models\Serviciu;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Serviciu>
 */
class ServiciuFactory extends Factory
{
    protected $model = Serviciu::class;

    public function definition(): array
    {
        $titlu = $this->faker->randomElement([
            'Defrisari controlate',
            'Plantari noi',
            'Mentenanta spatii verzi',
            'Compostare deseuri organice',
        ]);

        return [
            'titlu' => ['ro' => $titlu, 'de' => null, 'en' => null],
            'slug' => Str::slug($titlu).'-'.$this->faker->unique()->numberBetween(1, 9999),
            'categorie' => $this->faker->randomElement(ServiciuCategorie::cases()),
            'audienta' => $this->faker->randomElement(ServiciuAudienta::cases()),
            'descriere' => ['ro' => $this->faker->sentence(15), 'de' => null, 'en' => null],
            'continut' => ['ro' => $this->faker->paragraph(4), 'de' => null, 'en' => null],
            'is_active' => true,
            'ordine' => $this->faker->numberBetween(0, 100),
        ];
    }
}
