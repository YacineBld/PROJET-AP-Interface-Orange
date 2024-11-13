<?php

if (isset($_SESSION['email']))
{
    require_once("controleur/produitControleur.php");
?>
    <br>
    <h2 class="text-center">Produits</h2>
    <br>

        <!--  Formulaire pour ajouter un matériel  -->

<?php
    if($_SESSION['userType'] == "client")
    {
?>

        <form method="post">

            <div class="form-group">

                <div class="input-group mb-3">
                    <select required class="custom-select" id="inputGroupSelect01" name = "designation">
                        <option selected><?= ($formMateriel != null) ?  $formMateriel['designation'] : 'Choose' ?> </option>
                        <option value="box wifi">Box Wifi</option>
                        <option value="ordinateur">Ordinateur</option>
                        <option value="telephone">Telephone</option>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input required type="text" name="marque" class="form-control" id="floatingInput" placeholder="Marque" required value=" <?= ($formMateriel != null) ? $formMateriel['marque'] : '' ?> ">
                    <label for="floatingInput">Marque</label>
                </div>

                <div class="form-floating mb-3">
                    <select required class="custom-select" id="inputGroupSelect01" name = "modele">
                            <option selected><?= ($formMateriel != null) ?  $formMateriel['modele'] : 'Choose' ?> </option>
                            <option value="nouveau">Nouveau</option>
                            <option value="ancien">Ancien</option>
                            <option value="reconditioné">Reconditioné</option>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input required type="text" name="prixachat" class="form-control" id="floatingInput" placeholder="Prix d'achat" required value=" <?= ($formMateriel != null) ? $formMateriel['prixachat'] : '' ?> ">
                    <label for="floatingInput">Prix d'achat</label>
                </div>

                    <input type="hidden" name="dateAchat" value="<?php date("d/m/y")  ?>">

                    <input type="hidden" name="iduser" value=<?php echo $_SESSION['idUser']; ?>>

                <?php
                    if($formMateriel != null)
                    {
                        echo '<button type="submit" class="btn btn-primary" name="modifyMateriel" value="modifyMateriel" >Modifier Matériel</button>';
                    }
                    else
                    {
                        echo '<button type="submit" class="btn btn-primary" name="createMateriel" value="createMateriel" >Créer Matériel</button>';
                    }
                ?>


            </div>

        </form>

        <br>
        <br>

<?php
    }
?>




<!--  Filtrer les matériaux -->


<!--    <form method="post">
        <div class="form-floating mb-3">
            <input type="text" name="filtre" class="form-control" id="floatingInput" placeholder="Filtrer">
            <label for="floatingInput">Filtrer</label>
        </div>

        <button type="submit" class="btn btn-primary" name="filtrerMateriel" value="filtrerMateriel" >Filtrer Matériel</button>

    </form>


    <br>
    <br>
-->



    <!-- Liste des matériels  -->

    <table class="table table-bordered ">

        <thead class="table-dark">
            <tr>
                <th scope="col">Identifiant Matériel</th>
                <th scope="col">Matériel</th>
                <th scope="col">Marque</th>
                <th scope="col">Modèle</th>
                <th scope="col">Prix Achat</th>
                <th scope="col">date Achat</th>
                <?php
                    if ($_SESSION['userType'] == "client")
                    {
                        echo '<th scope="col">Actions</th>';
                    }else if ($_SESSION['userType'] == "technicien")
                    {
                        echo '<th scope="col">idClient</th>';
                    }
                ?>
            </tr>
        </thead>

        <tbody>
            <?php

                if (isset($lesMateriaux)) 
                {
                    if ($_SESSION['userType'] == "client")
                    {
                        foreach ($lesMateriaux as $unMateriel)
                        {
                            echo
                            '
                                <tr>
                                    <th scope="row">'.$unMateriel['idMateriel'].'</th>
                                    <td>'.$unMateriel['designation'].'</td>
                                    <td>'.$unMateriel['marque'].'</td>
                                    <td>'.$unMateriel['modele'].'</td>
                                    <td>'.$unMateriel['prixachat'].'</td>
                                    <td>'.$unMateriel['date_achat'].'</td>
                                </tr>
                            ';
                            /*        <td> <a href="index.php?page=1&action=modifier&idMateriel='.$unMateriel['idMateriel'].'" > <img src="./Images/modifier.png" width="40" height="40"> </a>
                                            
                                            <a href="index.php?page=1&action=supprimer&idMateriel='.$unMateriel['idMateriel'].'" > <img src="./Images/supprimer.png" width="40" height="40"> </a></td>
                                </tr>
                            ';*/
                        }
                    }else if ($_SESSION['userType'] == "technicien")
                    {
                        foreach ($lesMateriaux as $unMateriel)
                        {
                            echo
                            '
                                <tr>
                                    <th scope="row">'.$unMateriel['idMateriel'].'</th>
                                    <td>'.$unMateriel['designation'].'</td>
                                    <td>'.$unMateriel['marque'].'</td>
                                    <td>'.$unMateriel['modele'].'</td>
                                    <td>'.$unMateriel['prixachat'].'</td>
                                    <td>'.$unMateriel['date_achat'].'</td>
                                    <td>'.$unMateriel['idUser'].'</td>
                                </tr>
                            ';
                        }
                    }
                    
                }
            ?>
        </tbody>
    </table>


<?php
}
else
{
    echo 'Veuillez vous connecter pour avoir accès à vos produits';
}

?>