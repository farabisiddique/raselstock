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
      $second_reference_percentage = $row['second_reference_percentage'];
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
                                  <label for="refPercentage">2nd Reference Comission Percentage (%) </label>
                                  <input type="number" class="form-control" id="secondrefPercentage" name="second_reference_percentage" value="<?php echo $second_reference_percentage;?>" >
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
                                  <label for="main_product_brand">Brand Name</label>
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
<script type="text/javascript" charset="utf8" src="datatable/confirmed_order.js"></script>

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
