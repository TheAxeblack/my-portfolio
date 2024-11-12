<?php
// Vérifie si le formulaire a été correctement soumis
if (!isset($_POST['submit'])) {
    echo 'Erreur lors de l\'envoi du mail';
    return;
}

// Vérifie que les champs email et message ne sont pas vides
if (empty($_POST['email']) || empty($_POST['message'])) {
    echo 'Erreur lors de l\'envoi du mail';
    return;
}

// Préparation des données du mail
$to = '[email protected]'; // Adresse mail de réception
$subject = 'Nouveau message'; // Sujet du mail
$message = $_POST['message']; // Message du mail
$headers = 'From: ' . $_POST['email']; // Adresse mail de l'expéditeur

// Envoi du mail
if (!mail($to, $subject, $message, $headers)) {
    echo 'Erreur lors de l\'envoi du mail';
}