<?php
// fetch_respondents.php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$db   = 'your_database_name';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

$event_id = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0;

if ($event_id > 0) {
    // Join responses and users table to get full attendee details
    $sql = "SELECT u.first_name, u.last_name, u.middle_name, u.email, u.contact_no, u.year_level, u.program_id, r.created_at 
            FROM responses r 
            JOIN users u ON r.users_id = u.users_id 
            WHERE r.event_id = ? 
            ORDER BY r.created_at DESC";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $respondents = [];
    while ($row = $result->fetch_assoc()) {
        // Format the date nicely for the frontend
        $row['formatted_date'] = date('M d, Y h:i A', strtotime($row['created_at']));
        $respondents[] = $row;
    }
    
    echo json_encode([
        'status' => 'success',
        'total' => count($respondents),
        'data' => $respondents
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Event ID']);
}
?>