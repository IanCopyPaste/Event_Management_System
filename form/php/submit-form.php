<?php
/* ========================================
   SUBMIT-FORM.PHP - Save Form Response
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

    // Get JSON input
    $input = file_get_contents('php://input');
    
    if (empty($input)) {
        die(json_encode(['success' => false, 'error' => 'No data received']));
    }
    
    $data = json_decode($input, true);

    // Validate JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        die(json_encode(['success' => false, 'error' => 'Invalid JSON: ' . json_last_error_msg()]));
    }

    // Validate required fields
    if (!$data || !isset($data['form_id']) || !isset($data['answers'])) {
        die(json_encode(['success' => false, 'error' => 'Invalid submission data - missing form_id or answers']));
    }

    $formId = $data['form_id'];
    $answers = $data['answers'];

    // Validate form ID
    $formId = preg_replace('/[^a-zA-Z0-9]/', '', $formId);
    
    if (empty($formId)) {
        die(json_encode(['success' => false, 'error' => 'Invalid form ID']));
    }

    // Check if form exists
    $form = getForm($conn, $formId);
    if (!$form) {
        die(json_encode(['success' => false, 'error' => 'Form not found']));
    }

    // Save response
    $success = saveResponse($conn, $formId, $answers);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Response submitted successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to save response']);
    }

    $conn->close();
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}
?>