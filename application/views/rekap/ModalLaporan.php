<style>
    .modal {
        overflow: auto !important;
    }

    @media print {
        .tr {
            -webkit-print-color-adjust: exact !important;
        }
    }

    table,
    th,
    td,
    tr {
        text-align: center;
    }
</style>
<?php
$segment = $this->uri->segment(3);
$kar = $this->kar->get_by_id($segment);
$gedung = $this->gedung->get_by_id($segment);
$gedung = $this->gedung->get_by_id($segment = $this->uri->segment(3)); ?>

<div class="box" style='max-width:80.5%;margin-left:125px'>
    <div class="box-header with-border">
        <h3 class="box-title">Data Laporan Karyawan</h3>
        <div class="container">
            <div class="alert"></div>
            <div class="row clearfix">
                <div id='msg'></div>
                <div class="input-daterange">
                    <div class="col-md-3">
                        <input type="text" name="start" id="start" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="end" id="end" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
                </div>
            </div>
        </div>
        <button onclick="printDiv('print-area')" class='pull-right'><i class='fa fa-print'></i> Print</button>
    </div>
    <div class="box-body">
        <div class="modal-content" style="min-width: 1000px;">
            <div class="modal-header" style='text-align:center'>
                <div class='pull-right'> </div>
                <span id="print-area">
                    <table style='margin-left:130px;'>
                        <tr>
                            <td style='padding:50px'>
                                <img src="<?php echo base_url(); ?>assets/dist/img/logo.jpg" width='100px'></img>
                            </td>
                            <td> <br>
                                <p style='text-align: center;font-size:20px;'><b>
                                        <font size='5px'>DATA LAPORAN KARYAWAN</font>
                                    </b></p>
                            </td>
                        </tr>
                    </table>
                    <table style='text-align:left;font-weight:bold;margin-left:40px;'>
                        <tr>
                            <td width='200px' class='tr'>Lokasi</td>
                            <td>:&nbsp;</td>
                            <td class='tr'> <?php echo $gedung->nama_gedung; ?></td>
                            <td width='200px' rowspan='3'>&nbsp;</td>
                            <td width='200px' class='tr'>Periode</td>
                            <td>:&nbsp;</td>
                            <td class='tr'>
                                <?php
                                $start = $this->input->get('tgl');
                                $end = $this->input->get('tgl');
                                $data = $this->rekap->resultHadir2($segment, $start, $end);
                                $start = $this->input->get('start');
                                $st = date('Y-m-d', strtotime($start));
                                $t = explode('-', $st);
                                $bulan = $this->tanggal->bulan($t[1]);
                                echo $bulan . '&nbsp' . $t[0];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width='200px' class='tr'>Alamat </td>
                            <td class='tr'>:&nbsp;</td>
                            <td class='tr'><?php echo $gedung->alamat; ?> </td>
                            <td width='200px' class='tr'>Operator </td>
                            <td class='tr'>:&nbsp;</td>
                            <td class='tr'><?= $user->first_name ?></td>
                        </tr>
                    </table> <br><br><br>
                    <table style='text-align: center;margin-top:-20px;' border="2" cellspacing="0" width="100%">
                        <thead>
                            <tr style='background-color:#00ccff !important'>
                                <th width='50px' rowspan="2" align='top'>No</th>
                                <th width='200px' rowspan="2">NAMA</th>
                                <th width='150px' rowspan="2">JABATAN </th>
                                <th width='70px' rowspan="2">Total Kehadiran </th>
                                <th width='130px' colspan="3">Total Ketidakhadiran </th>
                            </tr>
                            <tr style='background-color:#00ccff !important'>
                                <th width='80px'>&nbsp; Sakit</th>
                                <th width='80px'>&nbsp; Ijin </th>
                                <th width='80px'>&nbsp; Alpha </th>
                            </tr>
                        </thead>
                        <?php
                        $no = 0;
                        $start = $this->input->get('tgl');
                        $end = $this->input->get('tgl');
                        foreach ($this->rekap->karyawan($segment) as $row) {
                            $no++;
                            $hadir = $this->rekap->totalHadir_bak($segment, $row->id_karyawan, $start, $end);
                            $sakit = $this->rekap->totalHadir2($segment, $row->id_karyawan, $start, $end);
                            $ijin = $this->rekap->totalHadir3($segment, $row->id_karyawan, $start, $end);
                            $alpha = $this->rekap->totalHadir4($segment, $row->id_karyawan, $start, $end);
                            echo "<tr>
                            <td>" . $no . "</td>
                            <td>" . $row->nama_karyawan . "</td>
                            <td>" . $row->nama_jabatan . "</td>
                            <td>" . $hadir . "</td>
                            <td>" . $sakit . "</td>
                            <td>" . $ijin . "</td>
                            <td>" . $alpha . "</td>
                            </tr>  ";
                        } ?>
                    </table>
            </div>
            <div class="modal-body" id="dataLaporan" style='margin-top:10px'></div>
            </span>
        </div><!-- /.modal-content -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary btn3d" data-dismiss="modal">Close</button>
        </div>
        <script src="<?php echo base_url() ?>assets/app/core/ModalLaporan.js" charset="utf-8"></script>
        <script src="<?php echo base_url() ?>assets/app/core/print.js" charset="utf-8"></script>
        <script type="text/javascript">
            function LoadDateL() {
                var start = $('#start').val();
                var end = $('#end').val();
                var url = "rekap/ajax_list_laporan/<?php echo $this->uri->segment(3); ?>/";
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        start: start,
                        end: end,
                    },
                    datatype: 'text',
                    success: function(data) {
                        $('#dataLap').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        </script>