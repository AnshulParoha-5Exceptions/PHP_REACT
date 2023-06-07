<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');

include_once('../config/database.php');
include_once('../classes/Employee.php');

$db = new Database();
$connection = $db->connect();

$employee = new Employee($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->email) && !empty($data->password)) {
        $email = $data->email;
        $password = $data->password;

        $user = $employee->login($email, $password);

        if ($user) {
            // Login successful, create a session or token for authentication
            // For example, you can use JSON Web Tokens (JWT) to generate a token
            // and return it in the API response
            $token = generate_token($user['id'], $user['email']); // Implement the token generation function

            http_response_code(200);
            echo json_encode(array('status' => 'success', 'message' => 'Login Successful.', 'token' => $token));
        } else {
            http_response_code(401);
            echo json_encode(array('status' => 'error', 'message' => 'Invalid Email or Password.'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'message' => 'Invalid or Missing Data.'));
    }
} else {
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'GET method is not allowed.'));
}

?>
