<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="shortcut2.png">
    <title>Edit Workshop Feedback - GRAVITON</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

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

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <img src="tdp_logo.png" alt="Logo" class="logo">
                <h3 class="text-center mb-4">Edit Workshop Feedback</h3>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'login_register');
                if ($conn->connect_error) {
                    die('Connection Failed: ' . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM form WHERE id = $id";
                    $result = $conn->query($sql);
                
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $uploadedFiles = !empty($row['workshopImage']) ? explode(',', $row['workshopImage']) : [];
                ?>
                        <form action="update_form.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate autocomplete="off">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

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

                            <!-- Upload Image 1 -->
                            <div class="form-group">
                                <label for="workshopImage1">Upload Image 1:</label>
                                <input type="file" id="workshopImage1" name="workshopImage[]" class="form-control-file" accept="image/*">
                                <input type="hidden" name="existingImages[]" value="<?php echo htmlspecialchars($uploadedFiles[0] ?? ''); ?>">
                                <?php if (!empty($uploadedFiles[0])): ?>
                                    <img src="uploads/<?php echo htmlspecialchars($uploadedFiles[0]); ?>" style="max-width: 150px; max-height: 150px;">
                                <?php endif; ?>
                            </div>

                            <!-- Upload Image 2 -->
                            <div class="form-group">
                                <label for="workshopImage2">Upload Image 2:</label>
                                <input type="file" id="workshopImage2" name="workshopImage[]" class="form-control-file" accept="image/*">
                                <input type="hidden" name="existingImages[]" value="<?php echo htmlspecialchars($uploadedFiles[1] ?? ''); ?>">
                                <?php if (!empty($uploadedFiles[1])): ?>
                                    <img src="uploads/<?php echo htmlspecialchars($uploadedFiles[1]); ?>" style="max-width: 150px; max-height: 150px;">
                                <?php endif; ?>
                            </div>

                            <!-- Upload Image 3 -->
                            <div class="form-group">
                                <label for="workshopImage3">Upload Image 3:</label>
                                <input type="file" id="workshopImage3" name="workshopImage[]" class="form-control-file" accept="image/*">
                                <input type="hidden" name="existingImages[]" value="<?php echo htmlspecialchars($uploadedFiles[2] ?? ''); ?>">
                                <?php if (!empty($uploadedFiles[2])): ?>
                                    <img src="uploads/<?php echo htmlspecialchars($uploadedFiles[2]); ?>" style="max-width: 150px; max-height: 150px;">
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="workshopImage4">Upload Image 4:</label>
                                <input type="file" id="workshopImage4" name="workshopImage[]" class="form-control-file" accept="image/*">
                                <input type="hidden" name="existingImages[]" value="<?php echo htmlspecialchars($uploadedFiles[3] ?? ''); ?>">
                                <?php if (!empty($uploadedFiles[3])): ?>
                                    <img src="uploads/<?php echo htmlspecialchars($uploadedFiles[3]); ?>" style="max-width: 150px; max-height: 150px;">
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="workshopImage5">Upload Image 5:</label>
                                <input type="file" id="workshopImage5" name="workshopImage[]" class="form-control-file" accept="image/*">
                                <input type="hidden" name="existingImages[]" value="<?php echo htmlspecialchars($uploadedFiles[4] ?? ''); ?>">
                                <?php if (!empty($uploadedFiles[4])): ?>
                                    <img src="uploads/<?php echo htmlspecialchars($uploadedFiles[4]); ?>" style="max-width: 150px; max-height: 150px;">
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="workshopImage6">Upload Image 6:</label>
                                <input type="file" id="workshopImage6" name="workshopImage[]" class="form-control-file" accept="image/*">
                                <input type="hidden" name="existingImages[]" value="<?php echo htmlspecialchars($uploadedFiles[5] ?? ''); ?>">
                                <?php if (!empty($uploadedFiles[5])): ?>
                                    <img src="uploads/<?php echo htmlspecialchars($uploadedFiles[5]); ?>" style="max-width: 150px; max-height: 150px;">
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="workshopName">Workshop Name</label>
                                <input type="text" class="form-control" name="workshopName" value="<?php echo htmlspecialchars($row['workshopName']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="schoolName">School Name</label>
                                <input type="text" class="form-control" name="schoolName" value="<?php echo htmlspecialchars($row['schoolName']); ?>" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="workshopDate">Workshop Date</label>
                                    <input type="date" class="form-control" name="workshopDate" value="<?php echo htmlspecialchars($row['workshopDate']); ?>" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="participants">No of Pax</label>
                                    <input type="number" class="form-control" name="participants" value="<?php echo htmlspecialchars($row['participants']); ?>" required min="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pros">Pros</label>
                                <textarea class="form-control" name="pros" rows="2" required><?php echo htmlspecialchars($row['pros']); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="cons">Cons</label>
                                <textarea class="form-control" name="cons" rows="2" required><?php echo htmlspecialchars($row['cons']); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="suggestion">Suggestion</label>
                                <textarea class="form-control" name="suggestion" rows="2" required><?php echo htmlspecialchars($row['suggestion']); ?></textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Update</button>
                                <a href="workshopindex.php" class="btn btn-secondary btn-block mt-2">Cancel</a>
                            </div>
                        </form>
                <?php
                    } else {
                        echo "<p>No feedback found.</p>";
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
