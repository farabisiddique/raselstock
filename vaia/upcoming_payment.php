<?php

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

function find_second_reference($db_con,$code){

    $sql2 = "SELECT * FROM order_table WHERE my_referral_code='$code'";
         
    $result2 = $db_con->query($sql2);

    if($result2->num_rows>0){
      while ($row = $result2->fetch_assoc()) {
          if(!is_null($row['reference_name']) && !is_null($row['reference_phone']) ){

        $scnd_rfr_name = $row['reference_name'];
        $scnd_rfr_phone = $row['reference_phone'];
        $second_reference = array($scnd_rfr_name,$scnd_rfr_phone);
      }
      else{
          $second_reference = false;
        }
      }
    }
    else{
      $second_reference = false;
    }

    return $second_reference;


}


if(isset($_COOKIE["email"]))
{

  include realpath('../db.php');
  $upcoming_days = 50;
  $add_day_to_today = $upcoming_days - 1;
  
  $today = date('Y-m-d');

  $date=date_create($today);
  date_add($date,date_interval_create_from_date_string("".$add_day_to_today." days"));
  $after_date = date_format($date,"Y-m-d");


  $period = new DatePeriod(
     new DateTime($today),
     new DateInterval('P1D'),
     new DateTime($after_date)
  );

  $all_dates_array = array();
  
  $sql2 = "SELECT * FROM order_table WHERE (NOT(payment_description='33') OR NOT(second_referral_payment=3)) AND order_status=2";

  $result2 = $conn->query($sql2);


  if($result2->num_rows>0){

      $no_upcoming_payment = 0;
      $main_array = array();
      $ref_array = array();
      $scnd_ref_array = array();
  
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
            $sr_status = $row['second_referral_payment'];
            $references_code = $row['references_code'];

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
            if($sr_status==3){

            }
            else{

                $sr = find_second_reference($conn,$references_code);

                if($sr){
                  $row['second_reference_name'] = $sr[0];
                  $row['second_reference_phone'] = $sr[1];
                  $second_referral_percentage = $row['second_referral_percentage'];
                  $row['scnd_ref_comission_no'] = $sr_status+1;
                  $date_row_string_ref_scnd = "comission_date_".$row['scnd_ref_comission_no'];
                  $sort_date_ref_scnd = $row[$date_row_string_ref_scnd];

                  if (array_key_exists($sort_date_ref_scnd,$scnd_ref_array)){
                    array_push($scnd_ref_array[$sort_date_ref_scnd],$row);
                    
                  }
                  else{
                    $scnd_ref_array[$sort_date_ref_scnd][0] = $row;
                    
                  }
                }
                  

            }

          }
              
          
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
  

  
  }
  else{
      $no_upcoming_payment = 1;
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
                      <h1 class="m-0">Upcoming Payment for Next <?php echo $upcoming_days;?> Days</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Upcoming Payment</li>
                      </ol>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.container-fluid -->
              </div>
            </div>

                    <?php 

                      if($no_upcoming_payment!=1){


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
                                          
                                          <button type="button" class="btn btn-outline-primary btn-block paycomission" data-toggle="modal" data-target="#modal-warning" data-name="<?php echo $bvalue['customer_name'];?>" data-id="<?php echo $bvalue['id'];?>" data-pd="<?php echo $bvalue['comission_no'];?>"><i class="fas fa-money-bill-alt"></i> Pay the <?php echo ordinal($bvalue['comission_no']);?>  Comission (<?php echo $bvalue['comission_amount'];?> Taka)</button>

                                        

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
                                      <h5>Main Reference Information</h5> 
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
                                          <button type="button" class="btn btn-outline-dark btn-block payreferral" data-toggle="modal" data-target="#modal-secondary" data-name="<?php echo $cvalue['reference_name'];?>" data-id="<?php echo $cvalue['id'];?>" data-pd="<?php echo $cvalue['comission_no'];?>"><i class="fas fa-money-bill-alt"></i> Pay the <?php echo ordinal($cvalue['ref_comission_no']);?>  Comission (<?php echo floor(($cvalue['total']*$cvalue['referral_percentage'])/100); ?> Taka)</button>
                                        </li>
                                      
                                      </ul>
                                    </div>

                                      
                                  </div>
                                  
                                </div>
                                <?php  } ?>


                                <?php   
                                foreach ($scnd_ref_array[$a_date] as $key => $cvalue) { 
                                  ?>
                                <div class="col-md-4">
                                  <div class="card card-widget widget-user-2">   
                                    <div class="widget-user-header bg-danger">
                                      <h5>Second Reference Information</h5> 
                                    </div>
                                    <div class="card-footer p-0">
                                      <ul class="nav flex-column">
                                        <li class="nav-item">
                                          <a href="#" class="nav-link">
                                             Customer Name: <span class="float-right badge bg-info"><?php echo $cvalue['customer_name'];?></span>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="#" class="nav-link">
                                             Main Reference Name: <span class="float-right badge bg-info"><?php echo $cvalue['reference_name'];?></span>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="#" class="nav-link">
                                            Second Reference: <span class="float-right badge bg-info"><?php echo $cvalue['second_reference_name'];?></span>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="" class="nav-link">
                                            Second Reference Contact No: <span class="float-right badge bg-primary"><?php echo $cvalue['second_reference_phone'];?></span>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="#" class="nav-link">
                                             Comission Amount: <span class="float-right badge bg-primary"><?php echo floor(($cvalue['total']*$cvalue['second_referral_percentage'])/100); ?> Taka</span>
                                          </a>
                                        </li>
                                        
                                         <li class="nav-item mb-3">
                                          <button type="button" class="btn btn-outline-danger btn-block payreferral" data-toggle="modal" data-target="#modal-secondary" data-name="<?php echo $cvalue['second_reference_name'];?>" data-id="<?php echo $cvalue['id'];?>" data-pd="<?php echo $cvalue['scnd_ref_comission_no'];?>"><i class="fas fa-money-bill-alt"></i> Pay the <?php echo ordinal($cvalue['scnd_ref_comission_no']);?>  Comission (<?php echo floor(($cvalue['total']*$cvalue['second_referral_percentage'])/100); ?> Taka)</button>
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
              <p>Have you just paid <span id="customer_name_modal"></span>?</p>
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
              <p>Have you just paid <span id="reference_name_modal"></span>?</p>
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

  <?php    
    require(realpath('./footer.php'));
  ?>

  <?php    
    require(realpath('./right_sidebar.php'));
  ?>
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

<?php 
    require(realpath('./common_script.php'));
?>

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
