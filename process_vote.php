<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if voterID and candidate are provided
    if (isset($_POST["voterID"], $_POST["candidate"])) {
        $voterID = $_POST["voterID"];
        $candidate = $_POST["candidate"];

        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = ""; // Your database password
        $database = "db_evoting"; // Your database name
        $table = "tbl_votes"; // Your table name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement
        $sql = "INSERT INTO $table (voterID, candidate) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ss", $voterID, $candidate);

        // Execute SQL statement
        if ($stmt->execute()) {
            // Vote successfully recorded
            echo "success"; // Send success message back to JavaScript
        } else {
            echo "Error inserting record: " . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "VoterID or candidate not provided.";
    }
} else {
    echo "Form was not submitted.";
}
?>
