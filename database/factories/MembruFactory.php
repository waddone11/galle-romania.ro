<?php

namespace Database\Factories;

use App\Models\Membru;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Membru>
 */
class MembruFactory extends Factory
{
    protected $model = Membru::class;

    public function definition(): array
    {
        return [
            'nume' => fake()->name(),
            'rol' => ['ro' => fake()->jobTitle(), 'de' => null, 'en' => null],
            'imagine' => null,
            'is_active' => true,
            'ordine' => fake()->numberBetween(0, 100),
        ];
    }
}
