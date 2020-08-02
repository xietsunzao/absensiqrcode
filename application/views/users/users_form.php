<!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'>

            <div class='box-header'>
            <h3 class='box-title'>USERS</h3>
            </div>
            <div class="row">
            <div class="col-md-6">

              <?=form_open('users/update_info', array('id'=>'user_info'), array('id'=>$users->id))?>
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Data user</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body chart-responsive">

                  <table class='table table-bordered'>
          	    <tr><td>Username <?php echo form_error('username') ?></td>
                      <td><input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                  </td>
          	    <tr><td>Email <?php echo form_error('email') ?></td>
                      <td><input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                  </td>
          	    <tr><td>First Name <?php echo form_error('first_name') ?></td>
                      <td><input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $first_name; ?>" />
                  </td>
          	    <tr><td>Last Name <?php echo form_error('last_name') ?></td>
                      <td><input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>" />
                  </td>


          	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
          	    <tr><td colspan='2'><button type="submit" id="btn-info" class="btn btn-primary"><?php echo $button ?></button>
          	    <a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a></td></tr>

              </table>
            </div>
              <?=form_close()?>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <?php if($user1->id !== $users->id) : ?>
            <div class="col-md-6">
            <?=form_open('users/update_status', array('id'=>'user_status'), array('id'=>$users->id))?>
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Status & Level</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                    <!-- content  disini-->
                    <div class="box-body pb-0">
                        <div class="form-group">
                            <label>
                                <input <?=$users->active==='1'?"checked":""?> type="radio" name="status" value="1"> Aktif
                            </label>
                            <label>
                                <input <?=$users->active==='0'?"checked":""?> type="radio" name="status" value="0"> Tidak Aktif
                            </label>

                            <small class="help-block"></small>
                            <div class="box-footer">
                                <button type="submit" id="btn-status" class="btn btn-primary">Simpan</button>
                            </div>
                            <br>
                            <?=form_close()?>
                            <?php endif;?>
                            <?php if($user->id !== $users->id) : ?>
                              <?=form_open('users/update_level', array('id'=>'user_level'), array('id'=>$users->id))?>
                              <select id="level" name="level" class="form-control select2" style="width: 100%!important">
                                    <div class="form-group">
                                  <option value="">Pilih Level</option>
                                  <?php foreach ($groups as $row) : ?>
                                      <option <?=$level->id===$row->id ? "selected" : ""?> value="<?=$row->id?>"><?=$row->name?></option>
                                  <?php endforeach; ?>
                              </select>
                              <small class="help-block"></small>
                                  <div class="box-footer">
                                  <button type="submit" id="btn-level" class="btn btn-primary">Simpan</button>
                                </div>
                              </div>
                              <?=form_close()?>
                              <?php endif;?>

                              <?php if($user->id === $users->id) : ?>
                              <div class="col-md-6">
                              <?=form_open('users/change_password', array('id'=>'user_status'), array('id'=>$users->id))?>
                                <div class="box box-danger">
                                  <div class="box-header with-border">
                                    <h3 class="box-title">Change Password</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body chart-responsive">
                                      <!-- content  disini-->
                                      <div class="box-body pb-0">
                                          <div class="form-group">
                                              <label for="old">Password Lama</label>
                                              <input type="password" placeholder="Password Lama" name="old" class="form-control">
                                              <small class="help-block"></small>
                                          </div>
                                          <div class="form-group">
                                              <label for="new">Password Baru</label>
                                              <input type="password" placeholder="Password Baru" name="new" class="form-control">
                                              <small class="help-block"></small>
                                          </div>
                                          <div class="form-group">
                                              <label for="new_confirm">Konfirmasi Password</label>
                                              <input type="password" placeholder="Konfirmasi Password Baru" name="new_confirm" class="form-control">
                                              <small class="help-block"></small>
                                          </div>
                                      </div>
                                      <div class="box-footer">
                                          <button type="reset" class="btn btn-flat btn-default">
                                              <i class="fa fa-rotate-left"></i> Reset
                                          </button>
                                          <button type="submit" id="btn-pass" class="btn btn-flat btn-warning">Ganti Password</button>
                                      </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                                  <?php endif; ?>
                            </div>

                        </div>
                    </div>
                  </div>

                    <!-- /.box-body -->
                </div>
              </div>
                  <!-- /.box -->
                      <!-- /.box-body -->
            <!-- /.col (LEFT) -->
            <!-- /.col (RIGHT) -->
          </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->


        </section><!-- /.content -->
        <script src="<?php echo base_url() ?>template/plugins/sweetalert/sweetalert.min.js"></script>
        <script>
        <?= $this->session->flashdata('messageAlert'); ?>
        </script>
