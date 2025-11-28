@extends('layouts.main')

@section('title')
    <title>Laporan | Penggunaan Obat</title>
@endsection

@section('content')
    <section class="section row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Penggunaan Obat
                </div>
                <div class="card-body">
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
                                            <input type="date" class="form-control form-control-sm" id="datepickerFrom1"
                                                name="datepickerFrom1" {{--
                                                value="{{ date('Y-m-d', strtotime('-7 days')) }}"> --}}
                                            value="{{ date('Y-m-d') }}">
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
                                            <input type="date" class="form-control form-control-sm" id="datepickerTO1"
                                                name="datepickerTO1" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-md-4">
                                    <div class="form-group">

                                        <label for="" class="text-white">-</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                Obat
                                            </span>
                                            <select class="form-control form-control-sm" id="obat">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <div class="btn-group float-end" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-warning" id="btnCari"><i
                                                class="bi bi-search"></i></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-minimal ">
                        <table class="table" id="tableResep1">
                            <thead>
                                <tr>
                                    <th>Kode barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
    </section>
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

            sign1 = $('.sigPad2').signaturePad({
                drawOnly: true,
                drawBezierCurves: true,
                clear: 'button[type=reset]',
                clear: '.reset',
                lineTop: 140,
                penColour: '#000000',
                penWidth: 3,
            });


            $("#obat").select2({
                ajax: {
                    url: "/data/getDataobat",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            kd_bangsal: 'A1',
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
                theme: "bootstrap-5",
                closeOnSelect: true
            });
            getobat();
        });

        function getobat() {
            console.log($('#obat').val());

            if ($('#obat').val() == '' || $('#obat').val() == null) {
                $('#obat').focus();
                $("#obat").addClass("is-invalid");
            } else {
                $("#obat").removeClass("is-invalid");
                // console.log('tes');

                swal.fire({
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    width: '140px',
                    didOpen: () => {
                        swal.showLoading();
                    }
                });
                $("#tableResep1").DataTable().destroy()
                $("#tableResep1 tbody").html('')

                $.ajax({
                    url: "/penggunaanObat/getobat",
                    type: 'POST',
                    data: {
                        from: $('#datepickerFrom1').val(),
                        to: $('#datepickerTO1').val(),
                        kode_brng: $('#obat').val(),
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        row = '';
                        if (response.code == 200) {
                            if (response.data_obat) {
                                if (response.data_obat.length > 0) {
                                    jumlah = 0;
                                    for (let i = 0; i < response.data_obat.length; i++) {

                                        jumlahobat = 0;
                                        if (response.data_obat[i].jml_kronis != null) {
                                            jumlahobat = parseInt(response.data_obat[i].jml_kronis);
                                        } else {
                                            jumlahobat = parseInt(response.data_obat[i].jml);
                                        }

                                        if (i == 0) {
                                            row += '<tr class="table-warning">';
                                            row += '<td>' + response.data_obat[i].kode_brng + '</td>';
                                            row += '<td>' + response.data_obat[i].nama_brng + '</td>';
                                            row += '<td>' + response.data_obat[i].kode_sat + '</td>';
                                            row += '<td></td>';
                                            row += '</tr>';

                                            row += '<tr>';
                                            row += '<td></td>';
                                            row += '<td>' + response.data_obat[i].tgl_perawatan + ' | ' + response.data_obat[i].jam + ' | ' + response.data_obat[i].no_rawat + ' | ' + response.data_obat[i].no_resep + ' | ' + response.data_obat[i].no_rkm_medis + ' | <strong>' + response.data_obat[i].nm_pasien + '</strong></td>';
                                            row += '<td>' + jumlahobat + '</td>';
                                            row += '<td>' + response.data_obat[i].status + '</td>';
                                            row += '</tr>';
                                        } else {
                                            row += '<tr>';
                                            row += '<td></td>';
                                            row += '<td>' + response.data_obat[i].tgl_perawatan + ' | ' + response.data_obat[i].jam + ' | ' + response.data_obat[i].no_rawat + ' | ' + response.data_obat[i].no_resep + ' | ' + response.data_obat[i].no_rkm_medis + ' | <strong>' + response.data_obat[i].nm_pasien + '</strong></td>';
                                            row += '<td>' + jumlahobat + '</td>';
                                            row += '<td>' + response.data_obat[i].status + '</td>';
                                            row += '</tr>';
                                        }

                                        jumlah += parseInt(jumlahobat);



                                    }
                                    row += '<tr class="table-info">';
                                    row += '<td style="display:none"></td>'
                                    row += '<td colspan="2" class="text-end"><strong>Total :</strong></td>';
                                    row += '<td colspan="2"><strong>' + jumlah + '</strong></td>';
                                    row += '<td style="display:none"></td>'
                                    row += '</tr>';


                                } else {
                                    row += '<tr class="table-warning">';
                                    row += '<td colspan="4"><strong><center>Data Tidak Ditemukan, Silahkan pilih obat pada kolom yang tersedia</center></strong></td>';
                                }
                            } else {
                                row += '<tr class="table-warning">';
                                row += '<td colspan="4"><strong><center>Data Tidak Ditemukan, Silahkan pilih obat pada kolom yang tersedia</center></strong></td>';
                            }
                        } else {
                            row += '<tr class="table-warning">';
                            row += '<td colspan="4"><strong><center>Data Tidak Ditemukan, Silahkan pilih obat pada kolom yang tersedia</center></strong></td>';
                        }
                        $("#tableResep1 tbody").html(row)
                        $('#tableResep1').DataTable(
                            {
                                "paging": false,
                                "ordering": false,
                                "pageLength": 50,
                                "lengthChange": true,
                                // lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                                "bInfo": false,
                                "dom": 'Bfrtip',
                                "buttons": [{
                                    extend: 'excel',
                                    className: "btn btn-success",
                                    title: 'Penggunaan Obat',
                                    text: '<i class="bi bi-printer-fill"></i>',
                                    titleAttr: 'Export Excel',
                                }]
                            });
                        swal.close();
                    },
                    error: function (xhr, status, error) {

                        swal.close();
                        console.log(error);
                    }
                })
            }

        }


        $("#btnCari").click(function () {
            getobat();
        });
    </script>
@endsection