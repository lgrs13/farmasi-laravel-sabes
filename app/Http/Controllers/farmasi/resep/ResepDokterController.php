<?php

namespace App\Http\Controllers\farmasi\resep;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ResepDokterController extends BaseController
{
    public function index()
    {
        $ppn = DB::table('set_ppn as a')
            ->first();
        $penjualan = DB::table('setpenjualanumum as a')
            ->first();

        return view(
            'farmasi.resep.resepDokter',
            [
                "ppn" => $ppn->ppn,
                "penjualan" => $penjualan->utama,
                "menu" => 'resep'
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
                'b.tgl_registrasi',
                'b.jam_reg as jam_registrasi',
                'f.png_jawab'
            )
            ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
            ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
            ->join('dokter as d', 'a.kd_dokter', '=', 'd.kd_dokter')
            ->join('poliklinik as e', 'b.kd_poli', '=', 'e.kd_poli')
            ->join('penjab as f', 'b.kd_pj', '=', 'f.kd_pj')
            ->where('a.status', 'ralan')
            ->whereBetween('a.tgl_perawatan', [$request->input('from'), $request->input('to')])
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
                'b.tgl_registrasi',
                'b.jam_reg as jam_registrasi',
                'a.stts_resep',
                'i.png_jawab'
            )
            ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
            ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
            ->join('dokter as d', 'a.kd_dokter', '=', 'd.kd_dokter')
            ->join('penjab as i', 'b.kd_pj', '=', 'i.kd_pj')
            ->where('a.status', 'ranap')
            ->whereBetween('a.tgl_perawatan', [$request->input('from'), $request->input('to')])
            ->orderBy('a.tgl_perawatan', 'DESC')
            ->orderBy('a.jam', 'DESC')
            ->groupBy('a.no_resep')
            ->get();

        $arraydata = array_map(function ($data) {
            $kamarpasien = DB::table('kamar_inap as a')
                ->select(
                    'a.kd_kamar',
                    'b.kd_bangsal',
                    'c.nm_bangsal'
                )
                ->join('kamar as b', 'a.kd_kamar', '=', 'b.kd_kamar')
                ->join('bangsal as c', 'b.kd_bangsal', '=', 'c.kd_bangsal')
                ->where('a.no_rawat', $data->no_rawat)
                ->orderBy('a.tgl_masuk', 'DESC')
                ->orderBy('a.jam_masuk', 'DESC')
                ->first();

            return [
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
            ];
        }, $resep_ranap->toArray());

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
            ->where('b.no_resep', $request->input('no_resep'))
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


    public function getitempermintaanobatcopy(Request $request)
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
            ->where('b.no_resep', $request->input('no_resep'))
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
        // DB::table('resep_obat as a')
        //     ->where('a.no_resep', $request->input('no_resep'))
        //     ->update([
        //         'stts_resep' => 'Sudah Divalidasi',
        //     ]);

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

    public function getdetailjumlahsisaobat(Request $request)
    {
        $dataobattgl = DB::table('resep_obat as a')
            ->select(
                'c.multidose as jenis_obat_multidose',
                'b.multidose as jml_multidose',
                DB::raw('sum(b.jml) as jml'),
                DB::raw("(SELECT COUNT(*) FROM data_pemberian_obat_ranap AS d_sub WHERE d_sub.no_rawat = a.no_rawat AND d_sub.kode_barang = b.kode_brng) as total_beri"),
            )
            ->join('resep_dokter as b', 'a.no_resep', '=', 'b.no_resep')
            ->join('databarang as c', 'b.kode_brng', '=', 'c.kode_brng')

            ->where('a.no_rawat', '=', $request->input('no_rawat'))
            ->where('b.kode_brng', '=', $request->input('kode_brng'))
            // ->where('a.tgl_perawatan', '=', '2025-04-15')
            // ->where('a.tgl_perawatan', '=', $request->input('tgl_perawatan'))
            // ->whereBetween('a.tgl_perawatan', [$request->input('from'), $request->input('to')])
            // ->groupBy('b.kode_brng')
            ->first();


        if ($dataobattgl) {
            echo json_encode(array(
                'status' => '200',
                'data' => $dataobattgl,
            ));
        } else {
            echo json_encode(array(
                'status' => '404',
            ));
        }
    }

    public function getaturanpakai(Request $request)
    {
        $resep = DB::table('detail_pemberian_obat as a')
            ->select(
                'a.kode_brng',
                'b.nama_brng',
                'c.aturan',
                DB::raw('SUM(a.jml) as jml'),
            )
            ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
            ->leftJoin('aturan_pakai as c', function ($join) {
                $join->on('a.no_rawat', '=', 'c.no_rawat')
                    ->on('a.no_resep', '=', 'c.no_resep')
                    ->on('a.kode_brng', '=', 'c.kode_brng');
            })
            ->where('a.no_resep', $request->input('no_resep'))
            ->where('c.aturan', '<>', '')
            ->groupBy('c.kode_brng')
            ->groupBy('c.aturan')
            ->get();

        $resep_racik = DB::table('obat_racikan as a')
            ->select(
                'a.kd_racik',
                'a.nama_racik',
                'a.aturan_pakai as aturan',
            )
            ->where('a.no_resep', $request->input('no_resep'))
            ->get();


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

        echo json_encode(array(
            'code' => 200,
            'list_obat' => $resep,
            "list_obat_racik" => $resep_racik,
            'pasien' => $pasien,
            'no_resep' => $request->input('no_resep')
        ));
    }

    public function postSelesai(Request $request)
    {
        $save = DB::table('resep_obat as a')
            ->where('a.no_resep', $request->input('no_resep'))
            ->update([
                'stts_resep' => 'Sudah Terlayani',
            ]);

        if ($save) {
            if ($request->input('status_rawat') == 'Ralan') {
                $racik = DB::table('antrian_farmasi as a')
                    ->where('a.no_resep', $request->input('no_resep'))
                    ->first();

                if ($racik) {
                    $racik = DB::table('resep_dokter_racikan as a')
                        ->where('a.no_resep', $request->input('no_resep'))
                        ->count();

                    DB::table('antrian_farmasi')
                        ->insert([
                            'no_resep' => $request->input('no_resep'),
                            'no_rkm_medis' => $request->input('no_rkm_medis'),
                            'no_rawat' => $request->input('no_rawat'),
                            'kd_poli' => $request->input('kd_poli'),
                            'nm_poli' => $request->input('nm_poli'),
                            'nm_pasien' => $request->input('nm_pasien'),
                            'tgl_peresepan' => $request->input('tgl_peresepan'),
                            'no_antri' => $request->input('no_antri'),
                            'racikan' => ($racik > 0 ? 1 : 0),
                            'panggil' => 0
                        ]);
                } else {

                    $save = DB::table('antrian_farmasi as a')
                        ->where('a.no_resep', $request->input('no_resep'))
                        ->update([
                            'stts_resep' => 'Sudah Terlayani',
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
                'penerima_obat' => $request->input('penerima_obat'),
                'ket_penerima_obat' => $request->input('ket_penerima_obat'),

                'sign_pasien' => $request->input('sign_pasien'),

                'user' => $request->session()->get('user')['id_user'],
            ], ['no_rawat']);

        if ($save) {
            $save = DB::table('resep_obat as a')
                ->where('a.no_resep', $request->input('no_resep'))
                ->update([
                    'stts_resep' => 'Selesai',
                ]);

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

    public function postSimpanResep(Request $request)
    {
        $arraybatch = array();
        $save = false;
        $mesagge = '';
        $listitem = $request->input('list_obat');
        $index = (int) ($request->input('tipe') == 3 ? 1 : 0);
        DB::beginTransaction();
        try {
            if ($listitem) {
                for ($i = 0; $i < count($listitem); $i++) {
                    $barang = DB::table('data_batch as a')
                        ->select(
                            'a.kode_brng',
                            'a.no_batch',
                            'a.no_faktur',
                            'a.tgl_kadaluarsa',
                            'a.tgl_beli',
                            'a.utama as harga',
                            'c.stok',
                        )
                        ->Join('gudangbarang as c', function ($join) {
                            $join->on('a.kode_brng', '=', 'c.kode_brng')
                                ->On('a.no_batch', '=', 'c.no_batch')
                                ->On('a.no_faktur', '=', 'c.no_faktur');
                        })
                        ->where('a.kode_brng', $listitem[$i][1 + $index])
                        ->where('c.kd_bangsal', $request->input('depo'))
                        ->orderBy('a.tgl_kadaluarsa')
                        ->orderBy('a.tgl_beli')
                        ->where('c.stok', '>', 0)
                        ->get();

                    $hasilkurang = 0;
                    $sisa = 0;
                    $index2 = 0;
                    if (!$barang->isEmpty()) {
                        foreach ($barang as $data) {
                            if ($hasilkurang == 0) {
                                $hasilkurang = (int) $data->stok - (int) $listitem[$i][0 + $index];
                                $sisa = abs($hasilkurang);

                                $save = DB::table('detail_pemberian_obat')
                                    ->insert([
                                        'tgl_perawatan' => $request->input('tgl_perawatan'),
                                        'jam' => $request->input('jam'),
                                        'no_rawat' => $request->input('no_rawat'),
                                        'kode_brng' => $listitem[$i][1 + $index],
                                        'h_beli' => $listitem[$i][10 + $index],
                                        'biaya_obat' => $listitem[$i][11 + $index],
                                        'jml' => ($hasilkurang >= 0 ? $listitem[$i][0 + $index] : (int) $listitem[$i][0 + $index] - $sisa),
                                        'embalase' => 0,
                                        'tuslah' => 0,
                                        'total' => ((int) $listitem[$i][0 + $index] * (int) $listitem[$i][11 + $index]),
                                        'status' => $request->input('status_rawat'),
                                        'kd_bangsal' => $request->input('depo'),
                                        'no_batch' => $data->no_batch,
                                        'no_faktur' => $data->no_faktur,
                                        'no_resep' => $request->input('no_resep')
                                    ]);

                                // update stok asal
                                $save = DB::table('gudangbarang as a')
                                    ->where('a.kode_brng', $listitem[$i][1])
                                    ->where('a.kd_bangsal', $request->input('depo'))
                                    ->where('a.no_batch', $data->no_batch)
                                    ->where('a.no_faktur', $data->no_faktur)
                                    ->update([
                                        'stok' => ($hasilkurang <= 0 ? 0 : $hasilkurang)
                                    ]);
                            } else {
                                $sisa = abs($hasilkurang);
                                $hasilkurang = (int) $data->stok - (int) $sisa;

                                $save = DB::table('detail_pemberian_obat')
                                    ->insert([
                                        'tgl_perawatan' => $request->input('tgl_perawatan'),
                                        'jam' => $request->input('jam'),
                                        'no_rawat' => $request->input('no_rawat'),
                                        'kode_brng' => $listitem[$i][(1 + $index)],
                                        'h_beli' => $listitem[$i][10 + $index],
                                        'biaya_obat' => $listitem[$i][11 + $index],
                                        'jml' => $sisa,
                                        'embalase' => 0,
                                        'tuslah' => 0,
                                        'total' => ((int) $sisa * (int) $listitem[$i][11 + $index]),
                                        'status' => $request->input('status_rawat'),
                                        'kd_bangsal' => $request->input('depo'),
                                        'no_batch' => $data->no_batch,
                                        'no_faktur' => $data->no_faktur,
                                        'no_resep' => $request->input('no_resep')
                                    ]);

                                // update stok asal
                                $save = DB::table('gudangbarang as a')
                                    ->where('a.kode_brng', $listitem[$i][(1 + $index)])
                                    ->where('a.kd_bangsal', $request->input('depo'))
                                    ->where('a.no_batch', $data->no_batch)
                                    ->where('a.no_faktur', $data->no_faktur)
                                    ->update([
                                        'stok' => ($hasilkurang <= 0 ? 0 : $hasilkurang)
                                    ]);
                                $sisa = abs($hasilkurang);
                            }

                            array_push(
                                $arraybatch,
                                array(
                                    // $listitem[$i][1] =>  $barang,
                                    'hasilkurang' => $hasilkurang,
                                    'sisa' => $sisa,
                                    'no_batch' => $data->no_batch,
                                    'no_faktur' => $data->no_faktur,
                                    'stok' => $data->stok,
                                    'index2' => ++$index2

                                )
                            );

                            if ($hasilkurang >= 0) {
                                $sisa = 0;
                                break;
                            }
                        }

                        $save = DB::table('aturan_pakai')
                            ->insert([
                                'tgl_perawatan' => $request->input('tgl_perawatan'),
                                'jam' => $request->input('jam'),
                                'no_rawat' => $request->input('no_rawat'),
                                'kode_brng' => $listitem[$i][1 + $index],
                                'aturan' => $listitem[$i][5 + $index],
                                'no_resep' => $request->input('no_resep'),
                                'cara_pemberian' => $listitem[$i][6 + $index],
                                'dosis' => $listitem[$i][7 + $index],
                                'frekuensi' => $listitem[$i][8 + $index],
                                'aturan_tambahan' => $listitem[$i][9 + $index],
                            ]);
                    } else {
                        $save = false;
                        $mesagge = 'stok tidak cukup untuk obat ' . $listitem[$i][2 + $index];
                        DB::rollBack();
                        return response()->json([
                            'code' => 201,
                            'mesagge' => $mesagge,
                        ]);
                    }
                }
            }

            //simpan obat racik
            $arraybatch2 = array();
            $listitemracik = $request->input('list_obat_racik');
            if ($listitemracik) {
                for ($i = 0; $i < count($listitemracik); $i++) {

                    if ($listitemracik[$i][0] == 0) {
                        $save = DB::table('obat_racikan')
                            ->insert([
                                'tgl_perawatan' => $request->input('tgl_perawatan'),
                                'jam' => $request->input('jam'),
                                'no_rawat' => $request->input('no_rawat'),
                                'no_resep' => $request->input('no_resep'),
                                'no_racik' => $listitemracik[$i][1],
                                'nama_racik' => $listitemracik[$i][4],
                                'kd_racik' => $listitemracik[$i][3],
                                'jml_dr' => $listitemracik[$i][2],
                                'aturan_pakai' => $listitemracik[$i][6],
                                'keterangan' => $listitemracik[$i][9],
                            ]);
                    } else if ($listitemracik[$i][0] == 1) { {

                            //simpan detail racik
                            $save = DB::table('detail_obat_racikan')
                                ->insert([
                                    'tgl_perawatan' => $request->input('tgl_perawatan'),
                                    'jam' => $request->input('jam'),
                                    'no_rawat' => $request->input('no_rawat'),
                                    'no_resep' => $request->input('no_resep'),
                                    'no_racik' => $listitemracik[$i][1],
                                    'kode_brng' => $listitemracik[$i][3],
                                ]);

                            $barang = DB::table('data_batch as a')
                                ->select(
                                    'a.kode_brng',
                                    'a.no_batch',
                                    'a.no_faktur',
                                    'a.tgl_kadaluarsa',
                                    'a.tgl_beli',
                                    'a.utama as harga',
                                    'c.stok',
                                )
                                ->Join('gudangbarang as c', function ($join) {
                                    $join->on('a.kode_brng', '=', 'c.kode_brng')
                                        ->On('a.no_batch', '=', 'c.no_batch')
                                        ->On('a.no_faktur', '=', 'c.no_faktur');
                                })
                                ->where('a.kode_brng', $listitemracik[$i][3])
                                ->where('c.kd_bangsal', $request->input('depo'))
                                ->orderBy('a.tgl_kadaluarsa')
                                ->orderBy('a.tgl_beli')
                                ->where('c.stok', '>', 0)
                                ->get();

                            $hasilkurang = 0;
                            $sisa = 0;
                            $index2 = 0;
                            if (!$barang->isEmpty()) {
                                foreach ($barang as $data) {
                                    if ($hasilkurang == 0) {
                                        $hasilkurang = (int) $data->stok - (int) $listitemracik[$i][2];
                                        $sisa = abs($hasilkurang);

                                        $save = DB::table('detail_pemberian_obat')
                                            ->insert([
                                                'tgl_perawatan' => $request->input('tgl_perawatan'),
                                                'jam' => $request->input('jam'),
                                                'no_rawat' => $request->input('no_rawat'),
                                                'kode_brng' => $listitemracik[$i][3],
                                                'h_beli' => $listitemracik[$i][6],
                                                'biaya_obat' => $listitemracik[$i][7],
                                                'jml' => ($hasilkurang >= 0 ? $listitemracik[$i][2] : (int) $listitemracik[$i][2] - $sisa),
                                                'embalase' => 0,
                                                'tuslah' => 0,
                                                'total' => ((int) $listitemracik[$i][2] * (int) $listitemracik[$i][7]),
                                                'status' => $request->input('status_rawat') . ' - Racikan',
                                                'kd_bangsal' => $request->input('depo'),
                                                'no_batch' => $data->no_batch,
                                                'no_faktur' => $data->no_faktur,
                                                'no_resep' => $request->input('no_resep')
                                            ]);

                                        // update stok asal
                                        $save = DB::table('gudangbarang as a')
                                            ->where('a.kode_brng', $listitemracik[$i][3])
                                            ->where('a.kd_bangsal', $request->input('depo'))
                                            ->where('a.no_batch', $data->no_batch)
                                            ->where('a.no_faktur', $data->no_faktur)
                                            ->update(values: [
                                                'stok' => ($hasilkurang <= 0 ? 0 : $hasilkurang)
                                            ]);
                                    } else {
                                        $sisa = abs($hasilkurang);
                                        $hasilkurang = (int) $data->stok - (int) $sisa;

                                        $save = DB::table('detail_pemberian_obat')
                                            ->insert([
                                                'tgl_perawatan' => $request->input('tgl_perawatan'),
                                                'jam' => $request->input('jam'),
                                                'no_rawat' => $request->input('no_rawat'),
                                                'kode_brng' => $listitemracik[$i][3],
                                                'h_beli' => $listitemracik[$i][6],
                                                'biaya_obat' => $listitemracik[$i][7],
                                                'jml' => $sisa,
                                                'embalase' => 0,
                                                'tuslah' => 0,
                                                'total' => ((int) $sisa * (int) $listitemracik[$i][7]),
                                                'status' => $request->input('status_rawat') . ' - Racikan',
                                                'kd_bangsal' => $request->input('depo'),
                                                'no_batch' => $data->no_batch,
                                                'no_faktur' => $data->no_faktur,
                                                'no_resep' => $request->input('no_resep')
                                            ]);

                                        // update stok asal
                                        $save = DB::table('gudangbarang as a')
                                            ->where('a.kode_brng', $listitemracik[$i][3])
                                            ->where('a.kd_bangsal', $request->input('depo'))
                                            ->where('a.no_batch', $data->no_batch)
                                            ->where('a.no_faktur', $data->no_faktur)
                                            ->update([
                                                'stok' => ($hasilkurang <= 0 ? 0 : $hasilkurang)
                                            ]);
                                        $sisa = abs($hasilkurang);
                                    }

                                    array_push(
                                        $arraybatch2,
                                        array(
                                            // $listitem[$i][1] =>  $barang,
                                            'hasilkurang' => $hasilkurang,
                                            'sisa' => $sisa,
                                            'no_batch' => $data->no_batch,
                                            'no_faktur' => $data->no_faktur,
                                            'stok' => $data->stok,
                                            'index2' => ++$index2

                                        )
                                    );

                                    if ($hasilkurang >= 0) {
                                        $sisa = 0;
                                        break;
                                        // DB::rollBack();
                                        // return response()->json([
                                        //     'code' => 201,
                                        // ]);
                                    }
                                }
                            } else {
                                $save = false;
                                $mesagge = 'stok tidak cukup untuk obat ' . $listitem[$i][2 + $index];
                                DB::rollBack();
                                return response()->json([
                                    'code' => 201,
                                    'mesagge' => $mesagge,
                                ]);
                            }
                        }
                    }
                }
            }


            if ($save) {
                if ($request->input('tipe') == 3) {

                    DB::table('detail_pemberian_obat_kronis')
                        ->where('no_resep', $request->input('no_resep'))
                        ->delete();

                    for ($i = 0; $i < count($listitem); $i++) {

                        if ($listitem[$i][1] != '') {
                            $save = DB::table('detail_pemberian_obat_kronis')
                                ->insert([
                                    'no_resep' => $request->input('no_resep'),
                                    'no_rawat' => $request->input('no_rawat'),
                                    'tgl_perawatan' => $request->input('tgl_perawatan'),
                                    'jam' => $request->input('jam'),
                                    'kode_brng' => $listitem[$i][2],
                                    'h_beli' => $listitem[$i][11],
                                    'biaya_obat' => $listitem[$i][12],
                                    'jml' => ($listitem[$i][0] == '' ? 0 : $listitem[$i][0]),
                                    'total' => ((int) $listitem[$i][0] * (int) $listitem[$i][12]),
                                    'status' => $request->input('status_rawat'),
                                ]);
                        }
                    }
                }

                $save = DB::table('data_penyerahan_obat')
                    ->upsert([
                        'no_resep' => $request->input('no_resep'),
                        'no_rawat' => $request->input('no_rawat'),
                        'no_rkm_medis' => $request->input('no_rkm_medis'),

                        'perubahan_resep' => $request->input('perubahan_resep'),

                        'status_rawat' => $request->input('status_rawat'),
                        'user_validasi' => $request->session()->get('user')['id_user'],
                        'nama_user_validasi' => $request->session()->get('user')['nama_user'],
                        'datetime_validasi' => date('Y-m-d H:i:s'),
                    ], ['no_rawat']);

                // get no antri
                if ($request->input('status_rawat') == 'ralan') {
                    $no = DB::table('resep_obat')
                        ->select(DB::raw('ifnull(MAX(CONVERT(no_antri,signed)),0) as no_antri'))
                        ->where('tgl_perawatan', '=', $request->input('tgl_perawatan'))
                        ->first();
                }

                DB::table('resep_obat as a')
                    ->where('a.no_resep', $request->input('no_resep'))
                    ->update([
                        'tgl_perawatan' => $request->input('tgl_perawatan'),
                        'jam' => $request->input('jam'),
                        'no_antri' => $no->no_antri ?? '',
                        'stts_resep' => 'Sedang di Proses',
                    ]);

                DB::table('fhir_flag_medication_dispense')
                    ->insert([
                        'no_rawat' => $request->input('no_rawat'),
                        'no_resep' => $request->input('no_resep'),
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
                                // 'timestamp_insert' => $dattimeDec
                            ]);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'code' => 200,
                'data' => $arraybatch
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'code' => 201,
                'error' => $th,
            ]);
        }
    }

    public function postSimpanCopyResep(Request $request)
    {

        $listitem = $request->input('list_obat');
        $save = DB::table('copy_resep_dokter')
            ->where('no_resep', $request->input('no_resep'))
            ->delete();


        for ($i = 0; $i < count($listitem); $i++) {
            $save = DB::table('copy_resep_dokter')
                ->insert([
                    'no_rawat' => $request->input('no_rawat'),
                    'no_resep' => $request->input('no_resep'),
                    'tgl_peresepan' => $request->input('tgl_peresepan'),
                    'jam_peresepan' => $request->input('jam_peresepan'),
                    'kd_dokter' => $request->input('kd_dokter'),
                    'nm_dokter' => $request->input('nm_dokter'),

                    'alergi' => $request->input('alergi'),

                    'kode_brng' => $listitem[$i][2],
                    'nama_barang' => $listitem[$i][3],
                    'jml' => $listitem[$i][0],
                    'sisa' => $listitem[$i][1],
                    'aturan_pakai' => $listitem[$i][5],
                    'keterangan' => $listitem[$i][6],


                    'datetime' => date('Y-m-d H:i:s'),
                    'user' => $request->session()->get('user')['id_user'],
                ]);
        }

        if ($save) {
            echo json_encode(
                array(
                    'code' => 200,
                    'no_resep' => $request->input('no_resep'),

                )
            );
        } else {
            echo json_encode(
                array(
                    'code' => 501,

                )
            );
        }
    }

    public function postEditaturanpakai(Request $request)
    {

        $save = false;
        $listitem = $request->input('list_obat');
        if ($listitem) {
            for ($i = 0; $i < count($listitem); $i++) {
                $save = DB::table('aturan_pakai as a')
                    ->where('a.no_rawat', $request->no_rawat)
                    ->where('a.no_resep', $request->no_resep)
                    ->where('a.kode_brng', $listitem[$i][0])
                    ->update([
                        'aturan' => $listitem[$i][3]
                    ]);
            }
        }

        $listitemracik = $request->input('list_obat_racik');
        if ($listitemracik) {
            for ($i = 0; $i < count($listitemracik); $i++) {
                $save = DB::table('obat_racikan as a')
                    ->where('a.no_rawat', $request->no_rawat)
                    ->where('a.no_resep', $request->no_resep)
                    ->where('a.kd_racik', $listitemracik[$i][0])
                    ->update([
                        'aturan_pakai' => $listitemracik[$i][2]
                    ]);
            }
        }

        echo json_encode(
            array(
                'code' => 200,
                'no_resep' => $request->input('no_resep'),

            )
        );
    }

    public function postBatalResep(Request $request)
    {

        $save = DB::table('resep_obat as a')
            ->where('a.no_resep', $request->input('no_resep'))
            ->update([
                'stts_resep' => 'Batal',
            ]);

        if ($save) {

            $save = DB::table('resep_obat_batal')
                ->upsert(
                    [
                        'no_rawat' => $request->input('no_rawat'),
                        'no_resep' => $request->input('no_resep'),
                        'no_rkm_medis' => $request->input('no_rkm_medis'),

                        'keterangan' => $request->input('keterangan'),
                        'user' => $request->session()->get('user')['id_user'],
                        'datetime' => date('Y-m-d H:i:s'),
                    ],
                    ['no_resep']
                );

            echo json_encode(
                array(
                    'code' => 200,
                    'no_resep' => $request->input('no_resep'),

                )
            );
        } else {
            echo json_encode(
                array(
                    'code' => 501,

                )
            );
        }
    }



    public function HapusDataPemberianObat(Request $request)
    {
        $barang = DB::table('gudangbarang as a')
            ->where('a.kode_brng', $request->input('kode_brng'))
            ->where('a.no_batch', $request->input('no_batch'))
            ->where('a.no_faktur', $request->input('no_faktur'))
            ->where('a.kd_bangsal', 'A1')
            ->first();

        if ($barang) {
            $save = DB::table('riwayat_barang_medis')
                ->insert([
                    'kode_brng' => $request->input('kode_brng'),
                    'no_batch' => $request->input('no_batch'),
                    'no_faktur' => $request->input('no_faktur'),

                    'stok_awal' => $barang->stok,
                    'masuk' => $request->input('jml'),
                    'keluar' => 0,
                    'stok_akhir' => ((int) $barang->stok + (int) $request->input('jml')),

                    'posisi' => 'Pemberian Obat',
                    'kd_bangsal' => 'A1',
                    'status' => 'Hapus',

                    'tanggal' => date('Y-m-d'),
                    'jam' => date('H:i:s'),
                    'petugas' => $request->session()->get('user')['id_user'],

                    'ket' => $request->input('no_rawat') . ' - ' . $request->input('no_resep'),
                ]);
        }

        if ($save) {

            $delete = DB::table('detail_pemberian_obat')
                ->where('no_rawat', $request->input('no_rawat'))
                ->where('no_resep', $request->input('no_resep'))
                ->where('kode_brng', $request->input('kode_brng'))
                ->where('no_batch', $request->input('no_batch'))
                ->where('no_faktur', $request->input('no_faktur'))
                ->delete();

            $update = DB::table('gudangbarang')
                ->where('kode_brng', $request->input('kode_brng'))
                ->where('no_batch', $request->input('no_batch'))
                ->where('no_faktur', $request->input('no_faktur'))
                ->where('kd_bangsal', 'A1')
                ->update([
                    'stok' => ((int) $barang->stok + (int) $request->input('jml'))
                ]);


            echo json_encode(
                array(
                    'code' => 200,
                    'barang' => $barang,
                    '$delete' => $delete,
                    '$update' => $update,
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
