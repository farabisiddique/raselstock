<?php



if(isset($_COOKIE["email"]))
{

  include realpath('../db.php');
  $upcoming_days = 50;
  $add_day_to_today = -($upcoming_days - 1);
  
  $today = date('Y-m-d');

  $date=date_create($today);
  date_add($date,date_interval_create_from_date_string("".$add_day_to_today." days"));
  $after_date = date_format($date,"Y-m-d");



  $period = new DatePeriod(
     new DateTime($after_date),
     new DateInterval('P1D'),
     new DateTime($today)
  );
// die(var_dump($period));

  $all_dates_array = array();
  
  $sql2 = "SELECT * FROM order_table WHERE NOT(payment_description='33') AND order_status=2";

  $result2 = $conn->query($sql2);

  if($result2->num_rows>0){

      $no_upcoming_payment = 0;
      $main_array = array();
      $ref_array = array();
  
      while($row = $result2->fetch_assoc()) {
 
          $pay_prefix = $row['payment_description'][0];
          $pay_prefix = (int) $pay_prefix; 

          if($pay_prefix==3){

          }
          else{
            $row['comission_no'] = $pay_prefix+1;
            $date_row_string = "comission_date_".$row['comission_no'];
            $sort_date = $row[$date_row_string];

            if (array_key_exists($sort_date,$main_array)){
              array_push($main_array[$sort_date],$row);
              
            }
            else{
              $main_array[$sort_date][0] = $row;
              
            }

          }

          if(!is_null($row['reference_name'])){

            $pay_suffix = $row['payment_description'][1];
            $pay_suffix = (int) $pay_suffix;

            if($pay_suffix==3){

            }
            else{

                $row['ref_comission_no'] = $pay_suffix+1;
                $date_row_string_ref = "comission_date_".$row['ref_comission_no'];
                $sort_date_ref = $row[$date_row_string_ref];

                if (array_key_exists($sort_date_ref,$ref_array)){
                  array_push($ref_array[$sort_date_ref],$row);
                  
                }
                else{
                  $ref_array[$sort_date_ref][0] = $row;
                  
                }

            }

          }
              
          
      }
  

  }
  else{
      $no_upcoming_payment = 1;
  }

$all_stock_com_dates = array_keys($main_array);
$all_ref_com_dates = array_keys($ref_array);
$merged_array = array_merge($all_stock_com_dates,$all_ref_com_dates);
$unique_array = array_unique($merged_array);

$period_array = array();
foreach ($period as $key => $value) {
  array_push($period_array,$value->format('Y-m-d'));
}

$period = array_intersect($period_array, $unique_array);
usort($period, "date_sort");

$upcoming_payment = count($period);


function date_sort($a, $b) {
    return strtotime($a) - strtotime($b);
}



function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
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
            <a href="./unpaid.php" class="nav-link active">
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

    </div>

  </aside>


  <div class="content-wrapper overflow-auto" >

    <div class="content-header">
      
    </div>

    <section class="content">
      <div class="container-fluid">
        
            <div class="row">
              <div class="content-header col-lg-12">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1 class="m-0">All Unpaid Payments</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Unpaid Payments</li>
                      </ol>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.container-fluid -->
              </div>
            </div>

                    <?php 

                      if($upcoming_payment>0){


                      $i = 0;
                      foreach ($period as $key => $value) {
                        // $all_dates_array[$i]= $value->format('Y-m-d');
                        $all_dates_array[$i]= $value;
                        
                    ?>
                      <div class="time-label my-4">
                          <h3 class="bg-red"><?php echo date("j F, Y",strtotime($all_dates_array[$i])); ?></h3>
                      </div>
                      <div class="row">
                                <?php 
                                  $a_date = $all_dates_array[$i];
                                  foreach ($main_array[$a_date] as $key => $bvalue) {
                                  
                                 
                                ?>
                                <div class="col-md-4">
                                  <div class="card card-widget widget-user-2">
                                    <div class="widget-user-header bg-success">
                                      <h5>Customer Information</h5>
                                    </div>
                                    <div class="card-footer p-0">
                                      <ul class="nav flex-column">
                                        <li class="nav-item">
                                          <a href="#" class="nav-link">
                                            Name <span class="float-right badge bg-info"><?php echo $bvalue['customer_name'];?></span>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="" class="nav-link">
                                            Contact No: <span class="float-right badge bg-primary"><?php echo $bvalue['customer_phone'];?></span>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="#" class="nav-link">
                                            Address <span class="float-right badge bg-info"><?php echo $bvalue['customer_address'];?></span>
                                          </a>
                                        </li>

                                        <li class="nav-item mb-3">
                                          
                                          <button type="button" class="btn btn-outline-primary btn-block paycomission" data-toggle="modal" data-target="#modal-warning" data-name="<?php echo $bvalue['customer_name'];?>" data-id="<?php echo $bvalue['id'];?>" data-pd="<?php echo $bvalue['comission_no'];?>"><i class="fas fa-money-bill-alt"></i> Pay the <?php echo ordinal($bvalue['comission_no']);?> Stock Comission (<?php echo $bvalue['comission_amount'];?> Taka)</button>

                                        

                                        </li>

                                      </ul>
                                    </div>
                                      
                                  </div>
                                  
                                </div>

                                <?php  } 
                                foreach ($ref_array[$a_date] as $key => $cvalue) { 
                                  ?>
                                <div class="col-md-4">
                                  <div class="card card-widget widget-user-2">   
                                    <div class="widget-user-header bg-dark">
                                      <h5>Reference Information</h5> 
                                    </div>
                                    <div class="card-footer p-0">
                                      <ul class="nav flex-column">
                                        <li class="nav-item">
                                          <a href="#" class="nav-link">
                                            Referred Customer Name: <span class="float-right badge bg-info"><?php echo $cvalue['customer_name'];?></span>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="#" class="nav-link">
                                            Name: <span class="float-right badge bg-info"><?php echo $cvalue['reference_name'];?></span>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="" class="nav-link">
                                            Contact No: <span class="float-right badge bg-primary"><?php echo $cvalue['reference_phone'];?></span>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="#" class="nav-link">
                                            Reference Comission Amount: <span class="float-right badge bg-primary"><?php echo floor(($cvalue['total']*$cvalue['referral_percentage'])/100); ?> Taka</span>
                                          </a>
                                        </li>
                                        
                                         <li class="nav-item mb-3">
                                          <button type="button" class="btn btn-outline-primary btn-block payreferral" data-toggle="modal" data-target="#modal-secondary" data-name="<?php echo $cvalue['reference_name'];?>" data-id="<?php echo $cvalue['id'];?>" data-pd="<?php echo $cvalue['comission_no'];?>"><i class="fas fa-money-bill-alt"></i> Pay the <?php echo ordinal($cvalue['ref_comission_no']);?> Reference Comission (<?php echo floor(($cvalue['total']*$cvalue['referral_percentage'])/100); ?> Taka)</button>
                                        </li>
                                      
                                      </ul>
                                    </div>

                                      
                                  </div>
                                  
                                </div>
                                <?php  } ?>
                                    
                      </div>
                    <?php  

                      $i++;
                      } 

                      }
                      else{

                    ?>

                    <div class="row">
                      <h2 class="text-center">There is no upcoming payments</h2>
                    </div>



                    <?php                          
                      }
                    ?>



              
            
      </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="modal-warning" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Stock Comission Payment Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Have you just paid Mr. <span id="customer_name_modal"></span>?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-outline-dark" id="yespayment" data-orderid="" data-pd="" onclick="$('#modal-warning').modal('hide');" aria-label="Close">Yes</button>
            </div>
          </div>
          
        </div>
  </div>

  <div class="modal fade" id="modal-secondary" style="display: none; padding-right: 12px;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">Referral Comission Payment Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Have you just paid Mr. <span id="reference_name_modal"></span>?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-outline-dark" id="yespay_ref" data-orderid="" data-pd="" onclick="$('#modal-secondary').modal('hide');" aria-label="Close">Yes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="https://adminlte.io">Rasel Enterprise</a>.</strong>
    All rights reserved.
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
            <div class="card card-widget widget-user-2">
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
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->





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


<script type="text/javascript">
  $(".paycomission").on("click",function(){

      var name = $(this).data("name");
      var id = $(this).data("id");
      var pd = $(this).data("pd");

      $("#customer_name_modal").html(name);
      $('#yespayment').attr('data-orderid', id);
      $('#yespayment').attr('data-pd', pd);




  });

  $("#yespayment").click(function(){

            var id = $(this).data("orderid");
            var pd = $(this).data("pd");
            var type = 0;
            
            
            $.ajax({
                    method: "POST",
                    url: "pay.php",
                    async:false,
                    data: {id: id,pd: pd,type:type},
                    success: function(msg) {
        
                    if(msg==0){

                      alert("Sorry! Payment Unsuccessfull");
                      location.reload();
                      
                    }
                    else{

                      alert("Payment Successfull");
                      location.reload();
                    }

                 }
            });

           

  });


  $(".payreferral").on("click",function(){

      var name = $(this).data("name");
      var id = $(this).data("id");
      var pd = $(this).data("pd");

      $("#reference_name_modal").html(name);
      $('#yespay_ref').attr('data-orderid', id);
      $('#yespay_ref').attr('data-pd', pd);




  });

  $("#yespay_ref").click(function(){

            var id = $(this).data("orderid");
            var pd = $(this).data("pd");
            var type = 1;
            
            
            $.ajax({
                    method: "POST",
                    url: "pay.php",
                    async:false,
                    data: {id: id,pd: pd,type:type},
                    success: function(msg) {
        
                    if(msg==0){

                      alert("Sorry! Payment Unsuccessfull");
                      location.reload();
                      
                    }
                    else{
                      
                      alert("Payment Successfull");
                      location.reload();
                      
                    }

                 }
            });

           

  });
</script>





</body>
</html>
<?php   
 
}
else{
  header("location:index.php");
}

?>
