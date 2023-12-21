<?php
include('..\DO\DO_listes.php');
use ListesDAO as ListesDAO;
use Listes as Listes;

class ListesDAO {

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
	function recupererListes() : array {

		$this->connectionBdd();
		$res = $this->conn->query("SELECT id_liste, id_auteur FROM listes");


		$i = 0;

		foreach ($res as $row) {
			$util = new Listes;
			$util->id_liste = $row['id_liste'];
			$util->auteur = $row['id_auteur'];
			$listes[$i] = $util;

			$i++;
		}

		return $listes;
	}
}

?>
