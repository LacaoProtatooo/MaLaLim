<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ColorJewelry extends Model
{
    use HasFactory;
    protected $table = 'color_jewelry';

    protected $fillable = [
        'jewelry_id',
        'color_id',
        'image_path',
    ];

    public function stocks(){
        return $this->hasOne(Stock::class, 'color_jewelry_id');
    }
    public function jewelry()
    {
        return $this->belongsTo(Jewelry::class, 'jewelry_id');
    }

    public function colors()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class)
                    ->withPivot('quantity'); // Add any other pivot fields if needed
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
