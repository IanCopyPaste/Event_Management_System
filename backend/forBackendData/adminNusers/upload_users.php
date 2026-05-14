<?php
// api/upload_users.php
require_once "../../database/config.php";

if (isset($_FILES['user_file'])) {
    $file = $_FILES['user_file']['tmp_name'];
    $handle = fopen($file, "r");
    
    // Skip the first row (the headers like "First Name", "Email", etc.)
    fgetcsv($handle); 

    // Prepare the statement once for better performance
    $stmt = $conn->prepare("INSERT INTO users (role, first_name, last_name, email, status, program_id, year_level) VALUES (?, ?, ?, ?, 'active', ?, ?)");

    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Map CSV columns to your table fields 
        // Example CSV order: Role, First, Last, Email, Program, Year
        $stmt->bind_param("ssssss", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
        $stmt->execute();
    }
    
    fclose($handle);
    echo json_encode(["success" => true]);
}
?>