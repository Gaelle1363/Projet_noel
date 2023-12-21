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
				 echo'<a href="../VUE/Vue_principale.php">Retournez sur la Home page</a>';
    } else {
        // Gérer l'erreur
        echo "Erreur lors de l'ajout du cadeau à la liste.";
				 echo'<a href="../VUE/Vue_principale.php">Retournez sur la Home page</a>';
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
				 echo'<a href="../VUE/Vue_principale.php">Retournez sur la Home page</a>';

    }
 ?>
