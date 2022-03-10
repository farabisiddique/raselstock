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

  <?php    
    require(realpath('./preloader.php'));
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
            <h1 class="m-0">Completed Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Completed Orders</li>
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
                        <th>2nd Reference Name</th>
                        <th>2nd Reference Phone</th>
                        <th>Order Date</th>
                        <th>Product Name</th>
                        <th>Stock</th>
                        <th>Packet Number</th>
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
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="datatable/completed_order.js"></script>

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
