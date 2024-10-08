<?php
    session_start();

    include ("sql/bdd.php");
?>


<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Orange</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php
        require_once("vue/headerVue.php");

        echo '<div class="container">';

        if (isset($_GET['page'])) 
        {
            $page =  $_GET['page'];
        }else
        {
            echo '<script>window.location.href="index.php?page=0"</script>';
        }
    
        switch($page)
        {
            case 0: require_once('vue/accueilVue.php');break;
            case 1: require_once('vue/produitsVue.php');break;
            case 2: require_once('vue/interventionsVue.php');break;
            case 3: require_once('vue/parametresVue.php');break;
            case 4: require_once('deconnexion.php'); break;

            default: require_once('vue/accueilVue.php'); break;
        }

        echo '<div/>';

        require_once("vue/footerVue.php")
    ?>
</body>
</html>