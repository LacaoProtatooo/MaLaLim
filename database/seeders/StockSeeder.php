<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\Jewelry;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $jewelryItems = Jewelry::all();


        foreach ($jewelryItems as $jewelry) {

            if ($jewelry->stocks()->doesntExist()) {
                Stock::factory()->create([
                    'jewelry_id' => $jewelry->id,
                ]);
            }
        }
    }
}
