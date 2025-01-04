<?php

$conn = new mysqli('localhost', 'root', '', 'login_register');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Fetch the search query from the GET request
$search = isset($_GET['search']) ? $_GET['search'] : '';
$meetingDate = isset($_GET['meetingDate']) ? $_GET['meetingDate'] : '';

// Initialize the SQL query to get current and future internship progress
$sql_progress = "SELECT * FROM progress WHERE meetingDate < CURDATE()";

if (!empty($search)) {
    $sql_progress .= " AND fullName LIKE '%" . $conn->real_escape_string($search) . "%'";
}
if (!empty($meetingDate)) {
    $sql_progress .= " AND meetingDate = '" . $conn->real_escape_string($meetingDate) . "'";
}

$sql_progress .= " ORDER BY meetingDate ASC";

$result_progress = $conn->query($sql_progress);

if ($result_progress === false) {
    die('SQL Error: ' . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="x-icon" href="shortcut2.png">
    <title>Internship Progress History - GRAVITON</title>
    <style>
        body {
            background-image: url('page_bg.png'); /* Set your background image */
            background-size: cover;
            background-position: center;
        }
        .container {
           max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.0); /* Semi-transparent background */
            border-radius: 8px; /* Optional: for rounded corners */
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 100px 0 20px 0;
        }
        .header h1 {
            margin: 0;
            font-size: 2em;
            color: white;
            text-shadow: 2px 2px #000000;
        }
        .report button {
            display: inline-block;
            padding: 6px 12px;
            font-size: 14px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: green;
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px #999;
        }
        .progress-list {
            display: grid;
            gap: 20px;
            margin-top: 20px;
        }
        .progress-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        .progress-card img {
            width: 374px;
            height: 250px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .progress-info {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.5); /* Slightly more opaque for visibility */
            color: black;
        }
        .progress-info p {
            margin: 0;
        }
        .actions {
            margin-top: 10px;
            width: 100%;
            text-align: left;
        }
        .actions a {
            display: inline-block;
            margin-right: 10px;
            padding: 6px 12px;
            font-size: 14px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 2px solid #007bff; /* Thicker border with a visible color */
        }
        th, td {
            padding: 10px;
            text-align: left;
            vertical-align: top;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly opaque for visibility */
        }
        th {
            background-color: rgba(0, 123, 255, 0.1); /* Light background color for table headers */
            color: black; /* Change header text color */
        }
        ul {
            list-style-type: disc;
            padding-left: 20px;
            margin: 0;
        }
        .search-form input, .search-form button {
            padding: 6px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        
    </style>
</head>
<body>

    <?php include('includes/navbar.php'); ?>

    <div class="container mt-5">
        <div class="header">
            <h1>Internship Progress History</h1>
            <form method="GET" action="" class="search-form">
                <input type="text" name="search" placeholder="Search by Full Name" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <input type="date" name="meetingDate" value="<?php echo isset($_GET['meetingDate']) ? htmlspecialchars($_GET['meetingDate']) : ''; ?>">
                <button type="submit">Search</button>
            </form>
            <a href="projectindex.php" class="report">
                <button><i class='bx bx-arrow-back'></i><span> Back to Current Progress</span></button>
            </a>
        </div>

        <div class="progress-list">
            <?php
            if ($result_progress->num_rows > 0) {
                while ($row = $result_progress->fetch_assoc()) {
                    echo "<div class='progress-card'>";

                    echo "<div class='progress-info'>";
                    echo "<p><strong>Meeting Date:</strong> " . date('d/m/y', strtotime($row['meetingDate'])) . "</p>";
                    echo "<p><strong>Full Name:</strong> " . htmlspecialchars($row['fullName']) . "</p>";
                    echo "</div>";

                    // Display project images
                    echo "<div class='progress-info'>";
                    if (!empty($row['projectImage'])) {
                        echo "<div class='image-gallery'>";
                        $images = explode(',', $row['projectImage']);
                        foreach ($images as $image) {
                            $imagePath = 'uploads/' . trim($image);
                            $imagePath = str_replace('uploads/uploads/', 'uploads/', $imagePath);
                            echo "<img src='" . htmlspecialchars($imagePath) . "' alt='Uploaded Image'>";
                        }
                        echo "</div>";
                    }

                    echo "<div class='progress-info'>";
                    echo "<p><strong>Project Name:</strong> " . htmlspecialchars($row['projectName']) . "</p>";
                    echo "<p><strong>Project Start:</strong> " . date('d/m/y', strtotime($row['startProject'])) . "</p>";
                    echo "<p><strong>Project End:</strong> " . date('d/m/y', strtotime($row['dueProject'])) . "</p>";

                    echo "<table>";
                    echo "<tr><th>Project Completed</th><th>Project In Progress</th></tr>";
                    echo "<tr>";

                    echo "<td>";
                    if (!empty($row['complete'])) {
                        echo "<ul>";
                        foreach (preg_split('/(\.|\n)/', $row['complete']) as $sentence) {
                            if (!empty(trim($sentence))) {
                                echo "<li>" . htmlspecialchars(trim($sentence)) . "</li>";
                            }
                        }
                        echo "</ul>";
                    }
                    echo "</td>";

                    echo "<td>";
                    if (!empty($row['inprogress'])) {
                        echo "<ul>";
                        foreach (preg_split('/(\.|\n)/', $row['inprogress']) as $sentence) {
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

                    echo "<div class='progress-info'>";
                    echo "<p><strong>Gantt Chart:</strong></p>";
                    if (!empty($row['gantt'])) {
                        $ganttImages = explode(',', $row['gantt']);
                        foreach ($ganttImages as $image) {
                            $imagePath = 'uploads/' . trim($image);
                            echo "<img src='" . htmlspecialchars($imagePath) . "' alt='Gantt Chart' style='width:100%; height:auto;'>";
                        }
                    }
                    echo "</div>";

                    echo "<div class='actions'>";
                    echo "<a href='javascript:void(0);' onclick='confirmDelete(" . htmlspecialchars($row['id']) . ")' class='btn-delete'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No internship progress records found.</p>";
            }
            ?>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = "delete_project.php?id=" + id;
            }
        }
    </script>
</body>
</html>
