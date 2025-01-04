<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "intern_attendance";

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Decode JSON input or form data from fetch()
if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
    $data = json_decode(file_get_contents('php://input'), true);
} else {
    $data = $_POST;
}

// Extract variables from input data
$id = $data['id'] ?? null;
$intern_name = $data['intern_name'] ?? null;
$intern_id = $data['intern_id'] ?? null;
$department = $data['department'] ?? null;
$location = $data['location'] ?? null;
$on_site_location = $data['on_site_location'] ?? null;

// Handle file upload for supportive document (if applicable)
$supportive_doc_path = null;
if (isset($_FILES['supportive_doc']) && $_FILES['supportive_doc']['error'] == UPLOAD_ERR_OK) {
    $target_dir = __DIR__ . "/uploads/"; // Absolute path to the uploads directory
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }
    $file_name = time() . "_" . basename($_FILES["supportive_doc"]["name"]);
    $supportive_doc_path = "uploads/" . $file_name; // Relative path for database
    move_uploaded_file($_FILES["supportive_doc"]["tmp_name"], $target_dir . $file_name);
}

if ($id === null || $intern_name === null || $intern_id === null || $department === null) {
    die("Error: Missing required fields.");
}

// Update logic
if ($location === "In Office" || $location === "Outreach") {
    // Update present_attendance
    $sql = "UPDATE present_attendance SET intern_name=?, intern_id=?, department=?, location=?, on_site_location=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssi', $intern_name, $intern_id, $department, $location, $on_site_location, $id);
} else {
    // Update absent_attendance
    $sql = "UPDATE absent_attendance SET intern_name=?, intern_id=?, department=?";

    // Add supportive_doc_path to query if a file was uploaded
    if ($supportive_doc_path) {
        $sql .= ", supportive_doc_path=?";
    }
    $sql .= " WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($supportive_doc_path) {
        $stmt->bind_param('ssssi', $intern_name, $intern_id, $department, $supportive_doc_path, $id);
    } else {
        $stmt->bind_param('sssi', $intern_name, $intern_id, $department, $id);
    }
}

// Execute and check result
if ($stmt->execute()) {
    echo "Attendance record updated successfully.";
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
