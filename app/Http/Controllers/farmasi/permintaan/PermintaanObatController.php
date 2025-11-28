<?php

namespace App\Http\Controllers\farmasi\permintaan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PermintaanObatController extends BaseController
{
    public function index()
    {
        $ppn = DB::table('set_ppn as a')
            ->first();
        $penjualan = DB::table('setpenjualanumum as a')
            ->first();

        return view(
            'farmasi.permintaan.permintaan',
            [
                "ppn" => $ppn->ppn,
                "penjualan" => $penjualan->utama,
                "menu" => "permintaan",
            ]
        );
    }

    public function getpermintaanobat(Request $request)
    {
        $arraydata = array();
        $datapermintaan = DB::table('permintaan_mutasi_obat as a')
            ->select(
                'a.*',
                'b.nm_bangsal as nmdari',
                'c.nm_bangsal as nmtujuan',
                'd.nama',
            )
            ->join('bangsal as b', 'a.dari', '=', 'b.kd_bangsal')
            ->join('bangsal as c', 'a.tujuan', '=', 'c.kd_bangsal')
            ->join('pegawai as d', 'a.user', '=', 'd.nik')
            ->whereBetween('a.tgl_permintaan', [$request->input('from'), $request->input('to')])
            ->get();

        foreach ($datapermintaan as $data) {
            array_push(
                $arraydata,
                array(
                    'id' => $data->id,
                    'tgl_permintaan' => $data->tgl_permintaan,
                    'dari' => $data->dari,
                    'nmdari' => $data->nmdari,
                    'tujuan' => $data->tujuan,
                    'nmtujuan' => $data->nmtujuan,
                    'keterangan' => $data->keterangan,
                    'nama' => $data->nama,
                    'user' => $data->user,
                    'status' => $data->status,
                    'list_obat' => unserialize($data->list_obat),
                )
            );
        }
        if (!$datapermintaan->isEmpty()) {
            echo json_encode(array(
                'code' => 200,
                'permintaan' => $arraydata,
            ));
        } else {
            echo json_encode(array(
                'code' => 404,
            ));
        }
    }

    public function getitempermintaanobat(Request $request)
    {
        $data = DB::table('permintaan_mutasi_obat as a')
            ->select(
                'a.list_obat',
            )
            ->where('a.id', $request->input('id'))
            ->first();
        if ($data) {
            echo json_encode(array(
                'code' => 200,
                'list_obat' => unserialize($data->list_obat),
            ));
        } else {
            echo json_encode(array(
                'code' => 404,
            ));
        }
    }


    public function getmutasiBarang(Request $request)
    {
        $data = DB::table('mutasibarang as a')
            ->select(
                'a.*',
                'b.nm_bangsal as dari',
                'c.nm_bangsal as tujuan',
                'd.nama_brng',
            )
            ->join('bangsal as b', 'a.kd_bangsaldari', '=', 'b.kd_bangsal')
            ->join('bangsal as c', 'a.kd_bangsalke', '=', 'c.kd_bangsal')
            ->join('databarang as d', 'a.kode_brng', '=', 'd.kode_brng')
            ->whereBetween('a.tanggal', [$request->input('from') . ' 00:00:00', $request->input('to') . ' 23:59:59'])
            ->get();

        if (!$data->isEmpty()) {
            echo json_encode(array(
                'code' => 200,
                'barang_mutasi' => $data,
            ));
        } else {
            echo json_encode(array(
                'code' => 404,
            ));
        }
    }

    public function getDataobat(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $obat = DB::table('databarang as a')
                ->select(
                    'a.*',
                    'b.*',
                    DB::raw('sum(b.stok) as stok_total'),
                )
                ->join('gudangbarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                // ->where('b.kd_bangsal', '=', 'GO')
                ->where('b.kd_bangsal', '=', $request->input('dari'))
                ->where('b.stok', '>', 0)
                //  ->where('a.status','1')
                ->groupBy('a.kode_brng')
                ->get();
        } else {
            $obat = DB::table('databarang as a')
                ->select(
                    'a.*',
                    'b.*',
                    DB::raw('sum(b.stok) as stok_total'),
                )
                ->join('gudangbarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                ->where('a.nama_brng', 'LIKE', '%' . $request->input('searchTerm') . '%')
                // ->where('b.kd_bangsal', '=', 'GO')
                ->where('b.kd_bangsal', '=', $request->input('dari'))
                ->where('b.stok', '>', 0)
                //  ->where('a.status','1')
                ->groupBy('a.kode_brng')
                ->get();
        }

        $response = array();
        foreach ($obat as $data) {
            $response[] = array(
                "id" => $data->kode_brng, //for value
                "text" => $data->nama_brng . '  (Stok: ' . $data->stok_total . ')',
                "obat" => $data,
            );
        }
        echo json_encode($response);
    }

    public function getDetailbarang(Request $request)
    {
        $stokasal = DB::table('gudangbarang as a')
            ->select(
                DB::raw('SUM(a.stok) as stok'),
            )
            ->where('a.kode_brng', $request->input('kode_brng'))
            ->where('a.kd_bangsal', $request->input('dari'))
            ->groupBy('a.kode_brng')
            ->first();

        $stoktujuan = DB::table('gudangbarang as a')
            ->select(
                DB::raw('SUM(a.stok) as stok'),
            )
            ->where('a.kode_brng', $request->input('kode_brng'))
            ->where('a.kd_bangsal', $request->input('tujuan'))
            ->groupBy('a.kode_brng')
            ->first();


        echo json_encode(
            array(
                'code' => 200,
                'stokasal' => $stokasal->stok ?? 0,
                'stoktujuan' => $stoktujuan->stok ?? 0,
            )
        );
    }

    public function postPermintaan(Request $request)
    {
        $save = DB::table('permintaan_mutasi_obat')
            ->insert([
                'tgl_permintaan' => $request->input('tgl_permintaan'),
                'dari' => $request->input('dari'),
                'tujuan' => $request->input('tujuan'),
                'keterangan' => $request->input('keterangan'),
                'list_obat' => serialize($request->input('list_obat')),
                'user' => $request->session()->get('user')['id_user'],
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
                    'code' => 500,
                )
            );
        }
    }

    public function postValidasiPermintaan(Request $request)
    {

        $arraybatch = array();
        $save = false;
        $listitem = $request->input('list_obat');
        DB::beginTransaction();
        try {
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
                    ->where('a.kode_brng', $listitem[$i][0])
                    ->where('c.kd_bangsal', $request->input('kd_bangsaldari'))
                    ->orderBy('a.tgl_kadaluarsa')
                    ->orderBy('a.tgl_beli')
                    ->where('c.stok', '>', 0)
                    ->get();

                $hasilkurang = 0;
                $sisa = 0;
                $index = 0;
                foreach ($barang as $data) {
                    if ($hasilkurang == 0) {
                        $hasilkurang = (int) $data->stok - (int) $listitem[$i][4];
                        $sisa = abs($hasilkurang);
                        $save = DB::table('mutasibarang')
                            ->insert([
                                'kode_brng' => $listitem[$i][0],
                                'jml' => ($hasilkurang >= 0 ? $listitem[$i][4] : (int) $listitem[$i][4] - $sisa),
                                'harga' => $data->harga,
                                'kd_bangsaldari' => $request->input('kd_bangsaldari'),
                                'kd_bangsalke' => $request->input('kd_bangsalke'),
                                'tanggal' => $request->input('tanggal') . ' ' . date('H:i:s'),
                                'keterangan' => $request->input('keterangan') ?? '-',
                                'tgl_kadaluarsa' => $data->tgl_kadaluarsa,
                                'no_batch' => $data->no_batch,
                                'no_faktur' => $data->no_faktur,
                            ]);


                        // save stok
                        $stokgudang = DB::table('gudangbarang as a')
                            ->where('a.kode_brng', $listitem[$i][0])
                            ->where('a.kd_bangsal', $request->input('kd_bangsalke'))
                            ->where('a.no_batch', $data->no_batch)
                            ->where('a.no_faktur', $data->no_faktur)
                            ->first();

                        //update jika ada simpan jike belum ada
                        if ($stokgudang) {
                            $save = DB::table('gudangbarang as a')
                                ->where('a.kode_brng', $listitem[$i][0])
                                ->where('a.kd_bangsal', $request->input('kd_bangsalke'))
                                ->where('a.no_batch', $data->no_batch)
                                ->where('a.no_faktur', $data->no_faktur)
                                ->update([
                                    'stok' => (int) $stokgudang->stok + ($hasilkurang >= 0 ? (int) $listitem[$i][4] : (int) $listitem[$i][4] - $sisa),
                                ]);
                        } else {
                            $save = DB::table('gudangbarang')
                                ->insert([
                                    'kode_brng' => $listitem[$i][0],
                                    'kd_bangsal' => $request->input('kd_bangsalke'),
                                    'stok' => ($hasilkurang >= 0 ? $listitem[$i][4] : (int) $listitem[$i][4] - $sisa),
                                    'no_batch' => $data->no_batch,
                                    'no_faktur' => $data->no_faktur
                                ]);
                        }

                        // update stok asal
                        $save = DB::table('gudangbarang as a')
                            ->where('a.kode_brng', $listitem[$i][0])
                            ->where('a.kd_bangsal', $request->input('kd_bangsaldari'))
                            ->where('a.no_batch', $data->no_batch)
                            ->where('a.no_faktur', $data->no_faktur)
                            ->update([
                                'stok' => ($hasilkurang <= 0 ? 0 : $hasilkurang)
                            ]);

                        $gudangbarang = DB::table('gudangbarang as a')
                            ->select(
                                DB::raw('ifnull(SUM(a.stok),0) as stok'),
                            )
                            ->where('a.kode_brng', $listitem[$i][0])
                            ->where('a.kd_bangsal', $request->input('kd_bangsaldari'))
                            // ->where('a.no_batch', $data->no_batch)
                            // ->where('a.no_faktur', $data->no_faktur)
                            ->first();

                        if ($gudangbarang) {
                            //catat
                            DB::table('kartu_persediaan_obat')->insert([
                                'tanggal' => date('Y-m-d'),
                                'jam' => date('H:i:s'),

                                'kode_brng' => $listitem[$i][0],
                                'kd_bangsal' => $request->kd_bangsaldari,

                                'masuk' => 0,
                                'jenis_masuk' => '',
                                'unit_masuk' => 0,
                                'harga_masuk' => 0,
                                'jumlah' => 0,

                                'keluar' => 1,
                                'jenis_keluar' => 'Mutasi',
                                'unit_keluar' => ($hasilkurang >= 0 ? $listitem[$i][4] : (int) $listitem[$i][4] - $sisa),

                                'status' => 3,
                                'keterangan_status' => 'Mutasi',

                                'sisa' => $gudangbarang->stok,
                                'opname' => 0,

                                'no_batch' => $data->no_batch,
                                'no_faktur' => $data->no_faktur,
                                'tgl_kadaluarsa' => $data->tgl_kadaluarsa,

                                'keterangan' => $request->input('keterangan') ?? '-',
                            ]);
                        }


                    } else {
                        $sisa = abs($hasilkurang);
                        $hasilkurang = (int) $data->stok - (int) $sisa;
                        $save = DB::table('mutasibarang')
                            ->insert([
                                'kode_brng' => $listitem[$i][0],
                                'jml' => $sisa,
                                'harga' => $data->harga,
                                'kd_bangsaldari' => $request->input('kd_bangsaldari'),
                                'kd_bangsalke' => $request->input('kd_bangsalke'),
                                'tanggal' => $request->input('tanggal') . ' ' . date('H:i:s'),
                                'keterangan' => $request->input('keterangan') ?? '-',
                                'tgl_kadaluarsa' => $data->tgl_kadaluarsa,
                                'no_batch' => $data->no_batch,
                                'no_faktur' => $data->no_faktur,
                            ]);

                        // save stok
                        $stokgudang = DB::table('gudangbarang as a')
                            ->where('a.kode_brng', $listitem[$i][0])
                            ->where('a.kd_bangsal', $request->input('kd_bangsalke'))
                            ->where('a.no_batch', $data->no_batch)
                            ->where('a.no_faktur', $data->no_faktur)
                            ->first();

                        //update jika ada simpan jike belum ada
                        if ($stokgudang) {
                            $save = DB::table('gudangbarang as a')
                                ->where('a.kode_brng', $listitem[$i][0])
                                ->where('a.kd_bangsal', $request->input('kd_bangsalke'))
                                ->where('a.no_batch', $data->no_batch)
                                ->where('a.no_faktur', $data->no_faktur)
                                ->update([
                                    'stok' => (int) $stokgudang->stok + ($hasilkurang >= 0 ? (int) $listitem[$i][4] : (int) $listitem[$i][4] - $sisa),
                                ]);
                        } else {
                            $save = DB::table('gudangbarang')
                                ->insert([
                                    'kode_brng' => $listitem[$i][0],
                                    'kd_bangsal' => $request->input('kd_bangsalke'),
                                    'stok' => $sisa,
                                    'no_batch' => $data->no_batch,
                                    'no_faktur' => $data->no_faktur
                                ]);
                        }

                        // update stok asal
                        $save = DB::table('gudangbarang as a')
                            ->where('a.kode_brng', $listitem[$i][0])
                            ->where('a.kd_bangsal', $request->input('kd_bangsaldari'))
                            ->where('a.no_batch', $data->no_batch)
                            ->where('a.no_faktur', $data->no_faktur)
                            ->update([
                                'stok' => ($hasilkurang <= 0 ? 0 : $hasilkurang)
                            ]);


                        $gudangbarang = DB::table('gudangbarang as a')
                            ->select(
                                DB::raw('ifnull(SUM(a.stok),0) as stok'),
                            )
                            ->where('a.kode_brng', $listitem[$i][0])
                            ->where('a.kd_bangsal', $request->input('kd_bangsaldari'))
                            // ->where('a.no_batch', $data->no_batch)
                            // ->where('a.no_faktur', $data->no_faktur)
                            ->first();

                        if ($gudangbarang) {
                            //catat
                            DB::table('kartu_persediaan_obat')->insert([
                                'tanggal' => date('Y-m-d'),
                                'jam' => date('H:i:s'),

                                'kode_brng' => $listitem[$i][0],
                                'kd_bangsal' => $request->kd_bangsaldari,
                                'kd_bangsal_tujuan' => $request->kd_bangsalke,

                                'masuk' => 0,
                                'jenis_masuk' => '',
                                'unit_masuk' => 0,
                                'harga_masuk' => 0,
                                'jumlah' => 0,

                                'keluar' => 1,
                                'jenis_keluar' => 'Mutasi',
                                'unit_keluar' => $sisa,

                                'status' => 3,
                                'keterangan_status' => 'Mutasi',

                                'sisa' => $gudangbarang->stok,
                                'opname' => 0,

                                'no_batch' => $data->no_batch,
                                'no_faktur' => $data->no_faktur,
                                'tgl_kadaluarsa' => $data->tgl_kadaluarsa,

                                'keterangan' => $request->input('keterangan') ?? '-',
                            ]);
                        }

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
            }
            DB::commit();
            return response()->json([
                'code' => 200,
                'data' => $arraybatch,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'code' => 201,
                'error' => $th,
            ]);
        }
    }
}
