<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User as ModelsUser;
use App\Review;
use App\User;
use Faker\Generator as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'review' => $this->faker->paragraph,
            'rating' => $this->faker->numberBetween(0, 5),
            'user_id' => function () {
                return ModelsUser::all()->random();
            },
            'product_id' => function () {
                return Product::all()->random();
            },
        ];
    }
}