<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorJewelry extends Model
{
    use HasFactory;
    protected $table = 'color_jewelry';

    public function stocks(){
        return $this->hasOne(Stock::class);
    }
    public function jewelry()
    {
        return $this->belongsTo(Jewelry::class, 'jewelry_id');
    }

    public function colors()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
