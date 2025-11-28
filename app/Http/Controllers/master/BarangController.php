<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class BarangController extends BaseController
{
    public function index()
    {

        $penjualan = DB::table('setpenjualanumum as a')
            ->first();

        return view('farmasi.master.barang', [
            "penjualan" => $penjualan->utama,
            "menu" => 'master',
            "submenu" => 'barang',
        ]);
    }

    public function getDataBarang(Request $request)
    {
        if ($request->input('kd_bangsal') == '-') {
            $barang = DB::table('databarang as a')
                ->select(
                    'a.*',
                    DB::raw('ifnull(SUM(b.stok),0) as stok'),
                )
                ->leftJoin('gudangbarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                // ->Join('data_batch as c', function ($join) {
                //     $join->on('b.kode_brng', '=', 'c.kode_brng')
                //         ->On('b.no_batch', '=', 'c.no_batch')
                //         ->On('b.no_faktur', '=', 'c.no_faktur');
                // })
                //  ->where('a.status','1')
                //  ->where('b.stok', '>', 0)
                // ->where('b.kd_bangsal', 'A1')
                // ->orWhere('b.kd_bangsal', 'GO')
                ->groupBy('a.kode_brng')
                ->get();
        } else {
            $barang = DB::table('databarang as a')
                ->select(
                    'a.*',
                    DB::raw('SUM(b.stok) as stok'),
                )
                ->join('gudangbarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                // ->Join('data_batch as c', function ($join) {
                //     $join->on('b.kode_brng', '=', 'c.kode_brng')
                //         ->On('b.no_batch', '=', 'c.no_batch')
                //         ->On('b.no_faktur', '=', 'c.no_faktur');
                // })
                // ->where('a.status','1')
                //  ->where('b.stok', '>', 0)
                ->where('b.kd_bangsal', $request->input('kd_bangsal'))
                ->groupBy('b.kode_brng')
                ->get();
        }

        if (!$barang->isEmpty()) {
            echo json_encode(
                array(
                    'code' => 200,
                    'databarang' => $barang,
                    'kd_bangsal' => $request->input('kd_bangsal'),
                )
            );
        }
    }

    public function getkdbarang()
    {
        $kode_barang = DB::table('databarang')
            ->select(
                DB::raw('ifnull(MAX(CONVERT(RIGHT(kode_brng,4),signed)),0) as no'),
            )
            ->first();
        $kode_barang = 'B' . sprintf("%09s", ($kode_barang->no + 1));

        echo json_encode(
            array(
                'code' => 200,
                'kode_barang' => $kode_barang
            )
        );
    }

    public function historyBarang(Request $request)
    {
        $data = DB::table('kartu_persediaan_obat')
            ->where('kode_brng', '=', $request->input('kode_brng'))
            ->where('kd_bangsal', '=', $request->input('kd_bangsal'))
            ->orderBy('id')
            ->get();


        if (!$data->isEmpty()) {
            echo json_encode(
                array(
                    'code' => 200,
                    'data' => $data
                )
            );
        } else {
            echo json_encode(
                array(
                    'code' => 201,
                    'request' => $request->input()
                )
            );
        }

    }

    public function postBarang(Request $request)
    {
        $save = DB::table('databarang')
            ->insert([
                'kode_brng' => $request->input('kode_brng'),
                'nama_brng' => $request->input('nama_brng'),

                'kode_sat' => $request->input('satuan'),
                'kode_satbesar' => $request->input('satuan'),
                'kandungan' => $request->input('kandungan'),

                'dasar' => $request->input('h_beli'),
                'h_beli' => $request->input('h_beli'),

                'ralan' => $request->input('h_jual'),
                'kelas1' => $request->input('h_jual'),
                'kelas2' => $request->input('h_jual'),
                'kelas3' => $request->input('h_jual'),
                'utama' => $request->input('h_jual'),
                'vip' => $request->input('h_jual'),
                'vvip' => $request->input('h_jual'),
                'beliluar' => $request->input('h_jual'),
                'jualbebas' => $request->input('h_jual'),
                'karyawan' => $request->input('h_jual'),

                'stokminimal' => $request->input('stokminimal'),
                'batas_beri' => $request->input('batas_beri'),

                'kdjns' => $request->input('kdjns'),
                'kode_industri' => '-',
                'kode_kategori' => $request->input('kode_kategori'),
                'kode_golongan' => $request->input('kode_golongan'),

                'multidose' => $request->input('multidose'),
                'dosis' => $request->input('dosis'),
                'dosis_ml' => $request->input('dosis_ml'),
                'dosis_mg' => $request->input('dosis_mg'),
                'satuan_dosis' => $request->input('satuan_dosis'),

                'high_alert' => $request->input('high_alert'),

                'isi' => 0,
                'kapasitas' => 0,
                'expire' => date('Y-m-d'),

                'status' => '1',

            ]);

        if ($save) {
            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        } else {
            echo json_encode(
                array(
                    'code' => 201,
                )
            );
        }
    }

    public function updateBarang(Request $request)
    {
        $save = DB::table('databarang')
            ->where('kode_brng', $request->input('kode_brng'))
            ->update([
                'nama_brng' => $request->input('nama_brng'),

                'kode_sat' => $request->input('satuan'),
                'kode_satbesar' => $request->input('satuan'),
                'kandungan' => $request->input('kandungan'),

                'dasar' => $request->input('h_beli'),
                'h_beli' => $request->input('h_beli'),

                'ralan' => $request->input('h_jual'),
                'kelas1' => $request->input('h_jual'),
                'kelas2' => $request->input('h_jual'),
                'kelas3' => $request->input('h_jual'),
                'utama' => $request->input('h_jual'),
                'vip' => $request->input('h_jual'),
                'vvip' => $request->input('h_jual'),
                'beliluar' => $request->input('h_jual'),
                'jualbebas' => $request->input('h_jual'),
                'karyawan' => $request->input('h_jual'),

                'stokminimal' => $request->input('stokminimal'),
                'batas_beri' => $request->input('batas_beri'),

                'kdjns' => $request->input('kdjns'),
                'kode_industri' => '-',
                'kode_kategori' => $request->input('kode_kategori'),
                'kode_golongan' => $request->input('kode_golongan'),

                'multidose' => $request->input('multidose'),
                'dosis' => $request->input('dosis'),
                'dosis_ml' => $request->input('dosis_ml'),
                'dosis_mg' => $request->input('dosis_mg'),
                'satuan_dosis' => $request->input('satuan_dosis'),

                'high_alert' => $request->input('high_alert'),
            ]);

        if ($save) {
            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        } else {
            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        }
    }

    public function nonaktifbarang(Request $request)
    {
        $save = DB::table('databarang')
            ->where('kode_brng', $request->input('kode_brng'))
            ->update([
                'status' => 0
            ]);

        if ($save) {
            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        } else {
            echo json_encode(
                array(
                    'code' => 200,
                )
            );
        }
    }
}
