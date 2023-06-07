<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET'); 


//reusing classes
include_once('../config/database.php');
include_once('../classes/Employee.php');

// Creating an object for the database
$db = new Database();   
$connection = $db->connect();

$employee = new Employee($connection);

if($_SERVER['REQUEST_METHOD'] === 'GET') {

	$data = $employee->show_all();
	if ($data->num_rows > 0) {
		$employees = array();
		while ($row = $data->fetch_assoc()) {
			$employees[] = array(
				'id' => $row['id'],
				'name' => $row['name'],
				'email' => $row['email'],
				'contact' => $row['contact'],
				'address' => $row['address'],
				'password' => $row['password'],
			);
		}
		http_response_code(201);
		echo json_encode(array('status'=>'success', 'data'=> $employees));

	}else{
		http_response_code(404);
		echo json_encode(array('status'=>'error', 'message'=> 'No Employees Found.'));
	}
}else {
	http_response_code(405);
    echo json_encode(array('status'=> 'error', 'message'=> 'POST method is not allowed.'));
}

?>
