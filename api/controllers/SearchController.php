<?php
require_once __DIR__ . '/../db/connection.php';

header('Content-Type: application/json');

// Connect to the drug_data database
$conn = getConnection(DB_NAME_DRUG_DATA);

$response = ['status' => 'error', 'message' => 'Invalid request'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['csv'])) {
        generateCSV($conn);
        exit();
    }

    $year = isset($_GET['year']) ? filter_var($_GET['year'], FILTER_VALIDATE_INT) : 0;
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $chart_type = isset($_GET['chart_type']) ? $_GET['chart_type'] : '';
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $filter_value = isset($_GET['filter_value']) ? $_GET['filter_value'] : '';

    error_log("Year: $year, Type: $type, Chart Type: $chart_type, Filter: $filter, Filter Value: $filter_value");

    $allowedTypes = ['confiscari', 'urgente_medicale', 'campanii_prevenire'];
    if ($year > 0 && in_array($type, $allowedTypes)) {
        $params = [];
        $types = "i";
        $sql = "";

        if ($type == 'urgente_medicale') {
            $sql = "SELECT drug_name, SUM(cases) AS value FROM urgente_medicale WHERE year = ?";
            $params[] = $year;
            $types = "i"; // Initializing the types string for bind_param
        
            if ($filter && $filter_value) {
                $sql .= " AND $filter = ?";
                $params[] = $filter_value;
                $types .= "s"; // Adding string type for the filter value
            }
        
            $sql .= " GROUP BY drug_name";
        }
         if ($type == 'confiscari') {
            $sql = "SELECT drug_name, ";
            if ($filter) {
                $sql .= "SUM($filter) AS value ";
            } else {
                $sql .= "SUM(grame) AS grame, SUM(comprimate) AS comprimate, SUM(doze_buc) AS doze_buc, SUM(mililitri) AS mililitri, SUM(nr_capturi) AS nr_capturi ";
            }
            $sql .= "FROM confiscari WHERE year = ?";
            $params[] = $year;
            
            if ($filter && $filter_value) {
                $sql .= " AND $filter = ?";
                $params[] = $filter_value;
                $types .= "s";
            }
        
            $sql .= " GROUP BY drug_name";
        }
        
        error_log("SQL: $sql with params: " . implode(", ", $params));  // Log the final SQL and parameters
        
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            http_response_code(500);
            $response['message'] = 'Database error: ' . htmlspecialchars($conn->error);
            error_log("Database error: " . htmlspecialchars($conn->error));  // Log database errors
            echo json_encode($response);
            exit();
        }
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        if (!$stmt->execute()) {
            http_response_code(500);
            $response['message'] = 'Error executing query: ' . htmlspecialchars($stmt->error);
            error_log("Error executing query: " . htmlspecialchars($stmt->error));  // Log query execution errors
            echo json_encode($response);
            $stmt->close();
            exit();
        }
        
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        error_log("Data: " . print_r($data, true));  // Log fetched data
        
        if (empty($data)) {
            $response = [
                'status' => 'error',
                'message' => 'No data found for the given parameters.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $data
            ];
        }
        $stmt->close();
        
        
    } else {
        http_response_code(400);
        $response['message'] = 'Invalid parameters.';
    }
} else {
    http_response_code(405);
    $response['message'] = 'Method not allowed. Please use GET.';
}

echo json_encode($response);
$conn->close();

function generateCSV($conn) {
    $year = isset($_GET['year']) ? filter_var($_GET['year'], FILTER_VALIDATE_INT) : 0;
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $filter_value = isset($_GET['filter_value']) ? $_GET['filter_value'] : '';

    if ($year > 0 && in_array($type, ['confiscari', 'urgente_medicale'])) {
        $params = [];
        $types = "i";
        $sql = "";

        if ($type == 'urgente_medicale') {
            $sql = "SELECT drug_name, SUM(cases) AS value FROM urgente_medicale WHERE year = ?";
            $params[] = $year;

            if ($filter && $filter_value) {
                $sql .= " AND $filter = ?";
                $params[] = $filter_value;
                $types .= "s";
            }

            $sql .= " GROUP BY drug_name";
        } if ($type == 'confiscari') {
            $sql = "SELECT drug_name, ";
            if ($filter) {
                $sql .= "SUM($filter) AS value ";
            } else {
                $sql .= "SUM(grame) AS grame, SUM(comprimate) AS comprimate, SUM(doze_buc) AS doze_buc, SUM(mililitri) AS mililitri, SUM(nr_capturi) AS nr_capturi ";
            }
            $sql .= "FROM confiscari WHERE year = ?";
            $params[] = $year;
            
            if ($filter && $filter_value) {
                $sql .= " AND $filter = ?";
                $params[] = $filter_value;
                $types .= "s";
            }
        
            $sql .= " GROUP BY drug_name";
        }

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            http_response_code(500);
            echo 'Database error: ' . htmlspecialchars($conn->error);
            exit();
        }
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        if (!$stmt->execute()) {
            http_response_code(500);
            echo 'Error executing query: ' . htmlspecialchars($stmt->error);
            $stmt->close();
            exit();
        }
        
        $result = $stmt->get_result();
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="data.csv"');
        
        $output = fopen('php://output', 'w');
        
        // Output the column headings
        if ($type == 'confiscari') {
            if ($filter) {
                fputcsv($output, ['Drug Name', ucfirst($filter)]);
            } else {
                fputcsv($output, ['Drug Name', 'Grame', 'Comprimate', 'Doze Buc', 'Mililitri', 'Nr Capturi']);
            }
        } else {
            fputcsv($output, ['Drug Name', 'Cases']);
        }
        
        // Output the rows
        while ($row = $result->fetch_assoc()) {
            if ($type == 'confiscari' && $filter) {
                fputcsv($output, [$row['drug_name'], $row['value']]);
            } else {
                fputcsv($output, $row);
            }
        }
        
        fclose($output);
        $stmt->close();
        exit();
    } else {
        http_response_code(400);
        echo 'Invalid parameters.';
        exit();
    }
}

?>