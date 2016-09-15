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
				  <i class="fa fa-globe"></i>Purchase Order
				  <small class="pull-right">No PO: <?php echo $tp_no;?></small>
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
				  <strong><?php echo $ms_name;?></strong>
				  <br>Up. : <?php echo $tp_pic;?>
				  <br><?php echo $ms_address;?>
				  <br>Telp : <?php echo $ms_phone1;?>
				  <br>Fax : <?php echo $ms_fax;?>
				  <br>Email : <?php echo $ms_email;?>
			  </address>
			</div>
			<!-- /.col -->
			<div class="col-sm-4 invoice-col div-kanan-print">
			  <b>Tanggal Order :</b> <?php echo $tp_date;?>
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
					<th class="text-right col-lg-1">Qty</th>
					<th class="text-right col-lg-1 jml-terima">Terima</th>
					<th>Unit</th>
					<th class="text-right">Harga Satuan</th>
					<th class="text-right">Tanggal Kirim</th>
					<th class="text-right">Jumlah</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				if($num_rows > 0) {
				foreach($result as $row){
					$jml = intval($row['tpd_qty']*$row['mbp_price']);
					if(floatval($row['tpd_qty']) != floatval($row['jml_terima'])) {
						if(floatval($row['jml_terima']) <= 0) {
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
					<td class="text-right"><?php echo $row['tpd_qty'];?></td>
					<td class="text-right jml-terima"><?php echo $row['jml_terima'];?></td>
					<td><?php echo $row['mu_name'];?></td>
					<td class="text-right"><?php echo $this->no_format->idr_money($row['mbp_price']);?></td>
					<td class="text-right"><?php echo ($row['tpd_delivery_date'] == NULL || $row['tpd_delivery_date'] == '0000-00-00' ? NULL : $this->tanggal->tgl_indo4($row['tpd_delivery_date']));?></td>
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
				<?php echo $tp_description;?>
			  </p>
			</div>
			<!-- /.col -->
			<div class="col-xs-6">
			  <p class="lead"></p>
			  <div class="table-responsive row-total">
				<table class="table">
				  <tbody>
					<tr>
					  <th style="width:50%">Subtotal</th>
					  <th style="width:5%">:</th>
					  <td class="text-right"><?php echo $tp_subtotal;?></td>
					</tr>
					<?php if($tp_disc > 0) {?>
					<tr>
					  <th>Discount (<?php echo $tp_disc;?>%)</th>
					  <th style="width:5%">:</th>
					  <td class="text-right"><?php echo $tp_disc_nominal;?></td>
					</tr>
					<?php }?>
					<tr>
					  <th>PPn (<?php echo $tp_ppn;?>%)</th>
					  <th style="width:5%">:</th>
					  <td class="text-right"><?php echo $tp_ppn_nominal;?></td>
					</tr>
					<tr>
					  <th>Total</th>
					  <th style="width:5%">:</th>
					  <td class="text-right"><?php echo $tp_total;?></td>
					</tr>
				  </tbody>
				</table>
			  </div>
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