<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->realText(50),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'regular_holiday' => fake()->randomElement([
                '月曜日',
                '火曜日',
                '水曜日',
                '木曜日',
                '金曜日',
                '土曜日',
                '日曜日',
                '不定休'
            ]),
            'business_hours' => fake()->randomElement([
                '11:00〜20:00',
                '11:00〜23:00',
                '17:00〜24:00',
                '16:00〜01:00'
            ]),
            'price_range' => fake()->randomElement([
                '〜3,000円',
                '3,000円〜5,000円',
                '5,000円〜10,000円',
                '10,000円〜20,000円',
                '20,000円〜'
            ]),
            'category_id' => fake()->numberBetween(1, 10),
        ];
    }
}
