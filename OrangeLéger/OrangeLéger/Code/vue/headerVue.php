<?php
    require_once("controleur/inscriptionControleur.php");
    require_once("controleur/loginControleur.php");
?>


<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
    myInput.focus()
    })
</script>


    
<nav class="navbar navbar-expand-xl py-3 navbar-dark bg-dark">

    <!-- blank a -->
    <a class="navbar-brand"></a>

    <ul class="navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand" href="index.php"> <img src="images/logo.png" alt="logo Orange" width="50" height="50"> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?page=0">Accueil</span></a>
            </li>

            <?php
                if ( isset($_SESSION['email']) )
                {
                    echo'

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=1">Produits</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=2">Interventions</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=3">Paramètres</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=4">Se déconnecter </a>
                    </li>
                    ';
                }else
                {
                    echo'
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#login" onclick="$("#login").modal({"backdrop": "static"});">Se connecter</a>
                        </li>
                ';
                }
            ?>
        </ul>





                <!-- Modal loging in-->
        <form method="post">
            <div class="modal fade" id="login" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">


                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Se connecter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email</label>
                    </div>

                    <div class="form-floating">
                        <input type="password" name="mdp" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Mot de passe</label>

                        <a href="vue/mdp_perdu_form.php">Mot de passe perdu ?</a> <!-- Lien vers la page de récupération de mot de passe -->
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-target="#inscription" data-bs-toggle="modal">S'inscrire</button>
                    <button type="submit" class="btn btn-primary" name="Connection" value="Connection" >Se connecter</button>
                </div>


                </div>
            </div>
            </div>
        </form>



                <!-- Modal inscription-->
        <form method="post">

            <div class="modal fade" id="inscription" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">


                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">S'inscrire</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" name="nom" class="form-control" id="floatingInput" placeholder="Nom">
                            <label for="floatingInput">Nom</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="prenom" class="form-control" id="floatingInput" placeholder="Prenom">
                            <label for="floatingInput">Prenom</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="adresse" class="form-control" id="floatingInput" placeholder="Adresse">
                            <label for="floatingInput">Adresse</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="telephone" class="form-control" id="floatingInput" placeholder="Telephone">
                            <label for="floatingInput">Telephone</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" name="mdp" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Mot de passe</label>
                        </div>

                        <div class="form-floating">
                            
                        <div class="form-group">
                            <label for="role">Choisissez un rôle:</label><br>
                            <input type="radio" name="role" value="technicien"> Technicien<br>
                            <input type="radio" name="role" value="client"> Client
                        </div>

                        </div>




                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-target="#login" data-bs-toggle="modal">Se Connecter</button>
                    <button type="submit" class="btn btn-primary" name="Inscription" value="Inscription" >S'inscrire</button>
                </div>


                </div>
            </div>
            </div>
  
            </form>
</nav>