<?php
require_once("controleur/parametreControleur.php")

?>

<br>
<h2 class="text-center">Paramètres</h2>
<br>



        <!--  Formulaire pour modifier les paramètres  -->

<form method="post">

    <div class="form-group">

        <div class="form-floating mb-3">
            <input type="text" name="nom" class="form-control" id="floatingInput" placeholder="Nom" value="<?= ($formParametres != null) ?  $formParametres['nom'] : '' ?>">
            <label for="floatingInput">Nom</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" name="prenom" class="form-control" id="floatingInput" placeholder="Prenom" value="<?= ($formParametres != null) ?  $formParametres['prenom'] : '' ?>">
            <label for="floatingInput">Prénom</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" name="adresse" class="form-control" id="floatingInput" placeholder="Adresse" value="<?= ($formParametres != null) ?  $formParametres['adresse'] : '' ?>">
            <label for="floatingInput">Adresse</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" name="telephone" class="form-control" id="floatingInput" placeholder="Telephone" value="<?= ($formParametres != null) ?  $formParametres['telephone'] : '' ?>">
            <label for="floatingInput">Téléphone</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" name="email" class="form-control" id="floatingInput" placeholder="Email" value="<?= ($formParametres != null) ?  $formParametres['email'] : '' ?>">
            <label for="floatingInput">Email</label>
        </div>

        
            <input type="hidden" name="idUser" value=<?php echo $_SESSION['idUser']; ?>>

            <button type="submit" class="btn btn-primary" name="modifyUser" value="modifyUser" >Modifier Paramètres</button>
            <button type="submit" class="btn btn-primary" name="supressUser" value="supressUser" >Supprimer Utilisateur</button>

    </div>

</form>

<br>
<br>


<!--
<form method="post">

    <div class="form-group">
        <div class="form-floating mb-3">
            <input type="text" name="mdp" class="form-control" id="floatingInput" placeholder="Mot de passe">
            <label for="floatingInput">Nouveau Mot de passe</label>
        </div>
        
            <input type="hidden" name="idUser" value=<?php echo $_SESSION['idUser']; ?>>

            <button type="submit" class="btn btn-primary" name="changeMdp" value="changeMdp" >Changer mot de passe</button>
    </div>

</form>
-->