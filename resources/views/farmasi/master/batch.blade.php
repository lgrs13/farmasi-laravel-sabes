@extends('layouts.main')

@section('title')
    <title>Master | Batch</title>
@endsection

@section('content')
    <section class="section row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-6 ">
                        <h4 class="card-title">Batch</h4>
                    </div>
                    <div class="card  bg-light-primary mt-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Depo</label>
                                        <select class="form-control form-control-sm" id="depo">
                                            <option value="GO" selected>Gudang Obat</option>
                                            <option value="A1">Apotek</option>
                                            <option value="-">Semua</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="home" aria-selected="true">Data Batch</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="profile" aria-selected="false">History Stok Opname</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link bg-light-danger" id="profile-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="profile" aria-selected="false">Stok 0</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive datatable-minimal">
                                <table class="table" id="tablebarang">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Barang</th>
                                            <th>No. Batch</th>
                                            <th>No. Faktur</th>
                                            <th>Bangsal</th>
                                            <th>Tgl. Kadaluarsa</th>
                                            <th>Harga</th>
                                            <th>Total Stok</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card">
                                <div class="card-header mb-5 bg-light-primary">
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
                                                    <input type="date" class="form-control form-control-sm" id="datepickerFrom1" name="datepickerFrom1" value="{{ date('Y-m-d', strtotime('-7 days')) }}">
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
                                                    <input type="date" class="form-control form-control-sm" id="datepickerTO1" name="datepickerTO1" value="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive datatable-minimal">
                                        <table class="table" id="tableHitory">
                                            <thead>
                                                <tr>
                                                    <th>Tgl. Opname</th>
                                                    <th>Nama</th>
                                                    <th>No. Batch</th>
                                                    <th>No. Faktur</th>
                                                    <th>Bangsal</th>
                                                    <th>Real</th>
                                                    <th>Lebih</th>
                                                    <th>Nominal (Rp)</th>
                                                    <th>Kurang</th>
                                                    <th>Nominal (Rp)</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive datatable-minimal">
                                <table class="table" id="tablebarang2">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Barang</th>
                                            <th>No. Batch</th>
                                            <th>No. Faktur</th>
                                            <th>Bangsal</th>
                                            <th>Tgl. Kadaluarsa</th>
                                            <th>Harga</th>
                                            <th>Total Stok</th>
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
        </div>
    </section>

    <div class="modal fade text-left" id="modalEditbarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Stok Opname
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label">Tanggal Opname</label>
                                <input type="date" class="form-control form-control-sm" id="tanggalopname" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label class="form-label"> kode Barang</label>
                                <input type="text" class="form-control form-control-sm" id="kdbarang" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">No. Batch</label>
                                <input type="text" class="form-control form-control-sm" id="nobatch" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">No. Faktur</label>
                                <input type="text" class="form-control form-control-sm" id="nofaktur" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Harga Beli</label>
                                <input type="text" class="form-control form-control-sm" id="hargabeli" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4" hidden>
                            <div class="form-group">
                                <label for="basicInput">Kode Bangsal</label>
                                <input type="text" class="form-control form-control-sm" id="kodebangsal" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Bangsal</label>
                                <input type="text" class="form-control form-control-sm" id="bangsal" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Stok Asal</label>
                                <input type="number" class="form-control form-control-sm" id="stokasal" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Harga (Rp)</label>
                                <input type="text" class="form-control form-control-sm" id="harga" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Stok Real</label>
                                <input type="number" class="form-control form-control-sm" id="stok">
                                <p><small class="text-danger" for="">Tekan enter untuk menghitung selisih</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Selisih</label>
                                <input type="number" class="form-control form-control-sm" id="selisih" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nominal (Rp)</label>
                                <input type="text" class="form-control form-control-sm" id="nominal" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Tgl Kadaluarsa</label>
                                <input type="date" class="form-control form-control-sm" id="tglkadaluarsa">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Keterangan</label>
                                <textarea class="form-control form-control-sm" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm ms-1" id="btnsaveopname">
                        Simpan
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="assets/extensions/datatables.net-bs5/js/dataTables.js"></script>

    <script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/dataTables.buttons.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/buttons.bootstrap5.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/jszip.min.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/pdfmake.min.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/vfs_fonts.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/buttons.print.min.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/buttons.html5.min.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/buttons.colVis.min.js"></script>

    <script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/static/js/pages/datatables.js"></script>

    <script>
        $(document).ready(function() {           
            getDataBarang();
            getHistoryopname();
        })

        function getDataBarang() {
            // console.log($('#depo').val());
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: "/batch/getDataBarang",
                type: 'POST',
                data: {
                    kd_bangsal: $('#depo').val()
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        // swal.close();
                        if (response.databarang) {
                            $("#tablebarang").DataTable().destroy()
                            var Table = $('#tablebarang').dataTable({
                                "aaData": response.databarang,
                                "columns": [{
                                        "data": "kode_brng"
                                    },
                                    {
                                        "data": "nama_brng"
                                    },
                                    {
                                        "data": "no_batch"
                                    },
                                    {
                                        "data": "no_faktur"
                                    },
                                    {
                                        "data": "nm_bangsal"
                                    },
                                    {
                                        "data": "tgl_kadaluarsa"
                                    },
                                    {
                                        "data": "harga_jual"
                                    },
                                    {
                                        "data": "stok"
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            // console.log(data.no_batch);

                                            var button = '';
                                            button +=
                                                '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';

                                            button +=
                                                '<button type="button" id="btnEdit" class="btn btn-warning btnEdit" ';
                                            button += 'data-kode_brng="' + data.kode_brng + '"';
                                            button += 'data-nama_brng="' + data.nama_brng + '"';
                                            button += 'data-no_batch="' + data.no_batch + '"';
                                            button += 'data-no_faktur="' + data.no_faktur + '"';
                                            button += 'data-nm_bangsal="' + data.nm_bangsal +
                                                '"';
                                            button += 'data-kd_bangsal="' + data.kd_bangsal +
                                                '"';
                                            button += 'data-stok="' + data.stok + '"';
                                            button += 'data-hargajual="' + data.harga_jual +
                                                '"';
                                            button += 'data-hargabeli="' + data.harga_beli +
                                                '"';
                                            button += 'data-tglkadaluarsa="' + data
                                                .tgl_kadaluarsa + '"';
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
                                "autoWidth": false,
                                "order": [
                                    [0, 'desc']
                                ],
                                "dom": 'Bfrtip',
                                "buttons": [{
                                    extend: 'excel',
                                    className: "btn btn-success",
                                    title: 'Data Batch ' + $('#depo option:selected').text(),
                                    text: '<i class="bi bi-printer-fill"></i>',
                                    titleAttr: 'Export Excel',
                                }]
                            });
                        }

                        if (response.databarangkosong) {
                            $("#tablebarang2").DataTable().destroy()
                            var Table = $('#tablebarang2').dataTable({
                                "aaData": response.databarangkosong,
                                "columns": [{
                                        "data": "kode_brng"
                                    },
                                    {
                                        "data": "nama_brng"
                                    },
                                    {
                                        "data": "no_batch"
                                    },
                                    {
                                        "data": "no_faktur"
                                    },
                                    {
                                        "data": "nm_bangsal"
                                    },
                                    {
                                        "data": "tgl_kadaluarsa"
                                    },
                                    {
                                        "data": "harga_jual"
                                    },
                                    {
                                        "data": "stok"
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            // console.log(data.no_batch);

                                            var button = '';
                                            button +=
                                                '<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">';

                                            button +=
                                                '<button type="button" id="btnEdit" class="btn btn-warning btnEdit" ';
                                            button += 'data-kode_brng="' + data.kode_brng + '"';
                                            button += 'data-nama_brng="' + data.nama_brng + '"';
                                            button += 'data-no_batch="' + data.no_batch + '"';
                                            button += 'data-no_faktur="' + data.no_faktur + '"';
                                            button += 'data-nm_bangsal="' + data.nm_bangsal +
                                                '"';
                                            button += 'data-kd_bangsal="' + data.kd_bangsal +
                                                '"';
                                            button += 'data-stok="' + data.stok + '"';
                                            button += 'data-hargajual="' + data.harga_jual +
                                                '"';
                                            button += 'data-hargabeli="' + data.harga_beli +
                                                '"';
                                            button += 'data-tglkadaluarsa="' + data
                                                .tgl_kadaluarsa + '"';
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
                        swal.close();
                    } else {

                        swal.close();
                    }
                },
                error: function(xhr, status, error) {
                    swal.close();
                    console.log(error);
                }
            });

        }

        function getHistoryopname() {


            $.ajax({
                url: "/batch/getHistoryopname",
                type: 'POST',
                data: {
                    from: $('#datepickerFrom1').val(),
                    to: $('#datepickerTO1').val()
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        // swal.close();
                        if (response.databarang) {
                            var Table = $('#tableHitory').dataTable({
                                "aaData": response.databarang,
                                "columns": [{
                                        "data": "tanggal"
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var span = '';
                                            span += data.nama_brng + '<br>'
                                            span +=
                                                '<span class="badge bg-light-success mt-2">' +
                                                data.kode_brng + '</span>'
                                            return span;

                                        },
                                    },
                                    {
                                        "data": "no_batch"
                                    },
                                    {
                                        "data": "no_faktur"
                                    },
                                    {
                                        "data": "nm_bangsal"
                                    },
                                    {
                                        "data": "real"
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var span = '';
                                            span +=
                                                '<span class="badge bg-light-success mt-2">' +
                                                data.lebih + '</span>'
                                            return span;

                                        },
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var span = '';
                                            span +=
                                                '<span class="badge bg-light-success mt-2">' +
                                                data.nomilebih + '</span>'
                                            return span;

                                        },
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var span = '';
                                            span += '<span class="badge bg-light-danger">' +
                                                data.selisih + '</span><br>'
                                            return span;

                                        },
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var span = '';
                                            span += '<span class="badge bg-light-danger">' +
                                                data.nomihilang + '</span><br>'
                                            return span;

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
                                    [0, 'desc']
                                ],
                                "dom": 'Bfrtip',
                                "buttons": [{
                                    extend: 'excel',
                                    className: "btn btn-success",
                                    title: 'History Stok Opname',
                                    text: '<i class="bi bi-printer-fill"></i>',
                                    titleAttr: 'Export Excel',
                                }]
                            });
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // swal.close();
                    console.log(error);
                }
            });
        }

        $('#tablebarang').on('click', '.btnEdit', function() {
            // console.log($(this).data('no_batch'));

            $('#kdbarang').val($(this).data('kode_brng'));
            $('#namabarang').val($(this).data('nama_brng'));
            $('#nobatch').val($(this).data('no_batch'));
            $('#nofaktur').val($(this).data('no_faktur'));
            $('#kodebangsal').val($(this).data('kd_bangsal'));
            $('#bangsal').val($(this).data('nm_bangsal'));
            $('#stokasal').val($(this).data('stok'));
            $('#harga').val($(this).data('hargajual'));
            $('#hargabeli').val($(this).data('hargabeli'));
            $('#tglkadaluarsa').val($(this).data('tglkadaluarsa'));

            $('#stok').val('');
            $('#selisih').val('');
            $('#nominal').val('');
            $('#modalEditbarang').modal('show');
        });

        $('#tablebarang2').on('click', '.btnEdit', function() {
            // console.log($(this).data('no_batch'));

            $('#kdbarang').val($(this).data('kode_brng'));
            $('#namabarang').val($(this).data('nama_brng'));
            $('#nobatch').val($(this).data('no_batch'));
            $('#nofaktur').val($(this).data('no_faktur'));
            $('#kodebangsal').val($(this).data('kd_bangsal'));
            $('#bangsal').val($(this).data('nm_bangsal'));
            $('#stokasal').val($(this).data('stok'));
            $('#harga').val($(this).data('hargajual'));
            $('#hargabeli').val($(this).data('hargabeli'));
            $('#tglkadaluarsa').val($(this).data('tglkadaluarsa'));

            $('#stok').val('');
            $('#selisih').val('');
            $('#nominal').val('');
            $('#modalEditbarang').modal('show');
        });

        $('#stok').on('change', function() {
            $('#selisih').val((parseInt($('#stok').val()) - parseInt($('#stokasal').val())));
            $('#nominal').val((parseInt($('#selisih').val()) * parseInt($('#harga').val())));
        });

        // $('#btnsaveopname').on('click', function() {
        //     console.log('save');            
        // });

        $('#btnsaveopname').click(function(e) {
            if ($('#stok').val() == '') {
                $('#stok').focus();
                $("#stok").addClass("is-invalid");
            } else if ($('#stok').val() == '') {
                $('#selisih').focus();
                $("#selisih").addClass("is-invalid");
            } else if ($('#nominal').val() == '') {
                $('#nominal').focus();
                $("#nominal").addClass("is-invalid");
            } else {
                Swal.fire({
                    target: document.getElementById('modalEditbarang'),
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
                            url: "/batch/postStokOpname",
                            type: 'POST',
                            data: {

                                kode_brng: $("#kdbarang").val(),
                                h_beli: $("#hargabeli").val(),
                                tanggal: $("#tanggalopname").val(),
                                stok: $("#stokasal").val(),
                                real: $("#stok").val(),

                                selisih: $("#selisih").val(),
                                nominal: $("#nominal").val(),

                                keterangan: $("#keterangan").val(),
                                kd_bangsal: $("#kodebangsal").val(),

                                no_batch: $("#nobatch").val(),
                                no_faktur: $("#nofaktur").val(),

                                tgl_kadaluarsa: $("#tglkadaluarsa").val(),

                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.code == 200) {
                                    // console.log('test');

                                    $('#modalEditbarang').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Berhasil",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then((result) => {
                                        getDataBarang();
                                        getHistoryopname();
                                    });


                                    // getResep()
                                } else {
                                    $('#modalEditbarang').modal('hide')
                                    // swal.close();
                                    swal.fire({
                                        title: "Gagal",
                                        text: response.mesagge == '' ?
                                            "Periksa Kembali data / Silahkan Hubungi SIMRS" : response.mesagge,
                                        icon: "error",
                                    }).then((result) => {
                                        getDataBarang();
                                        getHistoryopname();
                                    });


                                }

                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                $('#modalEditbarang').modal('hide')
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

        $('#depo').on('change', function() {
            getDataBarang();
        });
    </script>
@endsection
