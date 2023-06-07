<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json; charset=UTF-8');



include_once('../config/database.php');
include_once('../classes/Employee.php');


$db = new Database();
$connection = $db->connect();


$employee = new Employee($connection);


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$data = $employee->search($id);
		if ($data->num_rows>0 && $data->num_rows==1) {
			$emps = array();
			while ($row = $data->fetch_assoc()) {
				$emps[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'contact' => $row['contact'],
					'address' => $row['address'],
                    'password' => $row['password'],
                );
			}
			http_response_code(201);
			echo json_encode(array('status'=>'success', 'data'=>$emps));
		}else {
			http_response_code(404);
            echo json_encode(array('status' => 'error', 'message' => 'No Record Found.'));
		}

	}else {
		http_response_code(400);
        echo json_encode(array('status' => 'error', 'message' => 'Missing ID parameter.'));
	}

}else {
	http_response_code(405);
	echo json_encode(array('status'=>'error', 'message'=>'POST method is not allowed.'));
}


 ?>