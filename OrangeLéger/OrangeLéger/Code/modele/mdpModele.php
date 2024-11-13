<?php
require_once("../sql/bdd.php");
class mdpModele extends BDD
    {
        private $mdp;

        public function __construct() 
        {
            parent :: __construct();
        }

        public function verifyUser($email)
        {
            $requete = "SELECT * FROM users WHERE email = :email";
            $select = $this->bdd->prepare($requete);
            $select->bindParam(":email", $email);
            $select->execute();
            return $select->fetch();
        }
        
    }