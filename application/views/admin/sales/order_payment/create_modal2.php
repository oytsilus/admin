		<table id="datatable-modal2" class="table table-striped table-bordered table-responsive">
		  <thead>
			<tr>
			  <th>No PO</th>
			  <th>Tanggal</th>
			  <th>Customer</th>
			  <th class="text-right">Total<br>Tagihan</th>
			  <th class="text-right">Total<br>Dibayar</th>
			  <th class="text-right">Sisa<br>Tagihan</th>
			  <th width="10%">Status<br>Pembayaran</th>
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
			  <td><?php echo $row['to_no'];?></td>
			  <td><?php echo $row['to_date'];?></td>
			  <td><?php echo $row['mc_name'];?></td>
			  <td class="text-right"><?php echo $this->no_format->idr_money($row['to_total']);?></td>
			  <td class="text-right"><?php echo $this->no_format->idr_money($row['total_bayar']);?></td>
			  <td class="text-right"><?php echo $this->no_format->idr_money($row['hutang_bayar']);?></td>
			  <td><?php echo ($row['status_pembayaran'] == 'OPEN' ? '<span class="text-danger">OPEN</span>' : '<span class="text-success">LUNAS</span>');?></td>
			  <td>
				<div class="checkbox">
				  <input type="radio" class="check2" id="check2_<?php echo $row['to_id'];?>" name="check2" value="<?php echo $row['to_id'];?>">
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
			$('#datatable-modal2').dataTable({
				aaSorting: [],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
			});
			
			// Button : checkall
			$('#datatable-modal2 thead').on('click', 'input.checkall',function(event) {  //on click 
				if(this.checked) { // check select status
					$('#datatable-modal2 tbody input.check2').each(function() { //loop through each checkbox
						this.checked = true;  //select all checkboxes with class "check2"  
						
						var new_value = this.value;
						$('#check_var2').val($('#check_var2').val() + new_value + '-');
					});
				}else{
					$('#datatable-modal2 tbody input.check2').each(function() { //loop through each checkbox
						this.checked = false; //deselect all checkboxes with class "check2"   
						
						var curr_value = this.value;
						var all_value = $("#check_var2").val();
						var new_value = all_value.replace(curr_value + '-', '');
						$("#check_var2").val(new_value);
					});         
				}
			});
			
			// On check : datatable-modal
			$('#datatable-modal2 tbody').on('click', 'input.check2', function () {
				if(this.checked) { // check select status
					var new_value = this.value;
					$('#check_var2').val($('#check_var2').val() + new_value + '-');
				}else{
					var curr_value = this.value;
					var all_value = $("#check_var2").val();
					var new_value = all_value.replace(curr_value + '-', '');
					$("#check_var2").val(new_value);
				}
			});
		});
		</script>