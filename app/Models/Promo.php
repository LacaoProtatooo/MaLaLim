<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'discountRate',
    ];

    public function jewelries()
    {
        return $this->belongsToMany(Jewelry::class);
    }
}
