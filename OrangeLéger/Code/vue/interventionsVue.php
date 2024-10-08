<?php

if (isset($_SESSION['email']))
{
    require_once("controleur/interventionControleur.php")

?>

    <br>
    <h2 class = "text-center">Interventions</h2>
    <br>



        <!--  Formulaire pour ajouter une intervention  -->

<?php
if(($_SESSION['userType'] == "technicien" && $formIntervention != null) || $_SESSION['userType'] == "client")
{
?>

        <form method="post">
            
            <div class="form-group">

                <div class="form-floating mb-3">
                    <input type="date" name="dateInter" class="form-control" id="floatingInput" placeholder="Date Intervention" 
                            value="<?= ($formIntervention != null) ?  $formIntervention['date_inter'] : ' ' ?>"
                            <?= ($_SESSION['userType'] == "technicien") ? 'readonly' : ' ' ?>>
                    <label for="floatingInput">Date Intervention</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="duree" class="form-control" id="floatingInput" placeholder="Duree" 
                            value="<?= ($formIntervention != null) ?  $formIntervention['duree'] : 'à remplir par le technicien' ?>"
                            <?= ($_SESSION['userType'] == "client") ? 'readonly' : '' ?>>
                    <label for="floatingInput">Duree</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="statut" class="form-control" id="floatingInput" placeholder="Statut" 
                            value="<?= ($formIntervention != null) ?  $formIntervention['statut'] : 'à remplir par le technicien' ?>"
                            <?= ($_SESSION['userType'] == "client") ? 'readonly' : '' ?>>

                    <label for="floatingInput">Statut</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="description" class="form-control" id="floatingInput" placeholder="Description" 
                            value="<?= ($formIntervention != null) ?  $formIntervention['description'] : ' ' ?>"
                            <?= ($_SESSION['userType'] == "technicien") ? 'readonly' : ' ' ?>>
                    <label for="floatingInput">Description</label>
                </div>

                <div class="input-group mb-3">
                    <select required class="custom-select" id="inputGroupSelect01" name = "idMateriel"
                            <?= ($_SESSION['userType'] == "technicien") ? 'readonly' : ' ' ?>>

                        <option selected><?= ($formIntervention != null) ?  $formIntervention['idMateriel'] : 'Choose' ?> </option>

                        <?php
                            if ($lesMateriaux != null)
                            {
                                foreach ($lesMateriaux as $unMateriel)
                                {
                                    echo '<option value="'.$unMateriel['idMateriel'].'">'.$unMateriel['idMateriel'].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>

                <input type="hidden" name="idtechnicien" value=<?php echo $_SESSION['idUser']; ?>>

                <?php

                if ($formIntervention != null)
                {
                    echo '<button type="submit" class="btn btn-primary" name="modifyIntervention" value="modifyIntervention" >Modifier Intervention</button>';
                }else
                {
                    echo '<button type="submit" class="btn btn-primary" name="createIntervention" value="createIntervention" >Créer Intervention</button>';
                }
                ?>

            </div>

        </form>

<?php
}
?>

<br>
<br>




<!--  Filtrer les matériaux -->

<!--
    <form method="post">
        <div class="form-floating mb-3">
            <input type="text" name="filtre" class="form-control" id="floatingInput" placeholder="Filtrer">
            <label for="floatingInput">Filtrer</label>
        </div>

        <button type="submit" class="btn btn-primary" name="filtrerIntervention" value="filtrerIntervention" >Filtrer Intervention</button>

    </form>
-->

<br>
<br>



    <!-- Liste des matériels  -->

    <table class="table table-bordered ">

        <thead class="table-dark">
            <tr>
                <th scope="col">Identifiant Intervention</th>
                <th scope="col">date Intervention</th>
                <th scope="col">duree</th>
                <th scope="col">statut</th>
                <th scope="col">Description</th>
                <th scope="col">id Materiel</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php

                if (isset($lesInterventions)) 
                {
                    foreach ($lesInterventions as $uneIntervention)
                    {
                        echo
                        '
                            <tr>
                                <th scope="row">'.$uneIntervention['idIntervention'].'</th>
                                <td>'.$uneIntervention['date_inter'].'</td>
                                <td>'.$uneIntervention['duree'].'</td>
                                <td>'.$uneIntervention['statut'].'</td>
                                <td>'.$uneIntervention['description'].'</td>
                                <td>'.$uneIntervention['idMateriel'].'</td>
                            </tr>
                        ';
                        /*        <td> <a href="index.php?page=2&action=modifier&idIntervention='.$uneIntervention['idIntervention'].'" > <img src="./Images/modifier.png" width="40" height="40"> </a>
                                        
                                        <a href="index.php?page=2&action=supprimer&idIntervention='.$uneIntervention['idIntervention'].'" > <img src="./Images/supprimer.png" width="40" height="40"> </a></td>
                            </tr>
                        ';*/
                    }
                }

            ?>
        </tbody>
    </table>


<?php
}
else
{
    echo 'Veuillez vous connecter pour avoir accès aux interventions';
}

?>