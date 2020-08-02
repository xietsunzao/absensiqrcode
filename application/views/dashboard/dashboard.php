<style>
    .donut2-legend>span {
        display: inline-block;
        margin-right: 30px;
        margin-bottom: 10px;
        font-size: 13px;
    }

    .donut2-legend>span:last-child {
        margin-right: 0;
    }

    .donut2-legend>span>i {
        display: inline-block;
        width: 15px;
        height: 15px;
        margin-right: 7px;
        margin-top: -3px;
        vertical-align: middle;
        border-radius: 1px;
    }

    .donut-legend>span {
        display: inline-block;
        margin-right: 30px;
        margin-bottom: 10px;
        font-size: 13px;
    }

    .donut-legend>span:last-child {
        margin-right: 0;
    }

    .donut-legend>span>i {
        display: inline-block;
        width: 15px;
        height: 15px;
        margin-right: 7px;
        margin-top: -3px;
        vertical-align: middle;
        border-radius: 1px;
    }

    .col {
        padding-top: 5px;
    }

    #donut2 {
        max-height: 280px;
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>
<section class='content'>
    <?php if ($this->ion_auth->is_admin()) : ?>
    <div class="row">
        <?php foreach ($info_box as $info) : ?>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-<?= $info->box ?>">
                <div class="inner">
                    <h3><?= $info->total; ?></h3>
                    <p><?= $info->title; ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-<?= $info->icon ?>"></i>
                </div>
                <a href="<?= base_url() . strtolower($info->title); ?>" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Total Karyawan Berdasarkan Penempatan</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="donut-chart" style="height: 250px; position: relative;"></div>
                    <br>
                    <div id="legend" class="donut2-legend"></div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Total Karyawan Berdasarkan Jabatan</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="donut-chart2" style="height: 240px; position: relative;"></div>
                    <br><br><br>
                    <div id="legend2" class="donut-legend"></div><br>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div>
        <script>
            // Menggunakan Morris.Bar
            $(document).ready(function() {
                var color_array1 = ['#03658C', '#63ad4a', '#F2594A', '#F28C4B', '#7E6F6A', '#36AFB2', '#9c6db2', '#d24a67', '#89a958', '#00739a', '#BDBDBD',
                    '#16404c', '#16404c', '#17c6c3'
                ];
                var donut2 = Morris.Donut({
                    element: 'donut-chart',
                    resize: true,

                    colors: color_array1,
                    data: [
                        <?php foreach ($get_plot as $row) :
                                ?> {
                            label: '<?php echo $row->nama_gedung ?>',
                            value: <?php echo $row->total_karyawan; ?>,
                        },
                        <?php endforeach; ?>
                    ],
                    hideHover: 'auto'
                });

                donut2.options.data.forEach(function(label, i) {
                    var legendItem = $('<div class="col"></div>').text(label['label'] + " ( " + label['value'] + " )").prepend('<i>&nbsp;</i>');
                    legendItem.find('i')
                        .css('backgroundColor', donut2.options.colors[i])
                        .css('width', '20px')
                        .css('display', 'inline-block')
                        .css('margin-left', '0px')
                        .css('padding-bottom', '5px');
                    $('#legend').append(legendItem)
                });

                var color_array2 = ['#03658C', '#7CA69E', '#F2594A', '#F28C4B', '#7E6F6A', '#36AFB2', '#9c6db2', '#d24a67', '#89a958', '#00739a', '#BDBDBD'];
                var donut = new Morris.Donut({
                    element: 'donut-chart2',
                    resize: true,
                    colors: color_array2,
                    data: [
                        <?php foreach ($get_plot2 as $row) :
                                ?> {
                            label: '<?php echo $row->nama_jabatan ?>',
                            value: <?php echo $row->total_karyawan; ?>,
                        },
                        <?php endforeach; ?>
                    ],
                    hideHover: 'auto'
                });

                donut.options.data.forEach(function(label, i) {
                    var legendItem = $('<span></span>').text(label['label'] + " ( " + label['value'] + " )").prepend('<i>&nbsp;</i>');
                    legendItem.find('i')
                        .css('backgroundColor', donut.options.colors[i])
                        .css('width', '20px')
                        .css('display', 'inline-block')
                        .css('margin-left', '0px');
                    $('#legend2').append(legendItem)
                });
            });
        </script>
    </div>
</section>

<?php else : ?>

<div class="col-md-12">
    <div class="box box-widget widget-user">
        <div class="widget-user-header bg-blue-active">
            <p style="text-align: center;">
                <span style="font-family: georgia, palatino; font-size: 15pt;">Selamat datang di  Sistem Absensi Karyawan.</span>
            </p>
            <h3 class="widget-user-username"></h3>
            <h5 class="widget-user-desc"></h5>
        </div>
        <div class="widget-user-image">
            <img class="img-circle" src="<?php echo base_url() ?>assets/dist/img/logo.jpg" alt="User Avatar">
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                    </div>
                </div>
                <div class="col-sm-4 border-right">
                 
                    <center>
                        <i>Sistem Absensi Karyawan berbasis QR CODE</i><br>
                        <br>Halaman ini terbuka dalam
                        <strong>{elapsed_time}</strong> detik.
                    </center>
                </div>
                <div class="col-sm-3">
                    <div class="description-block">
                        <h5 class="description-header"></h5>
                        <span class="description-text"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>