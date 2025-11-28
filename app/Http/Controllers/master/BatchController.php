<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class BatchController extends BaseController
{
    public function index()
    {
        return view('farmasi.master.batch', [
            "menu" => 'master',
            "submenu" => 'batch',
        ]);
    }

    public function getDataBarang(Request $request)
    {

        if ($request->input('kd_bangsal') == '-') {

            $barang = DB::table('data_batch as a')
                ->select(
                    'a.*',
                    'b.nama_brng',
                    'b.utama as harga_jual',
                    'b.dasar as harga_beli',
                    'b.nama_brng',
                    'c.stok',
                    'c.kd_bangsal',
                    'd.nm_bangsal',
                )
                ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                ->Join('gudangbarang as c', function ($join) {
                    $join->on('a.kode_brng', '=', 'c.kode_brng')
                        ->On('a.no_batch', '=', 'c.no_batch')
                        ->On('a.no_faktur', '=', 'c.no_faktur');
                })
                ->join('bangsal as d', 'c.kd_bangsal', '=', 'd.kd_bangsal')
                ->where(function ($query) {
                    $query->where('c.kd_bangsal', 'A1')
                        ->orWhere('c.kd_bangsal', 'GO');
                })
                // ->where('c.kd_bangsal', $request->input('kd_bangsal'))
                ->where('c.stok', '>', 0)
                ->get();
        } else {
            $barang = DB::table('data_batch as a')
                ->select(
                    'a.*',
                    'b.nama_brng',
                    'b.utama as harga_jual',
                    'b.dasar as harga_beli',
                    'b.nama_brng',
                    'c.stok',
                    'c.kd_bangsal',
                    'd.nm_bangsal',
                )
                ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                ->Join('gudangbarang as c', function ($join) {
                    $join->on('a.kode_brng', '=', 'c.kode_brng')
                        ->On('a.no_batch', '=', 'c.no_batch')
                        ->On('a.no_faktur', '=', 'c.no_faktur');
                })
                ->join('bangsal as d', 'c.kd_bangsal', '=', 'd.kd_bangsal')
                // ->where(function ($query) {
                //     $query->where('c.kd_bangsal', 'A1')
                //         ->orWhere('c.kd_bangsal', 'GO');
                // })
                ->where('c.kd_bangsal', $request->input('kd_bangsal'))
                ->where('c.stok', '>', 0)
                ->get();
        }

        if ($request->input('kd_bangsal') == '-') {

            $barangkosong = DB::table('data_batch as a')
                ->select(
                    'a.*',
                    'b.nama_brng',
                    'b.utama as harga_jual',
                    'b.dasar as harga_beli',
                    'b.nama_brng',
                    'c.stok',
                    'c.kd_bangsal',
                    'd.nm_bangsal',
                )
                ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                ->Join('gudangbarang as c', function ($join) {
                    $join->on('a.kode_brng', '=', 'c.kode_brng')
                        ->On('a.no_batch', '=', 'c.no_batch')
                        ->On('a.no_faktur', '=', 'c.no_faktur');
                })
                ->join('bangsal as d', 'c.kd_bangsal', '=', 'd.kd_bangsal')
                ->where(function ($query) {
                    $query->where('c.kd_bangsal', 'A1')
                        ->orWhere('c.kd_bangsal', 'GO');
                })
                // ->where('c.kd_bangsal', $request->input('kd_bangsal'))
                ->where('c.stok', '<=', 0)
                ->get();
        } else {
            $barangkosong = DB::table('data_batch as a')
                ->select(
                    'a.*',
                    'b.nama_brng',
                    'b.utama as harga_jual',
                    'b.dasar as harga_beli',
                    'b.nama_brng',
                    'c.stok',
                    'c.kd_bangsal',
                    'd.nm_bangsal',
                )
                ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                ->Join('gudangbarang as c', function ($join) {
                    $join->on('a.kode_brng', '=', 'c.kode_brng')
                        ->On('a.no_batch', '=', 'c.no_batch')
                        ->On('a.no_faktur', '=', 'c.no_faktur');
                })
                ->join('bangsal as d', 'c.kd_bangsal', '=', 'd.kd_bangsal')
                // ->where(function ($query) {
                //     $query->where('c.kd_bangsal', 'A1')
                //         ->orWhere('c.kd_bangsal', 'GO');
                // })
                ->where('c.kd_bangsal', $request->input('kd_bangsal'))
                ->where('c.stok', '<=', 0)
                ->get();
        }

        echo json_encode(
            array(
                'code' => 200,
                'databarang' => $barang,
                'databarangkosong' => $barangkosong
            )
        );
    }

    public function getHistoryopname(Request $request)
    {
        $barang = DB::table('opname as a')
            ->select(
                'a.*',
                'b.nama_brng',
                'c.nm_bangsal',
            )
            ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
            ->join('bangsal as c', 'a.kd_bangsal', '=', 'c.kd_bangsal')
            ->whereBetween('a.tanggal', [$request->input('from'), $request->input('to')])
            ->get();

        echo json_encode(
            array(
                'code' => 200,
                'databarang' => $barang
            )
        );
    }


    public function postStokOpname(Request $request)
    {
        DB::beginTransaction();
        try {

            if ((int) $request->input('selisih') < 0) {
                $save = DB::table('opname')
                    ->insert([
                        'kode_brng' => $request->input('kode_brng'),
                        'h_beli' => $request->input('h_beli'),
                        'tanggal' => $request->input('tanggal'),
                        'stok' => $request->input('stok'),
                        'real' => $request->input('real'),

                        'selisih' => $request->input('selisih'),
                        'nomihilang' => $request->input('nominal'),

                        'lebih' => 0,
                        'nomilebih' => 0,

                        'keterangan' => $request->input('keterangan') ?? '-',
                        'kd_bangsal' => $request->input('kd_bangsal'),
                        'no_batch' => $request->input('no_batch'),
                        'no_faktur' => $request->input('no_faktur'),
                    ]);

            } else {
                $save = DB::table('opname')
                    ->insert([
                        'kode_brng' => $request->input('kode_brng'),
                        'h_beli' => $request->input('h_beli'),
                        'tanggal' => $request->input('tanggal'),
                        'stok' => $request->input('stok'),
                        'real' => $request->input('real'),

                        'selisih' => 0,
                        'nomihilang' => 0,

                        'lebih' => $request->input('selisih'),
                        'nomilebih' => $request->input('nominal'),

                        'keterangan' => $request->input('keterangan') ?? '-',
                        'kd_bangsal' => $request->input('kd_bangsal'),
                        'no_batch' => $request->input('no_batch'),
                        'no_faktur' => $request->input('no_faktur'),
                    ]);
            }

            if ($save) {

                $save = DB::table('gudangbarang as a')
                    ->where('a.kode_brng', $request->input('kode_brng'))
                    ->where('a.kd_bangsal', $request->input('kd_bangsal'))
                    ->where('a.no_batch', $request->input('no_batch'))
                    ->where('a.no_faktur', $request->input('no_faktur'))
                    ->update([
                        'stok' => $request->input('real')
                    ]);

                $save = DB::table('data_batch as a')
                    ->where('a.kode_brng', $request->input('kode_brng'))
                    ->where('a.no_batch', $request->input('no_batch'))
                    ->where('a.no_faktur', $request->input('no_faktur'))
                    ->update([
                        'tgl_kadaluarsa' => $request->input('tgl_kadaluarsa'),
                        'sisa' => $request->input('real')
                    ]);

                $gudangbarang = DB::table('gudangbarang as a')
                    ->select(
                        DB::raw('ifnull(SUM(a.stok),0) as stok'),
                    )
                    ->where('a.kode_brng', $request->input('kode_brng'))
                    ->where('a.kd_bangsal', $request->input('kd_bangsal'))
                    // ->where('a.no_batch', $data->no_batch)
                    // ->where('a.no_faktur', $data->no_faktur)
                    ->first();

                if ($gudangbarang) {
                    //catat
                    DB::table('kartu_persediaan_obat')->insert([
                        'tanggal' => date('Y-m-d'),
                        'jam' => date('H:i:s'),

                        'kode_brng' => $request->kode_brng,
                        'kd_bangsal' => $request->kd_bangsal,

                        'status' => 1,
                        'keterangan_status' => 'Stok Opname',

                        'sisa' =>  ((int)$gudangbarang->stok == 0 ? $request->real : $gudangbarang->stok),
                        'opname' => $request->real,

                        'no_batch' => $request->input('no_batch'),
                        'no_faktur' => $request->input('no_faktur'),

                        'tgl_kadaluarsa' => $request->input('tgl_kadaluarsa'),
                        'keterangan' => $request->keterangan ?? '-',
                    ]);
                }



            }
            DB::commit();
            return response()->json(
                array(
                    'code' => 200,
                )
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'code' => 201,
                'error' => $th,
            ]);
        }
    }
}
