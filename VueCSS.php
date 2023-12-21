<html>

	<head>
		<title>Liste cadeau de noël</title>

		<style>
			 body {
					 margin: 0;
					 font-family: Arial, sans-serif;
					 background-color: #ecf0f1;
			 }

			 #header {
					 background-color: #3498db;
					 color: #fff;
					 text-align: center;
					 padding: 10px;
			 }

			 #menu {
					 float: left;
					 width: 100%;
					 background-color: #2c3e50;
					 overflow-y: auto;
					 padding: 50px;
			 }

			 #menu img {
					 width: 5%;
					 margin: 10px;
					 cursor: pointer;
			 }

			 #menu select {
					 width: 80%;
					 padding: 10px;
					 margin: 10px;
					 border: none;
					 border-radius: 3px;
					 background-color: #34495e;
					 color: #fff;
					 cursor: pointer;
			 }

			 #content {
					 float: left;
					 width: 80%;
					 padding: 20px;
					 background-color: #ecf0f1;
			 }

			 .author-details, .gift-details {
					 background-color: #fff;
					 border: 1px solid #ccc;
					 padding: 10px;
					 margin-bottom: 10px;
					 border-radius: 5px;
			 }

			 .details-button {
					 background-color: #4caf50;
					 color: #fff;
					 padding: 8px;
					 border: none;
					 border-radius: 3px;
					 cursor: pointer;
			 }

			 .details-image {
					 max-width: 30%;
					 height: auto;
					 margin-bottom: 15px;
			 }
	 </style>
	</head>

	<body style="font-family: 'Arial', sans-serif;font-size: 16px;color: #333;background-color: #fff;	line-height: 1.6;">
		<div id="header">
			 <div id="menu">
					 <a href="acceuil.html">
							 <img src="image/logoHome.webp" alt="Accueil" />
					 </a>
					 <select id="authorList" onchange="loadAuthorDetails()">
							 <option value="" style="background-color: #2c3e50; color: #fff;">Sélectionnez un auteur</option>
							 <option value="auteur1" style="background-color: #2c3e50; color: #fff;">Auteur 1</option>
							 <option value="auteur2" style="background-color: #2c3e50; color: #fff;">Auteur 2</option>
					 </select>
			 </div>
	 </div>
	<div>
			<h1 style=' margin: 10px;border: 2px solid #000; padding: 10px;display: inline-block; '>Bienvenue sur la plateforme de gestion de liste de cadeau pour noël</h1>
<br><br>
<br><br>
<script>
        function AfficheDetails(idDetails) {
            var detailsDiv = document.getElementById(idDetails);

            // Affiche ou masque les détails
            detailsDiv.style.display = (detailsDiv.style.display === 'none') ? 'block' : 'none';
        }
    </script>

<br>
		</div>
		<?php


		include('CONTROLEUR/CONTROLEUR_1.php');


		?>
	</body>
</html>
