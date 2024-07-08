<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'price',
        'status',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function jewelries()
    {
        return $this->belongsToMany(Jewelry::class);
    }
    public function couriers()
    {
        return $this->hasOne(Courier::class);
    }
}
