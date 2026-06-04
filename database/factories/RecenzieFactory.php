<?php

namespace Database\Factories;

use App\Models\Recenzie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Doar pentru teste — recenziile reale se adauga din admin, nu se seed-uiesc.
 *
 * @extends Factory<Recenzie>
 */
class RecenzieFactory extends Factory
{
    protected $model = Recenzie::class;

    public function definition(): array
    {
        return [
            'nume_client' => $this->faker->name(),
            'localitate' => $this->faker->city(),
            'rating' => $this->faker->numberBetween(4, 5),
            'text' => $this->faker->paragraph(2),
            'serviciu' => $this->faker->randomElement(array_keys(Recenzie::SERVICII)),
            'data' => $this->faker->dateTimeBetween('-1 year'),
            'sursa' => $this->faker->randomElement(['Google', 'WhatsApp', 'direct']),
            'is_published' => false,
            'ordine' => $this->faker->numberBetween(0, 50),
        ];
    }

    public function published(): static
    {
        return $this->state(['is_published' => true]);
    }
}
