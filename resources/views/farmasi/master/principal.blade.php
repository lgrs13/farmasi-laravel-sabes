@extends('layouts.main')

@section('title')
    <title>Master | Principal (I.F)</title>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 ">
                        <h4 class="card-title">Principal</h4>
                    </div>
                    <div class="col-6 ">
                        <a class="btn icon icon-left btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalADD" id="btnAdd"><i class="bi bi-database-add"></i></a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>No. tlp</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade text-left" id="modalADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel140">ADD Principal
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="nama1">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Alamat</label>
                                <input type="text" class="form-control form-control-sm" id="alamat1">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Kota</label>
                                <input type="text" class="form-control form-control-sm" id="kota1">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">No. tlp</label>
                                <input type="text" class="form-control form-control-sm" id="tlp1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="button" class="btn btn-warning ms-1" id="btnsaveobat">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalEDIT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Edit Principal
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12" hidden>
                            <div class="form-group">
                                <label for="basicInput">Kode</label>
                                <input type="text" class="form-control form-control-sm" id="kode2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="nama2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Alamat</label>
                                <input type="text" class="form-control form-control-sm" id="alamat2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Kota</label>
                                <input type="text" class="form-control form-control-sm" id="kota2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">No. tlp</label>
                                <input type="text" class="form-control form-control-sm" id="tlp2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="button" class="btn btn-warning ms-1" id="btnedit">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
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
            getData();
        })


        function getData() {
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: "/principal/getData",
                type: 'POST',
                data: {

                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        // swal.close();
                        if (response.data) {
                            $("#table1").DataTable().destroy()
                            var Table = $('#table1').DataTable({
                                "aaData": response.data,
                                "columns": [{
                                        "data": "kode_industri"
                                    },
                                    {
                                        "data": "nama_industri"
                                    },
                                    {
                                        "data": "alamat"
                                    },
                                    {
                                        "data": "kota"
                                    },
                                    {
                                        "data": "no_telp"
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var button = '';
                                            button += '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                                            // button += '<button type="button" id="btnEdit" class="btn btn-sm btn-warning btnEdit"><i class="bi bi-pencil"></i></button>';
                                            button += '<button type="button" id="btnEdit" class="btn btn-sm btn-success btnEdit"';
                                            button += 'data-kodeindustri="' + data.kode_industri + '"';
                                            button += 'data-namaindustri="' + data.nama_industri + '"';
                                            button += 'data-alamat="' + data.alamat + '"';
                                            button += 'data-kota="' + data.kota + '"';
                                            button += 'data-notelp="' + data.no_telp + '"';
                                            button += '><i class="bi bi-pencil"></i></button>';
                                            button += '</div>';
                                            return button;

                                        },
                                    },

                                ],
                                "retrieve": true,
                                "paging": true,
                                // "destroy": true,
                                "lengthChange": false,
                                "searching": true,
                                "ordering": true,
                                "pageLength": 25,
                                "responsive": false,
                                "autoWidth": false,
                                "dom": 'Bfrtip',
                                "buttons": [{
                                    extend: 'excel',
                                    className: "btn btn-success",
                                    title: 'Master Principal ',
                                    text: '<i class="bi bi-printer-fill"></i>',
                                    titleAttr: 'Export Excel',
                                }]
                            });

                            Table.draw();
                            swal.close();
                        }
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


        $('#table1').on('click', '.btnEdit', function() {
            $('#kode2').val($(this).data('kodeindustri'));
            $('#nama2').val($(this).data('namaindustri'));
            $('#alamat2').val($(this).data('alamat'));
            $('#kota2').val($(this).data('kota'));
            $('#tlp2').val($(this).data('notelp'));
            $('#bank2').val($(this).data('namabank'));
            $('#rekening2').val($(this).data('rekening'));

            $('#modalEDIT').modal('show');
        })


        $('#btnsaveobat').click(function(e) {

            if ($('#nama1').val() == '') {
                $('#nama1').focus();
                $("#nama1").addClass("is-invalid");
            } else {
                $.ajax({
                    url: "/principal/postData",
                    type: 'POST',
                    data: {
                        nama_industri: $('#nama1').val(),
                        alamat: $('#alamat1').val(),
                        kota: $('#kota1').val(),
                        no_telp: $('#tlp1').val(),
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.code == 200) {
                            Swal.fire({
                                title: "Berhasil",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1000
                            }).then((result) => {
                                getData();
                                $('#nama1').val('');
                                $('#alamat1').val('');
                                $('#kota1').val('');
                                $('#tlp1').val('');

                                $('#modalADD').modal('hide');
                            });

                        } else {
                            $('#modalADD').modal('hide');
                            Swal.fire(
                                'Gagal',
                                'Data Gagal Disimpan, Periksa Kembali data / Hubugi SIMRS',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        $('#modalADD').modal('hide');
                        Swal.fire(
                            'Gagal',
                            'Data Gagal Disimpan, Periksa Kembali data / Hubugi SIMRS',
                            'error'
                        );
                    }
                })
            }
        })

        $('#btnedit').click(function(e) {

            if ($('#nama2').val() == '') {
                $('#nama2').focus();
                $("#nama2").addClass("is-invalid");
            } else {

                $.ajax({
                    url: "/principal/updateData",
                    type: 'POST',
                    data: {
                        kode_suplier: $('#kode2').val(),
                        nama_suplier: $('#nama2').val(),
                        alamat: $('#alamat2').val(),
                        kota: $('#kota2').val(),
                        no_telp: $('#tlp2').val(),
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.code == 200) {
                            Swal.fire({
                                title: "Berhasil",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1000
                            }).then((result) => {
                                getData();
                                $('#nama1').val('');
                                $('#alamat1').val('');
                                $('#kota1').val('');
                                $('#tlp1').val('');
                                $('#bank1').val('');
                                $('#rekening1').val('');

                                $('#modalEDIT').modal('hide');
                            });

                        } else {
                            Swal.fire(
                                'Gagal',
                                'Data Gagal Disimpan, Periksa Kembali data / Hubugi SIMRS',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        Swal.fire(
                            'Gagal',
                            'Data Gagal Disimpan, Periksa Kembali data / Hubugi SIMRS',
                            'error'
                        );
                    }
                })
            }
        })
    </script>
@endsection
