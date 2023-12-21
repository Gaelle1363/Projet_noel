<?php


  //include('DO\DO_info_cadeaux.php');
  include('..\DAO\DAO_info_cadeaux.php');
  include('..\DTO\DTO_info_cadeaux.php');

	use infoCadeaux as infoCadeaux;
	use infoCadeauxDAO as infoCadeauxDAO;
	use infoCadeauxDTO as infoCadeauxDTO;


class infoCadeauxBO {
  public $conn;
   public $dao;

   // Modifiez le constructeur pour initialiser la propriété $dao
    public function __construct() {
        $this->dao = new infoCadeauxDAO(); // Initialisez la propriété dans le constructeur
    }
  // Service de récupération de la liste des utilisateurs par auteur
        function recupererListeinfocadeauxParAuteur($idAuteur) {
            // Appel au DAO correspondant
            $dao = new infoCadeauxDAO;
            $listeDo = $dao->recupererListeinfocadeauxParAuteur($idAuteur);
            $infoCadeauxDTO = array(); // Déclaration en dehors de la boucle

            // Conversion de la liste des DO récupérés en DTO
            $i = 0;
            foreach ($listeDo as $do) {
                $dto = new infoCadeauxDTO;
                $dto->id_cadeau = $do->id_cadeau;
                $dto->id_owner = $do->id_owner;
                $dto->id_liste = $do->id_liste;
                $dto->nom = $do->nom;
                $dto->resume = $do->resume;
                $dto->prix = $do->prix;
                $dto->image = $do->image;
                $dto->date_debut_reservation = $do->date_debut_reservation;
                $dto->date_fin_reservation = $do->date_fin_reservation;
                $dto->date_de_reservation = $do->date_de_reservation;
                $dto->etat_reservation = $do->etat_reservation;

                $infoCadeauxDTO[$i] = $dto;

                $i++;
            }

            return $infoCadeauxDTO;
        }


function supprimerListeinfocadeaux($idAuteur){
  $dao = new infoCadeauxDAO;
  $listeDo = $dao->supprimerListeinfocadeaux($idAuteur);
  $listeOut = array();

  // Conversion de la liste des DO récupérés en DTO
  $i = 0;
  foreach ($listeDo as $do) {
      $dto = new infoCadeauxDTO;
      $dto->id_cadeau = $do->id_cadeau;
      $dto->id_owner = $do->id_owner;
      $dto->id_liste = $do->id_liste;
      $dto->nom = $do->nom;
      $dto->resume = $do->resume;
      $dto->prix = $do->prix;
      $dto->image = $do->image;
      $dto->date_debut_reservation = $do->date_debut_reservation;
      $dto->date_fin_reservation = $do->date_fin_reservation;
      $dto->date_de_reservation = $do->date_de_reservation;
      $dto->etat_reservation = $do->etat_reservation;

      $listeOut[$i] = $dto;

      $i++;
  }
  return $listeOut;
}
function supprimerCadeau($idcadeau){
  $dao = new infoCadeauxDAO;
  $listeDo = $dao->supprimerCadeau($idcadeau);
  $listeOut2 = array();

  // Conversion de la liste des DO récupérés en DTO
  $i = 0;
  foreach ($listeDo as $do) {
      $dto = new infoCadeauxDTO;
      $dto->id_cadeau = $do->id_cadeau;
      $dto->id_owner = $do->id_owner;
      $dto->id_liste = $do->id_liste;
      $dto->nom = $do->nom;
      $dto->resume = $do->resume;
      $dto->prix = $do->prix;
      $dto->image = $do->image;
      $dto->date_debut_reservation = $do->date_debut_reservation;
      $dto->date_fin_reservation = $do->date_fin_reservation;
      $dto->date_de_reservation = $do->date_de_reservation;
      $dto->etat_reservation = $do->etat_reservation;

      $listeOut2[$i] = $dto;

      $i++;
  }
  return $listeOut2;
}

function ModifCadeau($cadeau_id,$cadeau_nom,$cadeau_resume,$cadeau_prix,$cadeau_img,$cadeau_ddr,$cadeau_dfr){
  $dao = new infoCadeauxDAO;
  $listeDo = $dao->ModifCadeau($cadeau_id,$cadeau_nom,$cadeau_resume,$cadeau_prix,$cadeau_img,$cadeau_ddr,$cadeau_dfr);
  $listeOut3 = array();

  // Conversion de la liste des DO récupérés en DTO
  $i = 0;
  foreach ($listeDo as $do) {
      $dto = new infoCadeauxDTO;
      $dto->id_cadeau = $do->id_cadeau;
      $dto->id_owner = $do->id_owner;
      $dto->id_liste = $do->id_liste;
      $dto->nom = $do->nom;
      $dto->resume = $do->resume;
      $dto->prix = $do->prix;
      $dto->image = $do->image;
      $dto->date_debut_reservation = $do->date_debut_reservation;
      $dto->date_fin_reservation = $do->date_fin_reservation;
      $dto->date_de_reservation = $do->date_de_reservation;
      $dto->etat_reservation = $do->etat_reservation;

      $listeOut3[$i] = $dto;

      $i++;
  }
  return $listeOut3;

}


function ajouterNouveauCadeau(infoCadeauxDTO $nouveauCadeauDTO) {

           $this->dao->connectionBdd(); // Utilisez $this->dao au lieu de $dao

           // Utilisez l'instance du DAO pour ajouter l'auteur
           $result = $this->dao->ajouterNouveauCadeau($nouveauCadeauDTO); // Utilisez $this->dao au lieu de $dao

           if ($result) {
               return true; // Ajout réussi
           } else {
               return "Erreur lors de l'ajout du nouveau cadeau ."; // Ajout échoué avec un message d'erreur
           }
       }

function ReserverCadeau($id_owner,$id_cadeau){

$dao = new infoCadeauxDAO;
  $result = $dao->ReserverCadeau($id_owner,$id_cadeau);

       }


}

?>
