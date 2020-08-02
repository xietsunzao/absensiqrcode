
<section class='content'>
  <div class='row'>
    <div class='col-xs-12'>

<div class='box-header'>
<h3 class='box-title'>TAMBAH USER</h3>
</div>
<div class="container">
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="nav-item active"><a class="nav-link active" href="#form" data-toggle="tab" aria-expanded="false">Formulir</a></li>
        <li class="nav-item"><a class="nav-link" href="#status" data-toggle="tab" aria-expanded="false">status</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="form">
                  <div class="well">
                        <?php echo form_open("auth/create_user", 'class="bs-example form-horizontal"');?>

                        <fieldset>
                              <legend>Isi identitas formulir terlebih dahulu</legend>
                              <div class="form-group">
                                <label for="inputName" class="col-md-3 control-label">Nama Depan</label>
                                    <div class="col-md-7"> <?php echo form_input($first_name, null, 'class="form-control"');?></div>
                              </div>

                              <div class="form-group">
                                  <label for="inputName" class="col-md-3 control-label">Nama Belakang</label>
                                    <div class="col-md-7"> <?php echo form_input($last_name, null, 'class="form-control"');?></div>
                              </div>

                              <div class="form-group">
                                    <label for="inputName" class="col-md-3 control-label">No. Hp</label>
                                    <div class="col-md-7"> <?php echo form_input($phone, null, 'class="form-control"');?></div>
                              </div>

                              <div class="form-group">
                                <label for="inputName" class="col-md-3 control-label">Perusahaan</label>
                                    <div class="col-md-7"> <?php echo form_input($company, null, 'class="form-control"');?></div>
                              </div>

                        </fieldset>
                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="status">
                  <div class="well">
                  <div class="bs-example form-horizontal">
                  <fieldset>
                        <legend>Isi data autentikasi</legend>
                        <div class="form-group">
                          <label for="inputName" class="col-md-3 control-label">Email</label>
                              <div class="col-md-7"> <?php echo form_input($email, null, 'class="form-control"');?></div>
                        </div>

                        <div class="form-group">
                          <label for="inputName" class="col-md-3 control-label">Password</label>
                              <div class="col-md-7"> <?php echo form_input($password, null, 'class="form-control"');?></div>
                        </div>

                        <div class="form-group">
                          <label for="inputName" class="col-md-3 control-label">Confirm Password</label>
                              <div class="col-md-7"> <?php echo form_input($password_confirm, null, 'class="form-control"');?></div>
                        </div>

                  </fieldset>
                  <!-- The timeline -->
                  <fieldset>
                    <legend>Status & level </legend>

                    <div class="form-group">
                      <label for="inputName" class="col-md-3 control-label">Status</label>
                          <div class="col-md-7">  <label>
                               <input type="radio" name="status" class="minimal" value="1"> Aktif
                            </label>
                            <label>
                                <input  type="radio" name="status" class="minimal" value="0"> Tidak Aktif
                            </label> </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-md-3 control-label">Level</label>
                          <div class="col-md-7">  <select id="level" name="level" class="form-control select2" style="width: 100%!important">
                                  <div class="form-group">
                                <option value="">Pilih Level</option>
                                <?php foreach ($groups as $row) : ?>
                                    <option <?=$level->id===$row->id ? "selected" : ""?> value="<?=$row->id?>"><?=$row->name?></option>
                                <?php endforeach; ?>
                            </select>
                          </div>
                    </div>

                  <div class="form-group">

                              <div class="box-footer">
                                <div class="form-group">
                                  <label for="input" class="col-md-5 col-lg-offset-2 control-label">
                                  <button type="button" name="button" class="btn btn-danger btn-lg">Submit</button>
                                </div>
                            </div>
                          </fieldset>
                        </div>
                          </div>
                        </div>
                        <?=form_close()?>
                </div>
                <!-- /.tab-pane -->
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
        </div>
      </div>
    </div>
