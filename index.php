<?php

 function after_date_maker($input_date,$interval,$how_many){
      
      $date_array = array();

      for($i=1;$i<=$how_many;$i++){

          $date=date_create($input_date);

          date_add($date,date_interval_create_from_date_string("".($interval*$i)." days"));
          $after_date = date_format($date,"d-m-Y"); 

          array_push($date_array, $after_date);

      }

      return $date_array;
  }

  function date_formatter($gimmeadate,$format='Y-m-d'){
      $date=date_create($gimmeadate);
      $formatted_date = date_format($date,$format);
      return $formatted_date;
  }


  function reference_finder($r_code,$conn){

     
      $sql = "SELECT * FROM order_table WHERE my_referral_code='".$r_code."'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) { 
          while($row = $result->fetch_assoc()) {

            $r_name = $row['customer_name'];
            $r_phone = $row['customer_phone'];  
            $r_bkash_no = $row['customer_bkash_no'];
          }
          return array($r_name,$r_phone);
      }
      else{
        return false;
      }
  }

 

  function refmake($c,$digits=3){
      $today = date('Y-m-d');
      $this_month = date("m");
      $this_year = date("Y");
      $start_date = $this_year."-".$this_month."-"."01";
      $end_date = date("Y-m-t", strtotime($today));
      $sql = "SELECT COUNT(id) FROM order_table WHERE order_date BETWEEN '$start_date' AND '$end_date'";
      $result = $c->query($sql)->fetch_assoc();
      $number_in_refcode = (int)$result["COUNT(id)"]+2;
      $formatted_no = sprintf("%0".$digits."d", $number_in_refcode);
      $code_array = range('A', 'L');
      $code_array_index = (int)date('n');
      $final_code = $code_array[$code_array_index-1].$formatted_no.date('y');
      return $final_code;
  }

  include 'db.php';

  $sql = "SELECT * FROM admin_settings"; 
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
      
      
      $comission_day_interval_show = $row['comission_interval'];
      $comission_percentage = $row['comission_percentage'];
      $reference_percentage = $row['reference_percentage'];
      $how_many_comission_date = $row['comission_date_number'];
      $default_payment_method = $row['default_payment_method'];
      $main_product = $row['main_product'];
      $main_product_brand = $row['main_product_brand'];
      $packet_per_stock = $row['packet_per_stock'];
      $unit_price = $row['unit_price'];
      $amount_per_packet = $row['amount_per_packet'];


    }

  } 




  if($default_payment_method==1){
    $payment_method = "বিকাশ";
  }
  else{
    $payment_method = "ক্যাশ";
  }
  
  $comission_day_interval = $comission_day_interval_show+1;
  
  $today = date('');


  $order_day = date('d-m-Y');

  $delivery_date_array = after_date_maker($today,1,1);


  $comission_date_array = after_date_maker($delivery_date_array[0],$comission_day_interval,$how_many_comission_date);

 



  if(isset($_POST['submit'])){
        
      if(!empty($_POST['reference_code'])){  // Reference code deya hoise

          
          $refcode = strtoupper(trim($_POST['reference_code']));

          if(reference_finder($refcode,$conn)=== FALSE){
                   // Reference Code wrong
          }
          else{    // Reference Code Right
              $reference_array = reference_finder($refcode,$conn);
              $customer_name = $_POST['customer_name'];
              $customer_phone = $_POST['customer_phone'];
              $customer_bkash_no = $_POST['customer_bkash_no'];
              $customer_address = $_POST['home_or_village'].",".$_POST['municipality'].",".$_POST['upazilla'].", ফেনী।";
              $order_date = date_formatter($order_day);
              $my_referral_code = refmake($conn);
              $reference_name = $reference_array[0];
              $reference_phone = $reference_array[1];
              $stock_amount = $_POST['stock_amount'];
              $product_name = $main_product;
              $brand_name = $main_product_brand;
              $product_amount = $stock_amount*$packet_per_stock;
              $product_ideal_amount = $amount_per_packet;
              $product_unit_price = $unit_price;
              $total = $product_amount*$unit_price;
              $comission_date_1 = date_formatter($comission_date_array[0]);
              $comission_date_2 = date_formatter($comission_date_array[1]);
              $comission_date_3 = date_formatter($comission_date_array[2]);
              $comission_amount = ($total*$comission_percentage)/100;
              $payment_method_for_order = $default_payment_method;
              $order_status = 0;
              $delivery_date = date_formatter($delivery_date_array[0]);
              $invoice_number = $my_referral_code;


              $sql = "INSERT INTO order_table (customer_name, customer_phone,customer_bkash_no, customer_address,order_date,my_referral_code,reference_name, reference_phone, stock_amount, product_name, brand_name,product_amount,product_ideal_amount,product_unit_price, total, comission_date_1, comission_date_2, comission_date_3,comission_percentage ,referral_percentage,comission_amount, payment_method,payment_description ,delivery_date, order_status, invoice_number )
              VALUES ('$customer_name', '$customer_phone','$customer_bkash_no','$customer_address','$order_date','$my_referral_code','$reference_name','$reference_phone','$stock_amount','$product_name','$main_product_brand','$product_amount','$product_ideal_amount','$unit_price','$total','$comission_date_1','$comission_date_2','$comission_date_3','$comission_percentage' ,'$reference_percentage','$comission_amount','$payment_method_for_order','00','$delivery_date','0','$invoice_number' )";

                // die(var_dump($sql));

                if ($conn->query($sql) === TRUE) {
                  header('location: print.php?m=1');
                } else {
                  header('location: print.php?m=2');
                }

          }

      }
      else{       // Reference code deya Hoy nai
                
              $customer_name = $_POST['customer_name'];
              $customer_phone = $_POST['customer_phone']; 
              $customer_bkash_no = $_POST['customer_bkash_no'];
              $customer_address = $_POST['home_or_village'].",".$_POST['municipality'].",".$_POST['upazilla'].", ফেনী।";
              $order_date = date_formatter($order_day);
              $my_referral_code = refmake($conn);
              $stock_amount = $_POST['stock_amount'];
              $product_name = $main_product;
              $brand_name = $main_product_brand;
              $product_amount = $stock_amount*$packet_per_stock;
              $product_ideal_amount = $amount_per_packet;
              $product_unit_price = $unit_price;
              $total = $product_amount*$unit_price;
              $comission_date_1 = date_formatter($comission_date_array[0]);
              $comission_date_2 = date_formatter($comission_date_array[1]);
              $comission_date_3 = date_formatter($comission_date_array[2]);
              $comission_amount = ($total*$comission_percentage)/100;
              $payment_method_for_order = $default_payment_method;
              $order_status = 0;
              $delivery_date = date_formatter($delivery_date_array[0]);
              $invoice_number = $my_referral_code;

              $sql = "INSERT INTO order_table (customer_name, customer_phone,customer_bkash_no ,customer_address,order_date, my_referral_code, stock_amount, product_name,brand_name, product_amount,product_ideal_amount,product_unit_price,total, comission_date_1, comission_date_2, comission_date_3, comission_percentage ,referral_percentage, comission_amount, payment_method,payment_description, delivery_date, order_status, invoice_number )
              VALUES ('$customer_name', '$customer_phone','$customer_bkash_no' ,'$customer_address','$order_date','$my_referral_code','$stock_amount','$product_name','$main_product_brand','$product_amount','$product_ideal_amount','$product_unit_price','$total','$comission_date_1','$comission_date_2','$comission_date_3','$comission_percentage' ,'$reference_percentage','$comission_amount','$payment_method_for_order','00','$delivery_date','0','$invoice_number' )";

                
              if ($conn->query($sql) === TRUE) {
                header('location: ./print.php?m=1');
                
              } else {
                header('location: print.php?m=2');
              }

      }
      


  }
  else{

  

 

  


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <title>মেসার্স রাসেল এন্টারপ্রাইজ</title>

  </head>

  <body>

  <!-------- BRAND NAME & ADDRESS--------->

  <div class="container" >
  
  <div class="brand">

  <h1> মেসার্স রাসেল এন্টারপ্রাইজ </h1>

  <h2>নিত্য প্রয়োজনীয় পণ্যের কমিশন এজেন্ট</h2>

  <h4> ০১৬২৭-৭২০৩৭১ ০১৯৪০-৭৫৭১০৬ </h4>

  <h4>আব্দুল জাব্বার মার্কেট, ঢাকা-চট্রগ্রাম মহাসড়ক সংলগ্ন, রামপুর রাস্তার মাথায়, ফেনী সদর, ফেনী</h4>
    
  </div>

</div>



  <div class="container">
    <div class="menu">
      
      <button type="button" class="btn btn-outline-dark" ><a href="index.php">হোম</a></button>
      <button type="button" class="btn btn-outline-dark"><a href="print.php">মেমো ডাউনলোড করুন </a> </button>
      
    </div>

  </div>




<div class="container">
  <div class="order">
    <p>ORDER DATE: <?php echo  $order_day; ?></p>
  </div>
</div>

<div class="container">
  <div class="customer-form-box">
   <h3 style="text-align:center; color:black; padding-top: 3%;">স্টক হোল্ডারের তথ্য</h3>

   <p class="text-center"><b>আপনার তথ্য দিয়ে অর্ডার Submit করুন</b></p>

   <form action="index.php" method="post">
     
      <label id="textdesign">স্টক হোল্ডারের নাম :</label>

      <input type="text" id="field" placeholder="এখানে নাম লিখুন..." required="1" name="customer_name">

      <label id="textdesign">মোবাইল নাম্বার :</label>

      <input type="number" id="field" placeholder="মোবাইল নাম্বার দিন" required="1" name="customer_phone">

      <label id="textdesign">স্টক হোল্ডারের বিকাশ (পার্সোনাল)  নম্বর:</label>

      <input type="number" id="field" placeholder="বিকাশ (পার্সোনাল) নম্বর দিন" name="customer_bkash_no">
      

      <h3 class="mt-4">ঠিকানা</h3>

      <label id="textdesign">বাসা/গ্রামঃ </label>
      <input type="text" id="field" placeholder="বাসা/গ্রাম লিখুন..." required="1" name="home_or_village">

      <label id="textdesign">পৌরসভা/ইউনিয়নঃ  </label>
      <input type="text" id="field" placeholder="পৌরসভা/ইউনিয়ন লিখুন..." required="1" name="municipality">

      <label id="textdesign">উপজেলাঃ </label>
      <input type="text" id="field" placeholder="উপজেলা লিখুন..." required="1" name="upazilla">



      <label id="textdesign">রেফারেন্সের কোড (যদি থাকে):</label>

      <input type="text" id="field" placeholder="রেফারেন্সের কোড লিখুন..."  name="reference_code"  class="reference_code">

       <div class="reference_code_error alert alert-success" role="alert" style="display: none;">


          
           
       </div>

     

     <label id="textdesign">স্টক সংখ্যা  :</label>

     <input type="number" id="field" placeholder="স্টক সংখ্যা  দিন " required="1" class="stock_amount" pattern="[0-9]+" name="stock_amount" min="1">

   

 </div>

<div class="container">

	<div id="tablesize">

		<h3 style="text-align:center; color:black; padding-top: 3%;">অর্ডার  তথ্য</h3>


	<table class="table table-hover">
  <thead class="text-center">
    <tr class="table-info">
	  <th scope="col">নং</th> 
      <th scope="col">বিবরণ</th>
      <th scope="col">ব্র্যান্ড</th>
      <th scope="col">পরিমাণ ( প্যাকেট )  </th>
      <th>কেজি/গ্রাম</th>
      <th scope="col">দর</th>
      <th scope="col">টাকা</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <tr>
      <td>০১</td>
	    <td><?php  echo $main_product; ?> </td>
      <td class="brand_name"><?php echo $main_product_brand; ?></td>
      <td class="product_amount">0</td>
      <td><?php echo $amount_per_packet; ?></td>
      <td class="unit_price"><?php echo $unit_price; ?>&nbsp;টাকা</td>
      <td class="total">0</td>
    </tr>

    <tr id="bold"> 
	     <td></td>
	     <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td>মোট</td> 
       <td class="total" id="totaltaka"></td>
    </tr>
  </tbody>
</table>



<h3 style="text-align:center; color:black; padding-top: 3%;">কমিশন তথ্য</h3>

<table class="table table-hover">
  <thead class="text-center">
    <tr class="table-info">
	  <th scope="col">নং</th> 
      <th scope="col">স্টক কমিশন প্রদানের তারিখ </th>
      <th scope="col">স্টক কমিশন, প্রতি <?php echo $comission_day_interval_show; ?> দিনে <?php echo $comission_percentage; ?>%</th>

      <th scope="col">প্রতিনিধি(রেফারেন্স)  কমিশন, প্রতি  <?php echo $comission_day_interval_show; ?> দিনে <?php echo $reference_percentage; ?>%</th>
      <th scope="col">পেমেন্ট পদ্ধতি</th>
      
    </tr>
  </thead>
  <tbody class="text-center">

   

    <?php  

      for($i=0;$i<$how_many_comission_date;$i++){

        echo "<tr>";

        echo "<td>".($i+1)."</td>";

        echo "<td>".$comission_date_array[$i]."</td>";

        echo "<td class='comission_amount'>0</td>";

        echo "<td class='reference_amount'>0</td>";

        echo "<td>".$payment_method."</td>";

        echo "</tr>";

      }

    ?>

   

    

  </tbody>
</table>

 <input type="submit" value="অর্ডার Submit করুন" id="submit" name="submit">
</form>




	</div>

</div>



<div class="container">
  <div class="footer">
      <p>সর্বস্বত্ব সংরক্ষিত &copy; ২০২২<a href="./index.php">মেসার্স রাসেল এন্টারপ্রাইজ </a></p> 

     <!--  <p>Designed and Developed By: <a href="index.php">Bari Siddique Computers</a></p> -->   
  </div>
</div>
    

  
    <!--jQuery Link--->

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/stock_calculate.js"></script>

    <script type="text/javascript">

          var stock_amount = $(".stock_amount").val();
          var packet_per_stock = '<?php echo $packet_per_stock; ?>';
          var unit_price = '<?php echo $unit_price; ?>';
          var percent = '<?php echo $comission_percentage; ?>';
          var reference_percent = '<?php echo $reference_percentage; ?>';
          var product_amount = stock_amount*parseInt(packet_per_stock);
          var total_amount = product_amount*parseInt(unit_price);
          var comission_amount = (total_amount*parseInt(percent))/100;
          var reference_amount = (total_amount*parseInt(reference_percent))/100;

          $(".product_amount").html(product_amount);
          $(".total").html(total_amount);
          $(".comission_amount").html(comission_amount);
          $(".reference_amount").html(reference_amount);

        $(".stock_amount").keyup(function(){ 

          var stock_amount = $(".stock_amount").val();
          var packet_per_stock = '<?php echo $packet_per_stock; ?>';
          var unit_price = '<?php echo $unit_price; ?>';
          var percent = '<?php echo $comission_percentage; ?>';
          var reference_percent = '<?php echo $reference_percentage; ?>';
          var product_amount = stock_amount*parseInt(packet_per_stock);
          var total_amount = product_amount*parseInt(unit_price);
          var comission_amount = (total_amount*parseInt(percent))/100;
          var reference_amount = (total_amount*parseInt(reference_percent))/100;

          $(".product_amount").html(product_amount);
          $(".total").html(total_amount);
          $(".comission_amount").html(comission_amount);
          $(".reference_amount").html(reference_amount);
        });


        $(".reference_code").keyup(function(){

            var inputted_code = $(".reference_code").val();
            var refcode = inputted_code.trim();
            
            if(!refcode){
              $(".reference_code_error").hide();
              $("#submit").removeAttr("type");
              $("#submit").attr("type","submit");
            }
            else{
              $.ajax({
                      method: "POST",
                      url: "check_ref_code.php",
                      async:false,
                      data: {refcode: refcode},
                      success: function(msg) {
          
                          if(msg==0){

                            $("#submit").removeAttr("type");
                            $(".reference_code_error").removeClass("alert-success");
                            $(".reference_code_error").addClass("alert-danger");
                            $(".reference_code_error").show();
                            $(".reference_code_error").html("রেফারেন্স কোড পাওয়া যায় নি। সঠিক কোড টাইপ করতে থাকুন। ");
                            
                          }
                          else{
                            
                            $("#submit").attr("type","submit");
                            $(".reference_code_error").removeClass("alert-danger");
                            $(".reference_code_error").addClass("alert-success");
                            $(".reference_code_error").show();
                            $(".reference_code_error").html("রেফারেন্স কোড পাওয়া গেছে। ");
                          }

                   }
                 });

            }

        });
    </script>
  
  </body>
</html>

<?php 
  
  }

?>