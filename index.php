<?php
require 'vendor/autoload.php'; // Ensure this line is included if using Composer
require 'api/controllers/UserController.php';
require 'api/controllers/ErrorController.php';

try {
    // Parse the URL to get the path
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', trim($uri, '/')); // Trim and split the URI

    // Remove the project directory from the URI array
    if ($uri[0] === 'Tehnologii_Web_RoDX') {
        array_shift($uri);
    }

    error_log("Parsed URI: " . print_r($uri, true)); // Debugging statement

    if ($uri[0] !== 'api') {
        error_log("Not an API request"); // Debugging statement
        ErrorController::handle("Endpoint not found", 404);
    }

    $controller = null;

    // Check the endpoint
    switch ($uri[1]) {
        case 'users':
            $controller = new UserController();
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                error_log("Handling registration"); // Debugging statement
                $controller->register();
            } else {
                error_log("Method not allowed for /users: " . $_SERVER["REQUEST_METHOD"]); // Debugging statement
                ErrorController::handle("Method not allowed", 405);
            }
            break;
        case 'login':
            $controller = new UserController();
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                error_log("Handling login"); // Debugging statement
                $controller->login();
            } else {
                error_log("Method not allowed for /login: " . $_SERVER["REQUEST_METHOD"]); // Debugging statement
                ErrorController::handle("Method not allowed", 405);
            }
            break;
        case 'search':
            if ($_SERVER["REQUEST_METHOD"] == 'GET') {
                require_once 'api/controllers/SearchController.php';
            } else {
                error_log("Method not allowed for /search: " . $_SERVER["REQUEST_METHOD"]); // Debugging statement
                ErrorController::handle("Method not allowed", 405);
            }
            break;
        default:
            error_log("Unknown endpoint: " . $uri[1]); // Debugging statement
            ErrorController::handle("Endpoint not found", 404);
    }
} catch (Exception $e) {
    ErrorController::handle($e->getMessage(), 500);
}
?>
