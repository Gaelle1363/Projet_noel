<?php


  //include('DO\DO_info_cadeaux.php');
  include('..\DAO\DAO_listes.php');
  include('..\DTO\DTO_listes.php');

	use Listes as Listes;
	use ListesDAO as ListesDAO;
	use ListesDTO as ListesDTO;


class ListesBO {

	// Service de récupératino de la liste des utilisateurs
	function recupererListes() {

		/// Appel au DAO correspondant
		$dao = new ListesDAO;
		$listeDo = $dao->recupererListes();

		// Conversion de la liste des DO récupérés en DTO
		$i = 0;
		foreach ($listeDo as $do) {
			$dto = new ListesDTO;
			$dto->id_liste = $do->id_liste;
			$dto->auteur = $do->auteur;
			$ListesDTO[$i] = $dto;
			$i++;
		}

		return $ListesDTO;
	}
}

?>
