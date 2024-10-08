<br>
<h2 class = "text-center">Accueil</h2>
<br>

<?php
    if (isset($_SESSION['email']))
    {
        echo '<p>Vous êtes connectés en tant que '.$_SESSION['userType'].'</p>';
    }
?>