<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');

// Clear any existing user session or authentication data
// For example, you can unset session variables or remove cookies

unset($_SESSION['user']); // Assuming you stored user data in the 'user' session variable

// You can also remove authentication cookies if any
// setcookie('auth_token', '', time() - 3600, '/');

http_response_code(200);
echo json_encode(array('status' => 'success', 'message' => 'Logout Successful.'));

?>
