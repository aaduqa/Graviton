<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="shortcut2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - GRAVITON</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">

    <style>
           body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('home_wall.png') repeat;
            background-size: cover;
            color: white; /* Default text color */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            text-align: center;
            flex: 1; /* Takes up the remaining space */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box; /* Ensures padding doesn't add to width */
        }

        @keyframes glow {
            0% {
                text-shadow: 
                    0 0 5px rgba(0, 153, 255, 0.8), 
                    0 0 10px rgba(0, 153, 255, 0.8), 
                    0 0 15px rgba(0, 153, 255, 0.8), 
                    0 0 20px rgba(0, 153, 255, 0.8);
            }
            50% {
                text-shadow: 
                    0 0 10px rgba(0, 255, 255, 1), 
                    0 0 20px rgba(0, 255, 255, 1), 
                    0 0 30px rgba(0, 255, 255, 1), 
                    0 0 40px rgba(0, 255, 255, 1);
            }
            100% {
                text-shadow: 
                    0 0 5px rgba(0, 153, 255, 0.8), 
                    0 0 10px rgba(0, 153, 255, 0.8), 
                    0 0 15px rgba(0, 153, 255, 0.8), 
                    0 0 20px rgba(0, 153, 255, 0.8);
            }
        }

        h1 {
            font-size: 4.5em; /* Set the font size for "WELCOME TO" */
            font-family: 'Fredoka One', cursive; /* Cartoonish font */
            margin: 0; /* Remove margin for h1 */
            font-weight: 700;
            color: white; /* Set color to white for "WELCOME TO" */
            animation: glow 4s infinite; /* Apply glowing animation */
        }

        .graviton {
            font-size: 4.5em; /* Same font size as "WELCOME TO" */
            font-family: 'Fredoka One', cursive; /* Same font family */
            font-weight: 700; /* Same weight for consistency */
            color: white; /* Set color to white for "GRAVITON" */
            margin-top: 0; /* Optional: Adjust spacing if needed */
            animation: glow 4s infinite; /* Apply glowing animation */
        }

        p {
            font-size: 1.3em;
            margin-bottom: 40px;
            font-weight: 400;
        }

        .footer {
            text-align: center;
            color: white;
            font-size: 0.9em;
            width: 100%;
        }
    </style>

</head>
<body>

    <!-- Include the navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main Content -->
    <div class="content">
        <h1>WELCOME TO</h1>
        <div class="graviton">GRAVITON</div> <!-- Positioned below WELCOME TO -->
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Tech Dome Penang. All rights reserved.</p>
    </div>

</body>
</html>
