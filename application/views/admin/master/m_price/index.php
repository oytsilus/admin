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
			
			<table id="datatable-buttons" class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th width="4%">No</th>
				  <th>Nama Item</th>
				  <th>Supplier</th>
				  <th>Satuan</th>
				  <th>Harga Beli</th>
				  <th>Harga Jual</th>
				  <th width="9%">Disc (%)</th>
				  <th>Disc (Rp)</th>
				  <th width="10%">Opsi</th>
				</tr>
			  </thead>

			  <tbody>
				<?php 
				if($num_rows > 0) {
				$no = 1;
				foreach($result as $row) {
				?>
				<tr>
				  <td><?php echo $no;?></td>
				  <td><?php echo $row['mp_name'].' - '.$row['mp_code'];?></td>
				  <td><?php echo $row['ms_name'];?></td>
				  <td><?php echo $row['mu_name'];?></td>
				  <td class="text-right"><?php echo $this->no_format->idr_money($row['mbp_buy_price']);?></td>
				  <td class="text-right"><?php echo $this->no_format->idr_money($row['mbp_sell_price']);?></td>
				  <td class="text-right"><?php echo $row['mbp_disc'];?></td>
				  <td class="text-right"><?php echo $this->no_format->idr_money($row['mbp_disc_nominal']);?></td>
				  <td class="text-center">
					<a href="<?php echo base_url('m_price/edit/'.$row['mp_id'].'/'.$row['ms_id']);?>" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> Detail </a>
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
		</div>
	  </div>
	</div>
  </div>
<!-- /page content -->
