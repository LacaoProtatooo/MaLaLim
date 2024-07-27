<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'courier_id',
        'payment_id',
        'name',
        'address',
        'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function colorJewelry()
    {
        return $this->belongsToMany(ColorJewelry::class)
                    ->withPivot('quantity'); // Ensure the pivot table has 'quantity'
    }
}
