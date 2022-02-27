<?php 
	
include realpath('../db.php');

$id = $_POST['id']; 

	
$sql2 = "UPDATE order_table SET capital_payment_description=1  WHERE id='$id'";

if ($conn->query($sql2) === TRUE) {
   echo 1;
} 
else {
   echo 0;
}
 




?>