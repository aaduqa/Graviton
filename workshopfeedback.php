<?php

$conn = new mysqli('localhost', 'root', '', 'login_register');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Fetch the search query from the GET request
$search = isset($_GET['search']) ? $_GET['search'] : '';
$meetingDate = isset($_GET['meetingDate']) ? $_GET['meetingDate'] : '';
$currentDate = date('Y-m-d'); // Get current date for comparison

// SQL query to get past feedbacks (meetingDate < today)
$sql_past = "SELECT * FROM form WHERE meetingDate < '$currentDate'";
if (!empty($search)) {
    $sql_past .= " AND fullName LIKE '%" . $conn->real_escape_string($search) . "%'";
}
if (!empty($meetingDate)) {
    $sql_past .= " AND meetingDate = '" . $conn->real_escape_string($meetingDate) . "'";
}

$result_past = $conn->query($sql_past);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css" href>
    <title>Workshop Feedback History</title>
</head>
<body>

    <!-- Include the navbar -->
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <div class="header">
            <h1>Past Workshops</h1>
            <form method="GET" action="" class="search-form">
                <input type="text" name="search" placeholder="Search by Full Name" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <input type="date" name="meetingDate" placeholder="Search by Meeting Date" value="<?php echo isset($_GET['meetingDate']) ? htmlspecialchars($_GET['meetingDate']) : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="workshop-list">
            <?php
            if ($result_past->num_rows > 0) {
                while ($row = $result_past->fetch_assoc()) {
                    echo "<div class='workshop-card'>";
                    echo "<div class='workshop-info'>";
                    echo "<p><strong>Meeting Date:</strong> " . date('d/m/y', strtotime($row['meetingDate'])) . "</p>";
                    echo "<p><strong>Full Name:</strong> " . htmlspecialchars($row['fullName']) . "</p>";
                    echo "</div>";

                    if (!empty($row['workshopImage'])) {
                        $images = explode(',', $row['workshopImage']);
                        foreach ($images as $image) {
                            $imagePath = 'uploads/' . trim($image);
                            $imagePath = str_replace('uploads/uploads/', 'uploads/', $imagePath);
                            echo "<img src='" . htmlspecialchars($imagePath) . "' alt='Uploaded Image'>";
                        }
                    }

                    echo "<div class='workshop-info'>";
                    echo "<p><strong>Workshop Name:</strong> " . htmlspecialchars($row['workshopName']) . "</p>";
                    echo "<p><strong>Date:</strong> " . date('d/m/y', strtotime($row['workshopDate'])) . "</p>";
                    echo "<p><strong>School Name:</strong> " . htmlspecialchars($row['schoolName']) . "</p>";
                    echo "<p><strong>No of Pax:</strong> " . htmlspecialchars($row['participants']) . "</p>";
                    echo "</div>";

                    echo "<div class='actions'>";
                    echo "<a href='edit_form.php?id=" . htmlspecialchars($row['id']) . "' class='btn-edit'>Edit</a>";
                    echo "<a href='javascript:void(0);' onclick='confirmDelete(" . htmlspecialchars($row['id']) . ")' class='btn-delete'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No past feedback data available</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this progress entry?")) {
                window.location.href = 'delete_form.php?id=' + id;
            }
        }
    </script>
    <?php include('includes/footer.php'); ?>
</body>
</html>
