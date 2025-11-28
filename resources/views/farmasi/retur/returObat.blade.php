@extends('layouts.main')

@section('title')
    <title>Transaksi | Retur Obat</title>
@endsection

@section('content')
    <section class="section row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 ">
                            <h4 class="card-title">Retur Obat</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab1" role="tab"
                                aria-controls="home" aria-selected="true"> <span class="badge bg-primary">NEW</span></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#tab2" role="tab"
                                aria-controls="profile" aria-selected="false">History</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label for="" class="text-white">-</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Tanggal
                                                </span>
                                            </div>
                                            <input type="date" class="form-control" id="datepicker1" name="datepicker1" {{--
                                                value="{{ date('Y-m-d', strtotime('-7 days')) }}"> --}}
                                            value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <button type="" class="btn btn-warning float-end" id="btnCari">Cari</button>
                                </div>
                            </div>
                            <div class="table-responsive datatable-minimal ">
                                <table class="table" id="tableRetur1">
                                    <thead>
                                        <tr>
                                            <th>No. Rawat</th>
                                            <th>Pasien</th>
                                            <th>Jenis Rawat</th>
                                            <th>user</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="home-tab">

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
                                                <input type="date" class="form-control" id="datepickerFrom1"
                                                    name="datepickerFrom1" {{--
                                                    value="{{ date('Y-m-d', strtotime('-7 days')) }}"> --}}
                                                value="{{ date('Y-m-d') }}">
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
                                                <input type="date" class="form-control" id="datepickerTO1"
                                                    name="datepickerTO1" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                        <button type="" class="btn btn-warning float-end" id="btnCari2">Cari</button>
                                    </div>
                                </div>

                                <div class="table-responsive datatable-minimal mt-5">
                                    <table class="table" id="tableRetur3">
                                        <thead>
                                            <tr>
                                                <th>No. Rawat</th>
                                                <th>Pasien</th>
                                                <th>Tgl & Jam Retur</th>
                                                <th>Jenis Rawat</th>
                                                <th>Tujuan</th>
                                                <th>User</th>
                                                <th>#</th>
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
    </section>

    <div class="modal fade text-left" id="modalvalidasi" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false"
        data-bs-backdrop="false" tabindex="-1">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel140">
                        Validasi Retur Obat
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

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Tanggal</label>
                                <input type="date" class="form-control form-control-sm" id="tglretur"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Jam</label>
                                <input type="time" class="form-control form-control-sm" id="jamretur"
                                    value="{{ date('H:i:s') }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Depo</label>
                                <select class="form-control form-control-sm" id="depo">
                                    <option value="A1" selected>Apotek</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary">
                        <div class="card-header">
                            <span class="card-title">List Obat</span>
                        </div>
                        <div class="card-body">
                            {{-- <div class="table-responsive"> --}}
                                <table class="table tableRetur2" id="tableRetur2">
                                    <thead>
                                        <tr>
                                            <th hidden></th>
                                            <th>Jumlah</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Satuan</th>
                                            <th hidden>Jumlah Jual</th>
                                            <th hidden>Harga Jual</th>
                                            <th>Harga Retur</th>
                                            <th>Subtotal</th>
                                            <th>No. Batch</th>
                                            <th>No. Faktur</th>
                                            <th>
                                                <button type="button" class="btn icon btn-primary icon-left addobat"
                                                    id="addobat"><i class="bi bi-plus-circle"></i></button>
                                                {{-- </center> --}}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    {{-- <tfoot>
                                        <tr>
                                            <td colspan="10"></td>
                                            <td>
                                                <center>

                                                    <button type="button" class="btn icon btn-primary icon-left"
                                                        id="addobat"><i class="bi bi-plus-circle"></i></button>
                                                </center>
                                            </td>
                                        </tr>
                                    </tfoot> --}}
                                </table>
                                {{--
                            </div> --}}
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

    <div class="modal fade text-left" id="modalEditItemretur" role="dialog" aria-labelledby="myModalLabel140"
        aria-hidden="false">
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

                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Satuan</label>
                                <input type="text" class="form-control form-control-sm" id="satuan2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Jumlah Jual</label>
                                <input type="number" class="form-control form-control-sm" id="jmljual2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Harga Jual</label>
                                <input type="text" class="form-control form-control-sm" id="hargajual2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Harga Retur</label>
                                <input type="text" class="form-control form-control-sm" id="hargaretur2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Subtotal</label>
                                <input type="text" class="form-control form-control-sm" id="subtotal2" disabled>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">No.Batch</label>
                                <select class="form-control" name="nobatch2" id="nobatch2">

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">No.Faktur</label>
                                <select class="form-control" name="nofaktur2" id="nofaktur2">

                                </select>
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

    <div class="modal fade text-left" id="modalNewItemretur" role="dialog" aria-labelledby="myModalLabel140"
        aria-hidden="false">
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
                                <input type="text" class="form-control form-control-sm" id="kodebarang3" disabled>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-8" hidden>
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang3" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <select class="form-control form-control-sm" id="inputbarang3">

                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Jumlah Jual</label>
                                <input type="text" class="form-control form-control-sm" id="jmljual3" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Jumlah</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" aria-describedby="lbljumlah3" id="jumlah3">
                                    <span class="input-group-text lbljumlah" id="lbljumlah3"></span>
                                </div>
                                <p class="text-danger small " id="keteranganjumlahretur"> <strong>* Jumlah yang
                                        diretur tidak boleh melebihi jumlah di Jual</strong></p>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Satuan</label>
                                <input type="text" class="form-control form-control-sm" id="satuan3" disabled>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Harga Jual</label>
                                <input type="text" class="form-control form-control-sm" id="hargajual3" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Harga Retur</label>
                                <input type="text" class="form-control form-control-sm" id="hargaretur3" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Subtotal</label>
                                <input type="text" class="form-control form-control-sm" id="subtotal3" disabled>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">No.Batch</label>
                                <select class="form-control" name="nobatch2" id="nobatch3">

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">No.Faktur</label>
                                <select class="form-control" name="nofaktur2" id="nofaktur3">

                                </select>
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
@endsection

@section('script')
    <script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/static/js/pages/datatables.js"></script>

    <script>
        $(document).ready(function (e) {

            $("#keteranganjumlahretur").hide();
            getBangsal('dari');
            getResep();
            getretur();

            $('#tableRetur2').on('click', '.btn_edit', function () {

                $('#idlistobat2').val($(this).parents("tr").attr('data-index'));
                $('#kodebarang2').val($(this).parents("tr").attr('data-kodebarang'));
                $('#namabarang2').val($(this).parents("tr").attr('data-namabrng'));

                $('#jumlah2').val($(this).parents("tr").attr('data-jumlah'));
                $('#lbljumlah2').html($(this).parents("tr").attr('data-satuan'));
                $('#satuan2').val($(this).parents("tr").attr('data-satuan'));

                $('#jmljual2').val($(this).parents("tr").attr('data-jmljual'));
                $('#hargajual2').val($(this).parents("tr").attr('data-hjual'));
                $('#hargaretur2').val($(this).parents("tr").attr('data-hretur'));
                $('#subtotal2').val($(this).parents("tr").attr('data-subtotal'));



                $('#nobatch2').html('');
                $.ajax({
                    url: "/retur/getnobatch",
                    type: 'POST',
                    data: {
                        no_rawat: $('#norawat').val(),
                        kode_brng: $(this).parents("tr").attr('data-kodebarang'),
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        if (response.code == 200) {
                            if (response.list_batch.length == 1) {
                                $('#nobatch2').append('<option val="' + response.list_batch[0]
                                    .no_batch + '">' + response.list_batch[0].no_batch +
                                    '</option>');
                            } else {
                                for (let i = 0; i < response.list_batch.length; i++) {
                                    $('#nobatch2').append('<option val="' + response.list_batch[
                                        i]
                                        .no_batch + '">' + response.list_batch[i].no_batch +
                                        '</option>'
                                    );
                                }
                            }

                            $('#nobatch2').trigger('change');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })

                $("#jumlah2").removeClass("is-invalid");
                $('#modalEditItemretur').modal('show');
                // index_table =$(this).parents("tr").attr('data-index');
                // console.log(index_table);
                // $('#' + index_table).after('<tr class="table-warning"><td>test1</td><td>test2</td><td>test3</td></tr>');
            });


            $("#nobatch2").change(function () {
                $('#nofaktur2').html('');
                $.ajax({
                    url: "/retur/getnofaktur",
                    type: 'POST',
                    data: {
                        no_rawat: $('#norawat').val(),
                        kode_brng: $('#kodebarang2').val(),
                        no_batch: $('#nobatch2').val(),
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        if (response.code == 200) {
                            if (response.list_faktur.length == 1) {
                                $('#nofaktur2').append('<option val="' + response.list_faktur[0]
                                    .no_batch + '">' + response.list_faktur[0].no_faktur +
                                    '</option>');
                            } else {
                                for (let i = 0; i < response.list_faktur.length; i++) {
                                    $('#nofaktur2').append('<option val="' + response
                                        .list_faktur[i]
                                        .no_batch + '">' + response.list_faktur[i]
                                            .no_faktur +
                                        '</option>'
                                    );
                                }
                            }

                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            });

            $("#nobatch3").change(function () {
                $('#nofaktur3').html('');
                $.ajax({
                    url: "/retur/getnofaktur",
                    type: 'POST',
                    data: {
                        no_rawat: $('#norawat').val(),
                        kode_brng: $('#kodebarang3').val(),
                        no_batch: $('#nobatch3').val(),
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        if (response.code == 200) {
                            if (response.list_faktur.length == 1) {
                                $('#nofaktur3').append('<option val="' + response.list_faktur[0]
                                    .no_batch + '">' + response.list_faktur[0].no_faktur +
                                    '</option>');
                            } else {
                                for (let i = 0; i < response.list_faktur.length; i++) {
                                    $('#nofaktur3').append('<option val="' + response
                                        .list_faktur[i]
                                        .no_batch + '">' + response.list_faktur[i]
                                            .no_faktur +
                                        '</option>'
                                    );
                                }
                            }

                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            });

            $("#btneditdetailitemresep").click(function () {
                row = '';

                if ($('#jumlah2').val() == 0 && $('#jumlah2').val() == '') {
                    $('#jumlah2').focus();
                    $("#jumlah2").addClass("is-invalid");
                } else {
                    index_table = $('#' + $('#idlistobat2').val());

                    row += '<tr class="table-warning">';
                    row += '<td hidden>1</td>';
                    row += '<td>' + $('#jumlah2').val() + '</td>';
                    row += '<td>' + $('#kodebarang2').val() + '</td>';
                    row += '<td>' + $('#namabarang2').val() + '</td>';
                    row += '<td>' + $('#satuan2').val() + '</td>';
                    row += '<td hidden>' + $('#jmljual2').val() + '</td>';
                    row += '<td hidden>' + $('#hargajual2').val() + '</td>';
                    row += '<td>' + $('#hargaretur2').val() + '</td>';
                    row += '<td>' + $('#subtotal2').val() + '</td>';
                    row += '<td>' + $('#nobatch2').val() + '</td>';
                    row += '<td>' + $('#nofaktur2').val() + '</td>';
                    row +=
                        '<td><button class="btn btn-danger btn_delete btn-sm"><i class="bi bi-x-circle-fill"></i></button> </td>';
                    row += '</tr>';


                    console.log($('#idlistobat2'));

                    index_table.after(row);


                    $('#idlistobat2').val('');
                    $('#kodebarang2').val('');
                    $('#namabarang2').val('');
                    $('#jumlah2').val('');

                    $('#modalEditItemretur').modal('hide');
                }

            });

            $("#btnadddetailitemresep").click(function () {
                row = '';

                if ($('#inputbarang3').val() == '') {
                    $('#inputbarang3').focus();
                    $("#inputbarang3").addClass("is-invalid");
                } else if ($('#jumlah3').val() == 0 && $('#jumlah3').val() == '') {
                    $('#jumlah3').focus();
                    $("#jumlah3").addClass("is-invalid");
                } else {

                    row += '<tr class="table-warning">';
                    row += '<td hidden>1</td>';
                    row += '<td>' + $('#jumlah3').val() + '</td>';
                    row += '<td>' + $('#kodebarang3').val() + '</td>';
                    row += '<td>' + $('#namabarang3').val() + '</td>';
                    row += '<td>' + $('#satuan3').val() + '</td>';
                    row += '<td hidden>' + $('#jmljual3').val() + '</td>';
                    row += '<td hidden>' + $('#hargajual3').val() + '</td>';
                    row += '<td>' + $('#hargaretur3').val() + '</td>';
                    row += '<td>' + $('#subtotal3').val() + '</td>';
                    row += '<td>' + $('#nobatch3').val() + '</td>';
                    row += '<td>' + $('#nofaktur3').val() + '</td>';
                    row +=
                        '<td><button class="btn btn-danger btn_delete btn-sm"><i class="bi bi-x-circle-fill"></i></button> </td>';
                    row += '</tr>';

                    $('#tableRetur2 tbody').append(row);

                    $('#inputbarang3').val(null).trigger('change');
                    $('#jmljual3').val('');
                    $('#jumlah3').val('');
                    $('#lbljumlah3').text('');
                    $('#hargaretur3').val('');
                    $('#subtotal3').val('');
                    $('#nobatch3').val('');
                    $('#nofaktur3').val('');

                    $('#modalNewItemretur').modal('hide');
                }

            });

            $('#tableRetur2').on('click', '.btn_delete', function () {
                $(this).closest("tr").remove();
            });

            $('#tableRetur1').on('click', '.btn_delete', function () {
                $(this).closest("tr").remove();
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
                url: "/retur/getretur",
                type: 'POST',
                data: {
                    tanggal: $('#datepicker1').val(),
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.code == 200) {
                        $("#tableRetur1").dataTable().fnDestroy()
                        var Table = $('#tableRetur1').dataTable({
                            "aaData": response.data_retur,
                            "columns": [{
                                "data": "no_rawat"
                            },
                            {
                                "mData": null,
                                "bSortable": false,
                                "mRender": function (data, type, full) {
                                    var result = '';
                                    result += data.no_rkm_medis + '<br>'
                                    result += data.nm_pasien
                                    return result;

                                },
                            },
                            {
                                "data": "status_lanjut"
                            },
                            {
                                "data": "nama"
                            },
                            {
                                "mData": null,
                                "bSortable": false,
                                "mRender": function (data, type, full) {
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
                error: function (xhr, status, error) {

                    swal.close();
                    console.log(error);
                }
            })

        }

        function getretur() {
            $('#tableRetur3 tbody').html('')
            $.ajax({
                url: "/retur/getDatareturSelesai",
                type: 'POST',
                data: {
                    from: $('#datepickerFrom1').val(),
                    to: $('#datepickerTO1').val()
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        var tbody_value = '';
                        var status = '';
                        for (i = 0; i < response.data_retur.length; i++) {

                            if (i % 2 == 0) {
                                status = 'table-danger';
                            } else {
                                status = 'table-warning';
                            }

                            tbody_value += '<tr id="detObat" class="' + status + '">';
                            tbody_value += '<td>' + response.data_retur[i].no_retur_jual + '</td>';
                            tbody_value += '<td>' + response.data_retur[i].no_rkm_medis + ' <br> ' + response
                                .data_retur[i].nm_pasien + '</td>';
                            tbody_value += '<td>' + response.data_retur[i].tgl_retur + ' <br> ' + response
                                .data_retur[
                                i].jam_retur + '</td>';
                            tbody_value += '<td></td>';
                            tbody_value += '<td>' + response.data_retur[i].nm_bangsal + '</td>';
                            tbody_value += '<td>' + response.data_retur[i].nama + '</td>';
                            tbody_value += '<td>';

                            tbody_value +=
                                '<button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#collapse' +
                                i + '" aria-expanded="true" aria-controls="collapse' + i +
                                '"><i class="bi bi-collection-fill"></i></button>';

                            tbody_value += '</td>';
                            tbody_value += '</tr>';

                            tbody_value += '<tr id="collapse' + i +
                                '" class="collapse ' + status + '" aria-labelledby="heading' + i +
                                '" data-parent="#tableRetur3">';
                            tbody_value += '<td colspan="7">';
                            tbody_value += '<div class="card">';
                            tbody_value += '<div class="card-body">';
                            tbody_value += '<table class="table table-bordered">';
                            tbody_value += '<thead>';
                            tbody_value += '<th>Nama Obat</th>';
                            tbody_value += '<th>Jumlah</th>';
                            tbody_value += '<th>No. Batch</th>';
                            tbody_value += '<th>No. Faktur</th>';
                            tbody_value += '</thead>';
                            tbody_value += '<tbody>';

                            for (j = 0; j < response.data_retur[i].list_item.length; j++) {
                                tbody_value += '<tr>';
                                tbody_value += '<td>' + response.data_retur[i].list_item[j].nama_brng + '</td>';
                                tbody_value += '<td>' + response.data_retur[i].list_item[j].jml_retur + '</td>';
                                tbody_value += '<td>' + response.data_retur[i].list_item[j].no_batch + '</td>';
                                tbody_value += '<td>' + response.data_retur[i].list_item[j].no_faktur + '</td>';
                                tbody_value += '</tr>';
                            }

                            tbody_value += '</tbody>';
                            tbody_value += '</table> ';
                            tbody_value += '</div>'
                            tbody_value += '</div>'
                            tbody_value += '</td>';
                            tbody_value += '</tr>';

                        }
                        $('#tableRetur3 tbody').append(tbody_value)
                    } else {
                        $('#tableRetur3 tbody').html(
                            '<tr><td colspan="6" class="text-center">Belum tersedia</td></tr>'
                        )
                    }
                    swal.close();
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            })
        }

        $('#tableRetur1').on('click', '.btnValidasi', function () {
            $('#tableRetur2 tbody').html('');

            $('#norawat').val($(this).data('norawat'));
            $('#norm').val($(this).data('norkmmedis'));
            $('#namapasien').val($(this).data('nama'));

            $('#modalvalidasi').modal('show')

            $.ajax({
                url: "/retur/getitemretur",
                type: 'POST',
                data: {
                    no_rawat: $(this).data('norawat'),
                    kd_bangsal: $('#depo').val(),
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.code == 200) {
                        if (response.list_obat) {
                            row = '';
                            for (let i = 0; i < response.list_obat.length; i++) {
                                row += '<tr id="obat' + (i + 1);
                                row += '" data-index="obat' + (i + 1);
                                row += '" data-jumlah="' + response.list_obat[i].jml_retur;
                                row += '" data-kodebarang="' + response.list_obat[i].kode_brng;
                                row += '" data-namabrng="' + response.list_obat[i].nama_brng;
                                row += '" data-satuan="' + response.list_obat[i].satuan;
                                row += '" data-jmljual="' + response.list_obat[i].jml_jual;
                                row += '" data-hjual="' + response.list_obat[i].h_jual;
                                row += '" data-hretur="' + response.list_obat[i].h_retur;
                                row += '" data-subtotal="' + response.list_obat[i].subtotal;
                                row += '">';
                                row += '<td hidden>0</td>';
                                row += '<td>' + response.list_obat[i].jml_retur + '</td>';
                                row += '<td>' + response.list_obat[i].kode_brng + '</td>';
                                row += '<td>' + response.list_obat[i].nama_brng + '</td>';
                                row += '<td>' + response.list_obat[i].satuan + '</td>';

                                row += '<td hidden>' + response.list_obat[i].jml_jual + '</td>';
                                row += '<td hidden>' + response.list_obat[i].h_jual + '</td>';

                                row += '<td>' + response.list_obat[i].h_retur + '</td>';
                                row += '<td>' + response.list_obat[i].subtotal + '</td>';
                                row += '<td></td>';
                                row += '<td></td>';
                                row += '<td>';
                                row +=
                                    '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';
                                row +=
                                    '<button class="btn icon btn-info btn_edit btn-sm"><i class="bi bi-pencil-fill"></i></button> ';
                                row +=
                                    '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                                row += '</div';
                                row += '</td>';
                                row += '</tr>';
                            }

                            // console.log(row);

                            $('#tableRetur2 tbody').append(row);
                            $('#modalvalidasiresep').modal('show')
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            })
        });

        $('#btnsavepermintaan').click(function (e) {

            arraylistitem = [];
            arraylistitemAll = [];
            var status = false;
            $("table.tableRetur2 tbody tr").each(function (i) {
                var arrayval = [];
                var arrayvalAll = [];
                status = false;
                $("td", this).each(function (j) {
                    if (j == 0) {
                        if ($(this).text() == '1') {
                            status = true;
                            arrayval.push($(this).text())
                        } else {
                            if (status) {
                                status = false;
                            }
                        }
                    } else {
                        if (status) {
                            arrayval.push($(this).text())
                        }
                    }
                    arrayvalAll.push($(this).text())
                });
                arraylistitemAll.push(arrayvalAll);
                if (status) {
                    arraylistitem.push(arrayval);
                }
            });
            console.log(arraylistitem);

            if (arraylistitem.length > 0) {
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

                        $.ajax({
                            url: "/retur/postretur",
                            type: 'POST',
                            data: {
                                no_rawat: $("#norawat").val(),
                                no_rkm_medis: $("#norm").val(),
                                status_rawat: $("#statusrawat").val(),

                                kd_bangsal: $("#depo").val(),

                                tgl_retur: $("#tglretur").val(),
                                jam_retur: $("#jamretur").val(),

                                list_retur: arraylistitem,
                                list_retur_all: arraylistitemAll
                            },
                            dataType: 'json',
                            success: function (response) {
                                console.log(response);
                                if (response.code == 200) {
                                    console.log('test');

                                    $('#modalvalidasi').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Berhasil",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then((result) => {
                                        console.log('test');
                                        getResep()
                                    });


                                    // getResep()
                                } else {
                                    // $('#modalvalidasi').modal('hide')
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
                            error: function (xhr, status, error) {
                                console.log(error);
                                // $('#modalvalidasi').modal('hide')
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

            } else {
                swal.fire({
                    target: document.getElementById('modalvalidasi'),
                    title: "Warning",
                    text: "Silahkan Isi item dengan kode batch dan no faktur",
                    icon: "warning",
                })
            }

        });

        $("#jumlah2").on("input", function () {
            // console.log(test);
            $("#subtotal2").val(parseInt($('#jumlah2').val()) * parseInt($('#hargaretur2').val()))
        });

        $("#addobat").click(function () {
            $("#inputbarang3").select2({
                ajax: {
                    url: "/retur/getDataobat",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            no_rawat: $("#norawat").val(),
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: false,
                },
                escapeMarkup: function (markup) {
                    return markup;
                },
                dropdownParent: $("#modalNewItemretur"),
                theme: "bootstrap-5",
                closeOnSelect: true
            }).on('select2:select', function (event) {
                var dtaSelected = event.params.data;
                console.log(dtaSelected);
                $("#kodebarang3").val(dtaSelected.id);
                $("#namabarang3").val(dtaSelected.text);

                $("#lbljumlah3").text(dtaSelected.satuan);
                $("#satuan3").val(dtaSelected.satuan);

                $("#jmljual3").val(dtaSelected.jml_jual);
                $("#hargajual3").val(dtaSelected.h_beli);
                $("#hargaretur3").val(dtaSelected.h_retur);

                $('#nobatch3').html('');
                $.ajax({
                    url: "/retur/getnobatch",
                    type: 'POST',
                    data: {
                        no_rawat: $('#norawat').val(),
                        kode_brng: dtaSelected.id
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        if (response.code == 200) {
                            if (response.list_batch.length == 1) {
                                $('#nobatch3').append('<option val="' + response.list_batch[0]
                                    .no_batch + '">' + response.list_batch[0].no_batch +
                                    '</option>');
                            } else {
                                for (let i = 0; i < response.list_batch.length; i++) {
                                    $('#nobatch3').append('<option val="' + response.list_batch[
                                        i]
                                        .no_batch + '">' + response.list_batch[i].no_batch +
                                        '</option>'
                                    );
                                }
                            }

                            $('#nobatch3').trigger('change');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })

            });

            $("#modalNewItemretur").modal('show')
        });

        $('#jumlah3').on('input', function () {
            subtotal = parseInt($('#jumlah3').val()) * parseInt($('#hargaretur3').val())
            $('#subtotal3').val(subtotal ? subtotal : 0);


            if ($('#jumlah3').val() > parseInt($('#jmljual3').val())) {
                $("#keteranganjumlahretur").show();
            } else {
                $("#keteranganjumlahretur").hide();

            }
        });

        $("#btnCari2").click(function () {
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });

            getretur();
        });

        $("#btnCari").click(function () {
            getResep();
        });
    </script>
@endsection