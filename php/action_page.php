<?php
// Improved form handling and email sending script

// Initialize variables
$nom = $prenom = $email = $message = "";
$errors = [];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = test_input($_POST["nom"]);
    $prenom = test_input($_POST["prenom"]);
    $email = test_input($_POST["email"]);
    $message = test_input($_POST["message"]);

    // Validate inputs
    validateName($nom, $errors);
    validateName($prenom, $errors, "Prénom");
    validateEmail($email, $errors);
    validateMessage($message, $errors);

    // Send email if no errors
    if (empty($errors)) {
        sendEmail($nom, $prenom, $email, $message);
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

// Functions for validation and sanitization
function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function validateName(&$name, &$errors, $fieldName = "Nom")
{
    if (empty($name)) {
        $errors[] = "$fieldName requis";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $errors[] = "Seules les lettres et les espaces sont autorisés pour le $fieldName";
    }
}

function validateEmail(&$email, &$errors)
{
    if (empty($email)) {
        $errors[] = "Email requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format d'email invalide";
    }
}

function validateMessage(&$message, &$errors)
{
    if (empty($message)) {
        $errors[] = "Message requis";
    }
}

function sendEmail($nom, $prenom, $email, $message)
{
    $to = $email;
    $subject = "Confirmation de votre message";
    $txt = "Bonjour $prenom $nom,\n\nJ'ai bien reçu votre message :\n$message\n\nJe vous recontacterai dès que possible.\n\nCordialement,\nMathis Lécuyer";
    $headers = "From: mathis.lecuyer.pro@gmail.com" . "\r\n";

    if (mail($to, $subject, $txt, $headers)) {
        echo "Email envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi de l'email.";
    }
}