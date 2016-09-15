<!-- Datatables -->
<script>
  $(document).ready(function() {
	var base_url = '<?php echo base_url();?>';
	var handleDataTableButtons = function() {
	  if ($("#datatable-buttons").length) {
		$("#datatable-buttons").DataTable({
		  dom: "Bfrtip",
		  buttons: [
			{
			  text: 'Tambah Customer',
              action: function ( e, dt, node, config ) {
                location.href="<?php echo base_url('m_customer/create');?>";
              },
			  className: "btn-sm"
            },
			{
			  extend: "copy",
			  className: "btn-sm",
			  exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5 ]
			  }
			},
			{
			  extend: "excel",
			  className: "btn-sm",
			  exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5 ]
			  }
			},
			{
			  extend: "pdf",
			  className: "btn-sm",
			  exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5 ]
			  }
			},
			{
			  extend: "print",
			  className: "btn-sm",
			  exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5 ]
			  }
			}
		  ],
		  columnDefs: [
			{ "orderable": false, "targets": 0 }
		  ],
		  responsive: true
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

	$('#datatable').dataTable({
        "columnDefs": [
			{ "orderable": false, "targets": 0 }
	    ]
	});

	TableManageButtons.init();
	
	// Delete data
	$("#datatable-buttons").on('click','tbody > tr > td > a.btn_delete', function(e){
		var id = $(this).data('id');
		var parent = $(this).parents("tr");
		
		bootbox.confirm("Hapus data ini?", function(result) {                
			if (result === true) {                                               
			$.ajax({
				type: 'POST',
				url: base_url+'m_customer/delete',
				data: {id:id},
				dataType: 'json',
				success: function(data) {
						parent.fadeOut(1000,function() {
							parent.remove();
							
							location.reload(1);
						});                    
				}
			  });                         
			}
		});
	});
  });
</script>
<!-- /Datatables -->