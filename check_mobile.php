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

// Check if Mobile exists for the Aadhar
if (isset($_POST['aadhar']) && isset($_POST['mobile'])) {
    $aadhar = mysqli_real_escape_string($conn, $_POST['aadhar']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

    $sql = "SELECT * FROM tbl_aadhar WHERE aadhar_number = '$aadhar' AND mobile_number = '$mobile'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $response = array("exists" => true);
        echo json_encode($response);
    } else {
        $response = array("exists" => false);
        echo json_encode($response);
    }
} else {
    $response = array("exists" => false);
    echo json_encode($response);
}

mysqli_close($conn);
?>
