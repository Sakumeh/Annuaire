<?php

class PdoBridge
{
    private static string $serveur = 'mysql:host=localhost';
    private static string $bdd = 'dbname=annuaire';
    private static string $user = 'root';
    private static string $mdp = '';
    private static $monPdoBridge = null;
    /**
     * @var PDO   <--- need by PhpStorm to find Methods of PDO
     */
    private static PDO $monPdo;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
        PdoBridge::$monPdo = new PDO(PdoBridge::$serveur . ';' . PdoBridge::$bdd, PdoBridge::$user, PdoBridge::$mdp);
        PdoBridge::$monPdo->query("SET CHARACTER SET utf8");
    }

    public function _destruct()
    {
        PdoBridge::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     *
     * Appel : $instancePdolafleur = PdoBridge::getPdoBridge();
     * @return l'unique objet de la classe PdoBridge
     */
    public static function getPdoBridge()
    {
        if (PdoBridge::$monPdoBridge == null) {
            PdoBridge::$monPdoBridge = new PdoBridge();
        }
        return PdoBridge::$monPdoBridge;
    }

    public function getLesMembres()
    {
    
        $sql = 'SELECT id, nom, prenom FROM membres';
        $lesLignes = PdoBridge::$monPdo->query($sql);
        return $lesLignes->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getLeMembre($id)
    {
        
        $sql = 'SELECT id, nom, prenom FROM membres WHERE id = :id';
        $laLigne = PdoBridge::$monPdo->prepare($sql);
        $laLigne->bindParam(':id', $id);
        $laLigne->execute();
        return $laLigne->fetch(PDO::FETCH_ASSOC);
    }

    public function getMaxId()
    {
        
        $req = "SELECT max(id) AS id FROM membres";
        $res = PdoBridge::$monPdo->query($req);
        $leID = $res->fetch();
        return 1 + $leID["id"];
    }

    public function insertMembre($nom, $prenom)
    {
        
        //$id = $this->getMaxId();
        //$sql = "INSERT INTO membres(id,nom,prenom) Values($id,'$nom', '$prenom')";
        //$req = PdoBridge::$monPdo->exec($sql);

        $id = $this->getMaxId();
        $sql = "INSERT INTO membres(id,nom,prenom) Values(:id, :nom, :prenom)";
        $req = PdoBridge::$monPdo->prepare($sql);
        $req->bindParam(':id', $id);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->execute();
    }
    public function DeleteMembre($id)
    {
        $sql = "DELETE FROM membres WHERE id = '$id'";
        $req = PdoBridge::$monPdo->exec($sql);
    }

    function modifMembre($id, $nom, $prenom) 
    {
	$requete= "UPDATE membres SET nom = :nom, prenom = :prenom WHERE id = :id;";
	$req = PdoBridge::$monPdo->prepare($requete);
        $req->bindParam(':id', $id);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->execute();
	if($req==false)
	{	
		$message="Impossible d'executer la requete:". $requete ;
		die();
		header("Location:views/v_accueil.php?erreur=$message"); 
		exit(); 
	}
	else 
	{
		$req->fetch(PDO::FETCH_ASSOC); 
	}
	return $req; 
    }
}