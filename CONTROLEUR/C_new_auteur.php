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
if (isset($_POST['submit_nouvel_auteur_choix'])) {
    $nouvel_auteur_choix = $_POST['nouvel_auteur_choix'];

    if ($nouvel_auteur_choix == 'ajouter') {
        // Formulaire pour ajouter un nouvel auteur
        echo "<form method='post' action='../VUE/Vue_C_New_auteur_validé.php'>";
        echo "    <label for='nouveau_nom_auteur'>Nom de l'auteur :</label>";
        echo "    <input type='text' name='nouveau_nom_auteur' id='nouveau_nom_auteur' required>";
        echo "    <label for='nouveau_prenom_auteur'>Prénom de l'auteur :</label>";
        echo "    <input type='text' name='nouveau_prenom_auteur' id='nouveau_prenom_auteur' required>";
        // Ajoutez d'autres champs au besoin
        echo "    <button type='submit' name='submit_ajouter_auteur'>Ajouter l'auteur</button>";
        echo "</form>";
    } elseif ($nouvel_auteur_choix == 'choisir') {
        // Formulaire pour choisir parmi les auteurs sans liste
        echo "<form method='post' action='../VUE/Vue_C_choix_auteur_sans_liste.php'>";
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
?>
