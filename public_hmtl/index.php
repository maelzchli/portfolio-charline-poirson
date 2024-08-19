<?php include("../config/bdd.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<link href="./css/main.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<title>Portfolio de Charline Poirson</title>
	<meta name="description" content="Vues aériennes, macro, contre-plongées sont les angles que j'explore dans mon travail. Je retranscris des paysages modernes, souvent colorés et abstraits. Et je questionne grâce à mes acryliques, huiles ou aquarelles sur la beauté de ce monde fragile, emplit de contradictions et de frontières.">
	<meta name="keywords" content="portfolio, artiste, peinture, peintre, acryliques, aquarelles, huiles, macro, vues aériennes, paysages">
	<link rel="icon" type="image/png" href="img/orange.webp">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Gudea:ital,wght@0,400;0,700;1,400&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">



</head>
<body class="body">

	<div id="popup-bg" class="">
		<div id="popup-content">
			<div>
				<img id="popup-img" src="">
			</div>
			<div>
				<h1 id="nom-peinture"></h1>
				<p id="technique-dimensions-peinture"></p>
				<p id="vente-peinture"></p>
			</div>			
		</div>
	</div>

	<header class="header-bottom" id="header">
		<h1 class="logo">Charline Poirson</h1>
		<?php include('nav.php')  ?>
	</header>
	<div class="main">
		<main>
			<section class="entete">
				<div class="imageentete" id="imageentete">
					<img src="./img/32.webp">
				</div>
				<div class="texteentete">
					<p>"Observer le monde et <br>
						le retranscrire. <br>
						Mettre en exergue les <br>
					contradictions."</p>
				</div>
			</section>

			<section class="section-2">
				<p>Vues aériennes, macro, contre-plongées sont les angles que j'explore dans mon travail.<br>
					Je retranscris des paysages modernes, souvent colorés et abstraits.<br>
					Et je questionne grâce à mes acryliques, huiles ou aquarelles sur la beauté de ce monde fragile, 
					emplit de contradictions et de frontières.
				</p>
				<p>Pour toute commande ou achat,merci de me contacter par mail à contact@charlinepoirson.com</p>
			</section>

			<section>
				<div class="rubriques">
					<button id="acryliques"><h2>Acryliques & Huiles</h2></button>
					<div class="boutonactif" id="boutonactif"></div>
					<button id="aquarelles"><h2>Aquarelles</h2></button>
				</div>
				<div class="filtres">
					<div class="form">			
						<div class="filtre">
							<input type="checkbox" name="vue-du-ciel" id="vue-du-ciel">
							<label for="vues-du-ciel">Vues du ciel</label>
						</div>
						<div class="filtre">
							<input type="checkbox" name="portrait" id="portrait">
							<label for="portraits">Portraits</label>
						</div>
						<div class="filtre">
							<input type="checkbox" name="paysage" id="paysage">
							<label for="paysages">Paysages</label>
						</div>
					</div>
				</div>
				<div class="peintures">

					<?php 

					$tableau = $bdd->query('SELECT * FROM peintures ORDER BY id DESC');

					foreach ($tableau as $value) { 

						?>

						<div class="peinture  <?php echo $value['theme']; ?>" id="<?php echo $value['lien'] ?>" data-nom="<?php echo $value['nom']; ?>" data-dimensions="<?php echo $value['dimensions']; ?>" data-technique="<?php echo $value['technique']; ?>" data-vente="<?php echo $value['vente']; ?>" data-theme="<?php echo $value['theme']; ?>">
							<h3><?php echo $value['nom']?></h3>
							<div>
								<img src="<?php echo $value['lien'] ?>" id="img-source">
							</div>
						</div>

					<?php } ?>

				</div>
			</section>
		</main>
		<?php include('footer.php') ?>
	</div>
	


	<script type="text/javascript" src="./lib/main.js"></script>

</body>
</html>