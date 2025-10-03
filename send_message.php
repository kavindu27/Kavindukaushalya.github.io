<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and retrieve form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Check if inputs are valid
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    if (!$email) {
        echo "Invalid email address.";
        exit;
    }

    // Email configuration
    $to = "kavindukaushalya60@gmail.com"; // Replace with your email address
    $subject = "New Message from $name";
    $headers = "From: noreply@yourdomain.com\r\n"; // Ensure you use a valid domain email
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email content
    $emailBody = "Name: $name\n";
    $emailBody .= "Email: $email\n\n";
    $emailBody .= "Message:\n$message\n";

    // Send email
    if (mail($to, $subject, $emailBody, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send the message. Please try again later.";
    }
} else {
    http_response_code(405); // Set HTTP response to 405 for invalid method
    echo "Invalid request method. Only POST is allowed.";
}
?>
