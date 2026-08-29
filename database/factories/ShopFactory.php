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
            'name' => $this->faker->company(),
            'description' => $this->faker->realText(50),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'regular_holiday' => $this->faker->randomElement([
                '月曜日',
                '火曜日',
                '水曜日',
                '木曜日',
                '金曜日',
                '土曜日',
                '日曜日',
                '不定休'
            ]),
            'business_hours' => $this->faker->randomElement([
                '11:00〜20:00',
                '11:00〜23:00',
                '17:00〜24:00',
                '16:00〜01:00'
            ]),
            'price_range' => $this->faker->randomElement([
                '〜3,000円',
                '3,000円〜5,000円',
                '5,000円〜10,000円',
                '10,000円〜20,000円',
                '20,000円〜'
            ]),
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
