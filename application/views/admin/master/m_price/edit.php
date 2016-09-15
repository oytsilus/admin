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

			<form method="post" action="<?php echo base_url('m_price/edit/'.$id.'/'.$sup_id);?>" class="form-horizontal form-label-left" novalidate>
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
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Item
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Nama Item" value="<?php echo $mp_name;?>" type="text" readonly="readonly">
				</div>
			  </div>
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Kode Item
				</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				  <input id="kode" class="form-control col-md-7 col-xs-12" name="kode" placeholder="Kode Item" type="text" value="<?php echo $kode;?>" readonly="readonly">
				</div>
			  </div>
			  <div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan">Satuan
				</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				  <input id="kode" class="form-control col-md-7 col-xs-12" name="satuan" placeholder="Satuan" type="text" value="<?php echo $mu_name;?>" readonly="readonly">
				</div>
			  </div>
			  <div class="ln_solid"></div>
			  <div class="x_content">
				<table class="table" id="detail_harga">
				  <thead>
					<tr>
					  <th width="10%">Tanggal</th>
					  <th>Supplier</th>
					  <th>Harga Beli</th>
					  <th>Harga Jual</th>
					  <th width="9%">Disc (%)</th>
					  <th width="14%">Disc (Rp)</th>
					</tr>
				  </thead>
				  <tbody>
					<?php 
					if($num_rows > 0) {
					$no = 1;
					foreach($result as $row) {
						$params = $row['mbp_id'];
					?>
					<tr>
					  <td>
						<?php echo $row['mbp_datetime'];?>
						<input type="hidden" id="h_id_detail_<?php echo $row['mbp_id'];?>" name="h_id_detail[]" value="<?php echo $params;?>">
					  </td>
					  <td><?php echo $row['ms_name'];?></td>
					  <td class="text-right hbeli">
						<input type="number" class="form-control" id="hbeli_<?php echo $row['mbp_id'];?>" name="hbeli[]" value="<?php echo ($row['mbp_buy_price'] == 0 ? '0' : $row['mbp_buy_price']);?>" min="0">
					  </td>
					  <td class="text-right hjual">
					    <input type="number" class="form-control" id="hjual_<?php echo $row['mbp_id'];?>" name="hjual[]" value="<?php echo ($row['mbp_sell_price'] == 0 ? '0' : $row['mbp_sell_price']);?>" min="0">
					  </td>
					  <td class="text-right disc">
					    <input type="number" class="form-control" id="disc_<?php echo $row['mbp_id'];?>" name="disc[]" value="<?php echo ($row['mbp_disc'] == 0 ? '0' : $row['mbp_disc']);?>" min="0">
					  </td>
					  <td class="text-right disc2">
					    <input type="number" class="form-control" id="disc2_<?php echo $row['mbp_id'];?>" name="disc2[]" value="<?php echo ($row['mbp_disc_nominal'] == 0 ? '0' : $row['mbp_disc_nominal']);?>" min="0">
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
