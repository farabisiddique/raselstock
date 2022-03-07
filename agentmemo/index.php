<?php
  
  function date_formatter($gimmeadate,$format='Y-m-d'){
      $date=date_create($gimmeadate);
      $formatted_date = date_format($date,$format);
      return $formatted_date;
  }


  function find_the_next_day($curdate,$days){
        
        $next_date = date('Y-m-d', strtotime("$curdate +$days days"));
        $next_date_day_find=getdate(strtotime($next_date));
        // $mydate=getdate(strtotime($curdate));

        switch($next_date_day_find['wday']){
            case 0: // sun
              $final_date = $next_date;
                break;
            case 1: // mon
              $final_date = $next_date;
                break;
            case 2: // tue
              $final_date = $next_date;
                break;
            case 3: // wed
              $final_date = $next_date;
                break;
            case 4: // thu
              $final_date = $next_date;               
                break;
            case 5: // fri
              $days = $days+1; 
              $final_date = date('Y-m-d', strtotime("$next_date +1 days"));
                break;
            case 6: // sat
              $final_date = $next_date;
                break;

        }

        return $final_date;

  }


  $comission_day_interval_show = 11;
  $comission_percentage = 16.67;
  $comission_percentage_2 = 3;
  $reference_percentage = 0.6;
  $how_many_comission_date = 6;
  $default_payment_method = 0;
  $main_product = "চাপাতা";
  $main_product_brand = "টুডে";
  $packet_per_stock = 40;
  $unit_price = 210;
  $amount_per_packet = "500 গ্রাম";

  if($default_payment_method==1){
    $payment_method = "বিকাশ";
  }
  else{
    $payment_method = "ক্যাশ";
  }
  
  $comission_day_interval = $comission_day_interval_show+1;
  

  $order_day = date('d-m-Y');

  $delivery_date = find_the_next_day($order_day,1);

  $comission_date_array = array($delivery_date);
  
  for($i=0;$i<$how_many_comission_date;$i++){
    $date_maker = find_the_next_day($comission_date_array[$i],$comission_day_interval);
    
    array_push($comission_date_array,$date_maker);
    
  }
  array_shift($comission_date_array);

  $din_array = array("১ম","২য়","৩য়","৪র্থ","৫ম","৬ষ্ঠ");
 

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <title>মেসার্স রাসেল এন্টারপ্রাইজ</title>

  </head>

  <body>

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
      
      <!-- <button type="button" class="btn btn-outline-dark" ><a href="index.php">হোম</a></button>
      <button type="button" class="btn btn-outline-dark"><a href="print.php">মেমো ডাউনলোড করুন </a> </button> -->
      
    </div>

  </div>




<div class="container">
  <div class="order">
    <p>ORDER DATE: <?php echo  $order_day; ?></p>
    <p>DELIVERY DATE: <?php echo  date_formatter($delivery_date,'d-m-Y'); ?></p>
  </div>
</div>

<div class="container">
  <div class="customer-form-box">
   <h3 style="text-align:center; color:black; padding-top: 3%;">এজেন্ট হোল্ডারের তথ্য</h3>

   <p class="text-center"><b>আপনার তথ্য দিয়ে অর্ডার Submit করুন</b></p>

   <form action="print/print_order.php" method="post">

      <label id="textdesign">নং :</label>

      <input type="text" id="field" placeholder="মেমো নাম্বার  দিন" required="1" name="memo_no">
     
      <label id="textdesign">এজেন্ট হোল্ডারের নাম :</label>

      <input type="text" id="field" placeholder="এখানে নাম লিখুন..." required="1" name="agent_holder_name">

      <label id="textdesign">মোবাইল নাম্বার :</label>

      <input type="text" id="field" placeholder="মোবাইল নাম্বার দিন" required="1" name="agent_holder_phone">

      <label id="textdesign">এন আই ডি নম্বর :</label>

      <input type="text" id="field" placeholder="এন আই ডি নম্বর দিন" name="nid_no">

      <label id="textdesign">এজেন্ট অফিস:</label>

      <select name="agent_office" id="field">
        <option value="আফতাব বিবির হাট">আফতাব বিবির হাট</option>
        <option value="বক্তারমুন্সী">বক্তারমুন্সী</option>
        <option value="একাডেমী">একাডেমী</option>
        <option value="রানীরহাট">রানীরহাট</option>
      </select>

      <label id="textdesign">এজেন্ট সংখ্যা  :</label>

     <input type="number" id="field" placeholder="এজেন্ট সংখ্যা  দিন " required="1" class="stock_amount" pattern="[0-9]+" name="stock_amount" min="1">

     <label id="textdesign">প্রতিনিধির নামঃ </label>

    <input type="text" id="field" placeholder="প্রতিনিধির নাম দিন" name="reference_name">

    <label id="textdesign">প্রতিনিধির মোবাইল নাম্বার :</label>

      <input type="text" id="field" placeholder="প্রতিনিধির মোবাইল নাম্বার দিন" name="reference_phone">


          
           
       </div>

     

     

   

 </div>

<div class="container">

	<div id="tablesize">

		<h3 style="text-align:center; color:black; padding-top: 3%;">অর্ডার  তথ্য</h3>


	<table class="table table-hover">
  <thead class="text-center">
    <tr class="table-info">
	  <th scope="col">নং</th> 
      <th scope="col">বিবরণ</th>
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
       <td>মোট</td> 
       <td class="total" id="totaltaka"></td>
    </tr>
  </tbody>
</table>



<h3 style="text-align:center; color:black; padding-top: 3%;">কমিশন তথ্য</h3>

<table class="table table-hover">
  <thead class="text-center">
    <tr class="table-info">
	  <th scope="col">দিন</th> 
      <th scope="col">প্রতি <?php echo $comission_day_interval_show; ?>তম দিনে পুঁজি ফেরত মোট মূল্যের  <?php echo $comission_percentage; ?>%</th>
      <th scope="col">প্রতি <?php echo $comission_day_interval_show; ?>তম দিনে কমিশন প্রদান মোট মূল্যের <?php echo $comission_percentage_2; ?>%</th>

      
      
      <th scope="col">প্রতি <?php echo $comission_day_interval_show; ?>তম দিনে কমিশন প্রদান মোট মূল্যের <?php echo $reference_percentage; ?>%</th>
      <th scope="col">পেমেন্ট তারিখ</th>
      
    </tr>
  </thead>
  <tbody class="text-center">

   

    <?php  


      for($i=0;$i<$how_many_comission_date;$i++){

        echo "<tr class='tables_row'>";
        echo "<td>".$din_array[$i]."&nbsp;১১তম দিন</td>";
        echo "<td class='comission_amount'>0</td>";
        echo "<td class='comission_amount_2'>&nbsp;</td>";
        echo "<td class='reference_amount'>0</td>";
        echo "<td>".date_formatter($comission_date_array[$i],'d-m-Y')."</td>";

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

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/stock_calculate.js"></script>

    <script type="text/javascript">

          var stock_amount = $(".stock_amount").val();
          var packet_per_stock = '<?php echo $packet_per_stock; ?>';
          var unit_price = '<?php echo $unit_price; ?>';
          var percent = '<?php echo $comission_percentage; ?>';
          var comission_percentage_2 = '<?php echo $comission_percentage_2; ?>';
          var reference_percent = '<?php echo $reference_percentage; ?>';
          
          var product_amount = stock_amount*parseInt(packet_per_stock);
          var total_amount = product_amount*parseInt(unit_price);
          var comission_amount = parseInt((total_amount*percent)/100);
          var comission_amount_2 = parseInt((total_amount*comission_percentage_2)/100);
          var reference_amount = parseInt((total_amount*reference_percent)/100);
          var number_of_day = $('.tables_row').length;

          $(".product_amount").html(product_amount);
          $(".total").html(total_amount);
          $(".comission_amount").html(comission_amount);
          
          for(var i=0;i<number_of_day;i++){

            if(i>=number_of_day/2){
              $(".comission_amount_2").eq(i).html(comission_amount_2/2);
              $(".reference_amount").eq(i).html(reference_amount/2);
            }
            else{
              $(".comission_amount_2").eq(i).html(comission_amount_2);
              $(".reference_amount").eq(i).html(reference_amount);
            }
            
          }
          
          
          

        $(".stock_amount").keyup(function(){ 

          var stock_amount = $(".stock_amount").val();
          var packet_per_stock = '<?php echo $packet_per_stock; ?>';
          var unit_price = '<?php echo $unit_price; ?>';
          var percent = '<?php echo $comission_percentage; ?>';
          var comission_percentage_2 = '<?php echo $comission_percentage_2; ?>';
          var reference_percent = '<?php echo $reference_percentage; ?>';
          
          var product_amount = stock_amount*parseInt(packet_per_stock);
          var total_amount = product_amount*parseInt(unit_price);
          var comission_amount = parseInt((total_amount*percent)/100);
          var comission_amount_2 = parseInt((total_amount*comission_percentage_2)/100);
          var reference_amount = parseInt((total_amount*reference_percent)/100);
          var number_of_day = $('.tables_row').length;

          $(".product_amount").html(product_amount);
          $(".total").html(total_amount);
          $(".comission_amount").html(comission_amount);
          
          for(var i=0;i<number_of_day;i++){

            if(i>=number_of_day/2){
              $(".comission_amount_2").eq(i).html(comission_amount_2/2);
              $(".reference_amount").eq(i).html(reference_amount/2);
            }
            else{
              $(".comission_amount_2").eq(i).html(comission_amount_2);
              $(".reference_amount").eq(i).html(reference_amount);
            }
            
          }
        });


    </script>
  
  </body>
</html>

