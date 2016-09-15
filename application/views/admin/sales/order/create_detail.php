<?php 
if($num_rows > 0) {
$no = 1;
foreach($result as $row) {
	$params = $row['mbp_id'].'|'.$row['mp_id'].'|'.$row['mp_code'].'|'.$row['mp_category'].'|'.$row['mp_name'].'|'.$row['mu_code'].'|'.$row['mu_name'].'|'.$row['mbp_sell_price'].'|'.$row['mbp_buy_price'];
?>
<tr id="row_<?php echo $row['mbp_id'];?>">
  <td>
	<?php echo $row['mp_name'];?>
	<input type="hidden" id="h_params_<?php echo $row['mbp_id'];?>" name="h_params[]" value="<?php echo $params;?>">
	<input type="hidden" class="h_mp_id" id="h_mp_id_<?php echo $row['mbp_id'];?>" name="h_mp_id[]" value="<?php echo $row['mp_id'];?>">
	<input type="hidden" class="h_tod_id" id="h_tod_id_<?php echo $row['mbp_id'];?>" name="h_tod_id[]" value="0">
  </td>
  <td><?php echo $row['mp_code'];?></td>
  <td class="text-right qty">
	<input type="number" class="form-control input-qty text-right" id="qty_<?php echo $row['mbp_id'];?>" name="qty[]" value="" data-id="<?php echo $row['mbp_id'];?>" data-harga="<?php echo $row['mbp_sell_price'];?>" min="0">
  </td>
  <td><?php echo $row['mu_name'];?></td>
  <td class="hbeli">
	<span>Rp.</span>
	<span class="kanan"><?php echo ($row['mbp_sell_price'] == 0 ? '0' : $this->no_format->idr_money($row['mbp_sell_price']));?></span>
  </td>
  <td class="text-right jkirim">
	<input type="text" class="form-control datepicker" id="jkirim_<?php echo $row['mbp_id'];?>" name="jkirim[]" placeholder="Tgl Kirim" aria-describedby="inputSuccess2Status">
  </td>
  <td class="jml">
	<span>Rp.</span>
	<span id="jml_nominal<?php echo $row['mbp_id'];?>" class="kanan">0</span>
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
		var $jumlah = $val*$harga;
		
		var strJumlah = accounting.formatMoney($jumlah, "", 0, ",", ".");
		$("#jml_nominal"+$id).html(strJumlah);
		
		var $subtotal = hitungSubtotal();
		var $disc = 0;
		var $discNominal = hitungDisc($subtotal,$disc);
		var $ppnNominal = hitungPpn($subtotal,$discNominal);
		hitungTotal($subtotal,$discNominal,$ppnNominal);
	});
	
	// Hitung discount
	$("#disc").on('keyup change click', function() {
		var $disc = parseFloat($(this).val());
		var $subtotal = parseInt($("#subtotal").val());
		
		var $discNominal = hitungDisc($subtotal,$disc);
		var $ppnNominal = hitungPpn($subtotal,$discNominal);
		hitungTotal($subtotal,$discNominal,$ppnNominal);
	});
	
	function hitungSubtotal() {
		var $subtotal = 0;
		$(".input-qty").each(function(i){
			var $val = parseFloat($(this).val());
			var $harga = parseInt($(this).data('harga'));
			var $id = parseInt($(this).data('id'));
			
			if (!isNaN($val)) {
				$subtotal += $val*$harga;
			}
		});
		
		var strSubtotal = accounting.formatMoney($subtotal, "", 0, ",", ".");
		$("#subtotal_nominal").html(strSubtotal);
		$("#subtotal").val($subtotal);
		
		return $subtotal;
	}
	
	function hitungDisc($subtotal,$disc) {
		var $discNominal = parseInt($subtotal*($disc/100));
		
		$("#disc_nominal").val($discNominal);
		return $discNominal;
	}
	
	function hitungPpn($subtotal,$discNominal) {
		var $defPpn = parseFloat($("#ppn").val());
		var $ppnNominal = parseInt(($subtotal-$discNominal)*($defPpn/100));
		var strPpn = accounting.formatMoney($ppnNominal, "", 0, ",", ".");
		
		$("#ppn_nominal").val($ppnNominal);
		$(".ppn-txt").html(strPpn);
		
		return $ppnNominal;
	}
	
	function hitungTotal($subtotal,$discNominal,$ppnNominal) {
		var $total = parseInt($subtotal-$discNominal+$ppnNominal);
		var strTotal = accounting.formatMoney($total, "", 0, ",", ".");
		$("#total_nominal").html(strTotal);
		
		$("input#total").val($total);
	}
	
	// Hapus baris
	$(".btn_delete").click(function(){
		var parent = $(this).parents("tr");
		
		bootbox.confirm("Hapus data ini?", function(result) {                
			if (result === true) {                                               
				parent.fadeOut(1000,function() {
					parent.remove();
					
					var $subtotal = hitungSubtotal();
					var $disc = parseFloat($("#disc").val());
					var $discNominal = hitungDisc($subtotal,$disc);
					var $ppnNominal = hitungPpn($subtotal,$discNominal);
					hitungTotal($subtotal,$discNominal,$ppnNominal);
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