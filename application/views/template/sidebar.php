<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() ?>assets/dist/img/user4-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Absensi Karyawan</p>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php if ($this->ion_auth->is_admin()) : ?>
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo base_url('dashboard') ?>">
                    <i class="fa fa-laptop"></i> <span>DASHBOARD</span>
                    <small class="label pull-right bg-red">6</small>
                </a>
            </li>
            <?php
                $menu = $this->db->get_where('menu', array('is_parent' => 0, 'is_active' => 1));
                foreach ($menu->result() as $m) {
                    // chek ada sub menu
                    $submenu = $this->db->get_where('menu', array('is_parent' => $m->id, 'is_active' => 1));
                    if ($submenu->num_rows() > 0) {
                        // tampilkan submenu
                        echo "<li class='treeview'>
                                    " . anchor('#',  "<i class='$m->icon'></i> <span>" . strtoupper($m->name) . ' </span><i class="fa fa-angle-left pull-right"></i>') . "
                                        <ul class='treeview-menu'>";
                        foreach ($submenu->result() as $s) {
                            echo "<li>" . anchor($s->link, "<i class='$s->icon'></i> <span>" . strtoupper($s->name)) . "</span></li>";
                        }
                        echo "</ul>
                                    </li>";
                    } else {
                        echo "<li>" . anchor($m->link, "<i class='$m->icon'></i> <span>" . strtoupper($m->name)) . "</span></li>";
                    }
                }
                ?>
        </ul>
        <?php else: ?>
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo base_url('dashboard') ?>">
                    <i class="fa fa-laptop"></i> <span>DASHBOARD</span>
                    <small class="label pull-right bg-red">6</small>
                </a>
            </li>
            <li class="treeview active">
                <a href="#"><i class="fa fa-folder"></i> <span>MASTER DATA </span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu menu-open" style="display: block;">
                    <li><a href="<?php echo base_url('karyawan') ?>"><i class="fa fa-user"></i> <span>DATA KARYAWAN</span></a></li>
                    <li><a href="<?php echo base_url('jabatan') ?>"><i class="fa fa-briefcase"></i> <span>DATA JABATAN</span></a></li>
                    <li><a href="<?php echo base_url('shift') ?>"><i class="fa fa-retweet"></i> <span>DATA SHIFT</span></a></li>
                    <li><a href="<?php echo base_url('lokasi') ?>"><i class="fa fa-location-arrow"></i> <span>DATA LOKASI</span></a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('scan') ?>">
                    <i class="fa fa-camera"></i> <span>SCAN</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('presensi') ?>">
                    <i class="fa fa-paperclip"></i> <span>HISTORI ABENSI</span>
                </a>
            </li>
        </ul>
        <?php endif; ?>
    </section>
</aside>