<?php
$mot_de_passe = 'lespeinturesdecharline@P'; // Le mot de passe en clair
$hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);
echo "Le hash du mot de passe est : " . $hash;
?>