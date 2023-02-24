<?php

namespace App\Http\Controllers;

use App\Models\DataPorts;
use App\Models\oltPort;
use Illuminate\Support\Facades\Gate;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;
use PDF;

class PengajuanController extends Controller
{
    public function index()
    {
        // $idPort = Auth::user()->olt_ports->pluck('id');
        // dd(oltPort::whereIn('id', $idPort)->first());
        // dd(Pengajuan::where('id_user', Auth::user()->id)->first()->olt_ports);


        /* GET DATA PENGAJUAN BY USER */
        // $data = Pengajuan::with(['slots.olts'])->where('id_user', Auth::user()->id);
        /* =============================================================================== */


        // dd($data->first()->olt_ports->olts->hostname);
        // $data->groupBy(function ($item) {
        //     return $item->olt_ports->olts->hostname;
        // });

        // $data->groupBy(function ($item) {
        //     dd($item);
        //     return $item->created_at->format('Y-m-d');
        // });
        $response = Gate::inspect('asmen');

        if ($response->allowed()) {
            return view('dashboard.index', [
                'title' => "Persetujuan",
                'datas' => Pengajuan::where('izin', 2)->get()
            ]);
        } else {
            return view('dashboard.index', [
                'title' => 'Pengajuan',
                'datas' => Auth::user()->pengajuans()->get()
            ]);
        }
    }
    public function diterima(Pengajuan $pengajuan)
    {

        $valid = $pengajuan->update([
            'izin' => 1
        ]);

        if ($valid) {
            oltPort::find($pengajuan->port_id)->update(['penggunaan' => 0]);
            $fileters = Pengajuan::where('port_id', $pengajuan->port_id)->where('izin', 2)->get();
            foreach ($fileters as $fileter) {
                $fileter->update([
                    'izin' => 0
                ]);
            };

            $datas = [
                'id_pengajuan' => $pengajuan->id_pengajuan,
                'id_user' => $pengajuan->id_user,
                'id_port' => $pengajuan->port_id,
                'jenisPembangunan' => $pengajuan->jenisPembangunan,
                "labelODP" => $pengajuan->labelODP,
                "labelODC" => $pengajuan->labelODC,
                "distribusi" => $pengajuan->distribusi,
                "alamat" => $pengajuan->alamat,
                "jumlahODP" => $pengajuan->jumlahODP,
                "usulan" => $pengajuan->usulan,
                "keterangan" => $pengajuan->keterangan,

            ];
            DataPorts::create($datas);
        }

        return redirect(Route('dashboard'));
    }
    public function ditolak(Pengajuan $pengajuan)
    {
        $valid = $pengajuan->update([
            'izin' => 0
        ]);

        return redirect(Route('dashboard'));
    }

    public function pengajuanPort(Request $request)
    {
        $validateData = $request->validate([
            'id_slot' => 'required',
            'jenisPembangunan' => 'required',
            'labelODP' => 'required',
            'labelODC' => 'required',
            'keterangan' => 'nullable',
            'jumlahODP' => 'required',
            'usulan' => 'required',
            'alamat' => 'required',
            'distribusi' => 'required',
            'port' => 'required',
            'port_id' => 'required',
            'id_pengajuan' => 'required|unique:pengajuans'
        ]);

        $validateData['id_user'] = Auth::user()->id;


        Pengajuan::create($validateData);
        return redirect(Route('dashboard'));
    }

    public function exportPdf(Pengajuan $pengajuan)
    {

        $pdf = PDF::loadView('exportPDF', [
            'data' => $pengajuan
        ]);



        return $pdf->download('itsolutionstuff.pdf');
    }
}
