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
				  <i class="fa fa-globe"></i>Detail Pembayaran
				  <small class="pull-right">Form No: <?php echo $tpi_no;?></small>
			  </h1>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- info row -->
		  <div class="row invoice-info">
			<div class="col-sm-6 invoice-col div-kiri-print">
			  Supplier :
			  <address>
				  <strong><?php echo $ms_name;?></strong>
				  <br><?php echo $ms_address;?>
				  <br>Telp : <?php echo $ms_phone1;?>
				  <br>Fax : <?php echo $ms_fax;?>
				  <br>Email : <?php echo $ms_email;?>
			  </address>
			</div>
			<!-- /.col -->
			<div class="col-sm-6 invoice-col div-kanan-print">
			  <b>Tanggal :</b> <?php echo $tpi_date;?>
			  <br>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->

		  <!-- Table row -->
		  <div class="row">
			<div class="col-xs-12 table">
			  <table class="table table-striped">
				<thead>
				  <tr>
					<th>No PO</th>
					<th>Tanggal</th>
					<th class="text-right">Total Tagihan</th>
					<th class="text-right">Total Dibayar</th>
					<th class="text-right">Sisa Tagihan</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				if($num_rows > 0) {
				foreach($result as $row){
					if(floatval($row['tp_outstanding']) > 0 ) {
						$class = ' class="danger"';
					}
					else {
						$class = NULL;
					}
				?>
				  <tr<?php echo $class;?>>
					<td><?php echo $row['tp_no'];?></td>
					<td><?php echo $this->tanggal->tgl_postgres($row['tp_date']);?></td>
					<td class="text-right col-lg-2"><?php echo $this->no_format->idr_money($row['tp_total']);?></td>
					<td class="text-right col-lg-2"><?php echo $this->no_format->idr_money($row['tpid_payment_amount']);?></td>
					<td class="text-right col-lg-2"><?php echo ($row['tp_outstanding'] > 0 ? $this->no_format->idr_money($row['tp_outstanding']) : '-');?></td>
				  </tr>
				<?php
				}
				}
				?>
				</tbody>
			  </table>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		  
		  <?php
		  if($tpi_desc != '') {
		  ?>
		  <div class="row">
			<!-- accepted payments column -->
			<div class="col-xs-6">
			  <p class="lead">Catatan:</p>
			  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
				<?php echo $tpi_desc;?>
			  </p>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		  <?php }?>
		  
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