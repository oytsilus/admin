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

			<form id="f_save_harga" method="post" action="<?php echo base_url('purchase_order/create');?>" class="form-horizontal form-label-left input_mask" novalidate>
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
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">No PO :</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<input type="text" id="po_no" name="po_no" class="form-control" value="<?php echo $po_no;?>" readonly="readonly">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Tanggal PO :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control datepicker" id="tgl" name="tgl" placeholder="Tanggal PO" aria-describedby="inputSuccess2Status" value="<?php echo $date_now;?>">
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Supplier :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<?php echo cb_supplier();?>
					</div>
				  </div>
				  
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="sup_address" class="col-md-4 col-sm-4 col-xs-12 control-label">Alamat Supplier :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<textarea id="sup_address" name="sup_address" class="form-control" rows="4" placeholder="Alamat Supplier"></textarea>
					</div>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="ship_address" class="col-md-4 col-sm-4 col-xs-12 control-label">Alamat Kirim :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<textarea id="ship_address" name="ship_address" class="form-control" rows="4" placeholder="Alamat Kirim"><?php echo $company_address;?></textarea>
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="up" class="col-md-4 col-sm-4 col-xs-12 control-label">u.p. :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<input type="text" id="up" name="up" class="form-control" value="" placeholder="u.p.">
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-12 col-sm-12 col-xs-12 has-feedback">
					<label for="note" class="col-md-2 col-sm-2 col-xs-12 control-label">Catatan :</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<textarea id="note" name="note" class="form-control" rows="4" placeholder="Catatan"></textarea>
					</div>
				  </div>
			  </div>
			  <div class="ln_solid"></div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="inv_no" class="col-md-4 col-sm-4 col-xs-12 control-label">No Invoice :</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<input type="text" id="inv_no" name="inv_no" class="form-control" placeholder="No Invoice">
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="inv_date" class="col-md-4 col-sm-4 col-xs-12 control-label">Tanggal Invoice :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control datepicker" id="inv_date" name="inv_date" placeholder="Tanggal Invoice" aria-describedby="inputSuccess2Status">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="inv_due_date" class="col-md-4 col-sm-4 col-xs-12 control-label">Jatuh Tempo Invoice :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control datepicker" id="inv_due_date" name="inv_due_date" placeholder="Tanggal Invoice" aria-describedby="inputSuccess2Status">
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
						<span id="subtotal_nominal" class="kanan">0</span>
						<input type="hidden" id="subtotal" name="subtotal">
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
						<input type="number" class="form-control col-md-8 col-md-xs-12 text-right" id="disc" name="disc" min="0" max="100" value="0">
						<label> </label>
					  </td>
					  <td class="jml text-left">
						<span class="kanan">
							<input type="text" class="form-control col-md-8 col-md-xs-12 text-right valid-number" id="disc_nominal" name="disc_nominal" value="0">
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
						<label id="ppn_str"><strong>PPN <?php echo $this->config->item('ppn_txt');?></strong></label>
						<input type="hidden" id="ppn" name="ppn" value="<?php echo $this->config->item('ppn');?>">
					  </td>
					  <td></td>
					  <td class="jml text-left ppn-row">
						<span>Rp.</span>
						<span class="kanan ppn-txt">0</span>
						<input type="hidden" id="ppn_nominal" name="ppn_nominal">
					  </td>
					  <td>
						<span style="float:right;">
							<input type="checkbox" id="is_ppn" name="is_ppn" checked="checked">
							<input type="hidden" id="h_is_ppn" name="h_is_ppn" value="PPN">
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
						<span id="total_nominal" class="kanan bold">0</span>
						<input type="hidden" id="total" name="total" value="0">
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
				  <button id="send" type="submit" class="btn btn-success" disabled="disabled">Simpan</button>
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

<?php if($this->session->flashdata('next_page')) {?>
<script>
window.open('<?php echo $this->session->flashdata('next_page');?>','_blank');
</script>
<?php } ?>