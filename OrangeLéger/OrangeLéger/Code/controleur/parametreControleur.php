<?php
require_once("modele/parametreModele.php");




    $parametreControleur = new parametreControleur();
    $formParametres = $parametreControleur->searchUser($_SESSION['idUser']);


    if (isset($_POST["modifyUser"])) 
    {
        $parametreControleur->updateUser($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['telephone'], $_POST['email'], $_POST['idUser']);
        echo '<script>window.location.href="index.php?page=3"</script>';
    }

    if (isset($_POST['supressUser']))
    {
        $parametreControleur->deleteUser($_POST['idUser']);
        echo '<script>window.location.href="index.php?page=3"</script>';
    }

    if (isset($_POST['changeMdp']))
    {
        $parametreControleur->changeMdp($_POST['mdp'], $_POST['idUser']);
    }




    class parametreControleur
    {
        private $parametreModele;

        public function __construct()
        {
            $this->parametreModele = new parametreModele();
        }

        public function updateUser($nom, $prenom, $adresse, $telephone, $email, $idUser)
        {
            $this->parametreModele->updateUser($nom, $prenom, $adresse, $telephone, $email, $idUser);
        }


        public function searchUser($idUser)
        {
            $result = $this->parametreModele->searchUser($idUser);

            return $result;
        }

        public function deleteUser($idUser)
        {
            $this->parametreModele->deleteUser($idUser);
        }

        public function changeMdp($mdp, $idUser)
        {
            $this->parametreModele->changeMdp($mdp, $idUser);
        }

    }

?>