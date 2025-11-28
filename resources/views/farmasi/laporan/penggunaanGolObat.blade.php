@extends('layouts.main')

@section('title')
    <title>Laporan | Penggunaan Obat </title>
@endsection

@section('content')
    <section class="section row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Penggunaan Obat Berdasarkan Golongan
                </div>
                <div class="card-body">
                    <div class="card bg-light-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
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
                                <div class="col-xs-12 col-md-3">
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
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">

                                        <label for="" class="text-white">-</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                Golongan
                                            </span>
                                            <select class="form-control form-control-sm" id="golongan">
                                                <option value="G47">Antibiotik</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">

                                        <label for="" class="text-white">-</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                Jenis
                                            </span>
                                            <select class="form-control form-control-sm" id="jenis">
                                                <option value="1">Ralan</option>
                                                <option value="2">Ranap</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <div class="btn-group float-end" role="group" aria-label="Basic example">
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
                                    <th>Kd. Poli</th>
                                    <th>PoliKlinik</th>
                                    <th>Jumalh Pasien</th>
                                    <th>Jumlah Golongan</th>
                                    <th>Persentase</th>
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
        $(document).ready(function(e) {

            sign1 = $('.sigPad2').signaturePad({
                drawOnly: true,
                drawBezierCurves: true,
                clear: 'button[type=reset]',
                clear: '.reset',
                lineTop: 140,
                penColour: '#000000',
                penWidth: 3,
            });


            $("#golongan").select2({
                ajax: {
                    url: "/data/getGolongans2",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
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
                theme: "bootstrap-5",
                closeOnSelect: true
            });
            
            getobat();
        });

        function getobat() {
            console.log($('#golongan').val());

            if ($('#golongan').val() == '' || $('#golongan').val() == null) {
                $('#golongan').focus();
                $("#golongan").addClass("is-invalid");
            } else {
                $("#golongan").removeClass("is-invalid");
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
                    url: "/penggunaanGolObat/getobat",
                    type: 'POST',
                    data: {
                        from: $('#datepickerFrom1').val(),
                        to: $('#datepickerTO1').val(),
                        kode_brng: $('#obat').val(),
                        kode_golongan: $('#golongan').val(),
                        jenis: $('#jenis').val(),
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        row = '';
                        if (response.code == 200) {
                            if (response.data_obat) {
                                if (response.data_obat.length > 0) {
                                    jumlah = 0;
                                    row += '<tr class="table-warning">';
                                    row += '<td> Golongan Obat : ' + $('#golongan option:selected').text(); + '</td>';
                                    row += '<td>' + $('#datepickerFrom1').val() + '</td>';
                                    row += '<td>Sampai</td>'
                                    row += '<td>' + $('#datepickerTO1').val() + '</td>';
                                    row += '<td></td>'
                                    row += '</tr>';

                                    for (let i = 0; i < response.data_obat.length; i++) {

                                        row += '<tr class="">';
                                        row += '<td>' + response.data_obat[i].kode + '</td>';
                                        row += '<td>' + response.data_obat[i].nama + '</td>';
                                        row += '<td>' + response.data_obat[i].jumlah_pasien + '</td>';
                                        row += '<td>' + response.data_obat[i].pengguna_antibiotik + '</td>';
                                        row += '<td>' + Math.round(response.data_obat[i].persentase) + ' %</td>';
                                        row += '</tr>';
                                    }
                                }
                            }
                        }
                        $("#tableResep1 tbody").html(row)
                        $('#tableResep1').DataTable({
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
                                title: 'Penggunaan Obat Berdasarkan Golongan',
                                text: '<i class="bi bi-printer-fill"></i>',
                                titleAttr: 'Export Excel',
                            }]
                        });
                        swal.close();
                    },
                    error: function(xhr, status, error) {

                        swal.close();
                        console.log(error);
                    }
                })
            }

        }


        $("#btnCari").click(function() {
            getobat();
        });
    </script>
@endsection
