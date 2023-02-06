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

        $GPFDignore = [0, 9, 10, 18, 19, 20, 21, 22];
        $GTGOGTGHignore = [1, 10, 18, 19, 20, 21, 22];
        $GFGHHFTHGFCHignore = [9, 10, 11, 18, 19, 20, 21, 22];
        $GCOBignore = [9, 10];
        $GFOAGPOAignore = [9, 10, 19, 20, 21, 22];


        $datas = Olt::find($request->id_olt)->slots()->pluck('number')->all();
        // $data_found = array_search($request->number, array_column($datas, 'number'));
        if (in_array($request->number, $datas)) {
            return redirect(route('olt.show', $request->id_olt))->with('errorr', 'Nomor Slot Sudah Ada, Gagal Untuk Menabahakn');;
        } else {
            if ($request->module === "GPFD") {
                if (in_array($request->number, $GPFDignore)) {
                    return redirect(route('olt.show', $request->id_olt))->with('errorr', 'Nomor Slot Tersebut Sudah Terpakai Modul Control');
                }
            } else if ($request->module === "GTGO" || $request->module === "GTGH") {
                if (in_array($request->number, $GTGOGTGHignore)) {
                    return redirect(route('olt.show', $request->id_olt))->with('errorr', 'Nomor Slot Tersebut Sudah Terpakai Modul Control');
                }
            } else if ($request->module === "GFGH" || $request->module === "HFTH" || $request->module === "GFCH") {
                if (in_array($request->number, $GFGHHFTHGFCHignore)) {
                    return redirect(route('olt.show', $request->id_olt))->with('errorr', 'Nomor Slot Tersebut Sudah Terpakai Modul Control');
                }
            } else if ($request->module === "GCOB") {
                if (in_array($request->number, $GCOBignore)) {
                    return redirect(route('olt.show', $request->id_olt))->with('errorr', 'Nomor Slot Tersebut Sudah Terpakai Modul Control');
                }
            } else if ($request->module === "GFOA" || $request->module === "GPOA") {
                if (in_array($request->number, $GFOAGPOAignore)) {
                    return redirect(route('olt.show', $request->id_olt))->with('errorr', 'Nomor Slot Tersebut Sudah Terpakai Modul Control');
                }
            }
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

    public function edit(Slot $slot)
    {
        return response()->json($slot);
    }

    public function update(Slot $slot, Request $request)
    {
        $sumAltPortOlt = $slot->olt_ports->count();
        $data = $request->validate([
            'id_slot' => 'required',
            'module' => 'required',
            'jPortUpdate' => 'required',
        ]);

        $valid = $slot->update([
            'module' => $request->module
        ]);

        if ($valid) {
            if ($sumAltPortOlt <= $request->jPortUpdate) {
                for ($i = $sumAltPortOlt + 1; $i <= 16; $i++) {
                    oltPort::create([
                        'id_slot' => $slot->id,
                        'port_number' => $i
                    ]);
                }
            } else {
                for ($i = $sumAltPortOlt; $i > 8; $i--) {
                    $data = oltPort::where('id_slot', $request->id_slot)->where('port_number', $i)->get();
                    oltPort::destroy($data[0]->id);
                }
            }
        }


        return redirect(Route('olt.show', ['olt' => $slot->id_olt, 'slot' => $slot->id]));
    }
}
