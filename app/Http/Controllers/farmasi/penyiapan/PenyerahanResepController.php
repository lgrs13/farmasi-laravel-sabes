<?php

namespace App\Http\Controllers\farmasi\penyiapan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PenyerahanResepController extends BaseController
{
    public function index()
    {
        $ppn = DB::table('set_ppn as a')
            ->first();
        $penjualan = DB::table('setpenjualanumum as a')
            ->first();

        return view(
            'farmasi.penyiapan.penyerahan',
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
                'h.*',
            )
            ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
            ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
            ->join('dokter as d', 'b.kd_dokter', '=', 'd.kd_dokter')
            ->join('poliklinik as e', 'b.kd_poli', '=', 'e.kd_poli')
            ->join('penjab as f', 'b.kd_pj', '=', 'f.kd_pj')
            ->join('data_penyerahan_obat as h', 'a.no_resep', '=', 'h.no_resep')
            ->where('a.status', 'ralan')
            ->whereBetween('a.tgl_perawatan', [$request->input('from'), $request->input('to')])
            ->whereNotNull('h.datetime_kemas')
            // ->whereNull('h.datetime_penyerahan')
            // ->where('a.stts_resep', 'Sedang di Proses')
            ->orderBy('a.tgl_perawatan', 'DESC')
            ->orderBy('a.jam', 'DESC')
            ->get();

        $arrayresepralan = array();
        if ($resep_ralan) {

            foreach ($resep_ralan as $data) {
                if ($data->kd_poli != 'IGDK') {
                    $resep = DB::table('resep_obat as a')
                        ->select(
                            DB::raw('count(a.no_resep) as jumlah_resep'),
                        )
                        ->where('a.no_rawat', $data->no_rawat)
                        ->first();
                }


                array_push(
                    $arrayresepralan,
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
                        'nm_poli' => $data->nm_poli,
                        'kd_poli' => $data->kd_poli,
                        'png_jawab' => $data->png_jawab,
                        'datetime_penyerahan' => $data->datetime_penyerahan,
                        'jumlah_resep' => $resep->jumlah_resep ?? 1
                    )
                );
            }
        }


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
                'k.*',
            )
            ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
            ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
            ->join('dokter as d', 'b.kd_dokter', '=', 'd.kd_dokter')
            ->join('penjab as i', 'b.kd_pj', '=', 'i.kd_pj')
            ->join('data_penyerahan_obat as k', 'a.no_resep', '=', 'k.no_resep')
            ->where('a.status', 'ranap')
            ->whereBetween('a.tgl_perawatan', [$request->input('from'), $request->input('to')])
            ->whereNotNull('k.datetime_kemas')
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
                )
            );
        }


        echo json_encode(array(
            'code' => 200,
            'resep_ralan' => $arrayresepralan,
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
                        'b.kode_sat',
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

        echo json_encode(array(
            'code' => 200,
            'list_obat' => $arraydata,
            'list_obat_racik' => $arrdataObatRacik,
            'pasien' => $pasien,
            'alergi_pasien' => $alergi_pasien,
            'diagnosa' => $diagnosa,
            'no_resep' => $request->input('no_resep')
        ));
    }


    public function postSelesai(Request $request)
    {

        $save = false;
        if ($request->input('status_rawat') == 'Ralan') {
            $racik = DB::table('antrian_farmasi as a')
                ->where('a.no_resep', $request->input('no_resep'))
                ->first();

            if (!$racik) {
                $racik = DB::table('resep_dokter_racikan as a')
                    ->where('a.no_resep', $request->input('no_resep'))
                    ->count();

                $save = DB::table('antrian_farmasi')
                    ->insert([
                        'no_resep' => $request->input('no_resep'),
                        'no_rkm_medis' => $request->input('no_rkm_medis'),
                        'no_rawat' => $request->input('no_rawat'),
                        'kd_poli' => $request->input('kd_poli'),
                        'nm_poli' => $request->input('nm_poli'),
                        'nm_pasien' => $request->input('nm_pasien'),
                        'tgl_peresepan' => $request->input('tgl_peresepan'),
                        'no_antri' => $request->input('no_antri') ?? '',
                        'racikan' => ($racik > 0 ? 1 : 0),
                        // 'panggil' => 0
                        'panggil' => 1
                    ]);
            } else {

                $save = DB::table('antrian_farmasi as a')
                    ->where('a.no_resep', $request->input('no_resep'))
                    ->update([
                        'panggil_ulang' => 'ya',
                        'wkt_masuk2' => date('Y-m-d H:i:s'),

                        'no_rkm_medis' => $request->input('no_rkm_medis'),
                        'nm_pasien' => $request->input('nm_pasien'),

                        'no_rawat' => $request->input('no_rawat'),
                        'kd_poli' => $request->input('kd_poli'),
                        'no_antri' => $request->input('no_antri') ?? '',
                    ]);
            }
        }

        if ($save) {

            if ($request->input('stts_resep') == 'Selesai') {
                $save = DB::table('resep_obat as a')
                    ->where('a.no_resep', $request->input('no_resep'))
                    ->update([
                        'stts_resep' => 'Sudah Terlayani',
                    ]);
            }

            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        } else {
            echo json_encode(
                array(
                    'code' => 500,
                    'no_resep' => $request->input('no_resep')
                )
            );
        }
    }

    public function postPenyerahanObat(Request $request)
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
                'no_tlp' => $request->input('no_tlp'),

                'sign_pasien' => $request->input('sign_pasien'),
                'sign_pasien_json' => $request->input('sign_pasien_json'),

                'user_penyerahan' => $request->session()->get('user')['id_user'],
                'nama_user_penyerahan' => $request->session()->get('user')['nama_user'],
                'datetime_penyerahan' => date('Y-m-d H:i:s'),
                // 'user' =>  $request->session()->get('user')['id_user'],
            ], ['no_resep']);

        if ($save) {
            $save = DB::table('resep_obat as a')
                ->where('a.no_resep', $request->input('no_resep'))
                ->update([
                    'stts_resep' => 'Selesai',
                ]);

            $refrensiJKN = DB::table('referensi_mobilejkn_bpjs as a')
                ->where('a.no_rawat', '=', $request->input('no_rawat'))
                ->first();
            if ($refrensiJKN) {

                $task = DB::table('referensi_mobilejkn_bpjs_antrian_tasklog as a')
                    ->where('a.no_rawat', '=', $request->input('no_rawat'))
                    ->where('a.taskid_tipe', '=', '5')
                    ->first();
                if (!$task) {
                    $dattimeDec = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . '- 20 minute'));
                    DB::table('referensi_mobilejkn_bpjs_antrian_tasklog')
                        ->insert([
                            'no_rawat' => $request->input('no_rawat'),
                            'taskid_tipe' => '5',
                            'timestamp_insert' => $dattimeDec
                        ]);
                }

                $task = DB::table('referensi_mobilejkn_bpjs_antrian_tasklog as a')
                    ->where('a.no_rawat', '=', $request->input('no_rawat'))
                    ->where('a.taskid_tipe', '=', '6')
                    ->first();
                if (!$task) {
                    $dattimeDec = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . '- 10 minute'));
                    DB::table('referensi_mobilejkn_bpjs_antrian_tasklog')
                        ->insert([
                            'no_rawat' => $request->input('no_rawat'),
                            'taskid_tipe' => '6',
                            'timestamp_insert' => $dattimeDec
                        ]);
                }

                $task = DB::table('referensi_mobilejkn_bpjs_antrian_tasklog as a')
                    ->where('a.no_rawat', '=', $request->input('no_rawat'))
                    ->where('a.taskid_tipe', '=', '7')
                    ->first();
                if (!$task) {
                   
                    DB::table('referensi_mobilejkn_bpjs_antrian_tasklog')
                        ->insert([
                            'no_rawat' => $request->input('no_rawat'),
                            'taskid_tipe' => '7',
                            // 'timestamp_insert' => $dattimeDec
                        ]);
                }

            } else {
                $task = DB::table('referensi_non_jkn_bpjs_antrian_tasklog as a')
                    ->where('a.no_rawat', '=', $request->input('no_rawat'))
                    ->where('a.taskid_tipe', '=', '5')
                    ->first();
                if (!$task) {
                    $dattimeDec = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . '- 20 minute'));
                    DB::table('referensi_non_jkn_bpjs_antrian_tasklog')
                        ->insert([
                            'no_rawat' => $request->input('no_rawat'),
                            'taskid_tipe' => '5',
                            'timestamp_insert' => $dattimeDec
                        ]);
                }

                $task = DB::table('referensi_non_jkn_bpjs_antrian_tasklog as a')
                    ->where('a.no_rawat', '=', $request->input('no_rawat'))
                    ->where('a.taskid_tipe', '=', '6')
                    ->first();
                if (!$task) {
                    $dattimeDec = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . '- 10 minute'));
                    DB::table('referensi_non_jkn_bpjs_antrian_tasklog')
                        ->insert([
                            'no_rawat' => $request->input('no_rawat'),
                            'taskid_tipe' => '6',
                            'timestamp_insert' => $dattimeDec
                        ]);
                }

                $task = DB::table('referensi_non_jkn_bpjs_antrian_tasklog as a')
                    ->where('a.no_rawat', '=', $request->input('no_rawat'))
                    ->where('a.taskid_tipe', '=', '7')
                    ->first();
                if (!$task) {
                    // $dattimeDec = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . '- 10 minute'));
                    DB::table('referensi_non_jkn_bpjs_antrian_tasklog')
                        ->insert([
                            'no_rawat' => $request->input('no_rawat'),
                            'taskid_tipe' => '7',
                            // 'timestamp_insert' => $dattimeDec
                        ]);
                }
            }

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
