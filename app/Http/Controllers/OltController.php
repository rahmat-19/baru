<?php

namespace App\Http\Controllers;

use App\Models\Olt;
use App\Models\oltPort;
use App\Models\Slot;
use App\Models\sto;
use Illuminate\Http\Request;

class OltController extends Controller
{
    public function index()
    {
        return view('admin.olt.index', [
            'title' => "All Olt",
            'datas' => Olt::all(),

        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hostname' => 'required|unique:olts',
            'id_sto' => 'required',
        ]);


        $valid = Olt::create($validatedData);

        return redirect(Route('olt.index'));
    }


    public function detail(Olt $olt, Slot $slot)
    {
        $datas = [
            'title' => $olt->hostname,
            'data' => $olt,
        ];


        if (!empty($slot->olt_ports()->get()->toArray())) {
            $datas['ports'] = $slot->olt_ports;
        } else {
            $datas['ports'] = null;
        }



        return view('admin.olt.detail', $datas);
    }

    public function destroy(Olt $olt)
    {
        $valid = $olt::destroy($olt->id);
        return redirect(Route('olt.index'));
    }
}
