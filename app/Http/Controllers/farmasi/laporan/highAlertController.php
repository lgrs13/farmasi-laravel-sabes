<?php

namespace App\Http\Controllers\farmasi\laporan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class highAlertController extends BaseController
{
    public function index()
    {

        return view(
            'farmasi.laporan.highAlert',
            [
                "menu" => 'laporan'
            ]
        );
    }

    public function getobat(Request $request)
    {
        $data = DB::table('data_pemberian_obat_ranap as a')
            ->select(
                'a.kode_barang',
                'b.nama_brng',
                'a.tanggal_pemberian',
                DB::raw('COUNT(a.kode_barang) as jumlah_beri')
            )
            ->join('databarang as b', 'a.kode_barang', '=', 'b.kode_brng')
            ->where('b.high_alert', 1)
            ->whereBetween('a.tanggal_pemberian', [$request->input('from'), $request->input('to')])
            ->groupBy('a.kode_barang', 'a.tanggal_pemberian', 'b.nama_brng')
            ->orderBy('a.tanggal_pemberian')
            ->get();

        if (!$data->isEmpty()) {
            echo json_encode(array(
                'code' => 200,
                'data_obat' => $data,
            ));
        } else {
            echo json_encode(array(
                'code' => 404,
            ));
        }
    }


}
