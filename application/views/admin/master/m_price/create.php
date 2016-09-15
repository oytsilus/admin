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

			<form id="f_save_harga" method="post" action="<?php echo base_url('m_price/create');?>" class="form-horizontal form-label-left" novalidate>
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
			  <div class="item form-group control-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Berlaku <span class="required">*</span>
				</label>
				<div class="controls">
				  <div class="col-md-3 xdisplay_inputx form-group has-feedback">
					<input type="text" class="form-control has-feedback-left" id="tgl_berlaku" name="tgl_berlaku" placeholder="Tanggal Berlaku" aria-describedby="inputSuccess2Status" value="<?php echo $date_now;?>">
					<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
					<span id="inputSuccess2Status" class="sr-only">(success)</span>
				  </div>
				</div>
			  </div>
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Supplier <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <div class="input-group">
					<?php echo cb_supplier();?>
					<span class="input-group-btn">
						<button type="button" id="add_supplier" class="btn btn-primary btn-custom">Tambah Supplier</button>
					</span>
				  </div>
				</div>
			  </div>
			  <div class="ln_solid"></div>
			  <div id="create_detail" class="x_content">
				<!-- Dynamic content -->
			  </div>
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