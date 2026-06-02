<?php

namespace Database\Factories;

use App\Models\Pagina;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Pagina>
 */
class PaginaFactory extends Factory
{
    protected $model = Pagina::class;

    public function definition(): array
    {
        $titlu = $this->faker->sentence(4);

        return [
            'slug' => Str::slug($titlu).'-'.$this->faker->unique()->numberBetween(1, 9999),
            'titlu' => ['ro' => $titlu, 'de' => null, 'en' => null],
            'meta_title' => ['ro' => $titlu, 'de' => null, 'en' => null],
            'meta_description' => ['ro' => $this->faker->sentence(15), 'de' => null, 'en' => null],
            'sectiuni' => null,
            'is_published' => true,
            'ordine' => $this->faker->numberBetween(0, 50),
        ];
    }
}
