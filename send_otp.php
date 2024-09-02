<?php
session_start();

// Twilio credentials
$accountSid = 'ACf93627a75f0a0e6e32bf63e2e48b0298';
$authToken = '3146c92a1a4e2f83be7768d81ffc2d46';

// Twilio phone number
$twilioNumber = '+17346723171';

// Recipient's phone number (received via POST)
$recipientNumber = $_POST['mobile'];

// Validate and sanitize mobile number
$recipientNumber = filter_var($recipientNumber, FILTER_SANITIZE_NUMBER_INT);
$recipientNumber = '+91' . substr($recipientNumber, -10); // Assuming Indian phone numbers

// Twilio API URL
$url = "https://api.twilio.com/2010-04-01/Accounts/$accountSid/Messages.json";

// Generate a new OTP
$otp = generateOTP();

// Message to send
$message = "Your OTP for Aadhar verification is: $otp";

// Store the OTP in the session for verification
$_SESSION['otp'] = $otp;

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
    // Log the error for debugging
    error_log("Twilio cURL Error: " . curl_error($ch));
    
    http_response_code(500);
    echo json_encode(array("success" => false, "message" => "Failed to send OTP. Curl error: " . curl_error($ch)));
    exit;
}

// Decode the JSON response
$responseData = json_decode($response, true);

// Check if the message was successfully sent
if (isset($responseData['sid'])) {
    http_response_code(200);
    echo json_encode(array("success" => true, "message" => "OTP Sent Successfully!"));
} else {
    // Log the exact recipientNumber for debugging
    error_log("Twilio Error - Invalid To Phone Number: $recipientNumber");
    
    http_response_code(500);
    echo json_encode(array("success" => false, "message" => "Failed to send OTP. Error: " . $responseData['message']));
}

// Close cURL session
curl_close($ch);

// Function to generate a random 6-digit OTP
function generateOTP() {
    return mt_rand(100000, 999999);
}
?>
