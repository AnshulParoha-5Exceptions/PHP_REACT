<?php 

class Database {

	//declaring variables
	private $hostname;
	private $dbname;
	private $username;
	private $password;
	private $conn;


	public function connect() {

	//initializing variables
	$this->hostname = "localhost";
	$this->dbname 	= "API";
	$this->username = "root";
	$this->password = "";

	$this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);

		if($this->conn->connect_error) {
			echo($this->conn->connect_error);
			exit();
		}else {
			return $this->conn;
		}

	}

}


 ?>