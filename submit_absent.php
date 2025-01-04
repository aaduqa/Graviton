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

// Handle file upload
$supportive_doc_path = null;
if (!empty($_FILES['supportive_doc']['name'])) {
    $file_name = time() . "_" . basename($_FILES["supportive_doc"]["name"]); // Make filename unique
    $supportive_doc_path = "uploads/" . $file_name; // Relative path to store in the database
    move_uploaded_file($_FILES["supportive_doc"]["tmp_name"], $target_dir . $file_name);
}

// Insert data into absent_attendance table
$stmt = $connection->prepare("INSERT INTO absent_attendance (intern_name, intern_id, department, supportive_doc_path, date) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param("ssss", $intern_name, $intern_id, $department, $supportive_doc_path);


if ($stmt->execute()) {
    echo "Absent attendance submitted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$connection->close();
?>
