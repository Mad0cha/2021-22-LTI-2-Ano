<?php
    include "auxiliares/abreconexao.php";

	session_start();
	$login = $_SESSION['login'];

    $query = "SELECT * FROM voluntario WHERE email = '$login'";

    $res = mysqli_query($conn, $query);

    if ($res) {
        // echo "sucesso";
    } else {
        echo "Erro: failed" . $query . "<br>" . mysqli_error($conn);
    }
	while($row = $res-> fetch_assoc()){
		$cc = $row['cc'];
		$nome = $row['nome'];
		$nascimento = $row['nascimento'];
		$carta = $row['carta'];
		$genero = $row['genero'];
		$email = $row['email'];
		$telefone = $row['telefone'];
		$concelho = $row['concelho'];
		$freguesia = $row['freguesia'];
		$distrito = $row['distrito'];
		$foto = $row['foto'];
	}
    // Termina a ligação com a base de dados
    mysqli_close($conn);
	?>

<?php // query da disp_voluntario
   include "auxiliares/abreconexao.php";
   $query3 = "SELECT * FROM disp_voluntario WHERE cc='$cc'";
   $res3 = mysqli_query($conn, $query3);

   $diaVol = " ";
   $hora_iniVol= " ";
   $hora_fimVol = " ";

   $cookie_name = "cartaocidadao";
   setcookie($cookie_name, $cc, time() + (86400 * 30), "/"); // 86400 = 1 day

   if ($res3) {
	// echo "sucesso";
   } else {
		echo "Erro: failed" . $query3. "<br>" . mysqli_error($conn);
   }
   while($row = $res3-> fetch_assoc()){
		$ccVol = $row['cc'];
		$diaVol = $row['dia'];
		$hora_iniVol = $row['hora_ini'];
		$hora_fimVol = $row['hora_fim'];
    }
	mysqli_close($conn);
?>

<?php // query da disp_instituicao
   include "auxiliares/abreconexao.php";
   $query4 = "SELECT * FROM disp_instituicao WHERE dia='$diaVol'";
   $res4 = mysqli_query($conn, $query4);

   $diaInst = " ";
   $hora_iniInst = " ";
   $hora_fimInst = " ";
   $emailInst = " ";

   if ($res4) {
	// echo "sucesso";
	} else {
	}
	$arrayInstituicoes = array("0");
	while($row = $res4-> fetch_assoc()){
		$emailInst = $row['email'];
		array_push($arrayInstituicoes, $emailInst);
		$diaInst = $row['dia'];
		$hora_iniInst = $row['hora_ini'];
		$hora_fimInst = $row['hora_fim'];
	}
	mysqli_close($conn);
?>

<?php // query da INSTITUICAO
   include "auxiliares/abreconexao.php";
   $query2 = "SELECT * FROM instituicao WHERE email='$emailInst'";
   $res2 = mysqli_query($conn, $query2);
   if ($res2) {
	// echo "sucesso";
	} else {
		echo "Erro: failed" . $query2 . "<br>" . mysqli_error($conn);
	}
	$arrayItens = array("0");
	while($row = $res2-> fetch_assoc()){
		$nomeInst = $row['nome'];
		$emailInst = $row['email'];
		array_push($arrayItens, $nomeInst, $emailInst);
		$concelhoInst = $row['concelho'];
		$freguesiaInst = $row['freguesia'];
	}

	// PARTE DO MATCH DAS DISPONIBILIDADES
	$query = "SELECT cc, concelho FROM voluntario WHERE email = '$login'";
	$res = mysqli_query($conn, $query);

	$cc_vol;
	$concelho_vol;

	if ($res){
		while($row = $res-> fetch_assoc()){
			$cc_vol = $row["cc"];
			$concelho_vol = $row["concelho"];
		}

	}else{
		echo "ERRO";
	}

	$disponibilidades_voluntario = array();

	$query = "SELECT dia, hora_ini, hora_fim FROM disp_voluntario WHERE cc = '$cc_vol' AND hora_ini <> 'None' AND hora_fim <> 'None'";
	$res = mysqli_query($conn, $query);

	if ($res){
		while($row = $res-> fetch_assoc()){
			$infos = array("dia"=>$row["dia"], "hora_ini"=>$row["hora_ini"], "hora_fim"=>$row["hora_fim"]);
			array_push($disponibilidades_voluntario , $infos);
		}

	}else{
		echo "ERRO";
	}

	$instituicoes = array();

	$query = "SELECT * FROM disp_instituicao WHERE hora_ini <> 'None' AND hora_fim <> 'None'";
	$res = mysqli_query($conn, $query);

	if ($res){
		
		while($row = $res-> fetch_assoc()){
			$infos = array("id"=>$row["id"],"email"=>$row["email"], "dia"=>$row["dia"], "hora_ini"=>$row["hora_ini"], "hora_fim"=>$row["hora_fim"]);
			array_push($instituicoes , $infos);
		}

	}else{
		echo "ERRO";
	}

	$status = array();

	$encontrados = array();

	foreach($disponibilidades_voluntario as $vol){
		foreach($instituicoes as $inst){

			if($inst["dia"] == $vol["dia"] and $inst["hora_ini"] == $vol["hora_ini"] and $inst["hora_fim"] == $vol["hora_fim"]){
	
				$email_inst= $inst["email"];
				$query = "SELECT nome, concelho, morada, tipo FROM instituicao WHERE email = '$email_inst'";
				$res = mysqli_query($conn, $query);
				
				while($row = $res-> fetch_assoc()){
					$inst["nome"] = $row["nome"];
					$inst["morada"] = $row["morada"];
					$inst["concelho"] = $row["concelho"];
					$inst["doacao"] = explode("," ,$row["tipo"])[1];
				}
				
				if ($concelho_vol == $inst["concelho"]){ 
					array_push($encontrados, $inst);
					array_push($status, "'". $email_inst."'");
				}
			}
		}
	}

	mysqli_close($conn);
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	let status = <?php echo json_encode($status) ?>;
	let jsonString = JSON.stringify(status);
	function updateUserStatus(){
		jQuery.ajax({
			url:'/~asw14/projeto2/online/update_user_status.php',
			success:function(){
			}
		});
	}

	function getUserStatus(){
		jQuery.ajax({
			type: "POST",
			url:'/~asw14/projeto2/online/get_user_status.php',
			data: "hashString=" + status,
			success:function(result){
				
				status_a_colocar = result.split("/");
				
				for (let i = 0; i < status_a_colocar.length; i++){
					let vol = status_a_colocar[i].split("-");

					if (vol[1] == "Offline"){
						
						$("[id=user_grid_" + vol[0].replace(/[^a-zA-Z ]/g, "") +"]").html('<button type="button" class="btn btn-danger">Offline</button>')
					}else{
						$("[id=user_grid_" + vol[0].replace(/[^a-zA-Z ]/g, "") +"]").html('<button type="button" class="btn btn-success">Online</button>')
					}
				}
			}
		});
	}
	getUserStatus();
	setInterval(function(){
		updateUserStatus();
	},2000);

	setInterval(function(){
		getUserStatus();
	},2000);

	// REDIRECIONAMENTO PARA AS MENSAGENS
	function redirecionaParaVoluntario(email){

		$.ajax({
			type: "POST",
			url: 'chat/poeSessao.php',   
			data: "chat=" + email,
			success: function(result){window.location.href = "chat/chat.php";}
		});
	}
</script>
<script>
	function serParceiro(id){
		jQuery.ajax({
			type: "POST",
			url:'/~asw14/projeto2/auxiliares/update_disp_DB.php',
			data: "id=" + String(id),
			success:function(result){
			}
		});
	}

	function getDisponibilidade(id){
		jQuery.ajax({
			type: "GET",
			url:'/~asw14/projeto2/auxiliares/state_update_disp_DB.php?q='+id,
			success:function(result){

				let login2 = <?php echo json_encode($_SESSION['login']) ?>;
				status_a_colocar2 = result.split("/");
				for (let i = 0; i < status_a_colocar2.length -1; i++){
					let vol2 = status_a_colocar2[i].split("-");
					
					if (result.includes('ocupado')){
						let vol = vol2[1].split(":")[1].trim();
						if (vol == login2){
							$("[id=getDisp_" + vol2[0] +"]").html('<p class="text-success">Inscrito</p>');
							$("[id=btn_inscrever_" + vol2[0] +"]").html("Desinscrever");
							$("[id=btn_inscrever_" + vol2[0] +"]").removeClass("btn-success").addClass("btn-danger");
							$("[id=btn_inscrever_" + vol2[0] +"]").prop('disabled',false);
						}else{
							$("[id=getDisp_" + vol2[0] +"]").html('<p class="text-danger">Indisponivel</p>');
							$("[id=btn_inscrever_" + vol2[0] +"]").html("Indisponivel");
							$("[id=btn_inscrever_" + vol2[0] +"]").removeClass("btn-success").addClass("btn-secondary");
							$("[id=btn_inscrever_" + vol2[0] +"]").prop('disabled',true);
						}
					}else{
						$("[id=getDisp_" + vol2[0] +"]").html('<p class="text-success">Disponivel</p>');
						$("[id=btn_inscrever_" + vol2[0] +"]").html("Inscrever");
						$("[id=btn_inscrever_" + vol2[0] +"]").removeClass("btn-danger").addClass("btn-success");
						$("[id=btn_inscrever_" + vol2[0] +"]").prop('disabled',false);
					}
				}
			}
		});
	}
	<?php
		$idsResultado= array();
		foreach($encontrados as $e){
			$idVirtual = $e["id"];
			array_push($idsResultado, intval($idVirtual));
		};
	?>
	let listaIds = <?php echo json_encode($idsResultado); ?>;
	function buscaDisp(){
		for(let i = 0; i<listaIds.length;i++){
			getDisponibilidade(listaIds[i]);
		}
	}
	buscaDisp();
	setInterval(function(){
		buscaDisp();
	},2000);
</script>

<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<title>ÁREA PESSOAL - REFOOD FCUL Edition</title>
	<link href="assets/img/brand/icon.png" rel="icon">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>

	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
	<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
	<link href="assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script src="Bootstrap/js/bootstrap.min.js"></script>

	<!-- Main CSS File -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/areas.css" rel="stylesheet">

</head>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="index.php" class="logo me-auto"><img src="assets/img/brand/logo.png" alt=""></a>

      <!-- ======= Navbar ======= -->
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Página Principal</a></li>
          <li><a class="nav-link scrollto" href="instituicoes.php">Instituições</a></li>
		  <li><a class="nav-link scrollto" href="sobre.php">Sobre nós</a></li>
          <li><a class="nav-link scrollto" href="contactos.php">Contactos</a></li>
          <?php 
    
          if (isset($_SESSION["login"])){
			echo "<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'> </script>
				<script>
				function updateUserStatus(){
				jQuery.ajax({
					url:'/~asw14/projeto/TestesPedro/Proj/chat2/update_user_status.php',
					success:function(){
					
					}
				});
				}
			
				setInterval(function(){
				updateUserStatus();
				},3000);
		    </script>";
            if ($_SESSION["tipo_login"] == "voluntario"){
              echo '<li><a class="nav-link scrollto nav-active" href="area_user.php">Área de utilizador</a></li>';
              
            }else if($_SESSION["tipo_login"] == "instituicao"){
              echo '<li><a class="nav-link scrollto nav-active" href="area_instituicao.php">Área de utilizador</a></li>';
              
            }else{
              echo '<li><a class="nav-link scrollto nav-active" href="admin.php">Área de administração</a></li>';
            }
          }
        ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->
	  <?php 
        if (isset($_SESSION["login"])){
          echo '<a href="auxiliares/termina_sessao.php" class="login-btn scrollto" id="sair"><span class="d-none d-md-inline">Sair</a>';
        }else{
          echo '<a href="login.php" class="login-btn scrollto"><span class="d-none d-md-inline">Entrar/</span>Registar</a>'; 
        }
      ?>
    </div>
  </header>
  <!-- End Header -->

<body class="dashboard">
<div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="auxiliares/users/<?php echo $foto?>" alt="Foto do Utilizador"
									class="rounded-circle p-1 bg-primary" width="110" height="110">
								<div class="mt-3">
									<h4><?php echo $nome;?></h4>
									<p class="text-secondary mb-1">Voluntário</p>
									<p class="text-muted font-size-sm"><?php echo $concelho;?></p>
								</div>
							</div>
							<hr class="my-4">
							<div class="align-items-center text-center">
								<i class="fa fa-search" aria-hidden="true"></i>
								<a href="pesquisa_instituicoes.php" class="h5">Pesquisa de instituições</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
						<?php include "auxiliares/abreconexao.php"; ?>
		
        <?php
        if (isset($_SESSION['message'])): ?>
        
        <div class=" alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>

        <div class="container">

        <div class="row justify-content-center">
            <table class="table" hidden>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nascimento</th>
						<th>Carta</th>
                        <th>Genero</th>
						<th>Email</th>
                        <th>Telefone</th>
						<th>Concelho</th>
                        <th>Freguesia</th>
						<th>Distrito</th>
                        <th colspan="9">Action</th>
                    </tr>

					<tr>
						<td><?php echo $row['nome']; ?></td>
						<td><?php echo $row['nascimento']; ?></td>
						<td><?php echo $row['carta']; ?></td>
						<td><?php echo $row['genero']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['telefone']; ?></td>
						<td><?php echo $row['concelho']; ?></td>
						<td><?php echo $row['freguesia']; ?></td>
						<td><?php echo $row['distrito']; ?></td>
						<td>
							<a href="area_user_updates.php?edit=<?php echo $row['cc'] ?>"
								class="btn btn-info">Edit</a>
							<a href="process.php?delete=<?php echo $row['cc'] ?>"
								class="btn btn-danger">Delete</a>
						</td>
					</tr>

            </table>      
        </div>
        <?php
            function pre_r( $array ) {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>

        <div class="row justify-content-center">
            <form action="process.php" method="POST">
            <div class="form-group">
            <input type="hidden" name="cc" value="<?php echo $cc; ?>">
            
            <div class="form-group">
            <label>Name</label>
            <input type="text" name="nome" class="form-control" 
                value="<?php echo $nome; ?>" placeholder="Enter your name">
            </div>
			
            <div class="form-group">
            <label>Nascimento</label>
            <input type="text" name="nascimento" class="form-control" 
                value="<?php echo $nascimento; ?>" placeholder="Enter your location">
            </div>

			<div class="form-group">
            <label>Carta de Condução</label>
            <input type="text" name="carta" class="form-control" 
                value="<?php echo $carta; ?>" placeholder="Enter your location">
            </div>

			<div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" 
                value="<?php echo $email; ?>" placeholder="Enter your location">
            </div>

			<div class="form-group">
            <label>Genero</label>
            <input type="text" name="genero" class="form-control" 
                value="<?php echo $genero; ?>" placeholder="Enter your location">
            </div>

			<div class="form-group">
            <label>Distrito</label>
            <input type="text" name="distrito" class="form-control" 
                value="<?php echo $distrito; ?>" placeholder="Enter your location">
            </div>

			<div class="form-group">
            <label>Concelho</label>
            <input type="text" name="concelho" class="form-control" 
                value="<?php echo $concelho; ?>" placeholder="Enter your location">
            </div>

			<div class="form-group">
            <label>Freguesia</label>
            <input type="text" name="freguesia" class="form-control" 
                value="<?php echo $freguesia; ?>" placeholder="Enter your location">
            </div>

			<div class="form-group">
            <label>Telemóvel</label>
            <input type="text" name="telefone" class="form-control" 
                value="<?php echo $telefone; ?>" placeholder="Enter your location">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-info btn-primary" name="update">Atualizar</button>
            </div>
        </form>
        </div>
        </div>
		</div>
		</div>
		</div>
		</div>
					<body>
						<hr>
						<div class="px-1 py-1 my-3 text-center">
							<h2 class="display-5 fw-bold">Definir preferências:</h2>
						</div>
						
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th scope="col">Dia da Semana</th>
									<th scope="col">Hora de Início da Recolha</th>
									<th scope="col">Hora de Fim da Recolha</th>
									<th scope="col">Horário atual</th>
								</tr>
							</thead>
							<tbody>
							<form action="code_disp_voluntario.php" method="POST">
					<select  name="cartcid" class="hidd">
						<option value="<?= $cc ?>"><?php echo $cc?></option>
					</select>

					<select  name="segunda" class="hidd">
						<option value="Segunda">Segunda</option>
					</select>

					<select  name="terca" class="hidd">
						<option value="Terca">Terca</option>
					</select>

					<select  name="quarta" class="hidd">
						<option value="Quarta">Quarta</option>
					</select>

					<select  name="quinta" class="hidd">
						<option value="Quinta">Quinta</option>
					</select>

					<select  name="sexta" class="hidd">
						<option value="Sexta">Sexta</option>
					</select>

					<select  name="sabado" class="hidd">
						<option value="Sabado">Sabado</option>
					</select>

					<select  name="domingo" class="hidd">
						<option value="Domingo">Domingo</option>
					</select>
								<tr>
									<th scope="row" >Segunda</th>
									<td>
										<select  name="seg1" class="seg1" id="seg1">
											<option value="1-None">None</option>
											<option value="2-09:00:00">09:00</option>
											<option value="3-10:00:00">10:00</option>
											<option value="4-11:00:00">11:00</option>
											<option value="5-12:00:00">12:00</option>
											<option value="6-13:00:00">13:00</option>
											<option value="7-14:00:00">14:00</option>
											<option value="8-15:00:00">15:00</option>
											<option value="9-16:00:00">16:00</option>
											<option value="10-17:00:00">17:00</option>
											<option value="11-18:00:00">18:00</option>
											<option value="12-19:00:00">19:00</option>
											<option value="13-20:00:00">20:00</option>
											<option value="14-21:00:00">21:00</option>
											<option value="15-22:00:00">22:00</option>
										</select></td>

									<td><select  name="seg2" class="seg2" id="seg2">
											<option value="1-None">None</option>
											<option value="2-10:00:00">10:00</option>
											<option value="3-11:00:00">11:00</option>
											<option value="4-12:00:00">12:00</option>
											<option value="5-13:00:00">13:00</option>
											<option value="6-14:00:00">14:00</option>
											<option value="7-15:00:00">15:00</option>
											<option value="8-16:00:00">16:00</option>
											<option value="9-17:00:00">17:00</option>
											<option value="10-18:00:00">18:00</option>
											<option value="11-19:00:00">19:00</option>
											<option value="12-20:00:00">20:00</option>
											<option value="13-21:00:00">21:00</option>
											<option value="14-22:00:00">22:00</option>
											<option value="15-23:00:00">23:00</option>
										</select></td>
									<td>
										<p id="segunda_atual">N/A</p>
									</td>
								</tr>
								<tr>
									<th scope="row" >Terça</th>
									
									<td><select  name="ter1" class="ter1" id="ter1">
											<option value="1-None">None</option>
											<option value="2-09:00:00">09:00</option>
											<option value="3-10:00:00">10:00</option>
											<option value="4-11:00:00">11:00</option>
											<option value="5-12:00:00">12:00</option>
											<option value="6-13:00:00">13:00</option>
											<option value="7-14:00:00">14:00</option>
											<option value="8-15:00:00">15:00</option>
											<option value="9-16:00:00">16:00</option>
											<option value="10-17:00:00">17:00</option>
											<option value="11-18:00:00">18:00</option>
											<option value="12-19:00:00">19:00</option>
											<option value="13-20:00:00">20:00</option>
											<option value="14-21:00:00">21:00</option>
											<option value="15-22:00:00">22:00</option>
											
										</select></td>
										<td><select  name="ter2" class="ter2" id="ter2">
											<option value="1-None">None</option>
											<option value="2-10:00:00">10:00</option>
											<option value="3-11:00:00">11:00</option>
											<option value="4-12:00:00">12:00</option>
											<option value="5-13:00:00">13:00</option>
											<option value="6-14:00:00">14:00</option>
											<option value="7-15:00:00">15:00</option>
											<option value="8-16:00:00">16:00</option>
											<option value="9-17:00:00">17:00</option>
											<option value="10-18:00:00">18:00</option>
											<option value="11-19:00:00">19:00</option>
											<option value="12-20:00:00">20:00</option>
											<option value="13-21:00:00">21:00</option>
											<option value="14-22:00:00">22:00</option>
											<option value="15-23:00:00">23:00</option>
										</select></td>
										<td>
											<p id="terca_atual">N/A</p>
										</td>
								</tr>
								<tr>
									<th scope="row">Quarta</th>
									
									<td><select  name="qua1" class="qua1" id="qua1">
											<option value="1-None">None</option>
											<option value="2-09:00:00">09:00</option>
											<option value="3-10:00:00">10:00</option>
											<option value="4-11:00:00">11:00</option>
											<option value="5-12:00:00">12:00</option>
											<option value="6-13:00:00">13:00</option>
											<option value="7-14:00:00">14:00</option>
											<option value="8-15:00:00">15:00</option>
											<option value="9-16:00:00">16:00</option>
											<option value="10-17:00:00">17:00</option>
											<option value="11-18:00:00">18:00</option>
											<option value="12-19:00:00">19:00</option>
											<option value="13-20:00:00">20:00</option>
											<option value="14-21:00:00">21:00</option>
											<option value="15-22:00:00">22:00</option>
										</select></td>
										<td><select  name="qua2" class="qua2" id="qua2">
											<option value="1-None">None</option>
											<option value="2-10:00:00">10:00</option>
											<option value="3-11:00:00">11:00</option>
											<option value="4-12:00:00">12:00</option>
											<option value="5-13:00:00">13:00</option>
											<option value="6-14:00:00">14:00</option>
											<option value="7-15:00:00">15:00</option>
											<option value="8-16:00:00">16:00</option>
											<option value="9-17:00:00">17:00</option>
											<option value="10-18:00:00">18:00</option>
											<option value="11-19:00:00">19:00</option>
											<option value="12-20:00:00">20:00</option>
											<option value="13-21:00:00">21:00</option>
											<option value="14-22:00:00">22:00</option>
											<option value="15-23:00:00">23:00</option>
										</select></td>

										<td>
											<p id="quarta_atual">N/A</p>
										</td>
								</tr>
								<tr>
									<th scope="row">Quinta</th>
									
									<td><select  name="qui1" class="qui1" id="qui1">
											<option value="1-None">None</option>
											<option value="2-09:00:00">09:00</option>
											<option value="3-10:00:00">10:00</option>
											<option value="4-11:00:00">11:00</option>
											<option value="5-12:00:00">12:00</option>
											<option value="6-13:00:00">13:00</option>
											<option value="7-14:00:00">14:00</option>
											<option value="8-15:00:00">15:00</option>
											<option value="9-16:00:00">16:00</option>
											<option value="10-17:00:00">17:00</option>
											<option value="11-18:00:00">18:00</option>
											<option value="12-19:00:00">19:00</option>
											<option value="13-20:00:00">20:00</option>
											<option value="14-21:00:00">21:00</option>
											<option value="15-22:00:00">22:00</option>
											
										</select></td>
										<td><select  name="qui2" class="qui2" id="qui2">
											<option value="1-None">None</option>
											<option value="2-10:00:00">10:00</option>
											<option value="3-11:00:00">11:00</option>
											<option value="4-12:00:00">12:00</option>
											<option value="5-13:00:00">13:00</option>
											<option value="6-14:00:00">14:00</option>
											<option value="7-15:00:00">15:00</option>
											<option value="8-16:00:00">16:00</option>
											<option value="9-17:00:00">17:00</option>
											<option value="10-18:00:00">18:00</option>
											<option value="11-19:00:00">19:00</option>
											<option value="12-20:00:00">20:00</option>
											<option value="13-21:00:00">21:00</option>
											<option value="14-22:00:00">22:00</option>
											<option value="15-23:00:00">23:00</option>
										</select></td>

										<td>
											<p id="quinta_atual">N/A</p>
										</td>
								</tr>
								<tr>
									<th scope="row">Sexta</th>
									
									<td><select  name="sex1" class="sex1" id="sex1">
											<option value="1-None">None</option>
											<option value="2-09:00:00">09:00</option>
											<option value="3-10:00:00">10:00</option>
											<option value="4-11:00:00">11:00</option>
											<option value="5-12:00:00">12:00</option>
											<option value="6-13:00:00">13:00</option>
											<option value="7-14:00:00">14:00</option>
											<option value="8-15:00:00">15:00</option>
											<option value="9-16:00:00">16:00</option>
											<option value="10-17:00:00">17:00</option>
											<option value="11-18:00:00">18:00</option>
											<option value="12-19:00:00">19:00</option>
											<option value="13-20:00:00">20:00</option>
											<option value="14-21:00:00">21:00</option>
											<option value="15-22:00:00">22:00</option>
											
										</select></td>
										<td><select  name="sex2" class="sex2" id="sex2">
											<option value="1-None">None</option>
											<option value="2-10:00:00">10:00</option>
											<option value="3-11:00:00">11:00</option>
											<option value="4-12:00:00">12:00</option>
											<option value="5-13:00:00">13:00</option>
											<option value="6-14:00:00">14:00</option>
											<option value="7-15:00:00">15:00</option>
											<option value="8-16:00:00">16:00</option>
											<option value="9-17:00:00">17:00</option>
											<option value="10-18:00:00">18:00</option>
											<option value="11-19:00:00">19:00</option>
											<option value="12-20:00:00">20:00</option>
											<option value="13-21:00:00">21:00</option>
											<option value="14-22:00:00">22:00</option>
											<option value="15-23:00:00">23:00</option>
										</select></td>

										<td>
											<p id="sexta_atual">N/A</p>
										</td>
								</tr>
								<tr>
									<th scope="row">Sábado</th>
									
									<td><select  name="sab1" class="sab1" id="sab1">
											<option value="1-None">None</option>
											<option value="2-09:00:00">09:00</option>
											<option value="3-10:00:00">10:00</option>
											<option value="4-11:00:00">11:00</option>
											<option value="5-12:00:00">12:00</option>
											<option value="6-13:00:00">13:00</option>
											<option value="7-14:00:00">14:00</option>
											<option value="8-15:00:00">15:00</option>
											<option value="9-16:00:00">16:00</option>
											<option value="10-17:00:00">17:00</option>
											<option value="11-18:00:00">18:00</option>
											<option value="12-19:00:00">19:00</option>
											<option value="13-20:00:00">20:00</option>
											<option value="14-21:00:00">21:00</option>
											<option value="15-22:00:00">22:00</option>
											
										</select></td>
										<td><select  name="sab2" class="sab2" id="sab2">
											<option value="1-None">None</option>
											<option value="2-10:00:00">10:00</option>
											<option value="3-11:00:00">11:00</option>
											<option value="4-12:00:00">12:00</option>
											<option value="5-13:00:00">13:00</option>
											<option value="6-14:00:00">14:00</option>
											<option value="7-15:00:00">15:00</option>
											<option value="8-16:00:00">16:00</option>
											<option value="9-17:00:00">17:00</option>
											<option value="10-18:00:00">18:00</option>
											<option value="11-19:00:00">19:00</option>
											<option value="12-20:00:00">20:00</option>
											<option value="13-21:00:00">21:00</option>
											<option value="14-22:00:00">22:00</option>
											<option value="15-23:00:00">23:00</option>
										</select></td>
										<td>
											<p id="sabado_atual">N/A</p>
										</td>
								</tr>
								<tr>
									<th scope="row">Domingo</th>
									
									<td><select  name="dom1" class="dom1" id="dom1">
											<option value="1-None">None</option>
											<option value="2-09:00:00">09:00</option>
											<option value="3-10:00:00">10:00</option>
											<option value="4-11:00:00">11:00</option>
											<option value="5-12:00:00">12:00</option>
											<option value="6-13:00:00">13:00</option>
											<option value="7-14:00:00">14:00</option>
											<option value="8-15:00:00">15:00</option>
											<option value="9-16:00:00">16:00</option>
											<option value="10-17:00:00">17:00</option>
											<option value="11-18:00:00">18:00</option>
											<option value="12-19:00:00">19:00</option>
											<option value="13-20:00:00">20:00</option>
											<option value="14-21:00:00">21:00</option>
											<option value="15-22:00:00">22:00</option>
											
										</select></td>
										<td><select  name="dom2" class="dom2" id="dom2">
											<option value="1-None">None</option>
											<option value="2-10:00:00">10:00</option>
											<option value="3-11:00:00">11:00</option>
											<option value="4-12:00:00">12:00</option>
											<option value="5-13:00:00">13:00</option>
											<option value="6-14:00:00">14:00</option>
											<option value="7-15:00:00">15:00</option>
											<option value="8-16:00:00">16:00</option>
											<option value="9-17:00:00">17:00</option>
											<option value="10-18:00:00">18:00</option>
											<option value="11-19:00:00">19:00</option>
											<option value="12-20:00:00">20:00</option>
											<option value="13-21:00:00">21:00</option>
											<option value="14-22:00:00">22:00</option>
											<option value="15-23:00:00">23:00</option>
										</select></td>
										<td>
											<p id="domingo_atual">N/A</p>
										</td>
								</tr>
							</tbody>
						</table>
						<button type="submit" name="save_select" class="btn btn-primary guardar">Guardar Alterações</button>
					</form>

					<script>
						// POR AS NECESSIDADES ATUAIS
						<?php 
							$str_final = "";

							foreach($disponibilidades_voluntario as $vol){
								$str_final .= implode($vol, '-'). " ";
							}
						?>

						let arr = <?php echo json_encode($str_final); ?>;
						let disps = arr.split(" ");
						for (let i = 0; i < disps.length - 1; i++){
							let horario = disps[i].split("-");
							console.log(horario);

							if (horario[0] == "Segunda"){
								console.log("entrou");
								$('#segunda_atual').html(horario[1] + ' - ' + horario[2]);
							}else if (horario[0] == "Terca"){
								$('#terca_atual').html(horario[1] + ' - ' + horario[2]);
							}else if (horario[0] == "Quarta"){
								$('#quarta_atual').html(horario[1] + ' - ' + horario[2]);
							}else if (horario[0] == "Quinta"){
								$('#quinta_atual').html(horario[1] + ' - ' + horario[2]);
							}else if (horario[0] == "Sexta"){
								$('#sexta_atual').html(horario[1] + ' - ' + horario[2]);
							}else if (horario[0] == "Sabado"){
								$('#sabado_atual').html(horario[1] + ' - ' + horario[2]);
							}else if (horario[0] == "Domingo"){
								$('#domingo_atual').html(horario[1] + ' - ' + horario[2]);
							}
						}
					</script>

					<hr>
						<div class="px-1 py-1 my-3 text-center">
							<h2 class="display-5 fw-bold">Instituições Disponíveis:</h2>
						</div>
						<div id="instituicoesParceiras">
									<table class="table">
										<thead class="thead-dark">
											<tr>
												<th scope="col">Status</th>
												<th scope="col">Instituição</th>
												<th scope="col">Doação</th>
												<th scope="col">Dia</th>
												<th scope="col">Morada</th>
												<th scope="col">Hora de Início da Recolha</th>
												<th scope="col">Hora de Fim da Recolha</th>
												<th scope="col">Afiliar-se</th>
												<th scope="col">Disponibilidade</th>
												<th scope = "col"> Enviar mensagem</th>
											</tr>
										</thead>
										<tbody>
										<script>
											// console.log(<?= json_encode($encontrados); ?>);
										</script>
										<?php 
											if(count($encontrados) == 0){
											
												echo "<tr>";
												echo "<td> N/A </td>";
												echo "<td> N/A </td>";
												echo "<td> N/A </td>";
												echo "<td> N/A </td>";
												echo "<td> N/A </td>";
												echo "<td> N/A </td>";
												echo "<td> N/A </td>";
												echo "</tr>";
											
											}
											else{
					
												foreach($encontrados as $e){
													if($e["hora_ini"] == "None"){}
													else{
														echo "<tr>";
														$email_instituicao = preg_replace('/[@.;" "]+/', '', $e["email"]);
														echo "<td><span id='user_grid_" . $email_instituicao. "' ></span></td>";
														echo "<td>". $e["nome"] ."</td>";
														echo "<td>". $e["doacao"] ."</td>";
														echo "<td>". $e["dia"] ."</td>";
														echo "<td>". $e["morada"] ."</td>";
														echo "<td>". $e["hora_ini"] ."</td>";
														echo "<td>". $e["hora_fim"] ."</td>";
														echo "<td><button type='button' id='btn_inscrever_" . $e["id"] . "' class='btn' onclick='serParceiro(". $e["id"] .")'></button></td>";
														echo "<td><span id='getDisp_" . $e["id"] . "' ></span></td>";
														$r = $e['email'];
														echo "<td><button type='button' id='btn_msg' class='btn btn-success' value= '". $r ."' onclick='redirecionaParaVoluntario(this.value)'>Mensagem</button></td>";
														echo "</tr>";
													}
												}
											}
										?>
										</tbody>
									</table>
							</div>
				</div>
			</div>
		</div>
	</div>
	
	


</body>

</html>

<style>
    .dashboard{
        margin-top: 150px;
    }

	.hidd {
		display: none;
	}

</style>

<script>
$('.seg1').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.seg2 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) < val)
		})
	});

	$('.seg2').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.seg1 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) > val)
		})
	});
//Terca==================
	$('.ter1').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.ter2 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) < val)
		})
	});

	$('.ter2').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.ter1 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) > val)
		})
	});
//Quarta==================
	$('.qua1').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.qua2 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) < val)
		})
	});

	$('.qua2').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.qua1 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) > val)
		})
	});
//Quinta==================
	$('.qui1').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.qui2 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) < val)
		})
	});

	$('.qui2').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.qui1 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) > val)
		})
	});

//Sexta==================
	$('.sex1').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.sex2 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) < val)
		})
	});

	$('.sex2').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.sex1 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) > val)
		})
	});

//Sexta==================
$('.sex1').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.sex2 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) < val)
		})
	});

	$('.sex2').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.sex1 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) > val)
		})
	});

//Sábado==================
$('.sab1').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.sab2 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) < val)
		})
	});

	$('.sab2').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.sab1 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) > val)
		})
	});

//Domingo==================
$('.dom1').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.dom2 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) < val)
		})
	});

	$('.dom2').on('change', function() {
		let val = Number($(this).val().split("-")[0]);
		$('.dom1 option').each(function() {
			$(this).prop('disabled', Number($(this).val().split("-")[0]) > val)
		})
	});

</script>
