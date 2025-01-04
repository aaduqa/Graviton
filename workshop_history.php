<?php
// workshop_history.php

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'login_register');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Fetch search parameters from GET request
$search = isset($_GET['search']) ? $_GET['search'] : '';
$meetingDate = isset($_GET['meetingDate']) ? $_GET['meetingDate'] : '';

// Build the SQL query to fetch historical feedback (meetingDate < today)
$sql = "SELECT * FROM form WHERE meetingDate < CURDATE()";

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
    <link rel="shortcut icon" type="x-icon" href="shortcut2.png">
    <title>Workshop Feedback History - GRAVITON</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
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
        .workshop-list {
            display: grid;
            gap: 20px;
            margin-top: 20px;
        }
        .workshop-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        .workshop-info {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.5); /* Slightly more opaque for visibility */
            color: black;
            
        }
        .workshop-info img {
            width: 370px;
            height: 250px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
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
            padding-left: 20px; /* Add space for bullets */
            margin: 0;
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

        .workshop-info ul {
    color: black; /* Change text color to black for all unordered lists in workshop-info */
}

.image-gallery {
    display: flex; /* Align items in a row */
    gap: 10px; /* Optional: spacing between images */
    justify-content: center; /* Optional: center the images */
    flex-wrap: wrap; /* Optional: wrap to the next line if images overflow */
}

.image-gallery img {
    width: 350px; /* Adjust the width as needed */
    height: 250px; /* Maintain aspect ratio */
    border-radius: 8px;
    margin-bottom: 10px; /* Optional: space between rows */
}
    </style>
</head>
<body>
    <?php include('includes/navbar.php'); ?>
    <div class="container mt-5">
        <div class="header">
            <h1>Workshop Feedback History</h1>
            <form method="GET" action="" class="search-form">
                <input type="text" name="search" placeholder="Search by Full Name" value="<?php echo htmlspecialchars($search); ?>">
                <input type="date" name="meetingDate" placeholder="Search by Meeting Date" value="<?php echo htmlspecialchars($meetingDate); ?>">
                <button type="submit">Search</button>
            </form>
            <a href="workshopindex.php" class="report">
                <button><i class='bx bx-arrow-back'></i><span> Back to Current Feedback</span></button>
            </a>
        </div>

        <div class="workshop-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='workshop-card'>";

                    // Meeting Date and Full Name
                    echo "<div class='workshop-info'>";
                    echo "<p><strong>Meeting Date:</strong> " . date('d/m/Y', strtotime($row['meetingDate'])) . "</p>";
                    echo "<p><strong>Full Name:</strong> " . htmlspecialchars($row['fullName']) . "</p>";
                    echo "</div>";

                     // Workshop Details
                     echo "<div class='workshop-info'>";
                     if (!empty($row['workshopImage'])) {
                         echo "<div class='image-gallery'>"; // New wrapper div
                         $images = explode(',', $row['workshopImage']);
                         foreach ($images as $image) {
                             $imagePath = 'uploads/' . trim($image);
                             $imagePath = str_replace('uploads/uploads/', 'uploads/', $imagePath);
                             echo "<img src='" . htmlspecialchars($imagePath) . "' alt='Uploaded Image'>";
                         }
                         echo "</div>";
                     }
                     
                    echo "<p><strong>Workshop Name:</strong> " . htmlspecialchars($row['workshopName']) . "</p>";
                    echo "<p><strong>Date:</strong> " . date('d/m/Y', strtotime($row['workshopDate'])) . "</p>";
                    echo "<p><strong>School Name:</strong> " . htmlspecialchars($row['schoolName']) . "</p>";
                    echo "<p><strong>No of Pax:</strong> " . htmlspecialchars($row['participants']) . "</p>";
                    echo "</div>";

                    // Pros, Cons, and Suggestions
                    echo "<div class='workshop-info'>";
                    echo "<table>";
                    echo "<tr><th>Pros</th><th>Cons</th><th>Suggestions</th></tr>";
                    echo "<tr>";
                    echo "<td>";
                    $pros_sentences = explode(',', $row['pros']);
                    echo "<ul>";
                    foreach (preg_split('/(\.|\n)/', $row['pros']) as $sentence) {
                        if (!empty(trim($sentence))) {
                            echo "<li>" . htmlspecialchars(trim($sentence)) . "</li>";
                        }
                    }
                    echo "</ul>";
                    echo "</td>";

                    echo "<td>";
                    $cons_sentences = explode(',', $row['cons']);
                    echo "<ul>";
                    foreach (preg_split('/(\.|\n)/', $row['cons']) as $sentence) {
                        if (!empty(trim($sentence))) {
                            echo "<li>" . htmlspecialchars(trim($sentence)) . "</li>";
                        }
                    }
                    echo "</ul>";
                    echo "</td>";

                    echo "<td>";
                    $suggestions_sentences = explode(',', $row['suggestion']);
                    echo "<ul>";
                    foreach (preg_split('/(\.|\n)/', $row['suggestion']) as $sentence) {
                        if (!empty(trim($sentence))) {
                            echo "<li>" . htmlspecialchars(trim($sentence)) . "</li>";
                        }
                    }
                    echo "</ul>";
                    echo "</td>";

                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";

                    // Actions for editing and deleting
                    echo "<div class='actions'>";
                    echo "<a href='javascript:void(0);' onclick='confirmDelete(" . htmlspecialchars($row['id']) . ")' class='btn-delete'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No feedback found.</p>";
            }
            ?>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = "delete_form.php?id=" + id;
            }
        }
    </script>
    
</body>
</html>
