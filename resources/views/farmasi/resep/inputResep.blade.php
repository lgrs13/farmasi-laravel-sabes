@extends('layouts.main')

@section('title')
    <title>Transaksi | Input Resep</title>
@endsection

@section('content')
    <section class="section row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="home" aria-selected="true">Input Resep</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="profile" aria-selected="false">History</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="home-tab">

                            <div class="card bg-light-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xs-4 col-md-4">
                                            <div class="form-group">
                                                <label for="" class="text-white">-</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Dari
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control form-control-sm" id="datepickerFrom1" name="datepickerFrom1" {{--
                                                    value="{{ date('Y-m-d', strtotime('-7 days')) }}"> --}} value="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <div class="form-group">
                                                <label for="" class="text-white">-</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Sampai
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control form-control-sm" id="datepickerTO1" name="datepickerTO1" value="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <div class="form-group">

                                                <label for="" class="text-white">-</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        Jenis
                                                    </span>
                                                    <select class="form-control form-control-sm" id="jenisrawat">
                                                        <option value="Poliklinik">Poliklinik</option>
                                                        <option value="IGD">IGD</option>
                                                        <option value="Rawat Inap">Rawat Inap</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-12 secstatusranap">
                                            <div class="form-group">

                                                <label for="" class="text-white">-</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        Status
                                                    </span>
                                                    <select class="form-control form-control-sm" id="statusranap">
                                                        <option value="Belum Pulang" selected>Belum Pulang</option>
                                                        <option value="Pulang">Pulang</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="btn-group float-end" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-primary" id="btnAdd"><i class="bi bi-plus"></i></button>
                                                <button type="button" class="btn btn-warning" id="btnCari"><i class="bi bi-search"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive datatable-minimal ">
                                <table class="table" id="tableResep1">
                                    <thead>
                                        <tr>
                                            <th>No. Rawat</th>
                                            <th>Tgl. Jam Rawat</th>
                                            <th>Pasien</th>
                                            <th>Dokter</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card bg-light-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group">
                                                <label for="" class="text-white">-</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Dari
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control form-control-sm" id="datepickerFrom2" name="datepickerFrom2" {{--
                                                    value="{{ date('Y-m-d', strtotime('-7 days')) }}"> --}} value="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6">
                                            <div class="form-group">
                                                <label for="" class="text-white">-</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Sampai
                                                        </span>
                                                    </div>
                                                    <input type="date" class="form-control form-control-sm" id="datepickerTO2" name="datepickerTO2" value="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="btn-group float-end" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-warning" id="btnCari2"><i class="bi bi-search"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive datatable-minimal ">
                                <table class="table" id="tableResep3">
                                    <thead>
                                        <tr>
                                            <th>No. Rawat</th>
                                            <th>No. Resep</th>
                                            <th>Tgl. Jam Resep</th>
                                            <th>Pasien</th>
                                            <th>Dokter</th>
                                            <th>Status</th>
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

    <div class="modal fade text-left" id="modalinputresep" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false" data-bs-backdrop="false" tabindex="-1">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel140">
                        Input Resep
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Tgl. Resep</label>
                                <input type="date" value="{{ date('Y-m-d') }}" class="form-control form-control-sm" id="tglresep1">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Jam Resep</label>
                                <input type="time" value="{{ date('H:i:s') }}" class="form-control form-control-sm" id="jamresep1">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Antrian (Estimasi)</label>
                                <input type="text" class="form-control form-control-sm" id="antrian1">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Status</label>
                                <input type="text" class="form-control form-control-sm" id="status1" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Dokter</label>
                                <select class="form-control form-control-sm" id="dokter1">
                                    <option value="-" selected>Masukan Dokter Peresep</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Depo</label>
                                <select class="form-control form-control-sm" id="depo1">
                                    <option value="A1" selected>Apotek</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">No. Rawat</label>
                                <input type="text" class="form-control form-control-sm" id="norawat1" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">No. RM</label>
                                <input type="text" class="form-control form-control-sm" id="norm1" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nama Pasien</label>
                                <input type="text" class="form-control form-control-sm" id="namapasien1" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary">
                        <div class="card-header">
                            <span class="card-title">List Obat</span>
                        </div>
                        <div class="card-body">
                            <div class="table-border-style">
                                <div class="" style="min-height: 200px; max-height: 200px; overflow: auto;">
                                    <table class="table tableresep2" id="tableresep2">
                                        <thead>
                                            <tr>
                                                <th>Jumlah</th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Satuan</th>
                                                <th>Stok</th>
                                                <th>Catatan Resep</th>
                                                <th>Cara Pemberian</th>
                                                <th>Frekuensi</th>
                                                <th>Dosis</th>
                                                <th>Aturan Tambahan</th>
                                                <th hidden>Harga</th>
                                                <th hidden>Harga Beli</th>
                                                <th>
                                                    <button type="button" class="btn icon btn-primary icon-left" id="addobat"><i class="bi bi-plus-circle"></i></button>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
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

                        <div class="col-sm-8 col-md-8" hidden>
                            <div class="form-group">
                                <label for="basicInput">Harga Beli</label>
                                <input type="text" class="form-control form-control-sm" id="hargabeli1" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-8" hidden>
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
@endsection

@section('script')
    <script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/static/js/pages/datatables.js"></script>

    <script>
        $(document).ready(function(e) {

            $('.secstatusranap').hide()
            $('#jenisrawat').on('change', function() {
                if (this.value == 'Rawat Inap') {
                    $('.secstatusranap').show()
                    $('#datepickerTO1').prop('disabled', true);
                    $('#datepickerFrom1').prop('disabled', true);
                } else {
                    $('.secstatusranap').hide()
                    $('#datepickerTO1').prop('disabled', false);
                    $('#datepickerFrom1').prop('disabled', false);
                }
            });

            $('#statusranap').on('change', function() {
                if (this.value == 'Pulang') {
                    $('#datepickerTO1').prop('disabled', false);
                    $('#datepickerFrom1').prop('disabled', false);
                } else {
                    $('#datepickerTO1').prop('disabled', true);
                    $('#datepickerFrom1').prop('disabled', true);

                }
            });

            getPerawtan();
            getHistoryResep();

            $("#btnadddetailitemresep").click(function() {
                row = '';

                if ($('#inputbarang1').val() == '') {
                    $('#inputbarang1').focus();
                    $("#inputbarang1").addClass("is-invalid");
                } else if ($('#jumlah1').val() == 0 && $('#jumlah1').val() == '') {
                    $('#jumlah1').focus();
                    $("#jumlah1").addClass("is-invalid");
                } else {

                    var markup = '<tr class="table-warning' +
                        'data-kd_barang="' + $('#kodebarang1').val() +
                        '" data-jumlah="' + $('#jumlah1').val() +
                        '" data-aturanpakai="' + $('#aturanpakai1').val() +
                        '" data-caraBeri="' + $('#carapemberian1').val() +
                        '" data-dosis="' + $('#dosis1').val() +
                        '" data-frekuensi="' + $('#frekuensi1').val() +
                        '" data-aturanTambahan="' + $('#aturantambahan1').val() +
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
                        '<td hidden>' + $('#hargabeli1').val() + '</td>' +
                        '<td hidden>' + $('#hargajual1').val() + '</td>' +
                        '<td>' +
                        '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">' +
                        '<button type="button" class="btn btn-sm btn-success btn_edit" id="btn_edit"><i class="bi bi-pencil-fill"></i></button>' +
                        '<button type="button" class="btn btn-sm btn-danger btn_delete" id="btn_delete"><i class="bi bi-trash"></i></button>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';

                    $("#tableresep2 tbody").append(markup);
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

            $('#tableresep2').on('click', '.btn_delete', function() {
                $(this).closest("tr").remove();
            });

            $("#tableresep2").on("click", ".btn_edit", function() {

                $(this).parents("tr").find("td:eq(0)").html(
                    '<input style="width: 100%;" name="edit_jumlah" value="' + $(this).parents("tr")
                    .attr('data-jumlah') + '">');
                $(this).parents("tr").find("td:eq(5)").html(
                    '<input style="width: 100%;" name="edit_aturanpakai" value="' + $(this).parents(
                        "tr").attr('data-aturanpakai') + '">');
                $(this).parents("tr").find("td:eq(6)").html(
                    '<select style="width: 100%;" name="edit_caraBeri" class="form-control">' +
                    '<option ' + ($(this).parents("tr").attr('data-caraBeri') == 'Oral' ? ' selected ' :
                        null) + ' value="Oral">Oral</option>' +
                    '<option ' + ($(this).parents("tr").attr('data-caraBeri') == 'IM' ? ' selected ' :
                        null) + ' value="IM">IM</option>' +
                    '<option ' + ($(this).parents("tr").attr('data-caraBeri') == 'Infus' ?
                        ' selected ' : null) + ' value="Infus">Infus</option>' +
                    '<option ' + ($(this).parents("tr").attr('data-caraBeri') == 'Subkutan' ?
                        ' selected ' : null) + ' value="Subkutan">Subkutan</option>' +
                    '<option ' + ($(this).parents("tr").attr('data-caraBeri') == 'IV' ? ' selected ' :
                        null) + ' value="IV">IV</option>' +
                    '<option ' + ($(this).parents("tr").attr('data-caraBeri') == 'Suppositoria' ?
                        ' selected ' : null) + ' value="Suppositoria">Suppositoria</option>' +
                    '<option ' + ($(this).parents("tr").attr('data-caraBeri') == 'Topikal' ?
                        ' selected ' : null) + ' value="Topikal">Topikal</option>' +
                    '<option ' + ($(this).parents("tr").attr('data-caraBeri') == 'Inhalasi' ?
                        ' selected ' : null) + ' value="Inhalasi">Inhalasi</option>' +
                    '<option ' + ($(this).parents("tr").attr('data-caraBeri') == 'Lain - lain' ?
                        ' selected ' : null) + ' value="Lain - lain">Lain - lain</option>' +
                    '</select>');

                $(this).parents("tr").find("td:eq(7)").html(
                    '<input style="width: 100%;" name="edit_dosis" value="' + $(this).parents("tr")
                    .attr('data-dosis') + '">');
                $(this).parents("tr").find("td:eq(8)").html(
                    '<input style="width: 100%;" name="edit_frekuensi" value="' + $(this).parents("tr")
                    .attr('data-frekuensi') + '">');
                $(this).parents("tr").find("td:eq(9)").html(
                    '<input style="width: 100%;" name="edit_aturanTambahan" value="' + $(this).parents(
                        "tr").attr('data-aturanTambahan') + '">');

                $(this).parents("tr").find("td:eq(12)").prepend(
                    '<button class="btn btn-success btn-sm btn-update"><i class="bi bi-check-lg"></i></button>' +
                    '<button class="btn btn-danger btn-sm btn-cancel"><i class="bi bi-x"></i></button>')

                $(this).hide();
                $(this).parents("tr").find(".btn_delete").hide();


            });

            $("#tableresep2").on("click", ".btn-update", function() {

                var jumlah = $(this).parents("tr").find("input[name='edit_jumlah']").val();
                var aturanpakai = $(this).parents("tr").find("input[name='edit_aturanpakai']").val();
                var caraBeri = $(this).parents("tr").find("select[name='edit_caraBeri']").val();
                var dosis = $(this).parents("tr").find("input[name='edit_dosis']").val();
                var frekuensi = $(this).parents("tr").find("input[name='edit_frekuensi']").val();
                var aturanTambahan = $(this).parents("tr").find("input[name='edit_aturanTambahan']").val();

                // console.log(caraBeri);

                $(this).parents("tr").find("td:eq(0)").text(jumlah);
                $(this).parents("tr").find("td:eq(5)").text(aturanpakai);
                $(this).parents("tr").find("td:eq(6)").text(caraBeri);
                $(this).parents("tr").find("td:eq(7)").text(dosis);
                $(this).parents("tr").find("td:eq(8)").text(frekuensi);
                $(this).parents("tr").find("td:eq(9)").text(aturanTambahan);

                $(this).parents("tr").attr('data-jumlah', jumlah);
                $(this).parents("tr").attr('data-aturanpakai', aturanpakai);
                $(this).parents("tr").attr('data-caraBeri', caraBeri);
                $(this).parents("tr").attr('data-dosis', dosis);
                $(this).parents("tr").attr('data-frekuensi', frekuensi);
                $(this).parents("tr").attr('data-aturanTambahan', aturanTambahan);

                $(this).parents("tr").find(".btn_delete").show();
                $(this).parents("tr").find(".btn_edit").show();
                $(this).parents("tr").find(".btn-cancel").remove();
                $(this).parents("tr").find(".btn-update").remove();
            });

            $("#dokter1").select2({
                ajax: {
                    url: "/data/getDokterAlls2",
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
                escapeMarkup: function(markup) {
                    return markup;
                },
                dropdownParent: $("#modalinputresep"),
                theme: "bootstrap-5",
                closeOnSelect: true
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


        });

        function getPerawtan() {
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });

            $.ajax({
                url: "/resepManual/getPerawtan",
                type: 'POST',
                data: {
                    from: $('#datepickerFrom1').val(),
                    to: $('#datepickerTO1').val(),
                    jenisrawat: $('#jenisrawat').val(),
                    statusranap: $('#statusranap').val()
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        $("#tableResep1").DataTable().destroy()
                        var Table = $('#tableResep1').dataTable({
                            "aaData": response.data_pasien,
                            "columns": [{
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
                                        result += data.tanggal + '<br>'
                                        result += data.jam
                                        return result;

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
                                        result +=
                                            '<div class="btn-group mt-1 btn-group-sm" role="group" aria-label="Basic example">';
                                        result +=
                                            '<button type="button" id="btnValidasi" class="btn btn-success btnValidasi"';
                                        result += 'data-norawat="' + data.no_rawat + '"';
                                        result += 'data-norkmmedis="' + data.no_rkm_medis + '"';
                                        result += 'data-nama="' + data.nm_pasien + '"';
                                        result += 'data-statuslanjut="' + data.status_lanjut +
                                            '"';
                                        result += '><i class="bi bi-pencil"></i></button>';
                                        result += '</div>';
                                        return result;

                                    },
                                }

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

        function getHistoryResep() {
            $.ajax({
                url: "/resepManual/getHistoryResep",
                type: 'POST',
                data: {
                    from: $('#datepickerFrom2').val(),
                    to: $('#datepickerTO2').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        $("#tableResep3").DataTable().destroy()
                        var Table = $('#tableResep3').dataTable({
                            "aaData": response.data_resep,
                            "columns": [{
                                    "data": "no_rawat"
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.no_resep + '<br>'
                                        result += '<span class="badge bg-success">' + data
                                            .stts_resep + '</span>';
                                        return result;

                                    },
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.tanggal + '<br>'
                                        result += data.jam
                                        return result;

                                    },
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.no_rkm_medis + '<br>'
                                        result += '<b>' + data.nm_pasien + '</b>'
                                        return result;

                                    },
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.nm_dokter + '<br>'
                                        result += data.asal
                                        return result;

                                    },
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.png_jawab + '<br>'
                                        result += '<span class="badge bg-primary">' + data
                                            .status + '</span>';
                                        return result;

                                    },
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += '<div class="btn-group mt-1 btn-group-sm" role="group" aria-label="Basic example">';
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


                                        result += '<button type="button" id="btnprintresep" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"';
                                        result += '><i class="bi bi-printer-fill"></i></button>';

                                        result += '<ul class="dropdown-menu dropdown-menu-dark">'

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
                                        result += '</div>'
                                        return result;

                                    },
                                }

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
                                [2, 'desc']
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

        $('#btnsavepermintaan').click(function(e) {
            if ($('#dokter1').val() == '-') {
                $('#dokter1').focus();
                $("#dokter1").addClass("is-invalid");
            } else {
                Swal.fire({
                    target: document.getElementById('modalinputresep'),
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
                        tipe = 1;
                        $("table.tableresep2 tbody tr").each(function(i) {
                            var arrayval = [];
                            // var key = ['kode', 'nama', 'stokasal', 'stoktujuan', 'jumlah', 'aksi'];              
                            $("td", this).each(function(j) {
                                arrayval.push($(this).text())
                            });
                            arraylistitem.push(arrayval);
                        });
                        console.log(arraylistitem);


                        $.ajax({
                            url: "/resepManual/postSimpanResep",
                            type: 'POST',
                            data: {

                                tipe: tipe,

                                no_rawat: $("#norawat1").val(),
                                no_rkm_medis: $("#norm1").val(),
                                status_rawat: $("#status1").val(),

                                depo: $("#depo1").val(),

                                tanggal: $("#tglresep1").val(),
                                jam: $("#jamresep1").val(),

                                kd_dokter: $("#dokter1").val(),

                                list_obat: arraylistitem
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.code == 200) {
                                    console.log('test');

                                    $('#modalinputresep').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Berhasil",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then((result) => {
                                        getPerawtan()
                                    });


                                    // getResep()
                                } else {
                                    // $('#modalinputresep').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Gagal",
                                        text: response.mesagge == '' ?
                                            "Periksa Kembali data / Silahkan Hubungi SIMRS" : response.mesagge,
                                        icon: "error",
                                    }).then((result) => {
                                        getPerawtan()
                                    });


                                }

                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                $('#modalinputresep').modal('hide')
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
            }

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
                            kd_bangsal: $("#depo1").val(),
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

        $("#btnCari").click(function() {
            getPerawtan();
        });

        $("#btnCari2").click(function() {
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });
            getHistoryResep();
        });

        $('#tableResep1').on('click', '.btnValidasi', function() {
            $('#tableresep2 tbody').html('');

            $('#norawat1').val($(this).data('norawat'));
            $('#norm1').val($(this).data('norkmmedis'));
            $('#namapasien1').val($(this).data('nama'));
            $('#status1').val($(this).data('statuslanjut'));

            $('#modalinputresep').modal('show')

        });

        $('#tableResep3').on('click', '.btneditaturanpakai', function() {
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

        $('#tableResep3').on('click', '.btnprintresep', function() {
            // console.log("AWdawdawd");
            window.open('{{ env('LINK_ERESULT') }}/ResultResep/resultNoEresep/' + $(this).data('noresep'),
                '_blank');
        });

        $('#tableResep3').on('click', '.btnprintetiket', function() {
            // console.log("AWdawdawd");
            window.open('{{ env('LINK_ERESULT') }}/ResultFarmasi/tiketAturanPakai/' + $(this).data('noresep'),
                '_blank');
        });

        $('#tableResep3').on('click', '.btnprintbilingresep', function() {
            // console.log("AWdawdawd");
            window.open('{{ env('LINK_ERESULT') }}/ResultResep/resultBilingNoResep/' + $(this).data('noresep'),
                '_blank');
        });
    </script>
@endsection
