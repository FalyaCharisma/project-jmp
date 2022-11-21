<?php

namespace App\Http\Controllers;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    public function index(){
        $lk = LaporanKeuangan::all();
        return view('laporan.index', compact('lk'));
    }

    public function simpan(Request $request){
        $nominal = $request->nominal;

        for($i=0; $i < count($nominal); $i++){
            $datas = new LaporanKeuangan();
            $datas->nominal = $nominal[$i];
            $datas->save();
        }
    }
}
