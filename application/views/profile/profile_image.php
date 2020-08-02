<style media="screen">
    .btn {
        font-size: .96rem;
    }
</style>
<?php $profile = $this->Users_model->getProfile();?>
<div class="box-body box-profile">
    <div id="crop-avatar">
        <div class="avatar-view">
            <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() ?>assets/dist/img/user4-160x160.jpg" alt="User profile picture">
            <h3 class="profile-username text-center">
                <?php echo $profile->first_name; ?>&nbsp;<?php echo $profile->last_name; ?>
            </h3>
            <p class="text-muted text-center"><?php echo $profile->email; ?></p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Akses</b> <a class="pull-right"><?php echo $profile->name; ?></a>
                </li>
                <li class="list-group-item">
                    <b>Tanggal Terdaftar</b> <a class="pull-right"><?php echo !is_null($user->created_on) ? date('Y-m-d H:i:s', $user->created_on) : "-"; ?></a>
                </li>
                <li class="list-group-item">
                    <b>Terakhir Login</b> <a class="pull-right"><?php echo !is_null($user->last_login) ? date('Y-m-d H:i:s', $user->last_login) : "-"; ?></a>
                </li>
            </ul>
        </div>
        <!-- Cropping modal -->
    </div>
</div><!-- /.box-body -->