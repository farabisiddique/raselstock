<?php
  require(realpath('../db.php'));
  function total_paid_money($con,$option=3){

      $sql="SELECT * FROM order_table WHERE order_status=2";
      
      $result = $con->query($sql);

      $stock_comission_paid_total = 0;
      $reference_comission_paid_total = 0;
      $stock_comission_paid_to_this_customer = 0;
      $reference_comission_paid_with_this_customer = 0;
      $total_paid = 0;

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $pd = $row['payment_description'];
            $pay_prefix = (int)$pd[0];
            $pay_suffix = (int)$pd[1];

            if($option==1 || $option==3){
              $stock_comission_paid_to_this_customer = $pay_prefix*$row['comission_amount'];
              $stock_comission_paid_total = $stock_comission_paid_total + $stock_comission_paid_to_this_customer;
            }
            

          if($option==2 || $option==3){
            $reference_comission_paid_with_this_customer = $pay_suffix*floor($row['total']*$row['referral_percentage']/100);
            $reference_comission_paid_total = $reference_comission_paid_total + $reference_comission_paid_with_this_customer;
          }



        }

        $total_paid = $stock_comission_paid_total + $reference_comission_paid_total;
      }

      return $total_paid;

  }

  function total_gained_money($con){

      $sql="SELECT * FROM order_table WHERE order_status=2";
      $result = $con->query($sql);
      $total_gained = 0;

      if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            if($row['capital_payment_description']==0){
              $total_gained = $total_gained+$row['total'];
            }
            
        }
        
      }

      return $total_gained;

  }

  function total_paid_money_in_month($con,$which_month,$which_year){


      $sql="SELECT * FROM order_table WHERE order_status=2";    
        
      $result = $con->query($sql);

      $stock_comission_paid_total = 0;
      $reference_comission_paid_total = 0;
      $stock_comission_paid_to_this_customer = 0;
      $reference_comission_paid_with_this_customer = 0;
      $total_paid = 0;

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $pd = $row['payment_description'];
            $pay_prefix = (int)$pd[0];
            $pay_suffix = (int)$pd[1];

            if($pay_prefix==3){

            }
            else{
              $row['comission_no'] = $pay_prefix+1;
              $date_row_string = "comission_date_".$row['comission_no'];
              $pay_date = $row[$date_row_string];

              $pay_month = date("m",strtotime($pay_date));
              $pay_year = date("Y",strtotime($pay_date));

              if($pay_month==$which_month && $pay_year==$which_year){

                $stock_comission_paid_to_this_customer = $pay_prefix*$row['comission_amount'];
                $stock_comission_paid_total = $stock_comission_paid_total + $stock_comission_paid_to_this_customer;

              }

          

            }

            if(!is_null($row['reference_name'])){


              if($pay_suffix==3){

              }
              else{

                  $row['ref_comission_no'] = $pay_suffix+1;
                  $date_row_string_ref = "comission_date_".$row['ref_comission_no'];
                  $pay_date_ref = $row[$date_row_string_ref];

                  $pay_month_ref = date("m",strtotime($pay_date_ref));
                  $pay_year_ref = date("Y",strtotime($pay_date_ref));

                  if($pay_month_ref==$which_month && $pay_year_ref==$which_year){

                    $reference_comission_paid_with_this_customer = $pay_suffix*floor($row['total']*$row['referral_percentage']/100);
                    $reference_comission_paid_total = $reference_comission_paid_total + $reference_comission_paid_with_this_customer;
                  }

            

              }

            }    

        }

        $total_paid = $stock_comission_paid_total + $reference_comission_paid_total;
      }

      return $total_paid;

  }

  function total_gained_money_in_month($con,$which_month,$which_year){


      $sql="SELECT * FROM order_table WHERE order_status=2";    
        
      $result = $con->query($sql);

      $total_gained = 0;

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            
              $gain_date = $row['delivery_date'];
              $gain_month = date("m",strtotime($gain_date));
              $gain_year = date("Y",strtotime($gain_date));

            if($row['capital_payment_description']==0){

              if($gain_month==$which_month && $gain_year==$which_year){

                $total_gained = $total_gained + $row['total'];

              }
            }

        }

        
      }

      return $total_gained;

  }

  function total_gained_money_in_year($con,$which_year){


      $sql="SELECT * FROM order_table WHERE order_status=2";    
        
      $result = $con->query($sql);

      $total_gained = 0;

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            
              $gain_date = $row['delivery_date'];
              $gain_year = date("Y",strtotime($gain_date));

            if($row['capital_payment_description']==0){

              if($gain_year==$which_year){

                $total_gained = $total_gained + $row['total'];

              }
            }

        }

        
      }

      return $total_gained;

  }

  function total_paid_money_in_year($con,$which_year){


      $sql="SELECT * FROM order_table WHERE order_status=2";    
        
      $result = $con->query($sql);

      $stock_comission_paid_total = 0;
      $reference_comission_paid_total = 0;
      $stock_comission_paid_to_this_customer = 0;
      $reference_comission_paid_with_this_customer = 0;
      $total_paid = 0;

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $pd = $row['payment_description'];
            $pay_prefix = (int)$pd[0];
            $pay_suffix = (int)$pd[1];

            if($pay_prefix==3){

            }
            else{
              $row['comission_no'] = $pay_prefix+1;
              $date_row_string = "comission_date_".$row['comission_no'];
              $pay_date = $row[$date_row_string];

              $pay_year = date("Y",strtotime($pay_date));

              if($pay_year==$which_year){

                $stock_comission_paid_to_this_customer = $pay_prefix*$row['comission_amount'];
                $stock_comission_paid_total = $stock_comission_paid_total + $stock_comission_paid_to_this_customer;

              }

          

            }

            if(!is_null($row['reference_name'])){


              if($pay_suffix==3){

              }
              else{

                  $row['ref_comission_no'] = $pay_suffix+1;
                  $date_row_string_ref = "comission_date_".$row['ref_comission_no'];
                  $pay_date_ref = $row[$date_row_string_ref];

                  $pay_year_ref = date("Y",strtotime($pay_date_ref));

                  if($pay_year_ref==$which_year){

                    $reference_comission_paid_with_this_customer = $pay_suffix*floor($row['total']*$row['referral_percentage']/100);
                    $reference_comission_paid_total = $reference_comission_paid_total + $reference_comission_paid_with_this_customer;
                  }

            

              }

            }    

        }

        $total_paid = $stock_comission_paid_total + $reference_comission_paid_total;
      }

      return $total_paid;

  }

  
if(isset($_COOKIE["email"]))
{ 


  
  $this_month = date('m');
  $dateObj   = DateTime::createFromFormat('!m', $this_month);
  $ThisMonthName = $dateObj->format('F'); // March

  $this_year = date('Y');
  $totalPaid = total_paid_money($conn);
  $totalPaidStock = total_paid_money($conn,1);
  $totalPaidRef = total_paid_money($conn,2);
  $totalPaidThisMonth = total_paid_money_in_month($conn,$this_month,$this_year);
  $totalPaidThisYear = total_paid_money_in_year($conn,$this_year);
  $totalGained = total_gained_money($conn);
  $totalGainedThisMonth = total_gained_money_in_month($conn,$this_month,$this_year);
  $totalGainedThisYear = total_gained_money_in_year($conn,$this_year);





?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rasel Enterprise | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

  <link rel="stylesheet" type="text/css" href="plugins/progress-bar-number/progressnumber.css">

  <style type="text/css">
    .comission_stat1{
      background-color: yellow;
      font-weight: bolder;
      color: black;
      text-align: center;
    }

    .comission_stat2{
      background-color: blue;
      font-weight: bolder;
      color: black;
      text-align: center;
    }

    .comission_stat3{
      background-color: green;
      font-weight: bolder;
      color: white;
      text-align: center;
    }

    .ref_stat1{
      background-color: pink;
      font-weight: bolder;
      color: black;
      text-align: center;
    }

    .ref_stat2{
      background-color: magenta;
      font-weight: bolder;
      color: white;
      text-align: center;
    }

    .ref_stat3{
      background-color: #1f89e6;
      font-weight: bolder;
      color: white;
      text-align: center;
    }

    .total_paid_taka:after{
      content: " Taka";
    }
  </style>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php    
    // require(realpath('./preloader.php'));
?>

  <?php 
    require(realpath('./navbar.php'));
  ?>

  <?php 
    require(realpath('./left_sidebar.php'));
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper overflow-auto" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background:linear-gradient(to right, rgb(0, 242, 96), rgb(5, 117, 230));">
              <div class="inner progress-bar-number">
                <h3 class="num total_paid_taka" data-from="0" data-to="<?php echo $totalPaid;?>">0</h3>
                <p class="font-weight-bold">Total Comission Paid</p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-ban"></i> -->
                <i class="fas fa-money-bill-wave"></i>
              </div>
              <a href="./business_details.php" class="small-box-footer" style='color:black;'><b>More info</b><i class="fas fa-arrow-circle-right"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background:linear-gradient(to right, rgb(202, 197, 49), rgb(243, 249, 167));">
              <div class="inner progress-bar-number">
                <h3 class="num total_paid_taka" data-from="0" data-to="<?php echo $totalPaidStock;?>">0</h3>
                <p class="font-weight-bold">Total Stock Comission Paid</p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-ban"></i> -->
                <i class="fas fa-money-bill-wave"></i>
              </div>
              <a href="./business_details.php" class="small-box-footer" style='color:black;'><b>More info</b><i class="fas fa-arrow-circle-right"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background:linear-gradient(to right, rgb(86, 171, 47), rgb(168, 224, 99));">
              <div class="inner progress-bar-number">
                <h3 class="num total_paid_taka" data-from="0" data-to="<?php echo $totalPaidRef;?>">0</h3>
                <p class="font-weight-bold">Total Reference Comission Paid</p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-ban"></i> -->
                <i class="fas fa-money-bill-wave"></i>
              </div>
              <a href="./business_details.php" class="small-box-footer" style='color:black;'><b>More info</b><i class="fas fa-arrow-circle-right"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background:linear-gradient(to right, rgb(15, 32, 39), rgb(32, 58, 67), rgb(44, 83, 100)); color: white;">
              <div class="inner progress-bar-number">
                <h3 class="num total_paid_taka" data-from="0" data-to="<?php echo $totalGained;?>">0</h3>
                <p class="font-weight-bold">Total Gained Money</p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-ban"></i> -->
                <i class="fas fa-money-bill-wave"></i>
              </div>
              <a href="./business_details.php" class="small-box-footer" style='color:black;'><b>More info</b><i class="fas fa-arrow-circle-right"></i></a>
            </div>

          </div>

          
          <!-- ./col -->
        </div>

        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box" style="background:linear-gradient(to right, rgb(116, 235, 213), rgb(172, 182, 229));">
                  <div class="inner progress-bar-number">
                    <h3 class="num total_paid_taka" data-from="0" data-to="<?php echo $totalPaidThisMonth;?>">0</h3>
                    <p class="font-weight-bold">Total Comission Paid This Month</p>
                    <p class="font-weight-bold">(<?php echo $ThisMonthName.','.$this_year;?>)</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                  </div>
                  <a href="./business_details.php" class="small-box-footer" style='color:black;'><b>More info</b><i class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box" style="background:linear-gradient(to right, rgb(168, 255, 120), rgb(120, 255, 214)); color: black;">
                  <div class="inner progress-bar-number">
                    <h3 class="num total_paid_taka" data-from="0" data-to="<?php echo $totalPaidThisYear;?>">0</h3>
                    <p class="font-weight-bold">Total Comission Paid This Year</p>
                    <p class="font-weight-bold">(<?php echo $this_year;?>)</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                  </div>
                  <a href="./business_details.php" class="small-box-footer" style='color:black;'><b>More info</b><i class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box" style="background:linear-gradient(to right, rgb(0, 4, 40), rgb(0, 78, 146)); color: white;">
                  <div class="inner progress-bar-number">
                    <h3 class="num total_paid_taka" data-from="0" data-to="<?php echo $totalGainedThisMonth;?>">0</h3>
                    <p class="font-weight-bold">Total Gained This Month</p>
                    <p class="font-weight-bold">(<?php echo $ThisMonthName.','.$this_year;?>)</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                  </div>
                  <a href="./business_details.php" class="small-box-footer" style='color:black;'><b>More info</b><i class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box" style="background:linear-gradient(to right, rgb(255, 0, 132), rgb(51, 0, 27)); color:white;">
                  <div class="inner progress-bar-number">
                    <h3 class="num total_paid_taka" data-from="0" data-to="<?php echo $totalGainedThisYear;?>">0</h3>
                    <p class="font-weight-bold">Total Gained This Year</p>
                    <p class="font-weight-bold">(<?php echo $this_year;?>)</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                  </div>
                  <a href="./business_details.php" class="small-box-footer" style='color:black;'><b>More info</b><i class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>
        </div>
        <!-- /.row -->
        
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php    
    require(realpath('./footer.php'));
?>
<?php    
    require(realpath('./right_sidebar.php'));
?>
</div>
<!-- ./wrapper -->



<div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Confirm Cancel</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to cancel this order?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-outline-light"><a href="" class="delete-final">Yes Cancel this order</a></button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- <script src="dist/js/pages/dashboard.js"></script> -->

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="datatable/paid_order.js"></script>

<script type="text/javascript" charset="utf8" src="plugins/progress-bar-number/jquery.appear.js"></script>

<script type="text/javascript" charset="utf8" src="plugins/progress-bar-number/jquery.countTo.js"></script>

<script type="text/javascript" charset="utf8" src="plugins/progress-bar-number/progressnumber.js"></script>

<script type="text/javascript" charset="utf8" src="delete_modal_event.js"></script>

<?php 
    require(realpath('./common_script.php'));
?>



</body>
</html>

<?php   

 
}
else{
  header("location:index.php");
}

?>
