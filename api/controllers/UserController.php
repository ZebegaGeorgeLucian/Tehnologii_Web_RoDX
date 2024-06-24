<?php
// Ensure no output before this point
ob_start(); // Start output buffering

ini_set('display_errors', 0); // Disable displaying errors
ini_set('display_startup_errors', 0); // Disable startup errors
error_reporting(E_ALL); // Report all errors

require_once __DIR__ . '/../db/connection.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../helpers/JwtHelper.php';

header('Content-Type: application/json'); // Ensure the content type is JSON

class UserController {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
        if ($this->conn->connect_error) {
            $this->handleError("Database connection failed: " . $this->conn->connect_error, 500);
        }
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            if (!$data) {
                error_log("Invalid JSON: " . file_get_contents("php://input"));
                $this->handleError('Invalid JSON', 400);
            }

            $first_name = $data['first_name'] ?? '';
            $last_name = $data['last_name'] ?? '';
            $username = $data['username'] ?? '';
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';
            $confirm_password = $data['confirm_password'] ?? '';

            if ($password !== $confirm_password) {
                $this->handleError('Passwords do not match', 400);
            }

            $user = new User($this->conn);
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->username = $username;
            $user->email = $email;
            $user->password = password_hash($password, PASSWORD_BCRYPT);

            // Check if username or email already exists
            if ($user->exists()) {
                $this->handleError('Username or Email already exists', 400);
            }

            if ($user->create()) {
                http_response_code(201);
                echo json_encode(['status' => 'success', 'message' => 'Registration successful']);
            } else {
                $errorMsg = $this->conn->error ? $this->conn->error : "Unknown error";
                error_log("Error registering user: " . $errorMsg);
                $this->handleError('Error registering user: ' . $errorMsg, 500);
            }
        } else {
            $this->handleError('Invalid request method', 405);
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            if (!$data) {
                error_log("Invalid JSON: " . file_get_contents("php://input"));
                $this->handleError('Invalid JSON', 400);
            }

            $username = $data['username'] ?? '';
            $password = $data['password'] ?? '';

            if (empty($username) || empty($password)) {
                error_log("Username or password is empty.");
                $this->handleError('Username and password are required', 400);
            }

            $user = new User($this->conn);
            $user->username = $username;


            if ($user->login() && password_verify($password, $user->password)) {
                $token = JwtHelper::generateToken(['id' => $user->id, 'username' => $user->username], 'your_secret_key');
                http_response_code(200);
                echo json_encode(['status' => 'success', 'message' => 'Login successful', 'token' => $token]);
            } else {
                error_log("Invalid username or password for user: " . $username);
                $this->handleError('Invalid username or password', 401);
            }
        } else {
            $this->handleError('Invalid request method', 405);
        }
    }

    private function handleError($message, $statusCode) {
        error_log("Error: $message"); // Log the error message
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => $message]);
        ob_end_flush(); // End output buffering and flush output
        exit();
    }
}

// Flush output buffer at the end of the script
ob_end_flush();
?>
