<?php

namespace App\Imports;

use App\Models\Olt;
use App\Models\oltPort;
use App\Models\sto;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StoImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $checkIDsto = sto::where('slug', $row[0])->first();
            $checkMerk = ['ZTE', 'HUAWEI', 'FIBERHIOME'];
            $checkType = ['C320', 'C630', 'MA5600T', 'AN5000', 'AN6000'];
            if ($checkIDsto && in_array($row[3], $checkMerk) && in_array($row[4], $checkType)) {
                $valid = Olt::create([
                    'id_sto' => $checkIDsto->id,
                    'hostname' => $row[1],
                    'ip' => $row[2],
                    'merk' => $row[3],
                    'type' => $row[4],
                ]);
            } else {
                continue;
            }
        }
    }
}
