@extends('layouts.main')

@section('title')
    <title>Transaksi | Penerimaan</title>
@endsection

@section('content')
    <section class="section row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 ">
                            <h4 class="card-title">Penerimaan Obat</h4>
                        </div>
                        <div class="col-6 ">
                            <a class="btn icon icon-left btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalAddPenerimaan" id="btnAdd"><i class="bi bi-database-add"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="" class="text-white">-</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Urutan
                                        </span>
                                    </div>
                                    <select class="form-control" name="urutantgl" id="urutantgl">
                                        <option value="1">Tanggal Faktur</option>
                                        <option value="2">Tanggal Penerimaan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label for="" class="text-white">-</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Dari
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" id="datepickerFrom1" name="datepickerFrom1" {{-- value="{{ date('Y-m-d', strtotime('-7 days')) }}"> --}} value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
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

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="home" aria-selected="true">No. Faktur</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="profile" aria-selected="false">Obat</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive datatable-minimal">
                                <table class="table table-strip table-bordered" id="tableOrder1">
                                    <thead>
                                        <tr class="bg-light-danger">
                                            <th>Tgl. Faktur</th>
                                            <th>Tgl. Pesan</th>
                                            <th>No. Fakur</th>
                                            <th>Suplier</th>
                                            <th>Petugas</th>
                                            <th>Sub. Total</th>
                                            <th>PPN</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive datatable-minimal">
                                <table class="table table-strip table-bordered" id="tableOrder3">
                                    <thead>
                                        <tr>
                                            <th>Faktur</th>
                                            <th>SP/Order</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Suplier</th>
                                            <th>Jumlah</th>
                                            <th>Harga Pesan</th>
                                            {{-- <th>PPN</th> --}}
                                            <th>Total</th>
                                            <th>Petugas</th>
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

    <div class="modal fade text-left" id="modalAddPenerimaan" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false" data-bs-backdrop="false">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel140">ADD Penerimaan
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">No. Faktur</label>
                                <input type="text" class="form-control form-control-sm" id="nofaktur">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">PPN</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control form-control-sm" aria-describedby="basic-addon1" id="ppn" min="0" value="0">
                                    {{-- <input type="number" class="form-control form-control-sm"
                                        aria-describedby="basic-addon1" id="ppn" min="0"
                                        value="{{ $ppn }}"> --}}
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2" hidden>
                            <div class="form-group">
                                <label for="basicInput">Penjualan</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control form-control-sm" aria-describedby="basic-addon1" id="penjualan" value="{{ $penjualan }}" disabled>
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Tgl. Datang</label>
                                <input type="date" class="form-control form-control-sm" id="tgldatang" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="basicInput">Tgl. Faktur</label>
                                <input type="date" class="form-control form-control-sm" id="tglfaktur" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2" hidden>
                            <div class="form-group">
                                <label for="basicInput">Tgl. Tempo</label>
                                <input type="date" class="form-control form-control-sm" id="tgltempo" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">SP/Order</label>
                                <input type="text" class="form-control form-control-sm" id="sporder">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Distributor</label>
                                <select class="form-control form-control-sm" id="distributor">
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Lokasi</label>
                                <select class="form-control form-control-sm" id="lokasi">
                                    <option value="GO" selected>Gudang Obat</option>
                                    <option value="A1">Apotek</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary">
                        <div class="card-header">
                            <span class="card-title">List Obat</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table tableOrder2" id="tableOrder2">
                                    <thead>
                                        <tr>
                                            <th>Jumlah</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>No. Batch</th>
                                            <th>Tgl. Kadaluarsa</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>+PPN</th>
                                            <th>Subtotal</th>
                                            <th hidden>satuan</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="9"></td>
                                            <td>
                                                {{-- <center> --}}

                                                <button type="button" class="btn icon btn-primary icon-left" id="addobat"><i class="bi bi-plus-circle"></i></button>
                                                {{-- </center> --}}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group form-group-sm">
                        <div class="input-group form-control-sm">
                            <span class="input-group-text" id="basic-addon1">Total</span>
                            <input type="number" class="form-control form-control-sm" aria-describedby="basic-addon1" id="total" value="0" disabled>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="button" class="btn btn-warning btn-sm ms-1" id="btnsavepenerimaan">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalAddBarang" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="myModalLabel140">Add Barang
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="kodebarang">Barang</label>
                                <select class="form-control" id="barang">
                                    {{-- <option value="-" disabled selected>-</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Kode Barang</label>
                                <input type="text" class="form-control form-control-sm" id="kodebarang" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Tgl. Kadaluarsa</label>
                                <input type="date" class="form-control form-control-sm" id="tglkadaluarsa">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="kodebarang">Principal (Pabrikan)</label>
                                <select class="form-control" id="pabrikan">
                                    {{-- <option value="-" disabled selected>-</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">No. Batch</label>
                                <input type="text" class="form-control form-control-sm" id="nobatch">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Jumlah</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" aria-describedby="lbljumlah" id="jumlah">
                                    <span class="input-group-text" id="lbljumlah"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4" hidden>
                            <div class="form-group">
                                <label for="basicInput">satuan</label>
                                <input type="text" class="form-control form-control-sm" id="satuan" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Harga Beli</label>
                                <input type="number" class="form-control form-control-sm" id="hargabeli">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Harga Jual</label>
                                <input type="number" class="form-control form-control-sm" id="hargajual" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">+ PPN</label>
                                <input type="number" class="form-control form-control-sm" id="hargappn" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Sub Total</label>
                                <input type="text" class="form-control form-control-sm" id="subtotal" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="submit" class="btn btn-warning ms-1" id="btnadditem">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalEditBarang" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="myModalLabel140">Edit Barang
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Penjualan</label>
                                <input type="text" class="form-control form-control-sm" id="penjualan2" value="{{ $penjualan }}" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">No.Faktur</label>
                                <input type="text" class="form-control form-control-sm" id="nofaktur2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">SP/Order</label>
                                <input type="text" class="form-control form-control-sm" id="sporder2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Kode Barang</label>
                                <input type="text" class="form-control form-control-sm" id="kodebarang2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">No. Batch</label>
                                <input type="text" class="form-control form-control-sm" id="nobatch2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Tgl. Kadaluarsa</label>
                                <input type="date" class="form-control form-control-sm" id="tglkadaluarsa2">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">PPN</label>
                                <input type="number" class="form-control" aria-describedby="lbljumlah2" id="ppn2" min="0" value="0" disabled>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Jumlah</label>
                                <input type="number" class="form-control" aria-describedby="lbljumlah2" id="jumlah2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Harga Beli</label>
                                <input type="number" class="form-control form-control-sm" id="hargabeli2">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Harga Jual</label>
                                <input type="number" class="form-control form-control-sm" id="hargajual2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">+ PPN</label>
                                <input type="number" class="form-control form-control-sm" id="hargappn2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Sub Total</label>
                                <input type="text" class="form-control form-control-sm" id="subtotal2" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="submit" class="btn btn-warning ms-1" id="btnupdateitem">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
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
            // e.preventDefault();

            $("#pabrikan").select2({
                ajax: {
                    url: "/penerimaan/getDatPpabrikan",
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
            });

            $("#distributor").select2({
                ajax: {
                    url: "/penerimaan/getDataDistributor",
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
                dropdownParent: $("#modalAddPenerimaan"),
                theme: "bootstrap-5",
                closeOnSelect: true
            });

            $("#barang").select2({
                ajax: {
                    url: "/penerimaan/getDataobat",
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
                // console.log(data);
                $("#kodebarang").val(data.obat.kode_brng);
                $("#lbljumlah").html(data.obat.kode_sat);
                $("#satuan").val(data.obat.kode_sat);
                $("#namabarang").val(data.obat.nama_brng);
                $("#hargabeli").val(data.obat.h_beli);
                $("#hargajual").val(data.obat.utama);
            });

            getNoFaktur();
            getDataBarang();
        })

        function getDataBarang() {
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });
            $('#tableOrder1 tbody').html('');
            $.ajax({
                url: "/penerimaan/getPenerimaan",
                type: 'POST',
                data: {
                    urutan: $('#urutantgl').val(),
                    from: $('#datepickerFrom1').val(),
                    to: $('#datepickerTO1').val()
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        if (response.data_pemesanan) {
                            var tbody_value = '';
                            var status = '';
                            for (i = 0; i < response.data_pemesanan.length; i++) {

                                if (i % 2 == 0) {
                                    table = 'table-info';
                                    card = 'bg-light-info';
                                } else {
                                    table = 'table-warning';
                                    card = 'bg-light-warning';
                                }

                                if (i != 0) {

                                    tbody_value += '<tr><td colspan="7" class="text-center">-----</td></tr>';
                                }

                                tbody_value += '<tr id="detObat" class="' + card + '">';
                                tbody_value += '<td>' + response.data_pemesanan[i].tgl_faktur + '</td>';
                                tbody_value += '<td>' + response.data_pemesanan[i].tgl_pesan + '</td>';
                                tbody_value += '<td>' + response.data_pemesanan[i].no_faktur + '</td>';
                                tbody_value += '<td>' + response.data_pemesanan[i].nama_suplier + '</td>';
                                tbody_value += '<td>' + response.data_pemesanan[i].nama + '</td>';
                                tbody_value += '<td>' + response.data_pemesanan[i].subtotal + '</td>';
                                tbody_value += '<td>' + response.data_pemesanan[i].ppn + '</td>';
                                tbody_value += '<td>' + response.data_pemesanan[i].total + '</td>';
                                tbody_value += '</tr>';

                                tbody_value += '<tr class="' + card + '">';
                                tbody_value += '<td colspan="8">';
                                tbody_value += '<div class="card ' + card + '" >';
                                tbody_value += '<div class="card-body">';
                                tbody_value += '<table class="table table-bordered">';
                                tbody_value += '<thead>';
                                tbody_value += '<th><strong>Nama Obat</strong></th>';
                                tbody_value += '<th>No. Batch</th>';
                                tbody_value += '<th>Tgl. Kadaluarsa</th>';
                                tbody_value += '<th>Jumlah</th>';
                                tbody_value += '<th>Harga Pesan</th>';
                                tbody_value += '<th>Total</th>';
                                tbody_value += '</thead>';
                                tbody_value += '<tbody>';

                                for (j = 0; j < response.data_pemesanan[i].list_item.length; j++) {
                                    tbody_value += '<tr>';
                                    tbody_value += '<td>' + response.data_pemesanan[i].list_item[j].nama_brng + '</td>';
                                    tbody_value += '<td>' + response.data_pemesanan[i].list_item[j].no_batch + '</td>';
                                    tbody_value += '<td>' + response.data_pemesanan[i].list_item[j].kadaluarsa + '</td>';
                                    tbody_value += '<td>' + response.data_pemesanan[i].list_item[j].jumlah2 + '</td>';
                                    tbody_value += '<td>' + response.data_pemesanan[i].list_item[j].h_pesan + '</td>';
                                    tbody_value += '<td>' + response.data_pemesanan[i].list_item[j].total + '</td>';
                                    tbody_value += '</tr>';
                                }

                                tbody_value += '</tbody>';
                                tbody_value += '</table> ';
                                tbody_value += '</div>';
                                // tbody_value += '<div class="card-footer '+card+'">'
                                //     tbody_value += '<button type="button" id="btnPenyerahan" class="btn btn-sm btn-primary float-end btneditdetailpenerimaan"';
                                //     tbody_value += 'data-nofaktur="' + response.data_pemesanan[i].no_faktur + '"';
                                //     tbody_value += '><i class="bi bi-pencil"></i></button>';
                                // tbody_value += '</div>';
                                tbody_value += '</div>';
                                tbody_value += '</td>';
                                tbody_value += '</tr>';

                            }
                            $('#tableOrder1 tbody').append(tbody_value)
                        } else {
                            $('#tableOrder1 tbody').html(
                                '<tr><td colspan="7" class="text-center">Belum tersedia</td></tr>'
                            )
                        }


                        if (response.detailpesan) {
                            $("#tableOrder3").DataTable().destroy()
                            var Table = $('#tableOrder3').dataTable({
                                "aaData": response.detailpesan,
                                "columns": [{
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var span = '';
                                            span += '<span class="">' + data.no_faktur + '</span><br>'
                                            span += '<span class="badge bg-light-info">' + data.tgl_faktur + '</span>'
                                            return span;

                                        },
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var span = '';
                                            span += '<span class="">' + data.no_order + '</span><br>'
                                            span += '<span class="badge bg-light-primary">' + data.tgl_pesan + '</span>'
                                            return span;

                                        },
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var span = '';
                                            span += '<span class="">' + data.kode_brng + '</span><br>'
                                            span += '<span class="badge bg-light-info">' + data.no_batch + '</span>'
                                            return span;

                                        },
                                    },
                                    {
                                        "data": "nama_brng"
                                    },
                                    {
                                        "data": "nama_suplier"
                                    },
                                    {
                                        "data": "jumlah2"
                                    },
                                    {
                                        "data": "h_pesan"
                                    },
                                    {
                                        "data": "total"
                                    },
                                    {
                                        "data": "nama"
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            // console.log(data.no_batch);

                                            var button = '';
                                            button += '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                            button += '<button type="button" id="btnedititempemesanan" class="btn btn-sm btn-primary btnedititempemesanan" ';
                                            button += 'data-no_faktur="' + data.no_faktur + '"';
                                            button += 'data-no_order="' + data.no_order + '"';
                                            button += 'data-tgl_faktur="' + data.tgl_faktur + '"';
                                            button += 'data-no_batch="' + data.no_batch + '"';
                                            button += 'data-kode_brng="' + data.kode_brng + '"';
                                            button += 'data-nama_brng="' + data.nama_brng + '"';
                                            button += 'data-nama_suplier="' + data.nama_suplier + '"';
                                            button += 'data-jumlah="' + data.jumlah2 + '"';
                                            button += 'data-h_pesan="' + data.h_pesan + '"';
                                            button += 'data-total="' + data.total + '"';
                                            button += 'data-kadaluarsa="' + data.kadaluarsa + '"';
                                            button += ' ><i class="bi bi-pencil">';
                                            button += '</i></button>';
                                            button += '</div>';
                                            return button;

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
                                "autoWidth": false
                            });
                        }
                    }
                    swal.close();
                },
                error: function(xhr, status, error) {
                    swal.close();
                    console.log(error);
                }
            });
        }

        $('#tableOrder1').on('click', '.btnEdit', function() {
            $('#kdbarang').val($(this).data('kode_brng'));
            $('#namabarang').val($(this).data('nama_brng'));
            $('#bangsal').val($(this).data('nm_bangsal'));
            $('#stokasal').val($(this).data('stok'));
            $('#harga').val($(this).data('harga'));

            $('#modalEditbarang').modal('show');
        });

        $('#stok').on('change', function() {
            $('#selisih').val((parseInt($('#stok').val()) - parseInt($('#stokasal').val())));
            $('#nominal').val((parseInt($('#selisih').val()) * parseInt($('#harga').val())));
        });

        $('#addobat').click(function(e) {
            $('#modalAddBarang').modal('show')
        });

        $('#tgldatang').on('change', function() {
            getNoFaktur();
        });

        $('#btnadditem').click(function(e) {
            if ($('#barang').val() == null) {
                $('#barang').focus();
                $("#barang").addClass("is-invalid");
            } else if ($('#tglkadaluarsa').val() == '') {
                $('#tglkadaluarsa').focus();
                $("#tglkadaluarsa").addClass("is-invalid");
            } else if ($('#nobatch').val() == '') {
                $('#nobatch').focus();
                $("#nobatch").addClass("is-invalid");
            } else if ($('#jumlah').val() == '' || $('#jumlah').val() == 0) {
                $('#jumlah').focus();
                $("#jumlah").addClass("is-invalid");
            } else if ($('#hargabeli').val() == '' || $('#jumlah').val() == 0) {
                $('#hargabeli').focus();
                $("#hargabeli").addClass("is-invalid");
            } else {
                var row = '';
                row += '<tr ';
                row += 'data-kodebarang="' + $('#barang').val();
                row += '" data-namabrng="' + $('#namabarang').val();
                row += '" data-tglkadaluarsa="' + $('#tglkadaluarsa').val();
                row += '" data-nobatch="' + $('#nobatch').val();
                row += '" data-jumlah="' + $('#jumlah').val();
                row += '" data-hargabeli="' + $('#hargabeli').val();
                row += '" data-hargajual="' + $('#hargajual').val();
                row += '" data-hargappn="' + $('#hargappn').val();
                row += '" data-subtotal="' + $('#subtotal').val();
                row += '">';

                row += '<td>' + $('#jumlah').val() + '</td>';
                row += '<td>' + $('#barang').val() + '</td>';
                row += '<td>' + $('#namabarang').val() + '</td>';
                row += '<td>' + $('#nobatch').val() + '</td>';
                row += '<td>' + $('#tglkadaluarsa').val() + '</td>';
                row += '<td>' + $('#hargabeli').val() + '</td>';
                row += '<td>' + $('#hargajual').val() + '</td>';
                row += '<td>' + $('#hargappn').val() + '</td>';
                row += '<td>' + $('#subtotal').val() + '</td>';
                row += '<td hidden>' + $('#satuan').val() + '</td>';
                row += '<td>';
                row +=
                    '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                row += '</td>';
                row += '</tr>';

                $('#barang').val(null).trigger('change')
                $('#tglkadaluarsa').val('');
                $('#kodebarang').val('');
                $('#nobatch').val('');
                $('#jumlah').val('');
                $('#lbljumlah').text('');
                $('#hargabeli').val('');
                $('#hargajual').val('');
                $('#hargappn').val('');
                $('#subtotal').val('');
                $("#tableOrder2 tbody").append(row);
                $('#modalAddBarang').modal('hide')

                hitungtotal();
            }
        });

        $('#btnsavepenerimaan').click(function(e) {
            if ($('#nofaktur').val() == '') {
                $('#nofaktur').focus();
                $("#nofaktur").addClass("is-invalid");
            } else if ($('#tgldatang').val() == '') {
                $('#tgldatang').focus();
                $("#tgldatang").addClass("is-invalid");
            } else if ($('#tglfaktur').val() == '') {
                $('#tglfaktur').focus();
                $("#tglfaktur").addClass("is-invalid");
            } else if ($('#tgltempo').val() == '') {
                $('#tgltempo').focus();
                $("#tgltempo").addClass("is-invalid");
            } else if ($('#sporder').val() == '') {
                $('#sporder').focus();
                $("#sporder").addClass("is-invalid");
            } else if ($('#distributor').val() == '-') {
                $('#distributor').focus();
                $("#distributor").addClass("is-invalid");
            } else {
                Swal.fire({
                    target: document.getElementById('modalAddPenerimaan'),
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
                        $("table.tableOrder2 tbody tr").each(function(i) {
                            var arrayval = [];
                            // var key = ['kode', 'nama', 'stokasal', 'stoktujuan', 'jumlah', 'aksi'];              
                            $("td", this).each(function(j) {
                                arrayval.push($(this).text())
                            });
                            arraylistitem.push(arrayval);
                        });
                        console.log(arraylistitem);

                        $.ajax({
                            url: "/penerimaan/postSimpanPenerimaan",
                            type: 'POST',
                            data: {

                                no_faktur: $("#nofaktur").val(),
                                no_order: $("#sporder").val(),
                                kode_suplier: $("#distributor").val(),

                                tgl_pesan: $("#tgldatang").val(),
                                tgl_faktur: $("#tglfaktur").val(),
                                tgl_tempo: $("#tgltempo").val(),

                                total: $("#total").val(),
                                ppn: $("#ppn").val(),

                                kd_bangsal: $("#lokasi").val(),

                                list_obat: arraylistitem
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.code == 200) {
                                    console.log('test');

                                    $('#modalAddPenerimaan').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Berhasil",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then((result) => {
                                        getDataBarang();
                                    });


                                    // getResep()
                                } else {
                                    // $('#modalAddPenerimaan').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Gagal",
                                        text: response.mesagge == '' ?
                                            "Periksa Kembali data / Silahkan Hubungi SIMRS" : response.mesagge,
                                        icon: "error",
                                    }).then((result) => {});


                                }

                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                $('#modalAddPenerimaan').modal('hide')
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

        $('#tableOrder2').on('click', '.btn_delete', function() {
            $(this).closest("tr").remove();
        });

        $('#jumlah').on('input', function() {
            hitunghargajual(
                'ppn',
                'hargabeli',
                'penjualan',
                'jumlah',
                'hargajual',
                'hargappn',
                'subtotal',
            );
        });

        $('#hargabeli').on('input', function() {
            hitunghargajual(
                'ppn',
                'hargabeli',
                'penjualan',
                'jumlah',
                'hargajual',
                'hargappn',
                'subtotal',
            );
        });

        $('#jumlah2').on('input', function() {
            hitunghargajual(
                'ppn2',
                'hargabeli2',
                'penjualan2',
                'jumlah2',
                'hargajual2',
                'hargappn2',
                'subtotal2'
            );
        });

        $('#hargabeli2').on('input', function() {
            hitunghargajual(
                'ppn2',
                'hargabeli2',
                'penjualan2',
                'jumlah2',
                'hargajual2',
                'hargappn2',
                'subtotal2'
            );
        });

        $('#ppn').on('input', function() {

            $("table.tableOrder2 tbody tr").each(function(i) {
                var jumlah = $(this).find("td:eq(0)").text();
                var hargappn = 0;
                var hargabeli = $(this).find("td:eq(5)").text();
                var hargajual = 0;
                hargappn = Math.round(parseInt(hargabeli) +
                    (
                        (parseInt($('#ppn').val()) / 100) *
                        parseInt(hargabeli)
                    ));


                hargajual = Math.round(parseInt(hargappn) +
                    (
                        (parseInt($('#penjualan').val()) / 100) *
                        parseInt(hargappn)
                    ));


                if (hargajual % 100 != 0) {
                    hargajual = (parseInt(hargajual / 100) + 1) * 100;
                }
                $(this).find("td:eq(7)").text(hargappn);
                $(this).find("td:eq(6)").text(hargappn);
                $(this).find("td:eq(8)").text(
                    parseInt(jumlah) * hargappn);
            });
            hitungtotal();
        });

        $("#btnCari").click(function() {
            getDataBarang();
        });

        $('#tableOrder3').on('click', '.btnedititempemesanan', function() {
            $('#nofaktur2').val($(this).data('no_faktur'));
            $('#sporder2').val($(this).data('no_order'));
            $('#kodebarang2').val($(this).data('kode_brng'));
            $('#namabarang2').val($(this).data('nama_brng'));
            $('#nobatch2').val($(this).data('no_batch'));
            $('#tglkadaluarsa2').val($(this).data('kadaluarsa'));
            $('#jumlah2').val($(this).data('jumlah'));
            $('#hargabeli2').val($(this).data('h_pesan'));

            hitunghargajual(
                'ppn2',
                'hargabeli2',
                'penjualan2',
                'jumlah2',
                'hargajual2',
                'hargappn2',
                'subtotal2'
            );

            $('#modalEditBarang').modal('show')
        });

        $('#btnupdateitem').click(function(e) {
            if ($('#tglkadaluarsa2').val() == '') {
                $('#tglkadaluarsa2').focus();
                $("#tglkadaluarsa2").addClass("is-invalid");
            } else if ($('#jumlah2').val() == '' || $('#jumlah2').val() == 0) {
                $('#jumlah2').focus();
                $("#jumlah2").addClass("is-invalid");
            } else if ($('#hargabeli2').val() == '') {
                $('#hargabeli2').focus();
                $("#hargabeli2").addClass("is-invalid");
            } else {
                Swal.fire({
                    target: document.getElementById('modalEditBarang'),
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

                        $.ajax({
                            url: "/penerimaan/postEditItemPenerimaan",
                            type: 'POST',
                            data: {

                                no_faktur: $("#nofaktur2").val(),

                                kode_brng: $("#kodebarang2").val(),
                                no_batch: $("#nobatch2").val(),
                                jumlah: $("#jumlah2").val(),

                                kadaluarsa: $("#tglkadaluarsa2").val(),
                                h_pesan: $("#hargabeli2").val(),
                                h_jual: $("#hargajual2").val(),
                                total: $("#subtotal2").val(),
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.code == 200) {
                                    // console.log('test');

                                    $('#modalEditBarang').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Berhasil",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then((result) => {
                                        getDataBarang();
                                    });


                                    // getResep()
                                } else {
                                    // $('#modalAddPenerimaan').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Gagal",
                                        text: response.mesagge == '' ?
                                            "Periksa Kembali data / Silahkan Hubungi SIMRS" : response.mesagge,
                                        icon: "error",
                                    }).then((result) => {});


                                }

                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                $('#modalEditBarang').modal('hide')
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

        function hitunghargajual(
            ppn = '',
            hargabeli = '',
            penjualan = '',
            jumlah = '',
            hargajualval = '',
            hargappnval = '',
            subtotal = '',
        ) {
            var hargappn = 0;
            var hargajual = 0;
            hargappn = Math.round(parseFloat($('#' + hargabeli + '').val()) +
                (
                    (parseInt($('#' + ppn + '').val()) / 100) *
                    parseFloat($('#' + hargabeli + '').val())
                ));
            // console.log('hargappn : ' + hargappn);
            $('#' + hargappnval + '').val(hargappn);


            hargajual = Math.round(parseInt(hargappn) +
                (
                    (parseInt($('#' + penjualan + '').val()) / 100) *
                    parseInt(hargappn)
                ));
            // console.log('hargajual : ' + hargajual);
            if (hargajual % 100 != 0) {
                hargajual = (parseInt(hargajual / 100) + 1) * 100;
            }
            // console.log('hargajual bulat 100 : ' + hargajual);
            $('#' + hargajualval + '').val(hargajual);
            // $('#subtotal').val(parseInt($('#jumlah').val()) * hargappn);
            $('#' + subtotal + '').val(($('#' + jumlah + '').val()) * parseFloat($('#' + hargabeli + '').val()));
            // console.log(($('#jumlah').val()) * parseFloat($('#hargabeli').val()));
        }

        function getNoFaktur() {
            $.ajax({
                url: "/data/getNoFaktur",
                type: 'POST',
                data: {
                    tgl_pesan: $("#tgldatang").val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        $("#nofaktur").val(response.no_faktur);
                    }

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }

        function hitungtotal(params) {
            var jumlah = 0;
            $("table.tableOrder2 tbody tr").each(function(i) {
                jumlah = (parseInt($(this).find("td:eq(8)").text()) + parseInt(jumlah));
                console.log('tess');

            });
            $('#total').val(jumlah);
        }
    </script>
@endsection
