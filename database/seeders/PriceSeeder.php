<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = ['50000', '60000', '70000', '80000', '90000', '100000', '150000', '200000'];
        foreach ($prices as $price) {
            Price::query()->create([
                'price' => $price
            ]);
        }
    }
}
