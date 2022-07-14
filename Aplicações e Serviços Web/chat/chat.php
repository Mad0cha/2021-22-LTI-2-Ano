<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="chat.css" rel="stylesheet" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="processa.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
<body>

<?php

    include "abreconexao.php";

    session_start();

    $emissor = $_SESSION['login'];
    $recetor = $_SESSION['chat'];

    // se é voluntário ou instituição
    $tipo = ""; 

    $query = "SELECT * FROM voluntario WHERE email = '$emissor'";
    $res  = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) > 0){
      $tipo = "voluntario";
    }else{
      $tipo = "instituicao";
    }

    $arr = array();

    if ($tipo == "voluntario"){
      $query = "SELECT nome, email FROM instituicao";
      $res  = mysqli_query($conn, $query);

      while($row = $res-> fetch_assoc()){
        array_push($arr,$row);
      }

    }else{
      $query = "SELECT nome, email FROM voluntario WHERE email != 'admin@refood.fc.ul.pt'";
      $res  = mysqli_query($conn, $query);

      while($row = $res-> fetch_assoc()){
        array_push($arr,$row);
      }
    }
?>

<script>
  let emissor = '<?php echo $emissor; ?>';
  let recetor = '<?php echo $recetor; ?>';
</script>

<body>
<div class="container">
  
<div id="voltar">
    <img src="../assets/img/brand/arrow-small-left.png"  onclick="history.back()">
  </div>
<div class="participantes">
  <h3 class=" text-center" id="tit_emissor"></h3>
  <h3 class=" text-center" id="tit_recetor"></h3>
</div>
<div class="messaging">
      <div class="inbox_msg">
        <div class="mesgs">
          <div class="msg_history" id="caixa_msgs">
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
            <form action="">
                <input type="text" class="write_msg" name="msg" id="msg" placeholder = "Envie a sua mensagem">
                <button type="button" class="msg_send_btn" value="Enviar" class="submit" id="submit" name="submit" onclick= "envia_mensagem(emissor,recetor);"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<script>
  document.addEventListener('keydown', function (event) {
    if (event.keyCode !== 13) return;
    event.preventDefault();
    envia_mensagem(emissor,recetor);

  });
  // let emissor = '<?php echo $emissor; ?>';
  // let recetor = '<?php echo $recetor; ?>';
  document.getElementById("tit_emissor").innerHTML = "Emissor: " + emissor;
  document.getElementById("tit_recetor").innerHTML = "Recetor: " + recetor;
  function carregamento(){
    le_mensagens(emissor, recetor);
    // carrega_lateral(<?php echo json_encode($arr); ?>);
  }
  window.onload = carregamento();

  setInterval(function(){le_mensagens(emissor, recetor)}, 200);
</script>