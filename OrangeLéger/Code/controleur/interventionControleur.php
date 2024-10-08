<?php
require_once("modele/interventionsModele.php");




    $interventionControleur = new interventionControleur();
    $formIntervention = null;
    $lesMateriaux = null;


    //préparer la liste des materiaux
    $lesMateriaux = $interventionControleur->selectClientMaterials($_SESSION[('idUser')]);


    //afficher la liste des matériaux en fonction du filtre ou non

    if(isset($_POST["filtrerIntervention"]) && $_POST['filtre'] != "") 
    {
        $lesInterventions = $interventionControleur->searchIntervention($_POST['filtre']);
    }else if ($_SESSION['userType'] == "client")
    {
        $lesInterventions = $interventionControleur->selectClientIntervention($_SESSION['idUser']);
    }else if ($_SESSION['userType'] == 'technicien')
    {
        $lesInterventions = $interventionControleur->selectTechnicienIntervention($_SESSION['idUser']);
    }

    //gérer la modification et la supression d'interventions
    if(isset($_GET['action']) && isset ($_GET['idIntervention']))
    {
        $action = $_GET['action'];
        $idIntervention = $_GET['idIntervention'];
        switch ($action){
            case "supprimer" : $interventionControleur->deleteIntervention($idIntervention); echo '<script>window.location.href="index.php?page=2"</script>'; break;
            case "modifier" : $formIntervention = $interventionControleur->selectWhereIntervention($idIntervention); break;
        } 
    }




    // créer un matériel suite au formulaire 

    if (isset($_POST["createIntervention"])) 
    {
        var_dump($_POST);
        $interventionControleur->createInterventions($_POST['dateInter'], $_POST['duree'], $_POST['statut'], $_POST['description'], $_POST['idMateriel']);
        echo '<script>window.location.href="index.php?page=2"</script>';
    }

    if (isset($_POST['modifyIntervention']))
    {
        $interventionControleur->updateInterventions($_POST['dateInter'], $_POST['duree'], $_POST['statut'], $_POST['description'], $_POST['idMateriel'], $idIntervention);
        echo '<script>window.location.href="index.php?page=2"</script>';
    }







    class interventionControleur
    {
        private $interventionModele;

        public function __construct()
        {
            $this->interventionModele = new interventionsModele();
        }

        public function createInterventions($dateInter, $duree, $statut, $description, $idMateriel)
        {
            $this->interventionModele->createInterventions($dateInter, $duree, $statut, $description, $idMateriel);
        }

        public function updateInterventions($dateInter, $duree, $statut, $description, $idMateriel, $idIntervention)
        {
            $this->interventionModele->updateInterventions($dateInter, $duree, $statut, $description, $idMateriel, $idIntervention);
        }

        public function selectClientIntervention($idUser)
        {
            return $this->interventionModele->selectClientIntervention($idUser);
        }

        public function selectTechnicienIntervention($idUser)
        {
            return $this->interventionModele->selectTechnicienIntervention($idUser);
        }


        public function searchIntervention($mot)
        {
            return $this->interventionModele->searchIntervention($mot);
        }

        public function deleteIntervention($idIntervention)
        {
            //$this->interventionModele->removeForeignKeys($idIntervention);
            $this->interventionModele->deleteIntervention($idIntervention);
        }

        public function selectWhereIntervention($idIntervention)
        {
            return $this->interventionModele->selectWhereIntervention($idIntervention);
        }

        public function selectClientMaterials($idClient)
        {
            return $this->interventionModele->selectClientMaterials($idClient);
        }

    }

?>