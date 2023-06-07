<?php

class Employee {
    public $name;
    public $email;
    public $contact;
    public $address;
    public $id;


    private $conn;
    private $table_name;

    public function __construct($db) {
        $this->conn = $db;
        $this->table_name = "employee";
    }

    public function create_data() {
        $query = "INSERT INTO " . $this->table_name . "
        SET name = ?, email = ?, contact = ?, address = ?, password = ?";

        $stmt = $this->conn->prepare($query);


        // Bind the parameters
        $stmt->bind_param("sssss", $this->name, $this->email, $this->contact, $this->address, $this->password);

        // Execute the prepared statement
        if ($stmt->execute()) {
            return true; // Data insertion successful
        } else {
            return false; // Data insertion failed
        }
    }


    public function show_all() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . "
        WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true; // Data Deleted successfully
        } else {
            return false; // Data Deletion failed
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table_name ."
        SET name = ?, email = ?, contact = ?, address = ?, password = ? WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('sssssi', $this->name, $this->email, $this->contact, $this->address, $this->password, 
            $this->id);

        if ($stmt->execute()) {
            return true;
        }else {
            return false;
        }
    }


    public function search($id) {
        $query = "SELECT * FROM " .$this->table_name. " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result;
        }else {
            return false;
        }
    }

     public function signup() {
        $query = "INSERT INTO " . $this->table_name . "
        SET name = ?, email = ?, contact = ?, address = ?, password = ?";

        $stmt = $this->conn->prepare($query);

        // Bind the parameters
        $stmt->bind_param("sssss", $this->name, $this->email, $this->contact, $this->address, $this->password);

        // Execute the prepared statement
        if ($stmt->execute()) {
            return true; // Signup successful
        } else {
            return false; // Signup failed
        }
    }

    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    return $row; // Login successful, return user data
                }
            }
        }
        return false; // Login failed
    }



}

?>
