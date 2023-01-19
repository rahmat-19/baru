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
            if ($checkIDsto) {
                $valid = Olt::create([
                    'id_sto' => $checkIDsto->id,
                    'hostname' => $row[1],
                ]);
            } else {
                continue;
            }
        }
    }
}
