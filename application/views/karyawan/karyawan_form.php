<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-<?=$box;?>'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>FORMULIR ANGGOTA</h3>
                </div>
                <div class="box-body">
                    <form role="form" id="myForm" data-toggle="validator" action="<?php echo $action; ?>" method="post">
                        <div class="form-group">
                            <label for="nama_karyawan" class="control-label">Nama Karyawan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" data-error="Nama Anggota harus diisi" placeholder="Nama Karyawan" value="<?php echo $nama_karyawan; ?>" required />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="control-label">Jabatan<?php echo form_error('jabatan') ?></label>
                            <div class="input-group">
                                <?php echo cmb_dinamis('jabatan', 'jabatan', 'jabatan', 'nama_jabatan', 'id_jabatan', $jabatan) ?>
                                <span class="input-group-addon">
                                    <span class="fas fa-briefcase"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gedung_id" class="control-label">Penempatan<?php echo form_error('gedung') ?></label>
                            <div class="input-group">
                                <?php echo cmb_dinamis('gedung_id', 'gedung_id', 'gedung', 'alamat', 'gedung_id', $gedung_id) ?>
                                <span class="input-group-addon">
                                    <span class="fas fa-location-arrow"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_shift" class="control-label">Shift<?php echo form_error('shfit') ?></label>
                            <div class="input-group">
                                <?php echo cmb_dinamis('id_shift', 'id_shift', 'shift', 'nama_shift', 'id_shift', $id_shift) ?>
                                <span class="input-group-addon">
                                    <span class="fas fa-retweet"></span>
                                </span>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-lg btn3d"><?php echo $button ?></button>
                            <a href="<?php echo site_url('karyawan') ?>" class="btn btn-default btn-lg btn3d">Cancel</a>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->