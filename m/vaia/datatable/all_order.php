<?php


$path = realpath('./../../env.php');
$scnd_ref_path = realpath('./find_scnd_ref.php');

include $scnd_ref_path;
include  $path;  



// if(!@include("./../env.php")) throw new Exception("Failed to include 'script.php'"); 

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
	array( 'db' => 'references_code',     
		   'dt' => 7,
		   'formatter' => function( $d, $row ) {

		   		$sr = find_second_reference($d);

		   		if($sr){
		   			$sr_name = $sr[0];
		   			return $sr_name;
		   		}
		   		else{
		   			return null;
		   		}
		   	return $d;
		   		

			} 

	),
	array( 'db' => 'references_code',     
		   'dt' => 8,
		   'formatter' => function( $d, $row ) {

		   		$sr = find_second_reference($d);

		   		if($sr){
		   			$sr_phone = $sr[1];
		   			
		   			return "+880".$sr_phone;
		   		}
		   		else{
		   			return null;
		   		}
		   	return $d;
		   		

			} 

	),
	array(
		'db'        => 'order_date',
		'dt'        => 9,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array( 'db' => 'product_name',     'dt' => 10 ),
	array( 'db' => 'stock_amount',     'dt' => 11 ),
	array( 'db' => 'product_amount',     'dt' => 12 ),
	array(
		'db'        => 'total',
		'dt'        => 13,
		'formatter' => function( $d, $row ) {
			return '৳ '.number_format($d);
		}
	),
	array(
		'db'        => 'comission_date_1',
		'dt'        => 14,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array(
		'db'        => 'comission_date_2',
		'dt'        => 15,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array(
		'db'        => 'comission_date_3',
		'dt'        => 16,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array( 'db' => 'comission_amount',     'dt' => 17 ),
	array(
		'db'        => 'payment_method',
		'dt'        => 18,
		'formatter' => function( $d, $row ) {
			if($d==0){
				return "Cash";
			}
			else{
				return "Bkash";
			}
		}
	),
	array(
		'db'        => 'delivery_date',
		'dt'        => 19,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array( 'db' => 'order_status',     
		   'dt' => 20,
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

	)
	

);



$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASS,
	'db'   => DB_NAME,
	'host' => HOSTNAME
);



require( 'ssp.class.php' );


$result=SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns); 
    $start=$_REQUEST['start']+1;
    $idx=0;
    foreach($result['data'] as &$res){
        $res[0]=(string)$start;
        $start++;
        $idx++;
    }

    echo json_encode($result);
    


