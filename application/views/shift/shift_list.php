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
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>DATA SHIFT</h3>
                    <div class="pull-right">
                        <?php echo anchor(site_url('tambah_shift'), ' <i class="fa fa-plus"></i> &nbsp;&nbsp; Tambah Baru', 'class="btn btn-unique btn-lg  btn-create-data btn3d"'); ?>
                    </div>
                </div>
                <div class="box-body">
                    <table id="mytable" class="table table-bordered table-hover display" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Shift</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($shift_data as $shift) { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $shift->nama_shift ?></td>
                                <td>
                                    <?php
                                        echo anchor(site_url('shift/lihat/' . $shift->id_shift), '<i class="fa fa-eye fa-lg"></i>&nbsp;&nbsp;Lihat', array('title' => 'detail', 'class' => 'btn btn-md btn-success btn3d'));
                                        echo anchor(site_url('shift/update/' . $shift->id_shift), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-md btn-warning btn-edit-data btn3d'));
                                        echo anchor(site_url('shift/delete/' . $shift->id_shift), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Delete', 'title="delete" class="btn btn-md btn-danger btn-remove-data btn3d"');
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
                                    columnDefs: [{
                                        targets: [-1, -3],
                                        className: 'dt-responsive'
                                    }],
                                });
                        });
                    </script>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script>
    $(document).ready(function() {
        let checkLogin = '<?= $result ?>';
        if (checkLogin == 0) {
            $('.btn-create-data').hide();
            $('.btn-edit-data').hide();
            $('.btn-remove-data').hide();
        }
    });
</script>