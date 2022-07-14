<?php
// include('database.inc.php');

// $voluntarios = '(' .$_POST['hashString'] . ')'; 
// session_start();

// $res=mysqli_query($con,"select * from disp_voluntario where id in $voluntarios");

// $html='';
// while($row=mysqli_fetch_assoc($res)){
// 	$status='Disponivel';
// 	$class="btn-success";
// 	if($row['disponibilidade']!=NULL){
// 		$status='Indisponivel';
// 		$class="btn-danger";
// 	}

// 	$html.= $row["cc"]."-" .$status . '/';
	
	
// }
// echo $html;

$q = $_REQUEST["q"];
$dbhost = "appserver-01.alunos.di.fc.ul.pt";
$dbuser = "asw14";
$dbpass = "grupo14asw";
$dbname = "asw14";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_error()) {
    die("Database connection failed:".mysqli_connect_error());
}

$query = "SELECT cc,disponibilidade FROM disp_voluntario";

$dados = array();
$res = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($res)) {

	$a['cc'] = $row['cc'];
	$a['disp'] = $row['disponibilidade'];

	$dados[] = $a;
}

if ($res) {
    // echo "sucesso";
} else {
    echo "Erro: failed " . $query . " | " . mysqli_error($conn);
}

mysqli_close($conn);

echo json_encode($dados, JSON_UNESCAPED_UNICODE);

?>