<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $meetingDate = $_POST['meetingDate'];
    $fullName = $_POST['fullName'];
    $workshopName = $_POST['workshopName'];
    $workshopDate = $_POST['workshopDate'];
    $schoolName = $_POST['schoolName'];
    $participants = $_POST['participants'];
    $pros = $_POST['pros'];
    $cons = $_POST['cons'];
    $suggestion = $_POST['suggestion'];

    $targetDir = "uploads/";
    $uploadedFiles = isset($_POST['existingImages']) ? $_POST['existingImages'] : []; // Existing images from form

    // Process newly uploaded files
    if (isset($_FILES["workshopImage"])) {
        foreach ($_FILES["workshopImage"]["tmp_name"] as $key => $tmp_name) {
            if (!empty($tmp_name)) { // Only process new files
                $fileName = basename($_FILES["workshopImage"]["name"][$key]);
                $targetFile = $targetDir . $fileName;
                $check = getimagesize($tmp_name);
                if ($check !== false) {
                    if (move_uploaded_file($tmp_name, $targetFile)) {
                        $uploadedFiles[$key] = $fileName; // Add or replace image in the array
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo "File is not an image.";
                }
            }
        }
    }

    $workshopImages = implode(',', array_filter($uploadedFiles)); // Filter out empty slots

    // Update the database
    $conn = new mysqli('localhost', 'root', '', 'login_register');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("UPDATE form SET fullName=?, meetingDate=?, workshopName=?, workshopImage=?, workshopDate=?, schoolName=?, participants=?, pros=?, cons=?, suggestion=? WHERE id=?");
        $stmt->bind_param("ssssssisssi", $fullName, $meetingDate, $workshopName, $workshopImages, $workshopDate, $schoolName, $participants, $pros, $cons, $suggestion, $id);

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        } else {
            header("Location: workshopindex.php");
            exit();
        }
        $stmt->close();
        $conn->close();
    }
}
?>
