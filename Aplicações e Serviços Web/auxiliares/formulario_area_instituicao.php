<html><body>
  <?php 
  
    if (isset($_POST["submit"])){
      $email = $_POST["email_inst"];
      $nome = htmlspecialchars($_POST["nome_inst"]);
      $tipo = $_POST["tipo_inst"];
      $descricao = htmlspecialchars($_POST["descricao_inst"]);
      $telefone = $_POST["telefone_inst"];
      $concelho = htmlspecialchars($_POST["concelho_inst"]);
      $freguesia = htmlspecialchars($_POST["freguesia_inst"]);
      $distrito = htmlspecialchars($_POST["distrito_inst"]);
      $responsavel = htmlspecialchars($_POST["nome_cont_inst"]);
      $tel_responsavel = $_POST["tel_cont_inst"];
      
      echo "<p>". strlen($telefone) ."</p>";

      $erros = array();

      if (preg_match("/\d+/", $nome) != 0){
        array_push($erros, "O nome da pessoa responsável não pode conter digitos.");
      }

      if (preg_match("/\d+/", $responsavel) != 0){
        array_push($erros, "O nome da pessoa responsável não pode conter digitos.");
      }

      if (strlen($distrito) > 50){
        array_push($erros, "O nome do distrito é demasiado grande. O máximo é de 50 caracteres");
      }

      if (strlen($concelho) > 50){
        array_push($erros, "O nome do concelho é demasiado grande. O máximo é de 50 caracteres");
      }

      if (strlen($freguesia) > 50){
        array_push($erros, "O nome da freguesia é demasiado grande. O máximo é de 50 caracteres");
      }

      if (preg_match("/\d+/", $distrito) != 0){
        array_push($erros, "O distrito não pode conter digitos.");
      }

      if (preg_match("/\d+/", $concelho) != 0){
        array_push($erros, "O concelho não pode conter digitos.");
      }

      if (preg_match("/\d+/", $freguesia) != 0){
        array_push($erros, "A freguesia não pode conter digitos.");
      }

      if (strlen($telefone) <= 8){
        array_push($erros, "Tem números a menos no telefone da instituição.");
      }

      if (strlen($telefone) > 9){
        array_push($erros, "Tem números a mais no telefone da instituição.");
      }

      if (strlen($tel_responsavel) <= 8){
        array_push($erros, "Tem números a menos no telefone da pessoa responsável.");
      }

      if (strlen($tel_responsavel) > 9){
        array_push($erros, "Tem números a mais no telefone da pessoa responsável.");
      }




      include "abreconexao.php";
     

      $avancar = false;

      if (count($erros) == 0){
        $avancar = true;
      }

      if ($avancar){
        $query = "UPDATE instituicao
        SET nome='$nome', tipo='$tipo', descricao='$descricao', telefone='$telefone', concelho='$concelho', freguesia='$freguesia', distrito='$distrito', nome_cont='$responsavel', tel_cont='$tel_responsavel'
        WHERE email='$email'";
        $res = mysqli_query($conn, $query); 
        if ($res) {
          echo "Um novo update registado com sucesso";
        } else {
          echo "Erro: insert failed" . $query . "<br>" . mysqli_error($conn);
        }
        // Termina a ligação com a base de dados
        mysqli_close($conn);

        header('Location: index.php');
      }else{
        foreach($erros as $erro){
          echo "$erro <br>";
        }
      }
    }else{
      header('Location: login.php');
    }
    


  ?>

  </body> </html>
