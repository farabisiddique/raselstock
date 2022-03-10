

$(document).ready(function() {
    var t = $('#example').DataTable( {
        "columnDefs": [ {
            "width": "20%",
            "searchable": true,
            "orderable": true,
            "defaultContent": "-",
            "targets": "_all"

        } ],
        "order": [[ 1, 'asc' ]],
        "paging": true,
        "responsive": true,
        "lengthChange": true,
        "pageLength": 25,
        "processing": true,
        "serverSide": true,
        "ajax": "datatable/confirmed_order.php"
    } );

    t.columns.adjust().draw();
 


    

} );