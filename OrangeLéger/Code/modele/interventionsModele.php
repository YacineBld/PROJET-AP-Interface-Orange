<?php

    class interventionsModele extends BDD
    {
        private $produit;

        public function __construct() 
        {
            parent :: __construct();
        }

        public function createInterventions($dateInter, $duree, $statut, $description, $idMateriel)
        {
            $requete = "CALL insererIntervention (:dateInter, :duree, :statut, :description, :idMateriel);";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":dateInter", $dateInter);
            $select->bindParam(":duree", $duree);
            $select->bindParam(":statut", $statut);
            $select->bindParam(":description", $description);
            $select->bindParam(":idMateriel", $idMateriel);

            $select->execute();
        }

        public function updateInterventions($dateInter, $duree, $statut, $description, $idMateriel, $idIntervention)
        {
            $requete = "UPDATE intervention SET date_inter = :dateInter, duree = :duree, statut = :statut, description = :description, idMateriel = :idMateriel WHERE idIntervention = :idIntervention;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":dateInter", $dateInter);
            $select->bindParam(":duree", $duree);
            $select->bindParam(":statut", $statut);
            $select->bindParam(":description", $description);
            $select->bindParam(":idMateriel", $idMateriel);
            $select->bindParam(":idIntervention", $idIntervention);

            $select->execute();
        }

        public function deleteIntervention($idIntervention)
        {
            $requete = "DELETE FROM intervention WHERE idIntervention = :idIntervention;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idIntervention", $idIntervention);

            $select->execute();
        }

        public function selectClientIntervention($idUser)
        {
            $requete = "SELECT i.idIntervention, i.date_inter, i.duree, i.statut, i.description, i.idMateriel
                         FROM intervention AS i, materiel AS m WHERE i.idMateriel = m.idMateriel AND m.idUser = :idUser;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idUser", $idUser);
            
            $select->execute();
            return $select->fetchALl();
        }
        
        public function selectTechnicienIntervention($idUser)
        {
            $requete = "SELECT * FROM intervention WHERE idTechnicien = :idUser;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idUser", $idUser);

            $select->execute();
            return $select->fetchALl();
        }

        public function searchIntervention($mot)
        {
            $requete = "SELECT * FROM intervention WHERE date_inter LIKE :mot OR duree LIKE :mot OR statut LIKE :mot OR description LIKE :mot;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":mot", $mot);

            $select->execute();
            return $select->fetchAll();
        }

        public function selectWhereIntervention($idIntervention)
        {
            $requete = "SELECT * FROM intervention WHERE idIntervention = :idIntervention ;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idIntervention", $idIntervention);

            $select->execute();
            return $select->fetch();
        }


        public function selectClientMaterials($idClient)
        {
            $requete = "SELECT idMateriel from materiel WHERE idUser = :idClient";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idClient", $idClient);

            $select->execute();
            return $select->fetchAll();
        }
    }

?>