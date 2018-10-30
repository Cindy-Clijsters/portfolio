<?php
$errors = [];

// Check if name has been entered
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
if ($name === null || $name === "") {
    $errors['name'] = 'Gelieve je naam in te geven';
}

// Check if email has been entered and is valid
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
if ($email === null || $email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Gelieve een geldig e-mailadres in te geven';
}

//Check if message has been entered
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
if ($email === null || $email === "") {
    $errors['message'] = 'Gelieve een bericht in te geven';
}

$errorOutput = '';

if(!empty($errors)){

    $errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
    $errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

    $errorOutput  .= '<ul>';

    foreach ($errors as $key => $value) {
        $errorOutput .= '<li>'.$value.'</li>';
    }

    $errorOutput .= '</ul>';
    $errorOutput .= '</div>';

    echo $errorOutput;
    die();
}

$from    = $email;
$to      = 'cindy.clijsters@gmail.com';  // please change this email id
$subject = 'Contactformulier : Cindy Clijsters';

$body = "Van: $name\n E-mail: $email\n Bericht:\n $message";

$headers = "From: ".$from;

//send the email
$result = '';
if (mail ($to, $subject, $body, $headers)) {
    $result .= '<div class="alert alert-success alert-dismissible" role="alert">';
    $result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    $result .= 'Dank je! Ik zal zo snel mogelijk contact met je opnemen.';
    $result .= '</div>';

    echo $result;
    die();
}

$result = '';
$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
$result .= 'Er is een fout opgetreden bij het verzenden van het bericht. Probeer later opnieuw';
$result .= '</div>';

echo $result;
