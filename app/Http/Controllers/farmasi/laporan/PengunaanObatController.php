<?php

namespace App\Http\Controllers\farmasi\laporan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PengunaanObatController extends BaseController
{
    public function index()
    {

        return view(
            'farmasi.laporan.penggunaanObat',
            [
                "menu" => 'laporan'
            ]
        );
    }

    public function getobat(Request $request)
    {

        $data = DB::table('detail_pemberian_obat as a')
            ->select(
                'a.no_rawat',
                'a.no_resep',
                'b.kode_brng',
                'b.nama_brng',
                'b.kode_sat',
                'a.tgl_perawatan',
                'a.jam',
                'a.jml',
                'd.no_rkm_medis',
                'a.status',
                'd.nm_pasien',
                'd.no_rkm_medis',
                 DB::raw('(SELECT jml from detail_pemberian_obat_kronis WHERE kode_brng = a.kode_brng and no_rawat = a.no_rawat group by kode_brng, no_rawat) as jml_kronis'),
            )
            ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
            ->join('reg_periksa as c', 'a.no_rawat', '=', 'c.no_rawat')
            ->join('pasien as d', 'c.no_rkm_medis', '=', 'd.no_rkm_medis')
           
            ->where('a.kode_brng',$request->input('kode_brng'))
            ->whereBetween('a.tgl_perawatan', [$request->input('from'), $request->input('to')])
            ->orderBy('a.tgl_perawatan', 'ASC')
            ->orderBy('a.jam', 'DESC')
            // ->groupBy('a.no_rawat')
            ->get();


        if (!$data->isEmpty()) {
            echo json_encode(array(
                'code' => 200,
                'data_obat' => $data,
                'kode_brng' => $request->input('kode_brng')
            ));
        } else {
            echo json_encode(array(
                'code' => 404,
                'kode_brng' => $request->input('kode_brng')
            ));
        }
    }


}
