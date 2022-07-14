<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Cria a ligação à BD
$mysqli = new mysqli("appserver-01.alunos.di.fc.ul.pt", "asw14", "grupo14asw", "asw14") or die(mysqli_error($mysqli));
// Verifica a ligação à BD
if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
}

//==========Valores default======================
$edit = true;
$email = '';
$update = false;
$nome = '';
$tipo = '';
$descricao = '';
$telefone = '';
$concelho = '';
$freguesia = '';
$distrito = '';
$nome_cont = '';
$tel_cont = '';

#==============================Verificar se Edit é true=====================================

if (isset($_GET['edit'])){
    $email = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM instituicao WHERE email='$email'") or die($mysqli->error);
    //verificar que o registo a editar existe
    if (count($result)==1){
        $row = $result->fetch_array();
        $nome = $row['nome'];
        $tipo = $row['tipo'];
        $descricao = $row['descricao'];
        $telefone = $row['telefone'];
        $concelho = $row['concelho'];
        $freguesia = $row['freguesia'];
        $distrito = $row['distrito'];
        $nome_cont = $row['nome_cont'];
        $tel_cont = $row['tel_cont'];
    }     
}

#==============================Editar dados=====================================

if (isset($_POST['update'])){
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $tipo_doacoes = $_POST['tipo_doacoes'];
    $descricao = $_POST['descricao'];
    $telefone = $_POST['telefone'];
    $concelho = $_POST['concelho'];
    $freguesia = $_POST['freguesia'];
    $distrito = $_POST['distrito'];
    $nome_cont = $_POST['nome_cont'];
    $tel_cont = $_POST['tel_cont'];
   
    
    $mysqli->query("UPDATE instituicao SET nome='$nome', tipo='$tipo, $tipo_doacoes', descricao='$descricao', telefone='$telefone', concelho='$concelho', freguesia='$freguesia', distrito='$distrito', nome_cont='$nome_cont', tel_cont='$tel_cont' WHERE email='$email'") or
        die($mysqli->error);
     
    $_SESSION['message'] = "Dados atualizados com sucesso";
    $_SESSION['msg_type'] = "warning";

    header("location: area_instituicao.php");
}
?>