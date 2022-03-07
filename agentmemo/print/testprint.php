<?php 

function find_second_reference($db_con,$code){

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

    return $second_reference;


}



require realpath('../../db.php');

$input = "B01122";
$output = find_second_reference($conn,$input);

var_dump($output);








?>