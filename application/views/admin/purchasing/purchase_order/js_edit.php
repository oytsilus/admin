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