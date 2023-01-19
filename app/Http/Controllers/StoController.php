<?php

namespace App\Http\Controllers;

use App\Imports\StoImport;
use App\Models\sto;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Maatwebsite\Excel\Facades\Excel;

class StoController extends Controller
{
    public function index()
    {
        return view('admin.sto.index', [
            'title' => 'STO',
            'datas' => sto::all()
        ]);
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'slug' => 'required|unique:stos',
            'kota' => 'required|unique:stos'
        ]);

        sto::create($validateData);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        $datas = $request->file('file');
        $nameFile = $datas->getClientOriginalName();
        $datas->move('stoImport', $nameFile);
        Excel::import(new StoImport, \public_path('/stoImport/' . $nameFile));
        return redirect(route('olt.index'));
    }
}
