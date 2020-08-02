<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/smartwizard/css/smart_wizard.min.css">
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>FORMULIR USER</h3>
                </div>
                <div class="box-body">
                    <div id="infoMessage"><?php echo $message; ?></div>
                    <?php echo form_open("auth/create_user", array('role' => 'form', 'id' => 'myForm', 'data-toggle' => 'validator', 'class' => 'bs-example form-horizontal')); ?>
                    <div class="col-md-12 container install swMain" id="smartwizard">
                        <ul>
                            <li class="step" data-step="1"><a href="#step-1">Formulir<br /><small>isi identitas user terlebih dahulu</small></a></li>
                            <li class="step" data-step="2"><a href="#step-2">Status<br /><small>tentukan username,password & level user</small></a></li>
                        </ul>
                        <div>
                            <div id="step-1" class="step-1">
                                <div id="form-step-0" role="form" data-toggle="validator">
                                    <div class="form-group has-feedback">
                                        <label for="first_name" class="col-md-3 control-label">Nama Depan</label>
                                        <div class="col-md-7 input-group">
                                            <?php echo form_input($first_name, null, 'data-error="Nama depan harus diisi" class="form-control" required'); ?>
                                            <span class="input-group-addon">
                                                <span class="far fa-id-card"> </span>
                                            </span>
                                        </div>
                                        <div class="col-xs-4 col-md-2 col-md-push-3 help-block with-errors"></div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label for="last_name" class="col-md-3 control-label">Nama Belakang</label>
                                        <div class="col-md-7 input-group">
                                            <?php echo form_input($last_name, null, 'data-error="Nama Belakang harus diisi" class="form-control" required'); ?>
                                            <span class="input-group-addon">
                                                <span class="far fa-id-card"> </span>
                                            </span>
                                        </div>
                                        <div class="col-xs-4 col-md-3 col-md-push-3 help-block with-errors"></div>
                                    </div>
                                    <?php
                                    if ($identity_column !== 'email') {
                                        echo '<p>';
                                        echo lang('create_user_identity_label', 'identity');
                                        echo '<br />';
                                        echo form_error('identity');
                                        echo form_input($identity);
                                        echo '</p>';
                                    }
                                    ?>
                                    <div class="form-group has-feedback">
                                        <label for="phone" class="col-md-3 control-label">No. Hp</label>
                                        <div class="col-md-7 input-group">
                                            <?php echo form_input($phone, null, 'data-minlength="12" data-error="Nomor HP harus diisi" class="form-control" required'); ?>
                                            <span class="input-group-addon">
                                                <span class="fas fa-mobile-alt"> </span>
                                            </span>
                                        </div>
                                        <div class="col-xs-4 col-md-3 col-md-push-3 help-block with-errors">Nomor HP harus 12 digit</div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="company" class="col-md-3 control-label">Perusahaan</label>
                                        <div class="col-md-7 input-group">
                                            <?php echo form_input($company, null, 'class="form-control"readonly'); ?>
                                            <span class="input-group-addon">
                                                <span class="fas fa-building"> </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-2" class="step-2">
                                <div id="form-step-1" role="form" data-toggle="validator">
                                    <div class="bs-example form-horizontal">
                                        <fieldset>
                                            <legend>Isi data autentikasi</legend>
                                            <div class="form-group has-feedback">
                                                <label for="email" class="col-md-3 control-label">Email</label>
                                                <div class="col-md-7 input-group">
                                                    <?php echo form_input($email, null, ' pattern="^[^@\\s]+@[^@\\s]+\\.[^@\\s]+$" data-error="email tidak valid" class="form-control" required'); ?>
                                                    <span class="input-group-addon">
                                                        <span class="fas fa-at"> </span>
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 col-md-7 col-md-push-3 help-block with-errors">harap menggunakan email yang valid cth: Example@gmail.com</div>
                                            </div>

                                            <div class="form-group has-feedback">
                                                <label for="password" class="col-md-3 control-label">Password</label>
                                                <div class="col-md-7 input-group">
                                                    <?php echo form_input($password, null, 'data-minlength="8" data-error="masukkan password minimal 8 karakter" class="form-control" required'); ?>
                                                    <span class="input-group-addon">
                                                        <span class="fas fa-key"> </span>
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 col-md-7 col-md-push-3 help-block with-errors"></div>
                                            </div>

                                            <div class="form-group has-feedback">
                                                <label for="inputName" class="col-md-3 control-label">Konfirmasi Password</label>
                                                <div class="col-md-7 input-group">
                                                    <?php echo form_input($password_confirm, null, ' data-error="Konfirmasi password harus di isi" class="form-control" data-match="#password"  data-match-error="Password tidak sama" required'); ?>
                                                    <span class="input-group-addon">
                                                        <span class="fas fa-key"> </span>
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 col-md-7 col-md-push-3 help-block with-errors"></div>
                                            </div>

                                        </fieldset>
                                        <!-- The timeline -->
                                        <fieldset>
                                            <legend> level </legend>
                                            <div class="form-group">
                                                <label for="inputName" class="col-md-3 control-label">Level</label>
                                                <div class="col-md-7"> <select id="level" name="level" class="form-control select2" style="width: 100%!important">
                                                        <div class="form-group">
                                                            <option value="">Pilih Level</option>
                                                            <?php foreach ($groups as $row) : ?>
                                                            <option <?= $level->id === $row->id ? "selected" : "" ?> value="<?= $row->id ?>"><?= $row->name ?></option>
                                                            <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="box-footer">
                                                    <div class="form-group">
                                                        <label for="input" class="col-md-5 col-lg-offset-2 control-label">
                                                            <p><?php echo form_submit('submit', lang('create_user_submit_btn'), 'class = "btn btn-indigo btn-lg"'); ?></p>
                                                            <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>

<script src="<?php echo base_url()?>assets/plugins/smartwizard/js/jquery.smartWizard.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Finish')
            .addClass('btn btn-info')
            .on('click', function() {
                if (!$(this).hasClass('disabled')) {
                    var elmForm = $("#myForm");
                    if (elmForm) {
                        elmForm.validator('validate');
                        var elmErr = elmForm.find('.has-error');
                        if (elmErr && elmErr.length > 0) {
                            alert('Oops we still have error in the form');
                            return false;
                        } else {
                            alert('Great! we are ready to submit form');
                            elmForm.submit();
                            return false;
                        }
                    }
                }
            });
        var btnCancel = $('<button></button>').text('Cancel')
            .addClass('btn btn-danger')
            .on('click', function() {
                $('#smartwizard').smartWizard("reset");
                $('#myForm').find("input, textarea").val("");
            });


        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'default',
            transitionEffect: 'fade',
            autoFocus: true,
            saveState: false,
            showStepURLhash: false,
            contentCache: false,
            toolbarSettings: {
                toolbarPosition: 'bottom',
                toolbarExtraButtons: []
            },
            anchorSettings: {
                markDoneStep: true, // add done css
                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                enableAnchorOnDoneStep: false, // Enable/Disable the done steps navigation
            },
        });
    });

    $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
        var elmForm = $("#form-step-" + stepNumber);
        // stepDirection === 'forward' :- this condition allows to do the form validation
        // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
        if (stepDirection === 'forward' && elmForm) {
            elmForm.validator('validate');
            var elmErr = elmForm.children('.has-error');
            if (elmErr && elmErr.length > 0) {
                // Form validation failed
                return false;
            }
        }
        return true;
    });
</script>