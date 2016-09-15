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
				  Quantity Pengiriman Sayuran
				  <small class="pull-right">Periode: <?php echo $str_tgl_from;?> s/d <?php echo $str_tgl_to;?></small>
			  </h1>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- info row -->
		  <div class="row invoice-info">
			<div class="col-sm-12 invoice-col div-kiri-print">
			  Customer :
			  <address>
				  <strong><?php echo $mc_name;?></strong>
				  <br><?php echo $mc_address;?>
				  <br>Telp : <?php echo $mc_phone1;?>
				  <br>Fax : <?php echo $mc_fax;?>
				  <br>Email : <?php echo $mc_email;?>
			  </address>
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
					<th rowspan="3" class="text-center">No</th>
					<th rowspan="3" class="text-center">Nama Item</th>
					<th rowspan="3" class="text-center">Unit</th>
					<th colspan="<?php echo intval(count($arr_tr_ship_date)*2);?>" class="text-center">Tanggal Pengiriman</th>
				  </tr>
				  <tr>
					<?php
					if(count($arr_tr_ship_date) > 0) {
					foreach($arr_tr_ship_date as $row) {
						$exp = explode('|',$row);
					?>
					<th colspan="2" class="text-center"><?php echo $exp[1]?></th>
					<?php
					}
					}
					?>
				  </tr>
				  <tr>
					<?php
					if(count($arr_tr_ship_date) > 0) {
					foreach($arr_tr_ship_date as $row) {
						$exp = explode('|',$row);
					?>
					<th class="text-center">Qty</th>
					<th class="text-center">Total<br>Harga</th>
					<?php
					}
					}
					?>
				  </tr>
				</thead>
				<tbody>
				  <?php
					$x=0;
					$t_qty = array();
					$t_harga = array();
					$qty = 0;
					$harga = 0;
					if(count($arr_mp_name) > 0) {
					foreach($arr_mp_name as $mp){
						$exp = explode('|',$mp);
				  ?>
				  <tr>
					<td class="text-center"><?php echo $x+1;?></td>
					<td><?php echo $exp[0];?></td>
					<td class="text-center"><?php echo $exp[2];?></td>
					<?php
					$y=0;
					if(count($arr_tr_ship_date) > 0) {
					foreach($arr_tr_ship_date as $row) {
						$exp2 = explode('|',$row);
						$getDetail = get_qty_delivery($exp[1],$exp2[0],$mc_id);
						$qty = ($getDetail['qty'] == NULL ? '0' : round($getDetail['qty'],2));
						$harga = ($getDetail['price'] == NULL ? '0' : $getDetail['price']);
						
						$t_qty[$y][$x] = floatval($qty);
						$t_harga[$y][$x] = floatval($qty)*intval($harga);
					?>
					<!-- params : mp_id, date, mc_id -->
					<td class="text-right"><?php echo $qty;?></td>
					<td class="text-right"><?php echo $this->no_format->idr_money(floatval($qty*$harga));?></td>
					<?php
					$y++;
					}
					}
					?>
				  </tr>
				  <?php
					$x++;
					}
					}
				  ?>
				</tbody>
				<tfoot>
				  <tr>
					<th colspan="3" class="text-right">TOTAL</th>
					<?php
					$y2 = 0;
					if(count($arr_tr_ship_date) > 0) {
					foreach($arr_tr_ship_date as $row) {
						$exp = explode('|',$row);
					?>
					<th class="text-right"><?php echo floatval(array_sum($t_qty[$y2]));?></th>
					<th class="text-right"><?php echo $this->no_format->idr_money(intval(array_sum($t_harga[$y2])));?></th>
					<?php
					$y2++;
					}
					}
					?>
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