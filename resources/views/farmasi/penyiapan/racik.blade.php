@extends('layouts.main')

@section('title')
    <title>Persiapan | Resep Racik</title>
@endsection

@section('content')
    <section class="section row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 ">
                            <h4 class="card-title">Resep Dokter Racik</h4>
                        </div>
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
                                    <input type="date" class="form-control" id="datepickerTO1" name="datepickerTO1" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <button type="" class="btn btn-warning float-end" id="btnCari">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#ralan" role="tab" aria-controls="ralan" aria-selected="true">Rawat Jalan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#ranap" role="tab" aria-controls="ranap" aria-selected="false">Rawat Inap</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="ralan" role="tabpanel" aria-labelledby="ralan-tab">
                            <div class="table-responsive datatable-minimal ">
                                <table class="table" id="tableResep1">
                                    <thead>
                                        <tr>
                                            <th>No. Resep</th>
                                            <th>Tgl. Peresepan</th>
                                            <th>Jam Peresepan</th>
                                            <th>No. Rawat</th>
                                            <th>Pasien</th>
                                            <th>Dokter</th>
                                            <!-- <th>Status</th> -->
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ranap" role="tabpanel" aria-labelledby="ranap-tab">
                            <div class="table-responsive datatable-minimal">
                                <table class="table" id="tableResep2">
                                    <thead>
                                        <tr>
                                            <th>No. Resep</th>
                                            <th>Tgl. Peresepan</th>
                                            <th>Jam Peresepan</th>
                                            <th>No. Rawat</th>
                                            <th>No. RM</th>
                                            <th>Dokter</th>
                                            <!-- <th>Status</th> -->
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

    <div class="modal fade text-left" id="modalPenyerahanObat" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false" data-bs-backdrop="false" tabindex="-1">
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
                                        <textarea cols="3" class="form-control form-control-sm" id="perubahanresep"></textarea>
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
                                            <input type="checkbox" class="form-check-input form-check-primary" checked name="materiedukasi" id="materiedukasi1">
                                            <label class="form-check-label" for="materiedukasi1">Cara Pemakaian</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-inline-block me-2 mb-1">
                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="form-check-input form-check-primary" checked name="materiedukasi" id="materiedukasi2">
                                            <label class="form-check-label" for="materiedukasi2">Tgl.
                                                Kadaluarsa</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-inline-block me-2 mb-1">
                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="form-check-input form-check-primary" checked name="materiedukasi" id="materiedukasi3">
                                            <label class="form-check-label" for="materiedukasi3">Cara
                                                Penyimpanan</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-inline-block me-2 mb-1">
                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="form-check-input form-check-primary" checked name="materiedukasi" id="materiedukasi4">
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
                                        <textarea cols="3" class="form-control form-control-sm" id="ketkontrolhighalert"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="secttdpasien" hidden>
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

                                <div class="row seckeluargapasien">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="basicInput">Nama Keluarga</label>
                                            <input type="text" class="form-control" id="ketpenerimaobat">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 secsign">
                                    <strong><label for="">Tanda Tanggan Penerima</label></strong>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="sigPad2">
                                                <canvas class="pad"></canvas>
                                                <br>
                                                <button type="reset" class=" btn btn-warning reset"><i class="bi bi-stars"></i> Bersihkan</button>
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

                    <button type="button" class="btn btn-success btn-sm ms-1" id="btnsavepenyerahan">
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

            $('.secobathighalert').hide()
            $('#kontrolhighalert').on('change', function() {
                if (this.value == 'Ya') {
                    $('.secobathighalert').show()
                } else {
                    $('.secobathighalert').hide()
                }
            });

            getResep();

            $("#tableresep3").on("click", ".btn_edit", function() {
                $('#idlistobat2').val($(this).parents("tr").attr('data-index'));
                $('#kodebarang2').val($(this).parents("tr").attr('data-kodebarang'));
                $('#namabarang2').val($(this).parents("tr").attr('data-namabrng'));
                $('#jumlah2').val($(this).parents("tr").attr('data-jumlah'));
                $('#lbljumlah2').html($(this).parents("tr").attr('data-satuan'));
                $('#aturanpakai2').val($(this).parents("tr").attr('data-aturanpakai'));
                $('#carapemberian2').val($(this).parents("tr").attr('data-carapemberian'));
                $('#frekuensi2').val($(this).parents("tr").attr('data-frekuensi'));
                $('#dosis2').val($(this).parents("tr").attr('data-dosis'));
                $('#aturantambahan2').val($(this).parents("tr").attr('data-aturantambahan'));
                $('#keterangan2').val($(this).parents("tr").attr('data-keterangan'));

                $("#jumlah2").removeClass("is-invalid");
                $("#aturanpakai2").removeClass("is-invalid");
                $('#modalEditItemresep').modal('show');
            });

            $("#btneditdetailitemresep").click(function() {
                console.log($('#jumlah2').val());

                if ($('#jumlah2').val() == 0 && $('#jumlah2').val() == '') {
                    $('#jumlah2').focus();
                    $("#jumlah2").addClass("is-invalid");
                } else if ($('#aturanpakai2').val() == '') {
                    $('#aturanpakai2').focus();
                    $("#aturanpakai2").addClass("is-invalid");
                } else {
                    row = $('#' + $('#idlistobat2').val());
                    row.attr('data-index', $('#idDiagnosaSkunder').val());
                    row.attr('data-kodebarang', $('#kodebarang2').val());
                    row.attr('data-namabrng', $('#namabarang2').val());
                    row.attr('data-jumlah', $('#jumlah2').val());
                    row.attr('data-aturanpakai', $('#aturanpakai2').val());
                    row.attr('data-carapemberian', $('#carapemberian2').val());
                    row.attr('data-frekuensi', $('#frekuensi2').val());
                    row.attr('data-dosis', $('#dosis2').val());
                    row.attr('data-aturantambahan', $('#aturantambahan2').val());
                    row.attr('data-keterangan', $('#keterangan2').val());

                    $(row.children()[0]).text($('#jumlah2').val());
                    $(row.children()[5]).text($('#aturanpakai2').val());
                    $(row.children()[6]).text($('#carapemberian2').val());
                    $(row.children()[7]).text($('#frekuensi2').val());
                    $(row.children()[8]).text($('#dosis2').val());
                    $(row.children()[9]).text($('#aturantambahan2').val());
                    $(row.children()[12]).text($('#keterangan2').val());

                    $('#idlistobat2').val('');
                    $('#kodebarang2').val('');
                    $('#namabarang2').val('');
                    $('#jumlah2').val('');
                    $('#aturanpakai2').val('');
                    $('#carapemberian2').val('');
                    $('#frekuensi2').val('');
                    $('#dosis2').val('');
                    $('#aturantambahan2').val('');
                    $('#keterangan2').val('');

                    $('#modalEditItemresep').modal('hide');
                }

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
                url: "/persiapanracik/getResep",
                type: 'POST',
                data: {
                    from: $('#datepickerFrom1').val(),
                    to: $('#datepickerTO1').val()
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        $("#tableResep1").DataTable().destroy()
                        var Table = $('#tableResep1').dataTable({
                            "aaData": response.resep_ralan,
                            "columns": [{
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.no_resep + '<br>'
                                        if (data.stts_resep == 'Belum Terlayani') {
                                            result += '<span class="badge bg-danger">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sedang di Proses') {
                                            result += '<span class="badge bg-warning">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sudah Divalidasi') {
                                            result += '<span class="badge bg-warning">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sudah Terlayani') {
                                            result += '<span class="badge bg-success">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Selesai') {
                                            result += '<span class="badge bg-success">' + data
                                                .stts_resep + '</span>';
                                        }
                                        return result;

                                    },
                                },
                                {
                                    "data": "tgl_peresepan"
                                },
                                {
                                    "data": "jam_peresepan"
                                },
                                {
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.no_rawat + '<br>';
                                        if (data.kd_poli == 'OKMAT' || data.kd_poli == 'OKBED') {
                                            result += '<span class="badge" style="background-color: blueviolet;">ODC</span>';
                                        }

                                        return result
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

                                        // result += '<div class="btn-group mt-1 btn-group-sm" role="group" aria-label="Basic example">';
                                        if (data.stts_resep == 'Sedang di Proses' || data.stts_resep == 'Sudah Terlayani') {

                                            result += '<button type="button" id="btnPenyerahan" class="btn btn-sm btn-success btnPenyerahan"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_poli + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '><i class="bi bi-patch-check"></i></button>';

                                        }
                                        return result;

                                    },
                                },

                            ],
                            "createdRow": function(row, data, index) {
                                if (data.datetime_racik != null) {
                                    $(row).addClass('table-success'); //Original Date
                                }
                            },
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

                        $("#tableResep2").DataTable().destroy()
                        var Table = $('#tableResep2').dataTable({
                            "aaData": response.resep_ranap,
                            "columns": [{
                                    "mData": null,
                                    "bSortable": false,
                                    "mRender": function(data, type, full) {
                                        var result = '';
                                        result += data.no_resep + '<br>'
                                        if (data.stts_resep == 'Belum Terlayani') {
                                            result += '<span class="badge bg-danger">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sedang di Proses') {
                                            result += '<span class="badge bg-warning">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sudah Divalidasi') {
                                            result += '<span class="badge bg-warning">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Sudah Terlayani') {
                                            result += '<span class="badge bg-success">' + data
                                                .stts_resep + '</span>';
                                        } else if (data.stts_resep == 'Selesai') {
                                            result += '<span class="badge bg-success">' + data
                                                .stts_resep + '</span>';
                                        }
                                        return result;

                                    },
                                },
                                {
                                    "data": "tgl_peresepan"
                                },
                                {
                                    "data": "jam_peresepan"
                                },
                                {
                                    "data": "no_rawat"
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
                                        result += data.nm_bangsal
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

                                        // result += '<div class="btn-group mt-1 btn-group-sm" role="group" aria-label="Basic example">';
                                        if (data.stts_resep == 'Sedang di Proses' || data.stts_resep == 'Sudah Terlayani') {

                                            result += '<button type="button" id="btnPenyerahan" class="btn btn-sm btn-success btnPenyerahan"';
                                            result += 'data-noresep="' + data.no_resep + '"';
                                            result += 'data-tglperesepan="' + data.tgl_peresepan + '"';
                                            result += 'data-jamperesepan="' + data.jam_peresepan + '"';
                                            result += 'data-norawat="' + data.no_rawat + '"';
                                            result += 'data-nmdokter="' + data.nm_dokter + '"';
                                            result += 'data-nmpoli="' + data.nm_bangsal + '"';
                                            result += 'data-statusrawat="Ralan"';
                                            result += '><i class="bi bi-patch-check"></i></button>';

                                        }
                                        return result;

                                    },
                                },

                            ],
                            "createdRow": function(row, data, index) {
                                if (data.datetime_racik != null) {
                                    $(row).addClass('table-success'); //Original Date
                                }
                            },
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

        $('#tableResep1').on('click', '.btnPenyerahan', function() {

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
                success: function(response) {
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

                        if (response.tambahanobat) {
                            row = '';
                            if (response.tambahanobat.length > 0) {
                                row += '<tr>';
                                row += '<td colspan="4"><b>-tambahan-</b></td>';
                                row += '</tr>';
                                // row = '';
                                for (let i = 0; i < response.tambahanobat.length; i++) {
                                    row += '<tr>';
                                    row += '<td>' + (i + 1) + '</td>';
                                    row += '<td>' + response.tambahanobat[i].nama_brng + '</td>';
                                    row += '<td>' + response.tambahanobat[i].jml + '</td>';
                                    row += '<td>' + response.tambahanobat[i].kode_sat + '</td>';
                                    row += '</tr>';

                                    row += '<tr>';
                                    row += '<td></td>';
                                    row += '<td>' + response.tambahanobat[i].frekuensi + '</td>';
                                    row += '<td>' + response.tambahanobat[i].dosis + '</td>';
                                    row += '<td>' + response.tambahanobat[i].aturan + '</td>';
                                    row += '</tr>';

                                }
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
                                    row += '<td>' + response.list_obat_racik[i].dataObat[j].hasil + ' ' + response.list_obat_racik[i].dataObat[j].kode_sat + '</td>';
                                    row += '<td>' + response.list_obat_racik[i].dataObat[j].kandungan + ' mg</td>';
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
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        });

        $('#tableResep2').on('click', '.btnPenyerahan', function() {

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
                success: function(response) {
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

                        if (response.tambahanobat) {
                            row = '';
                            if (response.tambahanobat.length > 0) {
                                row += '<tr>';
                                row += '<td colspan="4"><b>-tambahan-</b></td>';
                                row += '</tr>';
                                // row = '';
                                for (let i = 0; i < response.tambahanobat.length; i++) {
                                    row += '<tr>';
                                    row += '<td>' + (i + 1) + '</td>';
                                    row += '<td>' + response.tambahanobat[i].nama_brng + '</td>';
                                    row += '<td>' + response.tambahanobat[i].jml + '</td>';
                                    row += '<td>' + response.tambahanobat[i].kode_sat + '</td>';
                                    row += '</tr>';

                                    row += '<tr>';
                                    row += '<td></td>';
                                    row += '<td>' + response.tambahanobat[i].frekuensi + '</td>';
                                    row += '<td>' + response.tambahanobat[i].dosis + '</td>';
                                    row += '<td>' + response.tambahanobat[i].aturan + '</td>';
                                    row += '</tr>';

                                }
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
                                    row += '<td>' + response.list_obat_racik[i].dataObat[j].hasil + ' ' + response.list_obat_racik[i].dataObat[j].kode_sat + '</td>';
                                    row += '<td>' + response.list_obat_racik[i].dataObat[j].kandungan + ' mg</td>';
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
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        });


        $('#btnsavepenyerahan').click(function(e) {
            Swal.fire({
                target: document.getElementById('modalPenyerahanObat'),
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
                    $.ajax({
                        url: "/persiapanracik/postSimpanResep",
                        type: 'POST',
                        data: {

                            no_rawat: $("#norawat2").val(),
                            no_rkm_medis: $("#norm2").val(),
                            no_resep: $("#noresep2").val(),

                            aspek_telaah_1: $("#aspektelaah1").val(),
                            aspek_telaah_2: $("#aspektelaah2").val(),
                            aspek_telaah_3: $("#aspektelaah3").val(),
                            aspek_telaah_4: $("#aspektelaah4").val(),
                            aspek_telaah_5: $("#aspektelaah5").val(),
                            aspek_telaah_6: $("#aspektelaah6").val(),
                            aspek_telaah_7: $("#aspektelaah8").val(),
                            aspek_telaah_8: $('#aspektelaah8').val(),
                            aspek_telaah_9: $('#aspektelaah9').val(),

                            telaah_obat_1: $('#telaahobat1').val(),
                            telaah_obat_2: $('#telaahobat2').val(),
                            telaah_obat_3: $('#telaahobat3').val(),
                            telaah_obat_4: $('#telaahobat4').val(),
                            telaah_obat_5: $('#telaahobat5').val(),

                            perubahan_resep: $("#perubahanresep").val(),

                            materi_edukasi_1: $("#materiedukasi1").is(':checked') ? 1 : 0,
                            materi_edukasi_2: $("#materiedukasi2").is(':checked') ? 1 : 0,
                            materi_edukasi_3: $("#materiedukasi3").is(':checked') ? 1 : 0,
                            materi_edukasi_4: $("#materiedukasi4").is(':checked') ? 1 : 0,

                            kontrol_high_alert: $("#kontrolhighalert").val(),
                            ket_kontrol_high_alert: $("#ketkontrolhighalert").val(),

                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.code == 200) {
                                // Swal.close();
                                $('#modalPenyerahanObat').modal('hide')
                                Swal.fire({
                                    title: "Berhasil",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then((result) => {
                                    // console.log('test');
                                    getResep()
                                });
                            } else {
                                // Swal.close();
                                $('#modalPenyerahanObat').modal('hide')
                                Swal.fire({
                                    title: "Gagal",
                                    text: "Periksa Kembali data / Silahkan Hubungi SIMRS",
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then((result) => {
                                    // console.log('test');
                                    getResep()
                                });
                            }

                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            $('#modalPenyerahanObat').modal('hide')
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
                }
            })

        });

        $('#btnCari').click(function(e) {
            getResep();
        })
    </script>
@endsection
