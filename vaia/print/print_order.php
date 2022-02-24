<?php  

  if(isset($_COOKIE["email"])){ 

      if(isset($_GET["id"])){

          $orderId = $_GET["id"];
          require realpath('../../db.php');

          $sql = "SELECT * FROM order_table WHERE id='$orderId'";
         
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row

            while($row = $result->fetch_assoc()) {
              
              $stock_holder_name = $row['customer_name'];
              $stock_holder_phone = $row['customer_phone'];
              $reference_name = $row['reference_name'];
              $reference_phone = $row['reference_phone'];
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
              $order_status = $row['order_status'];
              $total = $row['total'];
              $invoice_no = $row['my_referral_code'];
              $product_amount = $row['product_amount'];
              $comission_date_1 = $row['comission_date_1'];
              $comission_date_2 = $row['comission_date_2'];
              $comission_date_3 = $row['comission_date_3'];
              $comission_percentage = $row['comission_percentage'];
              $referral_percentage = $row['referral_percentage'];
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
        $hello_hacker = realpath('../../index.php');

        // die(var_dump($hello_hacker));

        header("location:".$hello_hacker);
      }




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>স্টক এজেন্ট মেমো</title>

  <style>

    
    @page {
        margin: 0px;
    }

    @media print {
      .pagebreak { page-break-before: always; } /* page-break-after works, as well */   

    }
    *{
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
      font-weight: bold;
      color: blue;
      border-color: blue;
    }
   .raselbg{
        background-image: url('raselbg.png');
        /* background-position: bottom; */
        background-position-x: center;
        background-repeat: no-repeat;
        background-position-y: 95%;
        /*background-size: 700px;*/
        background-size: 900px 239px;
        print-color-adjust: exact;
        color-adjust: exact;
        -webkit-print-color-adjust: exact;
        z-index: 99;

      }
    .main{
      width: 100%;
      height: 500px;
      /*background-color: green;*/
      
    }
    .middle{
      width: 95%;
      height: 100%;
      /*background-color: green;*/
      margin: auto; 
    }
    .topname{
      width: 100%;
      height: 38%;
      text-align: center;
      margin-bottom: 1%;
      line-height: 0.8;
      padding-top: 0.1%;
      /*background-color: pink;*/
    }
    .topname h1{
      font-size: 30px;
    }
    .topname h2{
      font-size: 18px;
    }
    .topname h3{
      font-size: 15px;
    }
    .narrow_height{
      line-height: 0.7;
    }
    .memoname{
      text-align: center;
      border: 3px solid green;
      border-radius: 35px;
      padding: 0.5%;
      font-weight: bold;
      padding-left: 20px;
      padding-right: 20px;
      font-size: 20px;
    }
    .holder_info{
      width: 100%;
      height: 24%;
      line-height: 0.7;
    }

    .holder_info_part{
      width: 50%;
      height: 100%;
      float: left;
    }
    .holder_info_part1{
      width: 48%;
      height: 100%;
      float: left;
      text-align: right;
    }
    .holder_info_part2{
      width: 50%;
      height: 100%;
      float: left;
      text-align: right;
    }
    .buy_date_h{
      text-align: right;
    }
    .first_table{
      width: 100%;
      height: 15%;
      text-align: center;
    }
    .second_table{
      width: 100%;
      height: 18%;
      text-align: center;
    }
    table,th,tr,td{
      border: 2px solid blue;
      border-collapse: collapse;
      text-align: center;
      line-height: 1.4;
    }
    table{
      width: 100%;
    }
    .maintable td:nth-child(n){
      width: 30px;
    }
    .maintable td:nth-child(2n){
      width: 70px;
    }
    .maintable td:nth-child(3n){
      width: 70px;
    }
    .maintable td:nth-child(6n){
      width: 100px;
    }
    .maintable td:nth-child(7n){
      width: 100px;
    }
    span{
      font-weight: bolder;
      color: blue;
    }
    .disclaimer{
      text-align: center;
    }

    .cut_line{
      margin-top: 20px;
      text-align: center;
    }



  </style>
 
</head>
<body >

  <div class="main raselbg">

    <div class="middle">
      <div class="topname">
        <h1 class="narrow_height" style="color: blue;"> মেসার্স রাসেল এন্টারপ্রাইজ </h1>

        <h2 class="narrow_height" style="color: red;">নিত্য প্রয়োজনীয় পণ্যের কমিশন এজেন্ট</h2>

        <h3 class="narrow_height" style="color: green; font-size: 18px;"> ০১৬২৭-৭২০৩৭১ ০১৯৪০-৭৫৭১০৬ </h3>

        <h3 class="narrow_height" style="color: blue; margin-bottom: 15px;">আব্দুল জাব্বার মার্কেট, ঢাকা-চট্রগ্রাম মহাসড়ক সংলগ্ন, রামপুর রাস্তার মাথায়, ফেনী সদর, ফেনী</h3>
        <span  class="memoname" style="color: green;"> স্টক এজেন্ট মেমো </span>

      </div>
      <div class="holder_info">
        <div class="holder_info_part">
          <h3>কোডঃ<span>&nbsp;<?php  echo $invoice_no; ?></span></h3>
          <h3>স্টক এজেন্ট হোল্ডার :
            <span class="b_holder">
              <?php  echo $stock_holder_name; ?>
            </span>
          </h3>
          <h3>মোবাইল নাম্বারঃ
            <span class="b_holder">
              <?php  echo $stock_holder_phone; ?>
            </span>
          </h3>
          <h3>স্টক সংখ্যাঃ 
            <span class="b_holder">
              <?php  echo $stock_amount; ?>
            </span>
          </h3>
          <h3>এরিয়া : 
            <span class="b_holder">
              <?php  echo $stock_holder_address; ?>
            </span>
          </h3>
        </div>
        <div class="holder_info_part" style="float: right;">
          <h3 style="text-align:right; margin-right: 75px;">অর্ডার তারিখ : 
            <span class="buy_date"><?php  echo date('d-m-Y', strtotime("$order_date")); ?>&nbsp;ইং</span>
          </h3>
          <h3 style="text-align:right; margin-right: 75px;">ডেলিভারী তারিখ : 
            <span class="buy_date"><?php  echo date('d-m-Y', strtotime("$delivery_date")); ?>&nbsp;ইং</span>
          </h3>
          <h3 style="text-align:right; margin-right: 75px;">অর্ডার স্ট্যাটাসঃ 
            <span class="buy_date"><?php  echo strtoupper($status); ?>&nbsp;</span>
          </h3>
        </div>    
      </div>
      <div class="first_table">
          <table>
            <thead>
              <tr>
                <th>নং</th>
                <th>বিবরণ</th>
                <th>ব্র্যান্ড</th>
                <th>পরিমাণ</th>
                <th>কেজি/গ্রাম</th>
                <th>দর</th>
                <th>টাকা</th>
              </tr>
            </thead>
            <tbody>
              <tr> 
                <td>০১</td>
                <td><?php  echo $product_name; ?></td>
                <td class="brand_name"><?php echo $brand_name; ?></td>
                <td><?php  echo $product_amount; ?></td>
                <td><span><?php  echo $product_ideal_amount; ?></span></td>
                <td><span><?php echo $product_unit_price; ?>&nbsp;</span>টাকা</td>
                <td><span class="milk_total"><?php echo $total;?>&nbsp;</span>টাকা </td>
              </tr>

              <tr>
                <td colspan="5">&nbsp;</td>
                <td>মোট</td>
                <td><span class="grand_total"><?php echo $total;?>&nbsp;</span>টাকা</td>

              </tr>
              
            </tbody>
          </table>
      </div>
      <div class="second_table">
        <table class="maintable">
          <thead>
            <tr>
              <th>দিন</th>
              <th>স্টক কমিশন প্রদানের তারিখ </th>
              <th>স্টক কমিশন, প্রতি 15 দিনে <?php echo $comission_percentage; ?>%</th>
              <th>পেমেন্ট পদ্ধতি</th>
              <th>পেমেন্ট স্ট্যাটাস</th>
              <th>সাক্ষর</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>১ম</td>
              <td><span><?php echo date('d/m/Y', strtotime("$comission_date_1"));?></span></td>
              <td><?php echo $stock_comission; ?>/-&nbsp;</td>
              <td><?php  echo $payment_method; ?></td>
              <td>
                <?php 

                  if($pay_prefix=='1' || $pay_prefix=='2' || $pay_prefix=='3'){
                    echo "PAID";
                  }
                  else{
                    echo "&nbsp;";
                  }

                ?>
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>২য়</td>
              <td><span><?php echo date('d/m/Y', strtotime("$comission_date_2"));?></span></td>
              <td><?php echo $stock_comission; ?>/-&nbsp;</td>
              <td><?php  echo $payment_method; ?></td>
              <td>
                <?php 

                  if($pay_prefix=='2' || $pay_prefix=='3'){
                    echo "PAID";
                  }
                  else{
                    echo "&nbsp;";
                  }

                ?>
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>৩য়</td>
              <td><span><?php echo date('d/m/Y', strtotime("$comission_date_3"));?></span></td>
              <td><?php echo $stock_comission; ?>/-&nbsp;</td>
              <td><?php  echo $payment_method; ?></td>
              <td>
                <?php 

                  if($pay_prefix=='3'){
                    echo "PAID";
                  }
                  else{
                    echo "&nbsp;";
                  }

                ?>
              </td>
              <td>&nbsp;</td>
            </tr>

          </tbody>
        </table>
      </div>

    </div>
  </div>
  
  <p class="cut_line">&#9986;---------------------------&#9986;--------------------------&#9986;--------------------------&#9986;--------------------------&#9986;---------------------------&#9986;----------------&#9986;</p>

        <!-- if else refer -->
        <?php if(!empty($reference_name) && !empty($reference_phone)){ 


            $ref_name = $reference_name;
            $ref_phone = $reference_phone;
            $ref_comission = floor(($total*$referral_percentage)/100);


          ?>
  <!-- <div class="pagebreak"> </div> -->
  <div class="main raselbg" style="margin-top: 2%;">
    <div class="middle">
      <div class="topname">
        <h1 class="narrow_height" style="color: blue;"> মেসার্স রাসেল এন্টারপ্রাইজ </h1>

        <h2 class="narrow_height" style="color: red;">নিত্য প্রয়োজনীয় পণ্যের কমিশন এজেন্ট</h2>

        <h3 class="narrow_height" style="color: green; font-size: 18px;"> ০১৬২৭-৭২০৩৭১ ০১৯৪০-৭৫৭১০৬ </h3>

        <h3 class="narrow_height" style="color: blue; margin-bottom: 15px;">আব্দুল জাব্বার মার্কেট, ঢাকা-চট্রগ্রাম মহাসড়ক সংলগ্ন, রামপুর রাস্তার মাথায়, ফেনী সদর, ফেনী</h3>
        <span  class="memoname" style="color: green;">প্রতিনিধি  মেমো </span>

      </div>

      <div class="holder_info">
        <div class="holder_info_part">
          <h3>কোডঃ <span>&nbsp;<?php  echo $invoice_no; ?></span></h3>
          <h3>প্রতিনিধির নামঃ 
            <span class="b_holder">
              <?php  echo $ref_name; ?>
            </span>
          </h3>
          <h3>মোবাইল নাম্বারঃ
            <span class="b_holder">
              <?php  echo $ref_phone; ?>
            </span>
          </h3>
          
        </div>
         

        <div class="holder_info_part" style="float: right;">
          <div class="holder_info_part1" style="line-height: 0.5;">
              <h3>বিজনেস হোল্ডারঃ
                <span class="b_holder">
                  <?php  echo $stock_holder_name; ?>
                </span>
              </h3>
              <h3>মোবাইল নাম্বারঃ
                <span class="b_holder">
                  <?php  echo $stock_holder_phone; ?>
                </span>
              </h3>
              <h3>স্টক সংখ্যাঃ 
                <span class="b_holder">
                  <?php  echo $stock_amount; ?>
                </span>
              </h3>
              <h3>এরিয়া : 
                <span class="b_holder">
                  <?php  echo $stock_holder_address; ?>
                </span>
              </h3>

        
            
          </div>
          <div class="holder_info_part2" style="line-height: 1.2;">
            <h3 style="margin-right: 75px;">অর্ডার তারিখ : 
              <span class="buy_date"><?php  echo date('d-m-Y', strtotime("$order_date")); ?>&nbsp;ইং</span>
            </h3>
            <h3 style="margin-right: 75px;">ডেলিভারী তারিখ : 
              <span class="buy_date"><?php  echo date('d-m-Y', strtotime("$delivery_date")); ?>&nbsp;ইং</span>
            </h3>
            <h3 style="margin-right: 75px;">অর্ডার স্ট্যাটাসঃ 
              <span class="buy_date"><?php  echo strtoupper($status); ?>&nbsp;</span>
            </h3>
          </div>
          

        </div>
      </div>
    

      <div class="first_table">
        <table>
          <thead>
            <tr>
              <th>নং</th>
              <th>বিবরণ</th>
              <th>ব্র্যান্ড</th>
              <th>পরিমাণ</th>
              <th>কেজি/গ্রাম</th>
              <th>দর</th>
              <th>টাকা</th>
            </tr>
          </thead>
          <tbody>
            <tr> 
              <td>০১</td>
              <td><?php  echo $product_name; ?></td>
              <td class="brand_name"><?php echo $brand_name; ?></td>
              <td><?php  echo $product_amount; ?></td>
              <td><span><?php  echo $product_ideal_amount; ?></span></td>
              <td><span><?php echo $product_unit_price; ?>&nbsp;</span>টাকা</td>
              <td><span class="milk_total"><?php echo $total;?>&nbsp;</span>টাকা </td>
            </tr>

            <tr>
              <td colspan="5">&nbsp;</td>
              <td>মোট</td>
              <td><span class="grand_total"><?php echo $total;?>&nbsp;</span>টাকা</td>

            </tr>
            
          </tbody>
        </table>
        
      </div>

      <div class="second_table">
        <table class="maintable">
          <thead>
            <tr>
              <th>দিন</th>
              <th>প্রতিনিধি কমিশন প্রদানের তারিখ </th>
              <th>প্রতিনিধি কমিশন, প্রতি 15 দিনে <?php echo $referral_percentage; ?>%</th>
              <th>পেমেন্ট পদ্ধতি</th>
              <th>পেমেন্ট স্ট্যাটাস</th>
              <th>সাক্ষর</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>১ম</td>
              <td><span><?php echo date('d/m/Y', strtotime("$comission_date_1"));?></span></td>
              <td><?php echo $ref_comission; ?>/-&nbsp;</td>
              <td><?php  echo $payment_method; ?></td>
              <td>
                <?php 

                  if($pay_suffix=='1' || $pay_suffix=='2' || $pay_suffix=='3'){
                    echo "PAID";
                  }
                  else{
                    echo "&nbsp;";
                  }

                ?>
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>২য়</td>
              <td><span><?php echo date('d/m/Y', strtotime("$comission_date_2"));?></span></td>
              <td><?php echo $ref_comission; ?>/-&nbsp;</td>
              <td><?php  echo $payment_method; ?></td>
              <td>
                <?php 

                  if($pay_suffix=='2' || $pay_suffix=='3'){
                    echo "PAID";
                  }
                  else{
                    echo "&nbsp;";
                  }

                ?>
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>৩য়</td>
              <td><span><?php echo date('d/m/Y', strtotime("$comission_date_3"));?></span></td>
              <td><?php echo $ref_comission; ?>/-&nbsp;</td>
              <td><?php  echo $payment_method; ?></td>
              <td>
                <?php 

                  if($pay_suffix=='3'){
                    echo "PAID";
                  }
                  else{
                    echo "&nbsp;";
                  }

                ?>
              </td>
              <td>&nbsp;</td>
            </tr>

          </tbody>
        </table>      
      </div>

    <?php  } ?>

      
    </div>

    

  </div>


<!-- ./wrapper -->
<!-- Page specific script -->
<!-- <script src="jquery-3.3.1.min.js"></script> -->
<!-- <script src="jspdf.min.js"></script> -->
<script>
  window.addEventListener("load", window.print());
//   import './Montserrat-VariableFont_wght-normal.js'
//   function onLoad() {
     
//     var pdf = new jsPDF('p','px','a4');
//     pdf.setFont('Montserrat-VariableFont_wght-normal');
    

//     pdf.fromHTML(document.body);

//     pdf.save('test.pdf');
//   };


// window.addEventListener("load", onLoad);

</script>
</body>
</html>
<?php   

 
}
else{
  // header("location:index.php");
  $hello_hacker = realpath('./../index.php');

  header("location:".$hello_hacker);
}

?>
