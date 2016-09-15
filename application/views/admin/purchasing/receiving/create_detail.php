<?php 
if($num_rows > 0) {
$no = 1;
foreach($result as $row) {
	$params = $row['mbp_id'].'|'.$row['mp_id'].'|'.$row['mp_code'].'|'.$row['mp_category'].'|'.$row['mp_name'].'|'.$row['mu_code'].'|'.$row['mu_name'].'|0||0|0|'.$row['mbp_buy_price'];
?>
<tr id="row_<?php echo $row['mbp_id'];?>">
  <td></td>
  <td>
	<?php echo $row['mp_name'];?>
	<input type="hidden" id="h_params_<?php echo $row['mbp_id'];?>" name="h_params[]" value="<?php echo $params;?>">
	<input type="hidden" class="h_mp_id" id="h_mp_id_<?php echo $row['mbp_id'];?>" name="h_mp_id[]" value="<?php echo $row['mp_id'];?>">
  </td>
  <td><?php echo $row['mp_code'];?></td>
  <td class="text-right qty">
	<input type="number" class="form-control input-qty text-right" id="qty_<?php echo $row['mbp_id'];?>" name="qty[]" value="" data-id="<?php echo $row['mbp_id'];?>" data-harga="<?php echo $row['mbp_buy_price'];?>" min="0">
  </td>
  <td><?php echo $row['mu_name'];?></td>
  <td class="hbeli">
	<span>Rp.</span>
	<span class="kanan"><?php echo ($row['mbp_buy_price'] == 0 ? '0' : $this->no_format->idr_money($row['mbp_buy_price']));?></span>
  </td>
  <td>
    <a href="javascript:;" class="btn btn-danger btn-xs btn_delete" data-id="<?php echo $row['mbp_id'];?>"><i class="fa fa-trash-o"></i> Hapus </a>
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