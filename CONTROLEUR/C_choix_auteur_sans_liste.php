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

// Initialisation de $selected_auteur_id à une valeur par défaut si le formulaire n'est pas soumis
$selected_auteur_id = isset($_POST['afficher_liste_auteur']) ? $_POST['select_auteur'] : null;

?>
<?php
if (isset($_POST['submit_choisir_auteur_sans_liste'])) {
    $choix_auteur_sans_liste = $_POST['choix_auteur_sans_liste'];
    // Formulaire pour ajouter des cadeaux à une nouvelle liste
    echo "<form method='post' action='../VUE/Vue_C_add_cadeau_auteur_exist.php'>";
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



 ?>
