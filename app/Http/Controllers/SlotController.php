<?php

namespace App\Http\Controllers;

use App\Models\Olt;
use App\Models\oltPort;
use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'jPort' => 'integer|required',
            'id_olt' => 'required',
            'number' => 'required',
            'module' => 'required',
        ]);


        $datas = Olt::find($request->id_olt)->slots()->get()->toArray();
        $data_found = array_search($request->number, array_column($datas, 'number'));
        if ($data_found) {
            return redirect(route('olt.show', $request->id_olt))->with('errorr', 'Nomor Slot Sudah Ada, Gagal Untuk Menabahakn');;
        } elseif ($data_found === 0) {
            return redirect(route('olt.show', $request->id_olt))->with('errorr', 'Nomor Slot Sudah Ada, Gagal Untuk Menabahakn');
        } else {
            $valid = Slot::create($data);
            if ($valid) {
                for ($i = 1; $i <= $request->jPort; $i++) {
                    oltPort::create([
                        'id_slot' => $valid->id,
                        'port_number' => $i
                    ]);
                }
                return redirect(route('olt.show', ['olt' => $request->id_olt, 'slot' => $valid->id]))->with('success', 'Berhasil Menambahkan Slot Baru');
            }
        }
    }
}
