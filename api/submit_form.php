<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}

$conn = get_db_connection();
if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed. Admin must run setup_db.php']);
    exit();
}

$type = $_POST['form_type'] ?? '';

try {
    if ($type === 'contact') {
        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $child_age = $_POST['child_age'] ?? '';
        $program = $_POST['program'] ?? '';
        $message = $_POST['message'] ?? '';

        $stmt = $conn->prepare("INSERT INTO contact_forms (first_name, last_name, email, phone, child_age, program, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone, $child_age, $program, $message);
        $stmt->execute();
    } elseif ($type === 'enquiry') {
        $parent_name = $_POST['parent_name'] ?? '';
        $child_name = $_POST['child_name'] ?? '';
        $child_age = $_POST['child_age'] ?? '';
        $program = $_POST['program'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';

        $stmt = $conn->prepare("INSERT INTO enquiry_forms (parent_name, child_name, child_age, program, phone, email, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $parent_name, $child_name, $child_age, $program, $phone, $email, $message);
        $stmt->execute();
    } elseif ($type === 'newsletter') {
        $email = $_POST['email'] ?? '';
        if (empty($email)) throw new Exception("Email is required");

        $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
    } else {
        throw new Exception("Invalid form type: " . $type);
    }

    echo json_encode(['status' => 'success', 'message' => 'Thank you! Your submission has been received.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Submission failed: ' . $e->getMessage()]);
}

$conn->close();
?>
