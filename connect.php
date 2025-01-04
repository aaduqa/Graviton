<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture POST data
    $fullName = $_POST['fullName'];
    $meetingDate = $_POST['meetingDate'];
    $workshopName = $_POST['workshopName'];
    $workshopDate = $_POST['workshopDate'];
    $schoolName = $_POST['schoolName'];
    $participants = $_POST['participants'];
    $pros = $_POST['pros'];
    $cons = $_POST['cons'];
    $suggestion = $_POST['suggestion'];

    // Directory for uploads
    $targetDir = "uploads/";
    $uploadedFiles = [];
    $uploadOk = 1;

    // Ensure target directory exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Process each uploaded image
    foreach ($_FILES["workshopImage"]["tmp_name"] as $key => $tmp_name) {
        if (!empty($tmp_name)) { // Check if a file was uploaded in this field
            $fileName = basename($_FILES["workshopImage"]["name"][$key]);
            $targetFile = $targetDir . $fileName;
            $check = getimagesize($tmp_name);
            
            if ($check !== false) { // Check if file is an image
                if (move_uploaded_file($tmp_name, $targetFile)) {
                    $uploadedFiles[] = $targetFile; // Store the file path
                } else {
                    $_SESSION['error'] = "Sorry, there was an error uploading $fileName.";
                    $uploadOk = 0;
                    break;
                }
            } else {
                $_SESSION['error'] = "$fileName is not a valid image.";
                $uploadOk = 0;
                break;
            }
        }
    }

    if ($uploadOk == 1) {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'login_register');
        
        // Check connection
        if ($conn->connect_error) {
            $_SESSION['error'] = 'Connection Failed: ' . $conn->connect_error;
        } else {
            // Prepare and bind statement
            $workshopImages = implode(',', $uploadedFiles);
            $stmt = $conn->prepare("INSERT INTO form (fullName, meetingDate, workshopName, workshopImage, workshopDate, schoolName, participants, pros, cons, suggestion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssisss", $fullName, $meetingDate, $workshopName, $workshopImages, $workshopDate, $schoolName, $participants, $pros, $cons, $suggestion);

            if ($stmt->execute()) {
                $_SESSION['success'] = "New record inserted successfully!";
                header("Location: workshopindex.php");
                exit();
            } else {
                $_SESSION['error'] = "Error: " . $stmt->error;
            }

            // Clean up
            $stmt->close();
            $conn->close();
        }
    } else {
        // Handle file upload error
        $_SESSION['error'] = $_SESSION['error'] ?? 'File upload failed. Please try again.';
    }

    // Redirect back with errors or success messages
    header("Location: feedbackform.php");
    exit();
}
?>
