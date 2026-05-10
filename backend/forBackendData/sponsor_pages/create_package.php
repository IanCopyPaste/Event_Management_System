<?php
session_start();
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../vendor/autoload.php';
include("../../database/config.php");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

$sponsor_id = isset($_SESSION['sponsor_id']) ? $_SESSION['sponsor_id'] : 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $event_id = isset($_POST['event_id']) ? (int)$_POST['event_id'] : null;
    $package_name = $_POST['package_name'] ?? '';
    $description = $_POST['description'] ?? '';
    $benefits = $_POST['benefits'] ?? '[]';
    $status = $_POST['status'] ?? 'ongoing';
    $approval_status = 'pending';

    // 1. DUPLICATE CHECK
    $check = $conn->prepare("SELECT package_id FROM packages WHERE sponsor_id = ? AND event_id = ? AND approval_status <> 'rejected'");
    $check->bind_param("ii", $sponsor_id, $event_id);
    $check->execute();
    if ($check->get_result()->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Package already exists for this event.']);
        exit;
    }

    // 2. FILE UPLOAD
    $fileNameToStore = 'default_bg.jpg';
    if (isset($_FILES['package_bg']) && $_FILES['package_bg']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../../image_data/package_bg/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $ext = pathinfo($_FILES['package_bg']['name'], PATHINFO_EXTENSION);
        $fileNameToStore = uniqid('pkg_', true) . '.' . $ext;
        move_uploaded_file($_FILES['package_bg']['tmp_name'], $uploadDir . $fileNameToStore);
    }

    // 3. DATABASE INSERT
    $sql = "INSERT INTO packages (sponsor_id, event_id, package_name, description, benefits, package_bg, status, approval_status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissssss", $sponsor_id, $event_id, $package_name, $description, $benefits, $fileNameToStore, $status, $approval_status);

    if ($stmt->execute()) {
        
        // ─────────────────────────────────────────────────────────────────────────────
        // 4. FETCH ORG EMAIL & EVENT NAME VIA JOIN
        // ─────────────────────────────────────────────────────────────────────────────
        // This query connects the event to the organization to get the recipient info
        $query = "SELECT e.event_name, o.org_email, o.org_name 
                  FROM events e 
                  JOIN organizations o ON e.org_id = o.org_id 
                  WHERE e.event_id = ?";
        
        $email_stmt = $conn->prepare($query);
        $email_stmt->bind_param("i", $event_id);
        $email_stmt->execute();
        $res = $email_stmt->get_result();
        $recipient = $res->fetch_assoc();

        if ($recipient) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'bobbycuen@gmail.com';
                $mail->Password   = $app_pass; 
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('bobbycuen@gmail.com', 'UKE Student Affairs');
                
                // Target the Org's Email specifically
                $mail->addAddress($recipient['org_email'], $recipient['org_name']); 

                $mail->isHTML(true); // Using HTML for a nicer look
                $mail->Subject = 'New Sponsorship Package Submitted: ' . $recipient['event_name'];
                
                $mail->Body = "
                    <h3>Hello {$recipient['org_name']},</h3>
                    <p>A new sponsorship package has been submitted for your event: <strong>{$recipient['event_name']}</strong>.</p>
                    <p><strong>Package Name:</strong> {$package_name}<br>
                    <strong>Description:</strong> {$description}</p>
                    <p>The application is currently <strong>PENDING REVIEW</strong> by Student Affairs. You will be notified once it is approved.</p>
                    <br>
                    <p>Best Regards,<br>University of Kristian Evangelion</p>
                ";

                $mail->send();
                $emailStatus = " and notification sent to " . $recipient['org_name'];
            } catch (Exception $e) {
                $emailStatus = " but email failed.";
            }
        }

        echo json_encode([
            'success' => true, 
            'message' => 'Package created successfully' . ($emailStatus ?? "")
        ]);

    } else {
        echo json_encode(['success' => false, 'message' => 'Insert error: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>