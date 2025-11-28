@extends('layouts.main')

@section('title')
    <title>Transaksi | Resep Dokter</title>
@endsection

@section('content')
    <section class="section row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 ">
                            <h4 class="card-title">Resep Dokter</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="" class="text-white">-</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Dari
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" id="datepickerFrom1" name="datepickerFrom1" {{--
                                    value="{{ date('Y-m-d', strtotime('-7 days')) }}"> --}} value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="" class="text-white">-</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Sampai
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" id="datepickerTO1" name="datepickerTO1" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <button type="" class="btn btn-warning float-end" id="btnCari">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#ralan" role="tab" aria-controls="ralan" aria-selected="true">Rawat Jalan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#ranap" role="tab" aria-controls="ranap" aria-selected="false">Rawat Inap</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="ralan" role="tabpanel" aria-labelledby="ralan-tab">
                            <div class="table-responsive datatable-minimal ">
                                <table class="table" id="tableResep1">
                                    <thead>
                                        <tr>
                                            <th>No. Resep</th>
                                            <th>Tgl. Peresepan</th>
                                            <th>Jam Peresepan</th>
                                            <th>No. Rawat</th>
                                            <th>Pasien</th>
                                            <th>Dokter</th>
                                            <!-- <th>Status</th> -->
                                            <th>Cara Bayar</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ranap" role="tabpanel" aria-labelledby="ranap-tab">
                            <div class="table-responsive datatable-minimal">
                                <table class="table" id="tableResep2">
                                    <thead>
                                        <tr>
                                            <th>No. Resep</th>
                                            <th>Tgl. Peresepan</th>
                                            <th>Jam Peresepan</th>
                                            <th>No. Rawat</th>
                                            <th>No. RM</th>
                                            <th>Dokter</th>
                                            <!-- <th>Status</th> -->
                                            <th>Cara Bayar</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <div class="modal fade text-left" id="modalvalidasiresep" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false" data-bs-backdrop="false" tabindex="-1">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel140">
                        Validasi Resep Dokter
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8 col-md-4" hidden>
                            <div class="form-group">
                                <label for="basicInput">Status Rawat</label>
                                <input type="text" class="form-control form-control-sm" id="statusrawat" disabled>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">No. Resep</label>
                                <input type="text" class="form-control form-control-sm" id="noPerimtaaan" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Tgl. Perimtaaan</label>
                                <input type="date" class="form-control form-control-sm" id="tglPerimtaaan">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Jam Perimtaaan</label>
                                <input type="time" class="form-control form-control-sm" id="jamPerimtaaan">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Antrian (Estimasi)</label>
                                <input type="text" class="form-control form-control-sm" id="noPerimtaaan">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-1">
                            <div class="form-group">
                                <label for="basicInput">Depo</label>
                                <select class="form-control form-control-sm" id="depo">
                                    <option value="A1" selected>Apotek</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">No. Rawat</label>
                                <input type="text" class="form-control form-control-sm" id="norawat" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">No. RM</label>
                                <input type="text" class="form-control form-control-sm" id="norm" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nama Pasien</label>
                                <input type="text" class="form-control form-control-sm" id="namapasien" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Umur</label>
                                <input type="text" class="form-control form-control-sm" id="umur" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Dokter</label>
                                <input type="text" class="form-control form-control-sm" id="dokter" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Poli / Bangsal</label>
                                <input type="text" class="form-control form-control-sm" id="poliklinik" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Diagnosa</label>
                                <input type="text" class="form-control form-control-sm" id="diagnosa" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-1">
                            <div class="form-group">
                                <label for="basicInput">BB (kg)</label>
                                <input type="text" class="form-control form-control-sm" id="bb" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Alergi</label>
                                <input type="text" class="form-control form-control-sm" id="alergi" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Keterangan Perubahan Resep</label>
                                <textarea type="text" class="form-control form-control-sm" id="perubahanresep" required>

                                </textarea>
                            </div>
                        </div>

                    </div>

                    <div class="row ">
                        <div class="col-12">

                            <span class="card-title">List Obat</span>
                            <div class="form-check">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-danger" name="obatkronis" id="obatkronis1">
                                    <label class="form-check-label text-danger" for="obatkronis1">Obat
                                        Kronis</label>
                                </div>
                            </div>


                        </div>
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-1 mt-2">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link secnonracik active" id="tablistobat1" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="bi bi-database-fill"></i>Non-Racik</a>
                                        <a class="nav-link secracik" id="tablistobat2" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="bi bi-capsule"> Racik</i></a>
                                    </div>
                                </div>
                                <div class="col-11">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane secnonracik fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            <table class="table table-bordered tableresep3" id="tableresep3">
                                                <thead>
                                                    <tr>

                                                        {{-- <th hidden></th> --}}
                                                        <th>Jumlah</th>
                                                        <th>Kode</th>
                                                        <th>Nama</th>
                                                        <th>Satuan</th>
                                                        <th>Stok</th>
                                                        <th>Catatan <br> Resep</th>
                                                        <th>Cara <br> Pemberian</th>
                                                        <th>Frekuensi</th>
                                                        <th>Dosis</th>
                                                        <th>Aturan <br> Tambahan</th>
                                                        <th>Keterangan</th>
                                                        <th>Harga</th>
                                                        <th hidden>Harga Beli</th>
                                                        <th>
                                                            <button type="button" class="btn btn-primary icon-left addobat" id="addobat"><i class="bi bi-plus-circle"></i></button>
                                                            {{-- </center> --}}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane secracik fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                            <table class="table table-bordered tableresep4" id="tableresep4">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th hidden></th>
                                                        <th>Jumlah</th>
                                                        <th>Kode</th>
                                                        <th>Nama</th>
                                                        <th>Metode</th>
                                                        <th>Catatan <br> Resep</th>
                                                        <th>Cara <br> Pemberian</th>
                                                        <th>Frekuensi</th>
                                                        <th>Keterangan</th>
                                                        <th>

                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-warning" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="button" class="btn btn-danger btn-sm ms-1" id="btnbatalpermintaan">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Batal</span>
                    </button>

                    <button type="button" class="btn btn-success btn-sm ms-1" id="btnsavepermintaan">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalNewItem" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="myModalLabel140">Add Detail Obat
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Kode Barang</label>
                                <input type="text" class="form-control form-control-sm" id="kodebarang1" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-8" hidden>
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang1" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-8" hidden>
                            <div class="form-group">
                                <label for="basicInput">Satuan</label>
                                <input type="text" class="form-control form-control-sm" id="satuan1" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <select class="form-control form-control-sm" id="inputbarang1">

                                </select>
                                <p><small class="text-danger" for="">Obat stok 0 pada depo yang dipilih tidak
                                        muncul</small></p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Jumlah didepo</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" aria-describedby="lbljumlah1" id="jumlahtotal" disabled>
                                    <span class="input-group-text lbljumlah1" id="lbljumlah1"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Jumlah</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" aria-describedby="lbljumlah1" id="jumlah1">
                                    <span class="input-group-text lbljumlah1" id="lbljumlah1"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Harga Beli</label>
                                <input type="text" class="form-control form-control-sm" id="hargabeli1" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Harga</label>
                                <input type="text" class="form-control form-control-sm" id="hargajual1" disabled>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Aturan Pakai / Catatan Resep</label>
                                <!-- <input type="text" class="form-control form-control-sm" id="aturanpakai1"> -->
                                <select id="aturanpakai1" class="form-control form-control-sm">

                                </select>
                                <p><small class="text-danger" for="">Aturan pakai ini akan digunakan untuk
                                        print e-tiket</small></p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Cara Pemberian</label>
                                <select id="carapemberian1" class="form-control form-control-sm">
                                    <option value=""></option>
                                    <option value="Oral">Oral</option>
                                    <option value="IM">IM</option>
                                    <option value="Infus">Infus</option>
                                    <option value="Subkutan">Subkutan</option>
                                    <option value="IV">IV</option>
                                    <option value="Suppositoria">Suppositoria</option>
                                    <option value="Topikal">Topikal</option>
                                    <option value="Inhalasi">Inhalasi</option>
                                    <option value="Lain - lain">Lain - lain</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Frekuensi</label>
                                <input type="text" class="form-control form-control-sm" id="frekuensi1">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Dosis</label>
                                <input type="text" class="form-control form-control-sm" id="dosis1">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Aturan Tambahan</label>
                                <input type="text" class="form-control form-control-sm" id="aturantambahan1">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Keterangan</label>
                                <textarea type="text" class="form-control form-control-sm" id="keterangan1"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="button" class="btn btn-warning ms-1 btn-sm" id="btnadddetailitemresep">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modaleditAturanPakai" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">
                        Edit Aturan Pakai
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8 col-md-4" hidden>
                            <div class="form-group">
                                <label for="basicInput">Status Rawat</label>
                                <input type="text" class="form-control form-control-sm" id="statusrawat" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3" hidden>
                            <div class="form-group">
                                <label for="basicInput">Tgl. Perimtaaan</label>
                                <input type="date" class="form-control form-control-sm" id="tglPerimtaaan2">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2" hidden>
                            <div class="form-group">
                                <label for="basicInput">Jam Perimtaaan</label>
                                <input type="time" class="form-control form-control-sm" id="jamPerimtaaan2">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">No. Resep</label>
                                <input type="text" class="form-control form-control-sm" id="noPerimtaaan2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">No. Rawat</label>
                                <input type="text" class="form-control form-control-sm" id="norawat2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">No. RM</label>
                                <input type="text" class="form-control form-control-sm" id="norm2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nama Pasien</label>
                                <input type="text" class="form-control form-control-sm" id="namapasien2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Dokter</label>
                                <input type="text" class="form-control form-control-sm" id="dokter2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Poli</label>
                                <input type="text" class="form-control form-control-sm" id="poliklinik2" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row  mt-2">
                        <div class="col-12">
                            <span class="card-title">List Obat</span>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered tableresep6" id="tableresep6">
                                <thead>
                                    <tr>

                                        {{-- <th hidden></th> --}}
                                        {{-- <th>Jumlah</th> --}}
                                        <th hidden>Kode</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Catatan Resep</th>
                                        <th>
                                            {{-- <button type="button" class="btn btn-primary icon-left" id="addobat"><i
                                                class="bi bi-plus-circle"></i></button> --}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <table class="table table-bordered tableresep7" id="tableresep7">
                                <thead>
                                    <tr>

                                        {{-- <th hidden></th> --}}
                                        {{-- <th>Jumlah</th> --}}
                                        <th hidden>Kode</th>
                                        <th>Nama Racik</th>
                                        <th>Catatan Resep</th>
                                        <th>
                                            {{-- <button type="button" class="btn btn-primary icon-left" id="addobat"><i
                                                class="bi bi-plus-circle"></i></button> --}}
                                            {{-- </center> --}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>

                        <button type="button" class="btn btn-warning btn-sm ms-1" id="btnsaveaturanpakai">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalcopyresep" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false" data-bs-backdrop="false" tabindex="-1">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel140">
                        Copy Resep Dokter
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8 col-md-4" hidden>
                            <div class="form-group">
                                <label for="basicInput">Status Rawat</label>
                                <input type="text" class="form-control form-control-sm" id="statusrawat5" disabled>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-4" hidden>
                            <div class="form-group">
                                <label for="basicInput">No. Resep</label>
                                <input type="text" class="form-control form-control-sm" id="noPerimtaaan5" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Tgl. Perimtaaan</label>
                                <input type="date" class="form-control form-control-sm" id="tglPerimtaaan5">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Jam Perimtaaan</label>
                                <input type="time" class="form-control form-control-sm" id="jamPerimtaaan5">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2" hidden>
                            <div class="form-group">
                                <label for="basicInput">Antrian (Estimasi)</label>
                                <input type="text" class="form-control form-control-sm" id="antrian5">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-1" hidden>
                            <div class="form-group">
                                <label for="basicInput">Depo</label>
                                <select class="form-control form-control-sm" id="depo5">
                                    <option value="A1" selected>Apotek</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">No. Rawat</label>
                                <input type="text" class="form-control form-control-sm" id="norawat5" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">No. RM</label>
                                <input type="text" class="form-control form-control-sm" id="norm5" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nama Pasien</label>
                                <input type="text" class="form-control form-control-sm" id="namapasien5" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Umur</label>
                                <input type="text" class="form-control form-control-sm" id="umur5" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3" hidden>
                            <div class="form-group">
                                <label for="basicInput">Kode Dokter</label>
                                <input type="text" class="form-control form-control-sm" id="kodedokter5" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Dokter</label>
                                <input type="text" class="form-control form-control-sm" id="dokter5" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Poli</label>
                                <input type="text" class="form-control form-control-sm" id="poliklinik5" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Diagnosa</label>
                                <input type="text" class="form-control form-control-sm" id="diagnosa5" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-1">
                            <div class="form-group">
                                <label for="basicInput">BB (kg)</label>
                                <input type="text" class="form-control form-control-sm" id="bb5" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Alergi</label>
                                <input type="text" class="form-control form-control-sm" id="alergi5" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row ">
                        <div class="col-12">

                            <span class="card-title">List Obat</span>

                        </div>
                        <div class="col-12 mt-5">
                            <table class="table table-bordered tableresep5" id="tableresep5">
                                <thead>
                                    <tr>
                                        <th>Jumlah</th>
                                        <th>Sisa</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Satuan</th>
                                        <th>Aturan Pakai</th>
                                        <th>Keterangan</th>
                                        <th>
                                            {{-- <button type="button" class="btn btn-sm btn-primary icon-left"
                                            id="addobat"><i class="bi bi-plus-circle"></i></button> --}}
                                            {{-- </center> --}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="button" class="btn btn-primary btn-sm ms-1" id="btnprinttempresep">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Print</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalEditItemresep" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="myModalLabel140">Edit Detail Obat
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>

                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">ID</label>
                                <input type="text" class="form-control form-control-sm" id="idlistobat2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Kode Barang</label>
                                <input type="text" class="form-control form-control-sm" id="kodebarang2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Jumlah</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" aria-describedby="lbljumlah2" id="jumlah2">
                                    <span class="input-group-text lbljumlah" id="lbljumlah2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Aturan Pakai / Catatan Resep</label>
                                <p><small class="text-danger" for="">Aturan pakai ini akan digunakan untuk
                                        print e-tiket</small></p>
                                <!-- <input type="text" class="form-control form-control-sm" id="aturanpakai2"> -->
                                <select id="aturanpakai2" class="form-control form-control-sm">

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Cara Pemberian</label>
                                <select id="carapemberian2" class="form-control form-control-sm">
                                    <option value=""></option>
                                    <option value="Oral">Oral</option>
                                    <option value="IM">IM</option>
                                    <option value="Infus">Infus</option>
                                    <option value="Subkutan">Subkutan</option>
                                    <option value="IV">IV</option>
                                    <option value="Suppositoria">Suppositoria</option>
                                    <option value="Topikal">Topikal</option>
                                    <option value="Inhalasi">Inhalasi</option>
                                    <option value="Lain - lain">Lain - lain</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Frekuensi</label>
                                <input type="text" class="form-control form-control-sm" id="frekuensi2">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Dosis</label>
                                <input type="text" class="form-control form-control-sm" id="dosis2">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Aturan Tambahan</label>
                                <input type="text" class="form-control form-control-sm" id="aturantambahan2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 secsisa2">
                            <div class="form-group">
                                <label for="basicInput">Sisa</label>
                                <input type="text" class="form-control form-control-sm" id="sisa2" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Keterangan</label>
                                <textarea type="text" class="form-control form-control-sm" id="keterangan2"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6" hidden>
                            <div class="form-group">
                                <label for="basicInput">Harga</label>
                                <input type="text" class="form-control form-control-sm" id="harga2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6" hidden>
                            <div class="form-group">
                                <label for="basicInput">Sub Total</label>
                                <input type="text" class="form-control form-control-sm" id="total2" disabled>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="button" class="btn btn-warning ms-1 btn-sm" id="btneditdetailitemresep">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalEditItemresepRacikan" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="myModalLabel140">Edit Detail Obat Racik
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>

                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">ID</label>
                                <input type="text" class="form-control form-control-sm" id="idlistobat3" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Nama Racik</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang3" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah3" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Aturan Pakai / Catatan Resep</label>
                                <p><small class="text-danger" for="">Aturan pakai ini akan digunakan untuk
                                        print e-tiket</small></p>
                                <input type="text" class="form-control form-control-sm" id="aturanpakai3">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Cara Pemberian</label>
                                <select id="carapemberian3" class="form-control form-control-sm">
                                    <option value=""></option>
                                    <option value="Oral">Oral</option>
                                    <option value="IM">IM</option>
                                    <option value="Infus">Infus</option>
                                    <option value="Subkutan">Subkutan</option>
                                    <option value="IV">IV</option>
                                    <option value="Suppositoria">Suppositoria</option>
                                    <option value="Topikal">Topikal</option>
                                    <option value="Inhalasi">Inhalasi</option>
                                    <option value="Lain - lain">Lain - lain</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Frekuensi</label>
                                <input type="text" class="form-control form-control-sm" id="frekuensi3">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Keterangan</label>
                                <textarea type="text" class="form-control form-control-sm" id="keterangan3"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="button" class="btn btn-warning ms-1 btn-sm" id="btneditdetailitemresepracikan">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalDatapemberiannObat" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-full  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">
                        Data Pemberian Obat
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">No. Rawat</label>
                                <input type="text" class="form-control form-control-sm" id="norawat9" disabled>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">No. RM</label>
                                <input type="text" class="form-control form-control-sm" id="norm9" disabled>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nama Pasien</label>
                                <input type="text" class="form-control form-control-sm" id="namapasien9" disabled>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">DPJP</label>
                                <input type="text" class="form-control form-control-sm" id="dokter9" disabled>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Asal</label>
                                <input type="text" class="form-control form-control-sm" id="poliklinik9" disabled>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Tanggal</label>
                                <input type="text" class="form-control form-control-sm" id="tanggal9" disabled>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Jam</label>
                                <input type="text" class="form-control form-control-sm" id="jam9" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row  mt-2">
                        <div class="col-12">
                            <span class="card-title">List Obat</span>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive" style="min-height: 200px; max-height: 600px; overflow: auto;">
                                <table class="table table-bordered tableresep9" id="tableresep9">
                                    <thead>
                                        <tr>
                                            <th>Tgl. & Jam Beri</th>
                                            {{-- <th>Jam Beri</th> --}}
                                            <th>No. Resep</th>
                                            {{-- <th>No. RM</th> --}}
                                            {{-- <th>Nama Pasien</th> --}}
                                            <th>Kode Obat</th>
                                            <th>Nama Obat</th>
                                            <th>
                                                <span class="badge bg-light-success">No. Batch</span>
                                                <br>
                                                <span class="badge bg-light-warning">No. Faktur</span>
                                            </th>
                                            <th>Jumlah</th>
                                            <th>
                                                <span class="badge bg-light-success">Harga</span>
                                                <br>
                                                <span class="badge bg-light-warning">Total</span>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalviewresep" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">
                        Edit Aturan Pakai
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8 col-md-4" hidden>
                            <div class="form-group">
                                <label for="basicInput">Status Rawat</label>
                                <input type="text" class="form-control form-control-sm" id="statusrawat" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3" hidden>
                            <div class="form-group">
                                <label for="basicInput">Tgl. Perimtaaan</label>
                                <input type="date" class="form-control form-control-sm" id="tglPerimtaaan2">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2" hidden>
                            <div class="form-group">
                                <label for="basicInput">Jam Perimtaaan</label>
                                <input type="time" class="form-control form-control-sm" id="jamPerimtaaan2">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">No. Resep</label>
                                <input type="text" class="form-control form-control-sm" id="noPerimtaaan2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">No. Rawat</label>
                                <input type="text" class="form-control form-control-sm" id="norawat2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">No. RM</label>
                                <input type="text" class="form-control form-control-sm" id="norm2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nama Pasien</label>
                                <input type="text" class="form-control form-control-sm" id="namapasien2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Dokter</label>
                                <input type="text" class="form-control form-control-sm" id="dokter2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Poli</label>
                                <input type="text" class="form-control form-control-sm" id="poliklinik2" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row  mt-2">
                        <div class="col-12">
                            <span class="card-title">List Obat</span>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered tableresep8" id="tableresep8">
                                <thead>
                                    <tr>

                                        {{-- <th hidden></th> --}}
                                        {{-- <th>Jumlah</th> --}}
                                        <th hidden>Kode</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Catatan Resep</th>
                                        <th>
                                            {{-- <button type="button" class="btn btn-primary icon-left" id="addobat"><i
                                                class="bi bi-plus-circle"></i></button> --}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <table class="table table-bordered tableresep7" id="tableresep7">
                                <thead>
                                    <tr>

                                        {{-- <th hidden></th> --}}
                                        {{-- <th>Jumlah</th> --}}
                                        <th hidden>Kode</th>
                                        <th>Nama Racik</th>
                                        <th>Catatan Resep</th>
                                        <th>
                                            {{-- <button type="button" class="btn btn-primary icon-left" id="addobat"><i
                                                class="bi bi-plus-circle"></i></button> --}}
                                            {{-- </center> --}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>

                        <button type="button" class="btn btn-warning btn-sm ms-1" id="btnsaveaturanpakai">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/static/js/pages/datatables.js"></script>

    <script>
        $(document).ready(function(e) {

            getBangsal('dari');
            getResep();

            $('#tablistobat2').hide();
            $('#secsisa2').hide();

            $('.secobathighalert').hide()
            $('#kontrolhighalert').on('change', function() {
                if (this.value == 'Ya') {
                    $('.secobathighalert').show()
                } else {
                    $('.secobathighalert').hide()
                }
            });

            $('.seckeluargapasien').hide()
            $('#penerimaobat').on('change', function() {
                if (this.value == 'Pasien') {
                    $('.seckeluargapasien').hide()
                } else {
                    $('.seckeluargapasien').show()
                }
            });

            $("#tableresep3").on("click", ".btn_edit", function() {
                $('#idlistobat2').val($(this).parents("tr").attr('data-index'));
                $('#kodebarang2').val($(this).parents("tr").attr('data-kodebarang'));
                $('#namabarang2').val($(this).parents("tr").attr('data-namabrng'));
                $('#jumlah2').val($(this).parents("tr").attr('data-jumlah'));
                $('#lbljumlah2').html($(this).parents("tr").attr('data-satuan'));
                // $('#aturanpakai2').val($(this).parents("tr").attr('data-aturanpakai'));

                if ($('#aturanpakai2').find("option[value='" + $(this).parents("tr").attr('data-aturanpakai') + "']").length) {
                    $('#aturanpakai2').val($(this).parents("tr").attr('data-aturanpakai')).trigger('change');
                } else {
                    // Create a DOM Option and pre-select by default
                    var newOption = new Option($(this).parents("tr").attr('data-aturanpakai'), $(this).parents("tr").attr('data-aturanpakai'), true, true);
                    // Append it to the select
                    $('#aturanpakai2').append(newOption).trigger('change');
                }

                $('#carapemberian2').val($(this).parents("tr").attr('data-carapemberian'));
                $('#frekuensi2').val($(this).parents("tr").attr('data-frekuensi'));
                $('#dosis2').val($(this).parents("tr").attr('data-dosis'));
                $('#aturantambahan2').val($(this).parents("tr").attr('data-aturantambahan'));
                $('#keterangan2').val($(this).parents("tr").attr('data-keterangan'));

                $("#jumlah2").removeClass("is-invalid");
                $("#aturanpakai2").removeClass("is-invalid");


                // console.log($('#statusrawat').val());
                // console.log($('#norawat').val());
                if ($('#statusrawat').val() == 'Ranap') {
                    $.ajax({
                        url: "/resep/getdetailjumlahsisaobat",
                        type: 'POST',
                        data: {
                            no_resep: $('#noPerimtaaan').val(),
                            no_rawat: $('#norawat').val(),
                            kode_brng: $(this).parents("tr").attr('data-kodebarang')
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.status == 200) {
                                if (response.data.jenis_obat_multidose == 0) {

                                    $('#sisa2').val(response.data.jml - response.data.total_beri);
                                    $('#secsisa2').show();
                                } else {
                                    $('#sisa2').val(response.data.jml_multidose - response.data.total_beri);
                                    $('#secsisa2').show();

                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    })
                } else {
                    $('#secsisa2').hide();
                }

                $('#modalEditItemresep').modal('show');


            });

            $('#tableresep3').on('click', '.btn_delete', function() {
                $(this).closest("tr").remove();
            });

            $("#aturanpakai1").select2({
                ajax: {
                    url: "/data/getaturanpakai",
                    type: "POST",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: false,
                },
                tags: true,
                escapeMarkup: function(markup) {
                    return markup;
                },
                dropdownParent: $("#modalNewItem"),
                theme: "bootstrap-5",
                closeOnSelect: true
            });

            $("#addobat").click(function() {
                $("#inputbarang1").select2({
                    ajax: {
                        url: "/data/getDataobat",
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                kd_bangsal: $("#depo").val(),
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function(response) {
                            return {
                                results: response
                            };
                        },
                        cache: false,
                    },
                    escapeMarkup: function(markup) {
                        return markup;
                    },
                    dropdownParent: $("#modalNewItem"),
                    theme: "bootstrap-5",
                    closeOnSelect: true
                }).on('select2:select', function(event) {
                    var dtaSelected = event.params.data;
                    console.log(dtaSelected);

                    $(".lbljumlah1").text(dtaSelected.kode_sat)
                    $("#jumlahtotal").val(dtaSelected.jml_item)
                    $("#kodebarang1").val(dtaSelected.id)
                    $("#namabarang1").val(dtaSelected.text)
                    $("#satuan1").val(dtaSelected.kode_sat)
                    $("#hargabeli1").val(dtaSelected.h_beli)
                    $("#hargajual1").val(dtaSelected.h_jual)
                });

                $("#modalNewItem").modal('show')
            });

            $("#btneditdetailitemresep").click(function() {
                console.log($('#jumlah2').val());

                if ($('#jumlah2').val() == 0 && $('#jumlah2').val() == '') {
                    $('#jumlah2').focus();
                    $("#jumlah2").addClass("is-invalid");
                } else if ($('#aturanpakai2').val() == '') {
                    $('#aturanpakai2').focus();
                    $("#aturanpakai2").addClass("is-invalid");
                } else {

                    row = $('#' + $('#idlistobat2').val());
                    row.attr('data-index', $('#idDiagnosaSkunder').val());
                    row.attr('data-kodebarang', $('#kodebarang2').val());
                    row.attr('data-namabrng', $('#namabarang2').val());
                    row.attr('data-jumlah', $('#jumlah2').val());
                    row.attr('data-aturanpakai', $('#aturanpakai2').val());
                    row.attr('data-carapemberian', $('#carapemberian2').val());
                    row.attr('data-frekuensi', $('#frekuensi2').val());
                    row.attr('data-dosis', $('#dosis2').val());
                    row.attr('data-aturantambahan', $('#aturantambahan2').val());
                    row.attr('data-keterangan', $('#keterangan2').val());

                    if ($("#obatkronis1").is(':checked')) {
                        $(row.children()[0]).text($('#jumlah2').val());
                        $(row.children()[6]).text($('#aturanpakai2').val());
                        $(row.children()[7]).text($('#carapemberian2').val());
                        $(row.children()[8]).text($('#frekuensi2').val());
                        $(row.children()[9]).text($('#dosis2').val());
                        $(row.children()[10]).text($('#aturantambahan2').val());
                        $(row.children()[11]).text($('#keterangan2').val());
                    } else {
                        $(row.children()[0]).text($('#jumlah2').val());
                        $(row.children()[5]).text($('#aturanpakai2').val());
                        $(row.children()[6]).text($('#carapemberian2').val());
                        $(row.children()[7]).text($('#frekuensi2').val());
                        $(row.children()[8]).text($('#dosis2').val());
                        $(row.children()[9]).text($('#aturantambahan2').val());
                        $(row.children()[10]).text($('#keterangan2').val());
                    }

                    $('#idlistobat2').val('');
                    $('#kodebarang2').val('');
                    $('#namabarang2').val('');
                    $('#jumlah2').val('');
                    $('#aturanpakai2').val('');
                    $('#carapemberian2').val('');
                    $('#frekuensi2').val('');
                    $('#dosis2').val('');
                    $('#aturantambahan2').val('');
                    $('#keterangan2').val('');

                    $('#modalEditItemresep').modal('hide');
                }

            });

            $("#tableresep4").on("click", ".btn_edit", function() {
                // console.log($(this).parents("tr").attr('data-aturanpakai'));

                $('#idlistobat3').val($(this).parents("tr").attr('data-index'));
                $('#namabarang3').val($(this).parents("tr").attr('data-namaracik'));
                $('#jumlah3').val($(this).parents("tr").attr('data-jmldr'));
                $('#aturanpakai3').val($(this).parents("tr").attr('data-aturanpakai'));
                $('#carapemberian3').val($(this).parents("tr").attr('data-carapemberian'));
                $('#frekuensi3').val($(this).parents("tr").attr('data-frekuensi'));
                $('#keterangan3').val($(this).parents("tr").attr('data-keterangan'));

                $('#modalEditItemresepRacikan').modal('show');
            });


            $("#btneditdetailitemresepracikan").click(function() {

                if ($('#aturanpakai3').val() == '') {
                    $('#aturanpakai3').focus();
                    $("#aturanpakai3").addClass("is-invalid");
                } else {
                    row = $('#' + $('#idlistobat3').val());
                    row.attr('data-index', $('#aturanpakai3').val());
                    row.attr('data-namaracik', $('#namabarang3').val());
                    row.attr('data-jmldr', $('#jumlah3').val());
                    row.attr('data-aturanpakai', $('#aturanpakai3').val());
                    row.attr('data-carapemberian', $('#carapemberian3').val());
                    row.attr('data-frekuensi', $('#frekuensi3').val());
                    row.attr('data-keterangan', $('#keterangan3').val());

                    // $(row.children()[0]).text($('#jumlah2').val());
                    $(row.children()[6]).text($('#aturanpakai3').val());
                    $(row.children()[7]).text($('#carapemberian3').val());
                    $(row.children()[8]).text($('#frekuensi3').val());
                    $(row.children()[9]).text($('#keterangan3').val());

                    $('#idlistobat2').val('');
                    $('#aturanpakai3').val('');
                    $('#namabarang3').val('');
                    $('#jumlah3').val('');
                    $('#carapemberian3').val('');
                    $('#frekuensi3').val('');
                    $('#keterangan3').val('');

                    $('#modalEditItemresepRacikan').modal('hide');
                }

            });

            $('#tableresep5').on('click', '.btn_delete', function() {
                $(this).closest("tr").remove();
            });

            $("#tableresep5").on("click", ".btn_edit", function() {

                $(this).parents("tr").find("td:eq(1)").html('<input name="edit_jumlah" value="' + $(this).parents("tr").attr('data-jumlah') + '">');
                $(this).parents("tr").find("td:eq(5)").html('<input name="edit_aturanpakai" value="' + $(this).parents("tr").attr('data-aturanpakai') + '">');
                $(this).parents("tr").find("td:eq(6)").html('<input name="edit_keterangan" value="' + $(this).parents("tr").attr('data-keterangan') + '">');

                $(this).parents("tr").find("td:eq(7)").prepend(
                    '<button class="btn btn-success btn-sm btn-update"><i class="bi bi-check2"></i></button>' +
                    '<button class="btn btn-danger btn-sm btn-cancel"><i class="bi bi-x-lg"></i></button>')

                $(this).parents("tr").find(".btn_edit").hide();
                $(this).parents("tr").find(".btn_delete").hide();


            });

            $("#tableresep5").on("click", ".btn-update", function() {

                var jumlah = $(this).parents("tr").find("input[name='edit_jumlah']").val();
                var aturanpakai = $(this).parents("tr").find("input[name='edit_aturanpakai']").val();
                var keterangan = $(this).parents("tr").find("input[name='edit_keterangan']").val();


                $(this).parents("tr").find("td:eq(1)").text(jumlah);
                $(this).parents("tr").find("td:eq(5)").text(aturanpakai);
                $(this).parents("tr").find("td:eq(6)").text(keterangan);

                $(this).parents("tr").attr('data-jumlah', jumlah);
                $(this).parents("tr").attr('data-aturanpakai', aturanpakai);
                $(this).parents("tr").attr('data-keterangan', keterangan);

                $(this).parents("tr").find(".btn_delete").show();
                $(this).parents("tr").find(".btn_edit").show();
                $(this).parents("tr").find(".btn-cancel").remove();
                $(this).parents("tr").find(".btn-update").remove();
            });


            $("#tableresep6").on("click", ".btn_edit", function() {

                $(this).parents("tr").find("td:eq(3)").html('<input name="edit_aturanpakai" value="' + $(this).parents("tr").attr('data-aturanpakai') + '">');


                $(this).parents("tr").find("td:eq(4)").prepend(
                    '<button class="btn btn-success btn-sm btn-update"><i class="bi bi-check2"></i></button>' +
                    '<button class="btn btn-danger btn-sm btn-cancel"><i class="bi bi-x-lg"></i></button>')

                $(this).parents("tr").find(".btn_edit").hide();
                $(this).parents("tr").find(".btn_delete").hide();


            });

            $("#tableresep6").on("click", ".btn-update", function() {

                var aturanpakai = $(this).parents("tr").find("input[name='edit_aturanpakai']").val();
                $(this).parents("tr").find("td:eq(3)").text(aturanpakai);
                $(this).parents("tr").attr('data-aturanpakai', aturanpakai);

                $(this).parents("tr").find(".btn_delete").show();
                $(this).parents("tr").find(".btn_edit").show();
                $(this).parents("tr").find(".btn-cancel").remove();
                $(this).parents("tr").find(".btn-update").remove();
            });


            $("#tableresep7").on("click", ".btn_edit", function() {

                $(this).parents("tr").find("td:eq(2)").html('<input name="edit_aturanpakai" value="' + $(this).parents("tr").attr('data-aturanpakai') + '">');


                $(this).parents("tr").find("td:eq(3)").prepend(
                    '<button class="btn btn-success btn-sm btn-update"><i class="bi bi-check2"></i></button>' +
                    '<button class="btn btn-danger btn-sm btn-cancel"><i class="bi bi-x-lg"></i></button>')

                $(this).parents("tr").find(".btn_edit").hide();
                $(this).parents("tr").find(".btn_delete").hide();


            });

            $("#tableresep7").on("click", ".btn-update", function() {

                var aturanpakai = $(this).parents("tr").find("input[name='edit_aturanpakai']").val();
                $(this).parents("tr").find("td:eq(2)").text(aturanpakai);
                $(this).parents("tr").attr('data-aturanpakai', aturanpakai);

                $(this).parents("tr").find(".btn_delete").show();
                $(this).parents("tr").find(".btn_edit").show();
                $(this).parents("tr").find(".btn-cancel").remove();
                $(this).parents("tr").find(".btn-update").remove();
            });

            // e.preventDefault();

            $("#aturanpakai2").select2({
                ajax: {
                    url: "/data/getaturanpakai",
                    type: "POST",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: false,
                },
                tags: true,
                escapeMarkup: function(markup) {
                    return markup;
                },
                dropdownParent: $("#modalEditItemresep"),
                theme: "bootstrap-5",
                closeOnSelect: true
            });

            $("#barang").select2({
                ajax: {
                    url: "/permintaan/getDataobat",
                    type: "POST",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: false,
                },
                minimumInputLength: 2,
                escapeMarkup: function(markup) {
                    return markup;
                },
                dropdownParent: $("#modalAddBarang"),
                theme: "bootstrap-5",
                closeOnSelect: true
            }).on('select2:select', function(event) {
                var data = event.params.data;
                $("#kodebarang").val(data.obat.kode_brng);
                $("#namabarang").val(data.obat.nama_brng);
                $(".lbljumlah").html(data.obat.kode_sat);

                $.ajax({
                    url: "/permintaan/getDetailbarang",
                    type: 'POST',
                    data: {

                        kode_brng: $("#kodebarang").val(),
                        dari: $("#dari").val(),
                        tujuan: $('#tujuan').val(),

                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.code == 200) {
                            $("#stokunit").val(response.stokasal)
                            $("#stoktujuan").val(response.stoktujuan)
                        }

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            });
        })

        function getResep() {
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });

            $.ajax({
                url: "/resep/getResep",
                type: 'POST',
                data: {
                    from: $('#datepickerFrom1').val(),
                    to: $('#datepickerTO1').val()
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        $("#tableResep1").DataTable().destroy()
                        var Table = $('#tableResep1').dataTable({
                            "aaData": response.resep_ralan,
                            "columns": [{
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.no_resep + '<br>'
                                        if (data.stts_resep == 'Belum Terlayani') {
                                            result += '<span class="badge bg-danger">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sedang di Proses') {
                                            result += '<span class="badge bg-warning">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sudah Divalidasi') {
                                            result += '<span class="badge bg-warning">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sudah Terlayani') {
                                            result += '<span class="badge bg-success">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Selesai') {
                                            result += '<span class="badge bg-success">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Batal') {
                                            result += '<span class="badge bg-danger">' + data
                                                .stts_resep + '</span>';
                                        }
                                        return result;

                                    },
                                },
                                {
                                    "data": "tgl_peresepan"
                                },
                                {
                                    "data": "jam_peresepan"
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += '<a  id="btnNorawat" class="btnNorawat"';
                                        result += 'data-noresep="' + data.no_resep + '"';
                                        result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                        result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                        result += 'data-norawat="' + data.no_rawat + '"';
                                        result += 'data-nmdokter="' + data.nm_dokter + '"';
                                        result += 'data-nmpoli="' + data.nm_poli + '"';
                                        result += 'data-norkmmedis="' + data.no_rkm_medis + '"';
                                        result += 'data-nmpasien="' + data.nm_pasien + '"';
                                        result += 'data-jamregistrasi="' + data.jam_registrasi + '"';
                                        result += 'data-tglregistrasi="' + data.tgl_registrasi + '"';
                                        result += 'data-statusrawat="Ralan"';
                                        result += '>' + data.no_rawat + '</a>';

                                        if(data.kd_poli == 'OKMAT' || data.kd_poli == 'OKBED') {
                                            result += '<span class="badge" style="background-color: blueviolet;">ODC</span>';
                                        }

                                        return result
                                    },
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.no_rkm_medis + '<br>'
                                        result += data.nm_pasien
                                        return result;

                                    },
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.nm_dokter + '<br>'
                                        result += data.nm_poli
                                        return result;

                                    },
                                },
                                {
                                    "data": "png_jawab"
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += '<div class="btn-group mt-1 btn-group-sm" role="group" aria-label="Basic example">';
                                            
                                        // result += '<button type="button" id="btnView" class="btn btn-sm btn-warning btnView"';
                                        // result += 'data-noresep="' + data.no_resep + '"';
                                        // result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                        // result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                        // result += 'data-norawat="' + data.no_rawat + '"';
                                        // result += 'data-nmdokter="' + data.nm_dokter + '"';
                                        // result += 'data-nmpoli="' + data.nm_poli + '"';
                                        // result += '><i class="bi bi-display"></i></button>';

                                        if (data.stts_resep == 'Belum Terlayani' || data.stts_resep == 'Sudah Divalidasi') {

                                            result += '<button type="button" id="btnValidasi" class="btn btn-sm btn-success btnValidasi"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '><i class="bi bi-pencil"></i></button>';

                                            result += '<button type="button" id="btncopyresep" class="btn btn-sm btn-primary btncopyresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-kddokter="' + data.kd_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '><i class="bi bi-copy"></i></button>';

                                            result += '<button type="button" id="btnprintresep" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"';
                                            result += '><i class="bi bi-printer-fill"></i></button>';

                                            result += '<ul class="dropdown-menu dropdown-menu-dark">'

                                            result += '<li class="dropdown-item btnprintresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '>Print Resep</li>';

                                            result += '</ul>'

                                        } else if (data.stts_resep == 'Sudah Terlayani' || data.stts_resep == 'Sedang di Proses') {

                                            result += '<button type="button" id="btneditaturanpakai" class="btn btn-sm btn-primary btneditaturanpakai"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-kddokter="' + data.kd_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '><i class="bi bi-file-ruled-fill"></i></button>';

                                            result += '<button type="button" id="btncopyresep" class="btn btn-sm btn-primary btncopyresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-kddokter="' + data.kd_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '><i class="bi bi-copy"></i></button>';

                                            result += '<button type="button" id="btnprintresep" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"';
                                            result += '><i class="bi bi-printer-fill"></i></button>';

                                            result += '<ul class="dropdown-menu dropdown-menu-dark">'

                                            result += '<li class="dropdown-item btnprintresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '>Print Resep</li>';

                                            result += '<li class="dropdown-item btnprintetiket"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '>E-tiket</li>';

                                            result += '<li class="dropdown-item btnprintbilingresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '>Billing Resep</li>';

                                            result += '</ul>'

                                        } else if (data.stts_resep == 'Selesai') {
                                            result += '<button type="button" id="btncopyresep" class="btn btn-sm btn-primary btncopyresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-kddokter="' + data.kd_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '><i class="bi bi-copy"></i></button>';

                                            result += '<button type="button" id="btnprintresep" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"';
                                            result += '><i class="bi bi-printer-fill"></i></button>';

                                            result += '<ul class="dropdown-menu dropdown-menu-dark">'

                                            result += '<li class="dropdown-item btnprintresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '>Print Resep</li>';

                                            result += '<li class="dropdown-item btnprintetiket"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '>E-tiket</li>';

                                            result += '<li class="dropdown-item btnprintbilingresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '>Billing Resep</li>';

                                            result += '</ul>'

                                        } else if (data.stts_resep == 'Batal') {
                                            result += '<button type="button" id="btnprintresep" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"';
                                            result += '><i class="bi bi-printer-fill"></i></button>';

                                            result += '<ul class="dropdown-menu dropdown-menu-dark">'

                                            result += '<li class="dropdown-item btnprintresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '>Print Resep</li>';

                                            result += '</ul>'

                                        }
                                        result += '</div>'
                                        return result;

                                    },
                                },

                            ],
                            "retrieve": true,
                            "paging": true,
                            "lengthChange": false,
                            "searching": true,
                            "ordering": true,
                            "pageLength": 25,
                            "responsive": false,
                            "autoWidth": false,
                            "order": [
                                [2, 'desc'],
                                [3, 'desc']
                            ]
                        });


                        $("#tableResep2").DataTable().destroy()
                        var Table = $('#tableResep2').dataTable({
                            "aaData": response.resep_ranap,
                            "columns": [{
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.no_resep + '<br>'
                                        if (data.stts_resep == 'Belum Terlayani') {
                                            result += '<span class="badge bg-danger">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sedang di Proses') {
                                            result += '<span class="badge bg-warning">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sudah Divalidasi') {
                                            result += '<span class="badge bg-warning">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sudah Terlayani') {
                                            result += '<span class="badge bg-success">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Selesai') {
                                            result += '<span class="badge bg-success">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Batal') {
                                            result += '<span class="badge bg-danger">' + data
                                                .stts_resep + '</span>';
                                        }
                                        return result;

                                    },
                                },
                                {
                                    "data": "tgl_peresepan"
                                },
                                {
                                    "data": "jam_peresepan"
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += '<a  id="btnNorawat" class="btnNorawat"';
                                        result += 'data-noresep="' + data.no_resep + '"';
                                        result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                        result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                        result += 'data-norawat="' + data.no_rawat + '"';
                                        result += 'data-nmdokter="' + data.nm_dokter + '"';
                                        result += 'data-nmpoli="' + data.nm_poli + '"';
                                        result += 'data-norkmmedis="' + data.no_rkm_medis + '"';
                                        result += 'data-nmpasien="' + data.nm_pasien + '"';
                                        result += 'data-jamregistrasi="' + data.jam_registrasi + '"';
                                        result += 'data-tglregistrasi="' + data.tgl_registrasi + '"';
                                        result += 'data-statusrawat="Ralan"';
                                        result += '>' + data.no_rawat + '</a>';
                                        return result
                                    },
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.no_rkm_medis + '<br>'
                                        result += data.nm_pasien
                                        return result;

                                    },
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.nm_dokter + '<br>'
                                        result += data.nm_bangsal
                                        return result;

                                    },
                                },
                                {
                                    "data": "png_jawab"
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += '<div class="btn-group mt-1 btn-group-sm" role="group" aria-label="Basic example">';

                                        if (data.stts_resep == 'Belum Terlayani' || data.stts_resep == 'Sudah Divalidasi') {

                                            result += '<button type="button" id="btnValidasi" class="btn btn-sm btn-success btnValidasi"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '><i class="bi bi-pencil"></i></button>';

                                            result += '<button type="button" id="btncopyresep" class="btn btn-sm btn-primary btncopyresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-kddokter="' + data.kd_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '><i class="bi bi-copy"></i></button>';

                                            result += '<button type="button" id="btnprintresep" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"';
                                            result += '><i class="bi bi-printer-fill"></i></button>';

                                            result += '<ul class="dropdown-menu dropdown-menu-dark">'

                                            result += '<li class="dropdown-item btnprintresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '>Print Resep</li>';

                                            result += '</ul>'

                                        } else if (data.stts_resep == 'Sudah Terlayani' || data.stts_resep == 'Sedang di Proses') {

                                            result += '<button type="button" id="btneditaturanpakai" class="btn btn-sm btn-primary btneditaturanpakai"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-kddokter="' + data.kd_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '><i class="bi bi-file-ruled-fill"></i></button>';

                                            result += '<button type="button" id="btncopyresep" class="btn btn-sm btn-primary btncopyresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-kddokter="' + data.kd_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '><i class="bi bi-copy"></i></button>';

                                            result += '<button type="button" id="btnprintresep" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"';
                                            result += '><i class="bi bi-printer-fill"></i></button>';

                                            result += '<ul class="dropdown-menu dropdown-menu-dark">'

                                            result += '<li class="dropdown-item btnprintresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '>Print Resep</li>';

                                            result += '<li class="dropdown-item btnprintetiket"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '>E-tiket</li>';

                                            result += '<li class="dropdown-item btnprintbilingresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '>Billing Resep</li>';

                                            result += '</ul>'

                                        } else if (data.stts_resep == 'Selesai') {

                                            result += '<button type="button" id="btncopyresep" class="btn btn-sm btn-primary btncopyresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-kddokter="' + data.kd_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '><i class="bi bi-copy"></i></button>';

                                            result += '<button type="button" id="btnprintresep" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"';
                                            result += '><i class="bi bi-printer-fill"></i></button>';

                                            result += '<ul class="dropdown-menu dropdown-menu-dark">'

                                            result += '<li class="dropdown-item btnprintresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '>Print Resep</li>';

                                            result += '<li class="dropdown-item btnprintetiket"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '>E-tiket</li>';

                                            result += '<li class="dropdown-item btnprintbilingresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ranap"';
                                            result += '>Billing Resep</li>';

                                            result += '</ul>'

                                        } else if (data.stts_resep == 'Batal') {
                                            result += '<button type="button" id="btnprintresep" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"';
                                            result += '><i class="bi bi-printer-fill"></i></button>';

                                            result += '<ul class="dropdown-menu dropdown-menu-dark">'

                                            result += '<li class="dropdown-item btnprintresep"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '>Print Resep</li>';

                                            result += '</ul>'

                                        }
                                        result += '</div>'
                                        return result;

                                    },
                                },

                            ],
                            "retrieve": true,
                            "paging": true,
                            "lengthChange": false,
                            "searching": true,
                            "ordering": true,
                            "pageLength": 25,
                            "responsive": false,
                            "autoWidth": false,
                            "order": [
                                [2, 'desc'],
                                [3, 'desc']
                            ]
                        });

                        swal.close();

                    } else {

                        swal.close();
                    }
                },
                error: function(xhr, status, error) {

                    swal.close();
                    console.log(error);
                }
            })
        }

        $('#tableResep1').on('click', '.btnValidasi', function() {
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });
            $('#tableresep3 tbody').html('');
            $('#tableresep4 tbody').html('');

            $('#statusrawat').val($(this).data('statusrawat'));
            $('#noPerimtaaan').val($(this).data('noresep'));
            $('#tglPerimtaaan').val($(this).data('tglperesepan'));
            $('#jamPerimtaaan').val($(this).data('jamperesepan'));

            $('#norawat').val($(this).data('norawat'));

            $('#dokter').val($(this).data('nmdokter'));
            $('#poliklinik').val($(this).data('nmpoli'));

            $.ajax({
                url: "/resep/getitempermintaanobat",
                type: 'POST',
                data: {
                    no_resep: $(this).data('noresep'),
                    no_rawat: $(this).data('norawat'),
                    kd_bangsal: $('#depo').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {

                        $('#norm').val(response.pasien.no_rkm_medis);
                        $('#namapasien').val(response.pasien.nm_pasien);
                        $('#umur').val(response.pasien.umur);

                        if (response.diagnosa) {

                            $('#diagnosa').val((response.diagnosa.diagnosa != null ? response.diagnosa
                                .diagnosa : ''));
                        }

                        if (response.alergi_pasien) {
                            $('#alergi').val((response.alergi_pasien.alergi != null ? response
                                .alergi_pasien
                                .alergi : ''));
                            $('#bb').val((response.alergi_pasien.berat_badan != null ? response
                                .alergi_pasien
                                .berat_badan : ''));
                        }

                        if (response.list_obat) {
                            row = '';
                            for (let i = 0; i < response.list_obat.length; i++) {
                                row += '<tr id="obat' + (i + 1);
                                row += '" data-index="obat' + (i + 1);
                                row += '" data-kodebarang="' + response.list_obat[i].kode_brng;
                                row += '" data-namabrng="' + response.list_obat[i].nama_brng;
                                row += '" data-jumlah="' + response.list_obat[i].jml;
                                row += '" data-stok="' + response.list_obat[i].stok;
                                row += '" data-aturanpakai="' + (response.list_obat[i].aturan_pakai == '' ? response.list_obat[i].frekuensi : response.list_obat[i].aturan_pakai);
                                row += '" data-carapemberian="' + response.list_obat[i].cara_pemberian;
                                row += '" data-frekuensi="' + response.list_obat[i].frekuensi;
                                row += '" data-dosis="' + response.list_obat[i].dosis;
                                row += '" data-aturantambahan="' + response.list_obat[i].aturan_tambahan;
                                row += '" data-satuan="' + response.list_obat[i].kode_sat;
                                row += '" data-harga="' + response.list_obat[i].harga;
                                row += '" data-keterangan="' + '';
                                row += '">';

                                // row += '<td>' + (i + 1) + '</td>';
                                row += '<td class="text-primary fw-bold">' + response.list_obat[i].jml + '</td>';
                                row += '<td>' + response.list_obat[i].kode_brng + '</td>';
                                row += '<td>' + response.list_obat[i].nama_brng + '</td>';
                                row += '<td>' + response.list_obat[i].kode_sat + '</td>';
                                row += '<td class="text-primary fw-bold">' + response.list_obat[i].stok + '</td>';
                                row += '<td>' + (response.list_obat[i].aturan_pakai == '' ? response.list_obat[i].frekuensi : response.list_obat[i].aturan_pakai) + '</td>';
                                row += '<td>' + (response.list_obat[i].cara_pemberian != null ? response.list_obat[i].cara_pemberian : '-') + '</td>';
                                row += '<td>' + (response.list_obat[i].frekuensi != null ? response.list_obat[i].frekuensi : '-') + '</td>';
                                row += '<td>' + (response.list_obat[i].dosis != null ? response.list_obat[i].dosis : '-') + '</td>';
                                row += '<td>' + (response.list_obat[i].aturan_tambahan != null ? response.list_obat[i].aturan_tambahan : '-') + '</td>';
                                row += '<td></td>';
                                row += '<td>' + response.list_obat[i].harga + '</td>';
                                row += '<td hidden>' + response.list_obat[i].harga_beli + '</td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
                                row +=
                                    '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                            }

                            // console.log(row);

                            $('#tableresep3 tbody').append(row);
                        }

                        if (response.list_obat_racik.length > 0) {
                            row = '';
                            // $('#tableresep4 tbody').html('');
                            for (let i = 0; i < response.list_obat_racik.length; i++) {
                                // console.log(i);

                                row += '<tr id="obatracik' + (i + 1);
                                row += '" data-index="obatracik' + (i + 1);
                                row += '" data-kdracik="' + response.list_obat_racik[i].kd_racik;
                                row += '" data-namaracik="' + response.list_obat_racik[i].nama_racik;
                                row += '" data-jmldr="' + response.list_obat_racik[i].jml_dr;
                                row += '" data-metode="' + response.list_obat_racik[i].metode_racik;
                                row += '" data-aturanpakai="' + (response.list_obat_racik[i].aturan_pakai == '' ? response.list_obat_racik[i].frekuensi : response.list_obat_racik[i].aturan_pakai);
                                row += '" data-carapemberian="' + response.list_obat_racik[i].cara_beri;
                                row += '" data-frekuensi="' + response.list_obat_racik[i].frekuensi;
                                row += '" data-keterangan="' + response.list_obat_racik[i].keterangan;
                                row += '">';

                                row += '<td hidden>0</td>'; //0
                                row += '<td>' + response.list_obat_racik[i].no_racik + '</td>';
                                row += '<td class="text-primary fw-bold">' + response.list_obat_racik[i].jml_dr + '</td>';
                                row += '<td>' + response.list_obat_racik[i].kd_racik + '</td>';
                                row += '<td>' + response.list_obat_racik[i].nama_racik + '</td>';
                                row += '<td>' + response.list_obat_racik[i].metode_racik + '</td>';
                                row += '<td>' + (response.list_obat_racik[i].aturan_pakai == '' ? response.list_obat_racik[i].frekuensi : response.list_obat_racik[i].aturan_pakai) + '</td>';
                                row += '<td>' + (response.list_obat_racik[i].cara_beri != null ? response.list_obat_racik[i].cara_beri : '-') + '</td>';
                                row += '<td>' + (response.list_obat_racik[i].frekuensi != null ? response.list_obat_racik[i].frekuensi : '-') + '</td>';
                                row += '<td>' + (response.list_obat_racik[i].keterangan != null ? response.list_obat_racik[i].keterangan : '-') + '</td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn icon btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
                                // row +=
                                //     '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';

                                //item racik
                                for (let j = 0; j < response.list_obat_racik[i].dataObat.length; j++) {
                                    // console.log('J'+j);
                                    row += '<tr class="">';
                                    row += '<td hidden>1</td>';
                                    row += '<td class="text-white">' + response.list_obat_racik[i].no_racik + '</td>';
                                    row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].jml + '</td>';
                                    row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].kode_brng + '</td>';
                                    if (j == 0) {
                                        // row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].kode_brng + '</td>';
                                        row += '<td class="table-info fw-bold">List Obat :</td>';
                                    } else {
                                        row += '<td class="table-info"></td>';
                                    }
                                    // row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].nama_brng + '</td>';
                                    row += '<td colspan="3" class="table-info">';
                                    row += response.list_obat_racik[i].dataObat[j].nama_brng;
                                    row += ' ( Jumlah :  ' + response.list_obat_racik[i].dataObat[j].jml;
                                    row += '  Dosis :  ' + response.list_obat_racik[i].dataObat[j].kandungan + ' )';
                                    row += '</td>';
                                    row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].h_beli + '</td>';
                                    row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].utama + '</td>';
                                    row += '<td></td>';
                                    row += '</tr>';
                                }

                                // console.log(row);

                            }
                            $('#tableresep4 tbody').html(row);

                            swal.fire({
                                title: "Obat Racik",
                                text: "Terdapat Resep Racik",
                                icon: "info",
                            })

                            console.log('tres');


                            $('#tablistobat2').show();
                            // $(".secracik").addClass("active");
                            // $(".secnonracik").removeClass("active");

                        } else {
                            // $(".secnonracik").addClass("active");
                            // $(".secracik").removeClass("active");
                            $('#tablistobat2').hide();
                            swal.close();
                        }

                        $('#modalvalidasiresep').modal('show')
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        });

        $('#tableResep2').on('click', '.btnValidasi', function() {
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });
            $('#tableresep3 tbody').html('');
            $('#tableresep4 tbody').html('');

            $('#statusrawat').val($(this).data('statusrawat'));
            $('#noPerimtaaan').val($(this).data('noresep'));
            $('#tglPerimtaaan').val($(this).data('tglperesepan'));
            $('#jamPerimtaaan').val($(this).data('jamperesepan'));

            $('#norawat').val($(this).data('norawat'));

            $('#dokter').val($(this).data('nmdokter'));
            $('#poliklinik').val($(this).data('nmpoli'));

            $.ajax({
                url: "/resep/getitempermintaanobat",
                type: 'POST',
                data: {
                    no_resep: $(this).data('noresep'),
                    no_rawat: $(this).data('norawat'),
                    kd_bangsal: $('#depo').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {

                        $('#norm').val(response.pasien.no_rkm_medis);
                        $('#namapasien').val(response.pasien.nm_pasien);
                        $('#umur').val(response.pasien.umur);

                        if (response.diagnosa) {

                            $('#diagnosa').val((response.diagnosa.diagnosa != null ? response.diagnosa
                                .diagnosa : ''));
                        }

                        if (response.alergi_pasien) {
                            $('#alergi').val((response.alergi_pasien.alergi != null ? response
                                .alergi_pasien
                                .alergi : ''));
                            $('#bb').val((response.alergi_pasien.berat_badan != null ? response
                                .alergi_pasien
                                .berat_badan : ''));
                        }

                        if (response.list_obat) {
                            row = '';
                            for (let i = 0; i < response.list_obat.length; i++) {
                                row += '<tr id="obat' + (i + 1);
                                row += '" data-index="obat' + (i + 1);
                                row += '" data-kodebarang="' + response.list_obat[i].kode_brng;
                                row += '" data-namabrng="' + response.list_obat[i].nama_brng;
                                row += '" data-jumlah="' + response.list_obat[i].jml;
                                row += '" data-stok="' + response.list_obat[i].stok;
                                row += '" data-aturanpakai="' + (response.list_obat[i].aturan_pakai == '' ? response.list_obat[i].frekuensi : response.list_obat[i].aturan_pakai);
                                row += '" data-carapemberian="' + response.list_obat[i].cara_pemberian;
                                row += '" data-frekuensi="' + response.list_obat[i].frekuensi;
                                row += '" data-dosis="' + response.list_obat[i].dosis;
                                row += '" data-aturantambahan="' + response.list_obat[i].aturan_tambahan;
                                row += '" data-satuan="' + response.list_obat[i].kode_sat;
                                row += '" data-keterangan="' + '';
                                row += '">';

                                // row += '<td>' + (i + 1) + '</td>';
                                row += '<td class="text-primary fw-bold">' + response.list_obat[i].jml + '</td>';
                                row += '<td>' + response.list_obat[i].kode_brng + '</td>';
                                row += '<td>' + response.list_obat[i].nama_brng + '</td>';
                                row += '<td>' + response.list_obat[i].kode_sat + '</td>';
                                row += '<td class="text-primary fw-bold">' + response.list_obat[i].stok + '</td>';
                                row += '<td>' + (response.list_obat[i].aturan_pakai == '' ? response.list_obat[i].frekuensi : response.list_obat[i].aturan_pakai) + '</td>';
                                row += '<td>' + (response.list_obat[i].cara_pemberian != null ? response.list_obat[i].cara_pemberian : '-') + '</td>';
                                row += '<td>' + (response.list_obat[i].frekuensi != null ? response.list_obat[i].frekuensi : '-') + '</td>';
                                row += '<td>' + (response.list_obat[i].dosis != null ? response.list_obat[i].dosis : '-') + '</td>';
                                row += '<td>' + (response.list_obat[i].aturan_tambahan != null ? response.list_obat[i].aturan_tambahan : '-') + '</td>';
                                row += '<td></td>';
                                row += '<td>' + response.list_obat[i].harga + '</td>';
                                row += '<td hidden>' + response.list_obat[i].harga_beli + '</td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
                                row +=
                                    '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                            }

                            // console.log(row);

                            $('#tableresep3 tbody').append(row);
                        }

                        if (response.list_obat_racik.length > 0) {
                            row = '';
                            // $('#tableresep4 tbody').html('');
                            for (let i = 0; i < response.list_obat_racik.length; i++) {
                                // console.log(i);

                                row += '<tr id="obatracik' + (i + 1);
                                row += '" data-index="obatracik' + (i + 1);
                                row += '" data-kdracik="' + response.list_obat_racik[i].kd_racik;
                                row += '" data-namaracik="' + response.list_obat_racik[i].nama_racik;
                                row += '" data-jmldr="' + response.list_obat_racik[i].jml_dr;
                                row += '" data-metode="' + response.list_obat_racik[i].metode_racik;
                                row += '" data-aturanpakai="' + (response.list_obat_racik[i].aturan_pakai == '' ? response.list_obat_racik[i].frekuensi : response.list_obat_racik[i].aturan_pakai);
                                row += '" data-carapemberian="' + response.list_obat_racik[i].cara_beri;
                                row += '" data-frekuensi="' + response.list_obat_racik[i].frekuensi;
                                row += '" data-keterangan="' + response.list_obat_racik[i].keterangan;
                                row += '">';

                                row += '<td hidden>0</td>'; //0
                                row += '<td>' + response.list_obat_racik[i].no_racik + '</td>';
                                row += '<td class="text-primary fw-bold">' + response.list_obat_racik[i].jml_dr + '</td>';
                                row += '<td>' + response.list_obat_racik[i].kd_racik + '</td>';
                                row += '<td>' + response.list_obat_racik[i].nama_racik + '</td>';
                                row += '<td>' + response.list_obat_racik[i].metode_racik + '</td>';
                                row += '<td>' + (response.list_obat_racik[i].aturan_pakai == '' ? response.list_obat_racik[i].frekuensi : response.list_obat_racik[i].aturan_pakai) + '</td>';
                                row += '<td>' + (response.list_obat_racik[i].cara_beri != null ? response.list_obat_racik[i].cara_beri : '-') + '</td>';
                                row += '<td>' + (response.list_obat_racik[i].frekuensi != null ? response.list_obat_racik[i].frekuensi : '-') + '</td>';
                                row += '<td>' + (response.list_obat_racik[i].keterangan != null ? response.list_obat_racik[i].keterangan : '-') + '</td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn icon btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
                                // row +=
                                //     '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';

                                //item racik
                                for (let j = 0; j < response.list_obat_racik[i].dataObat.length; j++) {
                                    // console.log('J'+j);
                                    row += '<tr class="">';
                                    row += '<td hidden>1</td>';
                                    row += '<td class="text-white">' + response.list_obat_racik[i].no_racik + '</td>';
                                    row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].jml + '</td>';
                                    row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].kode_brng + '</td>';
                                    if (j == 0) {
                                        // row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].kode_brng + '</td>';
                                        row += '<td class="table-info fw-bold">List Obat :</td>';
                                    } else {
                                        row += '<td class="table-info"></td>';
                                    }
                                    // row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].nama_brng + '</td>';
                                    row += '<td colspan="3" class="table-info">';
                                    row += response.list_obat_racik[i].dataObat[j].nama_brng;
                                    row += ' ( Jumlah :  ' + response.list_obat_racik[i].dataObat[j].jml;
                                    row += '  Dosis :  ' + response.list_obat_racik[i].dataObat[j].kandungan + ' )';
                                    row += '</td>';
                                    row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].h_beli + '</td>';
                                    row += '<td class="text-white">' + response.list_obat_racik[i].dataObat[j].utama + '</td>';
                                    row += '<td></td>';
                                    row += '</tr>';
                                }

                                // console.log(row);

                            }
                            $('#tableresep4 tbody').html(row);

                            swal.fire({
                                title: "Obat Racik",
                                text: "Terdapat Resep Racik",
                                icon: "info",
                            })

                            console.log('tres');


                            $('#tablistobat2').show();
                            // $(".secracik").addClass("active");
                            // $(".secnonracik").removeClass("active");

                        } else {
                            // $(".secnonracik").addClass("active");
                            // $(".secracik").removeClass("active");
                            $('#tablistobat2').hide();
                            swal.close();
                        }

                        $('#modalvalidasiresep').modal('show')
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        });

        $('#tableResep1').on('click', '.btnNorawat', function() {
            $('#norawat9').val($(this).data('norawat'));
            $('#norm9').val($(this).data('norkmmedis'));
            $('#namapasien9').val($(this).data('nmpasien'));
            $('#dokter9').val($(this).data('nmdokter'));
            $('#poliklinik9').val($(this).data('nmpoli'));
            $('#tanggal9').val($(this).data('tglregistrasi'));
            $('#jam9').val($(this).data('jamregistrasi'));
            $('#tableresep9 tbody').html('');
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });

            $.ajax({
                url: "/data/getDataPemberianObat",
                type: 'POST',
                data: {
                    no_rawat: $(this).data('norawat'),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        if (response.data_pemberian_obat) {
                            var row = '';
                            var total = 0;
                            for (let i = 0; i < response.data_pemberian_obat.length; i++) {
                                row += '<tr id="pemberianobat' + (i + 1);
                                row += '" data-index="obatselesai' + (i + 1);
                                row += '" data-kodebarang="' + response.data_pemberian_obat[i].kode_brng;
                                row += '" data-nobatch="' + response.data_pemberian_obat[i].no_batch;
                                row += '" data-nofaktur="' + response.data_pemberian_obat[i].no_faktur;
                                row += '" data-noresep="' + response.data_pemberian_obat[i].no_resep;
                                row += '" data-norawat="' + response.data_pemberian_obat[i].no_rawat;
                                row += '">';

                                // row += '<td>' + (i + 1) + '</td>';

                                row += '<td>' + response.data_pemberian_obat[i].tgl_perawatan + '<br>' + response.data_pemberian_obat[i].jam + '</td>';
                                row += '<td>' + response.data_pemberian_obat[i].no_resep + '</td>';
                                row += '<td>' + response.data_pemberian_obat[i].kode_brng + '</td>';
                                row += '<td>' + response.data_pemberian_obat[i].nama_brng + '</td>';
                                row += '<td>';
                                row += '<span class="badge bg-light-success">' + response.data_pemberian_obat[i].no_batch + '</span>';
                                row += '<br>';
                                row += '<span class="badge bg-light-warning">' + response.data_pemberian_obat[i].no_faktur + '</span>';
                                row += '</td>';
                                row += '<td>' + response.data_pemberian_obat[i].jml + '</td>';
                                row += '<td>';
                                row += '<span class="badge bg-light-success">' + response.data_pemberian_obat[i].utama + '</span>';
                                row += '<br>';
                                row += '<span class="badge bg-light-warning">' + response.data_pemberian_obat[i].total + '</span>';
                                row += '</td>';
                                row += '<td>';
                                row += '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                // row += '<button class="btn btn-danger btn_delete btn-sm"><i class="bi bi-trash-fill"></i></button> ';
                                row += '<button class="btn btn-danger btnhapuspemberianobat btn-sm" id="btnhapuspemberianobat"';
                                row += ' data-kodebarang="' + response.data_pemberian_obat[i].kode_brng;
                                row += '" data-nobatch="' + response.data_pemberian_obat[i].no_batch;
                                row += '" data-nofaktur="' + response.data_pemberian_obat[i].no_faktur;
                                row += '" data-noresep="' + response.data_pemberian_obat[i].no_resep;
                                row += '" data-norawat="' + response.data_pemberian_obat[i].no_rawat;
                                row += '" data-jml="' + response.data_pemberian_obat[i].jml;
                                row += '"><i class="bi bi-trash-fill"></i></button>';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                                total += parseInt(response.data_pemberian_obat[i].total);
                                // console.log(row);                            
                            }
                            // row += '<tr>';
                            // row += '<td colspan="6" class="text-end">Total</td>';
                            // row += '<td colspan="2" class="text-start"><strong>' + total + '</strong></td>';
                            // row += '<td></td>';
                            // row += '</tr>';

                            $('#tableresep9 tbody').html(row);
                        }
                        $('#modalDatapemberiannObat').modal('show');
                    }
                    swal.close();
                },
                error: function(xhr, status, error) {
                    swal.close();
                    console.log(error);
                }
            })
        });

        $('#tableResep2').on('click', '.btnNorawat', function() {
            $('#norawat9').val($(this).data('norawat'));
            $('#norm9').val($(this).data('norkmmedis'));
            $('#namapasien9').val($(this).data('nmpasien'));
            $('#dokter9').val($(this).data('nmdokter'));
            $('#poliklinik9').val($(this).data('nmpoli'));
            $('#tanggal9').val($(this).data('tglregistrasi'));
            $('#jam9').val($(this).data('jamregistrasi'));
            $('#tableresep9 tbody').html('');
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });

            $.ajax({
                url: "/data/getDataPemberianObat",
                type: 'POST',
                data: {
                    no_rawat: $(this).data('norawat'),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        if (response.data_pemberian_obat) {
                            var row = '';
                            var total = 0;
                            for (let i = 0; i < response.data_pemberian_obat.length; i++) {
                                row += '<tr id="pemberianobat' + (i + 1);
                                row += '" data-index="obatselesai' + (i + 1);
                                row += '" data-kodebarang="' + response.data_pemberian_obat[i].kode_brng;
                                row += '" data-nobatch="' + response.data_pemberian_obat[i].no_batch;
                                row += '" data-nofaktur="' + response.data_pemberian_obat[i].no_faktur;
                                row += '" data-noresep="' + response.data_pemberian_obat[i].no_resep;
                                row += '" data-norawat="' + response.data_pemberian_obat[i].no_rawat;
                                row += '">';

                                // row += '<td>' + (i + 1) + '</td>';

                                row += '<td>' + response.data_pemberian_obat[i].tgl_perawatan + '<br>' + response.data_pemberian_obat[i].jam + '</td>';
                                row += '<td>' + response.data_pemberian_obat[i].no_resep + '</td>';
                                row += '<td>' + response.data_pemberian_obat[i].kode_brng + '</td>';
                                row += '<td>' + response.data_pemberian_obat[i].nama_brng + '</td>';
                                row += '<td>';
                                row += '<span class="badge bg-light-success">' + response.data_pemberian_obat[i].no_batch + '</span>';
                                row += '<br>';
                                row += '<span class="badge bg-light-warning">' + response.data_pemberian_obat[i].no_faktur + '</span>';
                                row += '</td>';
                                row += '<td>' + response.data_pemberian_obat[i].jml + '</td>';
                                row += '<td>';
                                row += '<span class="badge bg-light-success">' + response.data_pemberian_obat[i].utama + '</span>';
                                row += '<br>';
                                row += '<span class="badge bg-light-warning">' + response.data_pemberian_obat[i].total + '</span>';
                                row += '</td>';
                                row += '<td>';
                                row += '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                row += '<button class="btn btn-danger btn_delete btn-sm"><i class="bi bi-trash-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                                total += parseInt(response.data_pemberian_obat[i].total);
                                // console.log(row);                            
                            }
                            // row += '<tr>';
                            // row += '<td colspan="6" class="text-end">Total</td>';
                            // row += '<td colspan="2" class="text-start"><strong>' + total + '</strong></td>';
                            // row += '<td></td>';
                            // row += '</tr>';

                            $('#tableresep9 tbody').html(row);
                        }
                        $('#modalDatapemberiannObat').modal('show');
                    }
                    swal.close();
                },
                error: function(xhr, status, error) {
                    swal.close();
                    console.log(error);
                }
            })
        });

        $("#obatkronis1").change(function() {
            if (this.checked) {
                $('#tableresep3').find('tr').each(function(i) {
                    if (i == 0) {
                        $(this).find('th').eq(0).after(
                            '<th class="table-info col-1 colobatkronis">Jml Obat Kronis</th>');
                    }
                    $(this).find('td').eq(0).after(
                        '<td class="table-info col-1 colobatkronis"><input type="number" class="col-sm-12"></td>'
                    );
                });
            } else {
                $('#tableresep3').find('tr').each(function(i) {
                    $(this).find('.colobatkronis').remove();
                    // if (i == 0) {
                    //     // $(this).children("th:eq(1)").remove();
                    //     // $(this).find("th:eq(1)").remove();
                    //     $(this).find('th .colobatkronis').remove();
                    // } else {
                    //     $(this).find('td .colobatkronis').remove();
                    // }
                })
            }
        });

        $('#btnsavepermintaan').click(function(e) {
            var tipe = 1; //1=obat non racik; 2=obat racik 3=obat kronis
            // const perubahan = $('#perubahanresep').val().trim();    
            // if (perubahan === '') {
            //     Swal.fire({
            //         icon:'warning',
            //         title: 'Perubahan Resep Harus diisi',
            //         text: 'Silakan isi alasan atau catatan pada kolom perubahan resep',
            //     });
            //     return;
            // }
            // if (perubahan.length < 10) {
            //     Swal.fire({
            //         icon: 'warning',
            //         title: 'Terlalu Singkat',
            //         text: 'Minimal 10 karakter diperlukan untuk menjelaskan alasan perubahan resep.',
            //     });
            //     return;
            // }
            Swal.fire({
                target: document.getElementById('modalvalidasiresep'),
                title: 'Apa Anda Yakin?',
                text: "Periksa Kembali, Jumlah Obat yang sudah di input tidak bisa diubah maupun dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Yakin`,
                denyButtonText: `Periksa Kembali`,
            }).then((result) => {
                if (result.isConfirmed) {
                    swal.fire({
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        width: '140px',
                        didOpen: () => {
                            swal.showLoading();
                        }
                    });

                    arraylistitem = [];
                    if ($("#obatkronis1").is(':checked')) {
                        tipe = 3;
                        $("table.tableresep3 tbody tr").each(function(i) {
                            var arrayval = [];
                            // var key = ['kode', 'nama', 'stokasal', 'stoktujuan', 'jumlah', 'aksi'];              
                            $("td", this).each(function(j) {
                                if (j == 1) {
                                    arrayval.push($(this).find("input").val())
                                } else {
                                    arrayval.push($(this).text())
                                }
                            });
                            arraylistitem.push(arrayval);
                        });
                    } else {
                        tipe = 1;
                        $("table.tableresep3 tbody tr").each(function(i) {
                            var arrayval = [];
                            // var key = ['kode', 'nama', 'stokasal', 'stoktujuan', 'jumlah', 'aksi'];              
                            $("td", this).each(function(j) {
                                arrayval.push($(this).text())
                            });
                            arraylistitem.push(arrayval);
                        });
                    }
                    console.log(arraylistitem);


                    arraylistitemracik = [];
                    $("table.tableresep4 tbody tr").each(function(i) {
                        var arrayval = [];
                        // var key = ['kode', 'nama', 'stokasal', 'stoktujuan', 'jumlah', 'aksi'];              
                        $("td", this).each(function(j) {
                            arrayval.push($(this).text())
                        });
                        arraylistitemracik.push(arrayval);
                    });
                    console.log(arraylistitemracik);

                    $.ajax({
                        url: "/resep/postSimpanResep",
                        type: 'POST',
                        data: {

                            tipe: tipe,

                            no_rawat: $("#norawat").val(),
                            no_rkm_medis: $("#norm").val(),
                            no_resep: $("#noPerimtaaan").val(),
                            status_rawat: $("#statusrawat").val(),

                            depo: $("#depo").val(),

                            tgl_perawatan: $("#tglPerimtaaan").val(),
                            jam: $("#jamPerimtaaan").val(),

                            list_obat: arraylistitem,
                            list_obat_racik: arraylistitemracik,

                            perubahan_resep: $("#perubahanresep").val(),
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.code == 200) {
                                // console.log('test');

                                $('#perubahanresep').val('')
                                $('#modalvalidasiresep').modal('hide')
                                // swal.close();
                                swal.fire({
                                    title: "Berhasil",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then((result) => {
                                    // console.log('test');
                                    getResep()
                                });


                                // getResep()
                            } else {
                                // $('#modalvalidasiresep').modal('hide')
                                // swal.close();
                                swal.fire({
                                    title: "Gagal",
                                    text: response.mesagge == '' ?
                                        "Periksa Kembali data / Silahkan Hubungi SIMRS" : response.mesagge,
                                    icon: "error",
                                })


                            }

                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            // $('#modalvalidasiresep').modal('hide')
                            // Swal.close();
                            swal.fire({
                                title: "Gagal",
                                text: "Periksa Kembali data / Silahkan Hubungi SIMRS",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    })
                }
            })

        });


        $('#btnbatalpermintaan').click(function(e) {
            var tipe = 1; // 1=obat non racik; 2=obat racik; 3=obat kronis
            // console.log($('#perubahanresep').val());

            const perubahan = $('#perubahanresep').val().trim();

            if (perubahan === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perubahan Resep Harus Diisi',
                    text: 'Silakan isi alasan atau catatan pada kolom perubahan resep.',
                });
                $('#perubahanresep').focus();
                $("#perubahanresep").addClass("is-invalid");
                return;
            }

            if (perubahan.length < 10) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Terlalu Singkat',
                    text: 'Minimal 10 karakter diperlukan untuk menjelaskan alasan perubahan resep.',
                });
                $('#perubahanresep').focus();
                $("#perubahanresep").addClass("is-invalid");
                return;
            }

            Swal.fire({
                target: document.getElementById('modalvalidasiresep'),
                title: 'Batal Resep, Apa Anda Yakin ?',
                text: "Periksa kembali, resep yang sudah dibatalkan tidak bisa divalidasi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Yakin`,
                denyButtonText: `Periksa Kembali`,
            }).then((result) => {
                if (result.isConfirmed) {
                    swal.fire({
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        width: '140px',
                        didOpen: () => {
                            swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "/resep/postBatalResep",
                        type: 'POST',
                        data: {
                            no_rawat: $("#norawat").val(),
                            no_rkm_medis: $("#norm").val(),
                            no_resep: $("#noPerimtaaan").val(),
                            keterangan: $('#perubahanresep').val() // dikirim ke server
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.code == 200) {
                                $('#perubahanresep').val('');
                                $('#modalvalidasiresep').modal('hide');
                                swal.fire({
                                    title: "Berhasil",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    getResep();
                                });
                            } else {
                                swal.fire({
                                    title: "Gagal",
                                    text: response.mesagge == '' ?
                                        "Periksa kembali data / Silahkan hubungi SIMRS" : response.mesagge,
                                    icon: "error",
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            swal.fire({
                                title: "Gagal",
                                text: "Periksa kembali data / Silahkan hubungi SIMRS",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    });
                }
            });
        });


        num = 0
        $("#btnadddetailitemresep").click(function() {
            row = '';

            if ($('#inputbarang1').val() == '') {
                $('#inputbarang1').focus();
                $("#inputbarang1").addClass("is-invalid");
            } else if ($('#jumlah1').val() == 0 && $('#jumlah1').val() == '') {
                $('#jumlah1').focus();
                $("#jumlah1").addClass("is-invalid");
            } else {

                $('#obatkronis1').prop('checked', false);
                $('#obatkronis1').trigger("change");

                var markup = '<tr class="table-warning" id="addobat' + (num + 1) + '"' +
                    ' data-index="addobat' + (num + 1) +
                    '" data-kd_barang="' + $('#kodebarang1').val() +
                    '" data-jumlah="' + $('#jumlah1').val() +
                    '" data-aturanpakai="' + $('#aturanpakai1').val() +
                    '" data-caraBeri="' + $('#carapemberian1').val() +
                    '" data-dosis="' + $('#dosis1').val() +
                    '" data-frekuensi="' + $('#frekuensi1').val() +
                    '" data-aturanTambahan="' + $('#aturantambahan1').val() +
                    '" data-keterangan="' + $('#keterangan1').val() +
                    '">' +
                    '<td>' + $('#jumlah1').val() + '</td>' +
                    '<td>' + $('#kodebarang1').val() + '</td>' +
                    '<td>' + $('#namabarang1').val() + '</td>' +
                    '<td>' + $('#satuan1').val() + '</td>' +
                    '<td>' + $('#jumlahtotal').val() + '</td>' +
                    '<td>' + $('#aturanpakai1').val() + '</td>' +
                    '<td>' + $('#carapemberian1').val() + '</td>' +
                    '<td>' + $('#frekuensi1').val() + '</td>' +
                    '<td>' + $('#dosis1').val() + '</td>' +
                    '<td>' + $('#aturantambahan1').val() + '</td>' +
                    '<td>' + $('#keterangan1').val() + '</td>' +
                    '<td>' + $('#hargajual1').val() + '</td>' +
                    '<td hidden>' + $('#hargabeli1').val() + '</td>' +
                    '<td>' +
                    '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">' +
                    '<button type="button" class="btn btn-sm btn-success btn_edit" id="btn_edit"><i class="bi bi-pencil-fill"></i></button>' +
                    '<button type="button" class="btn btn-sm btn-danger btn_delete" id="btn_delete"><i class="bi bi-trash"></i></button>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';

                console.log(markup);


                $("#tableresep3 tbody").append(markup);
                $("#inputbarang1").val("-").trigger('change');
                $("#jumlahtotal").val('');
                $("#jumlah1").val('');
                $(".lbljumlah1").text('');
                $("#aturanpakai1").val('');
                $("#carapemberian1").val('');
                $("#frekuensi1").val('');
                $("#dosis1").val('');
                $("#aturantambahan1").val('');

                $('#modalNewItem').modal('hide');
            }

        });

        $('#modalvalidasiresep').on('hidden.bs.modal', function() {
            //   console.log('test');
            $('#obatkronis1').prop('checked', false);
            $('#obatkronis1').trigger("change");
        });

        $('#tableResep1').on('click', '.btneditaturanpakai', function() {
            $('#tableresep6 tbody').html('');
            $('#tableresep7 tbody').html('');

            $('#statusrawat2').val($(this).data('statusrawat'));
            $('#noPerimtaaan2').val($(this).data('noresep'));
            $('#tglPerimtaaan2').val($(this).data('tglperesepan'));
            $('#jamPerimtaaan2').val($(this).data('jamperesepan'));

            $('#norawat2').val($(this).data('norawat'));

            $('#dokter2').val($(this).data('nmdokter'));
            $('#poliklinik2').val($(this).data('nmpoli'));



            $.ajax({
                url: "/resep/getaturanpakai",
                type: 'POST',
                data: {
                    no_resep: $(this).data('noresep'),
                    no_rawat: $(this).data('norawat'),
                    kd_bangsal: $('#depo').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {

                        $('#norm2').val(response.pasien.no_rkm_medis);
                        $('#namapasien2').val(response.pasien.nm_pasien);

                        if (response.diagnosa) {

                            $('#diagnosa').val((response.diagnosa.diagnosa != null ? response.diagnosa
                                .diagnosa : ''));
                        }

                        if (response.alergi_pasien) {
                            $('#alergi').val((response.alergi_pasien.alergi != null ? response
                                .alergi_pasien
                                .alergi : ''));
                            $('#bb').val((response.alergi_pasien.berat_badan != null ? response
                                .alergi_pasien
                                .berat_badan : ''));
                        }

                        if (response.list_obat) {
                            row = '';
                            for (let i = 0; i < response.list_obat.length; i++) {
                                row += '<tr id="aturanpakai' + (i + 1);
                                row += '" data-index="obat' + (i + 1);
                                row += '" data-kodebarang="' + response.list_obat[i].kode_brng;
                                row += '" data-namabrng="' + response.list_obat[i].nama_brng;
                                row += '" data-aturanpakai="' + response.list_obat[i].aturan;
                                row += '">';

                                // row += '<td>' + (i + 1) + '</td>';

                                row += '<td hidden>' + response.list_obat[i].kode_brng + '</td>';
                                row += '<td>' + response.list_obat[i].nama_brng + '</td>';
                                row += '<td>' + response.list_obat[i].jml + '</td>';
                                row += '<td>' + response.list_obat[i].aturan + '</td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
                                // row +=
                                //     '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                            }

                            $('#tableresep6 tbody').append(row);
                        }

                        if (response.list_obat_racik) {

                            $('#tableresep7').show();

                            row = '';
                            for (let i = 0; i < response.list_obat_racik.length; i++) {
                                row += '<tr id="aturanpakai' + (i + 1);
                                row += '" data-index="obat' + (i + 1);
                                row += '" data-kodebarang="' + response.list_obat_racik[i].kd_racik;
                                row += '" data-namabrng="' + response.list_obat_racik[i].nama_racik;
                                row += '" data-aturanpakai="' + response.list_obat_racik[i].aturan;
                                row += '">';

                                // row += '<td>' + (i + 1) + '</td>';

                                row += '<td hidden>' + response.list_obat_racik[i].kd_racik + '</td>';
                                row += '<td>' + response.list_obat_racik[i].nama_racik + '</td>';
                                row += '<td>' + response.list_obat_racik[i].aturan + '</td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
                                // row +=
                                //     '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                            }

                            $('#tableresep7 tbody').html(row);
                        } else {
                            $('#tableresep7').hide();
                        }


                        $('#modaleditAturanPakai').modal('show')
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        });

        $('#tableResep1').on('click', '.btncopyresep', function() {
            // swal.fire({
            //     allowEscapeKey: false,
            //     allowOutsideClick: false,
            //     width: '140px',
            //     didOpen: () => {
            //         swal.showLoading();
            //     }
            // });
            $('#tableresep5 tbody').html('');

            $('#statusrawat5').val($(this).data('statusrawat'));
            $('#noPerimtaaan5').val($(this).data('noresep'));
            $('#tglPerimtaaan5').val($(this).data('tglperesepan'));
            $('#jamPerimtaaan5').val($(this).data('jamperesepan'));

            $('#norawat5').val($(this).data('norawat'));

            $('#kodedokter5').val($(this).data('kddokter'));
            $('#dokter5').val($(this).data('nmdokter'));
            $('#poliklinik5').val($(this).data('nmpoli'));

            $.ajax({
                url: "/resep/getitempermintaanobatcopy",
                type: 'POST',
                data: {
                    no_resep: $(this).data('noresep'),
                    no_rawat: $(this).data('norawat'),
                    kd_bangsal: $('#depo').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {

                        $('#norm5').val(response.pasien.no_rkm_medis);
                        $('#namapasien5').val(response.pasien.nm_pasien);
                        $('#umur5').val(response.pasien.umur);

                        if (response.diagnosa) {

                            $('#diagnosa5').val((response.diagnosa.diagnosa != null ? response.diagnosa
                                .diagnosa : ''));
                        }

                        if (response.alergi_pasien) {
                            $('#alergi5').val((response.alergi_pasien.alergi != null ? response
                                .alergi_pasien
                                .alergi : ''));
                            $('#bb5').val((response.alergi_pasien.berat_badan != null ? response
                                .alergi_pasien
                                .berat_badan : ''));
                        }


                        if (response.list_obat) {
                            row = '';
                            for (let i = 0; i < response.list_obat.length; i++) {
                                row += '<tr id="obat' + (i + 1);
                                row += '" data-index="obat' + (i + 1);
                                row += '" data-jumlah="' + response.list_obat[i].jml;
                                // row += '" data-stok="' + response.list_obat[i].stok;
                                // row += '" data-aturanpakai="' + (response.list_obat[i].aturan_pakai == '' ? response.list_obat[i].frekuensi : response.list_obat[i].aturan_pakai);
                                // row += '" data-carapemberian="' + response.list_obat[i].cara_pemberian;
                                // row += '" data-frekuensi="' + response.list_obat[i].frekuensi;
                                row += '" data-aturanpakai="' + '';
                                // row += '" data-aturantambahan="' + response.list_obat[i].aturan_tambahan;
                                // row += '" data-satuan="' + response.list_obat[i].kode_sat;
                                row += '" data-keterangan="' + '';
                                row += '">';

                                row += '<td>' + response.list_obat[i].jml + '</td>';
                                row += '<td>' + response.list_obat[i].jml + '</td>';
                                row += '<td>' + response.list_obat[i].kode_brng + '</td>';
                                row += '<td>' + response.list_obat[i].nama_brng + '</td>';
                                row += '<td>' + response.list_obat[i].kode_sat + '</td>';
                                row += '<td></td>';
                                row += '<td></td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn btn-sm btn-info btn_edit "><i class="bi bi-pencil-fill"></i></button> ';
                                row +=
                                    '<button class="btn btn-sm btn-danger btn_delete "><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                            }
                            // console.log(row);

                            $('#tableresep5 tbody').append(row);
                        }



                        $('#modalcopyresep').modal('show')
                    }
                    swal.close();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    // swal.close();    
                }
            })
        });

        $('#tableResep2').on('click', '.btneditaturanpakai', function() {
            $('#tableresep6 tbody').html('');
            $('#tableresep7 tbody').html('');

            $('#statusrawat2').val($(this).data('statusrawat'));
            $('#noPerimtaaan2').val($(this).data('noresep'));
            $('#tglPerimtaaan2').val($(this).data('tglperesepan'));
            $('#jamPerimtaaan2').val($(this).data('jamperesepan'));

            $('#norawat2').val($(this).data('norawat'));

            $('#dokter2').val($(this).data('nmdokter'));
            $('#poliklinik2').val($(this).data('nmpoli'));



            $.ajax({
                url: "/resep/getaturanpakai",
                type: 'POST',
                data: {
                    no_resep: $(this).data('noresep'),
                    no_rawat: $(this).data('norawat'),
                    kd_bangsal: $('#depo').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {

                        $('#norm2').val(response.pasien.no_rkm_medis);
                        $('#namapasien2').val(response.pasien.nm_pasien);

                        if (response.diagnosa) {

                            $('#diagnosa').val((response.diagnosa.diagnosa != null ? response.diagnosa
                                .diagnosa : ''));
                        }

                        if (response.alergi_pasien) {
                            $('#alergi').val((response.alergi_pasien.alergi != null ? response
                                .alergi_pasien
                                .alergi : ''));
                            $('#bb').val((response.alergi_pasien.berat_badan != null ? response
                                .alergi_pasien
                                .berat_badan : ''));
                        }

                        if (response.list_obat) {
                            row = '';
                            for (let i = 0; i < response.list_obat.length; i++) {
                                row += '<tr id="aturanpakai' + (i + 1);
                                row += '" data-index="obat' + (i + 1);
                                row += '" data-kodebarang="' + response.list_obat[i].kode_brng;
                                row += '" data-namabrng="' + response.list_obat[i].nama_brng;
                                row += '" data-aturanpakai="' + response.list_obat[i].aturan;
                                row += '">';

                                // row += '<td>' + (i + 1) + '</td>';

                                row += '<td hidden>' + response.list_obat[i].kode_brng + '</td>';
                                row += '<td>' + response.list_obat[i].nama_brng + '</td>';
                                row += '<td>' + response.list_obat[i].jml + '</td>';
                                row += '<td>' + response.list_obat[i].aturan + '</td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
                                // row +=
                                //     '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                            }

                            $('#tableresep6 tbody').append(row);
                        }

                        if (response.list_obat_racik) {

                            $('#tableresep7').show();

                            row = '';
                            for (let i = 0; i < response.list_obat_racik.length; i++) {
                                row += '<tr id="aturanpakai' + (i + 1);
                                row += '" data-index="obat' + (i + 1);
                                row += '" data-kodebarang="' + response.list_obat_racik[i].kd_racik;
                                row += '" data-namabrng="' + response.list_obat_racik[i].nama_racik;
                                row += '" data-aturanpakai="' + response.list_obat_racik[i].aturan;
                                row += '">';

                                // row += '<td>' + (i + 1) + '</td>';

                                row += '<td hidden>' + response.list_obat_racik[i].kd_racik + '</td>';
                                row += '<td>' + response.list_obat_racik[i].nama_racik + '</td>';
                                row += '<td>' + response.list_obat_racik[i].aturan + '</td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
                                // row +=
                                //     '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                            }

                            $('#tableresep7 tbody').append(row);
                        } else {
                            $('#tableresep7').hide();
                        }


                        $('#modaleditAturanPakai').modal('show')
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        });

        $('#tableResep2').on('click', '.btncopyresep', function() {
            // swal.fire({
            //     allowEscapeKey: false,
            //     allowOutsideClick: false,
            //     width: '140px',
            //     didOpen: () => {
            //         swal.showLoading();
            //     }
            // });
            $('#tableresep5 tbody').html('');

            $('#statusrawat5').val($(this).data('statusrawat'));
            $('#noPerimtaaan5').val($(this).data('noresep'));
            $('#tglPerimtaaan5').val($(this).data('tglperesepan'));
            $('#jamPerimtaaan5').val($(this).data('jamperesepan'));

            $('#norawat5').val($(this).data('norawat'));

            $('#kodedokter5').val($(this).data('kddokter'));
            $('#dokter5').val($(this).data('nmdokter'));
            $('#poliklinik5').val($(this).data('nmpoli'));

            $.ajax({
                url: "/resep/getitempermintaanobatcopy",
                type: 'POST',
                data: {
                    no_resep: $(this).data('noresep'),
                    no_rawat: $(this).data('norawat'),
                    kd_bangsal: $('#depo').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {

                        $('#norm5').val(response.pasien.no_rkm_medis);
                        $('#namapasien5').val(response.pasien.nm_pasien);
                        $('#umur5').val(response.pasien.umur);

                        if (response.diagnosa) {

                            $('#diagnosa5').val((response.diagnosa.diagnosa != null ? response.diagnosa
                                .diagnosa : ''));
                        }

                        if (response.alergi_pasien) {
                            $('#alergi5').val((response.alergi_pasien.alergi != null ? response
                                .alergi_pasien
                                .alergi : ''));
                            $('#bb5').val((response.alergi_pasien.berat_badan != null ? response
                                .alergi_pasien
                                .berat_badan : ''));
                        }


                        if (response.list_obat) {
                            row = '';
                            for (let i = 0; i < response.list_obat.length; i++) {
                                row += '<tr id="obat' + (i + 1);
                                row += '" data-index="obat' + (i + 1);
                                row += '" data-jumlah="' + response.list_obat[i].jml;
                                // row += '" data-stok="' + response.list_obat[i].stok;
                                // row += '" data-aturanpakai="' + (response.list_obat[i].aturan_pakai == '' ? response.list_obat[i].frekuensi : response.list_obat[i].aturan_pakai);
                                // row += '" data-carapemberian="' + response.list_obat[i].cara_pemberian;
                                // row += '" data-frekuensi="' + response.list_obat[i].frekuensi;
                                row += '" data-aturanpakai="' + '';
                                // row += '" data-aturantambahan="' + response.list_obat[i].aturan_tambahan;
                                // row += '" data-satuan="' + response.list_obat[i].kode_sat;
                                row += '" data-keterangan="' + '';
                                row += '">';

                                row += '<td>' + response.list_obat[i].jml + '</td>';
                                row += '<td>' + response.list_obat[i].jml + '</td>';
                                row += '<td>' + response.list_obat[i].kode_brng + '</td>';
                                row += '<td>' + response.list_obat[i].nama_brng + '</td>';
                                row += '<td>' + response.list_obat[i].kode_sat + '</td>';
                                row += '<td></td>';
                                row += '<td></td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn btn-sm btn-info btn_edit "><i class="bi bi-pencil-fill"></i></button> ';
                                row +=
                                    '<button class="btn btn-sm btn-danger btn_delete "><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                            }
                            // console.log(row);

                            $('#tableresep5 tbody').append(row);
                        }



                        $('#modalcopyresep').modal('show')
                    }
                    swal.close();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    // swal.close();    
                }
            })
        });

        // $('#tableResep1').on('click', '.btneditaturanpakai', function() {
        //     $('#tableresep6 tbody').html('');
        //     $('#tableresep7 tbody').html('');

        //     $('#statusrawat2').val($(this).data('statusrawat'));
        //     $('#noPerimtaaan2').val($(this).data('noresep'));
        //     $('#tglPerimtaaan2').val($(this).data('tglperesepan'));
        //     $('#jamPerimtaaan2').val($(this).data('jamperesepan'));

        //     $('#norawat2').val($(this).data('norawat'));

        //     $('#dokter2').val($(this).data('nmdokter'));
        //     $('#poliklinik2').val($(this).data('nmpoli'));



        //     $.ajax({
        //         url: "/resep/getaturanpakai",
        //         type: 'POST',
        //         data: {
        //             no_resep: $(this).data('noresep'),
        //             no_rawat: $(this).data('norawat'),
        //             kd_bangsal: $('#depo').val(),
        //         },
        //         dataType: 'json',
        //         success: function(response) {
        //             console.log(response);
        //             if (response.code == 200) {

        //                 $('#norm2').val(response.pasien.no_rkm_medis);
        //                 $('#namapasien2').val(response.pasien.nm_pasien);

        //                 if (response.diagnosa) {

        //                     $('#diagnosa').val((response.diagnosa.diagnosa != null ? response.diagnosa
        //                         .diagnosa : ''));
        //                 }

        //                 if (response.alergi_pasien) {
        //                     $('#alergi').val((response.alergi_pasien.alergi != null ? response
        //                         .alergi_pasien
        //                         .alergi : ''));
        //                     $('#bb').val((response.alergi_pasien.berat_badan != null ? response
        //                         .alergi_pasien
        //                         .berat_badan : ''));
        //                 }

        //                 if (response.list_obat) {
        //                     row = '';
        //                     for (let i = 0; i < response.list_obat.length; i++) {
        //                         row += '<tr id="aturanpakai' + (i + 1);
        //                         row += '" data-index="obat' + (i + 1);
        //                         row += '" data-kodebarang="' + response.list_obat[i].kode_brng;
        //                         row += '" data-namabrng="' + response.list_obat[i].nama_brng;
        //                         row += '" data-aturanpakai="' + response.list_obat[i].aturan;
        //                         row += '">';

        //                         // row += '<td>' + (i + 1) + '</td>';

        //                         row += '<td hidden>' + response.list_obat[i].kode_brng + '</td>';
        //                         row += '<td>' + response.list_obat[i].nama_brng + '</td>';
        //                         row += '<td>' + response.list_obat[i].jml + '</td>';
        //                         row += '<td>' + response.list_obat[i].aturan + '</td>';
        //                         row += '<td>';
        //                         row +=
        //                             '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
        //                         row +=
        //                             '<button class="btn btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
        //                         // row +=
        //                         //     '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
        //                         row += '</div';
        //                         row += '</td>';
        //                         row += '</tr>';
        //                     }

        //                     $('#tableresep6 tbody').append(row);
        //                 }

        //                 if (response.list_obat_racik) {

        //                     $('#tableresep7').show();

        //                     row = '';
        //                     for (let i = 0; i < response.list_obat_racik.length; i++) {
        //                         row += '<tr id="aturanpakai' + (i + 1);
        //                         row += '" data-index="obat' + (i + 1);
        //                         row += '" data-kodebarang="' + response.list_obat_racik[i].kd_racik;
        //                         row += '" data-namabrng="' + response.list_obat_racik[i].nama_racik;
        //                         row += '" data-aturanpakai="' + response.list_obat_racik[i].aturan;
        //                         row += '">';

        //                         // row += '<td>' + (i + 1) + '</td>';

        //                         row += '<td hidden>' + response.list_obat_racik[i].kd_racik + '</td>';
        //                         row += '<td>' + response.list_obat_racik[i].nama_racik + '</td>';
        //                         row += '<td>' + response.list_obat_racik[i].aturan + '</td>';
        //                         row += '<td>';
        //                         row +=
        //                             '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
        //                         row +=
        //                             '<button class="btn btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
        //                         // row +=
        //                         //     '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
        //                         row += '</div';
        //                         row += '</td>';
        //                         row += '</tr>';
        //                     }

        //                     $('#tableresep7 tbody').append(row);
        //                 } else {
        //                     $('#tableresep7').hide();
        //                 }


        //                 $('#modaleditAturanPakai').modal('show')
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.log(error);
        //         }
        //     })
        // });

        $('#tableresep9').on('click', '.btnhapuspemberianobat', function() {
            var table = $(this);
            Swal.fire({
                target: document.getElementById('modalDatapemberiannObat'),
                title: 'Apa Anda Yakin?',
                text: "Obat Yang Sudah Di hapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Yakin`,
                denyButtonText: `Periksa Kembali`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/resep/HapusDataPemberianObat",
                        type: 'POST',
                        data: {

                            no_resep: $(this).data('noresep'),
                            no_rawat: $(this).data('norawat'),

                            kode_brng: $(this).data('kodebarang'),
                            no_batch: $(this).data('nobatch'),
                            no_faktur: $(this).data('nofaktur'),
                            jml: $(this).data('jml'),
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.code == 200) {
                                swal.fire({
                                    title: "Berhasil",
                                    target: document.getElementById('modalDatapemberiannObat'),
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then((result) => {
                                    $(table).closest("tr").remove();
                                });
                            } else {
                                swal.fire({
                                    title: "Gagal",
                                    text: "Periksa Kembali data / Silahkan Hubungi SIMRS",
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 1000
                                })

                            }

                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            $('#modaleditAturanPakai').modal('hide')
                            // Swal.close();
                            swal.fire({
                                title: "Gagal",
                                text: "Periksa Kembali data / Silahkan Hubungi SIMRS",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    })

                }

            });

        });

        $('#btnsaveaturanpakai').click(function(e) {
            Swal.fire({
                target: document.getElementById('modaleditAturanPakai'),
                title: 'Apa Anda Yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Yakin`,
                denyButtonText: `Periksa Kembali`,
            }).then((result) => {
                if (result.isConfirmed) {
                    arraylistitem = [];
                    $("table.tableresep6 tbody tr").each(function(i) {
                        var arrayval = [];
                        // var key = ['kode', 'nama', 'stokasal', 'stoktujuan', 'jumlah', 'aksi'];              
                        $("td", this).each(function(j) {
                            arrayval.push($(this).text())
                        });
                        arraylistitem.push(arrayval);
                    });
                    console.log(arraylistitem);

                    arraylistitemracik = [];
                    $("table.tableresep7 tbody tr").each(function(i) {
                        var arrayval = [];
                        // var key = ['kode', 'nama', 'stokasal', 'stoktujuan', 'jumlah', 'aksi'];              
                        $("td", this).each(function(j) {
                            arrayval.push($(this).text())
                        });
                        arraylistitemracik.push(arrayval);
                    });
                    console.log(arraylistitemracik);


                    // if (arraylistitem.length != 0) {
                    swal.fire({
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        width: '140px',
                        didOpen: () => {
                            swal.showLoading();
                        }
                    });
                    $.ajax({
                        url: "/resep/postEditaturanpakai",
                        type: 'POST',
                        data: {

                            no_rawat: $("#norawat2").val(),
                            no_rkm_medis: $("#norm2").val(),
                            no_resep: $("#noPerimtaaan2").val(),

                            list_obat: arraylistitem,
                            list_obat_racik: arraylistitemracik,
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.code == 200) {
                                // console.log('test');

                                $('#modaleditAturanPakai').modal('hide')
                                // swal.close();
                                swal.fire({
                                    title: "Berhasil",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then((result) => {
                                    // console.log('test');
                                    window.open('{{ env('LINK_ERESULT') }}/ResultFarmasi/tiketAturanPakai/' + response.no_resep, '_blank');
                                    getResep()
                                });

                            } else {
                                $('#modaleditAturanPakai').modal('hide')
                                // swal.close();
                                swal.fire({
                                    title: "Gagal",
                                    text: "Periksa Kembali data / Silahkan Hubungi SIMRS",
                                    icon: "error",
                                }).then((result) => {
                                    getResep()
                                });


                            }

                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            $('#modaleditAturanPakai').modal('hide')
                            // Swal.close();
                            swal.fire({
                                title: "Gagal",
                                text: "Periksa Kembali data / Silahkan Hubungi SIMRS",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    })
                }
            })

        });

        $('#btnprinttempresep').click(function(e) {
            Swal.fire({
                target: document.getElementById('modalcopyresep'),
                title: 'Apa Anda Yakin?',
                text: "Periksa kembali, Resep ini tidak akan tersimpan apa anda yakin ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Yakin`,
                denyButtonText: `Periksa Kembali`,
            }).then((result) => {
                if (result.isConfirmed) {


                    arraylistitem = [];
                    $("table.tableresep5 tbody tr").each(function(i) {
                        var arrayval = [];
                        // var key = ['kode', 'nama', 'stokasal', 'stoktujuan', 'jumlah', 'aksi'];              
                        $("td", this).each(function(j) {
                            arrayval.push($(this).text())
                        });
                        arraylistitem.push(arrayval);
                    });
                    console.log(arraylistitem);


                    if (arraylistitem.length != 0) {
                        swal.fire({
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            width: '140px',
                            didOpen: () => {
                                swal.showLoading();
                            }
                        });
                        $.ajax({
                            url: "/resep/postSimpanCopyResep",
                            type: 'POST',
                            data: {

                                no_rawat: $("#norawat5").val(),
                                no_rkm_medis: $("#norm5").val(),
                                no_resep: $("#noPerimtaaan5").val(),
                                status_rawat: $("#statusrawat5").val(),

                                depo: $("#depo5").val(),

                                alergi: $("#alergi5").val(),

                                tgl_peresepan: $("#tglPerimtaaan5").val(),
                                jam_peresepan: $("#jamPerimtaaan5").val(),

                                nm_dokter: $("#dokter5").val(),
                                kd_dokter: $("#kodedokter5").val(),

                                list_obat: arraylistitem,
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.code == 200) {
                                    // console.log('test');

                                    $('#modalcopyresep').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Berhasil",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then((result) => {
                                        // console.log('test');
                                        getResep()
                                    });

                                    window.open('{{ env('LINK_ERESULT') }}/ResultFarmasi/copyResep/' + response.no_resep, '_blank');
                                } else {
                                    $('#modalcopyresep').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Gagal",
                                        text: "Periksa Kembali data / Silahkan Hubungi SIMRS",
                                        icon: "error",
                                    }).then((result) => {
                                        getResep()
                                    });


                                }

                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                $('#modalcopyresep').modal('hide')
                                // Swal.close();
                                swal.fire({
                                    title: "Gagal",
                                    text: "Periksa Kembali data / Silahkan Hubungi SIMRS",
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })
                    } else {
                        swal.fire({
                            title: "Gagal",
                            text: "List obat tidak boleh kosong",
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }



                }
            })

        });

        $('#tableResep1').on('click', '.btnprintresep', function() {
            // console.log("AWdawdawd");
            window.open('{{ env('LINK_ERESULT') }}/ResultResep/resultNoEresep/' + $(this).data('noresep'),
                '_blank');
        });

        $('#tableResep1').on('click', '.btnprintetiket', function() {
            // console.log("AWdawdawd");
            window.open('{{ env('LINK_ERESULT') }}/ResultFarmasi/tiketAturanPakai/' + $(this).data('noresep'),
                '_blank');
        });

        $('#tableResep1').on('click', '.btnprintbilingresep', function() {
            // console.log("AWdawdawd");
            window.open('{{ env('LINK_ERESULT') }}/ResultResep/resultBilingNoResep/' + $(this).data('noresep'),
                '_blank');
        });

        $('#tableResep2').on('click', '.btnprintresep', function() {
            // console.log("AWdawdawd");
            window.open('{{ env('LINK_ERESULT') }}/ResultResep/resultNoEresep/' + $(this).data('noresep'),
                '_blank');
        });

        $('#tableResep2').on('click', '.btnprintetiket', function() {
            // console.log("AWdawdawd");
            window.open('{{ env('LINK_ERESULT') }}/ResultFarmasi/tiketAturanPakai/' + $(this).data('noresep'),
                '_blank');
        });

        $('#tableResep2').on('click', '.btnprintbilingresep', function() {
            // console.log("AWdawdawd");
            window.open('{{ env('LINK_ERESULT') }}/ResultResep/resultBilingNoResep/' + $(this).data('noresep'),
                '_blank');
        });

        $('#btnCari').click(function(e) {
            getResep();
        })
    </script>
@endsection
