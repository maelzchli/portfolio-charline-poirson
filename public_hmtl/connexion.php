<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

session_start();

// Charger les variables d'environnement depuis le fichier .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();


if (isset($_POST['valider'])) {
    if (!empty($_POST['identifiant']) && !empty($_POST['mdp'])){
        $identifiant_par_defaut = $_ENV['USER_ADMIN'];
        $mdp_hash = $_ENV['MDP_ADMIN'];

        $identifiant_saisi = htmlspecialchars($_POST['identifiant']);
        $mdp_saisi = htmlspecialchars($_POST['mdp']);

        if ($identifiant_saisi == $identifiant_par_defaut && password_verify($mdp_saisi, $mdp_hash)) {
            $_SESSION['mdp'] = $mdp_saisi;
            session_regenerate_id(true); 
            header('Location: index-admin.php');
            exit();
        } else {
            die('L\'identifiant ou le mot de passe est incorrect');
        }
    } else {
        die('Veuillez compléter tous les champs');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="./css/main.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Portfolio de Charline Poirson - Espace de connexion administrateur</title>
    <meta name="robots" content="noindex">
    <link rel="icon" type="image/png" href="./img/orange.webp">
</head>
<body>
    <div class="espace-connexion">
        <form method="POST" action="" align="center" class="connexion-form">
            <div>
                <div class="place-label">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" name="identifiant" id="identifiant" placeholder=" " autocomplete="off" required>
                </div>
                <div class="place-label">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" name="mdp" id="mdp" placeholder=" " required>
                </div>
            </div>
            <div class="envoyer">
                <button id="button" class="button" type="submit" name="valider">Se connecter</button>
            </div>
        </form>
    </div>
</body>
</html>
