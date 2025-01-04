<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="shortcut2.png">
    <title>Edit Progress Form - Graviton</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
         body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
        background-image: url('page_bg.png');
        background-size: cover; /* Ensure the image covers the entire background */
        background-repeat: no-repeat; /* Avoid repeating the image */
        background-attachment: fixed; /* Keep the background fixed during scrolling */
    }
        .card {
            max-width: 800px;
            margin: 10px auto 100px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .card-body {
            padding: 30px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .logo {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <img src="tdp_logo.png" alt="Logo" class="logo">
            <h3 class="text-center mb-4">Edit Progress Form</h3>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'login_register');
            if ($conn->connect_error) {
                die('Connection Failed: ' . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM progress WHERE id = $id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $projectImages = !empty($row['projectImage']) ? explode(',', $row['projectImage']) : [];
                    $ganttImages = !empty($row['gantt']) ? explode(',', $row['gantt']) : [];
            ?>
            <form action="update_project.php" method="POST" class="needs-validation" novalidate autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="meetingDate">Meeting Date</label>
                        <input type="date" class="form-control" name="meetingDate" value="<?php echo htmlspecialchars($row['meetingDate']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fullName">Name</label>
                        <input type="text" class="form-control" name="fullName" value="<?php echo htmlspecialchars($row['fullName']); ?>" required>
                    </div>
                </div>

                <!-- Separate fields for each image -->
                <div class="form-group">
                    <label for="projectImage1">Upload Image 1:</label>
                    <input type="file" id="projectImage1" name="projectImage[]" class="form-control-file" accept="image/*">
                    <?php if (isset($projectImages[0])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($projectImages[0]); ?>" style="max-width: 150px; max-height: 150px;">
                        <input type="hidden" name="existingProjectImages[]" value="<?php echo htmlspecialchars($projectImages[0]); ?>">
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="projectImage2">Upload Image 2:</label>
                    <input type="file" id="projectImage2" name="projectImage[]" class="form-control-file" accept="image/*">
                    <?php if (isset($projectImages[1])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($projectImages[1]); ?>" style="max-width: 150px; max-height: 150px;">
                        <input type="hidden" name="existingProjectImages[]" value="<?php echo htmlspecialchars($projectImages[1]); ?>">
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="projectImage3">Upload Image 3:</label>
                    <input type="file" id="projectImage3" name="projectImage[]" class="form-control-file" accept="image/*">
                    <?php if (isset($projectImages[2])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($projectImages[2]); ?>" style="max-width: 150px; max-height: 150px;">
                        <input type="hidden" name="existingProjectImages[]" value="<?php echo htmlspecialchars($projectImages[2]); ?>">
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="projectImage4">Upload Image 4:</label>
                    <input type="file" id="projectImage4" name="projectImage[]" class="form-control-file" accept="image/*">
                    <?php if (isset($projectImages[3])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($projectImages[3]); ?>" style="max-width: 150px; max-height: 150px;">
                        <input type="hidden" name="existingProjectImages[]" value="<?php echo htmlspecialchars($projectImages[3]); ?>">
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="projectImage5">Upload Image 5:</label>
                    <input type="file" id="projectImage5" name="projectImage[]" class="form-control-file" accept="image/*">
                    <?php if (isset($projectImages[4])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($projectImages[4]); ?>" style="max-width: 150px; max-height: 150px;">
                        <input type="hidden" name="existingProjectImages[]" value="<?php echo htmlspecialchars($projectImages[4]); ?>">
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="projectImage6">Upload Image 6:</label>
                    <input type="file" id="projectImage6" name="projectImage[]" class="form-control-file" accept="image/*">
                    <?php if (isset($projectImages[5])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($projectImages[5]); ?>" style="max-width: 150px; max-height: 150px;">
                        <input type="hidden" name="existingProjectImages[]" value="<?php echo htmlspecialchars($projectImages[5]); ?>">
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="projectName">Project Name</label>
                    <input type="text" class="form-control" name="projectName" value="<?php echo htmlspecialchars($row['projectName']); ?>" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="startProject">Project Start</label>
                        <input type="date" class="form-control" name="startProject" value="<?php echo htmlspecialchars($row['startProject']); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dueProject">Project End</label>
                        <input type="date" class="form-control" name="dueProject" value="<?php echo htmlspecialchars($row['dueProject']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="complete">Project Completed Part</label>
                    <textarea class="form-control" name="complete" rows="2" required><?php echo htmlspecialchars($row['complete']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="inprogress">Project In Progress</label>
                    <textarea class="form-control" name="inprogress" rows="2" required><?php echo htmlspecialchars($row['inprogress']); ?></textarea>
                </div>

                <!-- Separate Gantt chart uploads -->
                <div class="form-group">
                    <label for="gantt1">Gantt Chart:</label>
                    <input type="file" id="gantt1" name="gantt[]" class="form-control-file" accept="image/*">
                    <?php if (isset($ganttImages[0])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($ganttImages[0]); ?>" style="max-width: 150px; max-height: 150px;">
                        <input type="hidden" name="existingGanttImages[]" value="<?php echo htmlspecialchars($ganttImages[0]); ?>">
                    <?php endif; ?>
                </div>

                <button class="btn btn-primary btn-block" type="submit">Update</button>
                <a href="projectindex.php" class="btn btn-secondary btn-block mt-2">Cancel</a>
            </form>
            <?php
                } else {
                    echo "<p>No project found.</p>";
                }
            } else {
                echo "<p>Invalid request.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>
</body>
</html>
