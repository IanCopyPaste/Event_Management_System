<?php
/* ========================================
   CREATE-FORM.PHP - Save New Form
   ======================================== */

// Set JSON header FIRST (before any output)
header('Content-Type: application/json');

// Catch any errors
try {
    // Include required files with error checking
    if (!file_exists('config.php')) {
        die(json_encode(['success' => false, 'error' => 'config.php not found in: ' . __DIR__]));
    }
    require_once 'config.php';
    
    if (!file_exists('functions.php')) {
        die(json_encode(['success' => false, 'error' => 'functions.php not found in: ' . __DIR__]));
    }
    require_once 'functions.php';
    
    // Check if database connection exists
    if (!isset($conn) || $conn->connect_error) {
        die(json_encode(['success' => false, 'error' => 'Database connection failed: ' . ($conn->connect_error ?? 'No connection')]));
    }

    // Get JSON input from request
    $input = file_get_contents('php://input');
    
    // Check if we received data
    if (empty($input)) {
        die(json_encode(['success' => false, 'error' => 'No data received from client']));
    }
    
    // Decode JSON
    $formData = json_decode($input, true);

    // Check if JSON is valid
    if (json_last_error() !== JSON_ERROR_NONE) {
        die(json_encode(['success' => false, 'error' => 'Invalid JSON data: ' . json_last_error_msg()]));
    }

    // Validate that we have required fields
    if (!$formData || !isset($formData['questions'])) {
        die(json_encode(['success' => false, 'error' => 'Invalid form data - missing questions']));
    }

    // Validate that we have at least one question
    if (empty($formData['questions'])) {
        die(json_encode(['success' => false, 'error' => 'Form must have at least one question']));
    }

    // Try to save the form
    $formId = saveForm($conn, $formData);

    // Check if save was successful
    if ($formId) {
        // Success! Return form ID and URL
        echo json_encode([
            'success' => true,
            'form_id' => $formId,
            'url' => buildFormUrl($formId)
        ]);
    } else {
        // Save failed
        echo json_encode([
            'success' => false,
            'error' => 'Failed to save form to database'
        ]);
    }

    // Close database connection
    $conn->close();
    
} catch (Exception $e) {
    // Catch any unexpected errors
    echo json_encode([
        'success' => false,
        'error' => 'Server error: ' . $e->getMessage()
    ]);
}
?>