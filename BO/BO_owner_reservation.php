<?php


//include('DO\DO_owner_reservation.php');
include('..\DAO\DAO_owner_reservation.php');
include('..\DTO\DTO_owner_reservation.php');

	use ownerReservation as ownerReservation;
	use ownerReservationDAO as ownerReservationDAO;
	use ownerReservationDTO as ownerReservationDTO;


class ownerReservationBO {
	public $conn;
	 public $dao;

	 // Modifiez le constructeur pour initialiser la propriété $dao
		public function __construct() {
				$this->dao = new infoCadeauxDAO(); // Initialisez la propriété dans le constructeur
		}

	// Service de récupératino de la liste des utilisateurs
	function recupererListeownerreservation() {

		/// Appel au DAO correspondant
		$dao = new ownerReservationDAO();
		$listeDo = $dao->recupererListeownerreservation();

		// Conversion de la liste des DO récupérés en DTO
		$i = 0;
		foreach ($listeDo as $do) {
			$dto = new ownerReservationDTO;
			$dto->id_owner = $do->id_owner;
			$dto->nom_owner = $do->nom_owner;
			$dto->prenom_owner = $do->prenom_owner;




			$ownerReservationDTO[$i] = $dto;






			$i++;
		}

		return $ownerReservationDTO;
	}





function ajouterNouvelOwner($nom_owner,$prenom_owner) {

	$dao = new ownerReservationDAO();

						// Utilisez l'instance du DAO pour ajouter l'auteur
						$result = $dao->ajouterNouvelOwner($nom_owner,$prenom_owner);

						$dao = new ownerReservationDAO();
						$listeDo = $dao->recupererListeownerreservation();

						// Conversion de la liste des DO récupérés en DTO
						$i = 0;
						foreach ($listeDo as $do) {
							$dto = new ownerReservationDTO;
							$dto->id_owner = $do->id_owner;
							$dto->nom_owner = $do->nom_owner;
							$dto->prenom_owner = $do->prenom_owner;




							$ownerReservationDTO1[$i] = $dto;






							$i++;
						}

						return $ownerReservationDTO1;

		}

function QuiAReserver($id_owner){
	$dao = new ownerReservationDAO();


						$listeDo = $dao->QuiAReserver($id_owner);
						$ReservaurDTO = array();

								$ReservaurDTO = new ownerReservationDTO;
								$ReservaurDTO->id_owner = $listeDo->id_owner;
								$ReservaurDTO->nom_owner = $listeDo->nom_owner;
								$ReservaurDTO->prenom_owner = $listeDo->prenom_owner;

									return $ReservaurDTO;




}

}

?>
