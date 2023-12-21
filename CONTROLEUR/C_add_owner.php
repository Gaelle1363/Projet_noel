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


<?php

if(isset($_POST['submit_add_owner'])){
if ($_POST['liste_owner']=='new_owner'){
  echo "<form method='post' action='../VUE/Vue_C_add_owner_valider.php'>";
  echo "    <label for='nouveau_owner_nom'>Nom :</label>";
  echo "    <input type='text' name='nouveau_owner_nom' id='nouveau_owner_nom' required>";
  echo "    <label for='nouveau_owner_prenom'>Prénom :</label>";
  echo "    <input type='text' name='nouveau_owner_prenom' id='nouveau_owner_prenom' required>";
  // Ajoutez d'autres champs au besoin
  echo "    <button type='submit' name='submit_ajouter_owner'>Ajouter</button>";
  echo "</form>";
}else {
echo ' Owner existant <a href="../VUE/Vue_principale.php">Retournez sur la Home page</a>';


}
}

 ?>
