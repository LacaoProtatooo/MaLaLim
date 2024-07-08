<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'price',
    ];

    public function jewelries()
    {
        return $this->belongsTo(Jewelry::class);
    }
}
