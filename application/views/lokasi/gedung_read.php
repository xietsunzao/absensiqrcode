<style media="screen">
    table,
    tr,
    th,
    td {
        text-align: center;
    }

    .dataTables_wrapper .dt-buttons {
        float: none;
        text-align: center;
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
            <div class='box box-success'>
                <div class='box-header'>
                    <div class="col-md-4 col-md-6 col-md-push-4">
                        <?php $gedung = $this->Gedung_model->get_by_id($segment = $this->uri->segment(3)); ?>
                        <h3 class='box-title'>
                            <p align="center"> DETAIL <?php echo $gedung->nama_gedung ?></p>
                            <p align="center"> <?php echo $gedung->alamat ?></p>
                        </h3>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
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
                    <table id="mytable" class="table table-bordered table-hover display" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="20px">No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Shift</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($gedung_data as $gedung) { ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $gedung->nama_karyawan ?></td>
                                    <td><?php echo $gedung->nama_jabatan ?></td>
                                    <td>
                                        <?php echo $gedung->nama_shift ?>
                                    </td>
                                </tr> <?php } ?>
                        </tbody>
                        <tr>
                            <td colspan="5" style="text-align:center;"><?php echo anchor('lokasi', 'Kembali', array('class' => 'btn btn-indigo btn-lg btn3d')); ?></td>
                        </tr>
                    </table>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#mytable")
                                .addClass('nowrap')
                                .dataTable({
                                    responsive: true,
                                    columnDefs: [{
                                        targets: [-1, -4],
                                        className: 'dt-responsive'
                                    }],
                                    dom: 'Blfrtip',
                                    buttons: [
                                        'colvis',
                                        {
                                            extend: 'csv',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3],
                                            },
                                        },
                                        {
                                            extend: 'excel',
                                            title: 'PENGAMANAN <?php echo $gedung->nama_gedung ?>',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3],
                                            },
                                        },
                                        {
                                            extend: 'copy',
                                            title: 'PENGAMANAN <?php echo $gedung->nama_gedung ?>',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3],
                                            },
                                        },
                                        {
                                            extend: 'pdf',
                                            oriented: 'portrait',
                                            pageSize: 'A4',
                                            title: 'PENGAMANAN <?php echo $gedung->nama_gedung ?>',
                                            download: 'open',
                                            exportOptions: {
                                                columns: [0, 2, 3],
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
                                            title: 'PENGAMANAN <?php echo $gedung->nama_gedung ?>',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, 4],
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