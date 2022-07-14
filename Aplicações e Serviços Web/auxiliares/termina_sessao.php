<html><body>


        
<?php 
    session_start();

    $_SESSION["login"] = NULL;
    $_SESSION["tipo_login"] = NULL;

    unset($_SESSION['UID']);
    header('Location: ../index.php');
    die();
?>
          

</body></html>