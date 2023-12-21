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
if(isset($_POST['submit_modif_liste'])){
  //echo 'bbjr';
  $cadeau_choisi=$_POST['select_cadeau_nom'];
  //var_dump( $_POST['submit_modif_liste']);
    $res_info_cadeau = json_decode(htmlspecialchars_decode($_POST['res_info_cadeau']));
    echo '<form method="post" action="../VUE/Vue_C_modif_valider.php">';

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
echo "    <label for='image_cadeau'>Image :</label>";
echo "    <input type='text' name='image_cadeau' id='image_cadeau' value='". $cadeau->image . "' ><br>";
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
 ?>
