<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/font-awesome-4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/ionicons-2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/gif">

</head>
<style>
    .login-logo a,
    .register-logo a {
        color: #fbfbfb;
    }
</style>


<body class="hold-transition login-page">

    <style media="screen">

    </style>

    <div class="login-box">

        <!-- /.login-logo -->
        <div class="login-box pt-5">
            <!-- /.login-logo -->
            <div class="login-box-body">
                <h3 class="text-center mt-0 mb-4">
                    <b>S</b>istem <b>A</b>bsensi <b>Q</b>rcode
                </h3>
                <p class="login-box-msg">Login to start session</p>
                <div id="infoMessage" class="text-center"><?php echo $message; ?></div>
                <?= form_open("auth/cek_login", array('id' => 'login')); ?>
                <div class="form-group has-feedback">
                    <?= form_input($identity); ?>
                    <span class="fa fa-envelope form-control-feedback"></span>
                    <span class="help-block"></span>
                </div>
                <div class="form-group has-feedback">
                    <?= form_input($password); ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <span class="help-block"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <?= form_checkbox('remember', '', FALSE, 'id="remember"'); ?> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <?= form_submit('submit', lang('login_submit_btn'), array('id' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat')); ?>
                    </div>
                    <!-- /.col -->
                </div>
                <?= form_close(); ?>
                <p align='center'><b>Gunakan User dibawah ini</b></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>admin@admin.com</td>
                            <td>password</td>
                            <td>admin</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>operator@operator.com</td>
                            <td>password</td>
                            <td>operator</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <!-- SlimScroll -->
    <script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script src="<?= base_url() ?>assets/app/js/login.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>
<script type="text/javascript">
    let base_url = '<?= base_url(); ?>';
</script>

</html>