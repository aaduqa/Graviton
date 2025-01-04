<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $meetingDate = $_POST['meetingDate'];
    $projectName = $_POST['projectName'];
    $startProject = $_POST['startProject'];
    $dueProject = $_POST['dueProject'];
    $complete = $_POST['complete'];
    $inprogress = $_POST['inprogress'];

    $targetDir = "uploads/";
    $uploadedFiles = [];
    $uploadOk = 1;

    // Handle project images upload
    if (isset($_FILES["projectImage"])) {
        foreach ($_FILES["projectImage"]["tmp_name"] as $key => $tmp_name) {
            if (!empty($tmp_name) && file_exists($tmp_name)) { // Check if the file exists
                $fileName = uniqid() . '-' . basename($_FILES["projectImage"]["name"][$key]); // Unique filenames
                $targetFile = $targetDir . $fileName;
                $check = getimagesize($tmp_name);

                if ($check !== false) {
                    if (move_uploaded_file($tmp_name, $targetFile)) {
                        $uploadedFiles['projectImage'][] = $fileName;
                    } else {
                        echo "Sorry, there was an error uploading your project image.";
                        $uploadOk = 0;
                    }
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
        }
    }

    // Handle Gantt chart upload
    if (isset($_FILES["gantt"])) {
        foreach ($_FILES["gantt"]["tmp_name"] as $key => $tmp_name) {
            if (!empty($tmp_name) && file_exists($tmp_name)) { // Check if the file exists
                $fileName = uniqid() . '-' . basename($_FILES["gantt"]["name"][$key]); // Unique filenames
                $targetFile = $targetDir . $fileName;
                $check = getimagesize($tmp_name);

                if ($check !== false) {
                    if (move_uploaded_file($tmp_name, $targetFile)) {
                        $uploadedFiles['gantt'][] = $fileName;
                    } else {
                        echo "Sorry, there was an error uploading your Gantt chart.";
                        $uploadOk = 0;
                    }
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
        }
    }

    if ($uploadOk == 1) {
        $conn = new mysqli('localhost', 'root', '', 'login_register');
        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        } else {
            $projectImages = isset($uploadedFiles['projectImage']) ? implode(',', $uploadedFiles['projectImage']) : '';
            $ganttCharts = isset($uploadedFiles['gantt']) ? implode(',', $uploadedFiles['gantt']) : '';

            $stmt = $conn->prepare("INSERT INTO progress (fullName, meetingDate, projectName, startProject, dueProject, complete, inprogress, projectImage, gantt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $fullName, $meetingDate, $projectName, $startProject, $dueProject, $complete, $inprogress, $projectImages, $ganttCharts);

            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
            } else {
                header("Location: projectindex.php");
                exit();
            }

            $stmt->close();
            $conn->close();
        }
    }
}

if (!isset($_SESSION["projectindex"])) {
    header("Location: projectindex.php");
    exit();
}
?>
