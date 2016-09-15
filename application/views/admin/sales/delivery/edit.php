<style>
#myModal .modal-dialog  {width:75%;}

.table > tbody > tr > td > span.kanan,
.table > tfoot > tr > td > span.kanan {
	float: right;
}
td {
	line-height: 0 !important;
}
.table > tfoot > tr > td > span.bold {
	font-weight: bold;
}

@media screen and (min-width: 768px) {
	#myModal .modal-dialog  {width:900px;}
	#myModal2 .modal-dialog  {width:900px;}
}
</style>
<!-- page content -->
  <div class="">

	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2><?php echo $page_title;?></h2>
			<ul class="nav navbar-right panel_toolbox">
			  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			  </li>
			  <li><a class="close-link"><i class="fa fa-close"></i></a>
			  </li>
			</ul>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">

			<form id="f_update_receiving" method="post" action="<?php echo base_url('delivery/edit/'.$id);?>" class="form-horizontal form-label-left input_mask" novalidate>
			  <?php if($this->session->flashdata('msg')) {?>
			  <div class="form-group">
				  <div class="col-md-12 col-sm-12 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-2 col-sm-2 col-xs-12 control-label"></label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<div style="border:1px solid green; padding:10px;">
					<p>
						<?php echo $this->session->flashdata('msg');?>
					</p>
				  </div>
					</div>
				  </div>
			  </div>
			  <?php }?>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">No Surat Jalan :</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<input type="text" id="po_no" name="po_no" class="form-control" value="<?php echo $td_no;?>" readonly="readonly">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Tanggal :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control datepicker" id="tgl" name="tgl" placeholder="Tanggal PO" aria-describedby="inputSuccess2Status" value="<?php echo $td_date;?>">
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Customer :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<input type="text" id="txt_customer" name="txt_customer" class="form-control" value="<?php echo $mc_name;?>" readonly="readonly">
						<input type="hidden" id="customer" name="customer" class="form-control" value="<?php echo $mc_id.'|'.$mc_code.'|'.$mc_name;?>" readonly="readonly">
					</div>
				  </div>
				  
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="sup_address" class="col-md-4 col-sm-4 col-xs-12 control-label">Alamat Customer :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<textarea id="cus_address" name="cus_address" class="form-control" rows="4" placeholder="Alamat Customer"><?php echo $mc_address;?></textarea>
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="up" class="col-md-4 col-sm-4 col-xs-12 control-label">u.p. :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<input type="text" id="up" name="up" class="form-control" value="<?php echo $to_pic;?>" placeholder="u.p.">
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Supir :</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<input type="text" id="driver_name" name="driver_name" class="form-control" placeholder="Nama Supir" value="<?php echo $td_driver_name;?>">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Nopol Kendaraan :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" id="car_no" name="car_no" class="form-control" placeholder="Nopol Kendaraan" value="<?php echo $td_car_no;?>">
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-12 col-sm-12 col-xs-12 has-feedback">
					<label for="note" class="col-md-2 col-sm-2 col-xs-12 control-label">Catatan :</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<textarea id="note" name="note" class="form-control" rows="4" placeholder="Catatan"><?php echo $td_desc;?></textarea>
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label"></label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<button type="button" id="btn_add_item" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah Item</button>
						<button type="button" id="btn_choose_order" class="btn btn-primary"><i class="fa fa-file"></i> Pilih Order</button>
					</div>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 control-label"></label>
					<div class="col-md-8">
						
					</div>
				  </div>
			  </div>
			  <div class="ln_solid"></div>
			  <div class="x_content">
				<table class="table" id="detail_harga">
				  <thead>
					<tr>
					  <th>Order No</th>
					  <th>Nama Item</th>
					  <th>Kode Item</th>
					  <th width="10%">Qty</th>
					  <th width="20%">Unit</th>
					  <th width="11%">Harga</th>
					  <th width="8%">Opsi</th>
					</tr>
				  </thead>
				  <tbody id="create_detail">
					<?php 
					if($num_rows > 0) {
					$no = 1;
					foreach($result as $row) {						
						$params = $row['tdd_id'].'|'.$row['mp_id'].'|'.$row['mp_code'].'|'.$row['mp_category'].'|'.$row['mp_name'].'|'.$row['mu_code'].'|'.$row['mu_name'].'|'.$row['to_id'].'|'.$row['to_no'].'|'.$row['tdd_qty'].'|'.$row['tod_id'].'|'.$row['msp_price'].'|'.$row['tod_qty'].'|'.$row['mbp_price'];
						
						$disabled = $title = NULL;
						$res = $this->md->is_other_delivered($row['to_id'],$row['mp_id'],$row['tdd_id']);
						$stat = ($res['num_rows'] > 0 ? 'FALSE' : 'TRUE');
						$class = ($stat == 'FALSE' ? ' class="warning"' : NULL);
						$title = ($stat == 'FALSE' ? ' title="Outstanding item : '.floatval($row['tod_qty']-$row['tdd_qty']).'"' : NULL);
					?>
					<tr id="row_<?php echo $row['tdd_id'];?>"<?php echo $class.$title;?>>
					  <td>
						<?php echo $row['to_no'];?>
						<input type="hidden" class="h_is_edit" id="h_is_edit_<?php echo $row['tdd_id'];?>" name="h_is_edit[]" value="<?php echo $stat;?>">
					  </td>
					  <td>
						<?php echo $row['mp_name'];?>
						<input type="hidden" id="h_params_<?php echo $row['tdd_id'];?>" name="h_params[]" value="<?php echo $params;?>">
						<input type="hidden" class="h_order_id" id="order_id_<?php echo $row['tdd_id'];?>" name="h_order_id[]" value="<?php echo $row['to_id'];?>">
						<input type="hidden" class="h_tdd_id" id="h_tdd_id_<?php echo $row['tdd_id'];?>" name="h_tdd_id[]" value="<?php echo $row['tdd_id'];?>">
					  </td>
					  <td><?php echo $row['mp_code'];?></td>
					  <td class="text-right qty">
						<input type="number" class="form-control input-qty text-right" id="qty_<?php echo $row['tdd_id'];?>" name="qty[]" value="<?php echo $row['tdd_qty'];?>" data-id="<?php echo $row['tdd_id'];?>" data-harga-beli="<?php echo $row['mbp_price'];?>" data-harga-jual="<?php echo $row['msp_price'];?>" min="0" max="<?php echo $row['tod_qty'];?>" data-tod-qty="<?php echo $row['tod_qty'];?>"<?php echo $disabled.$title;?>>
					  </td>
					  <td><?php echo $row['mu_name'];?></td>
					  <td class="hbeli">
						<span>Rp.</span>
						<span class="kanan"><?php echo ($row['msp_price'] == 0 ? '0' : $this->no_format->idr_money($row['msp_price']));?></span>
					  </td>
					  <td>
					  <!--
						<a href="javascript:;" class="btn btn-danger btn-xs btn_delete" data-id="<?php echo $row['trd_id'];?>"<?php echo $disabled.$title;?>><i class="fa fa-trash-o"></i> Hapus </a>-->
					  </td>
					</tr>
					<?php
					$no++;
					} // endforeach
					}
					?>
				  </tbody>
				</table>
			  </div>
			  <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-6 col-md-offset-3">
				  <button type="reset" class="btn btn-danger">Batal</button>
				  <button id="send" type="submit" class="btn btn-success">Simpan</button>
				</div>
			  </div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
  </div>
<!-- /page content -->

<!-- Modal -->
<form method="post" class="form-horizontal" id="modalForm">
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Pilih Item</h4>
		  </div>
		  <div class="modal-body" id="myModalBody">
			
		  </div>
		  
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			<button id="submit_modal" type="button" class="btn btn-success">Pilih</button>
			<input type="hidden" id="check_var">
		  </div>
		</div>
	  </div>
	</div>
</form>

<!-- Modal 2 -->
<form method="post" class="form-horizontal" id="modalForm2">
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Pilih Order</h4>
		  </div>
		  <div class="modal-body table-responsive" id="myModalBody2">
			
		  </div>
		  
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			<button id="submit_modal2" type="button" class="btn btn-success">Pilih</button>
			<input type="hidden" id="check_var2">
		  </div>
		</div>
	  </div>
	</div>
</form>

<?php if($this->session->flashdata('next_page')) {?>
<script>
window.open('<?php echo $this->session->flashdata('next_page');?>','_blank');
</script>
<?php } ?>