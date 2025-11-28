<?php

namespace App\Http\Controllers\farmasi\laporan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class HTKPController extends BaseController
{
    public function index()
    {

        return view(
            'farmasi.laporan.HTKP',
            [
                "menu" => 'laporan'
            ]
        );
    }

    public function getlistpenyerahan(Request $request)
    {
        if ($request->input('jenisrawat') == 'Poliklinik') {
            $data = DB::table('resep_obat as a')
                ->select(
                    'a.no_rawat',
                    'a.no_resep',
                    'b.no_rkm_medis',
                    'b.datetime_validasi',
                    'b.datetime_racik',
                    'b.datetime_penyerahan',
                    'a.tgl_perawatan',
                    'a.jam',
                    'd.nm_pasien', 
                    DB::raw('IFNULL(TIMESTAMPDIFF(MINUTE,b.datetime_validasi,b.datetime_penyerahan),"") as datedif'),
                    DB::raw('COUNT(c.kode_brng) as jumlah_item')
                )
                ->join('data_penyerahan_obat as b', 'a.no_resep', '=', 'b.no_resep')
                ->join('resep_dokter as c', 'a.no_resep', '=', 'c.no_resep')
                // ->leftJoin('resep_dokter as c', function ($join) {
                //     $join->on('a.no_resep', '=', 'c.no_resep')
                //         ->on('a.no_rawat', '=', 'c.no_rawat');
                // })
                ->join('pasien as d', 'b.no_rkm_medis', '=', 'd.no_rkm_medis')                
                ->where('a.status', 'ralan')
                ->whereBetween('a.tgl_perawatan', [$request->input('from'), $request->input('to')])
                ->orderBy('a.tgl_perawatan', 'ASC')
                ->orderBy('a.jam', 'DESC')
                ->groupBy('c.no_resep')
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
