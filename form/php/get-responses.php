<?php
/* ========================================
   GET-RESPONSES.PHP - Load Form Responses
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

    // Get form ID from URL
    $formId = $_GET['id'] ?? null;

    // Validate input
    if (!$formId) {
        die(json_encode(['success' => false, 'error' => 'Form ID is required']));
    }

    // Sanitize form ID
    $formId = preg_replace('/[^a-zA-Z0-9]/', '', $formId);

    if (empty($formId)) {
        die(json_encode(['success' => false, 'error' => 'Invalid form ID']));
    }

    // Get form
    $form = getForm($conn, $formId);

    if (!$form) {
        die(json_encode(['success' => false, 'error' => 'Form not found']));
    }

    // Get all responses for this form
    $responses = getResponses($conn, $formId);

    // Return form data with responses
    echo json_encode([
        'success' => true,
        'form' => [
            'title' => $form['title'],
            'description' => $form['description'],
            'questions' => $form['questions'],
            'responses' => $responses
        ]
    ]);

    $conn->close();
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}
?>