<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Classification extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'classification',
    ];

    public function jewelries()
    {
        return $this->hasMany(Jewelry::class);
    }
}
