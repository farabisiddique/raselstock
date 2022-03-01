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

  if(isset($_COOKIE["email"])){ 
      if(isset($_GET["id"])){
          $orderId = $_GET["id"];
          require realpath('../../db.php');
          $sql = "SELECT * FROM order_table WHERE id='$orderId'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $stock_holder_name = $row['customer_name'];
              $stock_holder_phone = $row['customer_phone'];
              $reference_name = $row['reference_name'];
              $reference_phone = $row['reference_phone'];
              $references_code = $row['references_code'];
              $sr = find_second_reference($conn,$references_code);
              if($sr){
                $sr_name = $sr[0];
                $sr_phone = $sr[1];
              }
              $stock_holder_bkash_no = $row['customer_bkash_no'];
              $stock_holder_address = $row['customer_address'];
              $stock_amount = $row['stock_amount'];
              $product_name = $row['product_name'];
              $brand_name = $row['brand_name'];
              $product_amount = $row['product_amount'];
              $product_ideal_amount = $row['product_ideal_amount'];
              $product_unit_price = $row['product_unit_price'];
              $order_date = $row['order_date'];
              $delivery_date = $row['delivery_date'];
              $payment_method = $row['payment_method'];
              $payment_description = $row['payment_description'];
              $capital_payment_description = $row['capital_payment_description'];
              $second_referral_payment = $row['second_referral_payment'];
              $order_status = $row['order_status'];
              $total = $row['total'];
              $invoice_no = $row['my_referral_code'];
              $product_amount = $row['product_amount'];
              $comission_date_1 = $row['comission_date_1'];
              $comission_date_2 = $row['comission_date_2'];
              $comission_date_3 = $row['comission_date_3'];
              $comission_percentage = $row['comission_percentage'];
              $referral_percentage = $row['referral_percentage'];
              $second_referral_percentage = $row['second_referral_percentage'];
              $stock_comission = $row['comission_amount'];
              $pay_prefix = $payment_description[0];
              $pay_suffix = $payment_description[1];

              if($order_status==0){
                $status = "Accepted";
              }
              else if($order_status==1){
                $status = "Confirmed";
              }
              else if($order_status==2){
                $status = "Completed";
              }
              else if($order_status==3){
                $status = "Cancelled";
              }

              if($payment_method==1){
                $payment_method = "বিকাশ";
              }
              else{
                $payment_method = "ক্যাশ";
              }


            }
          } 
      }
      else{
        header("location: ../index.php");
      }

      require('stock_agent_print.php');

      if(!empty($reference_name) && !empty($reference_phone)){ 
        $ref_name = $reference_name;
        $ref_phone = $reference_phone;
        $ref_comission = floor(($total*$referral_percentage)/100);
        require('reference_print.php');
      }

      if($sr){
        $second_ref_comission = floor(($total*$second_referral_percentage)/100);
        require('second_reference_print.php');
      }

      require('print_footer.php');        
 
}
else{
  
  header("location: ../index.php");
}

?>
