@extends('layouts.main')

@section('title')
<title>Resep | Obat Kronis</title>
@endsection

@section('content')
<section class="section row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Obat Kronis
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
                                            Jenis
                                        </span>
                                        <select class="form-control form-control-sm" id="jenisrawat">
                                            <option value="Poliklinik">Poliklinik</option>
                                            <!-- <option value="IGD">IGD</option> -->
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
                                    <button type="button" class="btn btn-primary" id="btnAdd"><i
                                            class="bi bi-plus"></i></button>
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
                                <th>No. Rawat</th>
                                <th>Tgl. Jam Resep</th>
                                <th>Pasien</th>
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

<div class="modal fade text-left" id="modalPenyerahanObat" role="dialog" aria-labelledby="myModalLabel140"
    aria-hidden="false" data-bs-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel140">
                    Penyerahan Obat
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-5 secInformasiResep">
                        <div class="card" style="background: lightcyan;">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class=" tableinformasi" id="tableinformasi">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="background: rgb(249, 214, 153);">
                            {{-- <div class="card-header">
                            </div> --}}
                            <div class="card-body">
                                <strong>
                                    <h4>R/</h4>
                                </strong>
                                <div class="table-responsive">
                                    <table class="tableinformasi2" id="tableinformasi2">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7 secinput">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="basicInput">no rawat</label>
                                    <input type="text" class="form-control form-control-sm" id="norawat2" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="basicInput">no resep</label>
                                    <input type="text" class="form-control form-control-sm" id="noresep2" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="basicInput">no rkm_medis</label>
                                    <input type="text" class="form-control form-control-sm" id="norm2" disabled>
                                </div>
                            </div>
                        </div>

                        <strong><label for="">Aspek Telaah</label></strong>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="basicInput">Kejelasan Tulisan</label>
                                    <select class="form-control form-control-sm" id="aspektelaah1">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="basicInput">Benar Nama Pasien</label>
                                    <select class="form-control form-control-sm" id="aspektelaah2">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="basicInput">Benar Nama Obat</label>
                                    <select class="form-control form-control-sm" id="aspektelaah3">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Benar Dosis</label>
                                    <select class="form-control form-control-sm" id="aspektelaah4">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Benar Waktu & Frekuensi Pemberian</label>
                                    <select class="form-control form-control-sm" id="aspektelaah5">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Benar Cara Pemberian</label>
                                    <select class="form-control form-control-sm" id="aspektelaah6">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Poli Farmasi</label>
                                    <select class="form-control form-control-sm" id="aspektelaah7">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Duplikasi</label>
                                    <select class="form-control form-control-sm" id="aspektelaah8">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Interaksi Obat yang Mungkin Terjadi</label>
                                    <select class="form-control form-control-sm" id="aspektelaah9">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <strong><label for="" class="mt-2">Telaah Obat</label></strong>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Tepat Pasien</label>
                                    <select class="form-control form-control-sm" id="telaahobat1">
                                        <option value="Sesuai">Sesuai</option>
                                        <option value="Tidak Sesuai">Tidak Sesuai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Obat Dengan Resep</label>
                                    <select class="form-control form-control-sm" id="telaahobat2">
                                        <option value="Sesuai">Sesuai</option>
                                        <option value="Tidak Sesuai">Tidak Sesuai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Jumlah/Dosis Obat dengan Resep</label>
                                    <select class="form-control form-control-sm" id="telaahobat3">
                                        <option value="Sesuai">Sesuai</option>
                                        <option value="Tidak Sesuai">Tidak Sesuai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Rute dengan Resep</label>
                                    <select class="form-control form-control-sm" id="telaahobat4">
                                        <option value="Sesuai">Sesuai</option>
                                        <option value="Tidak Sesuai">Tidak Sesuai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="basicInput">Waktu & Frekuensi Pemberian dengan Resep</label>
                                    <select class="form-control form-control-sm" id="telaahobat5">
                                        <option value="Sesuai">Sesuai</option>
                                        <option value="Tidak Sesuai">Tidak Sesuai</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="basicInput">Perubahan Resep</label>
                                    <textarea cols="3" class="form-control form-control-sm"
                                        id="perubahanresep"></textarea>
                                </div>
                            </div>
                        </div>

                        <strong>
                            <label for="" class="mt-2"> Materi Edukasi</label>
                        </strong>
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block me-2 mb-1">
                                <div class="form-check">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="form-check-input form-check-primary" checked
                                            name="materiedukasi" id="materiedukasi1">
                                        <label class="form-check-label" for="materiedukasi1">Cara Pemakaian</label>
                                    </div>
                                </div>
                            </li>
                            <li class="d-inline-block me-2 mb-1">
                                <div class="form-check">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="form-check-input form-check-primary" checked
                                            name="materiedukasi" id="materiedukasi2">
                                        <label class="form-check-label" for="materiedukasi2">Tgl.
                                            Kadaluarsa</label>
                                    </div>
                                </div>
                            </li>
                            <li class="d-inline-block me-2 mb-1">
                                <div class="form-check">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="form-check-input form-check-primary" checked
                                            name="materiedukasi" id="materiedukasi3">
                                        <label class="form-check-label" for="materiedukasi3">Cara
                                            Penyimpanan</label>
                                    </div>
                                </div>
                            </li>
                            <li class="d-inline-block me-2 mb-1">
                                <div class="form-check">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="form-check-input form-check-primary" checked
                                            name="materiedukasi" id="materiedukasi4">
                                        <label class="form-check-label" for="materiedukasi4">Cara Buang</label>
                                    </div>
                                </div>
                            </li>
                        </ul>


                        <div class="form-group mt-2">
                            <label for="basicInput">Kontrol High Alert</label>
                            <select class="form-control form-control-sm" id="kontrolhighalert">
                                <option value="Tidak">Tidak</option>
                                <option value="Ya">Ya</option>
                            </select>
                        </div>

                        <div class="row secobathighalert">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="basicInput">Obat High Alert</label>
                                    <textarea cols="3" class="form-control form-control-sm"
                                        id="ketkontrolhighalert"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="secttdpasien">
                            <div class="form-group mt-2">
                                <label for="basicInput">Penyerahan</label>
                                <select class="form-control form-control-sm" id="penyerahan">
                                    <option value="Langsung">Langsung</option>
                                    <option value="Tidak Langsung">Tidak Langsung</option>
                                </select>
                            </div>


                            <div class="form-group mt-2">
                                <label for="basicInput">yang menerima obat</label>
                                <select class="form-control form-control-sm" id="penerimaobat">
                                    <option value="Pasien">Pasien</option>
                                    <option value="Keluarga Pasien">Keluarga Pasien</option>
                                </select>
                            </div>

                            <div class="seckeluargapasien">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Keluarga</label>
                                        <input type="text" class="form-control" id="ketpenerimaobat">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="basicInput">No.tlp</label>
                                <input type="number" class="form-control" id="notlppasien">
                            </div>

                            <div class="col-12 secsign">
                                <strong><label for="">Tanda Tanggan Penerima</label></strong>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="sigPad2">
                                            <canvas class="pad"></canvas>
                                            <br>
                                            <button type="reset" class=" btn btn-warning reset"><i
                                                    class="bi bi-stars"></i> Bersihkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card bg-light-secondary">
                    <div class="card-body ">
                        <div class="row ">
                            <div class="col-3">
                                <div class="form-group form-group-sm">
                                    <label for="basicInput">Petugas Validasi</label>
                                    <input type="text" class="form-control form-control-sm" id="petugasvalidasi">
                                    <input type="text" class="form-control form-control-sm" id="jamvalidasi">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group form-group-sm">
                                    <label for="basicInput">Petugas Racik</label>
                                    <input type="text" class="form-control form-control-sm" id="petugasracik">
                                    <input type="text" class="form-control form-control-sm" id="jamracik">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group form-group-sm">
                                    <label for="basicInput">Petugas Kemas</label>
                                    <input type="text" class="form-control form-control-sm" id="petugaskemas">
                                    <input type="text" class="form-control form-control-sm" id="jamkemas">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group form-group-sm">
                                    <label for="basicInput">Petugas Penyerahan</label>
                                    <input type="text" class="form-control form-control-sm" id="petugaspenyerahan">
                                    <input type="text" class="form-control form-control-sm" id="jampenyerahan">
                                </div>
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

        $('.secstatusranap').hide()
        $('#jenisrawat').on('change', function () {
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

        getPerawtan();
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
            url: "/obatKronis/getListkronis",
            type: 'POST',
            data: {
                from: $('#datepickerFrom1').val(),
                to: $('#datepickerTO1').val(),
                jenisrawat: $('#jenisrawat').val(),
                statusranap: $('#statusranap').val()
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.code == 200) {
                    $("#tableResep1").DataTable().destroy()
                    var Table = $('#tableResep1').dataTable({
                        "aaData": response.data_resep,
                        "columns": [
                            {
                                "mData": null,
                                "bSortable": false,
                                "mRender": function (data, type, full) {
                                    var result = '';
                                    result += data.no_rawat + '<br>'
                                    result += data.nm_dokter
                                    return result;

                                },
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
                                "mData": null,
                                "bSortable": false,
                                "mRender": function (data, type, full) {
                                    var result = '';
                                    result += '<div class="btn-group mt-1 btn-group-sm" role="group" aria-label="Basic example">';
                                    result += '<button type="button" id="btnPenyerahan" class="btn btn-sm btn-primary btnPenyerahan"';
                                    result += 'data-noresep="' + data.no_resep + '"';
                                    result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                    result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                    result += 'data-norawat="' + data.no_rawat + '"';
                                    result += 'data-nmdokter="' + data.nm_dokter + '"';
                                    result += 'data-nmpoli="' + data.nm_poli + '"';
                                    result += 'data-statusrawat="Ralan"';
                                    result += '><i class="bi bi-bucket-fill"></i></button>';

                                    result += '<button class="btn btn-sm btn-success btnprintbilingresep"';
                                    result += 'data-noresep="' + data.no_resep + '"';
                                    result += '><i class="bi bi-printer-fill"></i></button>';
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
                            [2, 'desc'],
                            [3, 'desc']
                        ]
                    });

                }
                swal.close();
            },
            error: function (xhr, status, error) {

                swal.close();
                console.log(error);
            }
        })

    }

    $('#tableResep1').on('click', '.btnprintbilingresep', function () {
        // console.log("AWdawdawd");
        window.open('{{ env('LINK_ERESULT') }}/ResultResep/resultBilingKronisNoResep/' + $(this).data('noresep'),
            '_blank');
    });


    $("#btnCari").click(function () {
        getPerawtan();
    });

   
</script>
@endsection