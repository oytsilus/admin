<!-- Datatables -->
<script>
  $(document).ready(function() {
	var handleDataTableButtons = function() {
	  if ($("#datatable-buttons").length) {
		$("#datatable-buttons").DataTable({
		  dom: "Bfrtip",
		  buttons: [
			{
			  text: 'Add New Supplier',
              action: function ( e, dt, node, config ) {
                location.href="<?php echo base_url('m_supplier/create');?>";
              },
			  className: "btn-sm"
            },
			{
			  extend: "copy",
			  className: "btn-sm"
			},
			{
			  extend: "excel",
			  className: "btn-sm"
			},
			{
			  extend: "pdf",
			  className: "btn-sm"
			},
			{
			  extend: "print",
			  className: "btn-sm"
			}
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

	$('#datatable').dataTable();

	TableManageButtons.init();
  });
</script>
<!-- /Datatables -->