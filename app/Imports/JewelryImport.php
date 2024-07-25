<?php

namespace App\Imports;

use App\Models\Jewelry;
use App\Models\Price;
use Maatwebsite\Excel\Concerns\ToModel;

class JewelryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         $jewelry = Jewelry::create([
            'name' => $row[0],
            'description' => $row[1],
            'classification_id' => $row[2],
        ]);

        Price::create([
            'jewelry_id' => $jewelry->id,
            'price' => $row[3],
        ]);
    }
}
