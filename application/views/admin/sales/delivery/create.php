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

			<form id="f_save_harga" method="post" action="<?php echo base_url('delivery/create');?>" class="form-horizontal form-label-left input_mask" novalidate>
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
						<input type="text" id="po_no" name="po_no" class="form-control" value="<?php echo $doc_no;?>" readonly="readonly">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Tanggal :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control datepicker" id="tgl" name="tgl" placeholder="Tanggal SJ" aria-describedby="inputSuccess2Status" value="<?php echo $date_now;?>">
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Customer :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<?php echo cb_customer();?>
					</div>
				  </div>
				  
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="cus_address" class="col-md-4 col-sm-4 col-xs-12 control-label">Alamat Customer :</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<textarea id="cus_address" name="cus_address" class="form-control" rows="4" placeholder="Alamat Customer"></textarea>
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
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Supir :</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<input type="text" id="driver_name" name="driver_name" class="form-control" placeholder="Nama Supir" value="">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 has-feedback">
					<label for="tgl" class="col-md-4 col-sm-4 col-xs-12 control-label">Nopol Kendaraan :</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" id="car_no" name="car_no" class="form-control" placeholder="Nopol Kendaraan" value="">
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
				  </tbody>
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