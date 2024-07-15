<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jewelry;
use App\Models\Color;
class ColorJewelrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jewelries = Jewelry::all();
        $colors = Color::all();

        $jewelries->each(function ($jewelry) use ($colors) {
            $jewelry->colors()->attach(
                $colors->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
