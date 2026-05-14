<?php
// backend/forFrontendData/getUserHistory.php

session_start();

// Set header to return JSON
header('Content-Type: application/json');

// 1. Check if the user is logged in
// (Adjust 'users_id' if your session variable is named differently)
if (!isset($_SESSION['users_id'])) {
    echo json_encode([
        "status" => false,
        "message" => "User not logged in."
    ]);
    exit();
}

$user_id = $_SESSION['users_id'];

// 2. Include your database connection
// (Adjust the path to point to your actual database connection file)
require_once '../../database/config.php';

try {
    // 3. Prepare the SQL Query
    // We join the 'responses' table with the 'events' table
    // We filter for the logged-in user and events that are 'finished' or have already passed
    $query = "
        SELECT 
            e.event_id, 
            e.event_name, 
            e.location, 
            e.start_date, 
            e.end_date, 
            e.status, 
            e.event_bg_picture
        FROM events e
        JOIN responses r ON e.event_id = r.event_id
        WHERE r.users_id = ? 
          AND (e.status = 'finished' OR e.status = 'closed' OR e.end_date < CURRENT_DATE)
        ORDER BY e.start_date DESC
    ";

    // Assuming you are using PDO for your database connection. 
    // If you are using MySQLi, the syntax will be slightly different.
    // If using MySQLi instead of PDO:
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $records = $result->fetch_all(MYSQLI_ASSOC);

    // 4. Return the JSON response
    if ($records) {
        echo json_encode([
            "status" => true,
            "record" => $records
        ]);
    } else {
        echo json_encode([
            "status" => true,
            "record" => [] // Return an empty array if no history is found
        ]);
    }
} catch (ErrorException $e) {
    // Catch any database errors
    echo json_encode([
        "status" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}
