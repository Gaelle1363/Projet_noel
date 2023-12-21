<?php
	include('BO\BO_info_cadeaux.php');
	use infoCadeauxBO as infoCadeauxBO;
	include('BO\BO_listes.php');
	use ListesBO as ListesBO;
	include('BO\BO_auteur.php');
	use AuteurBO as AuteurBO;
	include('BO\BO_owner_reservation.php');
 use ownerReservationBO as ownerReservationBO;
 $infoCadeauxDAO = new infoCadeauxDAO();
 $auteurBO = new AuteurBO();
$res_auteur=$auteurBO->recupererAuteur();
 // Initialisation de $selected_auteur_id à une valeur par défaut si le formulaire n'est pas soumis
 $selected_auteur_id = isset($_POST['afficher_liste_auteur']) ? $_POST['select_auteur'] : null;
?>
<html>

	<head>
		<title>Liste cadeau de noël</title>
	</head>

	<body style="font-family: 'Arial', sans-serif;font-size: 16px;color: #333;background-color: #fff;	line-height: 1.6;">
	<div>
			<h1 style=' margin: 10px;border: 2px solid #000; padding: 10px;display: inline-block; '>Bienvenue sur la plateforme de gestion de liste de cadeau pour noël</h1>
<br><br>
<br><br>
<form method='post' action=''>
		<label for='select_auteur'>Liste de :</label>
		<select name='select_auteur' id='select_auteur' required>
			<option value=''>.... </option>
				<?php foreach ($res_auteur as $auteur) : ?>
						<?php
						$selected = ($auteur->id_auteur == $selected_auteur_id) ? 'selected' : '';
						?>
						<option value='<?= $auteur->id_auteur ?>' <?= $selected ?>> <?= $auteur->prenom_auteur ?>  <?= $auteur->nom_auteur ?></option>
				<?php endforeach; ?>
		</select>
		<!--<button type='submit' name='afficher_liste_auteur'>Afficher Liste Auteur</button>-->
	</label>

  <button type='submit' name='submit' onclick='{console.log("fonction ")}'>Valider</button>

</form>





<script>

		function AfficheDetails(idDetails) {
				var detailsDiv = document.getElementById(idDetails);

				// Affiche ou masque les détails
				if (detailsDiv.style.display === 'none') {
						detailsDiv.style.display = 'block';
				} else {
						detailsDiv.style.display = 'none';
				}
		}
</script>
<?php
$selected_auteur_id;
 $infoCadeauxBO = new infoCadeauxBO();
if (isset($_POST['submit'])) {

//$selected_auteur_id = isset($_POST['select_auteur']) ? $_POST['select_auteur'] :null;
						// Récupération de l'auteur sélectionné
						$selected_auteur_id = $_POST['select_auteur'];

						if ($selected_auteur_id!== null ){

							// Récupération de la liste des cadeaux pour l'auteur sélectionné
							$res_info_cadeau = $infoCadeauxBO->recupererListeinfocadeauxParAuteur($selected_auteur_id);


													if (!empty($res_info_cadeau)) {

																echo "<form  method='post' action=''>";
																echo 	"	<label for='select_action'>Choisir une action :</label>";
																echo 	"		<select name='select_action' id='select_action'>";
																echo 	"			<option value=''>Choisir</option>";
																echo 	"			<option value='see'> Voir les listes </option>";
			 													echo 	"		<option value='modif'> Modifier liste </option>";
			 													echo 	"		<option value='delete'> Supprimer liste </option>";
		 														echo 	"	</select>";

		 														echo 	"		<button type='submit' name='submit1' onclick='{}'>Valider</button>";
	 															echo 	"		</form>";

															};
							};
							if(isset($_POST['submit1'])){
							$choix_action = $_POST['select_action'];
							echo $choix_action;
							$res_info_cadeau = $infoCadeauxBO->recupererListeinfocadeauxParAuteur($selected_auteur_id);
										if ($choix_action==='see'){
												// Affichage de la liste des cadeaux
												foreach ($res_info_cadeau as $cadeau) {
															// Afficher les détails du cadeau ici
															echo "<div>";
															echo " Nom du cadeau : {$cadeau->nom} ";
															echo "<button type='button' onclick='AfficheDetails(\"details_{$cadeau->id_cadeau}\")'>Détails</button>";
															echo "<div id='details_{$cadeau->id_cadeau}' style='display:none;'>";
															// ... Autres détails du cadeau ...
															echo "Résumé : {$cadeau->resume} <br>";
															echo "Prix : {$cadeau->prix} € <br>";
															echo "Image : <img src='Image/{$cadeau->image}' style='width:7%;height:10%' /> <br>";
															echo "Date de début de réservation : {$cadeau->date_debut_reservation} <br>";
															echo "Date de fin de réservation : {$cadeau->date_fin_reservation} <br>";
															$etat = ($cadeau->etat_reservation == "1") ? 'réservé' : 'disponible';
															echo "État du cadeau : {$etat} <br>";
															// ... Ajouter d'autres informations si nécessaire ...
															echo "</div>";
															echo "</div>";
														}

		 							$infoCadeauxDAO = new infoCadeauxDAO();
								};
						};
					};


//else if ($choix_action == 'delete' && $selected_auteur_id!== null){
	//$delete_info_cadeau = $infoCadeauxBO->supprimerListeinfocadeaux();
//	}



// Récupérer la liste des cadeaux non réservés
//$listeCadeauxNonReserves = $infoCadeauxDAO->recupererListeCadeauxNonReserves();

// Afficher la liste déroulante

?>
<br>

<script>

function Affiche(id){

 if (document.getElementById(id).style.display == 'none')  {

	document.getElementById(id).style.display = 'block';

	} else if(document.getElementById(id).style.display == 'block') {

	document.getElementById(id).style.display = 'none';

	}
};


function Reserve(id){
	if (id.value){
		console.log('tot');
	} else {
		console.log(id.value);
	}




	};


</script>

<?php
//$today = date("Y-m-d");
//echo $today;

//Récupération des DAO et DO
$bdd = new infoCadeauxBO;
//$res_info_cadeau = $bdd->recupererListeinfocadeaux();

$bdd1 = new ListesBO;
$res_listes = $bdd1->recupererListes();
$bdd2 = new AuteurBO;
$res_auteur = $bdd2->recupererAuteur();
$ownerReservationBO = new ownerReservationBO;
$res_owner_reservation = $ownerReservationBO->recupererListeownerreservation();

$count_auteur = count($res_auteur);
//$count_cadeau = count($res_info_cadeau);
$count_liste = count($res_listes);

/*
for ($j = 0; $j < $count_auteur; $j++) {

	//echo " id liste  : ". $res_listes[$r]->id_liste . "</br>";
	//echo " auteur  : ". $res_listes[$r]->auteur . "</br>";
	echo "</br></br></br> Liste de  ". $res_auteur[$j]->nom_auteur . "  ". $res_auteur[$j]->prenom_auteur. " &emsp; &emsp; <button type='button' name='button'onclick={}>+</button>  &emsp; <button type='button' name='button'onclick={}>[...]</button>
	 &emsp; <button type='button' name='button'onclick={}>X</button></br></br>";

	for ($r = 0; $r < $count_liste; $r++) {
		//echo " id auteur  : ". $res_auteur[$i]->id_auteur . "</br>";




		for ($i = 0; $i < $count_cadeau; $i++) {
			if ($res_auteur[$j]->id_auteur===$res_listes[$r]->auteur){


			if ($res_info_cadeau[$i]->id_liste===$res_listes[$r]->id_liste){



			//echo " id_liste  : ". $res_info_cadeau[$i]->id_liste ." </br>  ";
			echo " Nom du cadeau  : ". $res_info_cadeau[$i]->nom . " <button type='button' name='button'onclick={Affiche(". $i .")}>Détails</button></br>  ";
		  //echo " id_cadeau  : ". $res_info_cadeau[$i]->id_cadeau ." </br>  ";
			echo "<div id='" . $i.  "' style='display:none'>";
		  echo " Description du cadeau  : ". $res_info_cadeau[$i]->resume ." </br>  ";
		  echo " Prix du cadeau : ". $res_info_cadeau[$i]->prix ." € </br>  ";
		  echo " Image  : <img  src='Image/". $res_info_cadeau[$i]->image ."' style='width:7%;height:10%' /> </br>  ";
		  echo " Date de début de reservation  : ". $res_info_cadeau[$i]->date_debut_reservation ." </br>  ";
		  echo " Date de fin de reservation  : ". $res_info_cadeau[$i]->date_fin_reservation ." </br>  ";
			$etat=$res_info_cadeau[$i]->etat_reservation;
			if ($etat == "1"){
				$etat='réservé';
				echo " Personne ayant réservé le cadeau  : ". $res_info_cadeau[$i]->id_owner ." </br>    ";	;
			} else {
				$etat='disponible';
			}
		  echo " <div id='name_".$i."'>Etat du cadeau  : ". $etat ." </div>    <label for='owner-select'>Qui réserve ? </label> <select name='owner' id='owner-select'> <option value=''>----</option>";

				foreach ($res_owner_reservation as $owner_reservation) {
		echo "  <option value=''> ". $owner_reservation->nom_owner ."  ". $owner_reservation->prenom_owner . " </option>";
		}
		echo "</select>             <button type='button' name='button'onclick={Reserve(name_".$i.")}>Résever</button> </br></br></br>";
			echo " </div>";
}
		}

	}
}


}
*/

/*

*/


// Appel à la fonction de récupération de la liste des réservations


// Affichage des données de la table owner_reservation
/*
echo "<h2>Liste des réservations</h2>";
foreach ($res_owner_reservation as $owner_reservation) {
    echo "ID Owner : " . $owner_reservation->id_owner . "</br>";
    echo "Nom du propriétaire : " . $owner_reservation->nom_owner . "</br>";
    echo "Prénom du propriétaire : " . $owner_reservation->nom_owner. "</br></br>";
}
*/
	// Fermeture de la connexion
	/*if ($conn != null)
		$conn->close();*/
?>
		</div>

	</body>
</html>
