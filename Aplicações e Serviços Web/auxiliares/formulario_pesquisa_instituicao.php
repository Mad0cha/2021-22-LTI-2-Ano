<html><body>

    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        session_start();
        // unset($_SESSION['filtros']);
        include "abreconexao.php";

        if(isset($_POST["submit"])){

            // echo $_POST["escolha"];
            // echo $_POST["dia"];
            // echo $_POST["hora_ini"];
            // echo $_POST["hora_fim"];
            // echo $_POST["dist_conc_nome"];

            if ($_POST["escolha"] == "Concelho"){
                $concelho = $_POST["dist_conc_nome"];
                $query = "SELECT nome,tipo,email,telefone,nome_cont,tel_cont,morada FROM instituicao WHERE concelho LIKE '%$concelho%'";
                $res = mysqli_query($conn, $query);
                $encontrados = array();

                while($row = $res-> fetch_assoc()){
                    
                    $infos = array("nome" => $row["nome"], "tipo" => $row["tipo"], 
                                   "email" => $row["email"], "telefone" => $row["telefone"], "nome_cont" => $row["nome_cont"],
                                   "tel_cont" => $row["tel_cont"], "morada" => $row["morada"]);
                    // print_r($row);
                
                    array_push($encontrados, $infos);
                    // print_r($encontrados);
                        
                }

            }else if($_POST["escolha"] == "Distrito"){
                $distrito = $_POST["dist_conc_nome"];
                $query = "SELECT nome,tipo,email,telefone,nome_cont,tel_cont,morada FROM instituicao WHERE distrito LIKE '%$distrito%'";
                $res = mysqli_query($conn, $query);
                $encontrados = array();
                while($row = $res-> fetch_assoc()){
                    
                    $infos = array("nome" => $row["nome"], "tipo" => $row["tipo"], 
                                   "email" => $row["email"], "telefone" => $row["telefone"], "nome_cont" => $row["nome_cont"],
                                   "tel_cont" => $row["tel_cont"], "morada" => $row["morada"]);
                
                    array_push($encontrados, $infos);
                    // print_r($encontrados);
                        
                }

            }else if($_POST["escolha"] == "Nome"){
                $nome = $_POST["dist_conc_nome"];
                $query = "SELECT nome,tipo,email,telefone,nome_cont,tel_cont,distrito,concelho,morada FROM instituicao WHERE nome LIKE '%$nome%' ";
                $res = mysqli_query($conn, $query);
                $encontrados = array();

                while($row = $res-> fetch_assoc()){
                    
                    $infos = array("nome" => $row["nome"], "tipo" => $row["tipo"], 
                                   "email" => $row["email"], "telefone" => $row["telefone"], "nome_cont" => $row["nome_cont"],
                                   "tel_cont" => $row["tel_cont"], "distrito" => $row["distrito"], "concelho" => $row["concelho"], 
                                   "morada" => $row["morada"]);
                    // print_r($row);
                
                    array_push($encontrados, $infos);
                    // print_r($encontrados);
                        
                }

            }else if($_POST["escolha"] == "Necessidade"){
                $hora_ini = $_POST["hora_ini"].":00";
                $hora_fim = $_POST["hora_fim"].":00";
                $dia = $_POST["dia"];
                // echo $hora_ini . "<br>";
                // echo $hora_fim . "<br>";
                // echo $dia . "<br>";
                $query = "SELECT * FROM disp_instituicao WHERE dia = '$dia' AND hora_ini LIKE '$hora_ini' AND hora_fim LIKE '$hora_fim'";
                $res = mysqli_query($conn, $query);
                // echo $res;
                $encontrados = array();
                while($row = $res-> fetch_assoc()){
                    
                    $infos = array("dia" => $row["dia"], "hora_ini" => $row["hora_ini"], "hora_fim" => $row["hora_fim"]);
                    // print_r($row);
                    $email_inst = $row['email'];
                    $query = "SELECT nome,tipo,email,telefone,nome_cont,tel_cont,distrito,concelho,morada  FROM instituicao WHERE email = '$email_inst'";
                    $res2 = mysqli_query($conn, $query);

                    while($l = $res2-> fetch_assoc()){
                        $infos["nome"] = $l["nome"];
                        $infos["tipo"] = $l["tipo"];
                        $infos["email"] = $l["email"];
                        $infos["telefone"] = $l["telefone"];
                        $infos["nome_cont"] = $l["nome_cont"];
                        $infos["tel_cont"] = $l["tel_cont"];
                        $infos["distrito"] = $l["distrito"];
                        $infos["concelho"] = $l["concelho"];
                        $infos["morada"] = $l["morada"];
                    } 
                    
                    // print_r($infos);
                    array_push($encontrados, $infos);
                        
                }

            }
            
            $_SESSION["filtros"] = $encontrados;
            $_SESSION["tipo_filtro"] = $_POST["escolha"];

            mysqli_close($conn);
            
            echo "ANTES DO HEADER";
            header("Location: ../pesquisa_instituicoes.php");
            echo "DEPOIS DO HEADER";
        }
    
    
    
    
    
    
    
    
    
    
    ?>

</body></html>