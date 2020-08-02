<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-<?=$box?>'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>FORMULIR SHIFT</h3>
                </div>
                <div class="box-body">
                    <form role="form" id="myForm" data-toggle="validator" action="<?php echo $action; ?>" method="post">
                        <div class="form-group has-feedback">
                            <label for="nama_shift" class="label-control">Nama Shift <?php echo form_error('nama_shift') ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control" data-error="Nama Shift harus diisi" name="nama_shift" id="nama_shift" placeholder="Nama Shift" value="<?php echo $nama_shift; ?>" required />
                                <span class="input-group-addon">
                                    <span class="fas fa-retweet"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="id_shift" value="<?php echo $id_shift; ?>" />
                    <button type="submit" class="btn btn-lg btn-primary btn3d"><?php echo $button ?></button>
                    <a href="<?php echo site_url('shift') ?>" class="btn btn-lg btn-default btn3d">Cancel</a>
                </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->