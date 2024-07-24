<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'color_jewelry_id',
    ];

    public function colorjewelry()
    {
        return $this->belongsTo(ColorJewelry::class);
    }
}
