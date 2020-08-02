<div class="box box-widget">
    <?php
    $params['data'] = $id_karyawan;
    $params['level'] = 'H';
    $params['size'] = 4;
    $params['savename'] = FCPATH . "uploads/qr_image/" . $id_karyawan . 'code.png';
    $this->ciqrcode->generate($params);
    ?>

    <div id="print-area">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue">
                <div class="widget-user-image">
                    <img class="img-responsive" src="<?php echo base_url('uploads/qr_image/') . $id_karyawan . 'code.png'; ?>" />
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?php echo $id_karyawan ?></h3>
                <h5 class="widget-user-desc"><?php echo $nama_karyawan; ?></h5>
                <button onclick="printDiv('print-area')" class='pull-right'><i class='fa fa-print'></i> Print</button>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">NAMA JABATAN : <?php echo $nama_jabatan; ?> </a></li>
                    <li><a href="#">SHIFT : <?php echo $nama_shift; ?> </a></li>
                    <li><a href="#">PENEMPATAN : <?php echo $nama_gedung; ?> </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>