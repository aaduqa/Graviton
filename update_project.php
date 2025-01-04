<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fullName = $_POST['fullName'];
    $meetingDate = $_POST['meetingDate'];
    $projectName = $_POST['projectName'];
    $startProject = $_POST['startProject'];
    $dueProject = $_POST['dueProject'];
    $complete = $_POST['complete'];
    $inprogress = $_POST['inprogress'];

    $targetDir = "uploads/";
    $uploadOk = true;

    // Retrieve existing images
    $projectImages = isset($_POST['existingProjectImages']) ? $_POST['existingProjectImages'] : [];
    $ganttFiles = isset($_POST['existingGanttImages']) ? $_POST['existingGanttImages'] : [];

    // Handle projectImage uploads
    if (!empty($_FILES["projectImage"]["name"])) {
        foreach ($_FILES["projectImage"]["name"] as $key => $imageName) {
            if (!empty($imageName) && $_FILES["projectImage"]["error"][$key] == 0) {
                $uniqueName = uniqid() . '-' . basename($imageName);
                $targetPath = $targetDir . $uniqueName;

                $check = getimagesize($_FILES["projectImage"]["tmp_name"][$key]);
                if ($check !== false) {
                    if (move_uploaded_file($_FILES["projectImage"]["tmp_name"][$key], $targetPath)) {
                        $projectImages[$key] = $uniqueName; // Replace specific image
                    } else {
                        $uploadOk = false;
                        echo "Error uploading project image: $imageName.<br>";
                    }
                } else {
                    $uploadOk = false;
                    echo "File is not a valid image: $imageName.<br>";
                }
            }
        }
    }

    // Handle gantt uploads
    if (!empty($_FILES["gantt"]["name"])) {
        foreach ($_FILES["gantt"]["name"] as $key => $ganttName) {
            if (!empty($ganttName) && $_FILES["gantt"]["error"][$key] == 0) {
                $uniqueName = uniqid() . '-' . basename($ganttName);
                $targetPath = $targetDir . $uniqueName;

                if (move_uploaded_file($_FILES["gantt"]["tmp_name"][$key], $targetPath)) {
                    $ganttFiles[$key] = $uniqueName; // Replace specific gantt file
                } else {
                    $uploadOk = false;
                    echo "Error uploading gantt file: $ganttName.<br>";
                }
            }
        }
    }

    if ($uploadOk) {
        $conn = new mysqli('localhost', 'root', '', 'login_register');
        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        } else {
            // Convert arrays to comma-separated strings
            $projectImage = implode(',', $projectImages);
            $gantt = implode(',', $ganttFiles);

            // Update the database
            $stmt = $conn->prepare("UPDATE progress SET fullName=?, meetingDate=?, projectName=?, startProject=?, dueProject=?, complete=?, inprogress=?, projectImage=?, gantt=? WHERE id=?");
            $stmt->bind_param("sssssssssi", $fullName, $meetingDate, $projectName, $startProject, $dueProject, $complete, $inprogress, $projectImage, $gantt, $id);

            if ($stmt->execute()) {
                echo "Record updated successfully!";
                header("Location: projectindex.php");
                exit();
            } else {
                echo "Database error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    } else {
        echo "One or more files failed to upload. Please try again.";
    }
}
?>
