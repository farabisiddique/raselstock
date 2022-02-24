<?php
  include 'env.php';
  $conn = new mysqli(HOSTNAME, DB_USER, DB_PASS,DB_NAME);
  $conn->set_charset("utf8mb4");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else{
     
  }
 
