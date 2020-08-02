<!-- Main content -->
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

    .sfwal2-popup {
        font-family: inherit;
        font-size: 1.2rem;
    }

    div.dataTables_wrapper div.dataTables_length label {
        padding-top: 5px;
        font-weight: normal;
        text-align: left;
        white-space: nowrap;
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
                    <h3 class='box-title'>DATA KARYAWAN</h3>
                    <div class="pull-right">
                        <?php echo anchor(site_url('tambah_anggota'), ' <i class="fa fa-plus"></i> &nbsp;&nbsp; Tambah Baru', ' class="btn btn-unique btn-lg btn-create-data btn3d" hidden="true"'); ?>
                    </div>
                </div>
                <div class="box-body">
                    <div class="actionPart">
                        <div class="actionSelect">
                            <div class="col-md-3">
                                <select id="exportLink" class="form-control">
                                    <option>Pilih Metode Ekspor Data</option>
                                    <option id="csv">Ekspor menjadi CSV</option>
                                    <option id="print">Cetak Data</option>
                                    <option id="pdf">Ekspor menjadi PDF</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table id="mytable" class="table table-bordered table-hover display" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="all">No.</th>
                                <th class="all">Kode Karyawan.</th>
                                <th class="all">Nama Karywan</th>
                                <th class="desktop">Jabatan</th>
                                <th class="desktop">Shift</th>
                                <th class="desktop">action</th>
                            </tr>
                        </thead>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript">
    let base_url = '<?= base_url() ?>';
</script>
<script type="text/javascript">
    let checkLogin = '<?= $result ?>';
</script>
<script src="<?php echo base_url() ?>assets/app/datatables/karyawan.js" charset="utf-8"></script>