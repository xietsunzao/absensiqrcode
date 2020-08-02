<style>
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
                <div class='box-header with-border'>
                    <?php $jabatan = $this->Jabatan_model->get_by_id($segment = $this->uri->segment(3)); ?>
                    <h4 class='box-title'>TABEL DATA <?php echo $jabatan->nama_jabatan ?></h3><br>
                </div><!-- /.box-header -->
                <div class='box-body'>
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
                                <th>Kode Karyawan</th>
                                <th>Nama Karyawan</th>
                                <th>Shift</th>
                                <th>Lokasi</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($jabatan_data as $jabatan) { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $jabatan->id_karyawan ?></td>
                                <td><?php echo $jabatan->nama_karyawan ?></td>
                                <td><?php echo $jabatan->nama_shift ?></td>
                                <td><?php echo $jabatan->nama_gedung ?></td>
                                <td><?php echo $jabatan->alamat ?></td>
                            </tr> <?php }  ?>
                        </tbody>
                        <tr>
                            <td colspan="6" style="text-align:center;"><?php echo anchor('jabatan', 'Kembali', array('class' => 'btn btn-indigo btn-lg btn3d')); ?></td>
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
                                                columns: [0, 1, 2, 3],
                                            },
                                        },
                                        {
                                            extend: 'excel',
                                            title: 'DATA <?php echo $jabatan->nama_jabatan ?>',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3],
                                            },
                                        },
                                        {
                                            extend: 'copy',
                                            title: 'DATA <?php echo $jabatan->nama_jabatan ?>',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3],
                                            },
                                        },
                                        {
                                            extend: 'pdf',
                                            oriented: 'portrait',
                                            pageSize: 'A4',
                                            title: 'DATA <?php echo $jabatan->nama_jabatan ?>',
                                            download: 'open',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, ],
                                            },
                                            customize: function(doc) {
                                                doc.content[1].table.widths = Array(doc.content[1].table.body[3].length + 1).join('*').split('');
                                                doc.styles.tableBodyEven.alignment = 'center';
                                                doc.styles.tableBodyOdd.alignment = 'center';
                                            },
                                        },
                                        {
                                            extend: 'print',
                                            oriented: 'portrait',
                                            pageSize: 'A4',
                                            title: 'DATA <?php echo $jabatan->nama_jabatan ?>',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3],
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