<?php

namespace Database\Factories;

use App\Enums\ComandaStatus;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'nume' => $this->faker->name(),
            'firma' => $this->faker->company(),
            'email' => $this->faker->safeEmail(),
            'telefon' => $this->faker->phoneNumber(),
            'serviciu' => $this->faker->randomElement(['forestier', 'peisagistica', 'compostare']),
            'mesaj' => $this->faker->paragraph(2),
            'status' => ComandaStatus::Nou,
            'source' => 'contact_form',
        ];
    }
}
