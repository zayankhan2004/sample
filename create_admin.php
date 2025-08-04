<?php
include './config.php'; // Adjust path if needed

 header("HTTP/1.0 404 Not Found");
    // Optionally, include a custom 404 error page content here
    exit();
$username = 'admin';
$password = password_hash('your_secure_password', PASSWORD_DEFAULT); // Change this password
$role = 'admin';

$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $role);
$stmt->execute();

echo "Admin user created.";
