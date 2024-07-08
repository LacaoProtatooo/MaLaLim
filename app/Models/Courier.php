<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rate',
    ];

    public function couriers()
    {
        return $this->belongsTo(Courier::class);
    }
}
