<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
$path = realpath('./../../env.php');

include  $path;

// DB table to use
$table = 'order_table';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'customer_name', 'dt' => 1 ),
	array( 'db' => 'customer_phone',  
		   'dt' => 2,
		   'formatter' => function( $d, $row ) {
		   		if(is_null($d)){
		   			
		   			return "";
		   		}
		   		else{
		   			return "+880".$d;
		   		}
				
			} 
	),
	array( 'db' => 'customer_bkash_no',  
		   'dt' => 3,
		   'formatter' => function( $d, $row ) {
		   		if(is_null($d)){
		   			
		   			return "";
		   		}
		   		else{
		   			return "0".$d;
		   		}
				
			} 
	),
	array( 'db' => 'customer_address',   'dt' => 4 ),
	array( 'db' => 'reference_name',     'dt' => 5 ),
	array( 'db' => 'reference_phone',     
		   'dt' => 6,
   		   'formatter' => function( $d, $row ) {
				if(is_null($d)){
		   			
		   			return "";
		   		}
		   		else{
		   			return "+880".$d;
		   		}
			} 
	),
	array(
		'db'        => 'order_date',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array( 'db' => 'product_name',     'dt' => 8 ),
	array( 'db' => 'stock_amount',     'dt' => 9 ),
	array( 'db' => 'product_amount',     'dt' => 10 ),
	array(
		'db'        => 'total',
		'dt'        => 11,
		'formatter' => function( $d, $row ) {
			return '৳ '.number_format($d);
		}
	),
	array(
		'db'        => 'comission_date_1',
		'dt'        => 12,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array(
		'db'        => 'comission_date_2',
		'dt'        => 13,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array(
		'db'        => 'comission_date_3',
		'dt'        => 14,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array( 'db' => 'comission_amount',     'dt' => 15 ),
	array(
		'db'        => 'payment_method',
		'dt'        => 16,
		'formatter' => function( $d, $row ) {
			if($d==0){
				return "Bkash";
			}
			else{
				return "Cash";
			}
		}
	),
	array(
		'db'        => 'delivery_date',
		'dt'        => 17,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array( 'db' => 'order_status',     
		   'dt' => 18,
		   'formatter' => function( $d, $row ) { 

		   		if($d==0){

		   			return "Accepted";

		   		}
		   		else if($d==1){

		   			return "Confirmed";

		   		}
		   		else if($d==2){

		   			return "Completed";

		   		}
		   		else if($d==3){

		   			return "Cancelled";

		   		}

			} 

	),
	array( 'db' => 'id',     
		   'dt' => 19,
		   'formatter' => function( $d, $row ) {

		   		$printInvoiceButton = "<button type='button' class='btn btn-block btn-primary btn-xs'><a href='print/print_order.php?id=".$d."' class='text-white'>Print Order</a></button>";

		   		return $printInvoiceButton;

			} 

	),

);

// SQL server connection information
$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASS,
	'db'   => DB_NAME,
	'host' => HOSTNAME
);

$whereResult = " order_status='2' "; // Completed
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

// echo json_encode(
// 	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
// );

$result=SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,$whereResult ); 
    $start=$_REQUEST['start']+1;
    $idx=0;
    foreach($result['data'] as &$res){
        $res[0]=(string)$start;
        $start++;
        $idx++;
    }
    echo json_encode($result);


