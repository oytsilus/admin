<?php 
if($num_rows > 0) {
$no = 1;
foreach($result as $row) {
	$params = $row['to_id'].'|'.$row['to_no'].'|'.$row['hutang_bayar'].'|'.$row['to_deadline_payment'].'|'.$row['mc_id'].'|'.$row['mc_name'].'|'.$row['mc_code'].'|'.$row['to_date'];
?>
<tr id="row_<?php echo $row['to_id'];?>">
  <td><?php echo $row['to_no'];?></td>
  <td>
	<?php echo $row['to_date'];?>
	<input type="hidden" id="h_params_<?php echo $row['to_id'];?>" name="h_params[]" value="<?php echo $params;?>">
	<input type="hidden" class="h_order_id" id="po_id_<?php echo $row['to_id'];?>" name="h_order_id[]" value="<?php echo $row['to_id'];?>">
	<input type="hidden" class="h_order_no" id="po_no_<?php echo $row['to_id'];?>" name="h_order_no[]" value="<?php echo $row['to_no'];?>">
  </td>
  <td><?php echo $row['mc_name'];?></td>
  <td class="hbeli">
	<span>Rp.</span>
	<span class="kanan"><?php echo ($row['to_total'] == 0 ? '0' : $this->no_format->idr_money($row['to_total']));?></span>
  </td>
  <td class="hbeli">
	<span>Rp.</span>
	<span class="kanan"><?php echo ($row['total_bayar'] == 0 ? '0' : $this->no_format->idr_money($row['total_bayar']));?></span>
  </td>
  <td class="hbeli">
	<span>Rp.</span>
	<span class="kanan"><?php echo ($row['hutang_bayar'] == 0 ? '0' : $this->no_format->idr_money($row['hutang_bayar']));?></span>
  </td>
  <td class="text-right dibayar">
	<input type="number" class="form-control input-dibayar text-right" id="dibayar_<?php echo $row['to_id'];?>" name="dibayar[]" value="<?php echo $row['hutang_bayar'];?>" data-id="<?php echo $row['to_id'];?>" data-hutang-bayar="<?php echo $row['hutang_bayar'];?>" min="0" max="<?php echo $row['hutang_bayar'];?>">
  </td>
  <td>
    <a href="javascript:;" class="btn btn-danger btn-xs btn_delete" data-id="<?php echo $row['to_id'];?>"><i class="fa fa-trash-o"></i> Hapus </a>
  </td>
</tr>
<?php
$no++;
} // endforeach
}
?>

<script>
$(document).ready(function(){
	// Hitung jumlah
	$(".input-dibayar").on('keyup change click blur', function() {
		hitungTotal();
	});
	
	// Hapus baris
	$(".btn_delete").click(function(){
		var parent = $(this).parents("tr");
		
		bootbox.confirm("Hapus data ini?", function(result) {                
			if (result === true) {                                               
				parent.fadeOut(1000,function() {
					parent.remove();
					
					hitungTotal();
				});                          
			}
		});    
	});
	
	// Daterangepicker
    $('.datepicker').daterangepicker({
	  singleDatePicker: true,
	  calender_style: "picker_1",
	  timePicker: false,
	  timePickerIncrement: 1,
	  timePicker12Hour: false,
	}, function(start, end, label) {
	  console.log(start.toISOString(), end.toISOString(), label);
	});
	
	// Validasi jumlah dibayar
	$(".input-dibayar").change(function() {
      var max = parseFloat($(this).attr('max'));
      var min = parseFloat($(this).attr('min'));
	  var current = parseFloat($(this).data('hutang-bayar'));
	  
      if ($(this).val() > max) {
          $(this).val(max);
      }
      else if ($(this).val() < min) {
          $(this).val(min);
      }  
    }); 
	
	function hitungTotal() {
		var arr_bayar = new Array();
		var $total = 0;
		$("input.input-dibayar").each(function(i){
			arr_bayar[i] = $(this).val();
			$total += parseInt(arr_bayar[i]);
		});
		
		var strTotal = accounting.formatMoney($total, "", 0, ",", ".");
		$("#total_nominal").html(strTotal);
		
		$("input#total").val($total);
	}
});
</script>