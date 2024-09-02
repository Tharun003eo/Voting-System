<?php
// Database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_evoting";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if Aadhar number is provided
if (isset($_POST['aadhar'])) {
    $aadhar = mysqli_real_escape_string($conn, $_POST['aadhar']);

    // Insert a record into tbl_voted_users to mark Aadhar as voted
    $sql = "INSERT INTO tbl_voted_users (aadhar_number) VALUES ('$aadhar')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $response = array("success" => true);
        echo json_encode($response);
    } else {
        $response = array("success" => false, "error" => mysqli_error($conn));
        echo json_encode($response);
    }
} else {
    $response = array("success" => false);
    echo json_encode($response);
}

mysqli_close($conn);
?>
