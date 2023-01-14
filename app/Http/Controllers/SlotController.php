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
        ]);

        $valid = Slot::create($data);
        if ($valid) {
            for ($i = 1; $i <= $request->jPort; $i++) {
                oltPort::create([
                    'id_slot' => $valid->id,
                    'port_number' => $i
                ]);
            }
            return redirect(route('olt.show', $valid->id_olt));
        }
    }
}
