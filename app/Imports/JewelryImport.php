<?php

namespace App\Imports;

use App\Models\Jewelry;
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
        return new Jewelry([
            'name' => $row[0],
            'description' => $row[1],
            'classification_id' => $row[2],
        ]);
    }
}
