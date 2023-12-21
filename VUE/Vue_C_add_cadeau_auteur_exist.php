<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Liste cadeau de noël</title>

<link rel="stylesheet" href="../style.css">
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
		button {
				background-color: #4caf50;
				color: #fff;
				padding: 10px;
				border: none;
				border-radius: 3px;
				cursor: pointer;
				margin-bottom: 15px;
		}
</style>
	</head>

	<body>

<script>
        function AfficheDetails(idDetails) {
					var detailsDiv = document.getElementById(idDetails);

					// Affiche ou masque les détails
					detailsDiv.style.display = (detailsDiv.style.display === 'none') ? 'block' : 'none';
        }
    </script>

		<div id="header">
				<div id="menu">
						<a href="Vue_principale.php">
								<img src="../image/logoHome.webp" alt="Accueil" />
						</a>
            	<br><br><br><br><br><br>

														</div>
												</div>
							<div id="content">
								<?php
								include('..\CONTROLEUR\C_add_cadeau_auteur_exist.php');
								?>
							</div>





	</body>
</html>
