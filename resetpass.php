<?php
// Include necessary PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

// Include your database connection
include("./conn.php");

// Function to send email
function sendEmail($to, $subject, $message)
{
    // ... Your existing email sending logic using PHPMailer
}

// Check if the form is submitted using POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from the form
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];

    // Check if both email and new password are provided
    if (empty($email) || empty($newPassword)) {
        echo 'Please provide both email and new password.';
        exit;
    }

    // ... (your existing code)

// Assuming your table structure has columns 'exmne_email', 'exmne_password', and 'reset_token'
$updateQuery = "UPDATE examinee_tbl SET exmne_password = :exmne_password, reset_token = NULL WHERE exmne_email = :exmne_email AND reset_token IS NOT NULL";
$updateStmt = $conn->prepare($updateQuery);
$updateStmt->bindParam(':exmne_password', $newPassword);
$updateStmt->bindParam(':exmne_email', $email, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT);

try {
    $updateStmt->execute();
    
    // Clear the reset_token after successful password update
    $clearTokenQuery = "UPDATE examinee_tbl SET reset_token = NULL WHERE exmne_email = :exmne_email";
    $clearTokenStmt = $conn->prepare($clearTokenQuery);
    $clearTokenStmt->bindParam(':exmne_email', $email);
    $clearTokenStmt->execute();

    echo 'Password updated successfully.';
} catch (PDOException $e) {
    echo 'Error updating password: ' . $e->getMessage();
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
    <style>
        /* Styling for the form and background */
        body {
            background-image: url('iitg3.jpg'); /* Replace with your background image URL */
            background-size: cover;
            background-position: center;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in;
        }

        label,
        input {
            display: block;
            margin: 10px 0;
        }

        input {
            padding: 15px;
            margin: 10px 0;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 20px 25px;
            font-size: 18px;
            margin: 10px;
            cursor: pointer;
            background-color: lightseagreen;
            color: white;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <form method="post">
        <!-- Input fields for email and new password -->
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>

        <!-- Button to submit the form -->
        <button type="submit">Update Password</button>
    </form>
</body>

</html>
