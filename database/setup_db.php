<?php
require_once __DIR__ . '/../config/db.php';

$conn = get_db_connection(false);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create Database
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    die("Error creating database: " . $conn->error);
}

$conn->select_db(DB_NAME);

// Create admins table
$sql = "CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// Create contact_forms table
$sql = "CREATE TABLE IF NOT EXISTS contact_forms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    child_age VARCHAR(50),
    program VARCHAR(100),
    message TEXT,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// Create enquiry_forms table
$sql = "CREATE TABLE IF NOT EXISTS enquiry_forms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_name VARCHAR(100),
    child_name VARCHAR(100),
    child_age VARCHAR(50),
    program VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    message TEXT,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// Create newsletter_subscribers table
$sql = "CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// Create activity_logs table
$sql = "CREATE TABLE IF NOT EXISTS activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    action VARCHAR(255),
    admin_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES admins(id)
)";
$conn->query($sql);

// Insert default admin
$admin_email = 'admin@bomis-ballari.com';
$admin_pass = password_hash('Bomis@123456', PASSWORD_DEFAULT);
$admin_name = 'Admin';

$check = $conn->prepare("SELECT id FROM admins WHERE email = ?");
$check->bind_param("s", $admin_email);
$check->execute();
if ($check->get_result()->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $admin_name, $admin_email, $admin_pass);
    $stmt->execute();
    echo "Default admin created successfully<br>";
} else {
    echo "Admin already exists<br>";
}

echo "Database setup completed successfully!";
$conn->close();
?>
