<?php
//logout.php
// setcookie("email", "", time()-3600);
setcookie('email', null, -1, '/'); 

// die(var_dump($_COOKIE["email"]));

header("location:index.php");

?>