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
        // modifiez la requête sql
        $sql = 'SELECT id, nom, prenom FROM membres';
        $lesLignes = PdoBridge::$monPdo->query($sql);
        return $lesLignes->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getMaxId()
    {
        // modifiez la requête sql
        $req = "SELECT max(id) AS id FROM membres";
        $res = PdoBridge::$monPdo->query($req);
        $leID = $res->fetch();
        return 1 + $leID["id"];
    }

    public function insertMembre($nom, $prenom)
    {
        // modifiez la requête sql
        $id = $this->getMaxId();
        // modifiez la requête sql
        $sql = "INSERT INTO membres(id,nom,prenom) Values($id,'$nom', '$prenom')";
        $req = PdoBridge::$monPdo->exec($sql);
    }
    function modif_membres($nom, $prenom) 
{
	
	$nb_lignes=0; 
	
	
	$requete= "ALTER TABLE membres (nom,prenom) VALUES ('$nom','$prenom');";
	
	$reponse_serveur=mysqli_query($lien_base, "$requete");
	if($reponse_serveur==false) 
	{	
		$message_erreur="Impossible d'executer la requete: $requete " . mysqli_error($lien_base);
		echo $message_erreur;
		die();
		header("Location:404.php?erreur=$message_erreur"); 
		exit(); 
	}
	else 
	{
		$nb_lignes=mysqli_affected_rows($lien_base); 

	}
	return $nb_lignes ;
 }
}