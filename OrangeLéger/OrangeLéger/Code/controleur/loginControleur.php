<?php
	include('modele/loginModele.php');

	function showModal()
    {
        ?>
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('#login').modal('show');
                });
            </script>
        <?php
    }




	$message = "";

    if (isset($_POST['Connection']))
    {
        $loginControleur = new loginControleur();
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        $unUser = $loginControleur->verifConnexion($email, $mdp);

        if ($unUser == null)
        {
            $message = "mauvais email ou mot de passe" ;
        }
        else
        {
            $message = "vous êtes bien connecté";
            $_SESSION['email'] = $unUser['email'];
            $_SESSION['nom'] = $unUser['nom'];
            $_SESSION['prenom'] = $unUser['prenom'];
            $_SESSION['idUser'] = $unUser['idUser'];

            if (isset($unUser['idClient']))
            {
                $_SESSION['userType'] = "client";
            }else if (isset($unUser["idTechnicien"]))
            {
                $_SESSION["userType"] = "technicien";
            }
        }
    }
	
    echo $message;










    class loginControleur
    {
        private $loginModele;

        public function __construct()
        {
            $this->loginModele = new loginModele();
        }


        public function verifConnexion($email, $mdp)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
			{

				$lg = strlen($mdp);
				$uppercase = preg_match('@[A-Z]@', $mdp);
				$lowercase = preg_match('@[a-z]@', $mdp);
				$number = preg_match('@[0-9]@', $mdp);
				$specialChar = preg_match('@[\w]@', $mdp);

				if ($lg >= 1)
				{
					$hashKey = $this->loginModele->getHash();
					$mdp = sha1($mdp.$hashKey['cle']);

					
					//appel au modele pour test les users

					$unUser = $this->loginModele->verifConnexion($email, $mdp);


					
					if ($unUser != null)
					{
						if ($mdp == $unUser['mdp'])
						{

                            $unClient = $this->loginModele->searchClient($unUser['idUser']);
                            $unTechnicien = $this->loginModele->searchTechnicien($unUser['idUser']);

                            if ($unClient != null)
                            {
                                return $unClient;
                            }else if($unTechnicien != null)
                            {
                                return $unTechnicien;
                            }

						}else
						{
							return null;
						}
					}else
					{
						return null;
					}

				}else
				{
					return null;
				}
			}else
			{
				return null;
			}
        }
    }



?>