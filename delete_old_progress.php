<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'login_register');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Calculate the current date minus six months
$sixMonthsAgo = date('Y-m-d', strtotime('-6 months'));

// Prepare the SQL statement to delete records older than six months from their meetingDate
$stmt = $conn->prepare("DELETE FROM progress WHERE meetingDate < ?");
$stmt->bind_param("s", $sixMonthsAgo); // Bind the calculated date

if ($stmt->execute()) {
    echo "Progress records older than six months have been deleted successfully.";
} else {
    echo "Error deleting old progress: " . $stmt->error;
}

$stmt->close(); // Close the statement
$conn->close(); // Close the connection
?>
