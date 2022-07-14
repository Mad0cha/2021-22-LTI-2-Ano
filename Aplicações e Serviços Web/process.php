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
$cc = '';
$update = false;
$nome = '';
$nascimento = '';
$carta = '';
$genero = '';
$email = '';
$telefone = '';
$concelho = '';
$freguesia = '';
$distrito = '';




#==============================Verificar se Edit é true=====================================

if (isset($_GET['edit'])){
    $cc = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM voluntario WHERE cc=$cc") or die($mysqli->error);
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
    
    // $mysqli->query("UPDATE voluntario SET nome='$nome', nascimento='$nascimento', cc='$cc' WHERE cc=$cc") or 
    $mysqli->query("UPDATE voluntario SET nome='$nome', nascimento='$nascimento', carta='$carta', genero='$genero', email='$email', telefone='$telefone', concelho='$concelho', freguesia='$freguesia', distrito='$distrito' WHERE cc=$cc") or
        die($mysqli->error);
     
    $_SESSION['message'] = "Dados atualizados com sucesso";
    $_SESSION['msg_type'] = "warning";


    header("location: area_user.php");
}


?>
