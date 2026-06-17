<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Sanitize inputs to prevent script injection
    $name    = strip_tags(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST['message']));

    // Basic Validation
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=invalid_input#contact");
        exit;
    }

    // !!! IMPORTANT: Fixed the typo in the email address !!!
    $to = "epaphrasnasasira21@gmail.com"; 
    
    $subject = "New Portfolio Message from $name";

    // Construct the email body
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // Redirect with success message
        header("Location: index.php?success=1#contact");
    } else {
        // Redirect with server error message
        header("Location: index.php?error=server_error#contact");
    }
    exit;
} else {
    // Redirect to home if accessed directly
    header("Location: index.php");
    exit;
}
?>