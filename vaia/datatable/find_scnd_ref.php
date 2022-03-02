<?php 
	
function find_second_reference($code){

	$path = realpath('./../../env.php');
	$db_con = new mysqli(HOSTNAME, DB_USER, DB_PASS,DB_NAME);
	$db_con->set_charset("utf8mb4");
	if ($db_con->connect_error) {
		die("Connection failed: " . $db_con->connect_error);
		$second_reference = false;
	}
	else{
	 	$sql2 = "SELECT * FROM order_table WHERE my_referral_code='$code'";
         
	    $result2 = $db_con->query($sql2);

	    if($result2->num_rows>0){
	      while ($row = $result2->fetch_assoc()) {
	          if(!is_null($row['reference_name']) && !is_null($row['reference_phone']) ){

	        $scnd_rfr_name = $row['reference_name'];
	        $scnd_rfr_phone = $row['reference_phone'];
	        $second_reference = array($scnd_rfr_name,$scnd_rfr_phone);
	      }
	      else{
	          $second_reference = false;
	        }
	      }
	    }
	    else{
	      $second_reference = false;
	    }

	    
	}

    return $second_reference;


}









?>