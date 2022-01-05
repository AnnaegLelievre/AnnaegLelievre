<?php
require_once "Constantes.php";
require_once "metier/Adresse.php";

/**
 * 
 *Classe permettant d'acceder en bdd pour inserer supprimer modifier
 * selectionner l'objet Adresse
 * @author pascal Lamy
 *
 */
class AdresseDB
{
	private $db; // Instance de PDO

	public function __construct($db)
	{
		$this->db = $db;;
	}
	/**
	 * 
	 * fonction d'Insertion de l'objet Adresse en base de donnee
	 * @param Adresse $p
	 */
	public function ajout(Adresse $p)
	{
		//TODO insertion de l'adresse en bdd
		$sql = $this->db->prepare('INSERT INTO personne(id,numero,rue,codepostal,ville, id_pers) values(:id,:numero,:rue,:codePostal,:ville,:id_pers');

		$sql->bindValue(':id', $p->getId());
		$sql->bindValue(':numero', $p->GetNumero());
		$sql->bindValue(':rue', $p->getRue());
		$sql->bindValue(':codePostal', $p->getCodePostal());
		$sql->bindValue(':ville', $p->getVille());
		$sql->bindValue(':id_pers', $p->getIdPers());
		$sql->execute();
		$sql->closeCursor();
		$sql = NULL;
	}
	/**
	 * 
	 * fonction de Suppression de l'objet Adresse
	 * @param Adresse $p
	 */
	public function suppression(Adresse $p)
	{
		//TODO suppression de l'adresse en bdd
		$sql = $this->db->prepare('delete from personne where id=:id');

		$sql->bindValue(':id', $p->getId(), PDO::PARAM_INT);
		$sql->execute();
		$sql->closeCursor();
		$sql = NULL;
	}
	/** 
	 * Fonction de modification d'une adresse
	 * @param Adresse $p
	 * @throws Exception
	 */
	public function update(Adresse $p)
	{
		try {
			//TODO mise a jour de l'adresse en bdd
			$sql = $this->db->prepare('UPDATE personne set numero=:numero,rue=:rue,codepostal=:codePostal,ville=:ville,id_pers=:id_pers where id=:id');
			$sql->bindValue(':id', $p->getId());
			$sql->bindValue(':numero', $p->GetNumero());
			$sql->bindValue(':rue', $p->getRue());
			$sql->bindValue(':codePostal', $p->getCodePostal());
			$sql->bindValue(':ville', $p->getVille());
			$sql->bindValue(':id_pers', $p->getIdPers());
			$sql->execute();
			$sql->closeCursor();
			$sql = NULL;

		} catch (Exception $e) {
			//TODO definir constante de l'exception
			throw new Exception(Constantes::EXCEPTION_DB_ADRESSE);
		}
	}
	/**
	 * 
	 * Fonction qui retourne toutes les adresses
	 * @throws Exception
	 */
	public function selectAll()
	{
		//TODO selection de l'adresse
		$query = 'SELECT id,numero,rue,codepostal,ville,id_pers';
		$q = $this->db->prepare($query);
		$q->execute();

		$result = $q->fetchAll(PDO::FETCH_CLASS);

		//TODO definir constante de l'exception
		if (empty($result)) {
			throw new Exception(Constantes::EXCEPTION_DB_ADRESSE);
		}

		$q->closeCursor();
		$q = NULL;
		return $result;
	}
	/**
	 * 
	 * Fonction qui retourne l'adresse en fonction de son id
	 * @throws Exception
	 * @param $id
	 */
	public function selectAdresse($id)
	{
		//TODO selection de l'adresse en fonction de son id
		$query = 'SELECT id,numero,rue,codepostal,ville,id_pers FROM   WHERE id= :id ';
		$q = $this->db->prepare($query);


		$q->bindValue(':id', $id);

		$q->execute();

		$result = $q->fetch(PDO::FETCH_ASSOC);

		//TODO definir constante de l'exception
		if (empty($result)) {
			throw new Exception(Constantes::EXCEPTION_DB_ADRESSE);
		}
		return $result;
	}
	/**
	 * 
	 * Fonction qui convertie un PDO Adresse en objet Adresse
	 * @param $pdoAdres
	 * @throws Exception
	 */
	public function convertPdoAdr($pdoAdres)
	{
		//TODO conversion du PDO ADRESSE en objet adresse
		if (empty($pdoAdres)) {
			throw new Exception(Constantes::EXCEPTION_DB_CONVERT_ADR);
		}
		//conversion du pdo en objet
		$obj = (object)$pdoAdres;
		//print_r($obj);
		//conversion de l'objet en objet adresse
		$adr = new Adresse($obj->id, $obj->numero, $obj->rue, $obj->codePostal, $obj->ville, $obj->id_pers);
		//affectation de l'id adr
		$adr->setId($obj->id);
		return $adr;
	}
}
