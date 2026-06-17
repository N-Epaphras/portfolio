<?php

if(isset($_POST['submit'])){

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$to = "epaphrasnasasira21.com"; // !!! IMPORTANT: Replace with your actual email address !!!

$subject = "Portfolio Contact";

$body = "
Name: $name

Email: $email

Message:
$message
";

mail($to,$subject,$body);

header("Location:index.php?success=1");
}
?>