<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'color',
    ];

    public function jewelries()
    {
        return $this->belongsToMany(Jewelry::class, 'color_jewelry')
                    ->withPivot('id'); // Include the pivot ID
    }

    public function colorJewelries()
    {
        return $this->hasMany(ColorJewelry::class, 'color_id');
    }
}
