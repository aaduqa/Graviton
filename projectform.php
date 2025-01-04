<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="shortcut2.png">
    <title>Internship Progress Form - GRAVITON</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                <h3 class="text-center mb-4">Internship Progress Form</h3>
                <form action="db.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate autocomplete="off">
                    
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="meetingDate">Meeting Date</label>
                            <input type="date" class="form-control" name="meetingDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fullName">Name</label>
                            <input type="text" class="form-control" name="fullName" placeholder="Abu Bin Bakar" required>
                        </div>
                    </div>
                    
                    <!-- Separate upload inputs for different images -->
                    <div class="form-group">
                        <label for="projectImage1">Upload Image 1:</label>
                        <input type="file" id="projectImage1" name="projectImage[]" class="form-control-file" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="projectImage2">Upload Image 2:</label>
                        <input type="file" id="projectImage2" name="projectImage[]" class="form-control-file" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="projectImage3">Upload Image 3:</label>
                        <input type="file" id="projectImage3" name="projectImage[]" class="form-control-file" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="projectImage4">Upload Image 4:</label>
                        <input type="file" id="projectImage4" name="projectImage[]" class="form-control-file" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="projectImage5">Upload Image 5:</label>
                        <input type="file" id="projectImage5" name="projectImage[]" class="form-control-file" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="projectImage6">Upload Image 6:</label>
                        <input type="file" id="projectImage6" name="projectImage[]" class="form-control-file" accept="image/*">
                    </div>

                    <div id="imagePreview"></div>

                    <div class="form-group">
                        <label for="projectName">Project Name</label>
                        <input type="text" class="form-control" name="projectName" placeholder="AquaAlert MY" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="startProject">Project Start</label>
                            <input type="date" class="form-control" name="startProject" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dueProject">Project End</label>
                            <input type="date" class="form-control" name="dueProject" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="complete">Project Completed Part</label>
                        <textarea class="form-control" name="complete" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inprogress">Project In Progress</label>
                        <textarea class="form-control" name="inprogress" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gantt">Gantt Chart</label>
                        <input type="file" id="gantt" name="gantt[]" class="form-control-file" accept="image/*" multiple required>
                    </div>
                    <div id="ganttPreview"></div>
                    
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                    <a href="projectindex.php" class="btn btn-secondary btn-block mt-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <script>
        // JavaScript to preview each image upload
        function previewImage(inputId) {
            const input = document.getElementById(inputId);
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ''; // Clear previous previews

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');;
                    img.src = e.target.result;
                    img.style.maxWidth = '150px'; // Adjust as needed
                    img.style.maxHeight = '150px'; // Adjust as needed
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Event listeners for each file input
        document.getElementById('projectImage1').addEventListener('change', function() {
            previewImage('projectImage1');
        });
        document.getElementById('projectImage2').addEventListener('change', function() {
            previewImage('projectImage2');
        });
        document.getElementById('projectImage3').addEventListener('change', function() {
            previewImage('projectImage3');
        });
        document.getElementById('projectImage4').addEventListener('change', function() {
            previewImage('projectImage4');
        });
        document.getElementById('projectImage5').addEventListener('change', function() {
            previewImage('projectImage5');
        });
        document.getElementById('projectImage6').addEventListener('change', function() {
            previewImage('projectImage6');
        });

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form.needs-validation');
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    alert('Please fill in all required fields.');
                }
                form.classList.add('was-validated');
            });
        });
    </script>
    <?php include('includes/footer.php'); ?>
</body>
</html>
