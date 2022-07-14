<html><body>
  <?php 
    session_start();
  
    if (isset($_POST["submit"])){
      $nome = htmlspecialchars($_POST["nome_inst"]);
      $tel_instituicao = $_POST["telefone_instituicao"];
      $nome_resp = htmlspecialchars($_POST["nome_pessoa"]);
      $tel_resp = $_POST["telefone_pessoa"]; 
      $email = htmlspecialchars($_POST["email"]);
      $morada = htmlspecialchars($_POST["morada"]);
      $distrito = htmlspecialchars($_POST["distrito"]);
      $concelho = htmlspecialchars($_POST["concelho"]);
      $freguesia = htmlspecialchars($_POST["freguesia"]);
      $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
      $descricao = htmlspecialchars($_POST["descricao"]);

      echo "<p>". strlen($telefone) ."</p>";

      $erros = array();

      if (preg_match("/\d+/", $nome_resp) != 0){
        // array_push($erros, "O nome da pessoa responsável não pode conter digitos.");
        array_push($erros, '1');
      }

      if (strlen($morada) > 50){
        // array_push($erros, "A morada é demasiado grande. O máximo é de 50 caracteres");
        array_push($erros, '2');
      }

      if (strlen($distrito) > 50){
        // array_push($erros, "O nome do distrito é demasiado grande. O máximo é de 50 caracteres");
        array_push($erros, '3_0');
      }

      if (strlen($concelho) > 50){
        // array_push($erros, "O nome do concelho é demasiado grande. O máximo é de 50 caracteres");
        array_push($erros, '4_0');
      }

      if (strlen($freguesia) > 50){
        // array_push($erros, "O nome da freguesia é demasiado grande. O máximo é de 50 caracteres");
        array_push($erros, '5_0');
      }

      if (strlen($email) > 50){
        // array_push($erros, "O email digitado é demasiado grande. O máximo é de 50 caracteres");
        array_push($erros, '7_0');
      }

      if (preg_match("/\d+/", $distrito) != 0){
        // array_push($erros, "O distrito não pode conter digitos.");
        array_push($erros, '3_1');
      }

      if (preg_match("/\d+/", $concelho) != 0){
        // array_push($erros, "O concelho não pode conter digitos.");
        array_push($erros, '4_1');
      }

      if (preg_match("/\d+/", $freguesia) != 0){
        // array_push($erros, "A freguesia não pode conter digitos.");
        array_push($erros, '5_1');
      }

      if (strlen($tel_instituicao) <= 8){
        // array_push($erros, "Tem números a menos no telefone da instituição.");
        array_push($erros, '6_0');
      }

      if (strlen($tel_instituicao) > 9){
        // array_push($erros, "Tem números a mais no telefone da instituição.");
        array_push($erros, '6_1');
      }

      if (strlen($tel_resp) <= 8){
        // array_push($erros, "Tem números a menos no telefone da pessoa responsável.");
        array_push($erros, '6_2');
      }

      if (strlen($tel_resp) > 9){
        // array_push($erros, "Tem números a mais no telefone da pessoa responsável.");
        array_push($erros, '6_3');
      }

      include "abreconexao.php";

      $query_email = "SELECT email FROM instituicao";
      $resposta = mysqli_query($conn, $query_email);
      if (mysqli_num_rows($resposta) > 0) {
        // echo "Captei as cenas";
        while($row = mysqli_fetch_assoc($resposta)) {
          // echo "email " . $row["email"];

          if (strcmp($row["email"], $email) == 0){
            // array_push($erros, "O e-mail digitado já está registado");
            array_push($erros, '7_1');
          }
        }

      }else{
        echo "Não deu";
      }
          

      $avancar = false;

      if (count($erros) == 0){
        $avancar = true;
      }

      if ($avancar){
        $query = "INSERT INTO instituicao (nome , descricao, email, passwd, telefone, concelho, freguesia, distrito, nome_cont, tel_cont, morada) 
        VALUES  ('$nome','$descricao','$email','$pass','$tel_instituicao', '$concelho','$freguesia','$distrito', '$nome_resp', '$tel_resp', '$morada')";
    
        $res = mysqli_query($conn, $query); 
        if ($res) {
          echo "Um novo registo inserido com sucesso";
        } else {
          echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
        }
        // Termina a ligação com a base de dados
        mysqli_close($conn);

        header('Location: ../index.php');
      }else{
        // foreach($erros as $erro){
        //   echo "$erro <br>";
        // }
        $_SESSION['erros'] = $erros;
        header('Location: ../registar_instituicao.php?signup=empty');
        exit();
      }
    }else{
      header('Location: ../login.php');
    }
    


  ?>

  </body> </html>
