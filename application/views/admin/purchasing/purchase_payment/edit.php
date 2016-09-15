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

			<form id="f_edit" method="post" action="<?php echo base_url('purchase_payment/edit/'.$id);?>" class="form-horizontal form-label-left input_mask" novalidate>
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
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Form PO :</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<input type="text" id="tpi_no" name="tpi_no" class="form-control" value="<?php echo $tpi_no;?>" readonly="readonly">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Tanggal :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control datepicker" id="tgl" name="tgl" placeholder="Tanggal PO" aria-describedby="inputSuccess2Status" value="<?php echo $tpi_date;?>">
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Supplier :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<input type="text" id="txt_supplier" name="txt_supplier" class="form-control" value="<?php echo $ms_name;?>" readonly="readonly">
						<input type="hidden" id="supplier" name="supplier" class="form-control" value="<?php echo $ms_id.'|'.$ms_code.'|'.$ms_name;?>" readonly="readonly">
					</div>
				  </div>
				  
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="sup_address" class="col-md-4 col-sm-4 col-xs-12 control-label">Alamat Supplier :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<textarea id="sup_address" name="sup_address" class="form-control" rows="4" placeholder="Alamat Supplier"><?php echo $ms_address;?></textarea>
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="payee" class="col-md-4 col-sm-4 col-xs-12 control-label">Dibayarkan Oleh :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<input type="text" id="payee" name="payee" class="form-control" value="<?php echo $tpi_payee;?>" placeholder="Dibayarkan Oleh">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-12 col-sm-12 col-xs-12 has-feedback">
					<label for="note" class="col-md-2 col-sm-2 col-xs-12 control-label">Catatan :</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<textarea id="note" name="note" class="form-control" rows="4" placeholder="Catatan"><?php echo $tpi_desc;?></textarea>
					</div>
				  </div>
			  </div>
			  <div class="form-group div-btn-popup">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label"></label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<button type="button" id="btn_choose_po" class="btn btn-primary"><i class="fa fa-file"></i> Pilih PO</button>
					</div>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 control-label"></label>
					<div class="col-md-8">
						
					</div>
				  </div>
			  </div>
			  
			  <div class="x_content">
				<table class="table" id="detail_harga">
				  <thead>
					<tr>
					  <th>PO No</th>
					  <th>Tanggal</th>
					  <th>Supplier</th>
					  <th class="text-right" width="11%">Total<br>Tagihan</th>
					  <!--<th class="text-right" width="11%">Total<br>Dibayar</th>
					  <th class="text-right" width="11%">Sisa<br>Tagihan</th>-->
					  <th class="text-right" width="15%">Dibayarkan</th>
					  <!--<th width="8%">Opsi</th>-->
					</tr>
				  </thead>
				  <tbody id="create_detail">
					<?php 
					if($num_rows > 0) {
					$no = 1;
					$total = 0;
					$total_bayar = 0;
					foreach($result as $row) {
						$params = $row['tp_id'].'|'.$row['tp_no'].'|'.$row['tp_outstanding'].'|'.$row['tp_deadline_payment'].'|'.$row['ms_id'].'|'.$row['ms_name'].'|'.$row['ms_code'].'|'.$row['tp_date'].'|'.$row['tp_total'];
						$total_bayar = intval($row['total_po']-$row['tp_total']);
					?>
					<tr id="row_<?php echo $row['tpid_id'];?>">
					  <td><?php echo $row['tp_no'];?></td>
					  <td>
						<?php echo $row['tp_date'];?>
						<input type="hidden" id="h_params_<?php echo $row['tpid_id'];?>" name="h_params[]" value="<?php echo $params;?>">
						<input type="hidden" class="h_po_id" id="po_id_<?php echo $row['tpid_id'];?>" name="h_po_id[]" value="<?php echo $row['tp_id'];?>">
						<input type="hidden" class="h_po_no" id="h_po_no_<?php echo $row['tpid_id'];?>" name="h_po_no[]" value="<?php echo $row['tp_no'];?>">
						<input type="hidden" class="h_tpid_id" id="h_tpid_id_<?php echo $row['tpid_id'];?>" name="h_tpid_id[]" value="<?php echo $row['tpid_id'];?>">
					  </td>
					  <td><?php echo $row['ms_name'];?></td>
					  <!--<td class="hbeli">
						<span>Rp.</span>
						<span class="kanan"><?php echo ($row['total_po'] == 0 ? '0' : $this->no_format->idr_money($row['total_po']));?></span>
					  </td>
					  <td class="hbeli">
						<span>Rp.</span>
						<span class="kanan"><?php echo ($total_bayar == 0 ? '0' : $this->no_format->idr_money($total_bayar));?></span>
					  </td>-->
					  <td class="hbeli">
						<span>Rp.</span>
						<span class="kanan"><?php echo ($row['tp_total'] == 0 ? '0' : $this->no_format->idr_money($row['tp_total']));?></span>
					  </td>
					  <td class="text-right dibayar">
						<input type="number" class="form-control input-dibayar text-right" id="dibayar_<?php echo $row['tpid_id'];?>" name="dibayar[]" value="<?php echo $row['tpid_payment_amount'];?>" data-id="<?php echo $row['tpid_id'];?>" data-hutang-bayar="<?php echo $row['tp_total'];?>" min="0" max="<?php echo $row['tp_total'];?>">
					  </td>
					  <!--<td>
						<a href="javascript:;" class="btn btn-danger btn-xs btn_delete" data-id="<?php echo $row['tpid_id'];?>"><i class="fa fa-trash-o"></i> Hapus </a>
					  </td>-->
					</tr>
					<?php
					$total += $row['tpid_payment_amount'];
					$no++;
					} // endforeach
					}
					?>
				  </tbody>
				  <tfoot>
					<tr>
					  <td></td>
					  <td></td>
					  <!--<td></td>
					  <td></td>-->
					  <td colspan="2" class="text-right">
						<label><strong>Total Pembayaran</strong></label>
					  </td>
					  <td class="jml text-left">
						<span>Rp.</span>
						<span id="total_nominal" class="kanan"><?php echo $this->no_format->idr_money($total);?></span>
						<input type="hidden" id="total" name="total" value="<?php echo $total;?>">
					  </td>
					  <td></td>
					</tr>
				  </tfoot>
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
			<h4 class="modal-title" id="myModalLabel">Pilih PO</h4>
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