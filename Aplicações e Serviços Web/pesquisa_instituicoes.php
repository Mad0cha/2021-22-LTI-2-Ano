<?php // query do VOLUNTARIO
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
									<button class="btn btn-primary">Mensagem</button>
								</div>
							</div>
							<hr class="my-4">

							<div class="align-items-center text-center">
                                <i class='fas fa-arrow-left'></i>
								<a href="area_user.php" class="h5">Área do utilizador</a>
							</div>
						
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
						<?php include "auxiliares/abreconexao.php";; ?>
		
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

            <script>
                $(document).ready(function() {
                   
                    $("#dist_conc_nome").prop('required',true);
                    $('#input_necessidade_1').hide();
                    $('#input_necessidade_2').hide();
                    $('#input_necessidade_3').hide();
                    $('#escolha').change(function() {
                        if ($('#escolha').val() == 'Concelho' || $('#escolha').val() == 'Distrito' || $('#escolha').val() == 'Nome') {
                        $('#input_dist_conc_nome').show();
                        $("#dist_conc_nome").prop('required',true);
                        } else {
                        $('#input_dist_conc_nome').hide();
                        $("#dist_conc_nome").prop('required',false);
                        }

                        if ($('#escolha').val() == 'Necessidade'){

                            $('#input_necessidade_1').show();
                            $('#input_necessidade_2').show();
                            $('#input_necessidade_3').show();
                            $("#dia").prop('required',true);
                            $("#hora_ini").prop('required',true);
                            $("#hora_fim").prop('required',true);
                        }else{
                            $('#input_necessidade_1').hide();
                            $('#input_necessidade_2').hide();
                            $('#input_necessidade_3').hide();
                            $("#dia").prop('required',false);
                            $("#hora_ini").prop('required',false);
                            $("#hora_fim").prop('required',false);
                        }
                    });
                });
            </script>

            <form action="auxiliares/formulario_pesquisa_instituicao.php" method="post">

            <p>Selecione o critério de pesquisa:</p>

                <div class="form-row">
                    <select id="escolha" name="escolha">
                        <option value="Concelho" selected>Concelho</option>
                        <option value="Distrito">Distrito</option>
                        <option value="Nome">Nome</option>
                        <option value="Necessidade">Necessidade</option>
                    </select>
                </div>

                <div class="form-input mt-2" id = "input_dist_conc_nome">
                    <input type="text" name="dist_conc_nome" id="dist_conc_nome">
                </div>

                <div class="form-input mt-2" id = "input_necessidade_1">
                    <label for="descricao" class="required">Dia da Semana: </label>
                    <input type="text" name="dia" id="dia" placeholder = "Ex: Segunda, Terça...">
                </div>
                <div class="form-input mt-2" id = "input_necessidade_2">
                    <label for="descricao" class="required">Hora de inicio: </label>
                    <input type="text" name="hora_ini" id="hora_ini" placeholder = "Ex: 10:00">
                </div>
                <div class="form-input mt-2" id = "input_necessidade_3">
                    <label for="descricao" class="required">Hora de fim: </label>
                    <input type="text" name="hora_fim" id="hora_fim" placeholder = "Ex: 11:00">
                </div>

                <div class="form-submit mt-2">
                    <input type="submit" value="Pesquisar" class="submit btn-primary" id="submit" name="submit" />
                  
                </div>
            </form>
        </div>

        <?php
        
            if (isset($_SESSION["filtros"])){

                if ($_SESSION['tipo_filtro'] == "Necessidade"){

                ?>
                  <div class = "container mt-5">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Instituição</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Dia</th>
                                <th scope="col">Hora de Início da Recolha</th>
                                <th scope="col">Hora de Fim da Recolha</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Pessoa responsável</th>
                                <th scope="col">Telefone da pessoa responsável</th>
                                <th scope="col">Distrito</th>
                                <th scope="col">Concelho</th>
                                <th scope="col">Morada</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            foreach($_SESSION["filtros"] as $e){
                                echo "<tr>";
                                echo "<td>". $e["nome"] ."</td>";
                                echo "<td>". $e["tipo"] ."</td>";
                                echo "<td>". $e["dia"] ."</td>";
                                echo "<td>". $e["hora_ini"] ."</td>";
                                echo "<td>". $e["hora_fim"] ."</td>";
                                echo "<td>". $e["email"] ."</td>";
                                echo "<td>". $e["telefone"] ."</td>";
                                echo "<td>". $e["nome_cont"] ."</td>";
                                echo "<td>". $e["tel_cont"] ."</td>";
                                echo "<td>". $e["distrito"] ."</td>";
                                echo "<td>". $e["concelho"] ."</td>";
                                echo "<td>". $e["morada"] ."</td>";
                                echo "</tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                  </div>

                <?php
                }else if ($_SESSION['tipo_filtro'] == "Nome"){
                ?>
                 <div class = "container mt-5">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">Instituição</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Pessoa responsável</th>
                                <th scope="col">Telefone da pessoa responsável</th>
                                <th scope="col">Distrito</th>
                                <th scope="col">Concelho</th>
                                <th scope="col">Morada</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            foreach($_SESSION["filtros"] as $e){
                                echo "<tr>";
                                echo "<td>". $e["nome"] ."</td>";
                                echo "<td>". $e["tipo"] ."</td>";
                                echo "<td>". $e["email"] ."</td>";
                                echo "<td>". $e["telefone"] ."</td>";
                                echo "<td>". $e["nome_cont"] ."</td>";
                                echo "<td>". $e["tel_cont"] ."</td>";
                                echo "<td>". $e["distrito"] ."</td>";
                                echo "<td>". $e["concelho"] ."</td>";
                                echo "<td>". $e["morada"] ."</td>";
                                echo "</tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                  </div>
                <?php
                }else{
                ?>

                  <div class = "container mt-5">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Instituição</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Pessoa responsável</th>
                                <th scope="col">Telefone da pessoa responsável</th>
                                <th scope="col">Morada</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            foreach($_SESSION["filtros"] as $e){
                                echo "<tr>";
                                echo "<td>". $e["nome"] ."</td>";
                                echo "<td>". $e["tipo"] ."</td>";
                                echo "<td>". $e["email"] ."</td>";
                                echo "<td>". $e["telefone"] ."</td>";
                                echo "<td>". $e["nome_cont"] ."</td>";
                                echo "<td>". $e["tel_cont"] ."</td>";
                                echo "<td>". $e["morada"] ."</td>";
                                echo "</tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                  </div>
                <?php
                }
            }
            unset($_SESSION['filtros']);
            unset($_SESSION['tipo_filtro']);
        ?>        