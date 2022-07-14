<?php

include('../online/database.inc.php');

session_start();
// $info = 
// $pk = $_REQUEST["q"];
// $inst = "";
if($_SESSION["tipo_login"] == "instituicao"){
	$infos = $_POST["id"];
	$pk = explode("/", $infos)[0];
	$email_inst = explode("/", $infos)[1];
	$query=mysqli_query($con,"SELECT * FROM disp_voluntario WHERE id=$pk");
}
else if($_SESSION["tipo_login"] == "voluntario"){
	$pk = $_REQUEST["q"];
	$query=mysqli_query($con,"SELECT * FROM disp_instituicao WHERE id=$pk");
}

$html='';
while($row = $query-> fetch_assoc()){
	$disp = $row["disponibilidade"];

	$dia_vol = $row["dia"];
	$hora_ini_vol = $row["hora_ini"];
	$hora_fim_vol = $row["hora_fim"];

	if ($_SESSION["tipo_login"] == "instituicao" && $disp == 'livre'){
		$query2=mysqli_query($con,"SELECT * FROM disp_instituicao WHERE dia = '$dia_vol' AND hora_ini = '$hora_ini_vol' AND hora_fim = '$hora_fim_vol' AND email = '$email_inst'");
		while($row2 = $query2-> fetch_assoc()){
			if ($row2["disponibilidade"] == 'livre'){
				$disp_inst = "disponivel";
			}else{
				$disp_inst = "indisponivel";
			}
		}
		$html.= $pk. "-" .$disp . "-" . $disp_inst .'/';
	}else{
		$html.= $pk. "-" .$disp . '/';
	}

	// $html.= $pk. "-" .$disp . '/';

}
echo $html;
?>