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
$ownerReservationBO = new ownerReservationBO;
$res_owner_reservation = $ownerReservationBO->recupererListeownerreservation();
?>

<?php
if (isset($_POST['submit'])) {
    $selected_auteur_id = $_POST['select_auteur'];

    if ($selected_auteur_id == 'autre') {
        // Formulaire pour ajouter un nouvel auteur ou choisir parmi les auteurs sans liste
        echo "<form method='post' action='..\VUE\Vue_C_new_auteur.php'>";
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
            echo "<form method='post' action='..\VUE\Vue_C_action_auteur.php'>";
            echo "    <input type='hidden' name='selected_auteur_id' value='{$selected_auteur_id}'>";

            echo "    <label for='select_action'>Choisir une action :</label>";
            echo "    <select name='select_action' id='select_action' required>";
            echo "        <option value='' selected disabled>...</option>";
            echo "        <option value='see'>Voir les listes</option>";
            echo "        <option value='modif'>Modifier liste</option>";
            echo "        <option value='delete'>Supprimer liste</option>";
            echo "        <option value='add_cadeau'>Ajouter un cadeau</option>";
            echo "    </select>";

            // Ajoutez un champ caché pour stocker les listes de cadeaux
            echo "    <input type='hidden' name='res_info_cadeau' value='" . htmlspecialchars(json_encode($res_info_cadeau)) . "'>";
						echo "    <input type='hidden' name='res_id_auteur' value='" . htmlspecialchars(json_encode($selected_auteur_id)) . "'>";

            echo "    <button type='submit' name='submit1'>Valider</button>";
            echo "</form>";
        }
    }
}


?>
