<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Shop::create([
                'name' => '店舗' . $i,
                'description' => '店舗の説明です。',
                'address' => '佐賀県佐賀市',
                'phone_number' => '0952-00-0000',
                'regular_holiday' => '不定休',
                'business_hours' => '11:00〜20:00',
                'price_range' => '3,000円〜5,000円',
                'category_id' => (($i - 1) % 10) + 1,
            ]);
        }
    }
}
