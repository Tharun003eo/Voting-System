<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set
    if (isset($_POST['voterName'], $_POST['voterEmail'], $_POST['voterID'])) {
        $name = $_POST['voterName'];
        $email = $_POST['voterEmail'];
        $voterID = $_POST['voterID'];

        // File upload handling
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadedFile = $_FILES['photo'];

            // Specify the directory where you want to store the uploaded file
            $targetDir = 'uploads/';

            // Create a unique name for the uploaded file
            $targetFile = $targetDir . uniqid() . '_' . $uploadedFile['name'];

            // Move the uploaded file to the new location
            if (move_uploaded_file($uploadedFile['tmp_name'], $targetFile)) {
                // Database credentials
                $servername = "localhost";
                $username = "root";
                $password = ""; // Your database password
                $database = "db_evoting"; // Your database name
                $table = "tbl_users"; // Your table name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare SQL statement (with proper escaping to prevent SQL injection)
                $name = $conn->real_escape_string($name);
                $email = $conn->real_escape_string($email);
                $voterID = $conn->real_escape_string($voterID);
                $targetFile = $conn->real_escape_string($targetFile);

                $sql = "INSERT INTO $table (voterName, voterEmail, voterID, photo) VALUES ('$name', '$email', '$voterID', '$targetFile')";

                try {
                    // Attempt to execute the SQL query
                    if ($conn->query($sql) === TRUE) {
                        // Redirect to a success page
                        header("Location: aadhaar.html");
                        exit; // Make sure to exit after redirection
                    }
                } catch (mysqli_sql_exception $exception) {
                    // Check for duplicate entry error
                    if ($exception->getCode() == 1062) {
                        // Redirect to error_page.html if duplicate voterID is detected
                        header("Location: error_page.html");
                        exit;
                    } else {
                        // Handle other database errors
                        echo "Error inserting record: " . $exception->getMessage();
                    }
                }

                $conn->close();
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Form fields are not set.";
        // Handle case when form fields are not set
    }
} else {
    echo "Form was not submitted.";
    // Handle case when form is not submitted
}
?>
