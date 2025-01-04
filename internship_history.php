<?php

// projecthistory.php

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'login_register');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Fetch search parameters from GET request
$search = isset($_GET['search']) ? $_GET['search'] : '';
$meetingDate = isset($_GET['meetingDate']) ? $_GET['meetingDate'] : '';

// Build the SQL query to fetch historical feedback (meetingDate < today)
$sql = "SELECT * FROM progress WHERE meetingDate < CURDATE()";

// Apply search filters if provided
if (!empty($search)) {
    $sql .= " AND fullName LIKE '%" . $conn->real_escape_string($search) . "%'";
}
if (!empty($meetingDate)) {
    $sql .= " AND meetingDate = '" . $conn->real_escape_string($meetingDate) . "'";
}

$sql .= " ORDER BY meetingDate DESC"; // Optional: Order by meetingDate descending

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Progress History</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
        /* You can reuse the styles from projectindex.php or adjust as needed */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 50px 0 20px 0;
        }
        .header h1 {
            margin: 0;
            font-size: 2em;
        }
        .search-form {
            display: inline-block;
            margin-right: 10px;
        }
        .search-form input {
            padding: 6px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 5px;
        }
        .search-form button {
            padding: 6px 12px;
            font-size: 14px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
        }
        .project-list {
            display: grid;
            gap: 20px;
            margin-top: 20px;
        }
        .project-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .actions {
            margin-top: 10px;
        }
        .actions a {
            margin-right: 10px;
            padding: 6px 12px;
            text-decoration: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #007bff;
        }
        .btn-delete {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <?php include('includes/navbar.php'); ?>
    <div class="container mt-5">
        <div class="header">
            <h1>Internship Progress History</h1>
            <form method="GET" action="" class="search-form">
                <input type="text" name="search" placeholder="Search by Full Name" value="<?php echo htmlspecialchars($search); ?>">
                <input type="date" name="meetingDate" placeholder="Search by Meeting Date" value="<?php echo htmlspecialchars($meetingDate); ?>">
                <button type="submit">Search</button>
            </form>
            <a href="projectindex.php" class="report">
                <button><i class='bx bx-arrow-back'></i><span> Back to Current Progress</span></button>
            </a>
        </div>

        <div class="project-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='project-card'>";

                    echo "<div class='project-info'>";
                    echo "<p><strong>Meeting Date:</strong> " . date('d/m/Y', strtotime($row['meetingDate'])) . "</p>";
                    echo "<p><strong>Full Name:</strong> " . htmlspecialchars($row['fullName']) . "</p>";
                    echo "</div>";

                    if (!empty($row['projectImage'])) {
                        $images = explode(',', $row['projectImage']);
                        foreach ($images as $image) {
                            $imagePath = 'uploads/' . trim($image);
                            echo "<img src='" . htmlspecialchars($imagePath) . "' alt='Uploaded Image'>";
                        }
                    }

                    echo "<div class='project-info'>";
                    echo "<p><strong>Project Name:</strong> " . htmlspecialchars($row['projectName']) . "</p>";
                    echo "<p><strong>Project Start:</strong> " . date('d/m/Y', strtotime($row['startProject'])) . "</p>";
                    echo "<p><strong>Project End:</strong> " . date('d/m/Y', strtotime($row['dueProject'])) . "</p>";

                    echo "<table>";
                    echo "<tr><th>Project Completed</th><th>Project In Progress</th></tr>";
                    echo "<tr>";

                    echo "<td>";
                    if (!empty($row['complete'])) {
                        $complete_sentences = preg_split('/(\.|\n)/', $row['complete']);
                        echo "<ul>";
                        foreach ($complete_sentences as $sentence) {
                            if (!empty(trim($sentence))) {
                                echo "<li>" . htmlspecialchars(trim($sentence)) . "</li>";
                            }
                        }
                        echo "</ul>";
                    }
                    echo "</td>";

                    echo "<td>";
                    if (!empty($row['inprogress'])) {
                        $inprogress_sentences = preg_split('/(\.|\n)/', $row['inprogress']);
                        echo "<ul>";
                        foreach ($inprogress_sentences as $sentence) {
                            if (!empty(trim($sentence))) {
                                echo "<li>" . htmlspecialchars(trim($sentence)) . "</li>";
                            }
                        }
                        echo "</ul>";
                    }
                    echo "</td>";

                    echo "</tr>";
                    echo "</table>";

                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No historical progress data available.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script src="script.js"></script>
    <?php include('includes/footer.php'); ?>
</body>
</html>
