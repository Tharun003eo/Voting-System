<?php
session_start();

// Check if OTP exists in the session
if (isset($_SESSION['otp'])) {
    // Twilio credentials
    $accountSid = 'ACf93627a75f0a0e6e32bf63e2e48b0298';
    $authToken = '3146c92a1a4e2f83be7768d81ffc2d46';

    // Twilio phone number
    $twilioNumber = '+17346723171';

    // Recipient's phone number (received via POST)
    $recipientNumber = $_POST['mobile'];

    // Validate and sanitize mobile number
    $recipientNumber = filter_var($recipientNumber, FILTER_SANITIZE_NUMBER_INT);

    // Check if the number is 10 digits long
    if (!preg_match('/^\d{10}$/', $recipientNumber)) {
        http_response_code(400);
        exit(json_encode(array("success" => false, "message" => "Invalid mobile number format.")));
    }

    // Add country code +91 if not present
    if (strlen($recipientNumber) == 10) {
        $recipientNumber = '+91' . $recipientNumber;
    }

    // Twilio API URL
    $url = "https://api.twilio.com/2010-04-01/Accounts/$accountSid/Messages.json";

    // Message to send (using the OTP from the session)
    $otp = $_SESSION['otp'];
    $message = "Your OTP for Aadhar verification is: $otp";

    // Create an array of parameters to send to the Twilio API
    $data = array(
        'From' => $twilioNumber,
        'To' => $recipientNumber,
        'Body' => $message
    );

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options for POST request
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$accountSid:$authToken");

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        http_response_code(500);
        echo json_encode(array("success" => false, "message" => "Failed to resend OTP. Curl error: " . curl_error($ch)));
        exit;
    }

    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Check if the message was successfully sent
    if (isset($responseData['sid'])) {
        http_response_code(200);
        echo json_encode(array("success" => true, "message" => "OTP Resent Successfully!"));
    } else {
        http_response_code(500);
        echo json_encode(array("success" => false, "message" => "Failed to resend OTP. Error: " . $responseData['message']));
    }

    // Close cURL session
    curl_close($ch);
} else {
    http_response_code(500);
    echo json_encode(array("success" => false, "message" => "No OTP found in session. Please try again."));
}
?>
