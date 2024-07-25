<?php

namespace App\Imports;

use App\Models\Promo;
use Maatwebsite\Excel\Concerns\ToModel;

class PromoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Promo([
            'name' => $row[0],
            'description' => $row[1],
            'discountRate' => $row[2],
        ]);
    }
}
