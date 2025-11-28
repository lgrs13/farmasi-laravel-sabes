<?php

namespace App\Http\Controllers\farmasi\retur;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ReturObatController extends BaseController
{
    public function index()
    {
        $ppn = DB::table('set_ppn as a')
            ->first();
        $penjualan = DB::table('setpenjualanumum as a')
            ->first();

        return view(
            'farmasi.retur.returObat',
            [
                "ppn" => $ppn->ppn,
                "penjualan" => $penjualan->utama,
                "menu" => 'retur',
            ]
        );
    }

    public function getretur(Request $request)
    {
        $data_retur = DB::table('tampreturjual as a')
            ->select(
                'a.no_rawat',
                'b.status_lanjut',
                'c.no_rkm_medis',
                'c.nm_pasien',
                'd.nama',
                // DB::raw('SUM(a.no_rawat) as jml_item'),        
            )
            ->join('reg_periksa as b', 'a.no_rawat', '=', 'b.no_rawat')
            ->join('pasien as c', 'b.no_rkm_medis', '=', 'c.no_rkm_medis')
            ->join('pegawai as d', 'a.petugas', '=', 'd.nik')
            ->where('a.tanggal',$request->input('tanggal'))
            ->groupBy('a.no_rawat')
            ->groupBy('d.nama')
            ->get();

        echo json_encode(array(
            'code' => 200,
            'data_retur' => $data_retur,
        ));
    }

    public function getDataobat(Request $request)
    {
        if (!$request->has('searchTerm')) {
            $obat = DB::table('data_batch as a')
                ->select(
                    'c.kode_brng',
                    'b.nama_brng',
                    'b.kode_sat',
                    'b.utama',
                    'c.biaya_obat',
                    'c.jml',
                )
                ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                ->join('detail_pemberian_obat as c', function ($join) {
                    $join->on('c.kode_brng', '=', 'a.kode_brng')
                        ->On('c.no_batch', '=', 'a.no_batch')
                        ->On('c.no_faktur', '=', 'c.no_faktur');
                })
                ->where('c.no_rawat', '=', $request->input('no_rawat'))
                ->groupBy('a.kode_brng')
                ->groupBy('c.biaya_obat')
                ->groupBy('c.jml')
                ->get();
        } else {
            $obat = DB::table('data_batch as a')
                ->select(
                    'c.kode_brng',
                    'b.nama_brng',
                    'b.kode_sat',
                    'b.utama',
                    'c.biaya_obat',
                    'c.jml',
                )
                ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                ->join('detail_pemberian_obat as c', function ($join) {
                    $join->on('c.kode_brng', '=', 'a.kode_brng')
                        ->On('c.no_batch', '=', 'a.no_batch')
                        ->On('c.no_faktur', '=', 'c.no_faktur');
                })
                ->where('c.no_rawat', '=', $request->input('no_rawat'))
                ->where('b.nama_brng', 'LIKE', '%' . $request->input('searchTerm') . '%')
                ->groupBy('a.kode_brng')
                ->groupBy('c.biaya_obat')
                ->groupBy('c.jml')
                ->get();
        }

        $response = array();
        foreach ($obat as $data) {
            $response[] = array(
                "id" => $data->kode_brng, //for value
                "text" => $data->nama_brng,
                "satuan" => $data->kode_sat,
                "h_beli" => $data->biaya_obat,
                "jml_jual" => $data->jml,
                "h_retur" => $data->utama,
            );
        }
        echo json_encode($response);
    }

    public function getDatareturSelesai(Request $request)
    {
        $dataretur = DB::table('returjual as a')
            ->select(
                'a.*',
                'b.nama',
                'd.nm_pasien',
                'd.no_rkm_medis',
                // 'c.status_lanjut',
                'e.nm_bangsal',
            )
            ->join('pegawai as b', 'a.nip', '=', 'b.nik')
            // ->join('reg_periksa as c', 'a.no_retur_jual', '=', 'c.no_rawat')
            ->join('pasien as d', 'a.no_rkm_medis', '=', 'd.no_rkm_medis')
            ->join('bangsal as e', 'a.kd_bangsal', '=', 'e.kd_bangsal')
            ->whereBetween('a.tgl_retur', [$request->input('from'), $request->input('to')])
            ->get();


        if (!$dataretur->isEmpty()) {
            $arrdataObat = array();
            foreach ($dataretur as $dataObat) {

                $dataitemretur = DB::table('detreturjual as a')
                    ->where('a.no_retur_jual', 'LIKE', $dataObat->no_retur_jual . '%')
                    ->where('a.id_petugas', '=', $dataObat->nip)
                    ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
                    ->get();

                array_push($arrdataObat, array(
                    "no_retur_jual" => $dataObat->no_retur_jual,
                    "tgl_retur" => $dataObat->tgl_retur,
                    "jam_retur" => $dataObat->jam_retur,
                    "nm_pasien" => $dataObat->nm_pasien,
                    "nama" => $dataObat->nama,
                    "no_rkm_medis" => $dataObat->no_rkm_medis,
                    "nm_bangsal" => $dataObat->nm_bangsal,
                    "list_item" => $dataitemretur
                ));
            }

            echo json_encode(array(
                'status' => '200',
                'data_retur' => $arrdataObat,
            ));
        } else {
            echo json_encode(array(
                'status' => '404',
            ));
        }
    }

    public function getitemretur(Request $request)
    {
        $resep = DB::table('tampreturjual as a')
            ->select(
                'a.*'
            )
            ->join('databarang as b', 'a.kode_brng', '=', 'b.kode_brng')
            ->where('a.no_rawat', $request->input('no_rawat'))
            // ->where('b.no_rawat', $request->input('no_rawat'))
            ->where('b.status', '1')
            ->get();
        if ($resep) {
            echo json_encode(array(
                'code' => 200,
                'list_obat' => $resep,
                'no_resep' => $request->input('no_resep')
            ));
        }
    }

    public function getnobatch(Request $request)
    {
        $resep = DB::table('detail_pemberian_obat as a')
            ->select(
                'a.kode_brng',
                'a.no_batch',
                //  DB::raw('count(a.no_batch) as jml_item'),        
            )
            ->where('a.no_rawat', $request->input('no_rawat'))
            ->where('a.kode_brng', $request->input('kode_brng'))
            ->groupBy('a.no_batch')
            ->groupBy('a.kode_brng')
            ->get();
        if ($resep) {
            echo json_encode(array(
                'code' => 200,
                'list_batch' => $resep,
                'no_resep' => $request->input('no_resep')
            ));
        }
    }

    public function getnofaktur(Request $request)
    {
        $resep = DB::table('detail_pemberian_obat as a')
            ->select(
                'a.kode_brng',
                'a.no_faktur',
                //  DB::raw('count(a.no_batch) as jml_item'),        
            )
            ->where('a.no_rawat', $request->input('no_rawat'))
            ->where('a.kode_brng', $request->input('kode_brng'))
            ->where('a.no_batch', $request->input('no_batch'))
            ->groupBy('a.no_batch')
            ->groupBy('a.no_faktur')
            ->groupBy('a.kode_brng')
            ->get();
        if ($resep) {
            echo json_encode(array(
                'code' => 200,
                'list_faktur' => $resep,
                'no_resep' => $request->input('no_resep')
            ));
        }
    }

    public function postretur(Request $request)
    {

        $save = DB::table('returjual')
            ->insert([
                'no_retur_jual' => $request->input('no_rawat'),
                'no_rkm_medis' => $request->input('no_rkm_medis'),
                'kd_bangsal' => $request->input('kd_bangsal'),

                'tgl_retur' => $request->input('tgl_retur'),
                'jam_retur' => $request->input('jam_retur'),

                'nip' => $request->session()->get('user')['id_user'],
            ]);
        if ($save) {
            $listitem = $request->input('list_retur');
            for ($i = 0; $i < count($listitem); $i++) {

                $save = DB::table('detreturjual')
                    ->insert([
                        'no_retur_jual' => $request->input('no_rawat'),
                        'nota_jual' => '',

                        'kode_brng' => $listitem[$i][2],
                        'kode_sat' => $listitem[$i][4],
                        'jml_jual' => $listitem[$i][5],
                        'h_jual' => $listitem[$i][6],
                        'jml_retur' => $listitem[$i][1],
                        'h_retur' => $listitem[$i][7],
                        'subtotal' => $listitem[$i][8],
                        'no_batch' => $listitem[$i][9],
                        'no_faktur' => $listitem[$i][10],

                        'id_petugas' => $request->session()->get('user')['id_user'],
                    ]);
            }

            $save = DB::table('log_returjual')
                ->insert([
                    'no_retur_jual' => $request->input('no_rawat'),
                    'no_rkm_medis' => $request->input('no_rkm_medis'),
                    'kd_bangsal' => $request->input('kd_bangsal'),

                    'tgl_retur' => $request->input('tgl_retur'),
                    'jam_retur' => $request->input('jam_retur'),

                    'nip' => $request->session()->get('user')['id_user'],
                    'list_item' => serialize($request->input('list_retur_all'))
                ]);





            if ($save) {
                DB::table('tampreturjual')
                    ->where('no_rawat', $request->input('no_rawat'))
                    ->delete();
                ;
                echo json_encode(
                    array(
                        'code' => 200,
                    )
                );
            } else {


                DB::table('returjual')
                    ->where('no_rawat', $request->input('no_rawat'))
                    ->delete();

                DB::table('detreturjual')
                    ->where('no_rawat', $request->input('no_rawat'))
                    ->delete();

                echo json_encode(
                    array(
                        'code' => 500,

                    )
                );

            }


        } else {
            echo json_encode(
                array(
                    'code' => 500,

                )
            );
        }
    }
}
