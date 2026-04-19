<?php
/* ========================================
   GET-FORM.PHP - Load Form Data
   ======================================== */

// Set JSON header FIRST
header('Content-Type: application/json');

try {
    // Include required files with error checking
    if (!file_exists('config.php')) {
        die(json_encode(['success' => false, 'error' => 'config.php not found']));
    }
    require_once 'config.php';
    
    if (!file_exists('functions.php')) {
        die(json_encode(['success' => false, 'error' => 'functions.php not found']));
    }
    require_once 'functions.php';

    // Get form ID from URL parameter
    $formId = $_GET['id'] ?? null;

    // Validate input
    if (!$formId) {
        die(json_encode(['success' => false, 'error' => 'Form ID is required']));
    }

    // Sanitize form ID (only allow alphanumeric)
    $formId = preg_replace('/[^a-zA-Z0-9]/', '', $formId);

    if (empty($formId)) {
        die(json_encode(['success' => false, 'error' => 'Invalid form ID']));
    }

    // Get form from database
    $form = getForm($conn, $formId);

    // Check if form was found
    if ($form) {
        echo json_encode(['success' => true, 'form' => $form]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Form not found']);
    }

    $conn->close();
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}
?>