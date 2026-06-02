<?php

namespace Database\Factories;

use App\Models\Articol;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Articol>
 */
class ArticolFactory extends Factory
{
    protected $model = Articol::class;

    public function definition(): array
    {
        $titlu = $this->faker->sentence(6);

        return [
            'titlu' => ['ro' => $titlu, 'de' => null, 'en' => null],
            'slug' => Str::slug($titlu).'-'.$this->faker->unique()->numberBetween(1, 9999),
            'excerpt' => ['ro' => $this->faker->sentence(15), 'de' => null, 'en' => null],
            'continut' => ['ro' => $this->faker->paragraphs(4, true), 'de' => null, 'en' => null],
            'categorie' => $this->faker->randomElement(['ghid', 'studiu', 'noutati']),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'is_published' => true,
        ];
    }
}
