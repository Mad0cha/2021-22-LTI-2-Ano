<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('database.inc.php');

$voluntarios = '(' .$_POST['hashString'] . ')'; 

session_start();

if ($_SESSION["tipo_login"] == "voluntario"){
	$res=mysqli_query($con,"select * from instituicao where email in $voluntarios");
	
}else if($_SESSION["tipo_login"] == "instituicao"){
	$res=mysqli_query($con,"select * from voluntario where cc in $voluntarios");
}

$time=time() - 3;

$html='';
while($row=mysqli_fetch_assoc($res)){
	$status='Offline';
	$class="btn-danger";
	if($row['ultimo_login']>$time){
		$status='Online';
		$class="btn-success";
	}

	if ($_SESSION["tipo_login"] == "voluntario"){
		$html.= $row["email"]."-" .$status . '/';
		
	}else if($_SESSION["tipo_login"] == "instituicao"){
		$html.= $row["cc"]."-" .$status . '/';
	}
}
echo $html;
?>