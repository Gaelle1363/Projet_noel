<?php
	include('..\BO\BO_info_cadeaux.php');
	use infoCadeauxBO as infoCadeauxBO;
	include('..\BO\BO_listes.php');
	use ListesBO as ListesBO;
	include('..\BO\BO_auteur.php');
	use AuteurBO as AuteurBO;
	include('..\BO\BO_owner_reservation.php');
 use ownerReservationBO as ownerReservationBO;
 $infoCadeauxDAO = new infoCadeauxDAO();

 // Instanciation des objets BO nécessaires
$infoCadeauxBO = new infoCadeauxBO();
$auteurBO = new AuteurBO();
$listesBO = new ListesBO();
$infoCadeauxBO2=new infoCadeauxBO();
$infoCadeauxBO3=new infoCadeauxBO();
$infoCadeauxBO4=new infoCadeauxBO();
$owner_resevation=new ownerReservationBO();
$owner_resevation2=new ownerReservationBO();
// Récupération de tous les auteurs
$res_auteur = $auteurBO->recupererAuteur();
$ownerReservationBO = new ownerReservationBO;
$res_owner_reservation = $ownerReservationBO->recupererListeownerreservation();
// Initialisation de $selected_auteur_id à une valeur par défaut si le formulaire n'est pas soumis
$selected_auteur_id = isset($_POST['afficher_liste_auteur']) ? $_POST['select_auteur'] : null;

?>

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
							<img src="../image/logoHome.webp" style="" alt="Accueil" />
					</a>
					<br><br><br><br><br><br>


		<?php
		$ownerReservationBO = new ownerReservationBO;
		$res_owner_reservation = $ownerReservationBO->recupererListeownerreservation();

    echo '<form method="post" action="../VUE/Vue_C_add_owner.php">';
    echo ' <label for=liste_owner>Liste des personnes qui peuvent résever:</label>';
    echo "<select name='liste_owner' id='liste_owner'> <option value=''>----</option>";

      foreach ($res_owner_reservation as $owner_reservation) {
  echo "  <option value='owner_exist'> ". $owner_reservation->nom_owner ."  ". $owner_reservation->prenom_owner . " </option>";
  }
  echo "<option value='new_owner'> Ajouter une nouvelle personne</option> ";

  echo "</select>" ;

  echo "            <button type='submit' name='submit_add_owner' >Valider</button> </form>";


				        ?>

							</div>
					</div>

	</body>
</html>
