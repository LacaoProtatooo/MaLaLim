<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function colorJewelry()
    {
        return $this->belongsToMany(ColorJewelry::class)
                    ->withPivot('quantity'); // Ensure the pivot table has 'quantity'
    }
}
