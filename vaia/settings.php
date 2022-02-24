<?php
  
  
if(isset($_COOKIE["email"]))
{
  require(realpath('../db.php'));

  $sql = "SELECT * FROM admin_settings";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      
      $settings_id = $row['settings_id'];
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
        <a href="accepted.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./settings.php" class="nav-link active">Change Settings</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="./add-new-admin.php" class="nav-link">Add New Admin</a>
      </li> -->
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
                <!-- <i class="right fas fa-angle-left"></i> -->
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
                <!-- <span class="right badge badge-danger">New</span> -->
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
            <a href="./business_details.php" class="nav-link">
              <!-- <i class="nav-icon fas fa-money-bill-wave"></i> -->
              <i class="nav-icon fas fa-business-time"></i>
              <p>
                Business Details
              </p>
            </a>
          </li>          <li class="nav-item">
            <a href="./settings.php" class="nav-link active">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Change Settings
                
              </p>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="./add-new-admin.php" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Add New Admin
                
              </p>
            </a>
          </li> -->

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
        

        
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="content-header col-lg-12">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Change Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Change Settings</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
        </div>
        <div class="row">
            
              <div class="container-fluid row card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">Change any settings for user</h3>
                  </div>
                  <form action="change_settings.php" method="POST">
                    <div class="card-body row">
                        <div class="col-md-6">
                                <div class="form-group">
                                  <label for="comPercentage">Stock Comission Percentage (%) </label>
                                  <input type="number" class="form-control" id="comPercentage" name="comission_percentage" value="<?php echo $comission_percentage;?>">
                                </div>

                                <div class="form-group">
                                  <label for="refPercentage">Reference Comission Percentage (%) </label>
                                  <input type="number" class="form-control" id="refPercentage" name="reference_percentage" value="<?php echo $reference_percentage;?>" >
                                </div>

                                <div class="form-group">
                                  <label for="comInterval">Comission Interval (Days) </label>
                                  <input type="number" class="form-control" id="comInterval" name="comission_day_interval_show" value="<?php echo $comission_day_interval_show;?>">
                                </div>

                                <div class="form-group">
                                  <label>Payment Method</label>
                                  <select class="form-control form-select" name="default_payment_method">
                                    <option <?php 

                                      if($default_payment_method==1){
                                        echo "selected";
                                      }

                                    ?>value="1">Bkash</option>
                                    <option <?php 

                                      if($default_payment_method==0){
                                        echo "selected";
                                      }

                                    ?> value="0">Cash</option>


                                  </select>
                                </div>



                        </div>

                        <div class="col-md-6">

                                <div class="form-group">
                                  <label for="mainProduct">Main Product </label>
                                  <input type="text" class="form-control" id="mainProduct" name="main_product" value="<?php echo $main_product;?>">
                                </div>

                                <div class="form-group">
                                  <label for="main_product_brand">Product Name</label>
                                  <input type="text" class="form-control" id="main_product_brand" name="main_product_brand" value="<?php echo $main_product_brand;?>">
                                </div>

                                <div class="form-group">
                                  <label for="packetPerStock">Packet Per Stock</label>
                                  <input type="number" class="form-control" id="packetPerStock" name="packet_per_stock" value="<?php echo $packet_per_stock;?>">
                                </div>
                                <div class="form-group">
                                  <label for="unitPrice">Unit Price (Taka)</label>
                                  <input type="number" class="form-control" id="unitPrice" name="unit_price" value="<?php echo $unit_price;?>">
                                </div>

                                <div class="form-group">
                                  <label for="amount_per_packet">Amount Per Packet</label>
                                  <input type="text" class="form-control" id="amount_per_packet" name="amount_per_packet" value="<?php echo $amount_per_packet;?>">
                                </div>

                                <input type="hidden" name="settings_id" value="<?php echo $settings_id; ?>">



                                <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Change Settings</button>
                                </div>
     
                        </div>

                        
                    </div><!-- /.card-body --> 
                  </form>

              </div>
                

               

              </div>

              
            
        </div>
        
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
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="datatable/confirmed_order.js"></script>

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
