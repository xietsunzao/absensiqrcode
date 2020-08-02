<!-- Main content -->

<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-info'>
                <div class='box-header with-border'>
                    <h3 class='box-title'>MENU</h3>
                </div>
                <div class="box-body">
                    <form role="form" id="myForm" data-toggle="validator" action="<?php echo $action; ?>" method="post">
                        <div class="form-group">
                            <label for="name" class="control-label">Nama Menu</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" data-error="Nama menu harus diisi" value="<?php echo $name; ?>" required />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="link" class="control-label">URL Menu</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="link" id="link" placeholder="URL" data-error="URL Menu harus diisi" value="<?php echo $name; ?>" required />
                                <span class="input-group-addon">
                                    <span class="fas fa-external-link-alt"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="icon" class="control-label">Icon Menu</label>
                            <div class="input-group">
                                <input data-placement="bottomRight" name="icon" id="icon" placeholder="Icon" data-error="Icon Menu harus diisi" class="form-control icp icp-auto picker-target" value="<?php echo $icon; ?>" type="text" required />
                                <span class="input-group-addon">
                                    <span class="fab fa-font-awesome-flag"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="icon" class="control-label">Is Active</label>
                            <div class="input-group">
                                <?php echo form_dropdown('is_active', array('1' => 'AKTIF', '0' => 'TIDAK AKTIF'), $is_active, "class='form-control'"); ?>
                                <span class="input-group-addon">
                                    <span class="fas fa-check"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="icon" class="control-label">Is Parent</label>
                            <div class="input-group">
                                <select name="is_parent" class="form-control">
                                    <option value="0">YA</option>
                                    <?php
                                    $menu = $this->db->get('menu');
                                    foreach ($menu->result() as $m) {
                                        echo "<option value='$m->id' ";
                                        echo $m->id == $is_parent ? 'selected' : '';
                                        echo ">" .  strtoupper($m->name) . "</option>";
                                    } ?>
                                </select> <span class="input-group-addon">
                                    <span class="fas fa-grip-vertical"></span>
                                </span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                        <a href="<?php echo site_url('menu') ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->