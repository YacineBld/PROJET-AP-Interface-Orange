<?php
require_once("modele/produitModele.php");




    $produitControleur = new produitControleur();
    $formMateriel = null;



    //afficher la liste des matériaux en fonction du filtre ou non

    if(isset($_POST["filtrerMateriel"]) && $_POST['filtre'] != "") 
    {
        $lesMateriaux = $produitControleur->searchMateriel($_POST['filtre']);
    }else if($_SESSION['userType'] == "client")
    {
        $lesMateriaux = $produitControleur->selectClientMaterial($_SESSION['idUser']);
    }else if (($_SESSION['userType'] == "technicien"))
    {
        $lesMateriaux = $produitControleur->selectTechnicienMaterial($_SESSION["idUser"]);
    }

    //gérer les modification et les suppressions
    if(isset($_GET['action']) && isset ($_GET['idMateriel']))
    {
        $action = $_GET['action'];
        $idMateriel = $_GET['idMateriel'];
        switch ($action){
            case "supprimer" : $produitControleur->deleteMateriel($idMateriel); echo '<script>window.location.href="index.php?page=1"</script>'; break;
            case "modifier" : $formMateriel = $produitControleur->selectWhereMateriel($idMateriel); break;
        } 
    }




    // créer un matériel suite au formulaire 

    if (isset($_POST["createMateriel"])) 
    {
        $produitControleur->createMateriel($_POST['designation'], $_POST['marque'], $_POST['modele'], $_POST['prixachat'], $_POST['iduser']);
        echo '<script>window.location.href="index.php?page=1"</script>';
    }

    if (isset($_POST['modifyMateriel']))
    {
        $produitControleur->updateMateriel($_POST['designation'], $_POST['marque'], $_POST['modele'], $_POST['prixachat'], $idMateriel);
        echo '<script>window.location.href="index.php?page=1"</script>';
    }







    class produitControleur
    {
        private $produitModele;

        public function __construct()
        {
            $this->produitModele = new ProduitModele();
        }

        public function createMateriel($designation, $marque, $modele, $prixachat, $iduser)
        {
            $this->produitModele->createMateriel($designation, $marque, $modele, $prixachat, $iduser);
        }

        public function updateMateriel( $designation, $marque, $modele, $prixachat, $idMateriel)
        {
            $this->produitModele->updateMateriel( $designation,  $marque, $modele, $prixachat, $idMateriel);
        }

        public function selectClientMaterial($iduser)
        {
            return $this->produitModele->selectClientMaterial($iduser);
        }

        public function selectTechnicienMaterial($idUser)
        {
            return $this->produitModele->selectTechnicienMaterial($idUser);
        }


        public function searchMateriel($mot)
        {
            return $this->produitModele->searchMateriel($mot);
        }


        public function deleteMateriel($idMateriel)
        {
            $this->produitModele->deleteMateriel($idMateriel);
        }

        public function selectWhereMateriel($idMateriel)
        {
            return $this->produitModele->selectwhereMateriel($idMateriel);
        }

    }

?>