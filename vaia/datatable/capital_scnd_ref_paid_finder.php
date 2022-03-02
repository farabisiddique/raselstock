<?php 

function capital_scnd_ref_paid_finder($id){
	$cs = array();
	$path = realpath('./../../env.php');
	$db_con = new mysqli(HOSTNAME, DB_USER, DB_PASS,DB_NAME);
	$db_con->set_charset("utf8mb4");
	if ($db_con->connect_error) {
		die("Connection failed: " . $db_con->connect_error);
		
	}
	else{
		$sql2 = "SELECT * FROM order_table WHERE id='$id'";
         
	    $result2 = $db_con->query($sql2);

	    if($result2->num_rows>0){
	      while ($row = $result2->fetch_assoc()) {
	      		$capital_status = $row['capital_payment_description'];
	      		$scnd_ref_status = $row['second_referral_payment'];
	      }
	  	}
	  	else{
	  		$capital_status = 0;
	  		$scnd_ref_status = 0;
	  	}

	  	$cs = array($capital_status,$scnd_ref_status);
	}

	return $cs;
}








?>