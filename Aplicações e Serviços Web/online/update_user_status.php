<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
include('database.inc.php');

$email = $_SESSION['login'];
$time=time()+3;

var_dump($email);
var_dump($_SESSION);
if ($email){
    if ($_SESSION["tipo_login"] == "voluntario"){
        echo "voluntario";
        $res=mysqli_query($con,"UPDATE voluntario SET ultimo_login=$time WHERE email='$email'");
    }else if($_SESSION["tipo_login"] == "instituicao"){
        echo "instituicao";
        $res=mysqli_query($con,"UPDATE instituicao SET ultimo_login=$time WHERE email='$email'");
    }
}
?>