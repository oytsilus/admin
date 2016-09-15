<!-- Custom javascript -->
<script>
  var base_url = '<?php echo base_url();?>';
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
				url: base_url+'ajax/generate_cus_detail',
				data: {id:val},
				dataType: 'json',
				success: function(data) {
					$("#cus_address").html(data.mc_address);
					$("#up").val(data.mc_pic);
				}
			});
		}
	});
	
	// Onchange : customer2
	$("#customer2").on('change', function(){
		var val = $(this).val();
		
		if(val === '') {
			alert("Silahkan pilih customer!");
			$("button#send").attr('disabled','disabled');
		}
		else {
			$("button#send").removeAttr('disabled');
		}
	});
	
	// Button : tambah item
	$("button#btn_add_items").on('click', function(){
		$('#myModal').modal('show');
	});
	
	// Show Modal (Add Item)
    $("#btn_add_item").click(function(){
		if($("#customer").val() === '') {
			bootbox.alert("Silahkan pilih customer!", function(result) {
			});
		}
		else {
			// Reset check_var
			$("#check_var").val('');
			
			// existing item
			var arr_checkbox1 = new Array();
			
			$("input.h_mp_id").each(function(i){
				arr_checkbox1[i] = $(this).val();
			});
			
			$.ajax({
				url: base_url+'delivery/show_modal',
				type: 'POST',
				data: {
					id:$("#customer").val(),
					mp_id: arr_checkbox1
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
			url: base_url+'delivery/submit_detail',
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
	
	// Show Modal (Choose Order)
    $("#btn_choose_order").click(function(){
		if($("#customer").val() === '') {
			bootbox.alert("Silahkan pilih customer!", function(result) {
			});
		}
		else {
			// Reset check_var
			$("#check_var").val('');
			
			// existing po item
			var arr_checkbox2 = new Array();
			
			$("input.h_order_id").each(function(i){
				arr_checkbox2[i] = $(this).val();
			});
			
			$.ajax({
				url: base_url+'delivery/show_modal2',
				type: 'POST',
				data: {
					id:$("#customer").val(),
					o_id: arr_checkbox2
				},
				success: function(data){
					$("#myModalBody2").html(data);
				}
			});
			$('#myModal2').modal('show');
		}
    });	
	
	// Submit detail item
	$("#submit_modal2").on('click',function(){
		var strings = $("#check_var2").val();
		var string = strings.substring(0, strings.length-1);
		var arr_checkbox = string.split('-');
		
		$.ajax({
			type: 'POST',
			url: base_url+'delivery/submit_detail2',
			data: {id:arr_checkbox},
			success: function(data) {
				$('#myModal2').modal('hide');
				
				// Show detail 
				$("#create_detail").append(data);
				$("button#send").removeAttr('disabled');
				
				// Reset checkbox
				$("input.check2").each(function(){
					this.checked = false; //deselect all checkboxes with class "check" 
				});
				
				// Reset modal body
				$("#myModalBody2").html('');
			}
		});
	});
	
	// Numeric validation
   $('input.valid-number').bind('keypress', function(e) { 
       return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
   });
	
  });
</script>
<!-- /validator -->