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
    $('#tgl_berlaku').daterangepicker({
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
	  placeholder: "Pilih Supplier",
	  allowClear: false
	});
	
	// Onchange : supplier
	$("#supplier").on('change', function(){
		var val = $(this).val();
		
		if(val === '') {
			alert("Silahkan pilih supplier!");
			$("button#send").attr('disabled','disabled');
		}
		else {
			$.ajax({
				type: 'POST',
				url: base_url+'m_price/generate_harga',
				data: {id:val},
				success: function(data) {
					$("#create_detail").html(data);
					$("button#send").removeAttr('disabled');
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
	
	// Button : tambah supplier
	$("button#add_supplier").on('click', function() {
		bootbox.dialog({
                title: "Tambah Supplier",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal" method="post"> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="name">Nama Supplier</label> ' +
                    '<div class="col-md-8"> ' +
                    '<input id="popup_name" name="name" type="text" placeholder="Nama Supplier" class="form-control input-md" required="required"> ' +
                    '</div> ' +
                    '</div> ' +
					'<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="kode">Kode Supplier</label> ' +
                    '<div class="col-md-3"> ' +
                    '<input id="popup_kode" name="kode" type="text" placeholder="Kode Supplier" class="form-control input-md" required="required"> ' +
                    '</div> ' +
                    '</div> ' +
					'<div class="form-group"> ' +
                    '<div id="div_alert" class="alert alert-danger alert-dismissible hidden" role="alert"> ' +
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+
					'<span class="sr-only">Error:</span> '+
					'Nama Supplier harus diisi! '+
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
									url: base_url+'ajax/add_supplier',
									data: {name:name,kode:kode},
									dataType: 'json',
									success: function(data) {
										if(data.status === 'TRUE') {
											// Append it to select2
											$('#supplier').append($('<option>', { 
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
  });
</script>
<!-- /validator -->