
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Active l'affichage des erreurs pour débogage (à retirer en production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifie que la requête vient bien du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupère les champs du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Adresse email de réception
    $to = "vmangwandjo@gmail.com"; // 🔁 Remplace par ton adresse Gmail

    // Sujet et corps du message
    $email_subject = "Nouveau message du portfolio : $subject";
    $email_body = "Nom : $name\n";
    $email_body .= "Email : $email\n\n";
    $email_body .= "Message :\n$message";

    // --- Configuration SMTP Gmail ---
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';

    

    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vmangwandjo@gmail.com'; // 🔁 Ton adresse Gmail
        $mail->Password = 'umfnpsckhnlbhohp'; // 🔁 Ton mot de passe d’application
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Expéditeur et destinataire
        $mail->setFrom($email, $name);
        $mail->addAddress($to);

        // Contenu du mail
        $mail->isHTML(false);
        $mail->Subject = $email_subject;
        $mail->Body    = $email_body;

        // Envoi
        $mail->send();
        echo "OK";

    } catch (Exception $e) {
        echo "Erreur : le message n’a pas pu être envoyé. Détails : {$mail->ErrorInfo}";
    }

} else {
    echo "Méthode non autorisée.";
}
?>
