@extends('layouts.main')

@section('title')
<title>Laporan | Penggunaan Susu</title>
@endsection

@section('content')
<section class="section row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Laporan Penggeluaran Susu
            </div>
            <div class="card-body">
                <div class="card bg-light-primary">
                    <div class="card-body">
                        <div class="row">


                            <div class="col-xs-12 col-md-12">
                                <div class="form-group float-end">
                                    <label for="" class="text-white">-</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Pasien
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="norm" name="pasien">
                                        <button type="button" class="btn btn-warning btn-sm" id="btnCari"><i
                                                class="bi bi-search"></i></button>
                                    </div>
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
                                <th>No. RM</th>
                                <th>Pasien</th>
                                <th>Tgl. Jam Resep</th>
                                <th>Tgl. Jam Penyerahan</th>
                                <th>Jumlah Resep</th>
                                <th>TTD</th>
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
        // getPerawtan();
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
            url: "/penggunaanSusu/getlistpasien",
            type: 'POST',
            data: {
                no_rkm_medis: $('#norm').val(),
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.code == 200) {
                    $("#tableResep1").DataTable().destroy()
                    var Table = $('#tableResep1').dataTable({
                        "aaData": response.data_resep,
                        "columns": [
                            // {
                            //     "data": "no_resep"
                            // },

                            {
                                "data": "no_rawat"
                            },
                            {
                                "data": "no_rkm_medis"
                            },

                            {
                                "data": "nm_pasien"
                            },
                            {
                                "mData": null,
                                "bSortable": false,
                                "mRender": function (data, type, full) {
                                    var result = '';
                                    result += data.tgl_perawatan + '<br>'
                                    result += data.jam
                                    return result;

                                },
                            },
                            {
                                "data": "datetime_penyerahan"
                            },
                            {
                                "mData": null,
                                "bSortable": false,
                                "mRender": function (data, type, full) {
                                    var result = '';
                                    result += data.jml + ' ';
                                    result += data.kode_sat;
                                    return result;

                                },
                            },
                            {
                                "mData": null,
                                "bSortable": false,
                                "mRender": function (data, type, full) {
                                    var result = '';
                                    if (data.sign_pasien == 0) {
                                        result += '<span class="badge bg-danger"><i class="bi bi-x-square"></i></span>';
                                    } else {

                                        result += '<span class="badge bg-success"><i class="bi bi-check-square"></i></span>';
                                    }
                                    return result;

                                },
                            },
                        ],
                        "retrieve": true,
                        "paging": true,
                        "lengthChange": false,
                        "searching": true,
                        "ordering": true,
                        "pageLength": 70,
                        "responsive": false,
                        "autoWidth": false,
                        "order": [
                            [6, 'asc']
                        ],
                        "dom": 'Bfrtip',
                        "buttons": [{
                            extend: 'excel',
                            className: "btn btn-success",
                            title: 'HTKP',
                            text: '<i class="bi bi-printer-fill"></i>',
                            titleAttr: 'Export Excel',
                        }]
                    });

                    swal.close();
                } else {
                    swal.fire({
                        target: document.getElementById('modalvalidasi'),
                        title: "Warning",
                        text: "Data Tidak Ditemukan, Silahkan Cari menggunakan No. RM yang benar",
                        icon: "warning",
                    })
                }
            },
            error: function (xhr, status, error) {

                swal.close();
                console.log(error);
            }
        })

    }


    $("#btnCari").click(function () {
        getPerawtan();
    });

    $('#tableResep1').on('click', '.btnPenyerahan', function () {

        swal.fire({
            allowEscapeKey: false,
            allowOutsideClick: false,
            width: '140px',
            didOpen: () => {
                swal.showLoading();
            }
        });

        $('#tableinformasi tbody').html('');
        $('#tableinformasi2 tbody').html('');

        no_rawat = $(this).data('norawat');
        no_resep = $(this).data('noresep');
        nmdokter = $(this).data('nmdokter');
        nmpoli = $(this).data('nmpoli');
        jamperesepan = $(this).data('jamperesepan');
        tglperesepan = $(this).data('tglperesepan');
        $.ajax({
            url: "/data/getDetailPenyerahanObat",
            type: 'POST',
            data: {
                no_resep: $(this).data('noresep'),
                no_rawat: $(this).data('norawat'),
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                var row = '';
                if (response.code == 200) {

                    $("#norawat2").val(no_rawat);
                    $("#noresep2").val(no_resep);
                    $("#norm2").val(response.pasien.no_rkm_medis);

                    if (response.penyerahan) {
                        $("#aspektelaah1").val(response.penyerahan.aspek_telaah_1);
                        $("#aspektelaah2").val(response.penyerahan.aspek_telaah_2);
                        $("#aspektelaah3").val(response.penyerahan.aspek_telaah_3);
                        $("#aspektelaah4").val(response.penyerahan.aspek_telaah_4);
                        $("#aspektelaah5").val(response.penyerahan.aspek_telaah_5);
                        $("#aspektelaah6").val(response.penyerahan.aspek_telaah_6);
                        $("#aspektelaah7").val(response.penyerahan.aspek_telaah_7);
                        $("#aspektelaah8").val(response.penyerahan.aspek_telaah_8);
                        $("#aspektelaah9").val(response.penyerahan.aspek_telaah_9);

                        $("#telaahobat1").val(response.penyerahan.telaah_obat_1);
                        $("#telaahobat2").val(response.penyerahan.telaah_obat_2);
                        $("#telaahobat3").val(response.penyerahan.telaah_obat_3);
                        $("#telaahobat4").val(response.penyerahan.telaah_obat_4);
                        $("#telaahobat5").val(response.penyerahan.telaah_obat_5);

                        $("#perubahanresep").val(response.penyerahan.perubahan_resep);

                        $("#materiedukasi1").val(response.penyerahan.materi_edukasi_1);
                        $("#materiedukasi2").val(response.penyerahan.materi_edukasi_2);
                        $("#materiedukasi3").val(response.penyerahan.materi_edukasi_3);
                        $("#materiedukasi4").val(response.penyerahan.materi_edukasi_4);

                        $("#kontrolhighalert").val(response.penyerahan.kontrol_high_alert);
                        $("#ketkontrolhighalert").val(response.penyerahan.ket_kontrol_high_alert);
                        if (response.penyerahan.kontrol_high_alert == 'Ya') {
                            $('.secobathighalert').show()
                        } else {
                            $('.secobathighalert').hide()
                        }

                        $("#penyerahan").val(response.penyerahan.penyerahan);
                        $("#penerimaobat").val(response.penyerahan.penerima_obat);
                        $("#ketpenerimaobat").val(response.penyerahan.ket_penerima_obat);

                        $("#petugasvalidasi").val(response.penyerahan.nama_user_validasi);
                        $("#petugasracik").val(response.penyerahan.nama_user_racik);
                        $("#petugaskemas").val(response.penyerahan.nama_user_kemas);
                        $("#petugaspenyerahan").val(response.penyerahan.nama_user_penyerahan);

                        $("#jamvalidasi").val(response.penyerahan.datetime_validasi);
                        $("#jamracik").val(response.penyerahan.datetime_racik);
                        $("#jamkemas").val(response.penyerahan.datetime_kemas);
                        $("#jampenyerahan").val(response.penyerahan.datetime_penyerahan);

                        if (response.penyerahan.sign_pasien != null) {
                            sign1.regenerate(response.penyerahan.sign_pasien_json);
                        }

                    }

                    row += '<tr>';
                    row += '<td>No.Rawat / No.RM </td>';
                    row += '<td>:</td>';
                    row += '<td>' + no_rawat + ' ' + response.pasien.no_rkm_medis + '</td>';
                    row += '</tr>';
                    row += '<tr>';
                    row += '<td>No.Resep</td>';
                    row += '<td>:</td>';
                    row += '<td>' + no_resep + '</td>';
                    row += '</tr>';
                    row += '<tr>';
                    row += '<td>Nama Pasien</td>';
                    row += '<td>:</td>';
                    row += '<td>' + response.pasien.nm_pasien + '</td>';
                    row += '</tr>';
                    row += '<tr>';
                    row += '<td>Tgl. Lahir (Umur) </td>';
                    row += '<td>:</td>';
                    row += '<td>' + response.pasien.tgl_lahir + ' (' + response.pasien.umur +
                        ')</td>';
                    row += '<tr>';
                    row += '<td>Dokter</td>';
                    row += '<td>:</td>';
                    row += '<td>' + nmdokter + '</td>';
                    row += '</tr>';
                    row += '<tr>';
                    row += '<td>Poliklinik </td>';
                    row += '<td>:</td>';
                    row += '<td>' + nmpoli + '</td>';
                    row += '</tr>';
                    row += '<tr>';
                    row += '<td>Tgl & Jam Peresepan</td>';
                    row += '<td>:</td>';
                    row += '<td>' + tglperesepan + ' ' + jamperesepan + '</td>';
                    row += '</tr>';
                    row += '<tr>';

                    if (response.alergi_pasien) {
                        row += '<td>Berat Badan</td>';
                        row += '<td>:</td>';
                        row += '<td>' + (response.alergi_pasien.berat_badan != null ? response
                            .alergi_pasien.berat_badan : '') + '</td>';
                        row += '</tr>';
                        row += '<td>Alergi</td>';
                        row += '<td>:</td>';
                        row += '<td>' + (response.alergi_pasien.alergi != null ? response
                            .alergi_pasien
                            .alergi : '') + '</td>';
                        row += '</tr>';
                    }

                    if (response.diagnosa) {
                        row += '<td>Diagnosa</td>';
                        row += '<td>:</td>';
                        row += '<td>' + (response.diagnosa.diagnosa != null ? response.diagnosa
                            .diagnosa : '') + '</td>';
                        row += '</tr>';
                    }

                    row += '<td>Cara Bayar</td>';
                    row += '<td>:</td>';
                    row += '<td>' + (response.pasien.png_jawab != null ? response.pasien.png_jawab : '') + '</td>';
                    row += '</tr>';

                    $('#tableinformasi tbody').append(row);

                    if (response.list_obat) {
                        row = '';
                        // row = '';
                        for (let i = 0; i < response.list_obat.length; i++) {
                            row += '<tr>';
                            row += '<td>' + (i + 1) + '</td>';
                            row += '<td>' + response.list_obat[i].nama_brng + '</td>';
                            row += '<td>' + response.list_obat[i].jml + '</td>';
                            row += '<td>' + response.list_obat[i].kode_sat + '</td>';
                            row += '</tr>';

                            row += '<tr>';
                            row += '<td></td>';
                            row += '<td>' + response.list_obat[i].frekuensi + '</td>';
                            row += '<td>' + response.list_obat[i].dosis + '</td>';
                            row += '<td>' + response.list_obat[i].aturan_tambahan + '</td>';
                            row += '</tr>';

                        }

                        // console.log(row);

                        $('#tableinformasi2 tbody').append(row);
                        // $('#modalvalidasiresep').modal('show')
                    }

                    if (response.list_obat_racik) {
                        row = '';
                        // row = '';
                        for (let i = 0; i < response.list_obat_racik.length; i++) {

                            row += '<tr>';
                            row += '<td colspan="4"><center>--Racik--</center></td>';
                            row += '</tr>';


                            row += '<tr>';
                            row += '<td>' + (i + 1) + '</td>';
                            row += '<td>' + response.list_obat_racik[i].nama_racik + '</td>';
                            row += '<td>' + response.list_obat_racik[i].jml_dr + '</td>';
                            row += '<td>' + response.list_obat_racik[i].metode_racik + '</td>';
                            row += '</tr>';

                            for (let j = 0; j < response.list_obat_racik[i].dataObat.length; j++) {
                                row += '<tr>';
                                row += '<td></td>';
                                row += '<td>' + response.list_obat_racik[i].dataObat[j].nama_brng + '</td>';
                                row += '<td>' + response.list_obat_racik[i].dataObat[j].jml + ' ' + response.list_obat_racik[i].dataObat[j].kode_sat + '</td>';
                                row += '<td>' + response.list_obat_racik[i].dataObat[j].kandungan + '</td>';
                                row += '</tr>';
                            }

                        }

                        // console.log(row);

                        $('#tableinformasi2 tbody').append(row);
                        // $('#modalvalidasiresep').modal('show')
                    }

                    if (response.list_obat_maual) {
                        row = '';
                        // row = '';
                        for (let i = 0; i < response.list_obat_maual.length; i++) {
                            row += '<tr>';
                            row += '<td>' + (i + 1) + '</td>';
                            row += '<td>' + response.list_obat_maual[i].nama_brng + '</td>';
                            row += '<td>' + response.list_obat_maual[i].jml + '</td>';
                            row += '<td>' + response.list_obat_maual[i].kode_sat + '</td>';
                            row += '</tr>';

                            row += '<tr>';
                            row += '<td></td>';
                            row += '<td>' + response.list_obat_maual[i].frekuensi + '</td>';
                            row += '<td>' + response.list_obat_maual[i].dosis + '</td>';
                            row += '<td>' + response.list_obat_maual[i].aturan + '</td>';
                            row += '</tr>';

                        }

                        // console.log(row);

                        $('#tableinformasi2 tbody').append(row);
                        // $('#modalvalidasiresep').modal('show')
                    }


                    swal.close();
                    $('#modalPenyerahanObat').modal('show')
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        })
    });

</script>
@endsection