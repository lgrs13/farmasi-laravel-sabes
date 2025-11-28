<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class SuplierController extends BaseController
{
    public function index()
    {

        return view('farmasi.master.suplier', [
            "menu" => 'master',
            "submenu" => 'suplier',
        ]);
    }

    public function getData(Request $request)
    {

        $suplier = DB::table('datasuplier as a')
            ->get();

        if (!$suplier->isEmpty()) {
            echo json_encode(
                array(
                    'code' => 200,
                    'suplier' => $suplier,
                )
            );
        }
    }

    public function postData(Request $request)
    {
        $no = DB::table('datasuplier')
            ->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(kode_suplier,4),signed)),0) as no'))
            ->first();
        $kode_suplier = date('Ymd') . 'S' . sprintf("%04s", ($no->no + 1));

        $save = DB::table('datasuplier')
            ->insert([
                'kode_suplier' => $kode_suplier,
                'nama_suplier' => $request->input('nama_suplier'),
                'alamat' => $request->input('alamat') ?? '-',
                'kota' => $request->input('kota') ?? '-',
                'no_telp' => $request->input('no_telp')?? '-',
                'nama_bank' => $request->input('nama_bank') ?? '-',
                'rekening' => $request->input('rekening') ?? '-',
            ]);

        if ($save) {
            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        } else {
            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        }
    }

    public function updateData(Request $request)
    {
        $save = DB::table('datasuplier')
            ->where('kode_suplier', $request->input('kode_suplier'))
            ->update([
                'nama_suplier' => $request->input('nama_suplier'),
                'alamat' => $request->input('alamat') ?? '-',
                'kota' => $request->input('kota') ?? '-',
                'no_telp' => $request->input('no_telp')?? '-',
                'nama_bank' => $request->input('nama_bank') ?? '-',
                'rekening' => $request->input('rekening') ?? '-',
            ]);

        if ($save) {
            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        } else {
            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        }
    }
}
