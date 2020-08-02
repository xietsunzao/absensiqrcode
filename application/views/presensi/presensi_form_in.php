<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jQueryUI/css/jquery-ui.css">
<?php $gedung = $this->Gedung_model->get_by_id($segment = $this->uri->segment(3));
?>
<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-info'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>PRESENSI</h3>
                </div>
                <div class="box-body">
                    <form role="form" id="myForm" data-toggle="validator" action="<?php echo $action; ?>" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo $gedung->gedung_id ?>">
                        <div class="form-group">
                            <label for="id_karyawan" class="control-label">Nama Karyawan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" data-error="Nama Karyawan harus diisi" name="id_karyawan" id="id_karyawan" placeholder="nama karyawan" required />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="jam_msk" class="control-label">Jam Masuk <?php echo form_error('jam_msk') ?></label>
                            <div class="input-group clockpicker">
                                <input type="text" class="form-control" data-error="Jam Masuk harus diisi" name="jam_msk" id="jam_msk" placeholder="Jam Masuk" required>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="jam_klr" class="control-label">Jam Pulang <?php echo form_error('jam_klr') ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="jam_klr" id="jam_klr" placeholder="Jam selesai" readonly />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                        <a href="<?php echo site_url('presensi') ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jQueryUI/css/jquery-ui.css">
<script src="<?php echo base_url() ?>assets/plugins/jQueryUI/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css">
<script src="<?php echo base_url() ?>assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">
    $('.clockpicker').clockpicker({
        donetext: 'Selesai',
        autoclose: true,
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_karyawan').autocomplete({
            source: "<?php echo site_url('presensi/get_autocomplete/' . $gedung->gedung_id); ?>",
            select: function(event, ui) {
                $('[name="id_karyawan"]').val(ui.item.label);
            }
        });
    });
</script>