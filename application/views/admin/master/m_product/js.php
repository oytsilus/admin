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
    $('input#name').focus();
  });
  
  // onchange kode
  $('#category').change(function(e){
	var val = $(this).val();
	$.ajax({
		type: 'POST',
		url: base_url + 'm_product/get_kode',
		data: {tipe:val},
		dataType: 'json',
		success: function(data){
			$('input#kode').val(data.kode);
		}
	});
  });
</script>
<!-- /validator -->