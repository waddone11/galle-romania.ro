<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Faq>
 */
class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition(): array
    {
        return [
            'intrebare' => ['ro' => $this->faker->sentence(8, true), 'de' => null, 'en' => null],
            'raspuns' => ['ro' => $this->faker->paragraph(3), 'de' => null, 'en' => null],
            'categorie' => $this->faker->randomElement(['lemn_de_foc', 'livrare', 'plata', 'servicii']),
            'ordine' => $this->faker->numberBetween(0, 50),
            'is_published' => true,
        ];
    }
}
