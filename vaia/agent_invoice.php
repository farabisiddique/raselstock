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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="./add-new-admin.php" class="nav-link">Add New Admin</a>
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
            <a href="./accepted.php" class="nav-link active">
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
            <a href="./settings.php" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Change Settings
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./add-new-admin.php" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Add New Admin
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./agent_invoice.php" class="nav-link bg-danger">
              <i class="nav-icon fas fa-hands-helping"></i>
              <p>
                Agent Invoice
                
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
