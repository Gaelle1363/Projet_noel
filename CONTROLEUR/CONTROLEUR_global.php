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

// Initialisation de $selected_auteur_id à une valeur par défaut si le formulaire n'est pas soumis
$selected_auteur_id = isset($_POST['afficher_liste_auteur']) ? $_POST['select_auteur'] : null;

?>

<?php
$ownerReservationBO = new ownerReservationBO;
$res_owner_reservation = $ownerReservationBO->recupererListeownerreservation();
	echo '<form method="post" action="">';
	echo ' <label for=liste_owner>Liste des personnes qui peuvent résever:</label>';
	echo "<select name='owner' id='owner-select'> <option value=''>----</option>";

		foreach ($res_owner_reservation as $owner_reservation) {
echo "  <option value='". $owner_reservation->id_owner."'> ". $owner_reservation->nom_owner ."  ". $owner_reservation->prenom_owner . " </option>";
}
echo "<option value='new_owner'> Ajouter une nouvelle personne</option> ";

echo "</select>" ;

echo "            <button type='submit' name='submit_add_owner' >Valider</button> </form>";

		   echo "     <form method='post' action=''>";
		      echo "      <label for='select_auteur'>Choisir un auteur :</label> ";
		       echo "     <select name='select_auteur' id='select_auteur' required>";
		          echo "      <option value='' selected disabled>....</option> ";
		             ?>
                    <?php
		                // Filtrer les auteurs ayant une liste
		                $auteursAvecListes = array_filter($res_auteur, function ($auteur) use ($infoCadeauxBO) {
		                    return !empty($infoCadeauxBO->recupererListeinfocadeauxParAuteur($auteur->id_auteur));
		                });

		                foreach ($auteursAvecListes as $auteur) :
		                    $selected = ($auteur->id_auteur == $selected_auteur_id) ? 'selected' : '';
		                ?>

		                    <option value='<?= $auteur->id_auteur ?>' <?= $selected ?>><?= $auteur->nom_auteur ?> <?= $auteur->prenom_auteur ?></option>
		                <?php endforeach; ?> ";
		                <!-- Option pour ajouter un nouvel auteur -->
		             <option value='autre'>Autre</option>
		              </select>
		             <button type='submit' name='submit'>Valider</button>
		         </form>

		        <?php
		        if (isset($_POST['submit'])) {
		            $selected_auteur_id = $_POST['select_auteur'];

		            if ($selected_auteur_id == 'autre') {
		                // Formulaire pour ajouter un nouvel auteur ou choisir parmi les auteurs sans liste
		                echo "<form method='post' action=''>";
		                echo "    <label for='nouvel_auteur_choix'>Choisir une option :</label>";
		                echo "    <select name='nouvel_auteur_choix' id='nouvel_auteur_choix'>";
		                echo "        <option value='ajouter'>Ajouter un nouvel auteur</option>";
		                echo "        <option value='choisir'>Choisir parmi les auteurs sans liste</option>";
		                echo "    </select>";
		                echo "    <button type='submit' name='submit_nouvel_auteur_choix'>Valider</button>";
		                echo "</form>";
		            } else {
		                // Récupération de la liste des cadeaux pour l'auteur sélectionné
		                $res_info_cadeau = $infoCadeauxBO->recupererListeinfocadeauxParAuteur($selected_auteur_id);

		                if (!empty($res_info_cadeau)) {
		                    // Formulaire pour les auteurs ayant déjà une liste
		                    echo "<form method='post' action=''>";
												echo "    <input type='hidden' name='selected_auteur_id' value='{$selected_auteur_id}'>";

		                    echo "    <label for='select_action'>Choisir une action :</label>";
		                    echo "    <select name='select_action' id='select_action'>";
		                    echo "        <option value='' selected disabled>...</option>";
		                    echo "        <option value='see'>Voir les listes</option>";
		                    echo "        <option value='modif'>Modifier liste</option>";
		                    echo "        <option value='delete'>Supprimer liste</option>";
		                    echo "        <option value='add_cadeau'>Ajouter un cadeau</option>";
		                    echo "    </select>";

		                    // Ajoutez un champ caché pour stocker les listes de cadeaux
		                    echo "    <input type='hidden' name='res_info_cadeau' value='" . htmlspecialchars(json_encode($res_info_cadeau)) . "'>";

		                    echo "    <button type='submit' name='submit1'>Valider</button>";
		                    echo "</form>";
		                }
		            }
		        }

						if(isset($_POST['submit_add_owner'])){

							echo "<form method='post' action=''>";
							echo "    <label for='nouveau_owner_nom'>Nom :</label>";
							echo "    <input type='text' name='nouveau_owner_nom' id='nouveau_owner_nom' required>";
							echo "    <label for='nouveau_owner_prenom'>Prénom :</label>";
							echo "    <input type='text' name='nouveau_owner_prenom' id='nouveau_owner_prenom' required>";
							// Ajoutez d'autres champs au besoin
							echo "    <button type='submit' name='submit_ajouter_owner'>Ajouter</button>";
							echo "</form>";
						}

						if(isset($_POST['submit_ajouter_owner'])){

							// Traitement pour ajouter un nouvel auteur
						  $nouveau_nom_owner = $_POST['nouveau_owner_nom'];
						  $nouveau_prenom_owner = $_POST['nouveau_owner_prenom'];

						  // Créer un objet AuteurDTO avec les données du formulaire
						  $nouvelOwnerDTO = new ownerReservationDTO();
						  $nouvelOwnerDTO->nom_owner = $nouveau_nom_owner;
						  $nouvelOwnerDTO->prenom_owner = $nouveau_prenom_owner;
							$OwnerBO = new ownerReservationBO();
						  // Appeler la méthode pour ajouter le nouvel auteur
						  $OwnerBO->ajouterNouvelOwner($nouveau_nom_owner,$nouveau_prenom_owner);

							}



		        if (isset($_POST['submit1'])) {
		            $selected_action = $_POST['select_action'];

		            // Récupérez les listes de cadeaux depuis le champ caché
		            $res_info_cadeau = json_decode(htmlspecialchars_decode($_POST['res_info_cadeau']));

		            if ($selected_action == 'see') {
		                // Vérifiez si $res_info_cadeau est défini et non vide
		                if (!empty($res_info_cadeau)) {
		                    foreach ($res_info_cadeau as $cadeau) {
		                        // Affichez les détails du cadeau
		                        echo "<br><div>";
														$etat = ($cadeau->etat_reservation == "1") ? 'réservé' : 'disponible';
														echo "<div>";
														//$dateDuJour = new DateTime();
														$today = date("Y-m-d)");
														if ($etat=='réservé'){
															//echo 'Réservé par : ' . $cadeau->$id_owner;
															echo " <div class='pastille' style='width: 10px; height: 10px; border-radius: 20%; margin-right: 10px;background-color: red;'>";
														}else if($cadeau->date_fin_reservation < $today){
															//echo 'Date de réservation dépassé';
															echo " <div class='pastille' style='width: 10px; height: 10px; border-radius: 10%; margin-right: 2px;background-color: red;'>";

														} else {
															echo " <div class='pastille' style='width: 10px; height: 10px; border-radius: 20%; margin-right: 10px;background-color: green;'>";

															// echo "État du cadeau : {$etat} <br>";
															// echo '<button type="button" onclick="Reserver()">Réserver</button>';
														}
														echo "</div>";
		                        echo " Nom du cadeau : {$cadeau->nom} ";

		                        echo "<button type='button' onclick='AfficheDetails(\"details_{$cadeau->id_cadeau}\")'>Détails</button>";
														echo "</div>";
		                        echo "<div id='details_{$cadeau->id_cadeau}' style='display:none;'>";
		                        echo "Résumé : {$cadeau->resume} <br>";
		                        echo "Prix : {$cadeau->prix} € <br>";
		                        echo "Image : <img src='Image/{$cadeau->image}' style='width:7%;height:10%' /> <br>";
		                        echo "Date de début de réservation : {$cadeau->date_debut_reservation} <br>";
		                        echo "Date de fin de réservation : {$cadeau->date_fin_reservation} <br>";
		                        //$etat = ($cadeau->etat_reservation == "1") ? 'réservé' : 'disponible';

														//$dateDuJour = new DateTime();
														//$today = date("Y-m-d)");

														if ($etat=='réservé'){
															$nouvelOwnerDTO = new ownerReservationBO();
															$nouvelOwnerDTO->id_owner = $cadeau->id_owner;
															//echo $nouvelOwnerDTO->id_owner;
															//$OwnerBO2 = new ownerReservationBO();
															// Appeler la méthode pour ajouter le nouvel auteur
															$nouvelOwnerDTO=$nouvelOwnerDTO->QuiAReserver($nouvelOwnerDTO->id_owner);

															echo 'Réservé par : ' . $nouvelOwnerDTO->nom_owner . '  ' . $nouvelOwnerDTO->prenom_owner;

														}else if($cadeau->date_fin_reservation < $today){
															echo 'Date de réservation dépassé';
														} else {
															echo "État du cadeau : {$etat} <br>";
														}


		                        // ... Ajouter d'autres informations si nécessaire ...
		                        echo "</div>";
		                        echo "</div>";




		                    }
												echo "<br><br><br>";


												echo '<form method="post" action="">';
												echo "     <input type='hidden' name='res_owner_reservation' value='" . htmlspecialchars(json_encode($res_owner_reservation)) . "'>";



											echo "    <label for='select_cadeau_nom'>Choisir un cadeau à réserver :</label>";
											echo "    <select name='select_cadeau_nom' id='select_cadeau_nom' required>";
											echo "<option value='' selected disabled>....</option>";
											 foreach ($res_info_cadeau as $cadeau) {
                         if ($cadeau->id_owner == null){
												 echo "<option value='".htmlspecialchars($cadeau->id_cadeau)."'>".$cadeau->nom."</option>";
}

										}
									//	echo "    <input type='hidden' name='select_cadeau' value='{$cadeau->id_cadeau}'>";

										echo "    </select>";

										// Ajoutez un champ caché pour stocker les listes de cadeaux
										echo "    <input type='hidden' name='res_info_cadeau' value='" . htmlspecialchars(json_encode($res_info_cadeau)) . "'>";
											echo "<label for='owner_select'> Qui réserve ?</label> ";
											echo "<select name='owner_select' id='owner_select'>";
											echo " <option value='' selected disabled>----</option>";

												foreach ($res_owner_reservation as $owner_reservation) {
										echo "  <option value='". htmlspecialchars($owner_reservation->id_owner) ."'> ". $owner_reservation->nom_owner ."  ". $owner_reservation->prenom_owner . " </option>";
										}
										echo "</select>" ;

										echo "            <button type='submit' name='submit_reservation' >Résever</button> </form>";




		                } else {
		                    echo "Aucun cadeau trouvé pour cet auteur.";
		                }
		            } elseif ($selected_action == 'add_cadeau') {
									$selected_auteur_id = json_decode(htmlspecialchars_decode($_POST['selected_auteur_id']));

		                // Formulaire pour ajouter un cadeau
		                echo "<form method='post' action=''>";

		                echo "    <input type='hidden' name='selected_auteur_id' value='{$selected_auteur_id}'>";
		                echo "    <label for='nom_cadeau'>Nom du cadeau :</label>";
		                echo "    <input type='text' name='nom_cadeau' id='nom_cadeau' required>";
		                echo "    <label for='resume_cadeau'>Résumé :</label>";
		                echo "    <input type='text' name='resume_cadeau' id='resume_cadeau' required>";
		                echo "    <label for='prix_cadeau'>Prix :</label>";
		                echo "    <input type='number' name='prix_cadeau' id='prix_cadeau' required>";
		                echo "    <label for='image_cadeau'>image :</label>";
		                echo "    <input type='text' name='image_cadeau' id='image_cadeau' required>";
		                echo "    <label for='date_debut_reservation'>date debut reservation :</label>";
		                echo "    <input type='date' name='date_debut_reservation' id='date_debut_reservation' required>";
		                echo "    <label for='date_fin_reservation'>date fin reservation :</label>";
		                echo "    <input type='date' name='date_fin_reservation' id='date_fin_reservation' required>";
		                // Ajoutez d'autres champs au besoin
		                echo "    <button type='submit' name='submit_add_cadeau'>Ajouter le cadeau</button>";
		                echo "</form>";
		            } elseif($selected_action =='modif'){
									echo "<form method='post' action=''>";
									//echo "    <input type='hidden' name='selected_auteur_id' value='{$selected_auteur_id}'>";

									echo "    <label for='select_cadeau_nom'>Choisir un cadeau à modifier :</label>";
									echo "    <select name='select_cadeau_nom' id='select_cadeau_nom' required>";
									echo "<option value='' selected disabled>....</option>";
									 foreach ($res_info_cadeau as $cadeau) {
										 echo "<option value='".htmlspecialchars($cadeau->nom)."'>".$cadeau->nom."</option>";


								}
							//	echo "    <input type='hidden' name='select_cadeau' value='{$cadeau->id_cadeau}'>";

								echo "    </select>";

								// Ajoutez un champ caché pour stocker les listes de cadeaux
								echo "    <input type='hidden' name='res_info_cadeau' value='" . htmlspecialchars(json_encode($res_info_cadeau)) . "'>";

								echo "    <button type='submit' name='submit_modif_liste'>Valider</button>";
								echo "</form>";





								}elseif($selected_action =='delete'){
									//echo 'toto';
									$res_info_cadeau = json_decode(htmlspecialchars_decode($_POST['res_info_cadeau']));
										$res_auteur_id = json_decode(htmlspecialchars_decode($_POST['selected_auteur_id']));
								//	var_dump( $_POST['selected_auteur_id']);
									//echo $res_auteur_id;


										$sup_info_cadeau = $infoCadeauxBO2->supprimerListeinfocadeaux($res_auteur_id);

									//$sup_info_cadeau = $infoCadeauxBO->supprimerListeinfocadeaux($selected_auteur_id);
							}else {
		                echo "Autre option sélectionnée";
		                // Ajoutez ici le code pour les autres options du deuxième formulaire
		            }
		        }

						if(isset($_POST['submit_reservation'])){
							$infoCadeauxBO5=new infoCadeauxBO();
							$id_owner = $_POST['owner_select'];
							$id_cadeau=$_POST['select_cadeau_nom'];

						  $infoCadeauxBO5->ReserverCadeau($id_owner,$id_cadeau);
						}






		        if (isset($_POST['submit_nouvel_auteur_choix'])) {
		            $nouvel_auteur_choix = $_POST['nouvel_auteur_choix'];

		            if ($nouvel_auteur_choix == 'ajouter') {
		                // Formulaire pour ajouter un nouvel auteur
		                echo "<form method='post' action=''>";
		                echo "    <label for='nouveau_nom_auteur'>Nom de l'auteur :</label>";
		                echo "    <input type='text' name='nouveau_nom_auteur' id='nouveau_nom_auteur' required>";
		                echo "    <label for='nouveau_prenom_auteur'>Prénom de l'auteur :</label>";
		                echo "    <input type='text' name='nouveau_prenom_auteur' id='nouveau_prenom_auteur' required>";
		                // Ajoutez d'autres champs au besoin
		                echo "    <button type='submit' name='submit_ajouter_auteur'>Ajouter l'auteur</button>";
		                echo "</form>";
		            } elseif ($nouvel_auteur_choix == 'choisir') {
		                // Formulaire pour choisir parmi les auteurs sans liste
		                echo "<form method='post' action=''>";
		                echo "    <label for='choix_auteur_sans_liste'>Choisir un auteur sans liste :</label>";
		                echo "    <select name='choix_auteur_sans_liste' id='choix_auteur_sans_liste' required>";
		                echo "        <option value='' selected disabled>....</option>";
		                // Afficher la liste des auteurs sans liste
		                foreach ($res_auteur as $auteur) {
		                    if (empty($infoCadeauxBO->recupererListeinfocadeauxParAuteur($auteur->id_auteur))) {
		                        echo "        <option value='{$auteur->id_auteur}'>{$auteur->nom_auteur} {$auteur->prenom_auteur}</option>";
		                    }
		                }
		                echo "    </select>";
		                echo "    <button type='submit' name='submit_choisir_auteur_sans_liste'>Valider</button>";
		                echo "</form>";
		            }
		        }




		        if (isset($_POST['submit_ajouter_auteur'])) {

		    // Traitement pour ajouter un nouvel auteur
		    $nouveau_nom_auteur = $_POST['nouveau_nom_auteur'];
		    $nouveau_prenom_auteur = $_POST['nouveau_prenom_auteur'];

		    // Créer un objet AuteurDTO avec les données du formulaire
		    $nouvelAuteurDTO = new AuteurDTO();
		    $nouvelAuteurDTO->nom_auteur = $nouveau_nom_auteur;
		    $nouvelAuteurDTO->prenom_auteur = $nouveau_prenom_auteur;

		    // Appeler la méthode pour ajouter le nouvel auteur
		    if ($auteurBO->ajouterNouvelAuteur($nouveau_nom_auteur,$nouveau_prenom_auteur)) {

		        echo "Nouvel auteur ajouté avec succès!";


		    } else {
		        echo "Erreur lors de l'ajout du nouvel auteur.";
		    }
		}

		        if (isset($_POST['submit_choisir_auteur_sans_liste'])) {
		            $choix_auteur_sans_liste = $_POST['choix_auteur_sans_liste'];
								// Formulaire pour ajouter des cadeaux à une nouvelle liste
								echo "<form method='post' action=''>";
								echo "    <input type='hidden' name='selected_auteur_id' value='{$choix_auteur_sans_liste}'>";
								echo "    <label for='nom_cadeau'>Nom du cadeau :</label>";
								echo "    <input type='text' name='nom_cadeau' id='nom_cadeau' required>";
								echo "    <label for='resume_cadeau'>Résumé :</label>";
								echo "    <input type='text' name='resume_cadeau' id='resume_cadeau' required>";
								echo "    <label for='prix_cadeau'>Prix :</label>";
								echo "    <input type='number' name='prix_cadeau' id='prix_cadeau' required>";

								// Ajoutez ici les champs pour d'autres informations sur le cadeau
								echo "    <label for='image_cadeau'>Image :</label>";
								echo "    <input type='text' name='image_cadeau' id='image_cadeau' required>";
								echo "    <label for='date_debut_reservation'>Date début réservation :</label>";
								echo "    <input type='date' name='date_debut_reservation' id='date_debut_reservation' required>";
								echo "    <label for='date_fin_reservation'>Date fin réservation :</label>";
								echo "    <input type='date' name='date_fin_reservation' id='date_fin_reservation' required>";

								echo "    <button type='submit' name='submit_add_cadeau'>Ajouter le cadeau</button>";
								echo "    <button type='submit' name='valider_liste'>Valider la liste</button>";
								echo "</form>";
								// Vous pouvez ajouter ici d'autres traitements nécessaires
							}

// Vérifier si le formulaire d'ajout de cadeau a été soumis
if (isset($_POST['submit_add_cadeau'])) {
    $nouveauCadeauDTO = new infoCadeauxDTO();

    // Récupérer l'id de l'auteur sélectionné
    $idAuteurSelectionne = isset($_POST['selected_auteur_id']) ? $_POST['selected_auteur_id'] : null;

    // Remplir les autres champs du DTO avec les valeurs du formulaire
    $nouveauCadeauDTO->nom = $_POST['nom_cadeau'];
    $nouveauCadeauDTO->resume = $_POST['resume_cadeau'];
    $nouveauCadeauDTO->prix = $_POST['prix_cadeau'];
    $nouveauCadeauDTO->image = $_POST['image_cadeau'];
    $nouveauCadeauDTO->date_debut_reservation = $_POST['date_debut_reservation'];
    $nouveauCadeauDTO->date_fin_reservation = $_POST['date_fin_reservation'];

    // Affecter l'id de l'auteur sélectionné à id_liste
    $nouveauCadeauDTO->id_liste = $idAuteurSelectionne;

    // Traiter le résultat si nécessaire
    if ($infoCadeauxBO->ajouterNouveauCadeau($nouveauCadeauDTO)) {
        echo "Cool, le cadeau a été ajouté à la liste !";
    } else {
        // Gérer l'erreur
        echo "Erreur lors de l'ajout du cadeau à la liste.";
    }

    // Formulaire pour ajouter des cadeaux à une nouvelle liste
    echo "<form method='post' action=''>";
    echo "    <input type='hidden' name='selected_auteur_id' value='{$idAuteurSelectionne}'>";
    echo "    <label for='nom_cadeau'>Nom du cadeau :</label>";
    echo "    <input type='text' name='nom_cadeau' id='nom_cadeau' >";
    echo "    <label for='resume_cadeau'>Résumé :</label>";
    echo "    <input type='text' name='resume_cadeau' id='resume_cadeau' >";
    echo "    <label for='prix_cadeau'>Prix :</label>";
    echo "    <input type='number' name='prix_cadeau' id='prix_cadeau' >";

    // Ajoutez ici les champs pour d'autres informations sur le cadeau
    echo "    <label for='image_cadeau'>Image :</label>";
    echo "    <input type='text' name='image_cadeau' id='image_cadeau' >";
    echo "    <label for='date_debut_reservation'>Date début réservation :</label>";
    echo "    <input type='date' name='date_debut_reservation' id='date_debut_reservation' >";
    echo "    <label for='date_fin_reservation'>Date fin réservation :</label>";
    echo "    <input type='date' name='date_fin_reservation' id='date_fin_reservation' >";

    echo "    <button type='submit' name='submit_add_cadeau'>Ajouter le cadeau</button>";
    echo "    <button type='submit' name='valider_liste'>Valider la liste</button>";
    echo "</form>";
} elseif (isset($_POST['valider_liste'])) {
    // Traitement pour valider la liste

    // Récupérer l'id de l'auteur sélectionné
//$idAuteurSelectionne = isset($_POST['selected_auteur_id']) ? $_POST['selected_auteur_id'] : null;

    // Ajouter une nouvelle liste avec l'id de l'auteur sélectionné
  //  $nouvelleListeDTO = new ListesDTO();
  //  $nouvelleListeDTO->id_auteur = $idAuteurSelectionne;




        echo "Bravo ! La liste a été validé pour l'auteur sélectionné.";

    }


						if(isset($_POST['submit_modif_liste'])){
							//echo 'bbjr';
							$cadeau_choisi=$_POST['select_cadeau_nom'];
							//var_dump( $_POST['submit_modif_liste']);
							  $res_info_cadeau = json_decode(htmlspecialchars_decode($_POST['res_info_cadeau']));
								echo '<form method="post" action="">';

							//	echo "    <input type='hidden' name='selected_auteur_id' value='{$selected_auteur_id}'>";
							foreach ($res_info_cadeau as $cadeau) {

								$cadeau_name=$cadeau->nom;
								$cadeau_id=$cadeau->id_cadeau;
						if($cadeau_name == $cadeau_choisi){

						echo '<label for="nom_cadeau">Nom du cadeau :</label>';
					echo '<input type="text" id="nom_cadeau" name="nom_cadeau" value="'. $cadeau->nom . '"><br>';
					echo '<label for="resume_cadeau">Détails du cadeau :</label>';
				echo '<input type="text" id="resume_cadeau" name="resume_cadeau" value="'. $cadeau->resume . '"><br>';
				echo '<label for="prix_cadeau">Prix du cadeau :</label>';
			echo '<input type="number" id="prix_cadeau" name="prix_cadeau" value="'. $cadeau->prix . '"><br>';
			echo '<label for="ddr_cadeau">Date de début :</label>';
		echo '<input type="date" id="ddr_cadeau" name="ddr_cadeau" value="'. $cadeau->date_debut_reservation . '"><br>';
		echo '<label for="dfr_cadeau">Date de fin :</label>';
	echo '<input type="date" id="dfr_cadeau" name="dfr_cadeau" value="'. $cadeau->date_fin_reservation . '"><br>';
	//Choix de l'action
	echo '<label for="valider_action">Choisir une action :</label>';
	echo '<select name="valider_action" id="valider_action" required>';
	echo '<option value="test" selected disabled>....</option> ';
	echo '<option value="modif_valider">Valider la modification</option>';
	echo '<option value="delete_valider">Supprimer le cadeau</option>';
	echo '</select>';
	// Ajoutez un champ caché pour stocker les listes de cadeaux
	echo "    <input type='hidden' name='selected_cadeau_id' value='". htmlspecialchars(json_encode($cadeau_id)) ."'>";

	echo "    <button type='submit' name='submit_action_modif'>Valider la modification</button>";
	echo "</form>";
				}

			}
						}

						if(isset($_POST['submit_action_modif'])){
							$cadeau_id= $_POST['selected_cadeau_id'];
							$cadeau_nom= $_POST['nom_cadeau'];
							$cadeau_resume= $_POST['resume_cadeau'];
							$cadeau_prix= $_POST['prix_cadeau'];
							$cadeau_ddr= $_POST['ddr_cadeau'];
							$cadeau_dfr= $_POST['dfr_cadeau'];
						//	$res_info_cadeau = json_decode(htmlspecialchars_decode($_POST['res_info_cadeau']));
							$choix_action=$_POST['valider_action'];
							//var_dump($_POST['valider_action']);

							if ($choix_action=='modif_valider'){

								$modif_cadeau = $infoCadeauxBO3->ModifCadeau($cadeau_id,$cadeau_nom,$cadeau_resume,$cadeau_prix,$cadeau_ddr,$cadeau_dfr);


							}elseif($choix_action=='delete_valider'){
								//Supprimer un cadeau
								$sup_cadeau = $infoCadeauxBO4->supprimerCadeau($cadeau_id);
							}



						}

          //  include('VUE2.php');

		        ?>
