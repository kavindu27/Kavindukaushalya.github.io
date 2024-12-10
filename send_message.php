<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and retrieve form inputs
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    if ($email) {
        // Email configuration
        $to = "kavindukaushalya60@gmail.com"; // Replace with your email address
        $subject = "New Message from $name";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Email content
        $emailBody = "Name: $name\n";
        $emailBody .= "Email: $email\n\n";
        $emailBody .= "Message:\n$message\n";

        // Send email
        if (mail($to, $subject, $emailBody, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send the message. Please try again.";
        }
    } else {
        echo "Invalid email address.";
    }
} else {
    echo "Invalid request method.";
}
?>
