<?php

namespace App\Http\Controllers\farmasi\laporan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PenggunaanSusuPasienController extends BaseController
{
    public function index()
    {

        return view(
            'farmasi.laporan.penggunaanSusuPasien',
            [
                "menu" => 'laporan'
            ]
        );
    }

    public function getlistpasien(Request $request)
    {


        if ($request->input('no_rkm_medis')) {
            $data = DB::table('detail_pemberian_obat as a')
                ->select(
                    'a.tgl_perawatan',
                    'a.jam',
                    'a.no_rawat',
                    'a.jml',
                    'b.no_rkm_medis',
                    'c.nm_pasien',
                    'a.no_rawat',
                    'd.nama_brng',
                    'd.kode_sat',
                    'e.datetime_penyerahan',
                    DB::raw('IF(e.sign_pasien IS NULL,0,1) as sign_pasien'),
                )
                ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
                ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
                ->join('databarang as d', 'a.kode_brng', '=', 'd.kode_brng')
                ->leftJoin('data_penyerahan_obat as e', function ($join) {
                    $join->on('a.no_resep', '=', 'e.no_resep')
                        ->on('a.no_rawat', '=', 'e.no_rawat');
                })
                ->where('b.no_rkm_medis',$request->input('no_rkm_medis'))
                ->where(function ($query) {
                    $query->where('a.kode_brng','B000004197')
                          ->orWhere('a.kode_brng', 'B000004196')
                          ->orWhere('a.kode_brng', 'B000004349');
                })
                // ->limit(25)
                ->orderBy('a.tgl_perawatan', 'DESC')
                ->get();

            if (!$data->isEmpty()) {
                return response()->json([
                    'code' => 200,
                    'data_resep' => $data,
                ]);
            } else {
                return response()->json([
                    'code' => 404,
                ]);
            }
        } else {
            return response()->json([
                'code' => 404,
            ]);
        }
    }


}
