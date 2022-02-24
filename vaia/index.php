<?php
ini_set('display_errors',1); error_reporting(E_ALL | E_STRICT);

include(realpath('../db.php'));


if(isset($_COOKIE["email"]))
{
 header("location:accepted.php");
}

$message = '';

if(isset($_POST["login"]))
{ 

 if(empty($_POST["email"]) || empty($_POST["pass"]))
 {
  $message = "<div class='alert alert-danger'>Both Fields are required</div>";
 }
 else
 {   
   
  $email_input = $_POST['email'];
  
  $sql2 = "SELECT * FROM admin_table WHERE email = '$email_input'";

  $result2 = $conn->query($sql2);

  $count = $result2->num_rows;
    
  
  if($count > 0)
  {
   
   while($row = $result2->fetch_assoc()) {

      if($_POST["pass"]==$row["password"])
      { 
       setcookie("email", $row["email"], time()+3600,'/');
       header("location: accepted.php");
      }
      else
      {
       $message = '<div class="alert alert-danger">Wrong Password</div>';
      }
   }
  }
  else
  {
   $message = "<div class='alert alert-danger'>Wrong Email Address</div>";
  }
 }
}


?>

<!DOCTYPE html>
<html>
 <head>
  <title>Rasel Enterprise || Admin Login</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
         <div class="row">

            <div class="col-md-3"></div>
            
            <div class="panel panel-default col-md-5 mx-auto" style="background-color:rgba(0, 0, 0, 0.6);">
               
               <br />
               <div class="panel-heading" style="background:none;"><h2 align="center">Rasel Enterprise Admin Login</h2></div>
                <div class="panel-body">
                 <span><?php echo $message; ?></span>
                    <form action="./index.php" method="post">
                           <div class="form-group">
                            <label>Admin Email</label>
                            <input type="text" name="email" id="user_email" class="form-control" />
                           </div>
                           <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" id="user_password" class="form-control" />
                           </div>
                           <div class="form-group">
                            <input type="submit" name="login" id="login" class="btn btn-info" value="Login" />
                           </div>
                    </form>
                </div>
            </div>
            <br />
         </div>
  </div>
 </body>
</html>
