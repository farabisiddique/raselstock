

$(document).ready(function() {
    var t = $('#example').DataTable( {
        "bAutoWidth": false,
        "columnDefs": [ {

            "sWidth": "30%",
            "searchable": true,
            "orderable": true,
            "defaultContent": "-",
            "targets": "_all"

        } ],
        "language": {
            "infoFiltered": ""
        },
        
        "order": [[ 1, 'asc' ]],
        "paging": true,
        "responsive": true,
        "lengthChange": true,
        "pageLength": 25,
        "processing": true,
        "serverSide": true,
        "ajax": "datatable/accepted_order.php"
    } );

    t.columns.adjust().draw();
 
    

    

} );