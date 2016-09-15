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

			<form id="f_update_harga" method="post" action="<?php echo base_url('order/edit/'.$id);?>" class="form-horizontal form-label-left input_mask" novalidate>
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
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">No Order :</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<input type="text" id="po_no" name="po_no" class="form-control" value="<?php echo $order_no;?>" readonly="readonly">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Tanggal Order :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control datepicker" id="tgl" name="tgl" placeholder="Tanggal PO" aria-describedby="inputSuccess2Status" value="<?php echo $to_date;?>">
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-8 col-sm-8 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-3 col-sm-3 col-xs-12 control-label">Customer :</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="input-group">
							<?php echo cb_customer($mc_id);?>
							<span class="input-group-btn">
								<button type="button" id="add_customer" class="btn btn-primary btn-custom">Tambah Customer</button>
							</span>
						</div>
					</div>
				  </div>
				  
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="cus_address" class="col-md-4 col-sm-4 col-xs-12 control-label">Alamat Customer :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<textarea id="cus_address" name="cus_address" class="form-control" rows="4" placeholder="Alamat Customer"><?php echo $mc_address;?></textarea>
					</div>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					
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
				  <div class="col-md-12 col-sm-12 col-xs-12 has-feedback">
					<label for="note" class="col-md-2 col-sm-2 col-xs-12 control-label">Catatan :</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<textarea id="note" name="note" class="form-control" rows="4" placeholder="Catatan"><?php echo $to_description;?></textarea>
					</div>
				  </div>
			  </div>
			  <div class="ln_solid"></div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="inv_no" class="col-md-4 col-sm-4 col-xs-12 control-label">No Invoice :</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<input type="text" id="inv_no" name="inv_no" class="form-control" placeholder="No Invoice" value="<?php echo $toi_no;?>" readonly="readonly">
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="inv_date" class="col-md-4 col-sm-4 col-xs-12 control-label">Tanggal Invoice :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control datepicker" id="inv_date" name="inv_date" placeholder="Tanggal Invoice" aria-describedby="inputSuccess2Status" value="<?php echo $toi_date;?>">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="inv_due_date" class="col-md-4 col-sm-4 col-xs-12 control-label">Jatuh Tempo Invoice :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control datepicker" id="inv_due_date" name="inv_due_date" placeholder="Jatuh Tempo Invoice" aria-describedby="inputSuccess2Status" value="<?php echo $toi_due_date;?>">
					</div>
				  </div>
			  </div>
			  
			  <div class="ln_solid"></div>
			  
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label"></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<button type="button" id="btn_add_item" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah Item</button>
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
					  <th>Nama Item</th>
					  <th>Kode Item</th>
					  <th width="10%">Qty</th>
					  <th>Unit</th>
					  <th width="11%">Harga</th>
					  <th width="12%">Jadwal Kirim</th>
					  <th width="14%">Jumlah</th>
					  <th width="8%">Opsi</th>
					</tr>
				  </thead>
				  <tbody id="create_detail">
					<?php 
					if($num_rows_detail > 0) {
					$no = 1;
					$subtotal = 0;
					foreach($result_detail as $row) {
						$params = $row['tod_id'].'|'.$row['mp_id'].'|'.$row['mp_code'].'|'.$row['mp_category'].'|'.$row['mp_name'].'|'.$row['mu_code'].'|'.$row['mu_name'].'|'.$row['msp_price'];
						
						$hide = (floatval($row['jml_terima']) >= floatval($row['tod_qty']) ? ' class="hidden"' : NULL);
						$d_date = explode('-',$row['td_delivery_date']);
						$ddate = ($row['td_delivery_date'] != '' ? $d_date[1].'/'.$d_date[2].'/'.$d_date[0] : NULL);
					?>
					<tr id="row_<?php echo $row['tod_id'];?>"<?php echo $hide;?>>
					  <td>
						<?php echo $row['mp_name'];?>
						<input type="hidden" id="h_params_<?php echo $row['tod_id'];?>" name="h_params[]" value="<?php echo $params;?>">
						<input type="hidden" class="h_mp_id" id="h_mp_id_<?php echo $row['tod_id'];?>" name="h_mp_id[]" value="<?php echo $row['mp_id'];?>">
						<input type="hidden" class="h_tod_id" id="h_tod_id_<?php echo $row['tod_id'];?>" name="h_tod_id[]" value="<?php echo $row['tod_id'];?>">
					  </td>
					  <td><?php echo $row['mp_code'];?></td>
					  <td class="text-right qty">
						<input type="number" class="form-control input-qty text-right" id="qty_<?php echo $row['tod_id'];?>" name="qty[]" value="<?php echo $row['tod_qty'];?>" data-id="<?php echo $row['tod_id'];?>" data-harga="<?php echo $row['msp_price'];?>" min="0">
					  </td>
					  <td><?php echo $row['mu_name'];?></td>
					  <td class="hbeli">
						<span>Rp.</span>
						<span class="kanan"><?php echo ($row['msp_price'] == 0 ? '0' : $this->no_format->idr_money($row['msp_price']));?></span>
					  </td>
					  <td class="text-right jkirim">
						<input type="text" class="form-control datepicker" id="jkirim_<?php echo $row['tod_id'];?>" name="jkirim[]" placeholder="Tgl Kirim" aria-describedby="inputSuccess2Status" value="<?php echo $ddate;?>">
					  </td>
					  <td class="jml">
						<span>Rp.</span>
						<span id="jml_nominal<?php echo $row['tod_id'];?>" class="kanan"><?php echo $this->no_format->idr_money($row['total_harga']);?></span>
					  </td>
					  <td>
						<a href="javascript:;" class="btn btn-danger btn-xs btn_delete" data-id="<?php echo $row['tod_id'];?>"><i class="fa fa-trash-o"></i> Hapus </a>
					  </td>
					</tr>
					<?php
					$no++;
					$subtotal += $row['total_harga'];
					} // endforeach
					}
					?>
				  </tbody>
				  <tfoot>
					<tr>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td>
						<label><strong>Subtotal</strong></label>
					  </td>
					  <td></td>
					  <td class="jml text-left">
						<span>Rp.</span>
						<span id="subtotal_nominal" class="kanan"><?php echo $this->no_format->idr_money($to_subtotal);?></span>
						<input type="hidden" id="subtotal" name="subtotal" value="<?php echo $to_subtotal;?>">
					  </td>
					  <td></td>
					</tr>
					<tr>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td>
						<label><strong>Discount (%)</strong></label>
					  </td>
					  <td>
						<input type="number" class="form-control col-md-8 col-md-xs-12 text-right" id="disc" name="disc" min="0" max="100" value="<?php echo $to_disc;?>">
						<label> </label>
					  </td>
					  <td class="jml text-left">
						<span class="kanan">
							<input type="text" class="form-control col-md-8 col-md-xs-12 text-right valid-number" id="disc_nominal" name="disc_nominal" value="<?php echo $to_disc_nominal;?>">
						</span>
					  </td>
					  <td></td>
					</tr>
					<tr>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td class="ppn-row">
						<label><strong>PPN <?php echo intval($to_ppn).'%';?></strong></label>
						<input type="hidden" id="ppn" name="ppn" value="<?php echo $to_ppn;?>">
					  </td>
					  <td></td>
					  <td class="jml text-left ppn-row">
						<span>Rp.</span>
						<span class="kanan ppn-txt"><?php echo $this->no_format->idr_money($to_ppn_nominal);?></span>
						<input type="hidden" id="ppn_nominal" name="ppn_nominal" value="<?php echo $to_ppn_nominal;?>">
					  </td>
					  <td>
						<span style="float:right;">
							<input type="checkbox" id="is_ppn" name="is_ppn"<?php echo (intval($to_ppn) > 0 ? ' checked="checked"' : NULL);?>>
							<input type="hidden" id="h_is_ppn" name="h_is_ppn" value="<?php echo (intval($to_ppn) > 0 ? 'PPN' : 'NON-PPN');?>">
						</span>
					  </td>
					</tr>
					<tr>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td>
						<label><strong>Total</strong></label>
					  </td>
					  <td></td>
					  <td class="jml text-left">
						<span><strong>Rp.</strong></span>
						<span id="total_nominal" class="kanan bold"><?php echo $this->no_format->idr_money($to_total);?></span>
						<input type="hidden" id="total" name="total" value="<?php echo $to_total;?>">
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

<script>
<?php if($this->session->flashdata('next_page')) {?>
window.open('<?php echo $this->session->flashdata('next_page');?>','_blank');
<?php } ?>

<?php if($this->session->flashdata('next_page2')) {?>
window.open('<?php echo $this->session->flashdata('next_page2');?>','_blank');
<?php } ?>
</script>