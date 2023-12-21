<?php
include('..\DO\DO_owner_reservation.php');
use ownerReservationDAO as ownerReservationDAO;

class ownerReservationDAO {

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
	function recupererListeownerreservation() : array {

		$this->connectionBdd();
		$res = $this->conn->query("SELECT id_owner, nom_owner,prenom_owner FROM owner_reservation");


		$i = 0;

		foreach ($res as $row) {
			$util = new ownerReservation;
			$util->id_owner = $row['id_owner'];
			$util->nom_owner = $row['nom_owner'];
			$util->prenom_owner = $row['prenom_owner'];

			$ownerReservation[$i] = $util;

			$i++;
		}

		return $ownerReservation;
	}







	function ajouterNouvelOwner($nom_owner,$prenom_owner)  {
		$this->connectionBdd();
		$query = "INSERT INTO owner_reservation (id_owner, nom_owner, prenom_owner) VALUES (:id_owner, :nom_owner, :prenom_owner)";

// Récupérer le maximum actuel de la colonne id_auteur
$maxIdQuery = "SELECT MAX(id_owner) AS max_id FROM owner_reservation";
$result = $this->conn->query($maxIdQuery);
$maxId = $result->fetch(PDO::FETCH_ASSOC)['max_id'];

// Ajouter 1 pour obtenir le nouvel ID
$nouvelId = $maxId + 1;

// Utiliser le nouvel ID pour l'insertion
$stmt = $this->conn->prepare($query);
$stmt->bindParam(':id_owner', $nouvelId);
$stmt->bindParam(':nom_owner', $nom_owner);
$stmt->bindParam(':prenom_owner', $prenom_owner);


// Exécuter la requête
$stmt->execute();

	}





	function QuiAReserver($id_owner) {
	    $this->connectionBdd();

	    $query = "SELECT id_owner, nom_owner, prenom_owner FROM owner_reservation WHERE id_owner = :id_owner";

	    // Utiliser le nouvel ID pour l'insertion
	    $stmt = $this->conn->prepare($query);
	    $stmt->bindParam(':id_owner', $id_owner);

	    // Exécuter la requête
	    $stmt->execute();

	    // Récupérer les résultats
	    $result = $stmt->fetch(PDO::FETCH_ASSOC);

	    // Vérifier s'il y a des résultats
	    if ($result) {
	        $reserveur = new ownerReservation();
	        $reserveur->id_owner = $result['id_owner'];
	        $reserveur->nom_owner = $result['nom_owner'];
	        $reserveur->prenom_owner = $result['prenom_owner'];

	        return $reserveur;
	    } else {
	        // Gérer le cas où aucun résultat n'est trouvé
	        return null;
	    }
	}


}

?>
