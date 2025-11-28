<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PrincipalController extends BaseController
{
    public function index()
    {

        return view('farmasi.master.principal', [
            "menu" => 'master',
            "submenu" => 'principal',
        ]);
    }

    public function getData(Request $request)
    {

        $data = DB::table('industrifarmasi as a')
            ->get();

        if (!$data->isEmpty()) {
            echo json_encode(
                array(
                    'code' => 200,
                    'data' => $data,
                )
            );
        }
    }

    public function postData(Request $request)
    {
        $no = DB::table('industrifarmasi')
            ->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(kode_industri,4),signed)),0) as no'))
            ->first();
        $kode_industri = date('Ymd') . 'S' . sprintf("%04s", ($no->no + 1));

        $save = DB::table('industrifarmasi')
            ->insert([
                'kode_industri' => $kode_industri,
                'nama_industri' => $request->input('nama_industri'),
                'alamat' => $request->input('alamat') ?? '-',
                'kota' => $request->input('kota') ?? '-',
                'no_telp' => $request->input('no_telp')?? '-',
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
                'kode_industri' => $request->input('nama_suplier'),
                'alamat' => $request->input('alamat') ?? '-',
                'kota' => $request->input('kota') ?? '-',
                'no_telp' => $request->input('no_telp')?? '-',
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
