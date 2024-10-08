<?php
    //test comm

    class BDD
    {

        protected $bdd;

        public function __construct()
        {
            try
            {
                $this->bdd = new PDO("mysql:host=localhost;dbname=orange","root","");
            }

            catch(PDOException $exp){
                echo "Erreur Connexion : ".$exp->getMessage();
            }
        }


        protected function getHashKey()
        {
            $requete = "SELECT cle FROM hashing;";
            $select = $this->bdd->prepare($requete);
            $select->execute();
            return $select->fetch();
        }

    }

?>