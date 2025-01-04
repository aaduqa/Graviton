<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="shortcut2.png">
    <title>Workshop Feedback Form - GRAVITON</title>
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
                <h3 class="text-center mb-4">Workshop Feedback Form</h3>
                <p class="text-center mb-4">Leave your feedback here</p>

        <form action="connect.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate autocomplete="off">

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

          <!-- Three separate upload inputs for different images (no 'required' attribute) -->
          <div class="form-group">
            <label for="workshopImage1">Upload Image 1:</label>
            <input type="file" id="workshopImage1" name="workshopImage[]" class="form-control-file" accept="image/*">
          </div>
          <div class="form-group">
            <label for="workshopImage2">Upload Image 2:</label>
            <input type="file" id="workshopImage2" name="workshopImage[]" class="form-control-file" accept="image/*">
          </div>

          <div class="form-group">
            <label for="workshopImage3">Upload Image 3:</label>
            <input type="file" id="workshopImage3" name="workshopImage[]" class="form-control-file" accept="image/*">
          </div>

          <div class="form-group">
            <label for="workshopImage4">Upload Image 4:</label>
            <input type="file" id="workshopImage4" name="workshopImage[]" class="form-control-file" accept="image/*">
          </div>

          <div class="form-group">
            <label for="workshopImage5">Upload Image 5:</label>
            <input type="file" id="workshopImage5" name="workshopImage[]" class="form-control-file" accept="image/*">
          </div>

          <div class="form-group">
            <label for="workshopImage6">Upload Image 6:</label>
            <input type="file" id="workshopImage6" name="workshopImage[]" class="form-control-file" accept="image/*">
          </div>

          <div id="imagePreview"></div>

          <div class="form-group">
            <label for="workshopName">Workshop Name</label>
            <input type="text" class="form-control" name="workshopName" placeholder="Fluffy Slime" required>
          </div>

          <div class="form-group">
            <label for="schoolName">School Name</label>
            <input type="text" class="form-control" name="schoolName" placeholder="Sejati PreSchool" required>
          </div>

          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="workshopDate">Workshop Date</label>
              <input type="date" class="form-control" name="workshopDate" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="participants">No of Pax</label>
              <input type="number" class="form-control" name="participants" placeholder="100" required>
            </div>
          </div>

          <div class="form-group">
            <label for="pros">Pros</label>
            <textarea class="form-control" name="pros" rows="3" placeholder="The students enjoyed and had fun!" required></textarea>
          </div>

          <div class="form-group">
            <label for="cons">Cons</label>
            <textarea class="form-control" name="cons" rows="3" placeholder="The workshop is too short" required></textarea>
          </div>

          <div class="form-group">
            <label for="suggestion">Suggestion</label>
            <textarea class="form-control" name="suggestion" rows="3" placeholder="The workshop duration could be longer" required></textarea>
          </div>

          <button class="btn btn-primary btn-block" type="submit">Submit</button>
          <a href="workshopindex.php" class="btn btn-secondary btn-block mt-2">Cancel</a>
        </form>
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
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '150px'; // Adjust as needed
                    img.style.maxHeight = '150px'; // Adjust as needed
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Event listeners for each file input
        document.getElementById('workshopImage1').addEventListener('change', function() {
            previewImage('workshopImage1');
        });
        document.getElementById('workshopImage2').addEventListener('change', function() {
            previewImage('workshopImage2');
        });
        document.getElementById('workshopImage3').addEventListener('change', function() {
            previewImage('workshopImage3');
        });
        document.getElementById('workshopImage4').addEventListener('change', function() {
            previewImage('workshopImage4');
        });
        document.getElementById('workshopImage5').addEventListener('change', function() {
            previewImage('workshopImage5');
        });
        document.getElementById('workshopImage6').addEventListener('change', function() {
            previewImage('workshopImage6');
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
