<!DOCTYPE html>
<html lang="pt">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 

  <title>ENTRAR - REFOOD FCUL Edition</title>
  <link href="assets/img/brand/icon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
 
  <!-- JS files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/login.js"></script>

  <!-- Main CSS File -->
  <link href="assets/css/style_registo.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="login-body">

  <div id="voltar">
    <img src="assets/img/brand/arrow-small-left.png"  onclick="history.back()">
  </div>

  <div class="login-container" id="container">

    <div class="form-container sign-in-container">
      <form action="auxiliares/valida_login.php" enctype="multipart/form-data" method="post" class="login-form"> 
        <h1>ENTRAR</h1>
        <div id="err_1"></div>
        <input class="login-input" type="email" placeholder="Email" name="email" required/>
        <div id="err_2"></div>
        <input class="login-input" type="password" placeholder="Password" name="pass" required/>

        <input type = "submit" value = "Entrar" class="submit" name="entrar" id="btn_entrar" ></input>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-right">
          <h1>REGISTAR</h1>
          <p>Escolha como se quer registar</p>
          <button class="ghost" id="signUp" onclick="redirect(1);">Registar Instituição</button>
          <button class="ghost" id="signUp" onclick="redirect(2);">Registar Voluntário</button>
        </div>
      </div>
    </div>
  </div>
  
</body>
</html>


<?php 
    session_start();
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(strpos($fullUrl,"signup=empty") == true){
        $erros =  $_SESSION['erros'];
        ?>
        <script>
            var php_erros = "<?php echo implode(",", $erros) ?>";
            var php_erros_lista = php_erros.split(',');
            console.log("Erros:",php_erros_lista)

            for (let i = 0; i < php_erros_lista.length; i++) {
              
                if(php_erros_lista[i].length > 1){
                   
                    novo_id = php_erros_lista[i].split('_')[0];
                    descricao = php_erros_lista[i].split('_')[1];
                
                    var div = 'err_'+novo_id
                    console.log(div)
                }
                else{
                   
                    var div = 'err_'+php_erros_lista[i]
                    descricao = 'None'
                    
                }

    
                if(div == 'err_1'){
                    document.getElementById(div).innerHTML = '<p style="color:red;">'+"O e-mail introduzido não está registado"+'</p>';
                }
                else if (div == 'err_2'){
                    document.getElementById(div).innerHTML = '<p style="color:red;">'+"A password introduzida não está correta"+'</p>';
                }
            }
        </script>
        <?php
        exit();
    }
?> 