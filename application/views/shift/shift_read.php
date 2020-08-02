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
</style>

<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-success'>
                <div class='box-header with-border'>
                    <?php $shift = $this->Shift_model->get_by_id($segment = $this->uri->segment(3)); ?>
                    <h4 class='box-title'> TABEL DATA <?php echo $shift->nama_shift ?></h3>
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
                                <th>NIK</th>
                                <th>Nama Karyawan</th>
                                <th>Jabatan </th>
                                <th>Lokasi</th>
                                <th>alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($shift_data2 as $shift) { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $shift->id_karyawan ?></td>
                                <td><?php echo $shift->nama_karyawan ?></td>
                                <td> <?php echo $shift->nama_jabatan ?></td>
                                <td><?php echo $shift->nama_gedung ?></td>
                                <td><?php echo $shift->alamat ?></td>
                            </tr> <?php } ?>
                        </tbody>
                        <tr>
                            <td colspan="6" style="text-align:center;"><?php echo anchor('shift', 'Kembali', array('class' => 'btn btn-indigo btn-lg btn3d')); ?></td>
                        </tr>
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
                                        targets: [-1, -4],
                                        className: 'dt-responsive'
                                    }],
                                    dom: 'Blfrtip',
                                    buttons: [
                                        'colvis',
                                        {
                                            extend: 'csv',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, 4],
                                            },
                                        },
                                        {
                                            extend: 'excel',
                                            title: 'DATA <?php echo $shift->nama_shift ?>',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, 4],
                                            },
                                        },
                                        {
                                            extend: 'copy',
                                            title: 'DATA <?php echo $shift->nama_shift ?>',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, 4],
                                            },
                                        },
                                        {
                                            extend: 'pdf',
                                            oriented: 'portrait',
                                            pageSize: 'legal',
                                            title: 'DATA <?php echo $shift->nama_shift ?>',
                                            download: 'open',
                                            exportOptions: {
                                                columns: [0, 2, 3, 4],
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
                                            title: 'DATA <?php echo $shift->nama_shift ?>',
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