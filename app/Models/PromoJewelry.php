<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoJewelry extends Model
{
    use HasFactory;

    protected $table = 'jewelry_promo';

    protected $fillable = [
        'promo_id',
        'jewelry_id',
    ];

    public function jewelry()
    {
        return $this->belongsTo(Jewelry::class, 'jewelry_id');
    }

    public function colors()
    {
        return $this->belongsTo(Promo::class, 'promo_id');
    }
}
