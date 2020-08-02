<body class="hold-transition skin-blue layout-top-nav" onLoad="pindah()">
    
<div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">GENERATE QRCODE</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">INPUT NAMA DI SINI</label>
                                <input type="text" onChang="ready()" id="id"  name="id_karyawan" class="form-control" placeholder="Masukkan Nama yang terdaftar di Data Karyawan">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button onClick="ready()" onFocus="ready()" type="button" class="btn  btn-primary btn-lg btn3d">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">INFORMASI QRCODE AKAN MUNCUL DISINI</h3>
                        </div>
                        <div class="box-body ajax-content" id="showR"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jQueryUI/css/jquery-ui.css">
    <script  src="<?php echo base_url() ?>assets/plugins/jQueryUI/js/jquery-ui.js"></script>

    <script type="text/javascript">
        function pindah() {
            $('#id').focus();
        };

        function ready() {
            var id = $('#id').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('/GenBar/showw') ?>',
                data: `id=${id}`,
                beforeSend: function(msg) {
                    $('#showR').html('<h1><i class="fa fa-spin fa-refresh" /></h1>');
                },
                success: function(msg) {
                    $('#showR').html(msg);
                    $('#id_karyawan').focus();
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#id').autocomplete({
                source: "<?php echo site_url('GenBar/get_autocomplete'); ?>",
                select: function(event, ui) {
                    $('[name="qr"]').val(ui.item.label);
                }
            });
        });
    </script>
</body>

</html>