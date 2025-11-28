<?php

namespace App\Http\Controllers\farmasi\laporan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class TotalResepController extends BaseController
{
    public function index()
    {

        return view(
            'farmasi.laporan.totalHarianResep',
            [
                "menu" => 'laporan'
            ]
        );
    }

    public function getlistpasien(Request $request)
    {
        // $jamawal='';
        // $jamakhir='';

        $tanggal = $request->input('tanggal');
        if ($request->shift == 'Pagi') {
            $jamawal = '07:30:00';
            $jamakhir = '14:00:00';
        } else if ($request->shift == 'Siang') {
            $jamawal = '14:00:00';
            $jamakhir = '20:30:00';
        } else if ($request->shift == 'Malam') {
            $jamawal = '20:30:00';
            $tanggal = date('Y-m-d', strtotime($tanggal . ' +1 day'));
            $jamakhir = '07:30:00';
        } else if ($request->shift == 'All') {
            $jamawal = '07:30:00';
            $tanggal = date('Y-m-d', strtotime($tanggal . ' +1 day'));
            $jamakhir = '07:30:00';
        }


        if ($request->input('jenisrawat') == 'Poliklinik') {
            $data = DB::table('data_penyerahan_obat as a')
                ->select(
                    'a.no_rawat',
                    'a.no_resep',
                    'a.no_rkm_medis',
                    'a.datetime_penyerahan',
                    'b.tgl_perawatan',
                    'b.jam',
                    'd.nm_pasien',
                    'e.nm_poli',
                    // 'f.nm_dokter',
                    'g.png_jawab',
                    DB::raw('count(b.no_resep) as jumlah_resep'),
                )
                ->Join('resep_obat as b', function ($join) {
                    $join->on('a.no_rawat', '=', 'b.no_rawat')
                        ->On('a.no_resep', '=', 'b.no_resep');
                })
                ->join('reg_periksa as c', 'a.no_rawat', '=', 'c.no_rawat')
                ->join('pasien as d', 'a.no_rkm_medis', '=', 'd.no_rkm_medis')
                ->join('poliklinik as e', 'c.kd_poli', '=', 'e.kd_poli')
                // ->join('dokter as f', 'c.kd_dokter', '=', 'f.kd_dokter')
                ->join('penjab as g', 'c.kd_pj', '=', 'g.kd_pj')
                ->where('b.status', 'ralan')
                ->where('c.kd_poli', '<>', 'IGDK')
                // ->where('b.tgl_perawatan', $request->input('tanggal'))
                ->whereBetween(DB::raw('CONCAT(b.tgl_perawatan," ",b.jam)'), [$request->input('tanggal') . ' ' . $jamawal, $tanggal . ' ' . $jamakhir])
                ->whereNotNull(columns: 'a.datetime_penyerahan')
                ->groupBy('a.no_rawat')
                // ->groupBy('a.no_rkm_medis')
                // ->groupBy('a.no_resep')
                ->get();
        } else if ($request->input('jenisrawat') == 'IGD') {
            $data = DB::table('data_penyerahan_obat as a')
                ->select(
                    'a.no_rawat',
                    'a.no_resep',
                    'a.no_rkm_medis',
                    'a.datetime_penyerahan',
                    'b.tgl_perawatan',
                    'b.jam',
                    'd.nm_pasien',
                    'e.nm_poli',
                    // 'f.nm_dokter',
                    'g.png_jawab',
                    DB::raw('count(b.no_resep) as jumlah_resep'),
                )
                ->Join('resep_obat as b', function ($join) {
                    $join->on('a.no_rawat', '=', 'b.no_rawat')
                        ->On('a.no_resep', '=', 'b.no_resep');
                })
                ->join('reg_periksa as c', 'a.no_rawat', '=', 'c.no_rawat')
                ->join('pasien as d', 'a.no_rkm_medis', '=', 'd.no_rkm_medis')
                ->join('poliklinik as e', 'c.kd_poli', '=', 'e.kd_poli')
                // ->join('dokter as f', 'c.kd_dokter', '=', 'f.kd_dokter')
                ->join('penjab as g', 'c.kd_pj', '=', 'g.kd_pj')
                ->where('b.status', 'ralan')
                ->where('c.kd_poli', 'IGDK')
                // ->where('b.tgl_perawatan', $request->input('tanggal'))
                ->whereBetween(DB::raw('CONCAT(b.tgl_perawatan," ",b.jam)'), [$request->input('tanggal') . ' ' . $jamawal, $tanggal . ' ' . $jamakhir])
                ->whereNotNull(columns: 'a.datetime_penyerahan')
                ->groupBy('a.no_rawat')
                // ->groupBy('a.no_rkm_medis')
                // ->groupBy('a.no_resep')
                ->get();
        } else if ($request->input('jenisrawat') == 'Rawat Inap') {
            $data = '';
        }

        if (!$data->isEmpty()) {
            echo json_encode(array(
                'code' => 200,
                'data_resep' => $data,
                'tanggal' => $tanggal,
            ));
        } else {
            echo json_encode(array(
                'code' => 404,
                'tanggal' => $tanggal,
            ));
        }
    }


}
