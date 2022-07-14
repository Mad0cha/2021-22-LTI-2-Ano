<?php   
    include "abreconexao.php";

    if($_POST){
        $emissor = $_POST["emissor"];
        $recetor = $_POST["recetor"];
        $msg = $_POST["msg"];
        $hora = $_POST["data"];

        if ($msg != "undefined" and $msg != " "){
            
            $query = "INSERT INTO mensagens (de,para,msg,hora) VALUES ('$emissor','$recetor','$msg','$hora')";
            $res = mysqli_query($conn, $query); 
        }   
        echo "deu certo";
        
        mysqli_close($conn);

    }
?>