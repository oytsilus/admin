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

			<form id="f_save_harga" method="post" action="<?php echo base_url('m_price/create');?>" class="form-horizontal form-label-left input_mask" novalidate>
			  <?php if($this->session->flashdata('msg')) {?>
			  <div class="form-group">
				<div class="col-md-6 col-md-offset-3">
				  <div style="border:1px solid green; padding:10px;">
					<p>
						<?php echo $this->session->flashdata('msg');?>
					</p>
				  </div>
				</div>
			  </div>
			  <?php }?>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="tgl" class="col-lg-4 control-label">No PO :</label>
					<div class="col-lg-5">
						<input type="text" id="po_no" name="po_no" class="form-control" value="<?php echo $po_no;?>" readonly="readonly">
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="tgl" class="col-lg-4 control-label">Tanggal PO :</label>
					<div class="col-lg-6">
						<input type="text" class="form-control has-feedback-left datepicker" id="tgl" name="tgl" placeholder="Tanggal PO" aria-describedby="inputSuccess2Status" value="<?php echo $date_now;?>">
						<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
						<span id="inputSuccess2Status" class="sr-only">(success)</span>
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="tgl" class="col-lg-4 control-label">Supplier :</label>
					<div class="col-lg-8">
						<?php echo cb_supplier();?>
					</div>
				  </div>
				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="tgl" class="col-lg-4 control-label">Jadwal Kirim :</label>
					<div class="col-lg-6">
						<input type="text" class="form-control has-feedback-left datepicker" id="tgl" name="tgl" placeholder="Tanggal PO" aria-describedby="inputSuccess2Status" value="<?php echo $date_now;?>">
						<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
						<span id="inputSuccess2Status" class="sr-only">(success)</span>
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="sup_address" class="col-lg-4 control-label">Alamat Supplier :</label>
					<div class="col-lg-8">
						<textarea id="sup_address" name="sup_address" class="form-control" rows="4" placeholder="Alamat Supplier"></textarea>
					</div>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="ship_address" class="col-lg-4 control-label">Alamat Kirim :</label>
					<div class="col-lg-8">
						<textarea id="ship_address" name="ship_address" class="form-control" rows="4" placeholder="Alamat Kirim"><?php echo $company_address;?></textarea>
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="up" class="col-lg-4 control-label">u.p. :</label>
					<div class="col-lg-8">
						<input type="text" id="up" name="up" class="form-control" value="" placeholder="u.p.">
					</div>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="tgl" class="col-lg-4 control-label"></label>
					<div class="col-lg-8">
						
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					<label for="note" class="col-lg-2 control-label">Catatan :</label>
					<div class="col-lg-10">
						<textarea id="note" name="note" class="form-control" rows="4" placeholder="Catatan"></textarea>
					</div>
				  </div>
			  </div>
			  <div class="form-group">
				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="tgl" class="col-lg-4 control-label"></label>
					<div class="col-lg-6">
						<button type="button" id="btn_add_item" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah Item</button>
					</div>
				  </div>

				  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					<label for="tgl" class="col-lg-4 control-label"></label>
					<div class="col-lg-8">
						
					</div>
				  </div>
			  </div>
			  <div class="ln_solid"></div>
			  <div id="create_detail" class="x_content">
				<!-- Dynamic content -->
			  </div>
			  <div class="form-group">
				<div class="col-md-6 col-md-offset-3">
				  <button type="reset" class="btn btn-primary">Batal</button>
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

<!-- Modals -->
<!-- The login modal. Don't display it initially -->
<!--
<form id="fAddSupplier" method="post" class="form-horizontal" action="<?php echo base_url('ajax/add_supplier');?>" style="display:none;">
    <div class="form-group">
        <label class="col-xs-3 control-label">Nama Supplier</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="name" name="name" required="required" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Kode Supplier</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" id="kode" name="kode" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-5 col-xs-offset-3">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>
</form>
-->