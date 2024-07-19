<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Classification;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jewelry>
 */
class JewelryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected static $jewelry_names = array(
        "Eternal Elegance ", "Radiant Rose ", "Twilight Tear ", "Golden Grace ",
        "Moonlit Majesty ", "Celestial Charm ", "Starlight Symphony ", "Velvet Vows ",
        "Serenity Spark ", "Gilded Glory ", "Enchanted Embrace ", "Whispering Willow ",
        "Timeless Treasure ", "Luminous Love ", "Dreamy Dew ", "Royal Radiance ",
        "Mystic Moon ", "Harmony Heart ", "Celestial Bliss ", "Blossom Beauty ",
        "Gleaming Grace ", "Sunset Splendor ", "Fairy Tale ", "Ocean Odyssey ",
        "Elegant Echo ", "Starstruck Starlight ", "Petal Perfection ", "Golden Glow ",
        "Mystic Mirage ", "Heavenly Harmony ", "Eternal Ember ", "Twinkling Twilight ",
        "Serenade Sparkle ", "Dazzling Dusk ", "Aurora Allure ", "Whispering Wind ",
        "Radiant Radiance ", "Gilded Garland ", "Moonbeam Melody ", "Sunlit Symphony ",
        "Enchanted Evening ", "Starry Skies ", "Timeless Twinkle ", "Lustrous Love ",
        "Golden Glow ", "Celestial Charm ", "Mystic Midnight ", "Harmony Hues ",
        "Celestial Symphony ", "Blossom Bliss ", "Gleaming Gem ", "Sunset Serenade ",
        "Ethereal Echo ", "Ocean Oasis ", "Elegant Eternity ", "Starry Starling ",
        "Petal Paradise ", "Golden Grace ", "Mystic Muse ", "Heavenly Halo ",
        "Eternal Elegance ", "Twinkling Treasure ", "Serenade Spark ", "Dazzling Dawn ",
        "Aurora Aura ", "Whispering Wave ", "Radiant Rose ", "Gilded Grace ",
        "Moonbeam Magic ", "Sunlit Sparkle ", "Enchanted Embrace ", "Starry Night ",
        "Timeless Tranquility ", "Lustrous Lily ", "Golden Gleam ", "Celestial Glow ",
        "Mystic Moonbeam ", "Harmony Heart ", "Celestial Dream ", "Blossom Brilliance ",
        "Gleaming Glory ", "Sunset Serenity ", "Ethereal Essence ", "Oceanic Oasis ",
        "Elegant Echo ", "Starstruck Symphony ", "Petal Perfection ", "Golden Gem ",
        "Mystic Mirage ", "Heavenly Hues ", "Eternal Ember ", "Twinkling Twilight ",
        "Serenade Sparkle ", "Dazzling Dawn ", "Aurora Allure ", "Whispering Wind "
    );

    protected static $shuffled = false;
    public function definition(): array
    {


        if (empty(static::$jewelry_names)) {
            throw new \Exception('Not enough unique names for the number of instances being created');
        }

        // Shuffle the names array only once if it hasn't been shuffled yet
        if (!isset(static::$shuffled)) {
            shuffle(static::$jewelry_names);
            static::$shuffled = true;
        }
        $classificationIds = Classification::pluck('id')->toArray();
        $classificationId = $this->faker->randomElement($classificationIds);
        // Pop a name from the array to ensure it's unique
        $name = array_pop(static::$jewelry_names);
        $description = implode(' ', $this->faker->sentences(3));

        return [
            //
            'name' => $name,
            'image_path' =>'Image.jpg',
            'classification_id' => $classificationId,
            'description'=> $description,
        ];
    }
}
