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
            $pd_prefix = (int)$pd[0];
            $pd_suffix = (int)$pd[1];

            if($option==1 || $option==3){
              $stock_comission_paid_to_this_customer = $pd_prefix*$row['comission_amount'];
              $stock_comission_paid_total = $stock_comission_paid_total + $stock_comission_paid_to_this_customer;
            }
            

          if($option==2 || $option==3){
            $reference_comission_paid_with_this_customer = $pd_suffix*floor($row['total']*$row['referral_percentage']/100);
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
            $total_gained = $total_gained+$row['total'];
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
            $pd_prefix = (int)$pd[0];
            $pd_suffix = (int)$pd[1];

            if($pay_prefix==3){

            }
            else{
              $row['comission_no'] = $pay_prefix+1;
              $date_row_string = "comission_date_".$row['comission_no'];
              $pay_date = $row[$date_row_string];

              $pay_month = date("m",strtotime($pay_date));
              $pay_year = date("Y",strtotime($pay_date));

              if($pay_month==$which_month && $pay_year==$which_year){

                $stock_comission_paid_to_this_customer = $pd_prefix*$row['comission_amount'];
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

                    $reference_comission_paid_with_this_customer = $pd_suffix*floor($row['total']*$row['referral_percentage']/100);
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

              if($gain_month==$which_month && $gain_year==$which_year){

                $total_gained = $total_gained + $row['total'];

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

              if($gain_year==$which_year){

                $total_gained = $total_gained + $row['total'];

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
            $pd_prefix = (int)$pd[0];
            $pd_suffix = (int)$pd[1];

            if($pay_prefix==3){

            }
            else{
              $row['comission_no'] = $pay_prefix+1;
              $date_row_string = "comission_date_".$row['comission_no'];
              $pay_date = $row[$date_row_string];

              $pay_year = date("Y",strtotime($pay_date));

              if($pay_year==$which_year){

                $stock_comission_paid_to_this_customer = $pd_prefix*$row['comission_amount'];
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

                    $reference_comission_paid_with_this_customer = $pd_suffix*floor($row['total']*$row['referral_percentage']/100);
                    $reference_comission_paid_total = $reference_comission_paid_total + $reference_comission_paid_with_this_customer;
                  }

            

              }

            }    

        }

        $total_paid = $stock_comission_paid_total + $reference_comission_paid_total;
      }

      return $total_paid;

  }
  // echo total_paid_money_in_month($conn,'02','2022');
  
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

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/user2-160x160.jpg" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./accepted.php" class="nav-link active">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./settings.php" class="nav-link">Change Settings</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
 
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-user-circle"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="accepted.php" class="brand-link">
      <h2 class="brand-text font-weight-light">Rasel Enterprise</h2>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="./accepted.php" class="nav-link">
              <i class="nav-icon fas fa-plus-circle"></i>
              <p>
                Accepted Orders
              </p>
            </a>

          </li>

          <li class="nav-item">
            <a href="./confirmed.php" class="nav-link">
              <i class="nav-icon fas fa-check-circle"></i>
              <p>
                Confirmed Orders
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./completed.php" class="nav-link">
              <i class="nav-icon fas fa-trophy"></i>
              <p>
                Completed Orders
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./cancelled.php" class="nav-link">
              <i class="nav-icon fas fa-ban"></i>
              <p>
                Cancelled Orders
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./paid.php" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Paid Orders
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./unpaid.php" class="nav-link">
              <i class="nav-icon fas fa-not-equal"></i>
              <!-- <i class="fab fa-creative-commons-nc"></i> -->
              <p>
                Unpaid Orders
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./all.php" class="nav-link">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                All Orders
               
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./upcoming_payment.php" class="nav-link">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Upcoming Payment
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./business_details.php" class="nav-link active">
              <!-- <i class="nav-icon fas fa-money-bill-wave"></i> -->
              <i class="nav-icon fas fa-business-time"></i>
              <p>
                Business Details
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./settings.php" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Change Settings
                
              </p>
            </a>
          </li>

          <li class="nav-header">   </li>
          <li class="nav-header">   </li>
          <li class="nav-header">   </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper overflow-auto" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1" style="display:<?php $option = $order_confirmed?'block' : 'none'; echo $option;?>;">
          <div class="col-md-12">
            <div class="card bg-gradient-success">
              <div class="card-header">
                <h3 class="card-title">Order Confirmed!</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php echo "Order Successfully Confirmed!";?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
        </div>

        <div class="row mb-1" style="display:<?php $option = $order_deleted ?'block' : 'none'; echo $option;?>;">
          <div class="col-md-12">
            <div class="card bg-gradient-danger">
              <div class="card-header">
                <h3 class="card-title">Order Cancelled!</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php echo "Order Successfully Cancelled!";?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
        </div>

        <div class="row mb-1" style="display:<?php $option = $order_completed ?'block' : 'none'; echo $option;?>;">
          <div class="col-md-12">
            <div class="card bg-gradient-success">
              <div class="card-header">
                <h3 class="card-title">Order Completed!</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php echo "Order Successfully Completed!";?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
        </div>
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
                <p>Total Paid Money</p>
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
                <p>Total Stock Comission Paid</p>
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
                <p>Total Reference Comission Paid</p>
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
                <p>Total Gained Money</p>
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
                    <p>Total Paid In This Month</p>
                    <p>(<?php echo $ThisMonthName.','.$this_year;?>)</p>
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
                    <p>Total Paid In This Year</p>
                    <p>(<?php echo $this_year;?>)</p>
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
                    <p>Total Gained In This Month</p>
                    <p>(<?php echo $ThisMonthName.','.$this_year;?>)</p>
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
                    <p>Total Gained In This Year</p>
                    <p>(<?php echo $this_year;?>)</p>
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
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="https://adminlte.io">Rasel Enterprise</a>.</strong>
    All rights reserved.
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <!-- <div class="container-fluid"> -->
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header control-sidebar-dark">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="./dist/img/user2-160x160.jpg" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">Delowar Hossain Rasel</h3>
                <h5 class="widget-user-desc">Admin</h5>
              </div>
              <div class="card-footer p-0 control-sidebar-dark">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Change Name 
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Change Password 
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="./logout.php" class="nav-link">
                      Logout 
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
    <!-- </div> -->
  </aside>
  <!-- /.control-sidebar -->
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





</body>
</html>

<?php   

 
}
else{
  header("location:index.php");
}

?>
