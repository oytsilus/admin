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
				  <!--<th width="6%"><input type="checkbox" class="checkall" id="checkall" /></th>-->
				  <th>Order No</th>
				  <th>Tanggal Order</th>
				  <th>Invoice No</th>
				  <th>Tanggal <br>Invoice</th>
				  <th>Customer</th>
				  <th>Total</th>
				  <th class="col-lg-2 col-sm-2 col-xs-12">Status</th>
				  <th class="col-lg-2 col-sm-2 col-xs-12">Pembayaran</th>
				  <th width="15%">Opsi</th>
				</tr>
			  </thead>

			  <tbody>
				<?php 
				if($num_rows > 0) {
				$no = 1;
				foreach($result as $row) {
					$disabled = ($row['to_status'] == 'CLOSED' ? ' disabled="disabled"' : NULL);
					$url = ($row['to_status'] == 'CLOSED' ? 'javascript:;' : base_url('order/edit/'.$row['to_id']));
				?>
				<tr>
				  <!--<td>
					<div class="checkbox">
					  <input type="checkbox" class="check" id="check_<?php echo $row['to_id'];?>" name="check" value="<?php echo $row['to_id'];?>">
					</div>
				  </td>-->
				  <td>
					<a class="detail-record" href="<?php echo base_url('order/print_order/'.$row['to_id']);?>" title="Detail" target="_blank"><?php echo $row['to_no'];?></a>
				  </td>
				  <td><?php echo $this->tanggal->tgl_indo4($row['to_date']);?></td>
				  <td>
					<a class="detail-record" href="<?php echo base_url('order/print_invoice/'.$row['to_id']);?>" title="Invoice" target="_blank"><?php echo $row['to_no'];?></a>
				  </td>
				  <td><?php echo $this->tanggal->tgl_indo4($row['toi_date']);?></td>
				  <td><?php echo $row['mc_name'].' - '.$row['mc_code'];?></td>	
				  <td class="text-right"><?php echo $this->no_format->idr_money($row['to_total']);?></td>
				  <td><?php echo ($row['to_status'] == 'CLOSED' ? '<span class="text-danger">'.$row['to_status'].'</span>' : '<span class="text-success">'.$row['to_status'].'</span>');?></td>
				  <td><?php echo $row['to_status_payment'];?></td>
				  <td class="text-center">
					<a href="<?php echo $url;?>" class="btn btn-info btn-xs"<?php echo $disabled;?>><i class="fa fa-pencil"></i> Edit </a>
					<a href="javascript:;" class="btn btn-danger btn-xs btn_delete" data-id="<?php echo $row['to_id'];?>"<?php echo $disabled;?>><i class="fa fa-trash-o"></i> Delete </a>
				  </td>
				</tr>
				<?php
				$no++;
				} // endforeach
				}
				?>
			  </tbody>
			</table>
			<input type="hidden" id="check_var" name="check_var">
		  </div>
		</div>
	  </div>
	</div>
  </div>
<!-- /page content -->
