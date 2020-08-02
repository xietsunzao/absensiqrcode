
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>DATA KARYAWAN BERDASARKAN LOKASI
                </div><!-- /.box-header -->
                <div class='box-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="20px" style='text-align:center;'>No</th>
		    <th style='text-align:center;'>Nama Gedung</th>
		    <th style='text-align:center;'>Alamat</th>
		    <th width="15%" style='text-align:center;'>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($gedung_data as $gedung)
            {
                ?>
                <tr>
		    <td style='text-align:center;'><?php echo ++$start ?></td>
		    <td style='text-align:center;'><?php echo $gedung->nama_gedung ?></td>
		    <td style='text-align:center;'><?php echo $gedung->alamat ?></td>
		    <td style="text-align:center" width="40px">
			<?php
			echo anchor(site_url('lokasi1/read/'.$gedung->gedung_id),'<i class="fa fa-eye fa-lg"></i>&nbsp;&nbsp;Lihat',array('title'=>'detail','class'=>'btn btn-mdb-color '));

			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
