<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Jewelry extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'image_path',
        'description',
        'classification_id',
    ];

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_jewelry')
                    ->withPivot('id'); // Include the pivot ID
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function promos()
    {
        return $this->belongsToMany(Promo::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
    public function prices()
    {
        return $this->hasOne(Price::class);
    }

    public function colorjewelries()
    {
        return $this->hasMany(ColorJewelry::class);
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Add related model attributes to the searchable array
        $array['classification'] = $this->classification ? $this->classification->classification : null;

        return $array;
    }
}
