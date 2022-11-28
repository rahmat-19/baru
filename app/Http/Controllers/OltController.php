<?php

namespace App\Http\Controllers;

use App\Models\Olt;
use App\Models\oltPort;
use App\Models\sto;
use Illuminate\Http\Request;

class OltController extends Controller
{
    public function index()
    {
        return view('admin.olt.index', [
            'title' => "All Olt",
            'datas' => Olt::all(),
            'stos' => sto::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hostname' => 'required',
            'id_sto' => 'required',
            'port' => 'required|integer'
        ]);

        $valid = Olt::create($validatedData);
        if ($valid) {
            for ($i = 1; $i <= $valid->port; $i++) {
                oltPort::create([
                    'id_olt' => $valid->id,
                    'port_number' => $i
                ]);
            }
        }
        return redirect(Route('olt.index'));
    }


    public function detail(Olt $olt)
    {
        return view('admin.olt.detail', [
            'title' => $olt->name,
            'data' => $olt,
            'ports' => $olt->olt_ports
        ]);
    }

    public function destroy(Olt $olt)
    {
        $valid = Olt::destroy($olt->id);
        return redirect(Route('olt.index'));
    }
}
