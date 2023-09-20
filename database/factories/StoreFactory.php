<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Store::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'address' => fake()->address,
            'user_id' => rand(1, 100),
        ];
    }
}
