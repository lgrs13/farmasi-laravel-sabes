@extends('layouts.main')

@section('title')
    <title>Master | Barang</title>
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 ">
                        <h4 class="card-title">Barang</h4>
                    </div>
                    <div class="col-6 ">
                        <a class="btn icon icon-left btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalAddBarang" id="btnAdd"><i class="bi bi-database-add"></i></a>
                    </div>
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

            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="tablebarang">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Kenaikan</th>
                                <th>Total Stok</th>
                                <th>Type</th>
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


    <div class="modal fade text-left" id="modalAddBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel140">ADD Barang
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">kode Barang</label>
                                <input type="text" class="form-control form-control-sm" id="kodebarang">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Kandungan</label>
                                <input type="text" class="form-control form-control-sm" id="kandungan">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6" hidden>
                            <div class="form-group">
                                <label for="basicInput">Penjualan</label>
                                <input type="number" class="form-control form-control-sm" id="penjualan" value="{{ $penjualan }}" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Harga Beli</label>
                                <input type="number" class="form-control form-control-sm" id="hargabeli">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Harga Jual</label>
                                <input type="number" class="form-control form-control-sm" id="hargajual">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4" hidden>
                            <div class="form-group">
                                <label for="basicInput">Kenaikan</label>
                                <input type="number" class="form-control form-control-sm" id="kenaikan">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Jenis</label>
                                <select class="form-control jenis" id="jenis">
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Kategori</label>
                                <select class="form-control kategori" id="kategori">
                                    {{-- <option value="-">-</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Golongan</label>
                                <select class="form-control golongan" id="golongan">
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Stok Minimal</label>
                                <input type="number" class="form-control form-control-sm" id="stokminimal">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Maksimal Beri</label>
                                <input type="number" class="form-control form-control-sm" value="30" id="maksimalberi">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Satuan</label>
                                <select class="form-control satuan" id="satuan">
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 ">
                            <div class="form-group">
                                <label for="basicInput">Multidose</label>
                                <select style="border-color: lightsalmon;" class="form-control form-control-sm" id="multidose">
                                    <option value="0" selected>Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 secmultidose">
                            <div class="form-group">
                                <label for="basicInput">Konversi</label>
                                <select style="border-color: lightsalmon;" class="form-control form-control-sm" id="multidosekonversi">
                                    <option value="0" selected>Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 secmultidose">
                            <div class="form-group">
                                <label for="basicInput">Dosis</label>
                                <input style="border-color: lightsalmon;" type="number" class="form-control form-control-sm form-control-info"id="dosis_obat">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 secmultidosekonversi">
                            <div class="form-group">
                                <label for="basicInput">Dosis Ml</label>
                                {{-- <input style="border-color: lightsalmon;" type="number" class="form-control form-control-sm form-control-info"id="dosis_obatml"> --}}
                                <div class="input-group input-group-sm">
                                    <input style="border-color: lightsalmon;" type="number" class="form-control" aria-describedby="lbldosisml" id="dosis_obatml">
                                    <span class="input-group-text" id="lbldosisml">Ml</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 secmultidosekonversi">
                            <div class="form-group">
                                <label for="basicInput">Dosis MG</label>
                                {{-- <input style="border-color: lightsalmon;" type="number" class="form-control form-control-sm form-control-info"id="dosis_obatmg"> --}}

                                <div class="input-group input-group-sm">
                                    <input style="border-color: lightsalmon;" type="number" class="form-control" aria-describedby="lbldosismg" id="dosis_obatmg">
                                    <span class="input-group-text" id="lbldosismg">Mg</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 secmultidose">
                            <div class="form-group">
                                <label for="basicInput">Satuan Dosis</label>
                                <input style="border-color: lightsalmon;" type="text" class="form-control form-control-sm" id="dosis_satuan">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">High Alert</label>
                                {{-- <input style="border-color: rgb(122, 195, 255);" type="text" class="form-control form-control-sm" id="high_alert"> --}}
                                <select style="border-color: rgb(255, 0, 0);" class="form-control form-control-sm" id="high_alert">
                                    <option value="0" selected>Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
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

    <div class="modal fade text-left" id="modalEditBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Edit Barang
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">kode Barang</label>
                                <input type="text" class="form-control form-control-sm" id="kodebarang2" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Kandungan</label>
                                <input type="text" class="form-control form-control-sm" id="kandungan2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6" hidden>
                            <div class="form-group">
                                <label for="basicInput">Penjualan</label>
                                <input type="number" class="form-control form-control-sm" id="penjualan" value="{{ $penjualan }}" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Harga Beli</label>
                                <input type="number" class="form-control form-control-sm" id="hargabeli2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Harga Jual</label>
                                <input type="number" class="form-control form-control-sm" id="hargajual2">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4" hidden>
                            <div class="form-group">
                                <label for="basicInput">Kenaikan</label>
                                <input type="number" class="form-control form-control-sm" id="kenaikan2">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Jenis</label>
                                <select class="form-control jenis" id="jenis2">
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Kategori</label>
                                <select class="form-control kategori" id="kategori2">
                                    {{-- <option value="-">-</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Golongan</label>
                                <select class="form-control golongan" id="golongan2">
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Stok Minimal</label>
                                <input type="number" class="form-control form-control-sm" id="stokminimal2">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Maksimal Beri</label>
                                <input type="number" class="form-control form-control-sm" value="30" id="maksimalberi2">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Satuan</label>
                                <select class="form-control" id="satuan2">
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 ">
                            <div class="form-group">
                                <label for="basicInput">Multidose</label>
                                <select style="border-color: lightsalmon;" class="form-control form-control-sm" id="multidose2">
                                    <option value="0" selected>Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 secmultidose">
                            <div class="form-group">
                                <label for="basicInput">Konversi</label>
                                <select style="border-color: lightsalmon;" class="form-control form-control-sm" id="multidosekonversi2">
                                    <option value="0" selected>Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 secmultidose">
                            <div class="form-group">
                                <label for="basicInput">Dosis</label>
                                <input style="border-color: lightsalmon;" type="number" class="form-control form-control-sm form-control-info"id="dosis_obat2">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 secmultidosekonversi">
                            <div class="form-group">
                                <label for="basicInput">Dosis Ml</label>
                                {{-- <input style="border-color: lightsalmon;" type="number" class="form-control form-control-sm form-control-info"id="dosis_obatml"> --}}
                                <div class="input-group input-group-sm">
                                    <input style="border-color: lightsalmon;" type="number" class="form-control" aria-describedby="lbldosisml" id="dosis_obatml2">
                                    <span class="input-group-text" id="lbldosisml">Ml</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 secmultidosekonversi">
                            <div class="form-group">
                                <label for="basicInput">Dosis MG</label>
                                {{-- <input style="border-color: lightsalmon;" type="number" class="form-control form-control-sm form-control-info"id="dosis_obatmg"> --}}

                                <div class="input-group input-group-sm">
                                    <input style="border-color: lightsalmon;" type="number" class="form-control" aria-describedby="lbldosismg" id="dosis_obatmg2">
                                    <span class="input-group-text" id="lbldosismg">Mg</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-2 secmultidose">
                            <div class="form-group">
                                <label for="basicInput">Satuan Dosis</label>
                                <input style="border-color: lightsalmon;" type="text" class="form-control form-control-sm" id="dosis_satuan2">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="basicInput">High Alert</label>
                                {{-- <input style="border-color: rgb(122, 195, 255);" type="text" class="form-control form-control-sm" id="high_alert"> --}}
                                <select style="border-color: rgb(255, 0, 0);" class="form-control form-control-sm" id="high_alert2">
                                    <option value="0" selected>Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="button" class="btn btn-warning ms-1" id="btnupdateobat">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="modalHistorybarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="false">
        <div class="modal-dialog modal-full modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title white" id="myModalLabel140">History Barang
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="basicInput">kode Barang</label>
                                <input type="text" class="form-control form-control-sm" id="kodebarang3" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="form-group">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control form-control-sm" id="namabarang3">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12">

                            {{-- <div class="table-responsive" style="min-height: 200px; max-height: 600px; overflow: auto;"></div> --}}
                            <div class="table-responsive" style="min-height: 200px; max-height: 500px; overflow: auto;">
                                <table class="table table-bordered tablehistory" id="tablehistory">
                                    <thead class="table-success">
                                        <tr class="text-center">
                                            <td rowspan="2">No</td>
                                            <td rowspan="2">Jenis</td>
                                            <td rowspan="2">tanggal</td>
                                            <td colspan="3" class="text-center">Masuk</td>
                                            <td rowspan="2">Keluar</td>
                                            <td rowspan="2">Sisa</td>
                                            <td rowspan="2">No. Batch</td>
                                            <td rowspan="2">Tgl Kadaluarsa</td>
                                            <td rowspan="2">Keterangan</td>
                                        </tr>

                                        <tr class="text-center">
                                            <td>unit</td>
                                            <td>Harga Satuan</td>
                                            <td>Jumlah</td>
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
            getJenisObat('jenis')
            getKategori('kategori')
            getGolongan('golongan')
            getSatuan('satuan')
            getJenisObat('jenis2')
            getKategori('kategori2')
            getGolongan('golongan2')
            getSatuan('satuan2')

            $(".secmultidose").hide();
            $('#multidose').on('change', function() {
                console.log(this.value);

                if (this.value == '1') {
                    $('.secmultidose').show();
                } else {
                    $('.secmultidose').hide();
                }
            });

            $('#multidose2').on('change', function() {
                console.log(this.value);

                if (this.value == '1') {
                    $('.secmultidose').show();
                } else {
                    $('.secmultidose').hide();
                }
            });

            $(".secmultidosekonversi").hide();
            $('#multidosekonversi').on('change', function() {
                console.log(this.value);
                if (this.value == '1') {
                    $('.secmultidosekonversi').show();
                } else {
                    $('.secmultidosekonversi').hide();
                }
            });

            $('#multidosekonversi2').on('change', function() {
                console.log(this.value);
                if (this.value == '1') {
                    $('.secmultidosekonversi').show();
                } else {
                    $('.secmultidosekonversi').hide();
                }
            });
        })



        function getDataBarang() {
            console.log($('#depo').val());


            swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                width: '140px',
                didOpen: () => {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: "/barang/getDataBarang",
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
                            var Table = $('#tablebarang').DataTable({
                                "aaData": response.databarang,
                                "columns": [{
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var result = '';

                                            result += data.kode_brng + '<br>';
                                            if (data.status == 1) {
                                                result += '<span class="badge bg-light-success">Aktif</span><br>';
                                            } else {
                                                result += '<span class="badge bg-light-danger">Tidak Aktif</span><br>';
                                            }

                                            return result;

                                        },
                                    },
                                    {
                                        "data": "nama_brng"
                                    },
                                    {
                                        "data": "h_beli"
                                    },
                                    {
                                        "data": "utama"
                                    },
                                    {
                                        "data": "utama"
                                    },
                                    // {
                                    //     "data": "stok"
                                    // },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            if (data.stok) {

                                                var button = '';
                                                button += '<a href="#" type="button" id="btnhistory" class=" btnhistory"';
                                                button += 'data-kodebrng="' + data.kode_brng + '"';
                                                button += 'data-namabrng="' + data.nama_brng + '"';
                                                button += '>' + data.stok + '</a>';
                                                return button;
                                            } else {
                                                return "-";
                                            }

                                        },
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var result = '';
                                            if (data.multidose != 0) {
                                                result += '<span class="badge bg-light-warning">Multidose</span><br>';
                                            }

                                            if (data.high_alert == 1) {
                                                result += '<span class="badge bg-light-danger">High Alert</span><br>';
                                            }

                                            return result;

                                        },
                                    },
                                    {
                                        "mData": null,
                                        "bSortable": false,
                                        "mRender": function(data, type, full) {
                                            var button = '';
                                            button += '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                                            // button += '<button type="button" id="btnEdit" class="btn btn-sm btn-warning btnEdit"><i class="bi bi-pencil"></i></button>';
                                            button += '<button type="button" id="btnEdit" class="btn btn-sm btn-success btnEdit"';
                                            button += 'data-kodebrng="' + data.kode_brng + '"';
                                            button += 'data-namabrng="' + data.nama_brng + '"';
                                            button += 'data-satuan="' + data.kode_sat + '"';
                                            button += 'data-kandungan="' + data.kandungan + '"';
                                            button += 'data-hbeli="' + data.h_beli + '"';
                                            button += 'data-hjual="' + data.utama + '"';
                                            button += 'data-kdjns="' + data.kdjns + '"';
                                            button += 'data-kodekategori="' + data.kode_kategori + '"';
                                            button += 'data-kodegolongan="' + data.kode_golongan + '"';
                                            button += 'data-multidose="' + data.multidose + '"';
                                            button += 'data-dosis="' + data.dosis + '"';
                                            button += 'data-dosismg="' + data.dosis_mg + '"';
                                            button += 'data-dosisml="' + data.dosis_ml + '"';
                                            button += 'data-satuandosis="' + data.satuan_dosis + '"';
                                            button += 'data-highalert="' + data.high_alert + '"';
                                            button += 'data-stokminimal="' + data.stokminimal + '"';
                                            button += 'data-batasberi="' + data.batas_beri + '"';
                                            button += '><i class="bi bi-pencil"></i></button>';

                                            if (data.status == 1) {
                                                button += '<button type="button" id="btnHapus" class="m-10 btn btn-sm btn-danger btnHapus"';
                                                button += 'data-kodebrng="' + data.kode_brng + '"';
                                                button += '><i class="bi bi-archive"></i></button>';
                                            }

                                            // button += '<button type="button" id="btnHapus" class="btn btn-sm btn-danger btnHapus"></button>';
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
                                    title: 'Master Barang ' + $("#depo option:selected").text(),
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


        $('#tablebarang').on('click', '.btnEdit', function() {
            $('#kodebarang2').val($(this).data('kodebrng'));
            $('#namabarang2').val($(this).data('namabrng'));
            $('#kandungan2').val($(this).data('kandungan'));
            $('#hargabeli2').val($(this).data('hbeli'));
            $('#hargajual2').val($(this).data('hjual'));
            $('#kenaikan2').val($(this).data('hjual'));
            $('#jenis2').val($(this).data('kdjns'));
            $('#kategori2').val($(this).data('kodekategori'));
            $('#golongan2').val($(this).data('kodegolongan'));
            $('#stokminimal2').val($(this).data('stokminimal'));
            $('#maksimalberi2').val($(this).data('batasberi'));
            $('#satuan2').val($(this).data('satuan'));
            // $('#multidose2').val($(this).data('multidose'));
            console.log($(this).data('dosis'));

            if (($(this).data('multidose') == 1)) {
                $('.secmultidose').show();
                $('.secmultidosekonversi').hide();
                $('#multidose2').val(1);
                $('#multidosekonversi2').val(0);
            } else if (($(this).data('multidose') == 2)) {
                $('.secmultidose').show();
                $('.secmultidosekonversi').show();
                $('#multidose2').val(1);
                $('#multidosekonversi2').val(1);
            } else {
                $('.secmultidose').hide();
                $('.secmultidosekonversi').hide();
                $('#multidose2').val(0);
                $('#multidosekonversi2').val(0);

            }

            $('#dosis_obat2').val($(this).data('dosis'));
            $('#dosis_obatml2').val($(this).data('dosisml'));
            $('#dosis_obatmg2').val($(this).data('dosismg'));
            $('#dosis_satuan2').val($(this).data('satuandosis'));
            $('#high_alert2').val($(this).data('highalert'));

            $('#modalEditBarang').modal('show');
        })

        $('#tablebarang').on('click', '.btnhistory', function() {
            $('#tablehistory tbody').html('');
            $('#kodebarang3').val($(this).data('kodebrng'));
            $('#namabarang3').val($(this).data('namabrng'));
            $.ajax({
                url: "/barang/historyBarang",
                type: 'POST',
                data: {
                    kode_brng: $('#kodebarang3').val(),
                    kd_bangsal: $('#depo').val()
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        var row = '';
                        for (let i = 0; i < response.data.length; i++) {
                            row += '<tr class="text-center">';
                            row += '<td>' + (i + 1) + '</td>';
                            row += '<td>' + response.data[i].tanggal + '</td>';
                            row += '<td>' + response.data[i].keterangan_status + '</td>';
                            row += '<td class="table-warning">' + response.data[i].unit_masuk + '</td>';
                            row += '<td>' + response.data[i].harga_masuk + '</td>';
                            row += '<td>' + response.data[i].jumlah + '</td>';
                            row += '<td class="table-danger">' + response.data[i].unit_keluar + '</td>';
                            row += '<td class="table-success">' + response.data[i].sisa + '</td>';
                            row += '<td>' + response.data[i].no_batch + '</td>';
                            row += '<td>' + response.data[i].tgl_kadaluarsa + '</td>';
                            row += '<td>' + response.data[i].keterangan + '</td>';
                            row += '<tr>'

                        }
                        $('#tablehistory tbody').html(row);
                        $('#modalHistorybarang').modal('show');
                    } else {
                        $('#tablehistory tbody').html('<tr><td colspan="9" class="text-center">Data Tidak Di temukan</td></tr>');
                        $('#modalHistorybarang').modal('show');

                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        })

        $('#tablebarang').on('click', '.btnHapus', function() {
            Swal.fire({
                title: 'Apa Anda Yakin?',
                text: "Periksa Kembali, Apa Anda Yakin",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Yakin`,
                denyButtonText: `Periksa Kembali`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/barang/nonaktifbarang",
                        type: 'POST',
                        data: {
                            kode_brng: $(this).data('kodebrng')
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.code == 200) {
                                getDataBarang();
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

        })


        $('#btnAdd').click(function(e) {
            $.ajax({
                url: "/barang/getkdbarang",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        $('#kodebarang').val(response.kode_barang);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        })

        $('#btnsaveobat').click(function(e) {

            if ($('#kodebarang').val() == '') {
                $('#kodebarang').focus();
                $("#kodebarang").addClass("is-invalid");
            } else if ($('#namabarang').val() == '') {
                $('#namabarang').focus();
                $("#namabarang").addClass("is-invalid");
            } else if ($('#hargabeli').val() == '') {
                $('#hargabeli').focus();
                $("#hargabeli").addClass("is-invalid");
            } else if ($('#hargajual').val() == '') {
                $('#hargajual').focus();
                $("#hargajual").addClass("is-invalid");
            } else if ($('#multidose').val() == '1' && $('#dosis_obat').val() == '' && $('#dosis_satuan').val() == '') {
                if ($('#dosis_obat').val() == '') {
                    $('#dosis_obat').focus();
                    $("#dosis_obat").addClass("is-invalid");
                } else if ($('#dosis_satuan').val() == '') {
                    $('#dosis_satuan').focus();
                    $("#dosis_satuan").addClass("is-invalid");
                }
            } else {
                multidose = 0;
                if ($('#multidose').val() == 1) {
                    if ($('#multidosekonversi').val() == 1) {
                        multidose = 2;
                    } else if ($('#multidosekonversi').val() == 0) {
                        multidose = 1;
                    }
                }
                $.ajax({
                    url: "/barang/postBarang",
                    type: 'POST',
                    data: {
                        kode_brng: $('#kodebarang').val(),
                        nama_brng: $('#namabarang').val(),
                        kandungan: $('#kandungan').val(),
                        h_beli: $('#hargabeli').val(),
                        h_jual: $('#hargajual').val(),

                        satuan: $('#satuan').val(),

                        kenaikan: $('#kenaikan').val(),
                        kdjns: $('#jenis').val(),
                        kode_kategori: $('#kategori').val(),
                        kode_golongan: $('#golongan').val(),

                        stokminimal: $('#stokminimal').val(),
                        batas_beri: $('#maksimalberi').val(),

                        multidose: multidose,
                        dosis: $('#dosis_obat').val(),
                        dosis_ml: $('#dosis_obatml').val(),
                        dosis_mg: $('#dosis_obatmg').val(),
                        satuan_dosis: $('#dosis_satuan').val(),

                        high_alert: $('#high_alert').val(),
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
                                getDataBarang();
                                $('#namabarang').val('');
                                $('#hargabeli').val('');
                                $('#hargajual').val('');

                                $('#kenaikan').val('');
                                $('#jenis').val('');
                                $('#kategori').val('');
                                $('#golongan').val('');

                                $('#stokminimal').val('');
                                $('#maksimalberi').val('');

                                $('#modalAddBarang').modal('hide');
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

        $('#btnupdateobat').click(function(e) {

            if ($('#kodebarang2').val() == '') {
                $('#kodebarang2').focus();
                $("#kodebarang2").addClass("is-invalid");
            } else if ($('#namabarang2').val() == '') {
                $('#namabarang2').focus();
                $("#namabarang2").addClass("is-invalid");
            } else if ($('#hargabeli2').val() == '') {
                $('#hargabeli2').focus();
                $("#hargabeli2").addClass("is-invalid");
            } else if ($('#hargajual2').val() == '') {
                $('#hargajual2').focus();
                $("#hargajual2").addClass("is-invalid");
            } else if ($('#multidose2').val() == '1' && $('#dosis_obat2').val() == '' && $('#dosis_satuan2').val() == '') {
                if ($('#dosis_obat2').val() == '') {
                    $('#dosis_obat2').focus();
                    $("#dosis_obat2").addClass("is-invalid");
                } else if ($('#dosis_satuan2').val() == '') {
                    $('#dosis_satuan2').focus();
                    $("#dosis_satuan2").addClass("is-invalid");
                }
            } else {

                multidose = 0;
                if ($('#multidose2').val() == 1) {
                    if ($('#multidosekonversi2').val() == 1) {
                        multidose = 2;
                    } else if ($('#multidosekonversi2').val() == 0) {
                        multidose = 1;
                    }
                }

                $.ajax({
                    url: "/barang/updateBarang",
                    type: 'POST',
                    data: {
                        kode_brng: $('#kodebarang2').val(),
                        nama_brng: $('#namabarang2').val(),
                        kandungan: $('#kandungan2').val(),
                        h_beli: $('#hargabeli2').val(),
                        h_jual: $('#hargajual2').val(),

                        satuan: $('#satuan2').val(),

                        kenaikan: $('#kenaikan2').val(),
                        kdjns: $('#jenis2').val(),
                        kode_kategori: $('#kategori2').val(),
                        kode_golongan: $('#golongan2').val(),

                        stokminimal: $('#stokminimal2').val(),
                        batas_beri: $('#maksimalberi2').val(),

                        multidose: multidose,
                        dosis: $('#dosis_obat2').val(),
                        dosis_ml: $('#dosis_obatml2').val(),
                        dosis_mg: $('#dosis_obatmg2').val(),
                        satuan_dosis: $('#dosis_satuan2').val(),

                        high_alert: $('#high_alert2').val(),
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
                                getDataBarang();
                                $('#namabarang').val('');
                                $('#hargabeli').val('');
                                $('#hargajual').val('');

                                $('#kenaikan').val('');
                                $('#jenis').val('');
                                $('#kategori').val('');
                                $('#golongan').val('');

                                $('#stokminimal').val('');
                                $('#maksimalberi').val('');

                                $('#modalEditBarang').modal('hide');
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

        $('#hargabeli').on('input', function() {

            var hargajual = 0;
            hargajual = Math.round(parseInt($('#hargabeli').val()) +
                (
                    (parseInt($('#penjualan').val()) / 100) *
                    parseInt(parseInt($('#hargabeli').val()))));


            if (hargajual % 100 != 0) {
                hargajual = (parseInt(hargajual / 100) + 1) * 100;
            }

            $('#hargajual').val(hargajual);
        });

        $('#hargabeli2').on('input', function() {

            var hargajual = 0;
            hargajual = Math.round(parseInt($('#hargabeli2').val()) +
                (
                    (parseInt($('#penjualan').val()) / 100) *
                    parseInt(parseInt($('#hargabeli2').val()))));


            if (hargajual % 100 != 0) {
                hargajual = (parseInt(hargajual / 100) + 1) * 100;
            }

            $('#hargajual2').val(hargajual);
        });

        $('#depo').on('change', function() {
            getDataBarang();
        });
    </script>
@endsection
