<?php
include('..\DO\DO_auteur.php');
use AuteurDAO as  AuteurDAO;

class AuteurDAO {

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
	function recupererAuteur() : array {

		$this->connectionBdd();
		$res = $this->conn->query("SELECT id_auteur,nom_auteur,prenom_auteur FROM auteur");


		$i = 0;

		foreach ($res as $row) {
			$util = new Auteur;
			$util->id_auteur = $row['id_auteur'];
			$util->nom_auteur= $row['nom_auteur'];
			$util->prenom_auteur = $row['prenom_auteur'];
      $Auteur[$i] = $util;
			$i++;
		}

		return $Auteur;
	}

	// Ajouter cette méthode à votre classe AuteurDAO
	function ajouterNouvelAuteur($nouveau_nom_auteur,$nouveau_prenom_auteur) {
		$query = "INSERT INTO auteur (id_auteur, nom_auteur, prenom_auteur) VALUES (:id_auteur, :nom_auteur, :prenom_auteur)";
$query2 = "INSERT INTO listes (id_liste,id_auteur) VALUES (:id_auteur,:id_auteur)";
// Récupérer le maximum actuel de la colonne id_auteur
$maxIdQuery = "SELECT MAX(id_auteur) AS max_id FROM auteur";
$result = $this->conn->query($maxIdQuery);
$maxId = $result->fetch(PDO::FETCH_ASSOC)['max_id'];

// Ajouter 1 pour obtenir le nouvel ID
$nouvelId = $maxId + 1;

// Utiliser le nouvel ID pour l'insertion
$stmt = $this->conn->prepare($query);
$stmt->bindParam(':id_auteur', $nouvelId);
$stmt->bindParam(':nom_auteur', $nouveau_nom_auteur);
$stmt->bindParam(':prenom_auteur', $nouveau_prenom_auteur);

$stmt2 = $this->conn->prepare($query2);
$stmt2->bindParam(':id_auteur', $nouvelId);

// Exécuter la requête
$stmt->execute();
$stmt2->execute();
	}




		function AQuiAppartientLaListe($id_auteur){
		    $this->connectionBdd();

		    $query = "SELECT id_auteur,nom_auteur,prenom_auteur FROM auteur WHERE id_auteur = :id_auteur";

		    // Utiliser le nouvel ID pour l'insertion
		    $stmt = $this->conn->prepare($query);
		    $stmt->bindParam(':id_auteur', $id_auteur);

		    // Exécuter la requête
		    $stmt->execute();

		    // Récupérer les résultats
		    $result = $stmt->fetch(PDO::FETCH_ASSOC);

		    // Vérifier s'il y a des résultats
		    if ($result) {
		        $look = new Auteur();
		        $look->id_auteur = $result['id_auteur'];
		        $look->nom_auteur = $result['nom_auteur'];
		        $look->prenom_auteur = $result['prenom_auteur'];

		        return $look;
		    } else {

		        // Gérer le cas où aucun résultat n'est trouvé
		        return null;
		    }
		}





}

?>
