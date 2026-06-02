<?php

namespace Database\Factories;

use App\Enums\CertificareStatus;
use App\Enums\CertificareTip;
use App\Models\Certificare;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Certificare>
 */
class CertificareFactory extends Factory
{
    protected $model = Certificare::class;

    public function definition(): array
    {
        $tip = $this->faker->randomElement(CertificareTip::cases());

        return [
            'nume' => $tip->label(),
            'tip' => $tip,
            'status' => $this->faker->randomElement(CertificareStatus::cases()),
            'numar' => $this->faker->bothify('###-####-#####'),
            'data_emitere' => $this->faker->optional()->dateTimeBetween('-3 years', 'now'),
            'emitent' => $this->faker->randomElement(['Galle GmbH', 'DEKRA SE', 'SGS', 'TUV']),
            'descriere' => ['ro' => $this->faker->sentence(12), 'de' => null, 'en' => null],
            'is_active' => true,
            'ordine' => $this->faker->numberBetween(0, 50),
        ];
    }
}
