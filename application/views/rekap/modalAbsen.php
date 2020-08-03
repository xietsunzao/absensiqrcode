<style>
    .modal {
        overflow: auto !important;

    }

    .modal-dialog {
        overflow-y: initial !important
    }

    .modal-body {
        height: 400px;
        overflow-y: auto;
    }

    ;

    @media print {
        .tr {
            -webkit-print-color-adjust: exact !important;
        }
    }

    .vertical-alignment-helper {
        display: table;
        height: 100%;
        width: 100%;
        pointer-events: none;
        /* This makes sure that we can still click outside of the modal to close it */
    }

    .vertical-align-center {
        /* To center vertically */
        display: table-cell;
        vertical-align: middle;
        pointer-events: none;
    }

    .modal-content {
        /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
        width: inherit;
        max-width: max-content;
        /* For Bootstrap 4 - to avoid the modal window stretching full width */
        height: inherit;
        /* To center horizontally */
        margin: 0 auto;
        pointer-events: all;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css">

<div class="box" style='max-width:1200px;margin-left:90px;'>
    <div class="box-header with-border">
        <h3 class="box-title">Data Absensi Karyawan </h3>
        <button type="button" class="btn btn-danger btn3d pull-right" data-dismiss="modal"><i class='fa fa-close'></i>Close</button>
        <button onclick="printDiv('print-area')" target="_blank" class='pull-right btn btn-success btn3d'><i class='fa fa-print'></i> Print</button>
        <div class="container">
            <div class="alert"></div>
            <div class="row clearfix">
                <div id='msg'></div>
                <div class="input-daterange">
                    <div class="col-md-3">
                        <label>tanggal awal</label>
                        <input type="text" name="start" id="start" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label>tanggal akhir</label>
                        <input type="text" name="end" id="end" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label>Shift</label>
                        <?php echo cmb_dinamis9('id_shift', 'id_shift', 'shift', 'nama_shift', 'id_shift') ?>
                    </div>
                </div>
                <div class="col-md-3"><br>
                    <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="modal-content">
            <span id="print-area">
                <div class="modal-body form" id="absen">
                    <table style='margin-left:70px;'>
                        <tr>
                            <td style='padding:50px'>
                                <img src="<?php echo base_url(); ?>assets/dist/img/logo.jpg" width='100px'></img>
                            </td>
                            <td> <br>
                                <p style='font-size:20px;text-align:center;'><b>
                                        <font size='5px'>REKAP ABSENSI Karyawan <?php echo $gedung->nama_gedung; ?></font>
                                    </b></p>

                                <?php
                                if ($id_shift > 0) : ?>
                                    <p style='margin-top:-10px;text-align:center;'>
                                        <font size='4px'> <?php
                                                            $regu = array(1 => 'UNIT : NON SHIFT', 2 => 'UNIT :  I', 3 => "UNIT : II", 4 => "UNIT :III");
                                                            if (isset($regu[$id_shift])) {
                                                                echo $regu[$id_shift];
                                                            } else {
                                                                return false;
                                                            }
                                                            ?></font>
                                    </p>
                                <?php else : ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <table width="100%" style='text-align:left;font-weight:bold;margin-left:40px;'>
                        <tr>
                            <td width='100px' class='tr'>PERIODE</td>
                            <td>:&nbsp;</td>
                            <td class='tr'>
                                <?php
                                echo $periode;
                                ?>
                            </td>
                            <td width='250px' rowspan='3'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td width='100px' class='tr'>ALAMAT </td>
                            <td class='tr'>:&nbsp;</td>
                            <td class='tr'><?php echo $gedung->alamat; ?> </td>
                            <td width='200px' class='tr'>PARAF </td>
                            <td class='tr'>:&nbsp;</td>
                            <td class='tr'>______________________</td>
                        </tr>
                    </table> <br>
                    <table border="2" width="100%" style='text-align:center;font-weight:bold;margin-left:-10px;'>
                        <thead>
                            <tr style='background-color:#429ef4 !important'>
                                <th width='50px' rowspan='4' style='text-align:center;'>No</th>
                                <th width='200px' rowspan='4' style='text-align:center;'>NAMA</th>
                                <th scope="col" width='100px' rowspan='4' style='text-align:center;'>JABATAN</th>
                                <th colspan="<?php echo $colspan; ?>">
                                    <center>HARI/TANGGAL</center>
                                </th>
                                <th rowspan='3' style='text-align:center;width:60px;'>Total</th>
                            </tr>
                            <tr style='background-color:#42f445 !important'>
                                <?php
                                $resultHadir = $this->rekap->resultHadir2($segment, $start, $end);
                                foreach ($resultHadir as $data) {
                                    $days = $this->tanggal->namaHari($data->tgl);
                                    if ($days == "M") {
                                        echo "<th class='sunday' style='text-align:center;color:red !important;width:30px;'>" . ($days) . "</th>";
                                    } else {
                                        echo "<th  style='text-align:center;width:40px;'>" . ($days) . "</th>";
                                    }
                                } ?>
                            </tr>
                            <tr style='background-color:#42f445 !important'>
                                <?php
                                $resultHadir = $this->rekap->resultHadir2($segment, $start, $end);
                                foreach ($resultHadir as $data) {
                                    echo "<th style='text-align:center;width:40px;'>" . ($this->tanggal->ind($data->tgl, "-")) . "</th>";
                                } ?>
                            </tr>
                        </thead>
                        <?php
                        $no = 0;
                        $start = $this->input->get('tgl');
                        $end = $this->input->get('tgl');
                        $id_shift = $this->input->get('id_shift');
                        if ($id_shift > 0) {
                            foreach ($this->rekap->karyawan_bak3($segment, $start, $end, $id_shift) as $row) {
                                $no++;
                                echo
                                    "<tr>
                            <td>" . $no . "</td>
                            <td>" . $row->nama_karyawan . "</td>";
                                if ($row->jabatan == 1  || $row->jabatan == 2) {
                                    echo "<td style='color:red !important;width:30px;'>$row->nama_jabatan</td>";
                                } else {
                                    echo "<td>$row->nama_jabatan</td>";
                                }
                                if (count($resultHadir)) {
                                    foreach ($resultHadir as $datax) {
                                        $date_of_post = $datax->tgl;
                                        $id_khd = $datax->id_khd;
                                        $id = $row->id_karyawan;
                                        $date = $date_of_post;
                                        $date = date('Ymd', strtotime($date));
                                        $stamp  = $date;
                                        $ceki = $this->rekap->_cek($datax->tgl, $row->id_karyawan);
                                        $ceki2 = $this->rekap->_cek2($datax->tgl, $row->id_karyawan);
                                        $ceki3 = $this->rekap->_cek3($datax->tgl, $row->id_karyawan);
                                        $ceki4 = $this->rekap->_cek4($datax->tgl, $row->id_karyawan);
                                        $ceki5 = $this->rekap->_cek5($datax->tgl, $row->id_karyawan);
                                        $gedung = $this->gedung->get_by_id($segment = $this->uri->segment(3));
                                        $seg = $gedung->gedung_id;
                                        if ($ceki) {
                                            $datax->adkhd = 'onclick="add_kd(' . $stamp . ')"';
                                            $ceklist = "<i class='fa fa-check'></i>";
                                        } else if ($ceki2) { {
                                                $datax->adkhd = 'onclick="add_khd(' . "'" . $stamp . "','" . $row->id_karyawan . "','" . $seg . "'" . ')"';
                                                $ceklist = "<b>S</b>";
                                            };
                                        } else if ($ceki3) { {
                                                $datax->adkhd = 'onclick="add_khd(' . "'" . $stamp . "','" . $row->id_karyawan . "','" . $seg . "'" . ')"';
                                                $ceklist = "<b>I</b>";
                                            };
                                        } else if ($ceki4) { {
                                                $datax->adkhd = 'onclick="add_khd(' . "'" . $stamp . "','" . $row->id_karyawan . "','" . $seg . "'" . ')"';
                                                $ceklist = "<b>A</b>";
                                            };
                                        } else if ($ceki5) { {
                                                $datax->adkhd = 'onclick="add_khd(' . "'" . $stamp . "','" . $row->id_karyawan . "','" . $seg . "'" . ')"';
                                                $ceklist = "<b>O</b>";
                                            };
                                        } else if (!$ceki) {
                                            $datax->adkhd = 'onclick="add_khd(' . "'" . $stamp . "','" . $row->id_karyawan . "','" . $seg . "'" . ')"';
                                            $ceklist = "<a href='#'><i>-</i></a>";
                                        };
                                        if (!$ceki) {
                                            echo "<td style='cursor:pointer' $datax->adkhd>" . $ceklist . "</td>";
                                        } else if ($ceki5) {
                                            echo "<td style='background-color:red'></td>";
                                        } else {
                                            echo "<td>" . $ceklist . "</td>";
                                        }
                                    }
                                } else {
                                    echo "<td>&nbsp;</td>";
                                };
                                echo "<td>" . $this->rekap->totalHadir_bak($segment, $row->id_karyawan, $start, $end) . "&nbsp;</td></tr>";
                            }
                        } else {
                            foreach ($this->rekap->karyawan_bak2($segment, $start, $end) as $row) {
                                $no++;
                                echo "<tr>
                                <td>" . $no . "</td>
                                <td>" . $row->nama_karyawan . "</td>";
                                if ($row->jabatan == 1  || $row->jabatan == 2) {
                                    echo "<td style='color:red !important;width:30px;'>$row->nama_jabatan</td>";
                                } else {
                                    echo "<td>$row->nama_jabatan</td>";
                                }
                                if (count($resultHadir)) {
                                    foreach ($resultHadir as $datax) {
                                        $date_of_post = $datax->tgl;
                                        $id_khd = $datax->id_khd;
                                        $id = $row->id_karyawan;
                                        $date = $date_of_post;
                                        $date = date('Ymd', strtotime($date));
                                        $stamp  = $date;
                                        $ceki = $this->rekap->_cek($datax->tgl, $row->id_karyawan);
                                        $ceki2 = $this->rekap->_cek2($datax->tgl, $row->id_karyawan);
                                        $ceki3 = $this->rekap->_cek3($datax->tgl, $row->id_karyawan);
                                        $ceki4 = $this->rekap->_cek4($datax->tgl, $row->id_karyawan);
                                        $ceki5 = $this->rekap->_cek5($datax->tgl, $row->id_karyawan);
                                        $gedung = $this->gedung->get_by_id($segment = $this->uri->segment(3));
                                        $seg = $gedung->gedung_id;
                                        if ($ceki) {
                                            $datax->adkhd = 'onclick="add_kd(' . $stamp . ')"';
                                            $ceklist = "<i class='fa fa-check'></i>";
                                        } else if ($ceki2) { {
                                                $datax->adkhd = 'onclick="add_khd(' . "'" . $stamp . "','" . $row->id_karyawan . "','" . $seg . "'" . ')"';
                                                $ceklist = "<b>S</b>";
                                            };
                                        } else if ($ceki3) { {
                                                $datax->adkhd = 'onclick="add_khd(' . "'" . $stamp . "','" . $row->id_karyawan . "','" . $seg . "'" . ')"';
                                                $ceklist = "<b>I</b>";
                                            };
                                        } else if ($ceki4) { {
                                                $datax->adkhd = 'onclick="add_khd(' . "'" . $stamp . "','" . $row->id_karyawan . "','" . $seg . "'" . ')"';
                                                $ceklist = "<b>A</b>";
                                            };
                                        } else if ($ceki5) { {
                                                $datax->adkhd = 'onclick="add_khd(' . "'" . $stamp . "','" . $row->id_karyawan . "','" . $seg . "'" . ')"';
                                                $ceklist = "<b>O</b>";
                                            };
                                        } else if (!$ceki) {
                                            $datax->adkhd = 'onclick="add_khd(' . "'" . $stamp . "','" . $row->id_karyawan . "','" . $seg . "'" . ')"';
                                            $ceklist = "<a href='#'><i>-</i></a>";
                                        };
                                        if (!$ceki) {
                                            echo "<td style='cursor:pointer' $datax->adkhd>" . $ceklist . "</td>";
                                        } else if ($ceki5) {
                                            echo "<td style='background-color:red'></td>";
                                        } else {
                                            echo "<td>" . $ceklist . "</td>";
                                        }
                                    }
                                } else {
                                    echo "<td>&nbsp;</td>";
                                };
                                echo "<td>" . $this->rekap->totalHadir_bak($segment, $row->id_karyawan, $start, $end) . "&nbsp;</td></tr>";
                            }
                        } ?>
                    </table>
                </div>
                &nbsp;&nbsp;&nbsp;<b style="padding-left : 30px">KETERANGAN :</b>&nbsp;&nbsp;&nbsp;
                <b style="padding-left : 30px"><i class="fa fa-check"></i> = HADIR</b>&nbsp;&nbsp;&nbsp;
                <b style="padding-left : 30px">S = SAKIT</b>&nbsp;&nbsp;&nbsp;
                <b style="padding-left : 30px">I = IJIN</b>&nbsp;&nbsp;&nbsp;
                <b style="padding-left : 30px">A = TANPA KETERANGAN</b>&nbsp;&nbsp;&nbsp;
                <b style="padding-left : 30px">O = OFF/LEPAS</b>&nbsp;&nbsp;&nbsp;
        </div>

    </div>
    </span>
</div>
<div class="modal fade" id="sep" role="dialog">
    <div class="modal-dialog" style="width:300px">
        <div class="modal-content" style="width:300px">
            <div class="modal-header">
                <button type="button" class="close" onclick="tutup()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">KEHADIRAN</h3>
            </div>
            <div class="modal-body form" style="height:300px;">
                <form action="#" id="form">
                    <input type="hidden" value="" id="id" />
                    <input type="hidden" value="" id="id3" />
                    <div class="form-group">
                        <!-- <label class="control-label col-md-3">NIK</label> -->
                        <div class="col-md-10">
                            <input type="hidden" name="kar" value="" class="form-control" id="id_karyawan" type="text" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Kehadiran</label>
                        <div class="col-md-10">
                            <?php echo cmb_dinamis2('id_khd', 'id_khd', 'kehadiran', 'nama_khd', 'id_khd', $id_khd) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Ketererangan</label>
                        <div class="col-md-10">
                            <input name="ket" value="" class="form-control" id="ket" type="text" />
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-md-10">
                            <button type="button" class="full-left btn" onclick="tutup()">Cancel</button>
                            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- /.modal -->
<script src="<?php echo base_url() ?>assets/app/core/modalAbsen.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/app/core/print.js" charset="utf-8"></script>

<script type="text/javascript">
    function LoadDate(id) {
        var start = $('#start').val();
        var end = $('#end').val();
        var id_shift = $('#id_shift').val();
        var url = "rekap/ajax_list_modal2/<?php echo $this->uri->segment(3); ?>/";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                start: start,
                end: end,
                id_shift: id_shift,
            },
            datatype: 'text',
            success: function(data) {
                $('#datakar').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }
</script>