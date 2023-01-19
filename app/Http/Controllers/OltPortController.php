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
