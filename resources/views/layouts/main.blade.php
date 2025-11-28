<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    <link rel="shortcut icon" href="{{ asset('assets') }}/compiled/png/logo.png" type="image/x-icon">

    {{--
    <link rel="stylesheet" href="./assets/extensions/datatables.net-bs5/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="./assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="./assets/extensions/datatables.net-bs5/css/buttons.dataTables.css">

    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">

    <link rel="stylesheet" href="./assets/extensions/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="./assets/extensions/select2/css/select2.min.css">
    <link rel="stylesheet" href="./assets/extensions/select2/css/select2-bootstrap-5-theme.min.css">

    {{-- signaute pad --}}
    <link rel="stylesheet" type="text/css" href="./assets/extensions/signature-pad/assets/jquery.signaturepad.css">

    {{-- choices --}}
    <link rel="stylesheet" type="text/css" href="./assets/extensions/choices.js/public/assets/styles/choices.css">
    {{-- <style>
        .select2-container {
            z-index: 100000;
        }

        .select2-drop {
            z-index: 99999;
        }
    </style> --}}
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main" class='layout-navbar navbar-fixed'>
            @include('layouts.navbar')
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        {{-- <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>Vertical Layout with Navbar</h3>
                                <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Layout Vertical Navbar
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div> --}}
                    </div>
                    @yield('content')
                </div>

            </div>
            @include('layouts.footer')
        </div>
    </div>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="assets/compiled/js/app.js"></script>

    <script src="assets/extensions/jquery/jquery.min.js"></script>

    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>

    <script src="assets/extensions/select2/js/select2.min.js"></script>

    <script src="assets/extensions/parsleyjs/parsley.min.js"></script>

    {{-- signature pad --}}
    {{-- <script type="text/javascript" rc="{{ asset('assets') }}/libraries/bower_components/signature-pad/json2.js"></script> --}}
    <script type="text/javascript" src="assets/extensions/signature-pad/assets/numeric-1.2.6.min.js"></script>
    <script type="text/javascript" src="assets/extensions/signature-pad/assets/bezier.js"></script>
    <script type="text/javascript" src="assets/extensions/signature-pad/jquery.signaturepad.js"></script>
    {{--<script type="text/javascript" src="{{ asset('assets') }}/libraries/bower_components/signature-pad/assets/flashcanvas.js"></script> --}}

    {{-- choices --}}
    <script src="assets/extensions/choices.js/public/assets/scripts/choices.js"></script>

    <script>
        // $.fn.modal.Constructor.prototype.enforceFocus = function() {};

        $(document).ready(function(e) {
            $('#retunew').hide()
            $.ajax({
                url: "/data/getstatusmenu",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.retur > 0) {
                        $('#retunew').show()
                    } else {
                        $('#retunew').hide()
                    }


                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on("ajaxError", function(event, jqxhr, settings, thrownError) {
            console.log('error : ' + jqxhr.status);
            if (jqxhr.status == 419) {
                Swal.fire({
                    title: 'Sesion Timeout',
                    text: "Silahkan login ulang",
                    icon: 'error',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })
            }


        });

        function getJenisObat(opt = null) {
            $.ajax({
                url: "/data/getJenis",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        for (let i = 0; i < response.jenis.length; i++) {
                            $('#' + opt + '').append('<option value="' + response.jenis[i].kdjns + '">' +
                                response.jenis[i].nama + '</option>');
                        }
                    }

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }

        function getKategori(opt = null) {
            $.ajax({
                url: "/data/getKategori",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        for (let i = 0; i < response.kategori_barang.length; i++) {
                            $('#' + opt + '').append('<option value="' + response.kategori_barang[i].kode +
                                '">' + response.kategori_barang[i].nama + '</option>');
                        }
                    }

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }

        function getGolongan(opt = null) {
            $.ajax({
                url: "/data/getGolongan",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        for (let i = 0; i < response.golongan_barang.length; i++) {
                            $('#' + opt + '').append('<option value="' + response.golongan_barang[i].kode +
                                '">' + response.golongan_barang[i].nama + '</option>');
                        }
                    }

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }

        function getBangsal(opt = null) {
            $.ajax({
                url: "/data/getBangsal",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        for (let i = 0; i < response.bangsal.length; i++) {
                            $('#' + opt + '').append('<option value="' + response.bangsal[i].kd_bangsal +
                                '">' + response.bangsal[i].nm_bangsal + '</option>');
                        }
                    }

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }

        function getSatuan(opt = null) {
            $.ajax({
                url: "/data/getSatuan",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.code == 200) {
                        for (let i = 0; i < response.satuan_barang.length; i++) {
                            $('#' + opt + '').append('<option value="' + response.satuan_barang[i].kode_sat +
                                '">' + response.satuan_barang[i].satuan + '</option>');
                        }
                    }

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }


        $.extend(window.Parsley.options, {
            // focus: "first",
            // excluded: "input[type=button], input[type=submit], input[type=reset], .search, .ignore",
            // triggerAfterFailure: "change blur",
            // errorsContainer: function(element) {},
            // trigger: "change",
            successClass: "is-valid",
            errorClass: "is-invalid",
            classHandler: function(el) {
                return el.$element.closest(".form-group")
            },
            errorsContainer: function(el) {
                return el.$element.closest(".form-group")
            },
            errorsWrapper: '<div class="parsley-error"></div>',
            errorTemplate: "<span></span>",
        })

        Parsley.on("field:validated", function(el) {
            var elNode = $(el)[0]
            if (elNode && !elNode.isValid()) {
                var rqeuiredValResult = elNode.validationResult.filter(function(vr) {
                    return vr.assert.name === "required"
                })
                if (rqeuiredValResult.length > 0) {
                    var fieldNode = $(elNode.element)
                    var formGroupNode = fieldNode.closest(".form-group")
                    var lblNode = formGroupNode.find(".form-label:first")
                    if (lblNode.length > 0) {
                        // change default error message to include field label
                        var errorNode = formGroupNode.find(
                            "div.parsley-error span[class*=parsley-]"
                        )
                        if (errorNode.length > 0) {
                            var lblText = lblNode.text()
                            if (lblText) {
                                errorNode.html(lblText + " is required.")
                            }
                        }
                    }
                }
            }
        })
    </script>

    @yield('script')


</body>

</html>
