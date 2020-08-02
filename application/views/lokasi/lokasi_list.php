<style media="screen">
    table,
    th,
    tr {
        text-align: center;
    }

    .dataTables_wrapper .dt-buttons {
        float: none;
        text-align: center;
    }

    .swal2-popup {
        font-family: inherit;
        font-size: 1.2rem;
    }

    div.dataTables_wrapper div.dataTables_length label {
        padding-top: 5px;
        font-weight: normal;
        text-align: left;
        white-space: nowrap;
    }
</style>
<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>DATA LOKASI</h3>
                    <div class="pull-right">
                        <?php echo anchor(site_url('tambah_lokasi'), ' <i class="fa fa-plus"></i> &nbsp;&nbsp; Tambah Baru', 'class="btn btn-unique btn-lg btn-create-data btn3d"'); ?>
                    </div>
                </div>
                <div class="box-body">
                    <div class="actionPart">
                        <div class="actionSelect">
                            <div class="col-md-3">
                                <select id="exportLink" class="form-control">
                                    <option>Export Data</option>
                                    <option id="csv">Export as CSV</option>
                                    <option id="excel">Export as XLS</option>
                                    <option id="copy">Copy to clipboard</option>
                                    <option id="pdf">Export as PDF</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <table id="mytable" class="table table-bordered table-hover display" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Gedung</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($gedung_data as $gedung) { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $gedung->nama_gedung ?></td>
                                <td><?php echo $gedung->alamat ?></td>
                                <td>
                                    <?php
                                        echo anchor(site_url('lokasi/lihat/' . $gedung->gedung_id), '<i class="fa fa-eye fa-lg"></i>&nbsp;&nbsp;Lihat', array('title' => 'detail', 'class' => 'btn btn-md btn-success btn3d'));
                                        echo anchor(site_url('lokasi/update/' . $gedung->gedung_id), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-md btn-warning btn-edit-data btn3d'));
                                        echo anchor(site_url('lokasi/delete/' . $gedung->gedung_id), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-md btn-danger btn-remove-data btn3d"');
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
                                    }],
                                    dom: 'Blfrtip',
                                    buttons: [
                                        'colvis',
                                        {
                                            extend: 'csv',
                                            exportOptions: {
                                                columns: [0, 1, 2],
                                            },
                                        },
                                        {
                                            extend: 'excel',
                                            title: 'Data Lokasi',
                                            exportOptions: {
                                                columns: [0, 1, 2],
                                            },
                                        },
                                        {
                                            extend: 'copy',
                                            title: 'Data Lokasi',
                                            exportOptions: {
                                                columns: [0, 1, 2],
                                            },
                                        },
                                        {
                                            extend: 'pdf',
                                            oriented: 'portrait',
                                            pageSize: 'A4',
                                            title: 'Data Lokasi',
                                            download: 'open',
                                            exportOptions: {
                                                columns: [0, 1, 2],
                                            },
                                            customize: function(doc) {
                                                doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                                                doc.styles.tableBodyEven.alignment = 'center';
                                                doc.styles.tableBodyOdd.alignment = 'center';
                                            },
                                        },
                                        {
                                            extend: 'print',
                                            oriented: 'portrait',
                                            pageSize: 'A4',
                                            title: 'Data Lokasi',
                                            exportOptions: {
                                                columns: [0, 1, 2],
                                            },
                                        },
                                    ],
                                    initComplete: function() {
                                        var $buttons = $('.dt-buttons').hide();
                                        $('#exportLink').on('change', function() {
                                            var btnClass = $(this).find(":selected")[0].id ?
                                                '.buttons-' + $(this).find(":selected")[0].id :
                                                null;
                                            if (btnClass) $buttons.find(btnClass).click();
                                        })
                                    }
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