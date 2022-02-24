<?php

  function orderCount($con,$status=null){

      if(is_null($status)){
        $sql="SELECT * FROM order_table";
      }
      else{
        $sql="SELECT * FROM order_table WHERE order_status=".$status;
      }
      

      if ($result=mysqli_query($con,$sql))
        {
        // Return the number of rows in result set
        $rowamount=mysqli_num_rows($result);
        return $rowamount;
        
        }
  }

  
if(isset($_COOKIE["email"]))
{

  if(isset($_GET['mc'])){ 
    if($_GET['mc']==1){
      $order_confirmed = "Order Successfully Confirmed!";
    }
    else{
      $order_confirmed = null; 
    }
    
  }
  else{
    $order_confirmed = null;
  }

  if(isset($_GET['md'])){
    if($_GET['md']==1){
      $order_deleted = "Order Successfully Cancelled!";
    }
    else{
      $order_deleted = null;
    }
    
  }
  else{
    $order_deleted = null;
  }  
  require(realpath('../db.php'));

  $accptdCount = orderCount($conn,0);
  $confirmdCount = orderCount($conn,1);
  $completedCount = orderCount($conn,2);
  $cancelledCount = orderCount($conn,3);
  $allOrderCount = orderCount($conn);



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
        <a href="./settings.php" class="nav-link">Change Settings</a>
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
            <a href="./confirmed.php" class="nav-link active">
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
            <a href="./settings.php" class="nav-link">
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
            <div class="small-box bg-info">
              <div class="inner progress-bar-number">
                <h3 class="num" data-from="0" data-to="<?php echo $allOrderCount;?>">0</h3>



                <p>All Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-bag"></i>
              </div>
              <a href="./all.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner progress-bar-number">
                <h3 class="num" data-from="0" data-to="<?php echo $completedCount;?>">0</h3>

                <p>Completed Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-trophy"></i>
              </div>
              <a href="./completed.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: orange;">
              <div class="inner progress-bar-number">
                <h3 class="num" data-from="0" data-to="<?php echo $confirmdCount;?>">0</h3>

                <p>Confirmed Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <a href="confirmed.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: yellow;">
              <div class="inner progress-bar-number">
                <h3 class="num" data-from="0" data-to="<?php echo $accptdCount;?>">0</h3>

                <p>Accepted Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-plus-circle"></i>
              </div>
              <a href="accepted.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner progress-bar-number">
                <h3 class="num" data-from="0" data-to="<?php echo $cancelledCount;?>">0</h3>

                <p>Cancelled Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-ban"></i>
              </div>
              <a href="./cancelled.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="content-header col-lg-12">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Confirmed Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Confirmed Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
        </div>
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable overflow-auto">
            <table id="example" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Bkash Number</th>
                        <th>Customer Address</th>
                        <th>Reference Name</th>
                        <th>Reference Phone</th>
                        <th>Order Date</th>
                        <th>Product Name</th>
                        <th>Stock</th>
                        <th>Amount</th>
                        <th>Total</th>
                        <th>1st Comission Date</th>
                        <th>2nd Comission Date</th>
                        <th>3rd Comission Date</th>
                        <th>Comission Amount</th>
                        <th>Payment Method</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
            
          </section>
          <!-- /.Left col -->

          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
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
