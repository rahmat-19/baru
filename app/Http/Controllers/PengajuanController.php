<?php

namespace App\Http\Controllers;

use App\Models\oltPort;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
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
        $data = Pengajuan::with(['olt_ports.olts'])->where('id_user', Auth::user()->id);
        // dd($data->first()->olt_ports->olts->hostname);
        // $data->groupBy(function ($item) {
        //     return $item->olt_ports->olts->hostname;
        // });

        // $data->groupBy(function ($item) {
        //     dd($item);
        //     return $item->created_at->format('Y-m-d');
        // });


        return view('pengajuan.index', [
            'title' => 'Pengajuan',
            'datas' => $data->get()
        ]);
    }

    public function persetujuan()
    {

        return view('admin.persetujuan.index', [
            'title' => "Persetujuan",
            'datas' => Pengajuan::where('izin', 2)->get()
        ]);
    }

    public function diterima(Pengajuan $pengajuan)
    {
        $valid = $pengajuan->update([
            'izin' => 0
        ]);

        if ($valid) {
            oltPort::where('id', $pengajuan->id_port)->update(['penggunaan' => 1]);
        }

        return redirect(Route('pengajuan.persetujuan'));
    }
    public function ditolak(Pengajuan $pengajuan)
    {
        $valid = $pengajuan->update([
            'izin' => 1
        ]);

        return redirect(Route('pengajuan.persetujuan'));
    }

    public function pengajuanPort(Request $request)
    {
        $validateData = $request->validate([
            'id_port' => 'required',
            'jenisPembangunan' => 'required',
            'label' => 'required',
            'keterangan' => 'nullable',
            'jumlahODP' => 'required',
            'slot' => 'required',
            'usulan' => 'required',
            'alamat' => 'required',
            'distribusi' => 'required'
        ]);

        $validateData['id_user'] = Auth::user()->id;
        Pengajuan::create($validateData);
        return redirect(Route('pengajuan.index'));
    }

    public function exportPdf(Pengajuan $pengajuan)
    {

        $pdf = PDF::loadView('exportPDF', [
            'data' => $pengajuan
        ]);



        return $pdf->download('itsolutionstuff.pdf');
    }
}
