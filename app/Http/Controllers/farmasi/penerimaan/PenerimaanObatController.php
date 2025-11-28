<?php

namespace App\Http\Controllers\farmasi\penerimaan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PenerimaanObatController extends BaseController
{
    public function index()
    {
        $ppn = DB::table('set_ppn as a')
            ->first();
        $penjualan = DB::table('setpenjualanumum as a')
            ->first();

        return view(
            'farmasi.penerimaan.penerimaan',
            [
                "ppn" => $ppn->ppn,
                "penjualan" => $penjualan->utama,
                "menu" => "penerimaan",
            ]
        );
    }

    public function getDataobat(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $obat = DB::table('databarang as a')
                ->where('a.status', '=', '1')
                ->get();
        } else {
            $obat = DB::table('databarang as a')
                ->where('a.nama_brng', 'LIKE', '%' . $request->input('searchTerm') . '%')
                ->where('a.status', '=', '1')
                ->get();
        }

        $response = array();
        foreach ($obat as $data) {
            $response[] = array(
                "id" => $data->kode_brng, //for value
                "text" => $data->nama_brng,
                "obat" => $data,
            );
        }
        echo json_encode($response);
    }

    public function getDataDistributor(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $obat = DB::table('datasuplier as a')
                ->get();
        } else {
            $obat = DB::table('datasuplier as a')
                ->where('a.nama_suplier', 'LIKE', '%' . $request->input('searchTerm') . '%')
                ->get();
        }

        $response = array();
        foreach ($obat as $data) {
            $response[] = array(
                "id" => $data->kode_suplier, //for value
                "text" => $data->nama_suplier,
            );
        }
        echo json_encode($response);
    }

    public function getDatPpabrikan(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $obat = DB::table('industrifarmasi as a')
                ->get();
        } else {
            $obat = DB::table('industrifarmasi as a')
                ->where('a.nama_industri', 'LIKE', '%' . $request->input('searchTerm') . '%')
                ->get();
        }

        $response = array();
        foreach ($obat as $data) {
            $response[] = array(
                "id" => $data->kode_industri, //for value
                "text" => $data->nama_industri,
            );
        }
        echo json_encode($response);
    }

    public function getPenerimaan(Request $request)
    {
        if ($request->input('urutan') == '1') {
            $dataPemesanan = DB::table('pemesanan as a')
                ->select(
                    'a.*',
                    'b.nama',
                    'c.nama_suplier',
                    'e.nm_bangsal',
                )
                ->join('pegawai as b', 'a.nip', '=', 'b.nik')
                ->join('datasuplier as c', 'a.kode_suplier', '=', 'c.kode_suplier')
                ->join('bangsal as e', 'a.kd_bangsal', '=', 'e.kd_bangsal')
                ->whereBetween('a.tgl_faktur', [$request->input('from'), $request->input('to')])
                ->get();
        } else {
            $dataPemesanan = DB::table('pemesanan as a')
                ->select(
                    'a.*',
                    'b.nama',
                    'c.nama_suplier',
                    'e.nm_bangsal',
                )
                ->join('pegawai as b', 'a.nip', '=', 'b.nik')
                ->join('datasuplier as c', 'a.kode_suplier', '=', 'c.kode_suplier')
                ->join('bangsal as e', 'a.kd_bangsal', '=', 'e.kd_bangsal')
                ->whereBetween('a.tgl_pesan', [$request->input('from'), $request->input('to')])
                ->orderBy('a.tgl_pesan', 'desc')
                ->get();
        }


        if (!$dataPemesanan->isEmpty()) {
            $arrdataObat = array();
            foreach ($dataPemesanan as $dataObat) {

                $dataitemretur = DB::table('detailpesan as a')
                    ->where('a.no_faktur', $dataObat->no_faktur)
                    ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                    ->get();

                array_push($arrdataObat, array(
                    "no_faktur" => $dataObat->no_faktur,
                    "no_order" => $dataObat->no_order,
                    "nama_suplier" => $dataObat->nama_suplier,
                    "nama" => $dataObat->nama,
                    "tgl_pesan" => $dataObat->tgl_pesan,
                    "tgl_faktur" => $dataObat->tgl_faktur,
                    "subtotal" => $dataObat->total2,
                    "ppn" => $dataObat->ppn,
                    "total" => $dataObat->tagihan,
                    "status" => $dataObat->status,
                    "list_item" => $dataitemretur
                ));
            }


            if ($request->input('urutan') == '1') {
                $dataitem = DB::table('detailpesan as a')
                    ->select(
                        'a.*',
                        'b.nama_brng',
                        'c.tgl_faktur',
                        'c.tgl_pesan',
                        'c.no_order',
                        'd.nama_suplier',
                        'e.nama',
                    )
                    ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                    ->join('pemesanan as c', 'a.no_faktur', '=', 'c.no_faktur')
                    ->join('datasuplier as d', 'c.kode_suplier', '=', 'd.kode_suplier')
                    ->join('pegawai as e', 'c.nip', '=', 'e.nik')
                    ->whereBetween('c.tgl_faktur', [$request->input('from'), $request->input('to')])
                    ->get();
            } else {
                $dataitem = DB::table('detailpesan as a')
                    ->select(
                        'a.*',
                        'b.nama_brng',
                        'c.tgl_faktur',
                        'c.tgl_pesan',
                        'c.no_order',
                        'd.nama_suplier',
                        'e.nama',
                    )
                    ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                    ->join('pemesanan as c', 'a.no_faktur', '=', 'c.no_faktur')
                    ->join('datasuplier as d', 'c.kode_suplier', '=', 'd.kode_suplier')
                    ->join('pegawai as e', 'c.nip', '=', 'e.nik')
                    ->whereBetween('c.tgl_pesan', [$request->input('from'), $request->input('to')])
                    ->get();
            }

            echo json_encode(array(
                'status' => '200',
                'data_pemesanan' => $arrdataObat,
                'detailpesan' => $dataitem,
            ));
        } else {
            echo json_encode(array(
                'status' => '404',
            ));
        }
    }

    public function postSimpanPenerimaan(Request $request)
    {
        $listitem = $request->input('list_obat');

        DB::beginTransaction();
        try {
            $save = DB::table('pemesanan')
                ->insert([
                    'no_faktur' => $request->input('no_faktur'),
                    'no_order' => $request->input('no_order'),
                    'kode_suplier' => $request->input('kode_suplier'),

                    'tgl_pesan' => $request->input('tgl_pesan'),
                    'tgl_faktur' => $request->input('tgl_faktur'),
                    'tgl_tempo' => $request->input('tgl_tempo'),

                    'total1' => $request->input('total'),
                    'potongan' => 0,
                    'total2' => $request->input('total'),
                    'ppn' => $request->input('ppn'),
                    'meterai' => 0,
                    'tagihan' => $request->input('total'),

                    'kd_bangsal' => $request->input('kd_bangsal'),

                    'nip' => session('user')['id_user'],
                ]);

            if ($save) {
                for ($i = 0; $i < count($listitem); $i++) {
                    $save = DB::table('detailpesan')
                        ->insert([
                            'no_faktur' => $request->input('no_faktur'),
                            'jumlah' => $listitem[$i][0],

                            'jumlah2' => $listitem[$i][0],
                            'kode_brng' => $listitem[$i][1],
                            'no_batch' => $listitem[$i][3],
                            'kadaluarsa' => $listitem[$i][4],

                            'h_pesan' => $listitem[$i][5],
                            'subtotal' => $listitem[$i][8],
                            'dis' => 0,
                            'besardis' => 0,
                            'total' => $listitem[$i][8],
                            'kode_sat' => $listitem[$i][9],

                        ]);


                    $save = DB::table('data_batch')
                        ->insert([

                            'no_batch' => $listitem[$i][3],
                            'kode_brng' => $listitem[$i][1],

                            'tgl_beli' => $request->input('tgl_pesan'),
                            'tgl_kadaluarsa' => $listitem[$i][4],

                            'asal' => 'Penerimaan',
                            'no_faktur' => $request->input('no_faktur'),

                            'dasar' => $listitem[$i][5],
                            'h_beli' => $listitem[$i][5],

                            'ralan' => $listitem[$i][6],
                            'kelas1' => $listitem[$i][6],
                            'kelas2' => $listitem[$i][6],
                            'kelas3' => $listitem[$i][6],
                            'utama' => $listitem[$i][6],
                            'vip' => $listitem[$i][6],
                            'vvip' => $listitem[$i][6],
                            'beliluar' => $listitem[$i][6],
                            'jualbebas' => $listitem[$i][6],
                            'karyawan' => $listitem[$i][6],

                            'jumlahbeli' => $listitem[$i][0],
                            'sisa' => $listitem[$i][0],

                        ]);


                    $save = DB::table('gudangbarang')
                        ->insert([
                            'kode_brng' => $listitem[$i][1],
                            'kd_bangsal' => $request->input('kd_bangsal'),
                            'stok' => $listitem[$i][0],
                            'no_batch' => $listitem[$i][3],
                            'no_faktur' => $request->input('no_faktur'),
                        ]);

                    $barang = DB::table('databarang as a')
                        ->where('a.kode_brng', $listitem[$i][1])
                        ->first();
                    if ($barang) {
                        if ($barang->utama < $listitem[$i][6]) {
                            $save = DB::table('databarang as a')
                                ->where('a.kode_brng', $listitem[$i][1])
                                ->update([

                                    'dasar' => $listitem[$i][5],
                                    'h_beli' => $listitem[$i][5],

                                    'ralan' => $listitem[$i][6],
                                    'kelas1' => $listitem[$i][6],
                                    'kelas2' => $listitem[$i][6],
                                    'kelas3' => $listitem[$i][6],
                                    'utama' => $listitem[$i][6],
                                    'vip' => $listitem[$i][6],
                                    'vvip' => $listitem[$i][6],
                                    'beliluar' => $listitem[$i][6],
                                    'jualbebas' => $listitem[$i][6],
                                    'karyawan' => $listitem[$i][6],

                                    'expire' => $listitem[$i][4],
                                ]);
                        }
                    }

                    $gudangbarang = DB::table('gudangbarang as a')
                        ->select(
                            DB::raw('ifnull(SUM(a.stok),0) as stok'),
                        )
                        ->where('a.kode_brng', $listitem[$i][1])
                        ->where('a.kd_bangsal', $request->input('kd_bangsal'))
                        ->first();

                    if ($gudangbarang) {
                        //catat
                        DB::table('kartu_persediaan_obat')->insert([
                            'tanggal' => date('Y-m-d'),
                            'jam' => date('H:i:s'),

                            'kode_brng' => $listitem[$i][1],
                            'kd_bangsal' => $request->kd_bangsal,

                            'masuk' => 1,
                            'jenis_masuk' => 'Penerimaan',
                            'unit_masuk' => $listitem[$i][0],
                            'harga_masuk' => $listitem[$i][5],
                            'jumlah' => $listitem[$i][8],

                            'keluar' => 0,
                            'jenis_keluar' => '',

                            'status' => 2,
                            'keterangan_status' => 'Peneriamaan',

                            'sisa' => ((int) $gudangbarang->stok == 0 ? $listitem[$i][0] : $gudangbarang->stok),
                            'opname' => 0,

                            'no_batch' => $listitem[$i][3],
                            'no_faktur' => $request->input('no_faktur'),
                            'tgl_kadaluarsa' => $listitem[$i][4],

                            'keterangan' => $request->keterangan ?? '-',
                        ]);
                    }
                }


            }
            DB::commit();
            return response()->json([
                'code' => 200,
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'code' => 201,
                'error' => $th,
            ]);
        }
    }

    public function postEditItemPenerimaan(Request $request)
    {
        $save = DB::table('detailpesan as a')
            ->where('a.no_faktur', $request->input('no_faktur'))
            ->where('a.no_batch', $request->input('no_batch'))
            ->where('a.kode_brng', $request->input('kode_brng'))
            ->update([
                'jumlah' => $request->input('jumlah'),
                'jumlah2' => $request->input('jumlah'),

                'kadaluarsa' => $request->input('kadaluarsa'),

                'h_pesan' => $request->input('h_pesan'),
                'subtotal' => $request->input('total'),
                'total' => $request->input('total'),
            ]);

        if ($save) {
            $save = DB::table('data_batch as a')
                ->where('a.no_faktur', $request->input('no_faktur'))
                ->where('a.no_batch', $request->input('no_batch'))
                ->where('a.kode_brng', $request->input('kode_brng'))
                ->update([
                    'tgl_kadaluarsa' => $request->input('kadaluarsa'),

                    'dasar' => $request->input('h_pesan'),
                    'h_beli' => $request->input('h_pesan'),

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

                    'jumlahbeli' => $request->input('jumlah'),
                    'sisa' => $request->input('jumlah'),
                ]);

            $barang = DB::table('databarang as a')
                ->where('a.kode_brng', $request->input('kode_brng'))
                ->first();
            if ($barang) {
                if ($barang->utama < $request->input('h_jual')) {
                    $save = DB::table('databarang as a')
                        ->where('a.kode_brng', $request->input('kode_brng'))
                        ->update([
                            'dasar' => $request->input('h_pesan'),
                            'h_beli' => $request->input('h_pesan'),

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

                            'expire' => $request->input('kadaluarsa')
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
                    'code' => 501,
                )
            );
        }
    }
}
