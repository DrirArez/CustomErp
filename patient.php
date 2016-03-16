<?php 
class Patient 
{
	public $id,
			$civilite,
			$nom,
			$prenom,
			$age,
			$date_naissance,
			$n_dossier;


	public function hydrate(array $donnees){

		foreach($donnees as $key => $value){
			$method = 'set'.ucfirst($key);
			if(method_exists($this,$method)){
			$this->$method($value);
			}
		}
	}
	//Les getters 
	public function id()
	{
		return $this->id;
	}

	public function civilite()
	{
		return $this->civilite;
	}

	public function nom()
	{
		return $this->nom;
	}
	public function prenom()
	{
		return $this->prenom;
	}
	public function age()
	{
		return $this->age;
	}

	public function date_naissance()
	{
		return $this->date_naissance;
	}
	public function n_dossier()
	{
		return $this->n_dossier;
	}

	//Les setters
	public function setId($id)
	{
		$id = (int) $id;
		if($id > 0)
		{
			$this->id = $id;
		}
	}

	public function setCivilite($civilite)
	{
		$this->civilite = $civilite;
	}

	public function setNom($nom)
	{
		if(is_string($nom))
		{
			$this->nom = $nom;
		}
	}

	public function setPrenom($prenom)
	{
		if(is_string($prenom))
		{
			$this->prenom = $prenom;
		}
	}

	public function setDateNaissance($date_naissance)
	{
		$this->date_naissance = $date_naissance;
	}

	public function setAge($age)
	{
		if(is_int($age))
		{
			$this->age = $age;
		}
	}

	public function setNdossier($n_dossier)
	{
		$this->n_dossier = $n_dossier;
	}

}

class PatientManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function add(Patient $malade){

		$q = $this->db->prepare('INSERT INTO patient SET civilite = :civilite,  nom = :nom, prenom= :prenom, age = :age, date_naissance = :date_naissance, n_dossier= :n_dossier');
		$q->bindValue(':civilite',$_POST['civilite']);
		$q->bindValue(':nom',$_POST['nom']);
		$q->bindValue(':prenom', $_POST['prenom']);
		$q->bindValue(':age', $_POST['age']);
		$q->bindValue(':date_naissance', $_POST['date_naissance']);
		$q->bindValue(':n_dossier', $_POST['n_dossier']);
		$q->execute();

		$malade->hydrate([
			'id' => $this->db->lastInsertId(),
			]);
	}

	public function get($info)
	{
		if(is_int($info)){
			$q= $this->db->query('SELECT id, nom, prenom,  age, date_naissance, n_dossier FROM patient WHERE id='.$info);
			$pat = $q->fetch(PDO::FETCH_ASSOC);
		}
		else{

			$q = $this->db->query('SELECT id, civilite, nom, prenom, date_naissance, age, n_dossier FROM patient WHERE nom = :nom');
			$q->execute([':nom' => $info]);

			$pat = $q->fetch(PDO::FETCH_ASSOC);
		}
	}

	public function getList($nom){

		$q = $this->db->prepare('SELECT id, nom, prenom, age, date_naissance, n_dossier FROM patient WHERE nom <> :nom ORDER BY nom');
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}


 ?>