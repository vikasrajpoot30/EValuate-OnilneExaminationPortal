<?php
// index.php
// Set the timezone to Indian Standard Time
date_default_timezone_set('Asia/Kolkata');
// Check if a background image is set
$backgroundImage = 'iitg3.jpg'; // Replace with your image file

// Get the current date and time
$currentDateTime = date('l, F j, Y g:i A');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Login Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:400,700&display=swap">
    <style>
        body {
            <?php echo isset($backgroundImage) ? "background-image: url('$backgroundImage');" : ''; ?>
            background-size: cover;
            background-position: center;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column; /* Change to column layout */
            align-items: center;
            justify-content: center;
            height: 100vh;
            animation: floatBackground 20s infinite alternate; /* Floating animation for the background */
        }
        header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 20px;
            width: 100%;
        }
        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            font-size: 20px;
            max-width: 400px; /* Set maximum width for the logo */
            margin-right: 400px;
        }
        .options {
            text-align: center;
            background: rgba(255, 255, 255, 0.8); /* Adjust the background color and transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
            animation: fadeIn 1s ease-in; /* Fade-in animation */
        }
        .button {
            padding: 15px 30px;
            font-size: 18px;
            margin: 10px;
            cursor: pointer;
            background-color: blue; /* Green color */
            color: white; /* Text color */
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .button:hover {
            background-color: #c0392b; /* Darker red on hover */
            animation: pulse 1s infinite; /* Pulse animation on hover */
        }
        h2 {
            color: #333; /* Heading color */
        }
        h3 {
            color: #555; /* Subheading color */
        }
        .datetime {
            position: absolute;
            top: 30px;
            right: 30px;
            font-size: 20px;
            color: #fff; /* Text color */
            opacity: 0.8; /* Adjust opacity for a subtle look */
            animation: fadeInDate 2s ease-in; /* Fade-in animation for the date */
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes floatBackground {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }
        @keyframes fadeInDate {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 0.8; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <header>
        <img src="iitglogo.jpg" alt="College Logo" class="logo"> <!-- Replace with your college logo -->
       
    </header>
    <div class="options">
        <h2>Welcome to E-Valuate  Examination Portal</h2>
        <h3>Login Dashboard</h3>
        <a href="home.php" class="button">Student Login</a>
        <a href="adminpanel/admin/home.php" class="button">Examiner Login</a>
        <a href="adminSUPpanel/admin/home.php" class="button">Admin Login</a>
    </div>
    <div class="datetime"><?php echo $currentDateTime; ?></div>
</body>
</html>
