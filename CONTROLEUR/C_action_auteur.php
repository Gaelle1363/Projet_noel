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

<?php
if (isset($_POST['submit1'])) {
    $selected_action = $_POST['select_action'];

    // Récupérez les listes de cadeaux depuis le champ caché
    $res_info_cadeau = json_decode(htmlspecialchars_decode($_POST['res_info_cadeau']));
		$res_id_auteur = json_decode(htmlspecialchars_decode($_POST['res_id_auteur']));

		$auteurBO2 = new AuteurBO();
		$auteurBO2 = $auteurBO2->AQuiAppartientLaListe($res_id_auteur);
		echo " <h2 style='text-align: center;color:#2c3e50;'>Liste de  ". $auteurBO2->prenom_auteur."   ".$auteurBO2->nom_auteur . "</h2>";

    if ($selected_action == 'see') {

        // Vérifiez si $res_info_cadeau est défini et non vide
        if (!empty($res_info_cadeau)) {
            foreach ($res_info_cadeau as $cadeau) {
                // Affichez les détails du cadeau
                echo "<div id='details-container'><br>";
								echo "<div>";
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
                echo "Image : <img src='{$cadeau->image}' style='width: 30px; height: 20px;' /> <br>";
                echo "Date de début de réservation : {$cadeau->date_debut_reservation} <br>";
                echo "Date de fin de réservation : {$cadeau->date_fin_reservation} <br>";
                //$etat = ($cadeau->etat_reservation == "1") ? 'réservé' : 'disponible';

                //$dateDuJour = new DateTime();
                //$today = date("Y-m-d)");
								if ($cadeau->date_fin_reservation < $today){
									echo 'Date de réservation dépassé';
								}elseif ($etat=='réservé'){
                  $nouvelOwnerDTO = new ownerReservationBO();
                  $nouvelOwnerDTO->id_owner = $cadeau->id_owner;
                  //echo $nouvelOwnerDTO->id_owner;
                  //$OwnerBO2 = new ownerReservationBO();
                  // Appeler la méthode pour ajouter le nouvel auteur
                  $nouvelOwnerDTO=$nouvelOwnerDTO->QuiAReserver($nouvelOwnerDTO->id_owner);

                  echo 'Réservé par : ' . $nouvelOwnerDTO->nom_owner . '  ' . $nouvelOwnerDTO->prenom_owner;

                } else {
                  echo "État du cadeau : {$etat} <br>";
                }


                // ... Ajouter d'autres informations si nécessaire ...
                echo "</div>";
                echo "</div>";
								echo "</div>";




            }
            echo "<br><br><br>";


            echo '<form method="post" action="../VUE/Vue_C_reserver_cadeau.php">';
            echo "     <input type='hidden' name='res_owner_reservation' value='" . htmlspecialchars(json_encode($res_owner_reservation)) . "'>";



          echo "    <label for='select_cadeau_nom'>Choisir un cadeau à réserver :</label>";
          echo "    <select name='select_cadeau_nom' id='select_cadeau_nom' required>";
          echo "<option value='' selected disabled>....</option>";
           foreach ($res_info_cadeau as $cadeau) {

             if (($cadeau->id_owner == null && $cadeau->date_fin_reservation > $today)){
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
        echo "<form method='post' action='../VUE/Vue_C_add_cadeau_auteur_exist.php'>";

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
      echo "<form method='post' action='../VUE/Vue_C_modif_cadeau.php'>";
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

			$infoCadeauxBO2=new infoCadeauxBO();
        $sup_info_cadeau = $infoCadeauxBO2->supprimerListeinfocadeaux($res_auteur_id);
				echo "Liste supprimé ";
				 echo'<a href="../VUE/Vue_principale.php">Retournez sur la Home page</a>';
      //$sup_info_cadeau = $infoCadeauxBO->supprimerListeinfocadeaux($selected_auteur_id);
  }else {
        echo "Autre option sélectionnée";
        // Ajoutez ici le code pour les autres options du deuxième formulaire
    }
}
?>
