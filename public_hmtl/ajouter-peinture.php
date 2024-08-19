
	<?php

	include("../config/bdd.php");

	if (isset($_POST['envoyer'])) { 

		if (!empty($_POST) && !empty($_FILES['image'])) {
			if (
				isset($_POST['nom'], $_POST['dimensions'])
				&& (!empty($_POST['technique']))
				&& (!empty($_POST['theme']))
				&& (!empty($_POST['vente']))
				&& (!empty($_FILES['image'])))
			{

				$nom = strip_tags($_POST['nom']);
				$dimensions = strip_tags($_POST['dimensions']);
				$technique = strip_tags($_POST['technique']);
				$theme = strip_tags($_POST['theme']);
				$vente = strip_tags($_POST['vente']);
				$img_file =  $_FILES['image']['tmp_name'];
				$lien = './img/'.$_FILES['image']['name'];

				if (move_uploaded_file($img_file, $lien)) {

					$sql = "INSERT INTO peintures (nom, dimensions, technique, lien, theme, vente) VALUES (:nom, :dimensions, :technique, :lien, :theme, :vente)";

					$query = $bdd->prepare($sql);

					$query->bindValue(":nom", $nom);
					$query->bindValue(":dimensions", $dimensions);
					$query->bindValue(":technique", $technique);
					$query->bindValue(":lien", $lien);
					$query->bindValue(":theme", $theme);
					$query->bindValue(":vente", $vente);

					if(!$query->execute()){
						die('Les données n\'ont pas été envoyées');
					}
				} else {
					if ($_FILES['image']['error'] == 1) {
						echo 'L\'image est trop volumineuse';
					}
				}	
			}else{
				die('Le formulaire n\'est pas complet');
			}
		}else{
			die('Le formulaire n\'est pas complet');
		}
	}

	?>

	<form method="post" class="ajouter-peinture" enctype="multipart/form-data">
		<div>
			<h3>Ajouter une peinture</h3>
		</div>
		<div>
			<input type="text" name="nom" required>
			<label for="nom">Nom</label>	
		</div>
		<div>
			<input type="text" id="dimensions" name="dimensions" required>
			<label for="dimensions">Dimensions</label>
		</div>
		<div>
			<input type="radio" id="acrylique" name="technique" value="Acrylique">
			<label for="acrylique">Acrylique</label>
			<input type="radio" id="huile" name="technique" value="Huile">
			<label for="huile">Huile</label>
			<input type="radio" id="aquarelle" name="technique" value="Aquarelle">
			<label for="aquarelle">Aquarelle</label>
		</div>
		<div>
			<input type="radio" id="vue-du-ciel" name="theme" value="vue-du-ciel">
			<label for="vue-du-ciel">Vue du ciel</label>
			<input type="radio" id="portrait" name="theme" value="portrait">
			<label for="portrait">Portrait</label>
			<input type="radio" id="paysage" name="theme" value="paysage">
			<label for="paysage">Paysage</label>
		</div>
		<div>
			<input type="radio" id="avendre" name="vente" value="A vendre">
			<label for="avendre">A vendre</label>
			<input type="radio" id="vendu" name="vente" value="Vendu">
			<label for="vendu">Vendu</label>
		</div>
		<div>
			<input type="file" name="image" accept="image/png, image/jpeg, image/webp" required>
			<label for="image">Image</label>
		</div>
		<div>
			<button class="button" type="submit" name="envoyer">Envoyer</button>
		</div>
	</form>