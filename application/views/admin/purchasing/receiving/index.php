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
				  <th>No SJ</th>
				  <th>Supplier</th>
				  <th>Catatan</th>
				  <th width="15%">Opsi</th>
				</tr>
			  </thead>

			  <tbody>
				<?php 
				if($num_rows > 0) {
				$no = 1;
				foreach($result as $row) {
					$nextId = $this->no_format->get_next_receiving($row['tr_id'],$row['tp_id']);
					$disabled = ($nextId > 0 ? ' disabled="disabled"' : NULL);
					$class = ($nextId > 0 ? ' disablee' : NULL);
					$title = ($nextId > 0 ? 'title="Proses tidak dapat dilakukan karena terdapat proses receiving setelah dokumen ini"' : NULL);
					$url = ($nextId > 0 ? 'javascript:;' : base_url('receiving/edit/'.$row['tr_id']));
					//$disabled = NULL;
					//$url = base_url('receiving/edit/'.$row['tr_id']);
				?>
				<tr>
				  <td>
					<a class="detail-record" href="<?php echo base_url('receiving/print_rec/'.$row['tr_id']);?>" title="Detail" target="_blank"><?php echo $row['tr_no'];?></a>
				  </td>
				  <td><?php echo $row['tr_date'];?></td>
				  <td><?php echo $row['tr_ship_no'];?></td>
				  <td><?php echo $row['ms_name'].' - '.$row['ms_code'];?></td>	
				  <td><?php echo $row['tr_desc'];?></td>
				  <td class="text-center">
					<a href="<?php echo $url;?>" class="btn btn-info btn-xs<?php echo $class;?>"<?php echo $disabled.$title;?>><i class="fa fa-pencil"></i> Edit </a>
					<a href="javascript:;" class="btn btn-danger btn-xs btn_delete<?php echo $class;?>" data-id="<?php echo $row['tr_id'];?>"<?php echo $disabled.$title;?>><i class="fa fa-trash-o"></i> Delete </a>
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
