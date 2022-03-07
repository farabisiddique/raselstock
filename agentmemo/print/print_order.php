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
      if(isset($_POST["submit"])){
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
          $amount_per_packet = "৫০০ গ্রাম";

          $memo_no = $_POST['memo_no'];
          $agent_holder_name = $_POST['agent_holder_name'];
          $agent_holder_phone = $_POST['agent_holder_phone'];
          $nid_no = $_POST['nid_no'];
          $agent_office = $_POST['agent_office'];
          $stock_amount = (int)$_POST['stock_amount'];
          $reference_name = $_POST['reference_name'];
          $reference_phone = $_POST['reference_phone'];



          $product_amount =$stock_amount*$packet_per_stock;
          $total = $product_amount*$unit_price;

          $comission_amount = (int)($total*$comission_percentage/100);
          $comission_amount_2 = (int)($total*$comission_percentage_2/100);
          $reference_comission_amount = (int)($total*$reference_percentage/100);
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






      }
      
?>

<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>এজেন্ট মেমো</title>
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body >


<?php

      $total_page = 4;
      for($p=0;$p<$total_page;$p++){

        require('stock_agent_print.php');
        echo "<p class='cut_line'>&#9986;------&#9986;------&#9986;------&#9986;------&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;----&#9986;</p>";
        

        if(!empty($reference_name)){
          require('reference_print.php');
          echo "<div class='pagebreak'></div>";
        }

      }
        
      require('print_footer.php');        
 


?>
