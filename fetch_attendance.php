<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "intern_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$present_sql = "SELECT id, intern_name, intern_id, department, location, on_site_location, supportive_doc_path, date FROM present_attendance";
$present_result = $conn->query($present_sql);

$absent_sql = "SELECT id, intern_name, intern_id, department, supportive_doc_path, date FROM absent_attendance";
$absent_result = $conn->query($absent_sql);

$output = "";

// Present attendance
while ($row = $present_result->fetch_assoc()) {
    $supportive_doc_link = $row['supportive_doc_path'] ? "<a href='{$row['supportive_doc_path']}' target='_blank'>View</a>" : "N/A";
    $output .= "<tr>
        <td>{$row['intern_name']}</td>
        <td>{$row['intern_id']}</td>
        <td>{$row['department']}</td>
        <td>Present</td>
        <td>{$row['location']}</td>
        <td>{$row['on_site_location']}</td>
        <td>{$row['date']}</td>
        <td>{$supportive_doc_link}</td>
       <td><button onclick='openEditModal(".json_encode($row + ['status' => 'Present']).")'>Edit</button></td>
    </tr>";
}

// Absent attendance
while ($row = $absent_result->fetch_assoc()) {
    $row['status'] = 'Absent'; // Explicitly set Status for Absent
    $supportive_doc_link = $row['supportive_doc_path'] ? "<a href='{$row['supportive_doc_path']}' target='_blank'>View</a>" : "N/A";
    $output .= "<tr>
        <td>{$row['intern_name']}</td>
        <td>{$row['intern_id']}</td>
        <td>{$row['department']}</td>
        <td>{$row['status']}</td> <!-- Add Status Column -->
        <td>N/A</td>
        <td>N/A</td>
        <td>{$row['date']}</td>
        <td>{$supportive_doc_link}</td>
        <td><button onclick='openEditModal(".json_encode($row).")'>Edit</button></td>
    </tr>";
}

echo $output;

$conn->close();
?>
