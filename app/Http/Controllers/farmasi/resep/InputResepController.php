<?php

namespace App\Http\Controllers\farmasi\resep;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class InputResepController extends BaseController
{
    public function index()
    {
        $ppn = DB::table('set_ppn as a')
            ->first();
        $penjualan = DB::table('setpenjualanumum as a')
            ->first();

        return view(
            'farmasi.resep.inputResep',
            [
                "ppn" => $ppn->ppn,
                "penjualan" => $penjualan->utama,
                "menu" => 'resep'
            ]
        );
    }

    public function getPerawtan(Request $request)
    {

        if ($request->input('jenisrawat') == 'Poliklinik') {
            $data = DB::table('reg_periksa as a')
                ->select(
                    'a.no_rawat',
                    'a.tgl_registrasi as tanggal',
                    'a.jam_reg as jam',
                    'a.no_rkm_medis',
                    'a.status_lanjut',
                    'c.nm_pasien',
                    'd.nm_dokter',
                    'e.nm_poli',
                    'f.png_jawab',
                )
                ->join('pasien as c', 'a.no_rkm_medis', '=', 'c.no_rkm_medis')
                ->join('dokter as d', 'a.kd_dokter', '=', 'd.kd_dokter')
                ->join('poliklinik as e', 'a.kd_poli', '=', 'e.kd_poli')
                ->join('penjab as f', 'a.kd_pj', '=', 'f.kd_pj')
                ->where('a.status_lanjut', 'Ralan')
                ->where('a.kd_poli', '<>', 'IGDK')
                ->whereBetween('a.tgl_registrasi', [$request->input('from'), $request->input('to')])
                ->orderBy('a.tgl_registrasi', 'DESC')
                ->orderBy('a.jam_reg', 'DESC')
                ->get();
        } else if ($request->input('jenisrawat') == 'IGD') {
            $data = DB::table('reg_periksa as a')
                ->select(
                    'a.no_rawat',
                    'a.tgl_registrasi as tanggal',
                    'a.jam_reg as jam',
                    'a.no_rkm_medis',
                    'a.status_lanjut',
                    'c.nm_pasien',
                    'd.nm_dokter',
                    'e.nm_poli',
                    'f.png_jawab',
                )
                ->join('pasien as c', 'a.no_rkm_medis', '=', 'c.no_rkm_medis')
                ->join('dokter as d', 'a.kd_dokter', '=', 'd.kd_dokter')
                ->join('poliklinik as e', 'a.kd_poli', '=', 'e.kd_poli')
                ->join('penjab as f', 'a.kd_pj', '=', 'f.kd_pj')
                ->where('a.status_lanjut', 'Ralan')
                ->where('a.kd_poli', 'IGDK')
                ->whereBetween('a.tgl_registrasi', [$request->input('from'), $request->input('to')])
                ->orderBy('a.tgl_registrasi', 'DESC')
                ->orderBy('a.jam_reg', 'DESC')
                ->get();
        } else if ($request->input('jenisrawat') == 'Rawat Inap') {
            if ($request->input('statusranap') == 'Belum Pulang') {
                $data = DB::table('kamar_inap as a')
                    ->select(
                        'c.no_rkm_medis',
                        'c.nm_pasien',
                        'a.kd_kamar as nm_poli',
                        'a.tgl_masuk as tanggal',
                        'a.jam_masuk as jam',
                        'b.no_rawat',
                        'b.status_lanjut',
                        'f.nm_dokter',
                        'g.png_jawab',
                    )
                    ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
                    ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
                    ->join('kamar as d', 'a.kd_kamar', '=', 'd.kd_kamar')
                    ->join('dpjp_ranap as e', 'b.no_rawat', '=', 'e.no_rawat')
                    ->join('dokter as f', 'e.kd_dokter', '=', 'f.kd_dokter')
                    ->join('penjab as g', 'b.kd_pj', '=', 'g.kd_pj')
                    ->where('a.stts_pulang', '=', '-')
                    ->where('b.status_bayar', 'like', "%%")
                    ->get();
            } else if ($request->input('statusranap') == 'Pulang') {
                $data = DB::table('kamar_inap as a')
                    ->select(
                        'a.no_rawat',
                        'c.no_rkm_medis',
                        'c.nm_pasien',
                        'a.kd_kamar as nm_poli',
                        'a.tgl_keluar as tanggal',
                        'a.jam_keluar as jam',
                        'a.no_rawat',
                        'f.nm_dokter',
                        'g.png_jawab',
                    )
                    ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
                    ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
                    ->join('kamar as d', 'a.kd_kamar', '=', 'd.kd_kamar')
                    ->join('dpjp_ranap as e', 'b.no_rawat', '=', 'e.no_rawat')
                    ->join('dokter as f', 'e.kd_dokter', '=', 'f.kd_dokter')
                    ->join('penjab as g', 'b.kd_pj', '=', 'g.kd_pj')
                    ->whereBetween('a.tgl_keluar', [$request->input('from'), $request->input('to')])
                    ->where('b.status_bayar', 'like', "%%")
                    ->where('a.stts_pulang', '!=', "Pindah Kamar")
                    ->groupBy('a.kd_kamar')
                    ->groupBy('a.no_rawat')
                    ->groupBy('a.tgl_masuk')
                    ->groupBy('a.jam_masuk')
                    ->groupBy('f.nm_dokter')
                    ->groupBy('g.png_jawab')
                    ->orderBy('a.tgl_keluar', 'ASC')
                    ->get();
            }
        }

        if (!$data->isEmpty()) {
            echo json_encode(array(
                'code' => 200,
                'data_pasien' => $data,
            ));
        } else {
            echo json_encode(array(
                'code' => 404,
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
            )
            ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
            ->leftJoin('aturan_pakai as c', function ($join) {
                $join->on('a.no_rawat', '=', 'c.no_rawat')
                    ->on('a.no_resep', '=', 'c.no_resep')
                    ->on('a.kode_brng', '=', 'c.kode_brng');
            })
            ->where('a.no_resep', $request->input('no_resep'))
            ->where('c.aturan', '<>', '')
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

    public function getHistoryResep(Request $request)
    {
        $data = DB::table('resep_obat as a')
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
                'a.status',
                'a.stts_resep',
                'e.nm_poli',
                'b.kd_poli',
                'f.png_jawab'
            )
            ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
            ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
            ->join('dokter as d', 'b.kd_dokter', '=', 'd.kd_dokter')
            ->join('poliklinik as e', 'b.kd_poli', '=', 'e.kd_poli')
            ->join('penjab as f', 'b.kd_pj', '=', 'f.kd_pj')
            ->where('a.no_resep', 'NOT LIKE', '%E%')
            ->where('a.no_resep', 'NOT LIKE', '%RNP%')
            ->whereBetween('a.tgl_perawatan', [$request->input('from'), $request->input('to')])
            ->orderBy('a.tgl_perawatan', 'DESC')
            ->orderBy('a.jam', 'DESC')
            ->get();

        if (!$data->isEmpty()) {

            $arraydata = array();
            foreach ($data as $data) {

                if ($data->status == 'ranap') {
                    $ranap = DB::table('kamar_inap as a')
                        ->select(
                            'a.kd_kamar',
                        )
                        ->where('a.no_rawat', $data->no_rawat)
                        ->orderBy('a.tgl_masuk', 'DESC')
                        ->first();
                }

                array_push(
                    $arraydata,
                    array(
                        'no_rawat' => $data->no_rawat,
                        'no_resep' => $data->no_resep,
                        'tanggal' => $data->tgl_peresepan,
                        'jam' => $data->jam_peresepan,
                        'no_rkm_medis' => $data->no_rkm_medis,
                        'nm_pasien' => $data->nm_pasien,
                        'kd_dokter' => $data->kd_dokter,
                        'nm_dokter' => $data->nm_dokter,
                        'asal' => $data->status == 'ranap' ? $ranap->kd_kamar ?? '' : $data->nm_poli,
                        'stts_resep' => $data->stts_resep,
                        'status' => strtoupper($data->status),
                        'png_jawab' => $data->png_jawab,
                    )
                );
            }
            echo json_encode(array(
                'code' => 200,
                'data_resep' => $arraydata,
            ));
        } else {
            echo json_encode(array(
                'code' => 404,
            ));
        }
    }

    public function postSimpanResep(Request $request)
    {
        $arraybatch = array();
        $save = false;
        $mesagge = '';
        $noresep = DB::table('resep_obat')
            ->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(no_resep,3),signed)),0) as no'))
            ->where('tgl_perawatan', '=', date('Y-m-d'))
            ->first();
        $no_resep = date('Ymd') . sprintf("%05s", ($noresep->no + 1));
        $listitem = $request->input('list_obat');
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
                ->where('a.kode_brng', $listitem[$i][1])
                ->where('c.kd_bangsal', $request->input('depo'))
                ->orderBy('a.tgl_kadaluarsa')
                ->orderBy('a.tgl_beli')
                ->where('c.stok', '>', 0)
                ->get();

            $hasilkurang = 0;
            $sisa = 0;
            $index = 0;
            if (!$barang->isEmpty()) {
                foreach ($barang as $data) {
                    if ($hasilkurang == 0) {
                        $hasilkurang = (int) $data->stok - (int) $listitem[$i][0];
                        $sisa = abs($hasilkurang);
                        $save = DB::table('detail_pemberian_obat')
                            ->insert([
                                'tgl_perawatan' => $request->input('tanggal'),
                                'jam' => $request->input('jam'),
                                'no_rawat' => $request->input('no_rawat'),
                                'kode_brng' => $listitem[$i][1],
                                'h_beli' => $listitem[$i][10],
                                'biaya_obat' => $listitem[$i][11],
                                'jml' => ($hasilkurang >= 0 ? $listitem[$i][0] : (int) $listitem[$i][0] - $sisa),
                                'embalase' => 0,
                                'tuslah' => 0,
                                'total' => ((int) $listitem[$i][0] * (int) $listitem[$i][11]),
                                'status' => $request->input('status_rawat'),
                                'kd_bangsal' => $request->input('depo'),
                                'no_batch' => $data->no_batch,
                                'no_faktur' => $data->no_faktur,
                                'no_resep' => $no_resep
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
                                'tgl_perawatan' => $request->input('tanggal'),
                                'jam' => $request->input('jam'),
                                'no_rawat' => $request->input('no_rawat'),
                                'kode_brng' => $listitem[$i][1],
                                'h_beli' => $listitem[$i][10],
                                'biaya_obat' => $listitem[$i][11],
                                'jml' => $sisa,
                                'embalase' => 0,
                                'tuslah' => 0,
                                'total' => ((int) $listitem[$i][0] * (int) $listitem[$i][11]),
                                'status' => $request->input('status_rawat'),
                                'kd_bangsal' => $request->input('depo'),
                                'no_batch' => $data->no_batch,
                                'no_faktur' => $data->no_faktur,
                                'no_resep' => $no_resep
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
                            'index' => ++$index

                        )
                    );

                    if ($hasilkurang >= 0) {
                        $sisa = 0;
                        break;
                    }
                }

                $save = DB::table('aturan_pakai')
                    ->insert([
                        'tgl_perawatan' => $request->input('tanggal'),
                        'jam' => $request->input('jam'),
                        'no_rawat' => $request->input('no_rawat'),
                        'kode_brng' => $listitem[$i][1],
                        'aturan' => $listitem[$i][5],
                        'no_resep' => $no_resep,
                        'cara_pemberian' => $listitem[$i][6],
                        'dosis' => $listitem[$i][7],
                        'frekuensi' => $listitem[$i][8],
                        'aturan_tambahan' => $listitem[$i][9],
                    ]);

            } else {
                $save = false;
                $mesagge = 'stok tidak cukup untuk obat ' . $listitem[$i][2];
                break;
            }
        }

        if ($save) {
            if ($request->input('status_rawat') == 'Ralan') {
                $no_antri = DB::table('resep_obat')
                    ->select(DB::raw('ifnull(MAX(CONVERT(no_antri,signed)),0) as no'))
                    ->where('tgl_perawatan', '=', $request->input('tanggal'))
                    ->first();
            }

            DB::table('resep_obat')
                ->insert([
                    'no_antri' => $no_antri->no ?? " ",
                    'no_resep' => $no_resep,
                    'tgl_perawatan' => $request->input('tanggal'),
                    'jam' => $request->input('jam'),
                    'no_rawat' => $request->input('no_rawat'),
                    'kd_dokter' => $request->input('kd_dokter'),
                    'tgl_peresepan' => $request->input('tanggal'),
                    'jam_peresepan' => $request->input('jam'),
                    'status' => strtolower($request->input('status_rawat')),
                    'stts_resep' => 'Sedang di Proses'
                ]);


            $save = DB::table('data_penyerahan_obat')
                ->upsert([
                    'no_resep' =>$no_resep,
                    'no_rawat' => $request->input('no_rawat'),
                    'no_rkm_medis' => $request->input('no_rkm_medis'),

                    // 'perubahan_resep' => $request->input('perubahan_resep'),

                    'status_rawat' => $request->input('status_rawat'),
                    'user_validasi' => $request->session()->get('user')['id_user'],
                    'nama_user_validasi' => $request->session()->get('user')['nama_user'],
                    'datetime_validasi' => date('Y-m-d H:i:s'),
                ], ['no_rawat']);   

            echo json_encode(
                array(
                    'code' => 200,
                    'data' => $arraybatch
                )
            );
        } else {

            DB::table('detail_pemberian_obat')
                ->where('no_resep', $request->input('no_resep'))
                ->delete();

            DB::table('aturan_pakai')
                ->where('no_resep', $request->input('no_resep'))
                ->delete();

            echo json_encode(
                array(
                    'code' => 500,
                    'mesagge' => $mesagge

                )
            );
        }
    }

    public function postEditaturanpakai(Request $request)
    {

        $save = false;
        $listitem = $request->input('list_obat');

        for ($i = 0; $i < count($listitem); $i++) {
            $save = DB::table('aturan_pakai as a')
                ->where('a.no_rawat', $request->no_rawat)
                ->where('a.no_resep', $request->no_resep)
                ->where('a.kode_brng', $listitem[$i][0])
                ->update([
                    'aturan' => $listitem[$i][2]
                ]);
        }

        $listitemracik = $request->input('list_obat_racik');
        for ($i = 0; $i < count($listitemracik); $i++) {
            $save = DB::table('obat_racikan as a')
                ->where('a.no_rawat', $request->no_rawat)
                ->where('a.no_resep', $request->no_resep)
                ->where('a.kd_racik', $listitemracik[$i][0])
                ->update([
                    'aturan_pakai' => $listitemracik[$i][2]
                ]);
        }

        echo json_encode(
            array(
                'code' => 200,
                'no_resep' => $request->input('no_resep'),

            )
        );
    }

}
