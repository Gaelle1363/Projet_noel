<?php
include('..\DO\DO_info_cadeaux.php');
use infoCadeauxDAO as infoCadeauxDAO;

class infoCadeauxDAO {

	public $conn;

	// Connexion à la base de données
	function connectionBdd() {

		// Déclaration des variables de connexion
		$DB_HOST = "localhost";
		$DB_NAME = "ProjetNoel";
		$DB_PORT = 3306;
		$DB_USER = "root";
		$DB_PSWD = "";

		try {

			$connString =
				"mysql:host=".$DB_HOST.";dbname=".$DB_NAME.";
				port=".$DB_PORT;
				$this->conn = new PDO($connString, $DB_USER, $DB_PSWD);

		}
		catch(PDOException $e) {
			die("Erreur : " . $e->getMessage());
		}
	}

	// Requête de récupération des données en BDD
	function recupererListeinfocadeaux() : array {

		$this->connectionBdd();
		$res = $this->conn->query("SELECT id_cadeau, id_owner,id_liste,nom,resume,prix,image, date_debut_reservation,date_fin_reservation,etat_reservation FROM info_cadeaux");


		$i = 0;

		foreach ($res as $row) {
			$util = new infoCadeaux;
			$util->id_cadeau = $row['id_cadeau'];
			$util->id_owner = $row['id_owner'];
			$util->id_liste = $row['id_liste'];
      $util->nom = $row['nom'];
      $util->resume = $row['resume'];
      $util->prix = $row['prix'];
      $util->image = $row['image'];
      $util->date_debut_reservation = $row['date_debut_reservation'];
      $util->date_fin_reservation = $row['date_fin_reservation'];
			$util->date_de_reservation = $row['date_de_reservation'];
      $util->etat_reservation = $row['etat_reservation'];
			$infoCadeaux[$i] = $util;

			$i++;
		}

		return $infoCadeaux;
	}

	function supprimerListeinfocadeaux($idAuteur) : array {

		$this->connectionBdd();



		$query = "SELECT c.id_cadeau, c.id_owner, c.id_liste, c.nom, c.resume, c.prix, c.image, c.date_debut_reservation, c.date_fin_reservation, c.etat_reservation
								FROM info_cadeaux c
								INNER JOIN listes l ON c.id_liste = l.id_liste
								WHERE l.id_auteur = :idAuteur";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':idAuteur', $idAuteur, PDO::PARAM_INT);
		$stmt->execute();


		$res = $this->conn->query("DELETE FROM info_cadeaux WHERE id_liste =" . $idAuteur);





		$res2 = $this->conn->query("SELECT id_cadeau, id_owner,id_liste,nom,resume,prix,image, date_debut_reservation,date_fin_reservation,date_de_reservation,etat_reservation FROM info_cadeaux");


		$i = 0;
$infoCadeaux2=array();

	foreach ($res2 as $row) {
		$util = new infoCadeaux;
		$util->id_cadeau = $row['id_cadeau'];
		$util->id_owner = $row['id_owner'];
		$util->id_liste = $row['id_liste'];
		$util->nom = $row['nom'];
		$util->resume = $row['resume'];
		$util->prix = $row['prix'];
		$util->image = $row['image'];
		$util->date_debut_reservation = $row['date_debut_reservation'];
		$util->date_fin_reservation = $row['date_fin_reservation'];
		$util->date_de_reservation = $row['date_de_reservation'];
		$util->etat_reservation = $row['etat_reservation'];
		$infoCadeaux2[$i] = $util;

		$i++;
	}

if ($infoCadeaux2==null){
	return array();
}
return $infoCadeaux2;

	}

	function supprimerCadeau($idcadeau) : array {

		$this->connectionBdd();



		$query = "SELECT c.id_cadeau, c.id_owner, c.id_liste, c.nom, c.resume, c.prix, c.image, c.date_debut_reservation, c.date_fin_reservation, c.etat_reservation
								FROM info_cadeaux c
								INNER JOIN listes l ON c.id_liste = l.id_liste
								WHERE l.id_liste = :idcadeau";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':idcadeau', $idcadeau, PDO::PARAM_INT);
		$stmt->execute();


		$res = $this->conn->query("DELETE FROM info_cadeaux WHERE id_cadeau =" . $idcadeau);





		$res2 = $this->conn->query("SELECT id_cadeau, id_owner,id_liste,nom,resume,prix,image, date_debut_reservation,date_fin_reservation,date_de_reservation,etat_reservation FROM info_cadeaux");


		$i = 0;

		foreach ($res2 as $row) {
			$util = new infoCadeaux;
			$util->id_cadeau = $row['id_cadeau'];
			$util->id_owner = $row['id_owner'];
			$util->id_liste = $row['id_liste'];
			$util->nom = $row['nom'];
			$util->resume = $row['resume'];
			$util->prix = $row['prix'];
			$util->image = $row['image'];
			$util->date_debut_reservation = $row['date_debut_reservation'];
			$util->date_fin_reservation = $row['date_fin_reservation'];
			$util->date_de_reservation = $row['date_de_reservation'];
			$util->etat_reservation = $row['etat_reservation'];
			$infoCadeaux3[$i] = $util;

			$i++;
		}

		return $infoCadeaux3;

	}

function recupererListeinfocadeauxParAuteur($idAuteur) : array {
			 // Connexion à la base de données
			 $this->connectionBdd();

			 // Requête de récupération des données en BDD
			 $query = "SELECT c.id_cadeau, c.id_owner, c.id_liste, c.nom, c.resume, c.prix, c.image, c.date_debut_reservation, c.date_fin_reservation,c.date_de_reservation, c.etat_reservation
									 FROM info_cadeaux c
									 INNER JOIN listes l ON c.id_liste = l.id_liste
									 WHERE l.id_auteur = :idAuteur";

			 $stmt = $this->conn->prepare($query);
			 $stmt->bindParam(':idAuteur', $idAuteur, PDO::PARAM_INT);
			 $stmt->execute();


			 $infoCadeaux = array(); // Initialisez votre tableau

			 $i = 0;
			 foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
					 $util = new infoCadeaux;
					 $util->id_cadeau = $row['id_cadeau'];
					 $util->id_owner = $row['id_owner'];
					 $util->id_liste = $row['id_liste'];
					 $util->nom = $row['nom'];
					 $util->resume = $row['resume'];
					 $util->prix = $row['prix'];
					 $util->image = $row['image'];
					 $util->date_debut_reservation = $row['date_debut_reservation'];
					 $util->date_fin_reservation = $row['date_fin_reservation'];
					 $util->date_de_reservation = $row['date_de_reservation'];
					 $util->etat_reservation = $row['etat_reservation'];
					 $infoCadeaux[$i] = $util;
					 $i++;
			 }

			 return $infoCadeaux;
	 }


	 function ModifCadeau($cadeau_id,$cadeau_nom,$cadeau_resume,$cadeau_prix,$cadeau_img,$cadeau_ddr,$cadeau_dfr){
		 $this->connectionBdd();
		 $res = $this->conn->query("UPDATE info_cadeaux SET nom='" . $cadeau_nom . "', resume = '" .  $cadeau_resume . " ', prix = " . $cadeau_prix . ",image='".$cadeau_img."', date_debut_reservation ='". $cadeau_ddr . "',date_fin_reservation ='" .  $cadeau_dfr . "'  WHERE id_cadeau  =" . $cadeau_id );


		 		$res2 = $this->conn->query("SELECT id_cadeau, id_owner,id_liste,nom,resume,prix,image, date_debut_reservation,date_fin_reservation,date_de_reservation,etat_reservation FROM info_cadeaux");


		 		$i = 0;

		 		foreach ($res2 as $row) {
		 			$util = new infoCadeaux;
		 			$util->id_cadeau = $row['id_cadeau'];
		 			$util->id_owner = $row['id_owner'];
		 			$util->id_liste = $row['id_liste'];
		 			$util->nom = $row['nom'];
		 			$util->resume = $row['resume'];
		 			$util->prix = $row['prix'];
		 			$util->image = $row['image'];
		 			$util->date_debut_reservation = $row['date_debut_reservation'];
		 			$util->date_fin_reservation = $row['date_fin_reservation'];
		 			$util->date_de_reservation = $row['date_de_reservation'];
		 			$util->etat_reservation = $row['etat_reservation'];
		 			$infoCadeaux4[$i] = $util;

		 			$i++;
		 		}

		 		return $infoCadeaux4;




	 }

	 function ajouterNouveauCadeau(infoCadeauxDTO $nouveauCadeauDTO) {

    $query = "INSERT INTO info_cadeaux (id_cadeau, id_owner, id_liste, nom, resume, prix, image, date_debut_reservation, date_fin_reservation, etat_reservation, date_de_reservation) VALUES (:id_cadeau, :id_owner, :id_liste, :nom, :resume, :prix, :image, :date_debut_reservation, :date_fin_reservation, :etat_reservation, :date_de_reservation)";

    // Récupérer le maximum actuel de la colonne id_cadeau
    $maxIdQuery = "SELECT MAX(id_cadeau) AS max_id FROM info_cadeaux";
    $result = $this->conn->query($maxIdQuery);
    $maxId = $result->fetch(PDO::FETCH_ASSOC)['max_id'];

    // Ajouter 1 pour obtenir le nouvel ID
    $nouvelId = $maxId + 1;

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id_cadeau', $nouvelId);

    $stmt->bindParam(':id_liste', $nouveauCadeauDTO->id_liste);
    $stmt->bindParam(':nom', $nouveauCadeauDTO->nom);
    $stmt->bindParam(':resume', $nouveauCadeauDTO->resume);
    $stmt->bindParam(':prix', $nouveauCadeauDTO->prix);
    $stmt->bindParam(':image', $nouveauCadeauDTO->image);
    $stmt->bindParam(':date_debut_reservation', $nouveauCadeauDTO->date_debut_reservation);
    $stmt->bindParam(':date_fin_reservation', $nouveauCadeauDTO->date_fin_reservation);

    // Paramètres par défaut pour id_owner, date_de_reservation et etat_reservation
    $id_owner_default = null; // Si vous souhaitez définir une valeur par défaut différente, changez la ici
    $date_de_reservation_default = null; // Par défaut, la date de réservation n'est pas définie
    $etat_reservation_default = 0; // Par défaut, l'état de réservation est 0

    $stmt->bindParam(':id_owner', $id_owner_default);
    $stmt->bindParam(':date_de_reservation', $date_de_reservation_default);
    $stmt->bindParam(':etat_reservation', $etat_reservation_default);

    $stmt->execute();
}


function ReserverCadeau($id_owner,$id_cadeau) {
	$this->connectionBdd();
  $res = $this->conn->query("UPDATE info_cadeaux SET id_owner=" . $id_owner . ", etat_reservation=1  WHERE id_cadeau=" . $id_cadeau );
	$res2 = $this->conn->query("SELECT id_cadeau, id_owner,id_liste,nom,resume,prix,image, date_debut_reservation,date_fin_reservation,date_de_reservation,etat_reservation FROM info_cadeaux");

	$i = 0;

	foreach ($res2 as $row) {
		$util = new infoCadeaux;
		$util->id_cadeau = $row['id_cadeau'];
		$util->id_owner = $row['id_owner'];
		$util->id_liste = $row['id_liste'];
		$util->nom = $row['nom'];
		$util->resume = $row['resume'];
		$util->prix = $row['prix'];
		$util->image = $row['image'];
		$util->date_debut_reservation = $row['date_debut_reservation'];
		$util->date_fin_reservation = $row['date_fin_reservation'];
		$util->date_de_reservation = $row['date_de_reservation'];
		$util->etat_reservation = $row['etat_reservation'];
		$infoCadeaux[$i] = $util;

		$i++;
	}

	return $infoCadeaux;
}

}


?>
