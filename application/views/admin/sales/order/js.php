<!-- Custom javascript -->
<script>
  var base_url = '<?php echo base_url();?>';
  var def_ppn = '<?php echo $this->config->item('ppn');?>';
  var no_ppn = '0';
  var def_ppn_str = '<strong>PPN <?php echo $this->config->item('ppn');?>%</strong>';
  var no_ppn_str = '<strong>NON-PPN</strong>';
  
  // NProgress
  if (typeof NProgress != 'undefined') {
    $(document).ready(function () {
        NProgress.start();
    });

    $(window).load(function () {
        NProgress.done();
    });
  }
  
  // initialize the validator function
  validator.message.date = 'not a real date';

  // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
  $('form')
	.on('blur', 'input[required], input.optional, select.required', validator.checkField)
	.on('change', 'select.required', validator.checkField)
	.on('keypress', 'input[required][pattern]', validator.keypress);

  $('.multi.required').on('keyup blur', 'input', function() {
	validator.checkField.apply($(this).siblings().last()[0]);
  });

  $('form').submit(function(e) {
	e.preventDefault();
	var submit = true;

	// evaluate the form using generic validaing
	if (!validator.checkAll($(this))) {
	  submit = false;
	}

	if (submit)
	  this.submit();

	return false;
  });
  
  $(document).ready(function(){
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
	
	// Select2
	$(".select2_single").select2({
	  placeholder: "Pilih Customer",
	  allowClear: false
	});
	
	// Onchange : customer
	$("#customer").on('change', function(){
		var val = $(this).val();
		
		if(val === '') {
			alert("Silahkan pilih customer!");
			$("button#send").attr('disabled','disabled');
		}
		else {
			/*
			$.ajax({
				type: 'POST',
				url: base_url+'m_price/generate_harga',
				data: {id:val},
				success: function(data) {
					$("#create_detail").html(data);
					$("button#send").removeAttr('disabled');
				}
			});
			*/
			$.ajax({
				type: 'POST',
				url: base_url+'ajax/generate_cust_detail',
				data: {id:val},
				dataType: 'json',
				success: function(data) {
					$("#cus_address").html(data.mc_address);
					$("#up").val(data.mc_pic);
				}
			});
		}
	});
	
	// Column : harga beli
	$("table#detail_harga > tbody > tr > td.hbeli > span.text").click(function(){
		var $hidden = $(this).closest('tr').find('td.hbeli > input').val();
		var $str = '<input type="number" class="form-control input_hbeli" name="h_beli[]" value="'+$hidden+'" width="70%"/>';
		$(this).closest('tr').find('td.hbeli > span.text').hide();
        $(this).closest('tr').find('td.hbeli > span.input').html($str);
    });
	
	// Column : harga jual
	$("table#detail_harga > tbody > tr > td.hjual > span.text").click(function(){
		var $hidden = $(this).closest('tr').find('td.hjual > input').val();
		var $str = '<input type="number" class="form-control input_hjual" name="h_jual[]" value="'+$hidden+'" width="70%"/>';
		$(this).closest('tr').find('td.hjual > span.text').hide();
        $(this).closest('tr').find('td.hjual > span.input').html($str);
    });
	
	// Button : tambah item
	$("button#btn_add_items").on('click', function(){
		$('#myModal').modal('show');
	});
	
	// Show Modal
    $("#btn_add_item").click(function(){
		if($("#customer").val() === '') {
			bootbox.alert("Silahkan pilih customer!", function(result) {
			});
		}
		else {
			// Reset check_var
			$("#check_var").val('');
			// existing po item
			var arr_checkbox2 = new Array();
			
			$("input.h_mp_id").each(function(i){
				arr_checkbox2[i] = $(this).val();
			});
			
			$.ajax({
				url: base_url+'order/show_modal',
				type: 'POST',
				data: {
					id: 0,
					mp_id: arr_checkbox2
				},
				success: function(data){
					$("#myModalBody").html(data);
				}
			});
			$('#myModal').modal('show');
		}
    });	
	
	// Submit detail item
	$("#submit_modal").on('click',function(){
		/*
		var arr_checkbox = new Array();
		var checked = false;
		
		$("input[name='check']").each(function(i){
			if($(this).is(':checked')) {
				arr_checkbox[i] = $(this).val();
				checked = true;
			}
		});*/
		var strings = $("#check_var").val();
		var string = strings.substring(0, strings.length-1);
		var arr_checkbox = string.split('-');
		
		$.ajax({
			type: 'POST',
			url: base_url+'order/submit_detail',
			data: {id:arr_checkbox},
			success: function(data) {
				$('#myModal').modal('hide');
				
				// Show detail 
				$("#create_detail").append(data);
				$("button#send").removeAttr('disabled');
				
				// Reset checkbox
				$("input.check").each(function(){
					this.checked = false; //deselect all checkboxes with class "check" 
				});
				
				/*
				$.each(arr_checkbox, function( index, value ) {
				  $("#check_"+value).attr('disabled','disabled');
				});*/
				
				// Reset modal body
				$("#myModalBody").html('');
			}
		});
	});
	
	// Numeric validation
   $('input.valid-number').bind('keypress', function(e) { 
       return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
   });
   
   // Is PPN
   $('#is_ppn').bootstrapToggle({
      on: 'PPN',
      off: 'NON-PPN',
	  size: 'small',
	  onstyle: 'primary'
   });
   
   // Is PPN On Change
   $('#is_ppn').change(function(e){
	   if($(this).prop('checked') === true) {
		   $('#h_is_ppn').val('PPN');
		   
		   // Set PPN 
		   $('#ppn_str').html(def_ppn_str);
		   $('#ppn').val(def_ppn);
		   $('.ppn-row').fadeTo('slow',1, function() {
		   });
		   
			var $subtotal = hitungSubtotal();
			var $disc = 0;
			//var $discNominal = hitungDisc($subtotal,$disc);
			var $discNominal = $('#disc_nominal').val();
			var $ppnNominal = hitungPpn($subtotal,$discNominal,def_ppn);
			hitungTotal($subtotal,$discNominal,$ppnNominal);
	   }
	   else {
		   $('#h_is_ppn').val('NON-PPN');
		   
		   $('.ppn-row').fadeTo('slow',0, function() {
			   // Set PPN 
				$('#ppn_str').html(no_ppn_str);
				$('#ppn').val(no_ppn);
		   });
		   
		   var $subtotal = hitungSubtotal();
			//var $disc = 0;
			//var $discNominal = hitungDisc($subtotal,$disc);
			var $discNominal = $('#disc_nominal').val();
			var $ppnNominal = hitungPpn($subtotal,$discNominal,0);
			hitungTotal($subtotal,$discNominal,$ppnNominal);
	   }
   });
   
   // Button : tambah customer
	$("button#add_customer").on('click', function() {
		bootbox.dialog({
                title: "Tambah Customer",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal" method="post"> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="name">Nama Customer</label> ' +
                    '<div class="col-md-8"> ' +
                    '<input id="popup_name" name="name" type="text" placeholder="Nama Customer" class="form-control input-md" required="required"> ' +
                    '</div> ' +
                    '</div> ' +
					'<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="kode">Kode Customer</label> ' +
                    '<div class="col-md-6"> ' +
                    '<input id="popup_kode" name="kode" type="text" placeholder="Kode Customer" class="form-control input-md" required="required"> ' +
                    '</div> ' +
                    '</div> ' +
					'<div class="form-group"> ' +
                    '<div id="div_alert" class="alert alert-danger alert-dismissible hidden" role="alert"> ' +
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
					'<span class="sr-only">Error:</span> '+
					'Nama Customer harus diisi! '+
					'</div>'+
					'</div>'+
                    '</form> </div>  </div>',
                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-success",
                        callback: function () {
                            var name = $("input[name='name']").val();
                            var kode = $("input[name='kode']").val();
                            
							if(name === '') {
								$("#div_alert").removeClass('hidden');
								return false;
							}
							else {
								$.ajax({
									type: 'POST',
									url: base_url+'ajax/add_customer',
									data: {name:name,kode:kode},
									dataType: 'json',
									success: function(data) {
										if(data.status === 'TRUE') {
											// Append it to select2
											$('#customer').append($('<option>', { 
												value: data.value,
												text : data.name 
											})).select2();
											
											return true;
										}
										else {
											bootbox.alert("Error!", function() {
											});
											
											return false;
										}
									}
								});
							}
                        }
                    }
                },
				onEscape: function() {}
            }
        );
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
	
	function hitungPpn($subtotal,$discNominal,$ppn) {
		var $defPpn = parseFloat($ppn);
		var $ppnNominal = parseInt(($subtotal-$discNominal)*($defPpn/100));
		var strPpn = accounting.formatMoney($ppnNominal, "", 0, ",", ".");
		
		$("#ppn_nominal").val($ppnNominal);
		$(".ppn-txt").html(strPpn);
		console.log("PPN : "+$defPpn);
		return $ppnNominal;
	}
	
	function hitungTotal($subtotal,$discNominal,$ppnNominal) {
		var $total = parseInt($subtotal-$discNominal+$ppnNominal);
		var strTotal = accounting.formatMoney($total, "", 0, ",", ".");
		$("#total_nominal").html(strTotal);
		
		$("input#total").val($total);
	}
	
  });
</script>
<!-- /validator -->