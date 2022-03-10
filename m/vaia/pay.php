<?php 
	
	

include realpath('../db.php');

$id = $_POST['id']; 
$pd = $_POST['pd'];
$comission_type = $_POST['type'];

$sql = "SELECT payment_description FROM order_table WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
	while ($row = $result->fetch_assoc()) {
		$current_pd = $row['payment_description'];
	}

	$current_pd[$comission_type] = $pd;
	$new_pd = $current_pd;

	$sql2 = "UPDATE order_table SET payment_description='$new_pd' WHERE id='$id'";


	if ($conn->query($sql2) === TRUE) {
	   echo 1;
	} 
	else {
	   echo 0;
	}

	

}
else{
	echo 0;
} 













?>