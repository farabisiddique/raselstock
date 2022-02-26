<?php

  function find_the_next_day($curdate,$days){
        
        $next_date = date('Y-m-d', strtotime("$curdate +$days days"));
        $next_date_day_find=getdate(strtotime($next_date));
        // $mydate=getdate(strtotime($curdate));

        switch($next_date_day_find['wday']){
            case 0: // sun
              $final_date = $next_date;
                break;
            case 1: // mon
              $final_date = $next_date;
                break;
            case 2: // tue
              $final_date = $next_date;
                break;
            case 3: // wed
              $final_date = $next_date;
                break;
            case 4: // thu
              $final_date = $next_date;               
                break;
            case 5: // fri
              $days = $days+1; 
              $final_date = date('Y-m-d', strtotime("$next_date +1 days"));
                break;
            case 6: // sat
              $final_date = $next_date;
                break;

        }

        return $final_date;

  }
  

if(isset($_COOKIE["email"]))
{ 

    $today = date('Y-m-d');
    $delivery_date = find_the_next_day($today,1);
    $first_payment_date = find_the_next_day($delivery_date,1);
    $date_array = array($first_payment_date);
    
    for($i=0;$i<9;$i++){
      $date_maker = find_the_next_day($date_array[$i],1);
      array_push($date_array,$date_maker);
    }


    foreach ($date_array as $key => $value) {
        $date_array[$key] = date('d/m/Y', strtotime("$value"));
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
        
        <div class="row">
          <div class="content-header col-lg-12">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Agent Invoice Maker</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Agent Invoice Maker</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div>
          </div>
        </div>
        <!-- Main row -->
        <div class="row">
            
              <div class="container-fluid row card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">Delivery Date: &nbsp;<?php echo date('d/m/Y', strtotime("$delivery_date")) ?></h3>
                  </div>
                  <form>
                    <div class="card-body row">
                        <div class="col-md-6">
                                <div class="form-group">
                                  <label for="agentHolderName">Agent Holder Name </label>
                                  <input type="text" class="form-control" id="agentHolderName">
                                </div>

                                <div class="form-group">
                                  <label for="agentPhone">Agent Holder Mobile Number </label>
                                  <input type="number" class="form-control" id="agentPhone">
                                </div>

                                

                                <div class="form-group">
                                  <label for="agentOffice">Agent Office </label>
                                  <input type="text" class="form-control" id="agentOffice">
                                </div>

                        </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                  <label for="agentNo">Number of Agent </label>
                                  <input type="number" class="form-control" id="agentNo">
                                </div>

                                <div class="form-group">
                                  <label for="total">Total</label>
                                  <input type="number" class="form-control" id="total">
                                </div>
                                <div class="form-group">
                                  <label for="unitPrice">Unit Price (Taka)</label>
                                  <input type="number" class="form-control" id="unitPrice" value="50">
                                </div>
                        </div>
     
                    </div>

                    <div class="card-body row">
                        <div class="col-md-12">
                               <table class="table table-hover text-nowrap">
                                  <thead>
                                    <tr>
                                      <th>নং</th>
                                      <th>বিবরণ</th>
                                      <th>পরিমাণ</th>
                                      <th>দর</th>
                                      <th>টাকা</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>১</td>
                                      <td>বিস্কুট</td>
                                      <td><span class="amount"></span></td>
                                      <td><span class="unitPrice"></span></td>
                                      <td><span class="total"></span></td>
                                    </tr>
                                    <tr>
                                      <td colspan="3">&nbsp;</td>
                                      <td>মোট</td>
                                      <td><span class="total"></span></td>
                                    </tr>
                                  </tbody>
                               </table> 

                        </div>
                        
                    </div>
                    <div class="card-body row">
                      <div class="col-md-12">

                        <table class="table table-hover text-wrap">
                          <thead>
                            <tr>
                              <th>নং</th>
                              <th>প্রতিদিন পণ্য বিক্রয় থেকে পুঁজি ফেরত পণ্যের মোট মূল্যের ১০% </th>
                              <th>প্রতিদিন পণ্য বিক্রয় থেকে কিমিশন প্রদান পণ্যের মত মূল্যের ১.১১% </th>
                              <th>পেমেন্ট তারিখ</th>
                              <th>সাক্ষর</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>১ম</td>
                              <td><span class="x10"></span></td>
                              <td><span class="x1point11"></span></td>
                              <td class="payment_date"><?php echo $date_array[0];?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>২য়</td>
                              <td><span class="x10"></span></td>
                              <td><span class="x1point11"></span></td>
                              <td class="payment_date"><?php echo $date_array[1];?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>৩য়</td>
                              <td><span class="x10"></span></td>
                              <td><span class="x1point11"></span></td>
                              <td class="payment_date"><?php echo $date_array[2];?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>৪র্থ</td>
                              <td><span class="x10"></span></td>
                              <td><span class="x1point11"></span></td>
                              <td class="payment_date"><?php echo $date_array[3];?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>৫ম</td>
                              <td><span class="x10"></span></td>
                              <td><span class="x1point11"></span></td>
                              <td class="payment_date"><?php echo $date_array[4];?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>৬ষ্ঠ</td>
                              <td><span class="x10"></span></td>
                              <td><span class="x1point11"></span></td>
                              <td class="payment_date"><?php echo $date_array[5];?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>৭ম</td>
                              <td><span class="x10"></span></td>
                              <td><span class="x1point11"></span></td>
                              <td class="payment_date"><?php echo $date_array[6];?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>৮ম</td>
                              <td><span class="x10"></span></td>
                              <td><span class="x1point11"></span></td>
                              <td class="payment_date"><?php echo $date_array[7];?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>৯ম</td>
                              <td><span class="x10"></span></td>
                              <td><span class="x1point11"></span></td>
                              <td class="payment_date"><?php echo $date_array[8];?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>১০ম</td>
                              <td><span class="x10"></span></td>
                              <td><span class="x1point11"></span></td>
                              <td class="payment_date"><?php echo $date_array[9];?></td>
                              <td>&nbsp;</td>
                            </tr>
                          </tbody>
                        </table>

                        <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">ক্যাশ মেমো প্রিন্ট করুন</button>
                                </div>
                      </div>
                    </div>


                  </form>

              </div>
                

               

              </div>

              
            
        </div>
        
      </div>
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

<script src="dist/js/pages/dashboard.js"></script>

<?php 
    require(realpath('./common_script.php'));
?>

<script type="text/javascript">

      var total = $("#total").val();
      var unit_price = $("#unitPrice").val();

      if(total && unit_price){

          var amount = Math.ceil(total/unit_price);
          var x10value = Math.floor((total*10)/100);
          var comission = Math.floor((total*1.11)/100);
          
          $(".unitPrice").html(unit_price+"&nbsp;টাকা");
          $(".total").html(total+"&nbsp;টাকা");
          $(".amount").html(amount+"&nbsp;প্যাকেট");
          $(".x10").html(x10value+"&nbsp;/-");
          $(".x1point11").html(comission+"&nbsp;/-");

      }
    
    $("#total").keyup(function(){

      var total = $("#total").val();
      var unit_price = $("#unitPrice").val();

      if(total && unit_price){

          var amount = Math.ceil(total/unit_price);
          var x10value = Math.floor((total*10)/100);
          var comission = Math.floor((total*1.11)/100);

          $(".unitPrice").html(unit_price+"&nbsp;টাকা");
          $(".total").html(total+"&nbsp;টাকা");
          $(".amount").html(amount+"&nbsp;প্যাকেট");
          $(".x10").html(x10value+"&nbsp;/-");
          $(".x1point11").html(comission+"&nbsp;/-");

      }


    });

    $("#unitPrice").keyup(function(){

      var total = $("#total").val();
      var unit_price = $("#unitPrice").val();

      console.log(unit_price);

        if(total && unit_price){

            var amount = Math.ceil(total/unit_price);
            var x10value = Math.floor((total*10)/100);
            var comission = Math.floor((total*1.11)/100);

            $(".unitPrice").html(unit_price+"&nbsp;টাকা");
            $(".total").html(total+"&nbsp;টাকা");
            $(".amount").html(amount+"&nbsp;প্যাকেট");
            $(".x10").html(x10value+"&nbsp;/-");
            $(".x1point11").html(comission+"&nbsp;/-");

        }


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
