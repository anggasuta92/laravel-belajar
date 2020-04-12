@php
    $uri_segment = Request::segment(1);
    $uri_segment_dua = Request::segment(2);
@endphp

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RetroAppTech Bali</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="{{ asset('asstes/favicon.png') }}" rel="shortcut icon">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/morris.js/morris.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/jvectormap/jquery-jvectormap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/retro-modification.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/jquery-ui-1.12.1/jquery-ui.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
    </head>
    @guest

        @yield('content')

    @else
    <!-- <body class="hold-transition skin-blue-light sidebar-mini"> -->
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('layouts.navbar')

            @php
                $menu_master_active = false;
                $menu_transaksi_active = false;
                $menu_laporan_active = false;

                if($uri_segment=="kategori" || $uri_segment=="satuan" || $uri_segment=="barang" || $uri_segment=="brand"){
                    $menu_master_active = true;
                }else if($uri_segment=="pembelian"){
                    $menu_transaksi_active = true;
                }else if($uri_segment==""){

                }
            @endphp
            @include('layouts.sidebar')

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                    My Company
                    <small>Jalan Raya</small>
                    </h1>
                    <ol class="breadcrumb">
                    <!--<li><a href="#"><i class="fa fa-dashboard"></i> </a></li> -->
                    <!--<li class="active">Dashboard</li> -->
                    </ol>
                </section>

                <section class="content">
                    <div class="row">
                        @yield('content')
                    </div>
                </section>
            </div>
            @include('layouts.footer')
        </div>

        <div class="modal fade" id="iniModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Default Modal</h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        @endguest

        <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/bower_components/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('assets/bower_components/morris.js/morris.min.js') }}"></script>
        <script src="{{ asset('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('assets/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
        <script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
        <script src="{{ asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
        <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
        <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
        <script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery-numeric.js') }}"></script>
        <script src="{{ asset('assets/js/custom-function.js') }}"></script>

        @if($uri_segment === "penjualan")
        <script src="{{ asset('assets/js/penjualan.js') }}"></script>
        @endif


        @if (session('status'))
        <script>
            swal("{{ session('msg') }}", "", "{{ session('status') }}");
        </script>
        @endif

        @if($errors->any())
            @php
                $err_msg = "";
            @endphp
            @foreach ($errors->all() as $error)
                @php
                    $err_msg = $err_msg . $error;
                @endphp
            @endforeach

        <script>
            swal("{{ $err_msg }}", "", "warning");
        </script>
        @endif
                
        @if($uri_segment === "pembelian")
        <!-- select items purchase -->
        <script type="text/javascript"> 
            $(function() {
                $( "#cari_barang" ).autocomplete({
                    source: function( request, response ) {
                        var source_url = "{{ route('beli.searchitem') }}";
                        $.ajax({
                            type:"GET",
                            url:source_url,
                            data: { q: $("#cari_barang").val() },
                            dataType:"json",
                            //contentType:"application/json; charset=utf-8",
                            success:function(data) {
                                response(data);
                            },
                            error:function(data) {
                                alert("Data tidak ditemukan");
                            }
                        });
                    },
                    select: function( event, ui ) {
                        $("#nama_barang").val(ui.item.name);
                        $("#code_barang").val(ui.item.code + "/" + ui.item.barcode);
                        $("#barang_id").val(ui.item.id);
                        $("#price").val(ui.item.hpp);
                        document.getElementById("qty").focus();
                    }
                }).data("ui-autocomplete")._renderItem = function (ul, item) {
                    return $( "<li></li>" )
                        .data( "item.autocomplete", item )
                        .append("<div style=\"border:1px\">"+
                                    "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">"+
                                        "<tr>"+
                                            "<td width=\"75px\">Code</td>"+
                                            "<td>: "+ item.code +"</td>"+
                                        "</tr>"+
                                        "<tr>"+
                                            "<td>Name</td>"+
                                            "<td>: "+ item.name +"</td>"+
                                        "</tr>"+
                                        "<tr>"+
                                            "<td>Harga Beli Terakhir</td>"+
                                            "<td align=\"left\">: Rp. <strong>"+ numberFormat(item.hpp) +"</strong></td>"+
                                        "</tr>"+
                                        "<tr height=\"1\">"+
                                            "<td style=\"background-color:#999999;\" colspan=\"2\"></td>"+
                                        "</tr>"+
                                    "</table>"+
                                "</div>")
                        .appendTo( ul );
                }
                });

            /* confirm delete */
            function confirmDeleteItem(itemId, itemName){
                swal({
                title: "Konfirmasi",
                text: "Apakah anda ingin menghapus item " + itemName + " ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((deleteSaja) => {
                if (deleteSaja) {
                    $('#del_item_id').val(itemId);
                    $('#form-del-item').submit(); 
                } else {
                    $('#del_item_id').val('');
                    swal("Data batal dihapus");
                }
                });
            }

            function deleteSN(snId, serialNumber){
                swal({
                title: "Konfirmasi",
                text: "Apakah anda ingin menghapus serial number: " + serialNumber + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((deleteSaja) => {
                if (deleteSaja) {
                    $('#sn_id').val(snId);
                    $('#form-del-sn').submit(); 
                } else {
                    $('#sn_id').val('');
                    swal("Data batal dihapus");
                }
                });
            }

            function updateMain(){
                $('#type_input').val('main');
                $('#form-beli').submit(); 
            }

            function showDetailSN(id){
                // AJAX request
                $.ajax({
                    url: "{{ route('beli.serialnumber.detail') }}",
                    type: 'get',
                    data: {id: id},
                    success: function(response){ 
                    // Add response in Modal body
                    $('.modal-body').html(response);
                    $('.modal-title').html('Serial Number Detail');
                    // Display Modal
                    $('#iniModal').modal('show'); 
                    }
                });
            }

            function pdf(id){
                window.open("{{ route('beli.pdf') }}?id=" + id, "", "width=900,height=600");
            }

        </script>
        @endif

        <script>
            window.setTimeout("waktu()", 1000);
            function waktu() {
                var waktu = new Date();
                setTimeout("waktu()", 1000);
                var strWaktu = waktu.getFullYear() + "-" + (('0' + (waktu.getMonth()+1)).slice(-2)) + "-" + (('0' + waktu.getDate()).slice(-2)) + " " + waktu.getHours() + ":" + waktu.getMinutes() + ":" + waktu.getSeconds();
                document.getElementById('digital-clock').value = strWaktu;
                $('#digital-clock').html(strWaktu);
            }
        </script>

    </body>
</html>