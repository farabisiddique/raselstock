<?php
//logout.php
setcookie("email", "", time()-3600);

header("location:index.php");

?>