<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET first_name=?, last_name=?, username=?, email=?, password=?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("sssss", $this->first_name, $this->last_name, $this->username, $this->email, $this->password);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }
    }

    public function login() {
        $query = "SELECT id, password FROM " . $this->table_name . " WHERE username = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($this->id, $this->password);
            $stmt->fetch();
            return true;
        }
        return false;
    }

    public function exists() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE username = ? OR email = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("ss", $this->username, $this->email);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }
}
?>
