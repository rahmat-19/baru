<?php

namespace App\Imports;

use App\Models\sto;
use Maatwebsite\Excel\Concerns\ToModel;

class StoImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new sto([
            'slug' => $row[0],
            'kota' => $row[1]
        ]);
    }
}
