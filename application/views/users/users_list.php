<style media="screen">
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
<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>DATA USERS </h3>
                    <div class="pull-right">
                        <?php echo anchor('tambah_user', 'Tambah user', array('class' => 'btn btn-unique btn-lg btn-create-data btn3d')); ?>
                    </div>
                </div>
                <div class="box-body">
                    <div class='box-body'>
                        <table id="mytable" class="table table-bordered table-hover display" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama lengkap</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($users_data as $users) { ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $users->first_name, '&nbsp',  $users->last_name ?></td>
                                    <td><?php echo $users->username ?></td>
                                    <td><?php echo $users->email ?></td>
                                    <td><?php echo $users->name ?></td>
                                    <td><?php echo $users->created_on ?></td>
                                    <td><?php if ($users->active == '1') { ?><span class="label label-success"><?php echo "active";
                                                                                                                } else { ?><span class="label label-danger"><?php echo "non active";
                                                                                                                                                                                } ?></td>
                                    <td style="text-align:center" width="140px">
                                        <?php
                                            echo anchor(site_url('users/update/' . $users->id), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-md btn-warning btn-edit-data btn3d'));
                                            echo anchor(site_url('users/delete/' . $users->id), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-md btn-danger btn-remove-data btn3d"');
                                            ?>
                                    </td>
                                </tr> <?php } ?>
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
                        <script type="text/javascript">
                            var user_id = '<?= $user->id ?>';
                        </script>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->