<?php 
	
	if(isset($_POST['refcode'])){

			include 'db.php';

			$ref_code = $_POST['refcode'];
			$sql = "SELECT * FROM order_table WHERE my_referral_code='".$ref_code."'";
			$result = $conn->query($sql);



			if ($result->num_rows > 0) {
				
				echo 1;

			}
			else{
				echo 0;
			} 



	}










?>