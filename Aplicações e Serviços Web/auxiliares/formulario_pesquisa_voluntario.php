<html><body>

    <?php
    
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
                $query = "SELECT nome,nascimento,genero,email,telefone FROM voluntario WHERE concelho LIKE '%$concelho%'";
                $res = mysqli_query($conn, $query);
                $encontrados = array();

                while($row = $res-> fetch_assoc()){
                    
                    $infos = array("nome" => $row["nome"], "nascimento" => $row["nascimento"], 
                                   "genero" => $row["genero"], "email" => $row["email"], "telefone" => $row["telefone"]);
                    // print_r($row);
                
                    array_push($encontrados, $infos);
                    // print_r($encontrados);
                        
                }

            }else if($_POST["escolha"] == "Distrito"){
                $distrito = $_POST["dist_conc_nome"];
                $query = "SELECT nome,nascimento,genero,email,telefone FROM voluntario WHERE distrito LIKE '%$distrito%'";
                $res = mysqli_query($conn, $query);
                $encontrados = array();
                while($row = $res-> fetch_assoc()){
                    
                    $infos = array("nome" => $row["nome"], "nascimento" => $row["nascimento"], 
                                   "genero" => $row["genero"], "email" => $row["email"], "telefone" => $row["telefone"]);
                    // print_r($row);
                
                    array_push($encontrados, $infos);
                    // print_r($encontrados);
                        
                }

            }else if($_POST["escolha"] == "Nome"){
                $nome = $_POST["dist_conc_nome"];
                $query = "SELECT nome,nascimento,genero,email,telefone,concelho,distrito FROM voluntario WHERE nome LIKE '%$nome%' ";
                $res = mysqli_query($conn, $query);
                $encontrados = array();

                while($row = $res-> fetch_assoc()){
                    
                    $infos = array("nome" => $row["nome"], "nascimento" => $row["nascimento"], 
                                   "genero" => $row["genero"], "email" => $row["email"], "telefone" => $row["telefone"], 
                                   "concelho" => $row["concelho"], "distrito" => $row["distrito"]);
                    // print_r($row);
                
                    array_push($encontrados, $infos);
                    // print_r($encontrados);
                        
                }

            }else if($_POST["escolha"] == "Disponibilidade"){
                $hora_ini = $_POST["hora_ini"].":00";
                $hora_fim = $_POST["hora_fim"].":00";
                $dia = $_POST["dia"];
                // echo $hora_ini . "<br>";
                // echo $hora_fim . "<br>";
                // echo $dia . "<br>";
                $query = "SELECT * FROM disp_voluntario WHERE dia = '$dia' AND hora_ini LIKE '$hora_ini' AND hora_fim LIKE '$hora_fim'";
                $res = mysqli_query($conn, $query);
                // echo $res;
                $encontrados = array();
                while($row = $res-> fetch_assoc()){
                    
                    $infos = array("dia" => $row["dia"], "hora_ini" => $row["hora_ini"], "hora_fim" => $row["hora_fim"]);
                    // print_r($row);
                    $cc_vol = $row['cc'];
                    $query = "SELECT nome, concelho, email, telefone FROM voluntario WHERE cc = '$cc_vol'";
                    $res2 = mysqli_query($conn, $query);

                    while($l = $res2-> fetch_assoc()){
                        $infos["nome"] = $l["nome"];
                        $infos["concelho"] = $l["concelho"];
                        $infos["email"] = $l["email"];
                        $infos["telefone"] = $l["telefone"];
                    } 
                    
                    // print_r($infos);
                    array_push($encontrados, $infos);
                        
                }

            }
            
            $_SESSION["filtros"] = $encontrados;
            $_SESSION["tipo_filtro"] = $_POST["escolha"];

            mysqli_close($conn);

            header("Location: ../pesquisa_voluntarios.php");
        }
    
    
    
    
    
    
    
    
    
    
    ?>

</body></html>