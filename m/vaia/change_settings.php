<?php
  
  
if(isset($_COOKIE["email"]))
{
      require(realpath('../db.php'));

   
      $settings_id = $_POST['settings_id'];
      $comission_day_interval_show = $_POST['comission_day_interval_show'];
      $comission_percentage = $_POST['comission_percentage'];
      $reference_percentage = $_POST['reference_percentage'];
      $second_reference_percentage = $_POST['second_reference_percentage'];
      // $how_many_comission_date = $_POST['comission_date_number'];
      $default_payment_method = $_POST['default_payment_method'];
      $main_product = $_POST['main_product'];
      $main_product_brand = $_POST['main_product_brand'];
      $packet_per_stock = $_POST['packet_per_stock'];
      $unit_price = $_POST['unit_price'];
      $amount_per_packet = $_POST['amount_per_packet'];

      $sql = "UPDATE admin_settings SET comission_interval='$comission_day_interval_show',comission_percentage='$comission_percentage',reference_percentage='$reference_percentage',second_reference_percentage='$second_reference_percentage',default_payment_method='$default_payment_method',main_product='$main_product',main_product_brand='$main_product_brand',packet_per_stock='$packet_per_stock',unit_price='$unit_price',amount_per_packet='$amount_per_packet' WHERE settings_id='$settings_id'";

      if ($conn->query($sql) === TRUE) {

       header("location: settings.php");

      } else {

        echo "Error updating record: " . $conn->error;

      }
      


}
else{
  header("location:index.php");
}




?>