<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ColorJewelry> $colorJewelry
 * @property-read int|null $color_jewelry_count
 * @property-read \App\Models\User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUserId($value)
 */
	class Cart extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $classification
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jewelry> $jewelries
 * @property-read int|null $jewelries_count
 * @method static \Database\Factories\ClassificationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereUpdatedAt($value)
 */
	class Classification extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ColorJewelry> $colorJewelries
 * @property-read int|null $color_jewelries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jewelry> $jewelries
 * @property-read int|null $jewelries_count
 * @method static \Illuminate\Database\Eloquent\Builder|Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color query()
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereUpdatedAt($value)
 */
	class Color extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $jewelry_id
 * @property int $color_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cart> $carts
 * @property-read int|null $carts_count
 * @property-read \App\Models\Color $colors
 * @property-read \App\Models\Jewelry $jewelry
 * @property-read \App\Models\Stock|null $stocks
 * @method static \Illuminate\Database\Eloquent\Builder|ColorJewelry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorJewelry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorJewelry query()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorJewelry whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorJewelry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorJewelry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorJewelry whereJewelryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorJewelry whereUpdatedAt($value)
 */
	class ColorJewelry extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CourierFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Courier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereUpdatedAt($value)
 */
	class Courier extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $image_path
 * @property int $classification_id
 * @property string|null $description
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cart> $carts
 * @property-read int|null $carts_count
 * @property-read \App\Models\Classification $classification
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ColorJewelry> $colorjewelries
 * @property-read int|null $colorjewelries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Color> $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Material> $materials
 * @property-read int|null $materials_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\Price|null $prices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Promo> $promos
 * @property-read int|null $promos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\JewelryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry whereClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jewelry whereUpdatedAt($value)
 */
	class Jewelry extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $material
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jewelry> $jewelries
 * @property-read int|null $jewelries_count
 * @method static \Database\Factories\MaterialFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Material newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Material newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Material query()
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereMaterial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereUpdatedAt($value)
 */
	class Material extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $courier_id
 * @property int $quantity
 * @property string $price
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ColorJewelry> $colorJewelry
 * @property-read int|null $color_jewelry_count
 * @property-read \App\Models\Courier|null $couriers
 * @property-read \App\Models\Payment|null $payments
 * @property-read \App\Models\User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCourierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Order|null $payments
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $jewelry_id
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Jewelry|null $jewelries
 * @method static \Database\Factories\PriceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price query()
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereJewelryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereUpdatedAt($value)
 */
	class Price extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $image_path
 * @property string $discountRate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jewelry> $jewelries
 * @property-read int|null $jewelries_count
 * @method static \Illuminate\Database\Eloquent\Builder|Promo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Promo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Promo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Promo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promo whereDiscountRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promo whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promo whereUpdatedAt($value)
 */
	class Promo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $jewelry_id
 * @property int $promo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Promo $colors
 * @property-read \App\Models\Jewelry $jewelry
 * @method static \Illuminate\Database\Eloquent\Builder|PromoJewelry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PromoJewelry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PromoJewelry query()
 * @method static \Illuminate\Database\Eloquent\Builder|PromoJewelry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoJewelry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoJewelry whereJewelryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoJewelry wherePromoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoJewelry whereUpdatedAt($value)
 */
	class PromoJewelry extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUserId($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $color_jewelry_id
 * @property int $quantity
 * @property string|null $image_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ColorJewelry|null $colorjewelry
 * @method static \Database\Factories\StockFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereColorJewelryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 */
	class Stock extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $lname
 * @property string $fname
 * @property string $phone_number
 * @property string $address
 * @property string $email
 * @property string $password
 * @property string|null $birthdate
 * @property string|null $image_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Cart|null $carts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Jewelry> $jewelries
 * @property-read int|null $jewelries_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Order|null $orders
 * @property-read \App\Models\Role|null $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

