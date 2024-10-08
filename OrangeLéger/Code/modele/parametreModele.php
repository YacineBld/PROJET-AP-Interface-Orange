<?php

    class parametreModele extends BDD
    {

        private $hash;

        public function __construct() 
        {
            parent :: __construct();
            $this->hash = parent :: getHashKey();
        }

        public function updateUser($nom, $prenom, $adresse, $telephone, $email, $idUser)
        {
            $requete = "UPDATE users SET nom = :nom, prenom = :prenom, adresse = :adresse, telephone = :telephone, email = :email WHERE idUser = :idUser;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":nom", $nom);
            $select->bindParam(":prenom", $prenom);
            $select->bindParam(":adresse", $adresse);
            $select->bindParam(":telephone", $telephone);
            $select->bindParam(":email", $email);
            $select->bindParam(":idUser", $idUser);

            $select->execute();
        }

        public function deleteUser($idUser)
        {
            $requete = "DELETE FROM users WHERE idUser = :idUser";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idUser", $idUser);

            $select->execute();
        }

        public function searchUser($idUser)
        {
            $requete = "SELECT * FROM users WHERE idUser = :idUser ;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":idUser", $idUser);

            $select->execute();
            return $select->fetch();
        }


        public function changeMdp($mdp, $idUser)
        {
            $requete = "UPDATE users Set mdp = :mdp WHERE idUser = :idUser;";
            $select = $this->bdd->prepare($requete);
            $mdp = sha1($mdp.$this->hash['cle']);
            $select->bindParam(":mdp", $mdp);
            $select->bindParam(":idUser", $idUser);

            $select->execute();
        }
    }

?>