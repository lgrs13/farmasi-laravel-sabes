<?php

namespace App\Http\Controllers\master;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class DataController extends BaseController
{
    public function getdetailpasien(Request $request)
    {
        $pasien = DB::table('pasien')
            ->where('no_rkm_medis', $request->input('no_rkm_medis'))
            ->first();

        if ($pasien) {
            return response()->json([
                'status' => 200,
                'data' => $pasien
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function getPerawatan(Request $request)
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
                    'd.kd_dokter',
                    'e.nm_poli',
                    'f.png_jawab',
                    'c.jk',

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
                    'd.kd_dokter',
                    'e.nm_poli',
                    'f.png_jawab',
                    'c.jk',
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
                        'e.kd_dokter',
                        'c.jk',
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
            return response()->json([
                'code' => 200,
                'data_pasien' => $data,
            ]);
        } else {
            return response()->json([
                'code' => 404,
            ], 404);
        }
    }

    public function getJenis()
    {
        $jenis = DB::table('jenis')->get();

        return response()->json([
            'code' => 200,
            'jenis' => $jenis
        ]);
    }

    public function getKategori()
    {
        $kategori_barang = DB::table('kategori_barang')->get();

        return response()->json([
            'code' => 200,
            'kategori_barang' => $kategori_barang
        ]);
    }

    public function getGolongan()
    {
        $golongan_barang = DB::table('golongan_barang')->get();

        return response()->json([
            'code' => 200,
            'golongan_barang' => $golongan_barang
        ]);
    }

    public function getGolongans2(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $dokter = DB::table('golongan_barang')
                ->get();
        } else {
            $dokter = DB::table('golongan_barang')
                ->where('nama', 'LIKE', '%' . $request->input('searchTerm') . '%')
                ->get();
        }

        $response = [];
        foreach ($dokter as $data) {
            $response[] = [
                "id" => $data->kode,
                "text" => $data->nama,
            ];
        }
        return response()->json($response);
    }


    public function getBangsal()
    {
        $bangsal = DB::table('bangsal')->where('status', '1')->get();

        return response()->json([
            'code' => 200,
            'bangsal' => $bangsal
        ]);
    }

    public function getSatuan()
    {
        $satuan_barang = DB::table('kodesatuan')->get();

        return response()->json([
            'code' => 200,
            'satuan_barang' => $satuan_barang
        ]);
    }

    public function getNoFaktur(Request $request)
    {
        $no = DB::table('pemesanan')
            ->select(DB::raw('ifnull(MAX(CONVERT(RIGHT(no_faktur,3),signed)),0) as no'))
            ->where('tgl_pesan', '=', $request->input('tgl_pesan'))
            ->first();
        $no_faktur = 'PBE' . date('Ymd', strtotime($request->input('tgl_pesan'))) . sprintf("%03s", ($no->no + 1));

        return response()->json([
            'code' => 200,
            'no_faktur' => $no_faktur
        ]);
    }

    public function getDokterAlls2(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $dokter = DB::table('dokter')
                ->select('kd_dokter', 'nm_dokter')
                ->where('status', '=', '1')
                ->get();
        } else {
            $dokter = DB::table('dokter')
                ->select('kd_dokter', 'nm_dokter')
                ->where('nm_dokter', 'LIKE', '%' . $request->input('searchTerm') . '%')
                ->where('status', '=', '1')
                ->get();
        }

        $response = [];
        foreach ($dokter as $data) {
            $response[] = [
                "id" => $data->kd_dokter,
                "text" => $data->nm_dokter,
            ];
        }
        return response()->json($response);
    }

    public function getDokterAll(Request $request)
    {
        $dokter = DB::table('dokter')
            ->select('kd_dokter', 'nm_dokter')
            ->where('status', '=', '1')
            ->get();

        return response()->json($dokter);
    }

    public function getDataobat(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $obat = DB::table('databarang as a')
                ->select(
                    'a.nama_brng',
                    'a.kode_brng',
                    'a.kapasitas',
                    'a.kode_sat',
                    'a.h_beli',
                    'a.utama',
                    DB::raw('SUM(c.stok) as jml_item'),

                )
                ->join('gudangbarang as c', 'a.kode_brng', '=', 'c.kode_brng')
                ->where('a.status', '=', '1')
                ->where('c.no_batch', '<>', '')
                ->where('c.no_faktur', '<>', '')
                ->where('c.kd_bangsal', '=', $request->input('kd_bangsal'))
                ->where('c.stok', '>', '0')
                ->groupBy('c.kode_brng')
                ->orderBy('a.nama_brng', 'desc')
                ->get();
        } else {
            $obat = DB::table('databarang as a')
                ->select(
                    'a.nama_brng',
                    'a.kode_brng',
                    'a.kapasitas',
                    'a.kode_sat',
                    'a.h_beli',
                    'a.utama',
                    DB::raw('SUM(c.stok) as jml_item'),
                )
                ->join('gudangbarang as c', 'a.kode_brng', '=', 'c.kode_brng')
                ->where('a.status', '=', '1')
                ->where('c.no_batch', '<>', '')
                ->where('c.no_faktur', '<>', '')
                ->where('c.kd_bangsal', '=', $request->input('kd_bangsal'))
                ->where('c.stok', '>', '0')
                ->where('a.nama_brng', 'LIKE', '%' . $request->input('searchTerm') . '%')
                ->groupBy('c.kode_brng')
                ->orderBy('a.nama_brng', 'desc')
                ->get();
        }
        $response = [];
        foreach ($obat as $data) {
            $response[] = [
                "id" => $data->kode_brng,
                "text" => $data->nama_brng,
                "kode_sat" => $data->kode_sat,
                "jml_item" => $data->jml_item,
                "h_beli" => $data->h_beli,
                "h_jual" => $data->utama,
            ];
        }
        return response()->json($response);
    }

    public function getaturanpakai(Request $request)
    {

        if (!$request->has('searchTerm')) {
            $dokter = DB::table('master_aturan_pakai')
                ->select(
                    'aturan',
                )
                ->get();
        } else {
            $dokter = DB::table('master_aturan_pakai')
                ->select(
                    'aturan',
                )
                ->where('aturan', 'LIKE', '%' . $request->input('searchTerm') . '%')

                ->get();
        }

        $response = [];
        foreach ($dokter as $data) {
            $response[] = [
                "id" => $data->aturan,
                "text" => $data->aturan,
            ];
        }
        return response()->json($response);
    }

    public function getstatusmenu(Request $request)
    {
        $retur = DB::table('tampreturjual')
            ->where('tanggal', date('Y-m-d'))
            ->groupBy('no_rawat')
            ->count();

        return response()->json([
            'code' => 200,
            'retur' => $retur,
        ]);
    }

    public function getDetailPenyerahanObat(Request $request)
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

        if (!$arraydata) {
            $resepManual = DB::table('databarang as a')
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
                    'd.*',
                )
                ->join('detail_pemberian_obat as b', 'a.kode_brng', '=', 'b.kode_brng')
                ->join('golongan_barang as c', 'a.kode_golongan', '=', 'c.kode')
                ->leftJoin('aturan_pakai as d', function ($join) {
                    $join->on('b.no_rawat', '=', 'd.no_rawat')
                        ->on('b.no_resep', '=', 'd.no_resep')
                        ->on('b.kode_brng', '=', 'd.kode_brng');
                })
                ->where('b.no_resep', $request->input('no_resep'))
                ->where('b.no_rawat', $request->input('no_rawat'))
                ->where('a.STATUS', '1')
                ->get();
        } else {
            $tambahanobat = DB::table('databarang as a')
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
                    'd.*',
                )
                ->join('detail_pemberian_obat as b', 'a.kode_brng', '=', 'b.kode_brng')
                ->join('golongan_barang as c', 'a.kode_golongan', '=', 'c.kode')
                ->leftJoin('aturan_pakai as d', function ($join) {
                    $join->on('b.no_rawat', '=', 'd.no_rawat')
                        ->on('b.no_resep', '=', 'd.no_resep')
                        ->on('b.kode_brng', '=', 'd.kode_brng');
                })
                ->leftJoin('resep_dokter as e', function ($join) {
                    $join->on('b.no_resep', '=', 'e.no_resep')
                        ->on('b.kode_brng', '=', 'e.kode_brng');
                })
                ->where('b.no_resep', $request->input('no_resep'))
                ->where('b.no_rawat', $request->input('no_rawat'))
                ->whereNull('e.kode_brng')
                ->where('a.STATUS', '1')
                ->get();
        }

        $pasien = DB::table('reg_periksa as a')
            ->select(
                'a.no_rawat',
                'a.almt_pj',
                'a.kd_poli',
                'b.no_rkm_medis',
                'b.nm_pasien',
                'b.tgl_lahir',
                'b.no_tlp',
                'b.umur',
                'c.png_jawab',
            )
            ->join('pasien as b', 'a.no_rkm_medis', '=', 'b.no_rkm_medis')
            ->join('penjab as c', 'a.kd_pj', '=', 'c.kd_pj')
            ->where('a.no_rawat', $request->input('no_rawat'))
            ->first();

        $alergi_pasien = DB::table('alergi_pasien as a')
            ->where('a.no_rawat', $request->input('no_rawat'))
            ->first();

        $diagnosa = DB::table('diagnosa_pasien_rajal as a')
            ->where('a.no_rawat', $request->input('no_rawat'))
            ->orderBy('a.id', 'DESC')
            ->first();

        $penyerahan = DB::table('data_penyerahan_obat as a')
            ->where('a.no_rawat', $request->input('no_rawat'))
            ->where('a.no_resep', $request->input('no_resep'))
            ->first();

        return response()->json([
            'code' => 200,
            'list_obat' => $arraydata,
            'list_obat_racik' => $arrdataObatRacik,
            'list_obat_maual' => $resepManual ?? [],
            'tambahanobat' => $tambahanobat ?? [],
            'pasien' => $pasien,
            'alergi_pasien' => $alergi_pasien,
            'diagnosa' => $diagnosa,
            'penyerahan' => $penyerahan,
            'no_resep' => $request->input('no_resep')
        ]);
    }

    public function getDataPemberianObat(Request $request)
    {
        $list_obat = DB::table('databarang as a')
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
            ->join('detail_pemberian_obat as b', 'a.kode_brng', '=', 'b.kode_brng')
            ->join('golongan_barang as c', 'a.kode_golongan', '=', 'c.kode')
            ->where('b.no_rawat', $request->input('no_rawat'))
            ->where('a.STATUS', '1')
            ->get();

        return response()->json([
            'code' => 200,
            'no_rawat' => $request->input('no_rawat'),
            'data_pemberian_obat' => $list_obat,
        ]);
    }

    public function catatRiwayat(Request $request)
    {
        $save = DB::table('detailpesan as a')
            ->insert([
                'kode_brng' => $request->input('jumlah'),
                'no_batch' => $request->input('h_pesan'),
                'no_faktur' => $request->input('h_pesan'),

                'stok_awal' => $request->input('jumlah'),
                'masuk' => $request->input('kadaluarsa'),
                'keluar' => $request->input('kadaluarsa'),
                'stok_akhir' => $request->input('kadaluarsa'),

                'posisi' => $request->input('h_pesan'),
                'kd_bangsal' => $request->input('h_pesan'),
                'status' => $request->input('h_pesan'),

                'tanggal' => $request->input('total'),
                'jam' => $request->input('total'),
                'petugas' => $request->input('total'),
            ]);
    }


    public function getPemeriksaanLab(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $lab = DB::table('jns_perawatan_lab as a')
                ->select(
                    'a.kd_jenis_prw',
                    'a.nm_perawatan',
                    'a.total_byr',
                )
                ->where('a.status', '=', '1')
                ->orderBy('a.kd_jenis_prw')
                ->get();
        } else {
            $lab = DB::table('jns_perawatan_lab as a')
                ->select(
                    'a.kd_jenis_prw',
                    'a.nm_perawatan',
                    'a.total_byr',
                )
                ->where('a.status', '=', '1')
                ->where('a.nm_perawatan', 'LIKE', '%' . $request->input('searchTerm') . '%')
                ->orderBy('a.kd_jenis_prw')
                ->get();
        }
        return response()->json([
            "code" => 200,
            "data" => $lab
        ]);
    }

    public function getPemeriksaans2(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $dokter = DB::table('jns_perawatan_lab')
                ->where('status', '=', '1')
                ->get();
        } else {
            $dokter = DB::table('jns_perawatan_lab')
                ->where('nm_perawatan', 'LIKE', '%' . $request->input('searchTerm') . '%')
                ->where('status', '=', '1')
                ->get();
        }

        $response = [];
        foreach ($dokter as $data) {
            $response[] = [
                "id" => $data->kd_jenis_prw,
                "text" => $data->nm_perawatan,
            ];
        }
        return response()->json($response);
    }

    public function getItemPemeriksaanLab(Request $request)
    {

        if ($request->pemeriksaan) {
            if (count($request->pemeriksaan) > 0) {
                $arrdataLab = array();
                foreach ($request->pemeriksaan as $index => $data) {

                    $dataPemeriksaan = DB::table('jns_perawatan_lab as a')
                        ->select(
                            'a.nm_perawatan',
                            'a.kd_jenis_prw',
                            'a.total_byr',
                        )
                        ->where('a.kd_jenis_prw', '=', $data)
                        ->first();

                    $dataItemPemeriksaan = DB::table('template_laboratorium as a')
                        ->select(
                            'a.kd_jenis_prw',
                            'a.id_template',
                            'a.Pemeriksaan',
                            'a.satuan',
                            'a.nilai_rujukan_ld as nilai_rujukan',
                        )
                        ->where('a.kd_jenis_prw', '=', $data)
                        ->orderBy('a.urut')
                        ->get();

                    array_push(
                        $arrdataLab,
                        array(
                            'kd_jenis_prw' => $dataPemeriksaan->kd_jenis_prw,
                            'nm_perawatan' => $dataPemeriksaan->nm_perawatan,
                            'total_byr' => $dataPemeriksaan->total_byr,
                            'detilpemeriksaan' => $dataItemPemeriksaan,
                        )

                    );
                }

                return response()->json([
                    'status' => '200',
                    'periksa' => $arrdataLab,
                ]);
            } else {
                return response()->json([
                    'status' => '400'
                ]);
            }
        } else {
            return response()->json([
                'status' => '400'
            ]);
        }
    }

    public function getItemPemeriksaanLab2(Request $request)
    {
        $data = DB::table('template_laboratorium as a')
            ->select(
                'a.kd_jenis_prw',
                'a.id_template',
                'a.Pemeriksaan',
            )
            ->where('a.kd_jenis_prw', '=', $request->kd_jenis_prw)
            ->orderBy('a.urut')
            ->get();

        if ($data) {
            return response()->json([
                'status' => '200',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => '404',
            ]);
        }
    }

    public function getDetailResult(Request $request)
    {
        $nolab = $request->nolab;
        $no_rawat = $request->no_rawat;
        $result = DB::table('periksa_lab as a')
            ->select(
                'a.no_rawat',
                'a.kd_jenis_prw',
                'a.tgl_periksa',
                'a.jam',
                'b.nm_perawatan'
            )
            ->join('jns_perawatan_lab as b', 'a.kd_jenis_prw', '=', 'b.kd_jenis_prw')
            ->where('a.nolab', $nolab)
            ->where('a.no_rawat', $no_rawat)
            ->get();

        $arrresult = array();
        if ($result) {
            foreach ($result as $data) {
                array_push($arrresult, array(
                    "pemeriksaan" => $data->nm_perawatan,
                    "nilai" => '',
                    "satuan" => '',
                    "nilai_rujukan" => '',
                    "keterangan" => '',
                    "enable_duplo_checkbox" => false
                ));

                $resultDetail = DB::table('detail_periksa_lab as a')
                    ->select(
                        'b.Pemeriksaan',
                        'a.nilai',
                        'a.satuan',
                        'a.biaya_item',
                        'a.keterangan',
                        'a.kd_jenis_prw',
                        'a.id_template',
                        'a.nilai_rujukan'
                    )
                    ->join('template_laboratorium as b', 'a.id_template', '=', 'b.id_template')
                    ->where('a.no_rawat', $data->no_rawat)
                    ->where('a.tgl_periksa', $data->tgl_periksa)
                    ->where('a.jam', $data->jam)
                    ->where('a.kd_jenis_prw', $data->kd_jenis_prw)
                    ->get();

                foreach ($resultDetail as $dataDetail) {
                    array_push($arrresult, array(
                        "pemeriksaan" => $dataDetail->Pemeriksaan,
                        "kd_jenis_prw" => $dataDetail->kd_jenis_prw,
                        "id_template" => $dataDetail->id_template,
                        "nilai" => $dataDetail->nilai,
                        "satuan" => $dataDetail->satuan,
                        "nilai_rujukan" => $dataDetail->nilai_rujukan,
                        "keterangan" => $dataDetail->keterangan,
                        "enable_duplo_checkbox" => stripos($dataDetail->keterangan, "duplo") !== false
                    ));
                }
            }

            $validasi = DB::table('data_det_validasi_hasil_lab')
                ->where('nolab', $nolab)
                // ->where('no_rawat', $no_rawat)
                ->first();

            return response()->json([
                "status" => "200",
                "message" => "success",
                "data" => $arrresult,
                "nolab" => $request->nolab,
                "no_rawat" => $request->no_rawat,
                "validasi" => $validasi
            ]);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Failed",
            ]);
        }
    }

    public function getGDT(Request $request)
    {
        $noLab = DB::table('data_gambaran_darah_tepi')
            ->where('no_rawat', $request->no_rawat)
            ->where('nolab', $request->nolab)
            ->first();

        if ($noLab) {
            # code...
            return response()->json([
                "status" => "200",
                "data" => $noLab
            ]);
        } else {
            return response()->json([
                "status" => "404",
            ]);
        }
    }
}
