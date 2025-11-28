@extends('layouts.main')

@section('title')
    <title>Transaksi | Permintaan</title>
@endsection

@section('content')
    <section class="section row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 ">
                            <h4 class="card-title">Mutasi Obat</h4>
                        </div>
                        {{-- <div class="col-6 ">
                            <a class="btn icon icon-left btn-success float-end" id="btnAdd"><i
                                    class="bi bi-database-add"></i></a>
                        </div> --}}
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
                                    <input type="date" class="form-control" id="datepickerTO1" name="datepickerTO1"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <button type="" class="btn btn-warning float-end" id="btnCari">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12" hidden>
            <div class="card">
                <div class="card-header">
                    {{-- <h4 class="card-title">Permintaan</h4> --}}
                    <div class="row">
                        <div class="col-6 ">
                            <h4 class="card-title">Permintaan</h4>
                        </div>
                        <div class="col-6 ">
                            <a class="btn icon icon-left btn-success float-end" id="btnAdd"><i
                                    class="bi bi-database-add"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-minimal">
                        <table class="table" id="tablePermintaan">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Asal</th>
                                    <th>Tujuan</th>
                                    <th>keterangan</th>
                                    <th>Petugas</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">History</h4>
                    <div class="col-xl-12 col-md-12">
                        <button type="" class="btn btn-success float-end text-white" id="btnaddmutasi"><i
                                class="bi bi-cart-plus-fill"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-minimal">
                        <table class="table" id="tableBarangMutasi">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Barang</th>
                                    <th>No. Batch</th>
                                    <th>No. Faktur</th>
                                    <th>Tanggal</th>
                                    <th>Asal</th>
                                    <th>Tujuan</th>
                                    <th>keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade text-left" id="modalAddmutasi" role="dialog" aria-labelledby="myModalLabel140"
        data-bs-backdrop="false">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel140">
                        Mutasi Barang
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8 col-md-6" hidden>
                            <div class="form-group">
                                <label for="basicInput">No. Perimtaaan</label>
                                <input type="text" class="form-control form-control-sm" id="noPerimtaaan" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Tgl. Perimtaaan</label>
                                <input type="date" class="form-control form-control-sm" id="tglPerimtaaan"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Dari</label>
                                <select class="form-control" id="dari">
                                    <option value="GO" selected>Gudang Obat</option>
                                    <option value="A1">Apotek</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Tujuan</label>
                                <select class="form-control" id="tujuan">
                                    <option value="A1" selected>Apotek</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Keterangan</label>
                                <textarea type="text" class="form-control form-control-sm" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary">
                        <div class="card-header">
                            <span class="card-title">List Obat</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table tableOrder" id="tableOrder">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Stok Asal</th>
                                            <th>Stok Tujuan</th>
                                            <th>Jumlah diminta</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td>
                                                {{-- <center> --}}

                                                    <button type="button" class="btn icon btn-primary icon-left"
                                                        id="addobat"><i class="bi bi-plus-circle"></i></button>
                                                    {{--
                                                </center> --}}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="button" class="btn btn-success btn-sm ms-1" id="btnsavemutasi">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>

                    {{-- <button type="button" class="btn btn-warning btn-sm ms-1" id="btnvalidasipermintaan">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Validasi</span>
                    </button> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalAddBarang" role="dialog" aria-labelledby="myModalLabel140">
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
                    <form class="form" id="formadditem" data-parsley-validate>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="kodebarang">Barang</label>
                                    <select class="form-control" id="barang" data-parsley-required="true">
                                        {{-- <option value="-" disabled selected>-</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Nama Barang</label>
                                    <input type="text" class="form-control form-control-sm" id="namabarang" disabled>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Kode Barang</label>
                                    <input type="text" class="form-control form-control-sm" id="kodebarang" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-6">
                                <div class="form-group">
                                    <label for="basicInput">Stok diunit</label>
                                    <div class="input-group input-group-sm">
                                        <input type="number" class="form-control" aria-describedby="lbljumlah" id="stokunit"
                                            disabled>
                                        <span class="input-group-text lbljumlah" id="lbljumlah"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-6">
                                <div class="form-group">
                                    <label for="basicInput">Stok Tujuan</l abel>
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" aria-describedby="lbljumlah"
                                                id="stoktujuan" disabled>
                                            <span class="input-group-text lbljumlah" id="lbljumlah"></span>
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Jumlah</label>
                                    <div class="input-group input-group-sm">
                                        <input type="number" class="form-control" aria-describedby="lbljumlah" id="jumlah"
                                            data-parsley-required="true">
                                        <span class="input-group-text lbljumlah" id="lbljumlah"></span>
                                    </div>
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
                </form>
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
        $(document).ready(function (e) {

            getBangsal('tujuan')
            getpermintaanobat();
            // getmutasiBarang();
            // e.preventDefault();

            $("#barang").select2({
                ajax: {
                    url: "/permintaan/getDataobat",
                    type: "POST",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            searchTerm: params.term,
                            dari: $("#dari").val(),
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: false,
                },
                minimumInputLength: 2,
                escapeMarkup: function (markup) {
                    return markup;
                },
                dropdownParent: $("#modalAddBarang"),
                theme: "bootstrap-5",
                closeOnSelect: true
            }).on('select2:select', function (event) {
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
                    success: function (response) {
                        console.log(response);
                        if (response.code == 200) {
                            $("#stokunit").val(response.stokasal)
                            $("#stoktujuan").val(response.stoktujuan)
                        }

                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            });
        })

        $('#btnAdd').click(function (e) {
            $('#modalAddPermintaan').modal('show')
            $('#btnsavepermintaan').show();
            $('#btnvalidasipermintaan').hide();
        });

        function getpermintaanobat() {
            $('#tablePermintaan tbody').html('');
            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: "/permintaan/getpermintaanobat",
                type: 'POST',
                data: {
                    from: $('#datepickerFrom1').val(),
                    to: $('#datepickerTO1').val()
                },
                dataType: 'json',
                success: function (response) {
                    getmutasiBarang();
                    console.log(response);
                    if (response.code == 200) {
                        // swal.close();
                        if (response.permintaan) {
                            row = '';
                            for (let i = 0; i < response.permintaan.length; i++) {
                                row += '<tr>';
                                row += '<td>' + response.permintaan[i].id + '</td>';
                                row += '<td>' + response.permintaan[i].tgl_permintaan + '</td>';
                                row += '<td>' + response.permintaan[i].nmdari + '</td>';
                                row += '<td>' + response.permintaan[i].nmtujuan + '</td>';
                                row += '<td>' + (response.permintaan[i].keterangan != null ? response
                                    .permintaan[i].keterangan : '') + '</td>';
                                row += '<td>' + response.permintaan[i].nama + '</td>';

                                if (response.permintaan[i].status == 1) {
                                    row += '<td>';
                                    row +=
                                        '<button type="button" id="validasiobat" class="btn icon btn-sm btn-info validasiobat"';
                                    row += 'data-id="' + response.permintaan[i].id + '"';
                                    row += 'data-tgl="' + response.permintaan[i].tgl_permintaan + '"';
                                    row += 'data-dari="' + response.permintaan[i].dari + '"';
                                    row += 'data-nmdari="' + response.permintaan[i].nmdari + '"';
                                    row += 'data-tujuan="' + response.permintaan[i].tujuan + '"';
                                    row += 'data-nmtujuan="' + response.permintaan[i].nmtujuan + '"';
                                    row += 'data-keterangan="' + response.permintaan[i].keterangan + '"';
                                    row += 'data-list="' + response.permintaan[i].list_obat + '"';
                                    row += '><i class="bi bi-card-checklist"></i></button>';

                                    row += '</td>';
                                } else {
                                    row += '<td><span class="badge bg-success">Sudah</span></td>';
                                }
                                row += '</tr>';
                            }

                            $('#tablePermintaan tbody').append(row);

                        }
                    }
                    swal.close();
                },
                error: function (xhr, status, error) {
                    getmutasiBarang();
                    swal.close();
                    console.log(error);
                }
            })
        }


        $('#btnaddmutasi').click(function (e) {
            $('#modalAddmutasi').modal('show')
        });

        function getmutasiBarang() {
            $.ajax({
                url: "/permintaan/getmutasiBarang",
                type: 'POST',
                data: {
                    from: $('#datepickerFrom1').val(),
                    to: $('#datepickerTO1').val()
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.code == 200) {
                        // swal.close();
                        if (response.barang_mutasi) {
                            $("#tableBarangMutasi").DataTable().destroy()
                            var Table = $('#tableBarangMutasi').dataTable(
                                {
                                    "aaData": response.barang_mutasi,
                                    "columns": [
                                        // {
                                        //     "mData": null,
                                        //     "bSortable": false,
                                        //     "mRender": function (data, type, full) {
                                        //         var span = '';

                                        //         span += data.nama_brng + '<br>'
                                        //         span += '<span class="badge bg-light-danger">' +
                                        //             data.no_batch + '</span>'
                                        //         span += '<span class="badge bg-light-info">' +
                                        //             data.no_faktur + '</span>'

                                        //         return span;

                                        //     },
                                        // },
                                        {
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
                                            "data": "tanggal"
                                        },
                                        {
                                            "data": "dari"
                                        },
                                        {
                                            "data": "tujuan"
                                        },
                                        {
                                            "data": "keterangan"
                                        },
                                        {
                                            "data": "jml"
                                        },
                                        {
                                            "data": "harga"
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
                                    "dom": 'Bfrtip',
                                    "buttons": [{
                                        extend: 'excel',
                                        className: "btn btn-success",
                                        title: 'Mutasi Barang',
                                        text: '<i class="bi bi-printer-fill"></i>',
                                        titleAttr: 'Export Excel',
                                    }]
                                });

                            swal.close();
                        }
                    } else {
                        swal.close();


                    }
                },
                error: function (xhr, status, error) {

                    console.log(error);
                }
            });
        }

        $('#addobat').click(function (e) {
            $('#modalAddBarang').modal('show')
        });

        $("#formadditem").on('submit', function (e) {
            e.preventDefault();
            if ($(this).parsley().isValid()) {
                var row = '';
                row += '<tr ';
                row += 'data-kodebarang="' + $('#barang').val();
                row += '" data-namabrng="' + $('#namabarang').val();
                row += '" data-jumlah="' + $('#jumlah').val();
                row += '" data-stokunit="' + $('#stokunit').val();
                row += '" data-stoktujuan="' + $('#stoktujuan').val();
                row += '">';

                row += '<td>' + $('#barang').val() + '</td>';
                row += '<td>' + $('#namabarang').val() + '</td>';
                row += '<td>' + $('#stokunit').val() + '</td>';
                row += '<td>' + $('#stoktujuan').val() + '</td>';
                row += '<td>' + $('#jumlah').val() + '</td>';
                row += '<td>';
                row +=
                    '<button class="btn icon btn-danger btn_delete btn-sm"><i class="bi bi-archive-fill"></i></button> ';
                row += '</td>';
                row += '</tr>';

                $('#barang').val(null).trigger('change')
                $("#tableOrder tbody").append(row);
                $(this).trigger("reset");
                $('#modalAddBarang').modal('hide')
            }
        });

        $('#tableOrder').on('click', '.btn_delete', function () {
            $(this).closest("tr").remove();
        });

        $('#btnsavemutasi').click(function (e) {
            Swal.fire({
                target: document.getElementById('modalAddmutasi'),
                title: 'Apa Anda Yakin?',
                text: "Periksa Kembali, Data Permintaan Obat yang sudah di input tidak bisa diubah maupun dihapus",
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
                    $("table.tableOrder tbody tr").each(function (i) {
                        var arrayval = [];
                        // var key = ['kode', 'nama', 'stokasal', 'stoktujuan', 'jumlah', 'aksi'];              
                        $("td", this).each(function (j) {
                            arrayval.push($(this).text())
                        });
                        arraylistitem.push(arrayval);
                    });

                    console.log(arraylistitem);
                    if (arraylistitem.length > 0) {
                        $.ajax({
                            url: "/permintaan/postValidasiPermintaan",
                            type: 'POST',
                            data: {

                                id: $("#noPerimtaaan").val(),
                                tanggal: $("#tglPerimtaaan").val(),
                                kd_bangsalke: $('#tujuan').val(),
                                kd_bangsaldari: $('#dari').val(),
                                keterangan: $("#keterangan").val(),

                                list_obat: arraylistitem

                            },
                            dataType: 'json',
                            success: function (response) {
                                console.log(response);
                                if (response.code == 200) {
                                    // Swal.close();
                                    $('#modalAddmutasi').modal('hide')
                                    Swal.fire({
                                        title: "Berhasil",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                    // getpermintaanobat();
                                    getmutasiBarang();
                                } else {
                                    // Swal.close();
                                    $('#modalAddmutasi').modal('hide')
                                    Swal.fire({
                                        title: "Gagal",
                                        text: "Periksa Kembali data / Silahkan Hubungi SIMRS",
                                        icon: "error",
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                }

                            },
                            error: function (xhr, status, error) {
                                console.log(error);
                                $('#modalAddmutasi').modal('hide')
                                // Swal.close();
                                Swal.fire({
                                    title: "Gagal",
                                    text: "Periksa Kembali data / Silahkan Hubungi SIMRS",
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })


                    } else {
                        Swal.fire({
                            target: document.getElementById('modalAddmutasi'),
                            title: "Item Obat Masih Kosong / Belum Sesuai",
                            html: 'Silahkan Masukan Obat dengan klik <span class="badge bg-primary"><i class="bi bi-plus-circle"></i></span>',
                            icon: "warning",
                        })
                    }
                }
            })

        });

        $('#btnCari').click(function (e) {
            // getpermintaanobat();
            getmutasiBarang();
        });
    </script>
@endsection