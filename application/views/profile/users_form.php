
<!-- Main content -->
<section class='content'>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <?php $this->load->view('profile/profile_image') ?>
            </div><!-- /.box -->
        </div>
        <div class="col-md-8">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Info Profil</a></li>
                    <li>
                        <a href="#tab_2" data-toggle="tab">
                            Ganti Password
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <?=form_open('users/update_profile', array('role' => 'form','id'=>'user_info','data-toggle' => 'validator'), array('id'=>$users->id))?>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Data user</h3>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="form-group has-feedback">
                                    <label for="username" class="control-label">Username <?php echo form_error('username') ?>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" data-error="Username harus diisi" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" required/>
                                        <span class="input-group-addon">
                                            <span class="fas fa-user"></span>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="email" class="control-label">Email <?php echo form_error('email') ?></label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" data-error="Email tidak valid" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" required/>
                                        <span class="input-group-addon">
                                            <span class="fas fa-at"></span>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="first_name" class="control-label">Nama Depan<?php echo form_error('first_name') ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" data-error="Nama depan harus diisi" name="first_name" id="first_name" placeholder="Nama Depan" value="<?php echo $first_name; ?>" required/>
                                        <span class="input-group-addon">
                                            <span class="far fa-id-card"></span>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="last_name" class="control-label">Nama Belakang<?php echo form_error('last_name') ?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" data-error="Nama belakang harus diisi" name="last_name" id="last_name" placeholder="Nama Belakang" value="<?php echo $last_name; ?>" required/>
                                        <span class="input-group-addon">
                                            <span class="far fa-id-card"></span>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <button type="submit" id="btn-info" class="btn btn-primary btn3d"><?php echo $button ?></button>
                                <a href="<?php echo site_url('users') ?>" class="btn btn-default btn3d">Cancel</a>
                            </div>
                        </div>
                        <?=form_close()?>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <?php if($user->id === $users->id) : ?>
                            <?=form_open('users/change_pwprof', array('id'=>'user_status','role' => 'form','data-toggle' => 'validator'), array('id'=>$users->id))?>
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Ganti Password</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="box-body pb-0">
                                        <div class="form-group has-feedback">
                                            <label for="old" class="control-label">Password Lama</label>
                                            <div class="input-group">
                                                <input type="password" data-error="Masukkan password lama" placeholder="Password Lama" name="old" id="old" autocomplete="current-password" class="form-control" required/>
                                                <span class="input-group-addon">
                                                    <span class="fas fa-key"></span>
                                                </span>
                                            </div>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="new" class="control-label">Password Baru</label>
                                            <div class="input-group">
                                                <input type="password" data-minlength="8" placeholder="Password Baru" name="new" id="new" autocomplete="new-password" class="form-control" required/>
                                                <span class="input-group-addon">
                                                    <span class="fas fa-key"></span>
                                                </span>
                                            </div>
                                            <small class="help-block">Minimal 8 karakter</small>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="new_confirm">Konfirmasi Password</label>
                                            <div class="input-group">
                                                <input type="password"  data-error="Masukkan konfirmasi password" placeholder="Konfirmasi Password Baru" autocomplete="new-password" name="new_confirm" id="new_confirm" class="form-control" data-match="#new"  data-match-error="Password tidak sama" required/>
                                                <span class="input-group-addon">
                                                    <span class="fas fa-key"></span>
                                                </span>
                                            </div>
                                            <small class="help-block with-errors"></small>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" id="btn-pass" class="btn btn-warning btn3d">Ganti Password</button>
                                        <button type="reset" class="btn btn-default btn3d">
                                            <i class="fa fa-rotate-left"></i> Reset
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
