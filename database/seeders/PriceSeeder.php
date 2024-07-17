<?php

namespace Database\Seeders;

use App\Models\Jewelry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\price;
class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jewelryItems = Jewelry::all();


        foreach ($jewelryItems as $jewelry) {

            if ($jewelry->prices()->doesntExist()) {
                Price::factory()->create([
                    'jewelry_id' => $jewelry->id,
                ]);
            }
        }
    }
}
