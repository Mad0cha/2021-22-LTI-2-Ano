<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cria a ligação à BD
$mysqli = new mysqli("appserver-01.alunos.di.fc.ul.pt", "asw14", "grupo14asw", "asw14") or die(mysqli_error($mysqli));
// Verifica a ligação à BD
if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
}

//==========Valores default======================
$cc = '';
$update = false;
$nome = '';
$nascimento = '';
$carta = '';
$genero = '';
$email = '';
$passwd = '';
$telefone = '';
$concelho = '';
$freguesia = '';
$distrito = '';

#==============================Inserir novos dados=====================================
if (isset($_POST['save'])){
    $cc = $_POST['cc'];
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $carta = $_POST['carta'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $passwd = password_hash($_POST["passwd"], PASSWORD_DEFAULT);
    $telefone = $_POST['telefone'];
    $concelho = $_POST['concelho'];
    $freguesia = $_POST['freguesia'];
    $distrito = $_POST['distrito'];

    $mysqli->query("INSERT INTO voluntario (cc, nome, nascimento, carta, genero, email, passwd, telefone, concelho, freguesia, distrito) VALUES ('$cc', '$nome', '$nascimento', '$carta', '$genero', '$email', '$passwd','$telefone', '$concelho', '$freguesia', '$distrito')") or
            die($mysqli->error);
    
    $_SESSION['message'] = "Dados salvos com sucesso";
    $_SESSION['msg_type'] = "success";

    header("location: admin.php");
}

#==============================Eliminar dados=====================================
if (isset($_GET['delete'])){
    $cc = $_GET['delete'];
  

    $mysqli->query("DELETE FROM voluntario WHERE cc=$cc") or die($mysqli->error());

    $_SESSION['message'] = "Dados eliminados";
    $_SESSION['msg_type'] = "danger";

    header("location: admin.php");     
}

#==============================Editar dados=====================================
//Adicionar aos campos quando se clica edit
if (isset($_GET['edit'])){
    $cc = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM voluntario WHERE cc=$cc") or die($mysqli->error());
    //verificar que o registo a editar existe
    if (count($result)==1){
        $row = $result->fetch_array();
        $nome = $row['nome'];
        $nascimento = $row['nascimento'];
        $carta = $row['carta'];
        $genero = $row['genero'];
        $email = $row['email'];
        $telefone = $row['telefone'];
        $concelho = $row['concelho'];
        $freguesia = $row['freguesia'];
        $distrito = $row['distrito'];
    }      
}

#==============================Editar dados=====================================

if (isset($_POST['update'])){
    $cc = $_POST['cc'];
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $carta = $_POST['carta'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $concelho = $_POST['concelho'];
    $freguesia = $_POST['freguesia'];
    $distrito = $_POST['distrito'];
    
    $mysqli->query("UPDATE voluntario SET cc='$cc', nome='$nome', nascimento='$nascimento', carta='$carta', genero='$genero', email='$email', telefone='$telefone', concelho='$concelho', freguesia='$freguesia', distrito='$distrito' WHERE cc=$cc") or
        die($mysqli->error);
     
    $_SESSION['message'] = "Dados atualizados com sucesso";
    $_SESSION['msg_type'] = "warning";

    header("location: admin.php");
}

// ============================================================================

?>
