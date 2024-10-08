<?php

    class loginModele extends BDD
    {
        private $login;
        private $hash;

        public function __construct()
        {
            parent :: __construct();
            $this->hash = parent :: getHashKey();
        }


        public function verifConnexion($email, $mdp)
        {
            $requete = "SELECT * FROM users AS u WHERE (u.email = :email AND u.mdp = :mdp) ;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":email", $email);
            $select->bindParam(":mdp", $mdp);

            $select->execute();
            return $select->fetch();
        }


        public function searchClient($id)
        {
            $requete = "SELECT * FROM client, users WHERE client.idClient = :id AND users.idUser = :id ;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":id", $id);

            $select->execute();
            return $select->fetch();
        }

        public function searchTechnicien($id)
        {
            $requete = "SELECT * FROM technicien, users WHERE technicien.idTechnicien = :id AND users.idUser = :id ;";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":id", $id);


            $select->execute();
            return $select->fetch();
        }



        //getters and setters

        public function getHash()
        {
            return $this->hash;
        }
    }


?>