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

    if (!empty($data->name) && !empty($data->email) && !empty($data->contact) && !empty($data->address) && !empty($data->password)) {
        $employee->name = $data->name;
        $employee->email = $data->email;
        $employee->contact = $data->contact;
        $employee->address = $data->address;
        $employee->password = password_hash($data->password, PASSWORD_DEFAULT);

        if ($employee->signup()) {
            http_response_code(201);
            echo json_encode(array('status' => 'success', 'message' => 'Signup Successful.'));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 'error', 'message' => 'Failed to Signup.'));
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
