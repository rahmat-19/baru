<?php

namespace App\Http\Controllers;

use App\Models\Olt;
use App\Models\oltPort;
use App\Models\Slot;
use Illuminate\Http\Request;

class OltPortController extends Controller
{
    public function edit(oltPort $port)
    {
        if ($port->penggunaan === 1) {
            $port->update([
                'penggunaan' => 0
            ]);
        } else {
            $port->update([
                'penggunaan' => 1
            ]);
        }

        return redirect(Route('olt.show', ['olt' => $port->slots->id_olt, 'slot' => $port->id_slot]));
    }

    public function unable(oltPort $port)
    {
        $valid = $port->update([
            'penggunaan' => 1
        ]);
        if ($valid) {
            if ($port->data_ports) {
                $port->data_ports()->delete();
            }
            return redirect(Route('olt.show', ['olt' => $port->slots->id_olt, 'slot' => $port->id_slot]));
        }
    }

    public function detail(oltPort $port)
    {
        return response()->json($port);
    }

    public function addPort(Slot $slot, Request $request)
    {
        $sumAltPortOlt = $slot->olt_ports->count();


        for ($i = $sumAltPortOlt + 1; $i <= $sumAltPortOlt + $request->portAdd; $i++) {
            oltPort::create([
                'id_slot' => $slot->id,
                'port_number' => $i
            ]);
        }
        return redirect(Route('olt.show', ['olt' => $slot->id_olt, 'slot' => $slot->id]));
    }
}
