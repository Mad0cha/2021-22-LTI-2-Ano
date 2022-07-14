<?php

    session_start();
    
    unset($_SESSION["chat"]);
    $_SESSION["chat"] = $_POST['chat'];

?>
