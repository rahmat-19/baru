<?php

namespace App\Http\Controllers;

use App\Models\Olt;
use App\Models\oltPort;
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

        return redirect(Route('olt.show', $port->id_olt));
    }

    public function addPort(Olt $olt, Request $request)
    {
        $sumAltPortOlt = $olt->port;
        $value = $olt->update([
            "port" => $olt->port + $request->portAdd
        ]);
        if ($value) {
            for ($i = $sumAltPortOlt + 1; $i <= $sumAltPortOlt + $request->portAdd; $i++) {
                oltPort::create([
                    'id_olt' => $olt->id,
                    'port_number' => $i
                ]);
            }

            return redirect(Route('pengajuan.index'));
        }
    }
}
