<?php 
	
	

include realpath('../db.php');

$id = $_POST['id']; 
$pd = $_POST['pd'];


$sql2 = "UPDATE order_table SET second_referral_payment='$pd' WHERE id='$id'";

if ($conn->query($sql2) === TRUE) {
   echo 1;
} 
else {
   echo 0;
}

	


 













?>