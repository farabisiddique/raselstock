<?php


$path = realpath('./../../env.php');
$scnd_ref_path = realpath('./find_scnd_ref.php');

$capital_scnd_ref_paid_finder_path = realpath('./capital_scnd_ref_paid_finder.php');

include $capital_scnd_ref_paid_finder_path;
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
	array( 'db' => 'customer_address',   'dt' => 3 ),
	array( 'db' => 'reference_name',     'dt' => 4 ),
	array( 'db' => 'reference_phone',     
		   'dt' => 5,
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
		   'dt' => 6,
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
		   'dt' => 7,
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
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array( 'db' => 'product_name',     'dt' => 9 ),
	array( 'db' => 'stock_amount',     'dt' => 10 ),
	array( 'db' => 'product_amount',     'dt' => 11 ),
	array(
		'db'        => 'total',
		'dt'        => 12,
		'formatter' => function( $d, $row ) {
			return '৳ '.number_format($d);
		}
	),
	array(
		'db'        => 'comission_date_1',
		'dt'        => 13,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array(
		'db'        => 'comission_date_2',
		'dt'        => 14,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array(
		'db'        => 'comission_date_3',
		'dt'        => 15,
		'formatter' => function( $d, $row ) {
			return date( 'l, jS M, y', strtotime($d));
		}
	),
	array( 'db' => 'comission_amount',     'dt' => 16 ),
	array(
		'db'        => 'payment_description',
		'dt'        => 17,
		'formatter' => function( $d, $row ) {
			$pay_preffix = $d[0];
			$pay_suffix = $d[1];

			switch ($pay_preffix) {
				case '1':
					$comission_stat = "<p class='comission_stat1'>1st Stock Comission Paid</p>";
					break;
				case '2':
					$comission_stat = "<p class='comission_stat2'>1st and 2nd Stock Comission Paid</p>";
					break;
				case '3':
					$comission_stat = "<p class='comission_stat3'>All Stock Comission Paid</p>";
					break;
				default:
					$comission_stat = "&nbsp;";
					break;
			}

			switch ($pay_suffix) {
				case '1':
					$ref_stat = "<p class='ref_stat1'>1st Reference Comission Paid</p>";
					break;
				case '2':
					$ref_stat = "<p class='ref_stat2'>1st and 2nd Reference Comission Paid</p>";
					break;
				case '3':
					$ref_stat = "<p class='ref_stat3'>All Reference Comission Paid</p>";
					break;
				default:
					$ref_stat = "";
					break;
			}

			return $comission_stat."<br>".$ref_stat;
		}
	),
	array(
		'db'        => 'id',
		'dt'        => 18,
		'formatter' => function( $d, $row ) {
			$cs = capital_scnd_ref_paid_finder($d);
			$capital_status = $cs[0];
			$scnd_ref_status = $cs[1];

			if($capital_status==1){
				$capital_stat = "<p class='ref_stat1'>Capital Paid</p><br>";
			}
			else{
				$capital_stat = "";
			}

			switch ($scnd_ref_status) {
				case 1:
					$scnd_ref_stat = "<p class='ref_stat1'>1st Second Reference Comission Paid</p>";
					break;
				case 2:
					$scnd_ref_stat = "<p class='ref_stat2'>1st and 2nd Second Reference Comission Paid</p>";
					break;
				case 3:
					$scnd_ref_stat = "<p class='ref_stat3'>All Second Reference Comission Paid</p>";
					break;
				default:
					$scnd_ref_stat = "";
					break;
			}

			return $capital_stat.$scnd_ref_stat;
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

$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASS,
	'db'   => DB_NAME,
	'host' => HOSTNAME
);

$whereResult = " order_status='2' AND payment_description!='00' "; // Accepted
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
    


