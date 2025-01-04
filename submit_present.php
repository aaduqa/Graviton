<?php
// Database connection
$connection = new mysqli("localhost", "root", "", "intern_attendance");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Ensure the uploads directory exists
$target_dir = __DIR__ . "/uploads/"; // Absolute path to the uploads directory
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true); // Create directory with read/write permissions
}

// Get data from form
$intern_name = $_POST['intern_name'];
$intern_id = $_POST['intern_id'];
$department = $_POST['department'];
$location = $_POST['location'];
$on_site_location = isset($_POST['on_site_location']) ? $_POST['on_site_location'] : null;

// Insert data into present_attendance table
$stmt = $connection->prepare("INSERT INTO present_attendance (intern_name, intern_id, department, location, on_site_location, date) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("sssss", $intern_name, $intern_id, $department, $location, $on_site_location);


if ($stmt->execute()) {
    echo "Present attendance submitted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$connection->close();
?>
