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
 echo'Ajout validé  <a href="../VUE/Vue_principale.php">Retournez sur la Home page</a>';
  }

 ?>
