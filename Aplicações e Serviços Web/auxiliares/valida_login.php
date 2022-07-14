<html><body>

<?php 
    session_start();

    // echo $_POST["submit"];
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $email_input = $_POST["email"];
        $pass_input = $_POST["pass"];
        echo $pass_input. "<br>";

        $email_valido = false;
        $pass_valida = false;
        $tipo_login = NULL;

        $erros = array();

        include "abreconexao.php";
        $query = "SELECT email,passwd FROM voluntario";
        $resposta = mysqli_query($conn, $query);
        if (mysqli_num_rows($resposta) > 0) {
            // echo "Captei as cenas";
            while($row = mysqli_fetch_assoc($resposta)) {
                // echo "email " . $row["email"] . "<br>";
                // echo "email " . $row["passwd"] . "<br>";

                if (strcmp($row["email"], $email_input) == 0){
                    
                    $email_valido = true;

                    if(password_verify($pass_input, $row['passwd'])){
                        $pass_valida = true;
                        $tipo_login = "voluntario";

                    }else{
                        if (strcmp("admin@refood.fc.ul.pt", $email_input) == 0){
                            if (strcmp($pass_input, $row['passwd']) == 0){
                                $tipo_login = "admin";
                                $pass_valida = true;
                            }
                        }
                    }
                }
            }
        }

        // echo $email_valido . "<br>";
        // echo $pass_valida . "<br>";
        // echo $tipo_login . "<br>";

        if($email_valido != true && $pass_valida != true){
            $query = "SELECT email,passwd FROM instituicao";
            $resposta = mysqli_query($conn, $query);
            if (mysqli_num_rows($resposta) > 0) {
                // echo "Captei as cenas";
                while($row = mysqli_fetch_assoc($resposta)) {
                    // echo "email " . $row["email"] . "<br>";
                    // echo "email " . $row["passwd"] . "<br>";
    
                    if (strcmp($row["email"], $email_input) == 0){
                        
                        $email_valido = true;
    
                        if(password_verify($pass_input, $row['passwd'])){
                            $pass_valida = true;
                            $tipo_login = "instituicao";
                        }
                    }
                }
            }
        }

        if ($email_valido == false){
            // array_push($erros, "O e-mail introduzido não está registado");
            array_push($erros, '1');
        }

        if ($pass_valida == false){
            // array_push($erros,  "A password introduzida não está correta");
            array_push($erros, '2');
        }

        if($email_valido == true && $pass_valida == true){
            $_SESSION["login"] = $email_input;
            $_SESSION["tipo_login"] = $tipo_login;
            print_r($_SESSION);
            header('Location: ../index.php');

        }else{
            $_SESSION['erros'] = $erros;
            header('Location: ../login.php?signup=empty');
            exit();
        }
    }else{
    header('Location: login.php');
    }

    ?>
</body></html>