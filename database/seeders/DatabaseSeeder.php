<?php

namespace Database\Seeders;
use App\Models\Jewelry;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classification;
use App\Models\User;
use App\Models\Color;
use App\Models\Courier;
use App\Models\Material;
use App\Models\Payment;
use App\Models\Stock;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $classifications = [
            "necklace", "bracelet", "anklet", "earrings", "pendant", "amulet", "bangle", "ring", "cufflink"
        ];

        $colors = [
            'gold',
            'silver',
            'platinum',
            'rose gold',
            'white gold',
            'yellow gold',
            'black',
            'blue',
            'red',
            'green',
            'purple',
            'pink',
            'orange',
            'brown',
            'turquoise',
            'pearl white',
            'amber',
            'amethyst',
            'ruby',
            'emerald',
            'sapphire',
            'diamond clear',
        ];

        $payment = [
            'Gcash', 'Paymaya', 'Bank Transfer', 'Cash on Delivery'
        ];

        function mat(){

            $jewelryItems = Jewelry::all();


            $materials = Material::inRandomOrder()->get();


            foreach ($jewelryItems as $jewelry) {

                $randomMaterial = $materials->pop();


                $jewelry->materials()->attach($randomMaterial);

            }
        }


        // Uncomment after initializing the project
        // ==============START===============================

        // User::factory(10)->create();

        foreach ($payment as $pay)
        {
            Payment::create(['method' => $pay]);
        }
        foreach ($classifications as $classification) {
            Classification::create(['classification' => $classification]);
        }
        Jewelry::factory()->count(50)->create();
        foreach ($colors as $color) {
            Color::create(['color' => $color]);
        }
        Courier::factory()->count(5)->create();
        Material::factory()->count(10)->create();

        $this->call([
            ColorJewelrySeeder::class
        ]);
        $this->call([
            StockSeeder::class,
            PriceSeeder::class
        ]);
        $this->call([
            AdminSeeder::class
        ]);

        mat();              //jewelry materials attachment

        // ===============END==========================

    }
}
