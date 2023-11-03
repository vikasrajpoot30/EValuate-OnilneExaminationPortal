<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer Autoload
require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

include("./conn.php");

function generateToken()
{
    return bin2hex(random_bytes(32)); // Generate a random 32-character token
}

function sendEmail($to, $subject, $message)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0; // Enable verbose debug output (set to 2 for more detailed logs)
        $mail->isSMTP(); // Send using SMTP
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'rajpootvikas683@gmail.com'; // SMTP username (your Gmail address)
        $mail->Password   = 'lajpkyfkptycyzll'; // SMTP password (your Gmail password)
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('rajpootvikas683@gmail.com', 'Your Name'); // Set your Gmail address and name
        $mail->addAddress($to); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    if (empty($email)) {
        echo 'Please provide your email.';
        exit;
    }

    $query = "SELECT * FROM examinee_tbl WHERE exmne_email = :exmne_email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':exmne_email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate a unique token
        $token = generateToken();

        // Store the token in the database along with user information and expiration timestamp
        $tokenQuery = "INSERT INTO password_reset_tokens (user_id, token, expiration_time) VALUES (:user_id, :token, :expiration_time)";
        $tokenStmt = $conn->prepare($tokenQuery);
        $tokenStmt->bindParam(':user_id', $user['exmne_id']);
        $tokenStmt->bindParam(':token', $token);
        $expirationTime = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valid for 1 hour
        $tokenStmt->bindParam(':expiration_time', $expirationTime);
        $tokenStmt->execute();

        // Compose the reset link with the generated token
        $resetLink = 'http://localhost/CEE/resetpass.php?token=' . $token;

        $subject = 'Password Reset';
        $message = "Hello {$user['exmne_fullname']},
        this is Evaluate Team \n\n
        To reset your password, click on the following link: $resetLink 
         \r\n 
         regards- team evaluate (Sunny Kumar ) ";

        sendEmail($email, $subject, $message);

        echo 'Password reset instructions have been sent to your email.';
    } else {
        echo 'Email not registered.';
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <style>
        body {
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
            padding: 10px;
            margin: 5px 0;
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
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <button type="submit">Recover Password</button>
    </form>
</body>

</html>