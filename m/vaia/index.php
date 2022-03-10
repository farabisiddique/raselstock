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
  $message = "<div style='padding-left: 25px;' class='alert alert-danger' role='alert'>Both Fields are required</div>";
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
       header("location: ./accepted.php");
      }
      else
      {
       $message = "<div style='padding-left: 25px;' class='alert alert-danger' role='alert'>Wrong Password</div>";
         
      }
   }
  }
  else
  {
   $message = "<div style='padding-left: 25px;' class='alert alert-danger' role='alert'>Wrong Email Address</div>";
  }
 }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rasellogin/rasellogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Rasel Enterprise || Admin Login</title>
</head>
<body>

<div style="background-image: linear-gradient(to right, rgb(127, 0, 255), rgb(225, 0, 255));" class="container-fluid ">
    <div  class="container main-cont mt-3">
        <div class="row">
            <div  class="col-sm-12 col-md-6 col-lg-6 ml-3 back d-flex justify-content-center align-items-center">
                <img class="png" src="rasellogin/images-removebg-preview.png" alt="">
            </div>
    
            <div class="col-sm-12 col-md-6 col-lg-6 ">
                <h3 class="text-center text-white admin">Admin Login</h3>
                <div class="formDiv d-flex justify-content-center">
                    <form action="./index.php" method="post">
                        
                        <?php echo $message; ?>

                        <p class="formBorder"><b>Email</b><br> <input type="email" name="email" required="1" id="email"></p>
                        <p class="formBorder"><b>Passworld</b> <br> <input type="password" name="pass" required="1" id=""></p>

                        <button type="submit" name="login" class="btn btn-success mb-1"><b>Login Now</b></button>
                    </form>
                  </div>
            </div>
        </div>
    </div>    
    

</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
