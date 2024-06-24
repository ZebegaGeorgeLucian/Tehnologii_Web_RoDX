<?php
if (!class_exists('ErrorController')) {
    class ErrorController {
        public static function handle($message, $statusCode = 500) {
            error_log("Error [$statusCode]: $message");
            http_response_code($statusCode);
            header('Content-Type: application/json'); // Ensure JSON content type
            echo json_encode([
                'status' => 'error',
                'message' => $message
            ]);
            exit();
        }
    }
}
?>
