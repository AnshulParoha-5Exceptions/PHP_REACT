<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');

include_once('../config/database.php');
include_once('../classes/Employee.php');


//creating database object and connection
$db = new Database();
$connection = $db->connect();

//creating Employee class
$employee = new Employee($connection);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	if (isset($_GET['id'])) {
		$empID = $_GET['id'];
		$result = $employee->delete($empID);

		if ($result !== false) {
		http_response_code(201);
		echo json_encode(array('status'=>'success', 'message'=> "Deleted Successfully.", 'data'=>$result));
	}else {
		http_response_code(500);
		echo json_encode(array('status'=>'error', 'message'=> "Failed to Delete Data."));
	}
}else {
	http_response_code(400);
	echo json_encode(array('status'=> 'error', 'message'=> 'Missing Id parameter.'));
	}

}else {
	http_response_code(405);
	echo json_encode(array('status'=> 'error', 'message'=> 'POST method is not allowed.'));
}



 ?>