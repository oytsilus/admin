<?php 
if($num_rows > 0) {
$no = 1;
foreach($result as $row) {
	$params = $row['tod_id'].'|'.$row['mp_id'].'|'.$row['mp_code'].'|'.$row['mp_category'].'|'.$row['mp_name'].'|'.$row['mu_code'].'|'.$row['mu_name'].'|'.$row['to_id'].'|'.$row['to_no'].'|'.$row['td_outstanding'].'|'.$row['tod_id'].'|'.$row['msp_price'].'|'.$row['tod_qty'].'|'.$row['mbp_price'];
?>
<tr id="row_<?php echo $row['tod_id'];?>">
  <td><?php echo $row['to_no'];?></td>
  <td>
	<?php echo $row['mp_name'];?>
	<input type="hidden" id="h_params_<?php echo $row['tod_id'];?>" name="h_params[]" value="<?php echo $params;?>">
	<input type="hidden" class="h_order_id" id="order_id_<?php echo $row['to_id'];?>" name="h_order_id[]" value="<?php echo $row['to_id'];?>">
  </td>
  <td><?php echo $row['mp_code'];?></td>
  <td class="text-right qty">
	<input type="number" class="form-control input-qty text-right" id="qty_<?php echo $row['tod_id'];?>" name="qty[]" value="<?php echo $row['td_outstanding'];?>" data-id="<?php echo $row['tod_id'];?>" data-harga="<?php echo $row['msp_price'];?>" data-harga-beli="<?php echo $row['mbp_price'];?>" min="0" max="<?php echo $row['td_outstanding'];?>">
  </td>
  <td><?php echo $row['mu_name'];?></td>
  <td class="hbeli">
	<span>Rp.</span>
	<span class="kanan"><?php echo ($row['msp_price'] == 0 ? '0' : $this->no_format->idr_money($row['msp_price']));?></span>
  </td>
  <td>
    <a href="javascript:;" class="btn btn-danger btn-xs btn_delete" data-id="<?php echo $row['tod_id'];?>"><i class="fa fa-trash-o"></i> Hapus </a>
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
	$(".input-qty").on('keyup change click', function() {
		var $val = parseFloat($(this).val());
		var $harga = parseInt($(this).data('harga'));
		var $id = parseInt($(this).data('id'));
	});
	
	// Hapus baris
	$(".btn_delete").click(function(){
		var parent = $(this).parents("tr");
		
		bootbox.confirm("Hapus data ini?", function(result) {                
			if (result === true) {                                               
				parent.fadeOut(1000,function() {
					parent.remove();
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
});
</script>