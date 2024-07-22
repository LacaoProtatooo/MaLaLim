<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function users()
    {
        return $this->hasOne(User::class);
    }
    public function couriers()
    {
        return $this->hasOne(Courier::class);
    }
    public function payments()
    {
        return $this->hasOne(Payment::class);
    }
    public function colorJewelry()
    {
        return $this->belongsToMany(ColorJewelry::class)
                    ->withPivot('quantity'); // Ensure the pivot table has 'quantity'
    }
}
