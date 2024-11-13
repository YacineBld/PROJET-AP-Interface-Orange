<?php

    class produitModele extends BDD
    {
        private $produit;

        public function __construct() 
        {
            parent :: __construct();
        }

        public function createMateriel($designation, $marque, $modele, $prixachat, $iduser)
        {
            $requete = "INSERT INTO materiel VALUES (null, :designation, :marque, :modele, :prixachat, NOW(), :iduser);";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":designation", $designation);
            $select->bindParam(":marque", $marque);
            $select->bindParam(":modele", $modele);
            $select->bindParam(":prixachat", $prixachat);
            $select->bindParam(":iduser", $iduser);

            $select->execute();
        }

        public function updateMateriel($designation, $marque, $modele, $prixachat, $idMateriel)
        {
            $requete = "UPDATE materiel SET designation = :designation, marque = :marque, modele = :modele, prixachat = :prixachat WHERE idMateriel = :idMateriel;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":designation", $designation);
            $select->bindParam(":marque", $marque);
            $select->bindParam(":modele", $modele);
            $select->bindParam(":prixachat", $prixachat);
            $select->bindParam(":idMateriel", $idMateriel);

            $select->execute();
        }

        public function deleteMateriel($idMateriel)
        {
            $requete = "DELETE FROM materiel WHERE idMateriel = :idMateriel;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idMateriel", $idMateriel);

            $select->execute();
        }


        public function selectClientMaterial($idUser)
        {
            $requete = "SELECT * FROM materiel WHERE idUser = :idUser;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idUser", $idUser);

            $select->execute();
            return $select->fetchALl();
        }

        public function selectTechnicienMaterial($idUser)
        {
            $requete = "SELECT m.idMateriel, m.designation, m.marque, m.modele, m.prixachat, m.date_achat, m.idUser FROM materiel AS m, intervention AS i
                            Where m.idMateriel = i.idMateriel AND i.idTechnicien = :idUser;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idUser", $idUser);

            $select->execute();
            return $select->fetchALl();
        }


        public function searchMateriel($mot)
        {
            $requete = "SELECT * FROM materiel WHERE designation LIKE :mot OR marque LIKE :mot OR modele LIKE :mot OR date_achat LIKE :mot;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":mot", $mot);

            $select->execute();
            return $select->fetchAll();
        }

        public function selectWhereMateriel($idMateriel)
        {
            $requete = "SELECT * FROM materiel WHERE idMateriel = :idMateriel ;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idMateriel", $idMateriel);

            $select->execute();
            return $select->fetch();
        }
    }

?>