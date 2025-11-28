<?php

namespace App\Http\Controllers\farmasi\penyiapan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PenyiapanRacikController extends BaseController
{
    public function index()
    {
        $ppn = DB::table('set_ppn as a')
            ->first();
        $penjualan = DB::table('setpenjualanumum as a')
            ->first();

        return view(
            'farmasi.penyiapan.racik',
            [
                "ppn" => $ppn->ppn,
                "penjualan" => $penjualan->utama,
                "menu" => 'persiapanobat'
            ]
        );
    }

    public function getResep(Request $request)
    {
        $resep_ralan = DB::table('resep_obat as a')
            ->select(
                'a.no_antri',
                'a.no_resep',
                'a.tgl_peresepan',
                'a.jam_peresepan',
                'a.no_rawat',
                'c.no_rkm_medis',
                'c.nm_pasien',
                'a.kd_dokter',
                'd.nm_dokter',
                'a.stts_resep',
                'e.nm_poli',
                'b.kd_poli',
                'f.png_jawab',
                'g.kd_racik',
                'j.datetime_racik'
            )
            ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
            ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
            ->join('dokter as d', 'b.kd_dokter', '=', 'd.kd_dokter')
            ->join('poliklinik as e', 'b.kd_poli', '=', 'e.kd_poli')
            ->join('penjab as f', 'b.kd_pj', '=', 'f.kd_pj')
            ->leftJoin('resep_dokter_racikan as g', 'a.no_resep', '=', 'g.no_resep')
            ->leftJoin('data_penyerahan_obat as j', 'a.no_resep', '=', 'j.no_resep')
            ->where('a.status', 'ralan')
            ->whereBetween('a.tgl_perawatan', [$request->input('from'), $request->input('to')])
            ->whereNotNull('g.kd_racik')
            // ->where('a.stts_resep', 'Sedang di Proses')
            ->where(function ($query) {
                $query->where('a.stts_resep', 'Sedang di Proses')
                    ->orWhere('a.stts_resep', 'Sudah Terlayani');
            })
            ->orderBy('a.tgl_perawatan', 'DESC')
            ->orderBy('a.jam', 'DESC')
            ->get();


        $resep_ranap = DB::table('resep_obat as a')
            ->select(
                'a.no_antri',
                'a.no_resep',
                'a.tgl_peresepan',
                'a.jam_peresepan',
                'a.no_rawat',
                'c.no_rkm_medis',
                'c.nm_pasien',
                'a.kd_dokter',
                'd.nm_dokter',
                'a.stts_resep',               
                'i.png_jawab',
                'k.kd_racik',
                'j.datetime_racik'
            )
            ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
            ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
            ->join('dokter as d', 'b.kd_dokter', '=', 'd.kd_dokter')
            ->join('penjab as i', 'b.kd_pj', '=', 'i.kd_pj')
            ->leftJoin('resep_dokter_racikan as k', 'a.no_resep', '=', 'k.no_resep')
            ->leftJoin('data_penyerahan_obat as j', 'a.no_resep', '=', 'j.no_resep')
            ->where('a.status', 'ranap')
            ->where('a.stts_resep', 'Sedang di Proses')
            ->whereBetween('a.tgl_perawatan', [$request->input('from'), $request->input('to')])
            ->whereNotNull('k.kd_racik')
            ->orderBy('a.tgl_perawatan', 'DESC')
            ->orderBy('a.jam', 'DESC')
            ->groupBy('a.no_resep')
            ->get();

        $arraydata = array();
        foreach ($resep_ranap as $data) {

            $kamarpasien = DB::table('kamar_inap as a')
                ->select(
                    'a.kd_kamar',
                    'b.kd_bangsal',
                    'c.nm_bangsal',
                )
                ->join('kamar as b', 'a.kd_kamar', '=', 'b.kd_kamar')
                ->join('bangsal as c', 'b.kd_bangsal', '=', 'c.kd_bangsal')
                ->where('a.no_rawat', $data->no_rawat)
                ->orderBy('a.tgl_masuk', 'DESC')
                ->orderBy('a.jam_masuk', 'DESC')
                ->first();

            array_push(
                $arraydata,
                array(
                    'no_antri' => $data->no_antri,
                    'no_resep' => $data->no_resep,
                    'tgl_peresepan' => $data->tgl_peresepan,
                    'jam_peresepan' => $data->jam_peresepan,
                    'no_rawat' => $data->no_rawat,
                    'no_rkm_medis' => $data->no_rkm_medis,
                    'nm_pasien' => $data->nm_pasien,
                    'kd_dokter' => $data->kd_dokter,
                    'nm_dokter' => $data->nm_dokter,
                    'stts_resep' => $data->stts_resep,
                    'nm_bangsal' => $kamarpasien->nm_bangsal ?? '',
                    'kd_kamar' => $kamarpasien->kd_kamar ?? '',
                    'kd_bangsal' => $kamarpasien->kd_bangsal ?? '',
                    'png_jawab' => $data->png_jawab,
                    'kd_racik' => $data->kd_racik,
                    'datetime_racik' => $data->datetime_racik,
                )
            );
        }


        echo json_encode(array(
            'code' => 200,
            'resep_ralan' => $resep_ralan,
            'resep_ranap' => $arraydata,
        ));
    }

    public function getitempermintaanobat(Request $request)
    {
        $resep = DB::table('databarang as a')
            ->select(
                'a.kode_brng',
                'a.nama_brng',
                'a.utama',
                'a.kode_brng',
                'a.h_beli',
                'a.utama',
                'a.kode_sat',
                'b.*',
                'c.nama AS golongan',
            )
            ->join('resep_dokter as b', 'a.kode_brng', '=', 'b.kode_brng')
            ->join('golongan_barang as c', 'a.kode_golongan', '=', 'c.kode')
            // ->join(
            //     DB::raw('SUM(a.stok) as stok, kode_brng  FROM referensi_non_jkn_bpjs_antrian_tasklog GROUP BY no_rawat) f'),
            //     function ($join) {
            //         $join->on('b.no_rawat', '=', 'f.no_rawat')
            //         ->On('b.taskid_tipe', '=', 'f.taskid_tipe');
            //     }
            // )
            ->where('b.no_resep', $request->input('no_resep'))
            // ->where('b.no_rawat', $request->input('no_rawat'))
            ->where('a.STATUS', '1')
            ->get();

        $arraydata = array();
        if ($resep) {
            foreach ($resep as $data) {

                $barang = DB::table('gudangbarang as a')
                    ->select(
                        DB::raw('SUM(a.stok) as stok'),
                    )
                    ->where('a.kode_brng', $data->kode_brng)
                    ->where('a.kd_bangsal', $request->input('kd_bangsal'))
                    ->groupBy('a.kode_brng')
                    ->first();


                array_push(
                    $arraydata,
                    array(
                        'jml' => $data->jml,
                        'kode_brng' => $data->kode_brng,
                        'nama_brng' => $data->nama_brng,
                        'harga_beli' => $data->h_beli,
                        'harga' => $data->utama,
                        'kode_sat' => $data->kode_sat,
                        'aturan_pakai' => $data->aturan_pakai,
                        'cara_pemberian' => $data->cara_pemberian,
                        'frekuensi' => $data->frekuensi,
                        'dosis' => $data->dosis,
                        'aturan_tambahan' => $data->aturan_tambahan,
                        'stok' => $barang->stok ?? 0,
                    )
                );
            }
        }

        $dataobatRacik = DB::table('resep_dokter_racikan as a')
            ->where('a.no_resep', '=', $request->input('no_resep'))
            ->orderBy('a.no_racik')
            ->get();

        $arrdataObatRacik = array();
        if (!$dataobatRacik->isEmpty()) {
            foreach ($dataobatRacik as $dataobatRacik) {
                $dataDetobatRacik = DB::table('resep_dokter_racikan_detail as a')
                    ->select(
                        'a.*',
                        'b.nama_brng',
                        'b.utama',
                        'b.h_beli',
                        'b.utama',
                    )
                    ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                    ->where('a.no_resep', '=', $request->input('no_resep'))
                    ->where('a.kd_racik', '=', $dataobatRacik->kd_racik)
                    ->get();


                array_push($arrdataObatRacik, array(
                    "kd_racik" => $dataobatRacik->kd_racik,
                    "no_racik" => $dataobatRacik->no_racik,
                    "nama_racik" => $dataobatRacik->nama_racik,
                    "metode_racik" => $dataobatRacik->metode_racik,
                    "jml_dr" => $dataobatRacik->jml_dr,
                    "frekuensi" => $dataobatRacik->frekuensi,
                    "cara_beri" => $dataobatRacik->cara_beri,
                    "keterangan" => $dataobatRacik->keterangan,
                    "aturan_pakai" => $dataobatRacik->aturan_pakai,
                    "dataObat" => $dataDetobatRacik
                ));
            }
        }

        $pasien = DB::table('reg_periksa as a')
            ->select(
                'a.no_rawat',
                'b.no_rkm_medis',
                'b.nm_pasien',
                'b.tgl_lahir',
                'b.umur',
            )
            ->join('pasien as b', 'a.no_rkm_medis', '=', 'b.no_rkm_medis')
            ->where('a.no_rawat', $request->input('no_rawat'))
            ->first();

        $alergi_pasien = DB::table('alergi_pasien as a')
            ->where('a.no_rawat', $request->input('no_rawat'))
            ->first();

        $diagnosa = DB::table('diagnosa_pasien_rajal as a')
            ->where('a.no_rawat', $request->input('no_rawat'))
            ->orderBy('a.id', 'DESC')
            ->first();


        //update status resep
        DB::table('resep_obat as a')
            ->where('a.no_resep', $request->input('no_resep'))
            ->update([
                'stts_resep' => 'Sudah Divalidasi',
            ]);

        echo json_encode(array(
            'code' => 200,
            'list_obat' => $arraydata,
            "list_obat_racik" => $arrdataObatRacik,
            'pasien' => $pasien,
            'alergi_pasien' => $alergi_pasien,
            'diagnosa' => $diagnosa,
            'no_resep' => $request->input('no_resep')
        ));
    }

    public function postSimpanResep(Request $request)
    {

        $save = DB::table('data_penyerahan_obat')
            ->upsert([
                'no_resep' => $request->input('no_resep'),
                'no_rawat' => $request->input('no_rawat'),
                'no_rkm_medis' => $request->input('no_rkm_medis'),

                'aspek_telaah_1' => $request->input('aspek_telaah_1'),
                'aspek_telaah_2' => $request->input('aspek_telaah_2'),
                'aspek_telaah_3' => $request->input('aspek_telaah_3'),
                'aspek_telaah_4' => $request->input('aspek_telaah_4'),
                'aspek_telaah_5' => $request->input('aspek_telaah_5'),
                'aspek_telaah_6' => $request->input('aspek_telaah_6'),
                'aspek_telaah_7' => $request->input('aspek_telaah_7'),
                'aspek_telaah_8' => $request->input('aspek_telaah_8'),
                'aspek_telaah_9' => $request->input('aspek_telaah_9'),

                'telaah_obat_1' => $request->input('telaah_obat_1'),
                'telaah_obat_2' => $request->input('telaah_obat_2'),
                'telaah_obat_3' => $request->input('telaah_obat_3'),
                'telaah_obat_4' => $request->input('telaah_obat_4'),
                'telaah_obat_5' => $request->input('telaah_obat_5'),

                'perubahan_resep' => $request->input('perubahan_resep'),

                'materi_edukasi_1' => $request->input('materi_edukasi_1'),
                'materi_edukasi_2' => $request->input('materi_edukasi_2'),
                'materi_edukasi_3' => $request->input('materi_edukasi_3'),
                'materi_edukasi_4' => $request->input('materi_edukasi_4'),

                'kontrol_high_alert' => $request->input('kontrol_high_alert'),
                'ket_kontrol_high_alert' => $request->input('ket_kontrol_high_alert'),

                'penyerahan' => $request->input('penyerahan'),

                'penerima_obat' => $request->input('penerima_obat'),
                'ket_penerima_obat' => $request->input('ket_penerima_obat'),

                'sign_pasien' => $request->input('sign_pasien'),

                // 'user' =>  $request->session()->get('user')['id_user'],

                'user_racik' => $request->session()->get('user')['id_user'],
                'nama_user_racik' => $request->session()->get('user')['nama_user'],
                'datetime_racik' => date('Y-m-d H:i:s'),

                'user_kemas' => $request->session()->get('user')['id_user'],
                'nama_user_kemas' => $request->session()->get('user')['nama_user'],
                'datetime_kemas' => date('Y-m-d H:i:s'),
            ], ['no_resep']);


        if ($save) {
            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        } else {
            echo json_encode(
                array(
                    'code' => 500,

                )
            );
        }
    }
}
