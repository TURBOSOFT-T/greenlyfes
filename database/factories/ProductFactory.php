<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'price' => mt_rand(100, 1000) / 10.0,
            'originalPrice' => $this->faker->numberBetween(10, 20),
            'discountPrice' => $this->faker->numberBetween(1, 15),
            'stock' =>
            $this->faker->numberBetween(10, 10),
            'stock_alert'=>5,
            'user_id' => function () {
                return User::all()->random();
            },
            'category_id' => function () {
                return Category::all()->random();
            },
        ];
    }
}
