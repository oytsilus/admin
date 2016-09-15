<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>DOM-PDF CODEIGNITER 3</title>
	<!-- Bootstrap -->
    <link href="<?php echo base_url('assets');?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets');?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets');?>/build/css/custom.css" rel="stylesheet">
</head>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->	
        <div class="left_col" role="main">
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
									<th class="text-right">Qty</th>
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
								?>
								  <tr>
									<td><?php echo $row['mp_name'];?></td>
									<td><?php echo $row['mp_code'];?></td>
									<td class="text-right"><?php echo $row['tpd_qty'];?></td>
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
						</section>
					  </div>
					</div>
				  </div>
				</div>
				</div>
        </div>
        <!-- /page content -->
      </div>
    </div>
  </body>
</html>