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
if(isset($_POST['submit_action_modif'])){

  $cadeau_id= $_POST['selected_cadeau_id'];
  $cadeau_nom= $_POST['nom_cadeau'];
  $cadeau_resume= $_POST['resume_cadeau'];
  $cadeau_prix= $_POST['prix_cadeau'];
	$cadeau_img= $_POST['image_cadeau'];
  $cadeau_ddr= $_POST['ddr_cadeau'];
  $cadeau_dfr= $_POST['dfr_cadeau'];
//	$res_info_cadeau = json_decode(htmlspecialchars_decode($_POST['res_info_cadeau']));
  $choix_action=$_POST['valider_action'];
  //var_dump($_POST['valider_action']);

  if ($choix_action=='modif_valider'){

    $modif_cadeau = $infoCadeauxBO3->ModifCadeau($cadeau_id,$cadeau_nom,$cadeau_resume,$cadeau_prix,$cadeau_img,$cadeau_ddr,$cadeau_dfr);
      echo "Modification réussie ! ";
			 echo'<a href="../VUE/Vue_principale.php">Retournez sur la Home page</a>';

  }elseif($choix_action=='delete_valider'){
    //Supprimer un cadeau
    $sup_cadeau = $infoCadeauxBO4->supprimerCadeau($cadeau_id);
		echo "Suppresion réussie ! ";
		 echo'<a href="../VUE/Vue_principale.php">Retournez sur la Home page</a>';
  }



}
 ?>
