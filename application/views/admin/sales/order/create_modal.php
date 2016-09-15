		<table id="datatable-modal" class="table table-striped table-bordered">
		  <thead>
			<tr>
			  <th>Nama Item</th>
			  <th>Satuan</th>
			  <th>Supplier</th>
			  <th>Harga</th>
			  <th width="6%"><input type="checkbox" class="checkall" id="checkall" /></th>
			</tr>
		  </thead>

		  <tbody>
			<?php 
			if($num_rows_det > 0) {
			$no = 1;
			foreach($result_det as $row) {
			?>
			<tr>
			  <td><?php echo $row['mp_name'].' - '.$row['mp_code'];?></td>
			  <td><?php echo $row['mu_name'];?></td>
			  <td><?php echo $row['ms_name'];?></td>
			  <td class="text-right"><?php echo $this->no_format->idr_money($row['mbp_sell_price']);?></td>
			  <td>
				<div class="checkbox">
				  <input type="checkbox" class="check" id="check_<?php echo $row['mbp_id'];?>" name="check" value="<?php echo $row['mbp_id'];?>">
				</div>
			  </td>
			</tr>
			<?php
			$no++;
			} // endforeach
			}
			?>
		  </tbody>
		</table>
		
		<script>
		$(document).ready(function(){
			// Datatable : detail item
			$('#datatable-modal').dataTable({
				"columnDefs": [
					{ "orderable": false, "targets": 0 }
				],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
			});
			
			// Button : checkall
			$('#datatable-modal thead').on('click', 'input.checkall',function(event) {  //on click 
				if(this.checked) { // check select status
					$('#datatable-modal tbody input.check').each(function() { //loop through each checkbox
						this.checked = true;  //select all checkboxes with class "check"  
						
						var new_value = this.value;
						$('#check_var').val($('#check_var').val() + new_value + '-');
					});
				}else{
					$('#datatable-modal tbody input.check').each(function() { //loop through each checkbox
						this.checked = false; //deselect all checkboxes with class "check"   
						
						var curr_value = this.value;
						var all_value = $("#check_var").val();
						var new_value = all_value.replace(curr_value + '-', '');
						$("#check_var").val(new_value);
					});         
				}
			});
			
			// On check : datatable-modal
			$('#datatable-modal tbody').on('click', 'input.check', function () {
				if(this.checked) { // check select status
					var new_value = this.value;
					$('#check_var').val($('#check_var').val() + new_value + '-');
				}else{
					var curr_value = this.value;
					var all_value = $("#check_var").val();
					var new_value = all_value.replace(curr_value + '-', '');
					$("#check_var").val(new_value);
				}
			});
		});
		</script>