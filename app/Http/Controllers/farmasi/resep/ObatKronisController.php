<?php

namespace App\Http\Controllers\farmasi\resep;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ObatKronisController extends BaseController
{
    public function index()
    {

        return view(
            'farmasi.resep.obatKronis',
            [
                "menu" => 'resep'
            ]
        );
    }

    public function getListkronis(Request $request)
    {
        if ($request->input('jenisrawat') == 'Poliklinik') {
            $data = DB::table('detail_pemberian_obat_kronis as a')
                ->select(
                    'a.no_rawat',
                    'a.no_resep',
                    'b.tgl_perawatan',
                    'b.jam',
                    'd.no_rkm_medis',
                    'd.nm_pasien',
                    'e.nm_dokter',  
                   
                )
                ->join('resep_obat as b', 'a.no_resep', '=', 'b.no_resep')
                ->join('reg_periksa as c', 'a.no_rawat', '=', 'c.no_rawat')
                ->join('pasien as d', 'c.no_rkm_medis', '=', 'd.no_rkm_medis')
                ->join('dokter as e', 'b.kd_dokter', '=', 'e.kd_dokter')  
                ->where('b.status', 'ralan')
                ->whereBetween('b.tgl_perawatan', [$request->input('from'), $request->input('to')])
                ->orderBy('b.tgl_perawatan', 'ASC')
                ->orderBy('b.jam', 'DESC')
                ->groupBy('a.no_resep')
                ->get();
        }else if ($request->input('jenisrawat') == 'Rawat Inap') {
            $data = '';
        }

        if (!$data->isEmpty()) {
            echo json_encode(array(
                'code' => 200,
                'data_resep' => $data,
            ));
        } else {
            echo json_encode(array(
                'code' => 404,
            ));
        }
    }


}
