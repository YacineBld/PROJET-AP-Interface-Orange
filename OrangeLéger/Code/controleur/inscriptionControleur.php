<?php
include ("modele/inscriptionModele.php");



$message = "";

    if (isset($_POST['Inscription']))
    {
        $message = "on est rentré";
        $inscriptionControleur = new inscriptionControleur();
        $tab = $_POST;

        $uneInscription = $inscriptionControleur->inscription($tab);

        if ($uneInscription === true)
        {
            $message = "le compte a bien été créer";
        }else
        {
            $message = $uneInscription;
        }
    }

    require_once("vue/headerVue.php");

    echo $message;






    



class inscriptionControleur
{
    private $inscriptionModele;

    public function __construct()
    {
        $this->inscriptionModele = new inscriptionModele();
    }


    public function inscription($tab)
    {
        if (filter_var($tab['email'], FILTER_VALIDATE_EMAIL))
        {
            $existingUser = $this->inscriptionModele->existingUser($tab['email']);
            
            if($existingUser == null)
            {
                $this->inscriptionModele->insertUser($tab);
                return true;
            }
            else
            {
                return "l'email est déja utilisé";
            }
        }else
        {
            return "l'email n'est pas valide";
        }
    }
}

?>