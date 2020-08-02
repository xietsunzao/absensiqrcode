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
<?php $gedung = $this->Gedung_model->get_by_id($segment = $this->uri->segment(3)); ?>
<!-- Main content -->
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>HISTORI ABSENSI <?php echo $gedung->nama_gedung ?></h3>
                    <div class="pull-right">
                        <?php echo anchor(site_url('presensi/create/' . $gedung->gedung_id), ' <i class="fa fa-plus"></i> &nbsp;&nbsp; Tambah Baru', ' class="btn btn-unique btn-lg btn-create-data btn3d"'); ?>
                    </div>
                </div>
                <div class="box-body">
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class="actionPart">
                        <div class="actionSelect">
                            <div class="col-md-3">
                                <select id="exportLink" class="form-control">
                                    <option>Pilih Metode Ekspor</option>
                                    <option id="csv">Ekspor sebagai CSV</option>
                                    <option id="print">Cetak Data</option>
                                    <option id="pdf">Ekspor sebagai PDF</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table id="presensi" class="table table-bordered table-hover display" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="all">No</th>
                                <th class="all">Nama</th>
                                <th class="all">Tanggal</th>
                                <th class="desktop">Jam Masuk</th>
                                <th class="desktop">Jam Keluar</th>
                                <th class="desktop">Kehadiran</th>
                                <th class="desktop">Keterangan</th>
                                <th class="desktop">status </th>
                                <th class="desktop">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tr>
                            <td colspan="10"><?php echo anchor('presensi', 'Kembali', array('class' => 'btn btn-indigo btn-lg btn3d')); ?></td>
                        </tr>
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
    let segment = '<?= $this->uri->segment(3) ?>';
    <?php $gedung = $this->Gedung_model->get_by_id($segment = $this->uri->segment(3)); ?>
    let gedung = '<?= $gedung->nama_gedung ?>'
</script>
<script type="text/javascript">
    let checkLogin = '<?= $result ?>';
</script>
<script src="<?php echo base_url() ?>assets/app/datatables/presensi.js" charset="utf-8"></script>
<script>
    $(document).ready(function() {
        if (checkLogin == 0) {
            $('.btn-create-data').hide();
        }
    });
</script>