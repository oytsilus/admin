<div class="">
<div class="row">
  <div class="col-md-12">
	<div class="x_panel">

	  <div class="x_content">

		<section class="content invoice">
		  <!-- title row -->
		  <div class="row">
			<div class="col-xs-12 invoice-header">
			  <h1>
				  Laporan Laba Rugi
				  <small class="pull-right">Periode: <?php echo $str_tgl_from;?> s/d <?php echo $str_tgl_to;?></small>
			  </h1>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- info row -->
		  <div class="row invoice-info">
			<div class="col-sm-12 invoice-col div-kiri-print">
				<?php if($mc_id != 0) { ?>
				Customer :
			  <address>
					<strong><?php echo $mc_name;?></strong>
				  <br><?php echo $mc_address;?>
				  <br>Telp : <?php echo $mc_phone1;?>
				  <br>Fax : <?php echo $mc_fax;?>
				  <br>Email : <?php echo $mc_email;?>
			  </address>
				<?php }	?>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->

		  <!-- Table row -->
		  <div class="row">
			<div class="col-xs-12 table table-responsive">
			  <table class="table table-striped table-bordered">
				<thead>
				  <tr>
					<th class="text-center">No</th>
					<?php if($mc_id == 0) { ?>
					<th class="text-center">Customer</th>
					<?php } ?>
					<th class="text-center">Order No</th>
					<th class="text-center">Nama Item</th>
					<th class="text-center">Penjualan</th>
					<th class="text-center">HPP</th>
					<th class="text-center">Laba-rugi</th>
				  </tr>
				</thead>
				<tbody>
				  <?php
					$no=1; $total_labarugi = 0;
					if($num_rows > 0) {
						foreach($result as $row) {
					?>
					<tr>
						<td><?php echo $no;?></td>
						<?php if($mc_id == 0) { ?>
						<td>
							<?php echo $row['mc_name']; ?>
						</td>
						<?php } ?>
						<td>
							<?php echo $row['to_no']; ?>
						</td>
						<td>
							<?php echo $row['mp_name']; ?>
						</td>
						<td class="text-right">
							<?php echo $this->no_format->idr_money(floatval($row['penjualan'])); ?>
						</td>
						<td class="text-right">
							<?php echo $this->no_format->idr_money(floatval($row['hpp'])); ?>
						</td>
						<td class="text-right">
							<?php echo $this->no_format->idr_money(floatval($row['margin'])); ?>
						</td>
					</tr>
					<?php $no++; $total_labarugi += $row['margin'];  } } ?>
				</tbody>
				<tfoot>
				  <tr>
					<th colspan="<?php echo ($mc_id != 0 ? 5 : 6);?>" class="text-right">TOTAL LABA-RUGI</th>
					<th class="text-right"><?php echo $this->no_format->idr_money(floatval($total_labarugi)); ?></th>
				  </tr>
				</tfoot>
			  </table>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->

		  <div class="row">
			<div class="col-sm-4 invoice-ttd">
			  <div class="ttd-header">Prepared by :</div>
			  <div class="ttd-footer"><?php echo $prepared_by;?></div>
			  <div class="ln_solid2"></div>
			</div>
		  </div>
		  <!-- /.row -->

		  <!-- this row will not appear when printing -->
		  <div class="row no-print">
			<div class="col-xs-12">
			  <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
			  <button class="btn btn-danger pull-right" onclick="window.close();"><i class="fa fa-credit-card"></i> Tutup</button>
			  <!--
			  <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
			  <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
			  -->
			</div>
		  </div>
		</section>
	  </div>
	</div>
  </div>
</div>
</div>
