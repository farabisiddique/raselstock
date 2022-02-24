<?php
	
	if(isset($_COOKIE["email"]))
	{
		require(realpath('../db.php'));

		$order_id = $_GET['id']; 

		$sql = "UPDATE order_table SET order_status=2 WHERE id='$order_id'";

		if ($conn->query($sql) === TRUE) {
		   header("location: accepted.php?mcomp=1");
		} else {
		  echo "Error updating record: " . $conn->error;
		}
	}
	else{
	  header("location:index.php");
	}






?>