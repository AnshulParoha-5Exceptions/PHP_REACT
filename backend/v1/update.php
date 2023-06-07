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

	if (!empty($data->name) && !empty($data->email) && !empty($data->contact)) {
		$employee->id = $data->id;
		$employee->name = ucwords($data->name);
		$employee->email = $data->email;
		$employee->contact = $data->contact;
		$employee->address = ucwords($data->address);
		$employee->password  = $data->password;

		if ($employee->update()) {
			http_response_code(201);
			echo json_encode(array('status'=>'success', 'message'=>'Updated Successfully.'));
		}else {
			http_response_code(501);
			echo json_encode(array('status'=>'error', 'message'=>'Failed to update data.'));
		}
	}else {
		http_request_method_register(400);
		echo json_encode(array('status'=>'error', 'message'=>'Missing or invalid data.'));
	}
}else {
	http_response_code(405);
	echo json_encode(array('status'=>'error', 'message'=>'GET method is not allowed.'));
}


 ?>