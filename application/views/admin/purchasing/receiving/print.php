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
				  <i class="fa fa-globe"></i>Receive Item
				  <small class="pull-right">Form No: <?php echo $tr_no;?></small>
			  </h1>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- info row -->
		  <div class="row invoice-info">
			<div class="col-sm-6 invoice-col div-kiri-print">
			  Dari :
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
			  <b>Tanggal Terima :</b> <?php echo $tr_ship_date;?>
			  <br><b>No Surat Jalan :</b> <?php echo $tr_ship_no;?>
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
					<th>Nama Item</th>
					<th>Kode Item</th>
					<th class="text-right">Qty</th>
					<th class="text-right">Terima</th>
					<th>Unit</th>
					<th class="text-right">Harga Satuan</th>
					<th class="text-right">Jumlah</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				if($num_rows > 0) {
				foreach($result as $row){
					$jml = intval($row['tpd_qty']*$row['mbp_price']);
					if(floatval($row['tpd_qty']) != floatval($row['trd_qty'])) {
						if(floatval($row['trd_qty']) <= 0) {
							$class = ' class="danger"';
						}
						else $class = ' class="warning"';
					}
					else {
						$class = NULL;
					}
				?>
				  <tr<?php echo $class;?>>
					<td><?php echo $row['mp_name'];?></td>
					<td><?php echo $row['mp_code'];?></td>
					<td class="text-right col-lg-1"><?php echo $row['tpd_qty'];?></td>
					<td class="text-right col-lg-1"><?php echo $row['trd_qty'];?></td>
					<td><?php echo $row['mu_name'];?></td>
					<td class="text-right"><?php echo $this->no_format->idr_money($row['mbp_price']);?></td>
					<td class="text-right"><?php echo $this->no_format->idr_money($jml);?></td>
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

		  <div class="row">
			<!-- accepted payments column -->
			<div class="col-xs-6">
			  <p class="lead">Note:</p>
			  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
				<?php echo $tr_desc;?>
			  </p>
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