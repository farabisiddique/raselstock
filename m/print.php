<?php 
  
  include 'db.php';

  if(isset($_GET['m'])){
    $any_message = 1;
    $message = $_GET['m'];

    if($message==2){
      $stop_printing = 1;
    }
    else if($message==1){
      $stop_printing = 0;
    }
    else{
      $stop_printing = 0;
      header("location: print.php");
    }


  }
  else{
    $any_message = 0;
    $message = 0;
  }

  if(isset($_POST['customer_phone'])){
    $customer_phone = $_POST['customer_phone'];

    $sql = "SELECT * FROM order_table WHERE customer_phone='$customer_phone'"; 
    $result = $conn->query($sql);

  }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <title>অর্ডার ডাউনলোড পেজ || রাসেল এন্টারপ্রাইজ</title>

    <style type="text/css">
      table,th,td,tr{
        border: 1px solid black;
      }
    </style>

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
      
      <button type="button" class="btn btn-outline-dark" ><a href="index.php">হোম</a></button>
      <button type="button" class="btn btn-outline-dark"><a href="print.php">মেমো ডাউনলোড করুন </a> </button>
    </div>

</div>



  <div class="container">



    <div class="message alert <?php 

          if($message==1){
            echo "alert-primary";
          }
          else{
            echo "alert-danger";
          }
        ?>
         " role="alert" style="display: <?php 

        if($any_message==1){
          echo "block";
        }
        else{
          echo "none";
        } ?>;">

        <?php 

          if($message==1){
            echo "আপনার অর্ডারটি গ্রহণ করা হয়েছে।";
          }
          else{
            echo "দুঃখিত। আপনার অর্ডারটিতে কোন একটি ভুল হয়েছে। পুনরায় অর্ডার করুন। ";
          }
        ?>
         
    </div>

    <div id="print" style="display: <?php 

        if($stop_printing==1){
          echo "none";
        }
        else{
          echo "block";
        } ?>;">

     

    <h3 style="text-align:left; color:black; padding-top: 3%;">মেমো ডাউনলোড করুন
    </h3>

    <label id="textdesign">মোবাইল নাম্বার :
      <form action="" method="post">
       <input type="Number" id="field" required="1" name="customer_phone">
       <br>
       <button type="submit" class="btn btn-outline-dark">ডাউনলোড করুন</button>
      </form>

    </label>

    <?php 

      if(isset($_POST['customer_phone'])){
        if ($result->num_rows > 0) {
          // output data of each row

    ?>
    <table style="width: 100%;" class="table table-hover">
      <thead class="text-center">
        <th>কোড</th>
        <th>নাম</th>
        <th>মোবাইল নাম্বার</th>
        <th>অর্ডার তারিখ</th>
        <th>অর্ডার স্ট্যাটাস</th>
        <th>ডাউনলোড</th>
      </thead>
      <tbody class="text-center">
        <?php 

          while($row = $result->fetch_assoc()) {

            $order_status = $row['order_status'];

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

            echo "<tr>";

            echo "<td>".$row['my_referral_code']."</td>";
            echo "<td>".$row['customer_name']."</td>";
            echo "<td>".$row['customer_phone']."</td>";
            echo "<td>".$row['order_date']."</td>";
            echo "<td>".$status."</td>";
            echo "<td><a href='print/print_order.php?id=".$row['id']."'>ডাউনলোড করুন</a></td>";


            echo "</tr>";



          }

        ?>
      </tbody>
    </table>

  <?php 
    }
    else{
      echo "<div class='alert alert-danger' role='alert' style='display: block; margin-top:25%;'>দুঃখিত। এই মোবাইল নম্বর দিয়ে কোন অর্ডার করা হয় নি। 
          </div>";
    }
  }
  ?>


  
</div>
</div>
    
<!-- <div class="container">
  <div class="footer">
      <p>সর্বস্বত্ব সংরক্ষিত &copy; ২০২২<a href="index.php">মেসার্স রাসেল এন্টারপ্রাইজ </a></p> 

        
  </div>
</div> -->
    

  
    <!--jQuery Link--->

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  
  </body>
</html>