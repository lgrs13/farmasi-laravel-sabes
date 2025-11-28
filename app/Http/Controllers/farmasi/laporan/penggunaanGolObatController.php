<?php

namespace App\Http\Controllers\farmasi\laporan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class penggunaanGolObatController extends BaseController
{
    public function index()
    {

        return view(
            'farmasi.laporan.penggunaanGolObat',
            [
                "menu" => 'laporan'
            ]
        );
    }

    public function getobat(Request $request)
    {

        if ($request->jenis == '1') {
            $data = DB::table('reg_periksa as tr')
                ->join('poliklinik as poli', 'tr.kd_poli', '=', 'poli.kd_poli')
                ->leftJoin('detail_pemberian_obat as tbo', 'tr.no_rawat', '=', 'tbo.no_rawat')
                ->leftJoin('databarang as tobat', 'tbo.kode_brng', '=', 'tobat.kode_brng')
                ->select(
                    'tr.kd_poli as kode',
                    'poli.nm_poli as nama',
                    DB::raw('COUNT(DISTINCT tr.no_rkm_medis) AS jumlah_pasien'),
                    DB::raw("
                        COUNT(DISTINCT CASE 
                            WHEN tobat.kode_golongan = '" . $request->kode_golongan . "' THEN tr.no_rkm_medis 
                            ELSE NULL 
                        END) AS pengguna_antibiotik
                    "),
                    // Perhitungan Persentase
                    DB::raw("
                        (COUNT(DISTINCT CASE 
                            WHEN tobat.kode_golongan = '" . $request->kode_golongan . "' THEN tr.no_rkm_medis 
                            ELSE NULL 
                        END) / NULLIF(COUNT(DISTINCT tr.no_rkm_medis), 0) * 100) AS persentase
                    ")
                )

                ->whereNotIn('tr.kd_poli', [
                    'IGDK',
                    'VK',
                    'OKBED',
                    'OKMAT',
                    'LAB',
                    'RAD',
                    'RNP',
                    'TEST'
                ])

                ->where('tr.status_lanjut', 'Ralan')
                ->where('tr.stts', '!=', 'Batal')
                ->whereBetween('tr.tgl_registrasi', [$request->from, $request->to])
                ->groupBy('tr.kd_poli')
                ->get();
        } else {

            $data = DB::table('reg_periksa as tr')
                ->join('dpjp_ranap as dpjp', 'tr.no_rawat', '=', 'dpjp.no_rawat')
                ->join('dokter as dok', 'dpjp.kd_dokter', '=', 'dok.kd_dokter')
                ->leftJoin('detail_pemberian_obat as tbo', 'tr.no_rawat', '=', 'tbo.no_rawat')
                ->leftJoin('databarang as tobat', 'tbo.kode_brng', '=', 'tobat.kode_brng')
                ->select(
                    'dpjp.kd_dokter as kode',
                    'dok.nm_dokter as nama',
                    DB::raw('COUNT(DISTINCT tr.no_rkm_medis) AS jumlah_pasien'),
                    DB::raw("
                        COUNT(DISTINCT CASE 
                            WHEN tobat.kode_golongan = '" . $request->kode_golongan . "' THEN tr.no_rkm_medis 
                            ELSE NULL 
                        END) AS pengguna_antibiotik
                    "),
                    // Perhitungan Persentase
                    DB::raw("
                        (COUNT(DISTINCT CASE 
                            WHEN tobat.kode_golongan = '" . $request->kode_golongan . "' THEN tr.no_rkm_medis 
                            ELSE NULL 
                        END) / NULLIF(COUNT(DISTINCT tr.no_rkm_medis), 0) * 100) AS persentase
                    ")
                )
                ->where('tr.status_lanjut', 'Ranap')
                ->where('tr.stts', '!=', 'Batal')
                ->whereBetween('tr.tgl_registrasi', [$request->from, $request->to])
                ->groupBy('dpjp.kd_dokter')
                ->get();
        }



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
