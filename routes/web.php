<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\farmasi\laporan\highAlertController;
use App\Http\Controllers\master\BarangController;
use App\Http\Controllers\master\BatchController;
use App\Http\Controllers\master\DataController;
use App\Http\Controllers\master\PrincipalController;
use App\Http\Controllers\master\SuplierController;


use App\Http\Controllers\farmasi\laporan\HTKPController;
use App\Http\Controllers\farmasi\laporan\penggunaanGolObatController;
use App\Http\Controllers\farmasi\laporan\PenggunaanSusuPasienController;
use App\Http\Controllers\farmasi\laporan\PengunaanObatController;
use App\Http\Controllers\farmasi\laporan\TotalResepController;
use App\Http\Controllers\farmasi\penerimaan\PenerimaanObatController;
use App\Http\Controllers\farmasi\penyiapan\PenyerahanResepController;
use App\Http\Controllers\farmasi\penyiapan\PenyiapanNonRacikController;
use App\Http\Controllers\farmasi\penyiapan\PenyiapanRacikController;
use App\Http\Controllers\farmasi\permintaan\PermintaanObatController;
use App\Http\Controllers\farmasi\resep\InputResepController;
use App\Http\Controllers\farmasi\resep\ObatKronisController;
use App\Http\Controllers\farmasi\resep\ResepDokterController;
use App\Http\Controllers\farmasi\retur\ReturObatController;
use App\Http\Controllers\laboratorium\laporan\ItemPemeriksaanLabController;
use App\Http\Controllers\laboratorium\laporan\KunjunganLabController;
use App\Http\Controllers\laboratorium\laporan\PemintaanCitoController;
use App\Http\Controllers\laboratorium\pemeriksaan\PeriksaLabController;
use App\Http\Controllers\laboratorium\integrasi\WaLabController;
use App\Http\Controllers\laboratorium\permintaan\PermintaanLabController;
use App\Http\Controllers\master\DataPemeriksaanLabController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->middleware('alreadyLoggedIn');
    Route::post('/login/loginAction', 'loginAction');
    Route::get('/login/logOutAction', 'logOutAction');
});


Route::middleware('isLoggedIn')->group(function () {
    Route::get('/main', function () {
        return view('home');
    });

    Route::controller(DataController::class)->group(function () {

        Route::post('data/getdetailpasien', 'getdetailpasien');

        Route::post('data/getPerawatan', 'getPerawatan');
        Route::get('data/getstatusmenu', 'getstatusmenu');

        Route::get('data/getJenis', 'getJenis');
        Route::get('data/getKategori', 'getKategori');
        Route::get('data/getGolongan', 'getGolongan');
        Route::post('data/getGolongans2', 'getGolongans2');
        Route::get('data/getBangsal', 'getBangsal');
        Route::get('data/getSatuan', 'getSatuan');

        Route::post('data/getNoFaktur', 'getNoFaktur');

        Route::post('data/getDataobat', 'getDataobat');

        Route::post('data/getaturanpakai', 'getaturanpakai');

        Route::post('data/getDokterAlls2', 'getDokterAlls2');
        Route::post('data/getDokterAll', 'getDokterAll');

        Route::post('data/getDetailPenyerahanObat', 'getDetailPenyerahanObat');
        Route::post('data/getDataPemberianObat', 'getDataPemberianObat');

        //LAB
        Route::post('data/getPemeriksaanLab', 'getPemeriksaanLab');
        Route::post('data/getPemeriksaans2', 'getPemeriksaans2');
        Route::post('data/getItemPemeriksaanLab', 'getItemPemeriksaanLab');
        Route::post('data/getItemPemeriksaanLab2', 'getItemPemeriksaanLab2');
        Route::post('data/getDetailResult', 'getDetailResult');
        Route::post('data/getGDT', 'getGDT');
    });

    Route::controller(HTKPController::class)->group(function () {
        Route::get('/htkp', 'index');
        Route::post('htkp/getlistpenyerahan', 'getlistpenyerahan');
    });

    Route::controller(TotalResepController::class)->group(function () {
        Route::get('/totalresepdokter', 'index');
        Route::post('totalresepdokter/getlistpasien', 'getlistpasien');
    });

    Route::controller(PenggunaanSusuPasienController::class)->group(function () {
        Route::get('/penggunaanSusu', 'index');
        Route::post('penggunaanSusu/getlistpasien', 'getlistpasien');
    });

    Route::controller(PengunaanObatController::class)->group(function () {
        Route::get('/penggunaanObat', 'index');
        Route::post('penggunaanObat/getobat', 'getobat');
    });

    Route::controller(highAlertController::class)->group(function () {
        Route::get('/obatHighAlert', 'index');
        Route::post('obatHighAlert/getobat', 'getobat');
    });

    Route::controller(penggunaanGolObatController::class)->group(function () {
        Route::get('/penggunaanGolObat', 'index');
        Route::post('penggunaanGolObat/getobat', 'getobat');
    });

    Route::controller(BarangController::class)->group(function () {
        Route::get('/barang', 'index');
        Route::post('barang/getDataBarang', 'getDataBarang');
        Route::get('barang/getkdbarang', 'getkdbarang');
        Route::post('barang/postBarang', 'postBarang');
        Route::post('barang/updateBarang', 'updateBarang');
        Route::post('barang/historyBarang', 'historyBarang');
        Route::post('barang/nonaktifbarang', 'nonaktifbarang');
    });

    Route::controller(BatchController::class)->group(function () {
        Route::get('/batch', 'index');
        Route::post('batch/getDataBarang', 'getDataBarang');
        Route::post('batch/getHistoryopname', 'getHistoryopname');
        Route::post('batch/postStokOpname', 'postStokOpname');
    });

    Route::controller(SuplierController::class)->group(function () {
        Route::get('/suplier', 'index');
        Route::post('suplier/getData', 'getData');
        Route::post('suplier/postData', 'postData');
        Route::post('suplier/updateData', 'updateData');
    });

    Route::controller(PrincipalController::class)->group(function () {
        Route::get('/principal', 'index');
        Route::post('principal/getData', 'getData');
        Route::post('principal/postData', 'postData');
        Route::post('principal/updateData', 'updateData');
    });

    Route::controller(PenerimaanObatController::class)->group(function () {
        Route::get('/penerimaan', 'index');
        Route::post('penerimaan/getDataBarang', 'getDataBarang');
        Route::post('penerimaan/getDataDistributor', 'getDataDistributor');
        Route::post('penerimaan/getDatPpabrikan', 'getDatPpabrikan');
        Route::post('penerimaan/getDataobat', 'getDataobat');        
        Route::post('penerimaan/getPenerimaan', 'getPenerimaan');
        Route::post('penerimaan/postSimpanPenerimaan', 'postSimpanPenerimaan');
        Route::post('penerimaan/postEditItemPenerimaan', 'postEditItemPenerimaan');
    });

    Route::controller(PermintaanObatController::class)->group(function () {
        Route::get('/permintaan', 'index');
        Route::post('permintaan/getDataBarang', 'getDataBarang');
        Route::post('permintaan/getpermintaanobat', 'getpermintaanobat');
        Route::post('permintaan/getmutasiBarang', 'getmutasiBarang');
        Route::post('permintaan/getDataobat', 'getDataobat');
        Route::post('permintaan/getitempermintaanobat', 'getitempermintaanobat');
        Route::post('permintaan/getDetailbarang', 'getDetailbarang');
        Route::post('permintaan/postPermintaan', 'postPermintaan');
        Route::post('permintaan/postValidasiPermintaan', 'postValidasiPermintaan');
    });

    Route::controller(ResepDokterController::class)->group(function () {
        Route::get('/resep', 'index');
        Route::post('resep/getResep', 'getResep');
        Route::post('resep/getDataobat', 'getDataobat');
        Route::post('resep/getitempermintaanobat', 'getitempermintaanobat');
        Route::post('resep/getitempermintaanobatcopy', 'getitempermintaanobatcopy');
        Route::post('resep/getaturanpakai', 'getaturanpakai');
        Route::post('resep/getdetailjumlahsisaobat', 'getdetailjumlahsisaobat');
        Route::post('resep/postPenyerahanObat', 'postPenyerahanObat');
        Route::post('resep/postSelesai', 'postSelesai');
        Route::post('resep/postSimpanResep', 'postSimpanResep');
        Route::post('resep/postSimpanCopyResep', 'postSimpanCopyResep');
        Route::post('resep/postEditaturanpakai', 'postEditaturanpakai');
        Route::post('resep/postBatalResep', 'postBatalResep');
        Route::post('resep/HapusDataPemberianObat', 'HapusDataPemberianObat');
    });

    Route::controller(InputResepController::class)->group(function () {
        Route::get('/resepManual', 'index');
        Route::post('resepManual/getPerawtan', 'getPerawtan');
        Route::post('resepManual/getHistoryResep', 'getHistoryResep');
        Route::post('resepManual/getaturanpakai', 'getaturanpakai');
        Route::post('resepManual/postSimpanResep', 'postSimpanResep');
        Route::post('resepManual/postEditaturanpakai', 'postEditaturanpakai');
    });

    Route::controller(ObatKronisController::class)->group(function () {
        Route::get('/obatKronis', 'index');
        Route::post('obatKronis/getListkronis', 'getListkronis');
    });

    Route::controller(PenyiapanNonRacikController::class)->group(function () {
        Route::get('/persiapannonracik', 'index');
        Route::post('persiapannonracik/getResep', 'getResep');
        Route::post('persiapannonracik/getitempermintaanobat', 'getitempermintaanobat');
        Route::post('persiapannonracik/postSimpanResep', 'postSimpanResep');
    });

    Route::controller(PenyiapanRacikController::class)->group(function () {
        Route::get('/persiapanracik', 'index');
        Route::post('persiapanracik/getResep', 'getResep');
        Route::post('persiapanracik/getitempermintaanobat', 'getitempermintaanobat');
        Route::post('persiapanracik/postSimpanResep', 'postSimpanResep');
    });

    Route::controller(PenyerahanResepController::class)->group(function () {
        Route::get('/penyerahanobat', 'index');
        Route::post('penyerahanobat/getResep', 'getResep');
        Route::post('penyerahanobat/getitempermintaanobat', 'getitempermintaanobat');
        Route::post('penyerahanobat/postSelesai', 'postSelesai');
        Route::post('penyerahanobat/postPenyerahanObat', 'postPenyerahanObat');
    });

    Route::controller(ReturObatController::class)->group(function () {
        Route::get('/retur', 'index');
        Route::post('retur/getretur', 'getretur');
        Route::post('retur/getDatareturSelesai', 'getDatareturSelesai');
        Route::post('retur/getDataobat', 'getDataobat');
        Route::post('retur/getitemretur', 'getitemretur');
        Route::post('retur/getnobatch', 'getnobatch');
        Route::post('retur/getnofaktur', 'getnofaktur');
        Route::post('retur/postretur', 'postretur');
    });

    // LAB

    Route::controller(ItemPemeriksaanLabController::class)->group(function () {
        Route::get('/itempemeriksaanlab', 'index');
        Route::post('itempemeriksaanlab/getlistpasien', 'getlistpasien');
    });

    Route::controller(PemintaanCitoController::class)->group(function () {
        Route::get('/permintaanCito', 'index');
        Route::post('permintaanCito/getlistpasien', 'getlistpasien');
    });

    Route::controller(KunjunganLabController::class)->group(function () {
        Route::get('/kunjunganlab', 'index');
        Route::post('kunjunganlab/getlistpasien', 'getlistpasien');
    });

    Route::controller(DataPemeriksaanLabController::class)->group(function () {
        Route::get('/jenispemeriksaan', 'index');
        Route::post('jenispemeriksaan/getData', 'getData');
        Route::get('jenispemeriksaan/getkdmaster', 'getkdmaster');
        Route::post('jenispemeriksaan/getItemTemplate', 'getItemTemplate');
        Route::post('jenispemeriksaan/postdata', 'postdata');
        Route::post('jenispemeriksaan/updateData', 'updateData');
        Route::post('jenispemeriksaan/deleteItemTemplate', 'deleteItemTemplate');
    });


    Route::controller(PermintaanLabController::class)->group(function () {
        Route::get('/permintaanlab', 'index');
        Route::post('permintaanlab/getPermintaan', 'getPermintaan');
        Route::post('permintaanlab/getItemPermintaan', 'getItemPermintaan');
        Route::post('permintaanlab/validasiPermintaan', 'validasiPermintaan');
        Route::post('permintaanlab/validasiSample', 'validasiSample');

    });

    Route::controller(PeriksaLabController::class)->group(function () {
        Route::get('/periksalab', 'index');
        Route::post('periksalab/getperiksalab', 'getperiksalab');
        Route::post('periksalab/getPemeriksaanLab', 'getPemeriksaanLab');
        Route::post('periksalab/getItemPemeriksaan', 'getItemPemeriksaan');
        Route::post('periksalab/getEditNilaihasil', 'getEditNilaihasil');
        Route::post('periksalab/verifikasi', 'verifikasi');
        Route::post('periksalab/sendorder', 'sendorder');
        Route::post('periksalab/getorder', 'getorder');
        Route::post('periksalab/get_keterangan_lis_by_nolab', 'get_keterangan_lis_by_nolab');
        Route::post('periksalab/kirimPesan', 'kirimPesan');
        Route::post('periksalab/postSimpanDataNilaiHasil', 'postSimpanDataNilaiHasil');
        Route::post('periksalab/postEditPeriksa', 'postEditPeriksa');
        Route::post('periksalab/postNewPeriksa', 'postNewPeriksa');
        Route::post('periksalab/postGDT', 'postGDT');
        Route::post('periksalab/hapusPemeriksaan', 'hapusPemeriksaan');
    });

    Route::controller(WaLabController::class)->group(function() {

        Route::get('/wa_lab', 'index');
    });
});
