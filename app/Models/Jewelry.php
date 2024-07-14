<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jewelry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'description',
    ];

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function promos()
    {
        return $this->belongsToMany(Promo::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function stocks()
    {
        return $this->hasOne(Stock::class);
    }
}
