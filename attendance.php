<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="shortcut2.png">
    <title>Intern Attendance Tracking System - GRAVITON</title>
    <style>
         body {
            background-image: url('page_bg.png'); /* Set your background image */
            background-size: cover;
            background-position: center;
        }

        .form-container {
            max-width: 850px;
            margin: 90px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
            font-size: 14px;
        }

        input[type="text"], input[type="file"], select {
            width: 100%;
            max-width: 300px;
            padding: 14px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, select:focus {
            border-color: #ff7e5f;
            outline: none;
        }

        .error {
            color: #f44336;
            font-size: 12px;
        }

        button {
            width: 100%;
            padding: 16px;
            background-color: #4467C4;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #89CFF0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #4467C4;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Modal Styling */
        #editModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            border-radius: 8px;
        }

        #modalBackdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        #editModal button {
    margin: 5px; /* Adds spacing around all buttons */
}

#editModal button:first-child {
    margin-right: 10px; /* Adds extra space specifically between "Save Changes" and "Cancel" */
}

.footer {
  text-align: center;

  color: white;
  font-size: 1.1em;
  width: 100%;
}

    </style>
</head>
<body>
    <?php include('includes/navbar.php'); ?>

    <div class="form-container">
        <h2>Intern Attendance Tracking System</h2>

        <form id="attendanceForm" onsubmit="submitAttendance(event);">
            <label for="intern-name">Intern Name:</label>
            <input type="text" id="intern-name" required>
            <label for="intern-id">Intern ID:</label>
            <input type="text" id="intern-id" required>
            <label for="department">Department:</label>
            <select id="department" required>
                <option value="Science (Graviton)">Science (Graviton)</option>
                <option value="AI Education Hub">AI Education Hub</option>
                <option value="Research and Development">Research and Development</option>
            </select>
            <label for="attendance-status">Attendance Status:</label>
            <select id="attendance-status" onchange="toggleAttendanceFields()" required>
                <option value="">Select Status</option>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            </select>
            <div id="location-fields" style="display: none;">
                <label for="location">Location:</label>
                <select id="location" onchange="toggleOnSiteLocation()">
                    <option value="In Office">In Office</option>
                    <option value="Outreach">Outreach</option>
                </select>
                <div id="on-site-location-container" style="display: none;">
                    <label for="on-site-location">Outreach Location:</label>
                    <input type="text" id="on-site-location">
                </div>
            </div>
            <div id="supportive-doc-container" style="display: none;">
                <label for="supportive-doc">Supportive Document:</label>
                <input type="file" id="supportive-doc" accept=".pdf,.doc,.docx,.jpg,.png">
            </div>
            <button type="submit">Submit Attendance</button>
        </form>
        

        <table id="attendanceTable">
            <thead>
                <tr>
                    <th>Intern Name</th>
                    <th>Intern ID</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Outreach Location</th>
                    <th>Date</th>
                    <th>Supportive Document</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div id="editModal">
        <h3>Edit Attendance</h3>
        <form id="editForm">
            <label for="edit-intern-name">Intern Name:</label>
            <input type="text" id="edit-intern-name">
            <label for="edit-intern-id">Intern ID:</label>
            <input type="text" id="edit-intern-id">
            <label for="edit-department">Department:</label>
            <select id="edit-department">
                <option value="Science (Graviton)">Science (Graviton)</option>
                <option value="AI Education Hub">AI Education Hub</option>
                <option value="Research and Development">Research and Development</option>
            </select>
            <label for="edit-status">Status:</label>
<input type="text" id="edit-status" readonly>

            <label for="edit-location">Location:</label>
            <select id="edit-location" onchange="toggleEditLocationFields()">
                <option value="In Office">In Office</option>
                <option value="Outreach">Outreach</option>
            </select>
            <div id="edit-on-site-location-container" style="display: none;">
                <label for="edit-on-site-location">Outreach Location:</label>
                <input type="text" id="edit-on-site-location">
            </div>

            <div id="edit-supportive-doc-container" style="display: none;">
    <label for="edit-supportive-doc">Update Supportive Document:</label>
    <input type="file" id="edit-supportive-doc" accept=".pdf,.doc,.docx,.jpg,.png">
</div>

            <button type="button" onclick="submitEdit()">Save Changes</button>
            <button type="button" onclick="closeEditModal()">Cancel</button>
        </form>
    </div>
    <div id="modalBackdrop" onclick="closeEditModal()"></div>

    <script>
        let editData = {};

        function toggleAttendanceFields() {
            const status = document.getElementById('attendance-status').value;
            document.getElementById('location-fields').style.display = (status === 'Present') ? 'block' : 'none';
            document.getElementById('supportive-doc-container').style.display = (status === 'Absent') ? 'block' : 'none';
        }

        function toggleOnSiteLocation() {
            const location = document.getElementById('location').value;
            document.getElementById('on-site-location-container').style.display = (location === 'Outreach') ? 'block' : 'none';
        }

        function toggleEditLocationFields() {
            const location = document.getElementById('edit-location').value;
            const outreachContainer = document.getElementById('edit-on-site-location-container');
            outreachContainer.style.display = (location === 'Outreach') ? 'block' : 'none';
        }

        function submitAttendance(event) {
            event.preventDefault();
            const attendanceStatus = document.getElementById('attendance-status').value;
            const formData = new FormData();
            formData.append('intern_name', document.getElementById('intern-name').value);
            formData.append('intern_id', document.getElementById('intern-id').value);
            formData.append('department', document.getElementById('department').value);

            if (attendanceStatus === 'Present') {
                formData.append('location', document.getElementById('location').value);
                formData.append('on_site_location', document.getElementById('on-site-location').value || '');
                fetch('submit_present.php', { method: 'POST', body: formData })
                    .then(response => response.text())
                    .then(data => { alert(data); loadAttendanceData(); })
                    .catch(error => console.error('Error:', error));
            } else if (attendanceStatus === 'Absent') {
                const supportiveDoc = document.getElementById('supportive-doc').files[0];
                if (supportiveDoc) { formData.append('supportive_doc', supportiveDoc); }
                fetch('submit_absent.php', { method: 'POST', body: formData })
                    .then(response => response.text())
                    .then(data => { alert(data); loadAttendanceData(); })
                    .catch(error => console.error('Error:', error));
            } else {
                alert('Please select a valid attendance status.');
            }
        }

        function openEditModal(rowData) {
    editData = rowData;

    // Populate common fields
    document.getElementById('edit-intern-name').value = rowData.intern_name;
    document.getElementById('edit-intern-id').value = rowData.intern_id;
    document.getElementById('edit-department').value = rowData.department;
    document.getElementById('edit-status').value = rowData.status; // Read-only status field

    if (rowData.status === 'Present') {
        // Show location-related fields for Present
        document.getElementById('edit-location').value = rowData.location || 'In Office';
        document.getElementById('edit-on-site-location').value = rowData.on_site_location || '';
        document.getElementById('edit-location').style.display = 'block';
        document.getElementById('edit-on-site-location-container').style.display =
            rowData.location === 'Outreach' ? 'block' : 'none';
        document.getElementById('edit-supportive-doc-container').style.display = 'none'; // Hide supportive doc field
    } else if (rowData.status === 'Absent') {
        // Hide all location fields for Absent
        document.getElementById('edit-location').style.display = 'none';
        document.getElementById('edit-on-site-location-container').style.display = 'none';
        document.getElementById('edit-supportive-doc-container').style.display = 'block'; // Show supportive doc field
    }

    // Show the modal
    document.getElementById('editModal').style.display = 'block';
    document.getElementById('modalBackdrop').style.display = 'block';
}



        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.getElementById('modalBackdrop').style.display = 'none';
        }
        function submitEdit() {
    const formData = new FormData();
    formData.append('id', editData.id);
    formData.append('intern_name', document.getElementById('edit-intern-name').value);
    formData.append('intern_id', document.getElementById('edit-intern-id').value);
    formData.append('department', document.getElementById('edit-department').value);

    if (editData.status === 'Present') {
        formData.append('location', document.getElementById('edit-location').value);
        formData.append('on_site_location', document.getElementById('edit-on-site-location').value || '');
    } else if (editData.status === 'Absent') {
        const supportiveDoc = document.getElementById('edit-supportive-doc').files[0];
        if (supportiveDoc) {
            formData.append('supportive_doc', supportiveDoc);
        }
    }

    fetch('update_attendance.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.text())
        .then(data => {
            alert(data);
            closeEditModal();
            loadAttendanceData();
        })
        .catch(error => console.error('Error:', error));
}


        function loadAttendanceData() {
            fetch('fetch_attendance.php')
                .then(response => response.text())
                .then(data => { document.querySelector('#attendanceTable tbody').innerHTML = data; })
                .catch(error => console.error('Error fetching attendance data:', error));
        }

        window.onload = loadAttendanceData;
    </script>
     <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Tech Dome Penang. All rights reserved.</p>
    </div>
</body>
</html>
