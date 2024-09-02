<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "db_evoting";

  // UserInput Test
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Establishing Connection
  $conn = mysqli_connect($hostname, $username, $password, $database);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>
