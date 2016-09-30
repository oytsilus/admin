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

	// Numeric validation
   $('input.valid-number').bind('keypress', function(e) {
       return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
   });

  });
</script>
<!-- /validator -->
