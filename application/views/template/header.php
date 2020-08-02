<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>K</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Absesi Karyawan</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        if (function_exists('date_default_timezone_set'))
                            date_default_timezone_set('Asia/Jakarta');
                        ?>
                        <span id="clock">&nbsp;</span>
                    </a>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url() ?>assets/dist/img/user4-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">Welcome, <?= $user->first_name ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url() ?>assets/dist/img/user4-160x160.jpg" class="img-circle" alt="User Image">
                            <p>
                                <?= $user->first_name . ' ' . $user->last_name ?>
                                <small>Member since <?= date('M, Y', $user->created_on) ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo base_url(('users/profile/') . $users->id); ?>" class="btn btn-default btn-lg">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?php
                                echo anchor('auth/logout', 'Sign out', array('class' => 'btn btn-default btn-lg'));
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>