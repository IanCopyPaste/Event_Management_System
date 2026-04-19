<?php
/* ========================================
   DIAGNOSTIC.PHP - Check What's Wrong
   ======================================== */

// Start output buffering to catch any stray output
ob_start();

// Set JSON header
header('Content-Type: application/json');

$diagnostics = [
    'php_version' => phpversion(),
    'timestamp' => date('Y-m-d H:i:s'),
    'tests' => []
];

// Test 1: Can we access config.php?
$diagnostics['tests']['config_exists'] = file_exists('config.php');

if (file_exists('config.php')) {
    try {
        require_once 'config.php';
        $diagnostics['tests']['config_loaded'] = true;
        
        // Test database connection
        if (isset($conn) && $conn) {
            $diagnostics['tests']['db_connected'] = !$conn->connect_error;
            $diagnostics['tests']['db_name'] = DB_NAME;
            
            if (!$conn->connect_error) {
                // Check if tables exist
                $result = $conn->query("SHOW TABLES LIKE 'forms'");
                $diagnostics['tests']['forms_table_exists'] = ($result && $result->num_rows > 0);
                
                $result = $conn->query("SHOW TABLES LIKE 'form_responses'");
                $diagnostics['tests']['responses_table_exists'] = ($result && $result->num_rows > 0);
            } else {
                $diagnostics['tests']['db_error'] = $conn->connect_error;
            }
        } else {
            $diagnostics['tests']['db_connected'] = false;
            $diagnostics['tests']['db_error'] = 'No connection object created';
        }
    } catch (Exception $e) {
        $diagnostics['tests']['config_error'] = $e->getMessage();
    }
}

// Test 2: Can we access functions.php?
$diagnostics['tests']['functions_exists'] = file_exists('functions.php');

if (file_exists('functions.php')) {
    try {
        require_once 'functions.php';
        $diagnostics['tests']['functions_loaded'] = true;
        
        // Test if functions exist
        $diagnostics['tests']['generateFormId_exists'] = function_exists('generateFormId');
        $diagnostics['tests']['saveForm_exists'] = function_exists('saveForm');
        $diagnostics['tests']['getForm_exists'] = function_exists('getForm');
        $diagnostics['tests']['jsonResponse_exists'] = function_exists('jsonResponse');
    } catch (Exception $e) {
        $diagnostics['tests']['functions_error'] = $e->getMessage();
    }
}

// Test 3: File permissions
$diagnostics['tests']['php_directory_writable'] = is_writable(__DIR__);
$diagnostics['tests']['current_directory'] = __DIR__;

// Test 4: Check for any buffered output (this would break JSON)
$buffered_output = ob_get_contents();
if (!empty($buffered_output)) {
    $diagnostics['warning'] = 'Unexpected output detected (this breaks JSON)';
    $diagnostics['buffered_output'] = $buffered_output;
}

// Clear buffer and output clean JSON
ob_end_clean();

echo json_encode($diagnostics, JSON_PRETTY_PRINT);
?>