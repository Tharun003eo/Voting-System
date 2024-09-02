<?php
session_start();

// Check if OTP exists in the session
if (isset($_SESSION['otp'])) {
    // Get the entered OTP from POST data
    $enteredOTP = $_POST['otp'];

    // Get the stored OTP from the session
    $storedOTP = $_SESSION['otp'];

    // Verify if entered OTP matches the stored OTP
    if ($enteredOTP == $storedOTP) {
        // OTP is verified successfully
        http_response_code(200);
        echo json_encode(array("success" => true, "message" => "OTP Verified Successfully!"));

        // Additional actions after OTP verification
    } else {
        // Incorrect OTP
        http_response_code(400);
        echo json_encode(array("success" => false, "message" => "Incorrect OTP. Please try again."));
    }
} else {
    // No OTP found in session
    http_response_code(400);
    echo json_encode(array("success" => false, "message" => "OTP not found in session. Please try again."));
}
?>
