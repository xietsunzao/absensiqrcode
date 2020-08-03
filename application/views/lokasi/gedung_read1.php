
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <?php   $gedung=$this->Gedung_model->get_by_id($segment=$this->uri->segment(3));?>
                  <h3 class='box-title'>DETAIL <?php echo $gedung->nama_gedung ?></h3><br>
                    <h4 class='box-title'><?php echo $gedung->alamat ?></h3><br>
                </div><!-- /.box-header -->
                <div class='box-body'>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="20px" style='text-align:center;'>No</th>
                  <th style='text-align:center;'>NIK</th>
                  <th style='text-align:center;'>Nama</th>
		              <th style='text-align:center;'>Jabatan</th>
		              <th style='text-align:center;'>Shift</th>
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
        <td style='text-align:center;'><?php echo $gedung->id_karyawan ?></td>
		    <td style='text-align:center;'><?php echo $gedung->nama_karyawan ?></td>
		    <td style='text-align:center;'><?php echo $gedung->nama_jabatan ?></td>
		    <td style='text-align:center;'><?php echo $gedung->nama_shift ?></td>


	        </tr>
                <?php
            }
            ?>
            </tbody>
            <tr><td colspan="5" style="text-align:center;"><?php echo anchor('lokasi1','Kembali',array('class'=>'btn btn-indigo btn-lg'));?></td></tr>
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
