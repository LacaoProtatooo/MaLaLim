<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\ColorJewelry;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $jewelryItems = ColorJewelry::all();


        foreach ($jewelryItems as $jewelry) {

            if ($jewelry->stocks()->doesntExist()) {
                Stock::factory()->create([
                    'color_jewelry_id' => $jewelry->id,
                ]);
            }
        }
    }
}
