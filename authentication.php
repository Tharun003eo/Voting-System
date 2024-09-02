<?php
// Credentials
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

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['adminUserName']) || empty($_POST['adminPassword'])) {
    header("location: admin.php?error=empty");
    exit;
  } else {
    $admin_username = test_input($_POST['adminUserName']);
    $admin_password = test_input($_POST['adminPassword']);

    // Establish Connection
    $conn = mysqli_connect($hostname, $username, $password, $database);

    // Check Connection
    if (!$conn) {
      die("Connection Failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM tbl_admin WHERE admin_username='$admin_username' AND admin_password='$admin_password'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) == 1) {
      // Authentication Successful
      session_start();
      $_SESSION['admin_username'] = $admin_username;
      header("location: cpanel.php");
      exit;
    } else {
      header("location: admin.php?error=invalid");
      exit;
    }

    mysqli_close($conn);
  }
} else {
  // Redirect if accessed directly
  header("location: admin.php");
  exit;
}
?>
