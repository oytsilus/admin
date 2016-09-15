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
				  <th>Nama</th>
				  <th>Alamat</th>
				  <th>Telepon</th>
				  <th>Fax</th>
				  <th>E-mail</th>
				  <th width="15%">Opsi</th>
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
				  <td><?php echo $row['ms_name'].' - '.$row['ms_code'];?></td>
				  <td><?php echo $row['ms_address'];?></td>
				  <td><?php echo $row['ms_phone1'];?></td>
				  <td><?php echo $row['ms_fax'];?></td>
				  <td><?php echo $row['ms_email'];?></td>
				  <td>
					<a href="<?php echo base_url('m_supplier/edit/'.$row['ms_id']);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
					<a href="javascript:;" class="btn btn-danger btn-xs btn_delete" data-id="<?php echo $row['ms_id'];?>"><i class="fa fa-trash-o"></i> Delete </a>
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
