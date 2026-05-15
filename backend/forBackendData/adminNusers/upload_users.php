<?php
// api/upload_users.php
require_once "../../database/config.php";

if (isset($_FILES['user_file'])) {
    $file = $_FILES['user_file']['tmp_name'];
    $handle = fopen($file, "r");
    
    // Skip the header row
    fgetcsv($handle); 

    // We use ? for program_id to look it up by its abbreviation from the Excel (BSEntrep, etc.)
    $sql = "INSERT INTO users 
            (users_id, first_name, last_name, middle_name, email, status, year_level, contact_no, password_hashed, role, program_id) 
            VALUES (?, ?, ?, ?, ?, 'active', ?, ?, ?, 'client', 
            (SELECT program_id FROM programs WHERE prog_abv = ? LIMIT 1))";

    $stmt = $conn->prepare($sql);

    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Securely hash the password from Col I ($row[8])
        //$hashed_pw = password_hash($row[8], PASSWORD_DEFAULT);

        // bind_param: 
        // s = string, i = integer. Check your DB types!
        // We match the order of the ? in our SQL above
        $stmt->bind_param(
            "issssssss", 
            $row[0], // users_id
            $row[1], // first_name
            $row[2], // last_name
            $row[3], // middle_name
            $row[4], // email
            $row[5], // year_level
            $row[7], // contact_no
            $row[8], // password_hashed
            $row[6]  // program_abv (sent to the subquery)
        );
        
        $stmt->execute();
    }
    
    fclose($handle);
    echo json_encode(["success" => true]);
}
?>