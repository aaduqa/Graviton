<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to integer for safety

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'login_register');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM progress WHERE id = ?");
    $stmt->bind_param("i", $id); // Bind the integer ID

    if ($stmt->execute()) {
        echo "<script>alert('Progress deleted successfully');</script>";
        echo "<script>window.location.replace('projectindex.php');</script>";
    } else {
        echo "Error deleting feedback: " . $stmt->error; // Show error message
    }

    $stmt->close(); // Close the statement
    $conn->close(); // Close the connection
} else {
    echo "<p>Invalid request.</p>";
}
?>
