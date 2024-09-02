<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_evoting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Voter ID to delete
$voterID = "TAU8667341";

try {
    // Start a transaction
    $conn->begin_transaction();

    // Delete records from tbl_votes related to the user
    $deleteVotesQuery = "DELETE FROM tbl_votes WHERE voterID = ?";
    $deleteVotesStmt = $conn->prepare($deleteVotesQuery);
    $deleteVotesStmt->bind_param("s", $voterID);
    $deleteVotesStmt->execute();

    // Delete the user record
    $deleteUserQuery = "DELETE FROM tbl_users WHERE voterID = ?";
    $deleteUserStmt = $conn->prepare($deleteUserQuery);
    $deleteUserStmt->bind_param("s", $voterID);
    $deleteUserStmt->execute();

    // Commit the transaction
    $conn->commit();

    echo "Record deleted successfully";

} catch (mysqli_sql_exception $e) {
    // Rollback the transaction on error
    $conn->rollback();
    echo "Error deleting record: " . $e->getMessage();
}

// Close statements and connection
$deleteVotesStmt->close();
$deleteUserStmt->close();
$conn->close();
?>
