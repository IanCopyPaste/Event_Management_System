<?php
/* ========================================
   FUNCTIONS.PHP - All Reusable Functions
   ======================================== */

/**
 * Generate unique random form ID
 * 
 * @param object $conn Database connection
 * @param int $length Length of ID
 * @return string Unique form ID
 */
function generateFormId($conn, $length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    do {
        $formId = '';
        $max = strlen($characters) - 1;
        
        for ($i = 0; $i < $length; $i++) {
            $formId .= $characters[random_int(0, $max)];
        }
        
        // Check if ID already exists
        $stmt = $conn->prepare("SELECT form_id FROM forms WHERE form_id = ?");
        $stmt->bind_param("s", $formId);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        
    } while ($exists);
    
    return $formId;
}

/**
 * Save form to database
 * 
 * @param object $conn Database connection
 * @param array $formData Form data array
 * @param int $userId User ID (optional)
 * @return string|false Form ID on success, false on failure
 */
function saveForm($conn, $formData, $userId = null) {
    $formId = generateFormId($conn);
    $title = $formData['title'];
    $description = $formData['description'] ?? '';
    $jsonData = json_encode($formData);
    
    $stmt = $conn->prepare("INSERT INTO forms (form_id, title, description, form_data, user_id) VALUES (?, ?, ?, ?, ?)"); //should be event_id instead of user_id
    $stmt->bind_param("ssssi", $formId, $title, $description, $jsonData, $userId);
    $success = $stmt->execute();
    $stmt->close();
    
    return $success ? $formId : false;
}

/**
 * Get form by ID
 * 
 * @param object $conn Database connection
 * @param string $formId Form ID
 * @return array|null Form data or null if not found
 */
function getForm($conn, $formId) {
    $stmt = $conn->prepare("SELECT * FROM forms WHERE form_id = ?");
    $stmt->bind_param("s", $formId);
    $stmt->execute();
    $result = $stmt->get_result();
    $form = $result->fetch_assoc();
    $stmt->close();
    
    if ($form) {
        $form['questions'] = json_decode($form['form_data'], true)['questions'];
    }
    
    return $form;
}

/**
 * Save response
 * 
 * @param object $conn Database connection
 * @param string $formId Form ID
 * @param array $answers Answer data
 * @return bool Success status
 */
function saveResponse($conn, $formId, $answers) {
    $responseId = uniqid('resp_', true);
    $jsonData = json_encode($answers);
    
    $stmt = $conn->prepare("INSERT INTO form_responses (response_id, form_id, response_data) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $responseId, $formId, $jsonData);
    $success = $stmt->execute();
    $stmt->close();
    
    return $success;
}

/**
 * Get all responses for a form
 * 
 * @param object $conn Database connection
 * @param string $formId Form ID
 * @return array Array of responses
 */
function getResponses($conn, $formId) {
    $stmt = $conn->prepare("SELECT * FROM form_responses WHERE form_id = ? ORDER BY submitted_at DESC");
    $stmt->bind_param("s", $formId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $responses = [];
    while ($row = $result->fetch_assoc()) {
        $responses[] = [
            'id' => $row['response_id'],
            'submitted_at' => $row['submitted_at'],
            'data' => json_decode($row['response_data'], true)
        ];
    }
    $stmt->close();
    
    return $responses;
}

/**
 * Build URL for form
 * 
 * @param string $formId Form ID
 * @return string Full URL
 */
function buildFormUrl($formId) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $baseDir = dirname($_SERVER['PHP_SELF']);
    
    return $protocol . "://" . $host . $baseDir . "/../pages/view-form.html?id=" . $formId;
}

/**
 * Send JSON response
 * 
 * @param array $data Data to send
 */
function jsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
?>