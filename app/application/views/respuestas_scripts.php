	<script src="<?php echo JS; ?>plugin/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo JS; ?>plugin/datatables/dataTables.colVis.min.js"></script>
	<script src="<?php echo JS; ?>plugin/datatables/dataTables.tableTools.min.js"></script>
	<script src="<?php echo JS; ?>plugin/datatables/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo JS; ?>plugin/datatable-responsive/datatables.responsive.min.js"></script>
	<script src="<?php echo JS; ?>plugin/moment/moment.min.js"></script>
	<script src="<?php echo JS; ?>plugin/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo JS; ?>plugin/moment/es.js"></script>



<script type="text/javascript">

$(document).ready(function() {
	 $(".alert").removeClass("in").show();	 
	 $(".alert").delay(0).addClass("in").fadeOut(0);
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};


		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});

    var otable = $('#datatable_fixed_column').DataTable({

    	"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>>"+
				"t"+"r"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
		"autoWidth" : true,
		 "searching": false,
		 oLanguage: {
	        sProcessing: "<img style='width:50px' src='<?php echo IMG; ?>procesando.gif'>"
	    },


    	"processing": true,
        "serverSide": true,
        "order": [],
         
        "ajax": {
            "url": "respuestas/ajax_list",
            "type": "POST",
            "data": function ( data ) {
                data.datetimepicker1 = $('#datetimepicker1').val();
                data.datetimepicker2 = $('#datetimepicker2').val();
            }
        },
 
        
        "columnDefs": [
        { 
            "targets": [ 0, 5],
            "orderable": false,
        },
        ],



    	//"bFilter": false,
    	//"bInfo": false,
    	//"bLengthChange": false
    	//"bAutoWidth": false,
    	//"bPaginate": false,
    	//"bStateSave": true 
		
		"preDrawCallback" : function() {
			if (!responsiveHelper_datatable_fixed_column) {
				responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
			}
		},
		"rowCallback" : function(nRow) {
			responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
		},
		"drawCallback" : function(oSettings) {
			responsiveHelper_datatable_fixed_column.respond();
		}		
	
    });


	$('#btn-filter').click(function(){
			if(validacion())
			{
				table.ajax.reload();
			}	        
	    });

	$('#btn-reset').click(function(){
        $('#form-filter')[0].reset();
        table.ajax.reload();
    });
    
	var table = $('#datatable_fixed_column').DataTable();
 
    $('#datatable_fixed_column tbody').on( 'click', 'tr', function () {    	
    	var data = table.row( this ).data();            	
		$('#myModal').find('.modal-body').load('home/conversation?sessionId='+data[2]);
	  	$('#myModal').modal('show');

        if ( $(this).hasClass('highlight') ) {
            $(this).removeClass('highlight');
        }
        else {
            table.$('tr.highlight').removeClass('highlight');
            $(this).addClass('highlight');
        }
    } );

    $('#myModal').on('show.bs.modal', function () {
	    $('.modal .modal-body').css('overflow-y', 'auto'); 
	    $('.modal .modal-body').css('max-height', $(window).height() * 0.8);
	});
	$('#myModal').on('hidden.bs.modal', function () {	    
	    $('#myModal').find('.modal-body').html("<html></html>");
	    $('#datatable_fixed_column tr').removeClass('highlight');
	})

    
    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
    	
        otable
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
            
    } );
    
	$('#datatable_col_reorder').dataTable({
		"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
		"autoWidth" : true,
		"preDrawCallback" : function() {			
			if (!responsiveHelper_datatable_col_reorder) {
				responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
			}
		},
		"rowCallback" : function(nRow) {
			responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
		},
		"drawCallback" : function(oSettings) {
			responsiveHelper_datatable_col_reorder.respond();
		}			
	});

	$('#datatable_tabletools').dataTable({
		"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "oTableTools": {
        	 "aButtons": [
             "copy",
             "csv",
             "xls",
                {
                    "sExtends": "pdf",
                    "sTitle": "SmartAdmin_PDF",
                    "sPdfMessage": "SmartAdmin PDF Export",
                    "sPdfSize": "letter"
                },
             	{
                	"sExtends": "print",
                	"sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
            	}
             ],
            "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
        },
		"autoWidth" : true,
		"preDrawCallback" : function() {
			// Initialize the responsive datatables helper once.
			if (!responsiveHelper_datatable_tabletools) {
				responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
			}
		},
		"rowCallback" : function(nRow) {
			responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
		},
		"drawCallback" : function(oSettings) {
			responsiveHelper_datatable_tabletools.respond();
		}
	});

	$("#datetimepicker1").datetimepicker(
		{
			format:'YYYY-MM-DD HH:mm',
			locale: 'es'
		});
	    
	$("#datetimepicker2").datetimepicker(
		{
			format:'YYYY-MM-DD HH:mm',
		});	
})
</script>
