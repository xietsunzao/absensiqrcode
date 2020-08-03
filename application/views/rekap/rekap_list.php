<style>
    table,
    th,
    td {
        text-align: center;
    }
</style>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>REKAP ABSENSI</h3>
                </div>
                <div class="box-body">
                    <table id="mytable" class="table table-bordered table-hover display" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Lokasi</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="modal fade" id="modalAbsen" role="dialog" style="min-width: 100%;margin-left:10px">
                        <div class="modal-dialog" style="min-width: 100%;">
                            <div id="datakar"> </div>
                        </div><!-- /.modal-dialog -->
                    </div>
                </div><!-- /.modal -->
                <div class="modal fade" id="ModalLaporan" role="dialog" style="min-width: 100%;margin-left:10px">
                    <div class="modal-dialog" style="min-width: 100%;">
                        <div id="dataLap"></div>
                    </div><!-- /.modal-dialog -->
                </div>
            </div><!-- /.modal -->
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->
<script src="<?php echo base_url() ?>assets/app/core/rekaplist.js"></script>
<script src="<?php echo base_url() ?>assets/app/core/modalAbsen.js"></script>
