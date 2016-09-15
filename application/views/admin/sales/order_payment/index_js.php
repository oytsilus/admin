<!-- Datatables -->
<script>
  $(document).ready(function() {
	var base_url = '<?php echo base_url();?>';
	
	/*
	// Datatable filter_has_var
    $('#datatable-buttons thead tr#filterrow th').each( function () {
        var title = $('#datatable-buttons thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
    } );
    // Apply the filter
    $("#datatable-buttons thead input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
    } ); */
	
	var handleDataTableButtons = function() {
	  if ($("#datatable-buttons").length) {
		$("#datatable-buttons").DataTable({
		  dom: "Bfrtip",
		  buttons: [
			{
			  text: 'Buat Pembayaran',
              action: function ( e, dt, node, config ) {
                location.href="<?php echo base_url('order_payment/create');?>";
              },
			  className: "btn-sm btn-info"
            }
		  ],
		  aaSorting: [],
		  responsive: true,
		  orderCellsTop: true
		});
	  }
	};

	TableManageButtons = function() {
	  "use strict";
	  return {
		init: function() {
		  handleDataTableButtons();
		}
	  };
	}();
	
/*
	$('#datatable').dataTable({
        "columnDefs": [
			{ "orderable": false, "targets": 0 }
	    ],
		orderCellsTop: true
	}); */

	TableManageButtons.init();
	
	// Button : checkall
	$('#datatable-buttons thead').on('click', 'input.checkall',function(event) {  //on click 
		if(this.checked) { // check select status
			$('#datatable-buttons tbody input.check').each(function() { //loop through each checkbox
				this.checked = true;  //select all checkboxes with class "check"  
				
				var new_value = this.value;
				$('#check_var').val($('#check_var').val() + new_value + '-');
			});
		}else{
			$('#datatable-buttons tbody input.check').each(function() { //loop through each checkbox
				this.checked = false; //deselect all checkboxes with class "check"   
				
				var curr_value = this.value;
				var all_value = $("#check_var").val();
				var new_value = all_value.replace(curr_value + '-', '');
				$("#check_var").val(new_value);
			});         
		}
	});
	
	// Delete data
	$("#datatable-buttons").on('click','tbody > tr > td > a.btn_delete', function(e){
		var id = $(this).data('id');
		var to_id = $(this).data('to-id');
		var parent = $(this).parents("tr");
		
		if(!$(this).hasClass('disablee')) {
			bootbox.confirm("Hapus data ini?", function(result) {                
				if (result === true) {                                               
					$.ajax({
						type: 'POST',
						url: base_url+'order_payment/delete',
						data: {id:id,to_id:to_id},
						dataType: 'json',
						success: function(data) {
								parent.fadeOut(1000,function() {
									parent.remove();
									
									setTimeout(function(){ window.location=base_url+"order_payment"; }, 500);
								});                    
						}
					});                         
				}
			});
		}
	});
  });
  
  function stopPropagation(evt) {
	if (evt.stopPropagation !== undefined) {
		evt.stopPropagation();
	} else {
		evt.cancelBubble = true;
	}
  }
</script>
<!-- /Datatables -->