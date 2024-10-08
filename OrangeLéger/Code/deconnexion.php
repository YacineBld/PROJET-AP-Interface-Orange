<?php

    if(isset($_SESSION['email']))
    {
        session_destroy();
        echo '<script>window.location.href="index.php?page=0"</script>';
    }

?>