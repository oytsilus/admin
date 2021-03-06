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
				  <i class="fa fa-globe"></i>Surat Jalan
				  <small class="pull-right">No Surat Jalan: <?php echo $td_no;?></small>
			  </h1>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- info row -->
		  <div class="row invoice-info">
			<div class="col-sm-4 invoice-col div-kiri-print">
			  Dari :
			  <address>
				  <strong><?php echo $company_name;?></strong>
				  <br><?php echo $company_address;?>
				  <br>Telp : <?php echo $company_phone;?>
				  <br>Fax : <?php echo $company_fax;?>
				  <br>Email : <?php echo $company_email;?>
			  </address>
			</div>
			<!-- /.col -->
			<div class="col-sm-4 invoice-col div-tengah-print">
			  Kepada :
			  <address>
				  <strong><?php echo $mc_name;?></strong>
				  <br>Up. : <?php echo $to_pic;?>
				  <br><?php echo $mc_address;?>
				  <br>Telp : <?php echo $mc_phone1;?>
				  <br>Fax : <?php echo $mc_fax;?>
				  <br>Email : <?php echo $mc_email;?>
			  </address>
			</div>
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
					<th class="text-right no-print">Qty Order</th>
					<th class="text-right">Qty Kirim</th>
					<th>Unit</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				if($num_rows > 0) {
				foreach($result as $row){
					$jml = intval($row['tod_qty']*$row['msp_price']);
					if(floatval($row['tod_qty']) != floatval($row['tdd_qty'])) {
						if(floatval($row['tdd_qty']) <= 0) {
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
					<td class="text-right col-lg-1 no-print"><?php echo $row['tod_qty'];?></td>
					<td class="text-right col-lg-1"><?php echo $row['tdd_qty'];?></td>
					<td><?php echo $row['mu_name'];?></td>
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
				<?php echo $td_desc;?>
			  </p>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		  
		  <div class="row">
			<div class="col-sm-8 invoice-ttd-left">
			  <div class="ttd-header-left">Supir :</div>
			  <div class="ttd-footer-left"><?php echo $td_driver_name;?></div>
			  <div class="ln_solid2"></div>
			</div>
			<div class="col-sm-4 invoice-ttd">
			  <div class="ttd-header">Hormat kami :</div>
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