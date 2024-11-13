<?php
require_once("../modele/mdpModele.php");
require_once("../sql/bdd.php");

// Instancier le modèle
$mdpModele = new mdpModele();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Vérifier si l'utilisateur existe dans la base de données
    $user = $mdpModele->verifyUser($email);

    if ($user) {
        echo "Un email de récupération de mot de passe vous a été envoyé.";
        // Code pour envoyer un email ici (à implémenter)
    } else {
        echo "Aucun utilisateur avec cette adresse email.";
    }
}
?>
