<?php
switch ($action) {
    case 'accueil':
    {
        $message="Ce site permet d'enregistrer les participants à une épreuve.";
        include("views/v_accueil.php");
        break;
    }
    case 'lister': {
        $les_membres=$pdo->getLesMembres();
        require 'views/v_listemembres.php';
        break;
    }
    case 'saisir':
    {
        require "views/v_saisie.php";
        break;
    }

    case 'controlesaisie':
        {
            $nom = $_REQUEST['nom'];
            $prenom = $_REQUEST['prenom'];
    
            if (empty($nom) || empty($prenom)) {
                require "views/v_saisie.php";
            } else {
                $message = 'Membre enregistré';
                $resultat = $pdo->insertMembre($nom, $prenom);
                include("views/v_accueil.php");
            }
            break;
        }

    case 'supprimer': {
        $les_membres=$pdo->getLesMembres();
        require 'views/v_supprimermembres.php';
        break;
    }

    case 'valideSupp':{
        if(isset($_POST['courseName']) && !empty($_POST['courseName']))
        {
            $courseName = $_POST['courseName'];
            $pdo->DeleteMembre($courseName);
            $message = 'Membre supprimé';
            include("views/v_accueil.php");
        }
        break;
    }
    case 'modifier': {
        $le_membre=$pdo->getLeMembre($_GET['id']);
        require 'views/v_modif_membre.php';
        break;
    }

    case 'controlemodif':
        {
            $id = $_REQUEST['id'];
            $nom = $_REQUEST['nom'];
            $prenom = $_REQUEST['prenom'];
    
            if (empty($nom) || empty($prenom) || empty($id)) {
                require "views/v_modif_membre.php";
            } else {
                $message = 'Membre modifié';
                $resultat = $pdo->modifMembre($id, $nom, $prenom);
                include("views/v_accueil.php");
            }
            break;
        }

    default:
    {
        $_SESSION["message_erreur"] = "Site en construction";
        include("views/404.php");
        break;
    }


}
