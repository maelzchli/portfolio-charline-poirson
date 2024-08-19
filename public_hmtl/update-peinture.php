<?php
session_start();
include("../config/bdd.php");

if (!isset($_SESSION['mdp'])) {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['peinture_id']) && isset($_POST['vente'])) {
        $peinture_id = intval($_POST['peinture_id']);
        $vente = strip_tags($_POST['vente']);

        // Préparer la requête de mise à jour
        $sql = "UPDATE peintures SET vente = :vente WHERE id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':vente', $vente);
        $stmt->bindValue(':id', $peinture_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('Location: index-admin.php'); // Rediriger après mise à jour
            exit();
        } else {
            die('Erreur lors de la mise à jour');
        }
    } else {
        die('Données manquantes');
    }
} else {
    die('Méthode non autorisée');
}
?>
