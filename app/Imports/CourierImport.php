<?php

namespace App\Imports;

use App\Models\Courier;
use Maatwebsite\Excel\Concerns\ToModel;
use SebastianBergmann\LinesOfCode\Counter;

class CourierImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Courier([
            'name' => $row[0],
            'rate' => $row[1],
        ]);
    }
}
