<style>
    table,
    th,
    tr {
        text-align: center;
    }

    .swal2-popup {
        font-family: inherit;
        font-size: 1.2rem;
    }
</style>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header with-border'>
                    <h3 class='box-title'>MANU MANAGEMENT</h3>
                    <div class="pull-right">
                        <?php echo anchor(site_url('tambah_menu'), ' <i class="fa fa-plus"></i> &nbsp;&nbsp; Tambah Baru', ' class="btn btn-unique btn-lg btn-create-data btn3d"'); ?>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <table id="mytable" class="table table-bordered table-hover display" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Link</th>
                                <th>Icon</th>
                                <th>Aktif</th>
                                <th>Parent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($menu_data as $menu) {
                                $active = $menu->is_active == 1 ? 'AKTIF' : 'TIDAK AKTIF';
                                $parent = $menu->is_parent > 1 ? 'MAINMENU' : 'SUBMENU'
                                ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $menu->name ?></td>
                                <td><?php echo $menu->link ?></td>
                                <td><i class='<?php echo $menu->icon ?>'></i></td>
                                <td><?php echo $active ?></td>
                                <td><?php echo $parent ?></td>
                                <td>
                                    <?php
                                        echo anchor(site_url('menu/read/' . $menu->id), '<i class="fa fa-eye fa-lg"></i>&nbsp;&nbsp;Lihat', array('title' => 'detail', 'class' => 'btn btn-md btn-success btn3d'));
                                        echo anchor(site_url('menu/update/' . $menu->id), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-md btn-warning btn-edit-data btn3d'));
                                        echo anchor(site_url('menu/delete/' . $menu->id), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-md btn-danger btn-remove-data btn3d"');
                                        ?>
                                </td>
                            </tr> <?php }  ?>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#mytable")
                                .addClass('nowrap')
                                .dataTable({
                                    responsive: true,
                                    colReorder: true,
                                    fixedHeader: true,
                                    columnDefs: [{
                                        targets: [-1, -3],
                                        className: 'dt-responsive'
                                    }]
                                });
                        });
                    </script>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->