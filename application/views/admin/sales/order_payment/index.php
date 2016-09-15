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
				  <th>Form No</th>
				  <th>Tanggal</th>
				  <th>Order No</th>
				  <th>Supplier</th>
				  <th class="text-right">Total<br>Tagihan</th>
				  <th class="text-right">Total<br>Dibayar</th>
				  <th class="text-right">Sisa<br>Tagihan</th>
				  <th>Status</th>
				  <th width="15%">Opsi</th>
				</tr>
			  </thead>

			  <tbody>
				<?php 
				if($num_rows > 0) {
				$no = 1;
				foreach($result as $row) {
					$nextId = $this->no_format->get_next_op($row['top_id'],$row['to_id']);
					$disabled = ($nextId > 0 ? ' disabled="disabled"' : NULL);
					$class = ($nextId > 0 ? ' disablee' : NULL);
					$title = ($nextId > 0 ? 'title="Proses tidak dapat dilakukan karena terdapat proses payment setelah dokumen ini"' : NULL);
					$url = ($nextId > 0 ? 'javascript:;' : base_url('order_payment/edit/'.$row['top_id']));
					//$disabled = NULL;
					//$url = base_url('order_payment/edit/'.$row['top_id']);
				?>
				<tr>
				  <td>
					<a class="detail-record" href="<?php echo base_url('order_payment/print_payment/'.$row['top_id']);?>" title="Detail" target="_blank"><?php echo $row['top_no'];?></a>
				  </td>
				  <td><?php echo $this->tanggal->tgl_postgres($row['top_date']);?></td>
				  <td><a class="detail-record" href="<?php echo base_url('order_order/print_op/'.$row['to_id']);?>" title="Detail PO" target="_blank"><?php echo $row['to_no'];?></a></td>
				  <td><?php echo $row['mc_name'].' - '.$row['mc_code'];?></td>	
				  <td class="text-right"><?php echo $this->no_format->idr_money($row['total_tagihan']);?></td>
				  <td class="text-right"><?php echo $this->no_format->idr_money($row['total_bayar']);?></td>
				  <td class="text-right"><?php echo $this->no_format->idr_money($row['hutang_bayar']);?></td>
				  <td class="text-center"><?php echo ($row['status_pembayaran'] == 'LUNAS' ? '<span class="text-success">'.$row['status_pembayaran'].'</span>' : '<span class="text-danger">'.$row['status_pembayaran'].'</span>');?></td>
				  <td class="text-center">
					<a href="<?php echo $url;?>" class="btn btn-info btn-xs<?php echo $class;?>"<?php echo $disabled.$title;?>><i class="fa fa-pencil"></i> Edit </a>
					<a href="javascript:;" class="btn btn-danger btn-xs btn_delete<?php echo $class;?>" data-id="<?php echo $row['top_id'];?>" data-to-id="<?php echo $row['to_id'];?>"<?php echo $disabled.$title;?>><i class="fa fa-trash-o"></i> Delete </a>
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
