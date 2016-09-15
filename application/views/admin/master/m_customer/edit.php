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

			<form method="post" action="<?php echo base_url('m_customer/edit/'.$id);?>" class="form-horizontal form-label-left" novalidate>
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
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Customer <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Nama Customer" value="<?php echo $mc_name;?>" required="required" type="text">
				</div>
			  </div>
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kode Customer <span class="required">*</span>
				</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				  <input id="kode" class="form-control col-md-7 col-xs-12" name="kode" placeholder="Kode Customer" required="required" type="text" value="<?php echo $kode;?>">
				</div>
			  </div>
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Alamat
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <textarea id="address" name="address" class="form-control" placeholder="Alamat"><?php echo $mc_address;?></textarea>
				</div>
			  </div>
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Telepon 
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input id="phone" class="form-control col-md-7 col-xs-12" name="phone" placeholder="Telepon" value="<?php echo $mc_phone1;?>" type="tel">
				</div>
			  </div>
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="fax">Fax 
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input id="fax" class="form-control col-md-7 col-xs-12" name="fax" placeholder="Fax" value="<?php echo $mc_fax;?>" type="tel">
				</div>
			  </div>
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input id="email" class="form-control col-md-7 col-xs-12" name="email" placeholder="E-mail" value="<?php echo $mc_email;?>" type="email">
				</div>
			  </div>
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">PIC</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input id="pic" class="form-control col-md-7 col-xs-12" name="pic" placeholder="PIC" value="<?php echo $mc_pic;?>" type="text">
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
