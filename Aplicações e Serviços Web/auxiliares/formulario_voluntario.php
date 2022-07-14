<html><body>
  <?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();

    if (isset($_POST["submit"])){
      $nome = htmlspecialchars($_POST["first_name"] . " " . $_POST["last_name"]);
      $nascimento = $_POST["birthdayDate"];
      $cc = htmlspecialchars($_POST["cartao_cidadao"]);
      $ccond = htmlspecialchars($_POST["carta_conducao"]); 
      $email = htmlspecialchars($_POST["email"]);
      $genero = $_POST["genero"];
      $distrito = htmlspecialchars($_POST["distrito"]);
      $concelho = htmlspecialchars($_POST["concelho"]);
      $freguesia = htmlspecialchars($_POST["freguesia"]);
      $telefone =  htmlspecialchars($_POST["telefone"]);
      $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
      if(!empty($_FILES["file"])){
        $img = $_FILES["file"]["name"];
        $path = realpath($_FILES["file"]["tmp_name"]);
        $tamanho = filesize($path);
        // echo strlen($tamanho);
      }

      $ano_nasc = explode('/', $nascimento)[0];
      $extensao_img = pathinfo($img, PATHINFO_EXTENSION);
      $erros = array();
      
      if ($extensao_img != "jpeg"){
        // array_push($erros, "Apenas a extensão .jpeg é valida");
        array_push($erros, '1_0');
      }

      if ($extensao_img == "jpeg"){
        // caso em Kb
        if (strlen($tamanho) == 4){
          if ($tamanho > 2048){
            array_push($erros, '1_1');
          }
        }else{
          // caso em bytes
          if($tamanho > 2000000 ){ 
            array_push($erros, '1_1');
          }

        }
        
      }

      if (preg_match("/\d+/", $nome) != 0){
        // array_push($erros, "O seu nome não pode conter digitos.");
        array_push($erros, '2');
      }

      if (preg_match("/\d+/", $distrito) != 0){
        // array_push($erros, "O distrito não pode conter digitos.");
        array_push($erros, '3_0');
      }

      if (preg_match("/\d+/", $concelho) != 0){
        // array_push($erros, "O concelho não pode conter digitos.");
        array_push($erros, '4_0');
      }

      if (preg_match("/\d+/", $freguesia) != 0){
        // array_push($erros, "A freguesia não pode conter digitos.");
        array_push($erros, '5_0');
      }

      if (strlen($distrito) > 50){
        // array_push($erros, "O nome do distrito é demasiado grande. O máximo é de 50 caracteres");
        array_push($erros, '3_1');
      }

      if (strlen($concelho) > 50){
        // array_push($erros, "O nome do concelho é demasiado grande. O máximo é de 50 caracteres");
        array_push($erros, '4_1');
      }

      if (strlen($freguesia) > 50){
        // array_push($erros, "O nome da freguesia é demasiado grande. O máximo é de 50 caracteres");
        array_push($erros, '5_1');
      }

      if (strlen($email) > 50){
        // array_push($erros, "O email digitado é demasiado grande. O máximo é de 50 caracteres");
        array_push($erros, '6_0');
      }

      if (strlen($cc) > 8){
        // array_push($erros, "Tem número a mais no seu cartão de cidadão.");
        array_push($erros, '7_0');
      }

      if (strlen($cc) <= 7){
        // array_push($erros, "Tem número a menos no seu cartão de cidadão.");
        array_push($erros, '7_1');
      }

      if (strlen($ccond) > 8){
        // array_push($erros, "Tem número a mais na sua carta de condução.");
        array_push($erros, '8_0');
      }

      if (strlen($ccond) <= 7){
        // array_push($erros, "Tem número a menos na sua carta de condução.");
        array_push($erros, '8_1');
      }

      if (strlen($telefone) <= 8){
        // array_push($erros, "Tem números a menos no seu telefone.");
        array_push($erros, '9_0');
      }

      if (strlen($telefone) > 9){
        // array_push($erros, "Tem números a mais no seu telefone.");
        array_push($erros, '9_1');
      }

      if ($ano_nasc > (date("Y")-16)){
        // array_push($erros, "Tem de ter mais de 16 anos para poder participar como voluntário.");
        array_push($erros, '10');
      }

        
      // Validação do email e da carta  

      include "abreconexao.php";

      $query_email = "SELECT email,carta,cc FROM voluntario";
      $resposta = mysqli_query($conn, $query_email);
      if (mysqli_num_rows($resposta) > 0) {
        // echo "Captei as cenas";
        while($row = mysqli_fetch_assoc($resposta)) {
          // echo "email " . $row["email"];

          if (strcmp($row["email"], $email) == 0){
            // array_push($erros, "O e-mail digitado já está registado");
            array_push($erros, '6_1');
          }

          if (strcmp($row["carta"], $ccond) == 0){
            // array_push($erros, "A carta de condução inserida já está registada");
            array_push($erros, '8_2');
          }

          if (strcmp($row["cc"], $cc) == 0){
            // array_push($erros, "O cartão de cidadão inserido já está registado");
            array_push($erros, '7_2');
          }
        }

      }
          // Termina a ligação com a base de dados
      // mysqli_close($conn);

      $avancar = false;

      if (count($erros) == 0){
        $avancar = true;
      }

      if ($avancar){
        $ft = $cc. "." .$extensao_img;
        $query = "INSERT INTO voluntario (cc , nome, nascimento, carta, genero, email, passwd, telefone, concelho, freguesia, distrito, foto) 
            VALUES  ('$cc','$nome','$nascimento','$ccond','$genero','$email', '$pass','$telefone','$concelho','$freguesia','$distrito','$ft')";
        //echo $genero;
        $res = mysqli_query($conn, $query); 
        if ($res) {
          // echo "Um novo registo inserido com sucesso";
          // move_uploaded_file($_FILES["file"]["tmp_name"], "imgsUsers/$ft");
      
          $upload_dir = "users/";
          move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir.$ft);

          if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir.$ft)){
              echo "file moved successfully";
          }
          else{
              echo " STILL DID NOT MOVE";
          }


        } else {
          echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
        }
        // Termina a ligação com a base de dados
        mysqli_close($conn);
        header('Location: ../index.php');
      }else{
        //   foreach($erros as $erro){
        //     echo "$erro <br>";
        //   }
        // }
        $_SESSION['erros'] = $erros;
        header('Location: ../registar_voluntario.php?signup=empty');
        exit();
      }
      

    }else{
      header('Location: ../login.php');
    }

  
  ?>
<script>
    console.log(<?= json_encode($_SESSION['erros']); ?>);
</script>
  </body> </html>
