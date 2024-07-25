<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'jewelry_id'
    ];

    public function jewelries(){
        return $this->belongsTo(Jewelry::class);
    }
}
