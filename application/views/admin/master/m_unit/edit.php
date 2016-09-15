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

			<form method="post" action="<?php echo base_url('m_unit/edit/'.$id);?>" class="form-horizontal form-label-left" novalidate>
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
			  
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Unit <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Nama Item" value="<?php echo $mu_name;?>" required="required" type="text">
				</div>
			  </div>
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kode</span>
				</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				  <input id="kode" class="form-control col-md-7 col-xs-12" name="kode" placeholder="Kode Item" required="required" type="text" value="<?php echo $kode;?>">
				</div>
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
