<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-<?= $box ?>'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>FORMULIR LOKASI</h3>
                </div>
                <div class="box-body">
                    <form role="form" id="myForm" data-toggle="validator" action="<?php echo $action; ?>" method="post">
                        <div class="form-group has-feedback">
                            <label for="nama_gedung" class="control-label">Nama Lokasi<?php echo form_error('nama_gedung') ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control" data-error="Nama gedung harus diisi" name="nama_gedung" id="nama_gedung" placeholder="Nama Lokasi" value="<?php echo $nama_gedung; ?>" required />
                                <span class="input-group-addon">
                                    <span class="fas fa-building"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="alamat" class="control-label">Alamat <?php echo form_error('alamat') ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control" data-error="Alamat harus diisi" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" required />
                                <span class="input-group-addon">
                                    <span class="fas fa-address-card"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <input type="hidden" name="gedung_id" value="<?php echo $gedung_id; ?>" />
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-lg btn3d"><?php echo $button ?></button>
                            <a href="<?php echo site_url('lokasi') ?>" class="btn btn-default  btn-lg btn3d">Cancel</a>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->