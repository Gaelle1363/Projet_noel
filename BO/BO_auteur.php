<?php


  //include('DO/DO_auteur.php');
  include('..\DAO\DAO_auteur.php');
  include( '..\DTO\DTO_auteur.php');

	use Auteur as Auteur;
	use AuteurDAO as AuteurDAO;
	use AuteurDTO as AuteurDTO;


class AuteurBO {
  public $conn;
    public $dao;

    // Modifiez le constructeur pour initialiser la propriété $dao
    public function __construct() {
        $this->dao = new AuteurDAO(); // Initialisez la propriété dans le constructeur
    }
	// Service de récupératino de la liste des utilisateurs
	function recupererAuteur() {

		/// Appel au DAO correspondant
		$dao = new AuteurDAO();
		$listeDo = $dao->recupererAuteur();

		// Conversion de la liste des DO récupérés en DTO
		$i = 0;
		foreach ($listeDo as $do) {
			$dto = new AuteurDTO;
			$dto->id_auteur = $do->id_auteur;
			$dto->nom_auteur = $do->nom_auteur;
			$dto->prenom_auteur = $do->prenom_auteur;


			$AuteurDTO[$i] = $dto;


			$i++;
		}

		return $AuteurDTO;
	}


  function ajouterNouvelAuteur($nouveau_nom_auteur,$nouveau_prenom_auteur) {
    // Assurez-vous que la connexion est établie
              $this->dao->connectionBdd();

              // Utilisez l'instance du DAO pour ajouter l'auteur
              $result = $this->dao->ajouterNouvelAuteur($nouveau_nom_auteur,$nouveau_prenom_auteur);

              if ($result) {
                  return true; // Ajout réussi
              } else {
                  return "Erreur lors de l'ajout du nouvel auteur."; // Ajout échoué avec un message d'erreur
              }
      }


      function AQuiAppartientLaListe($id_auteur){
      	$dao = new AuteurDAO();


      						$listeDo = $dao->AQuiAppartientLaListe($id_auteur);
      						$LookDTO = array();

      								$LookDTO = new AuteurDTO;
      								$LookDTO->id_auteur = $listeDo->id_auteur;
      								$LookDTO->nom_auteur = $listeDo->nom_auteur;
      								$LookDTO->prenom_auteur = $listeDo->prenom_auteur;

      									return $LookDTO;


      }


}


?>
