<?php
$dados = $_POST["dados"];
print_r($dados);

require_once "lib/nusoap.php";
$client = new nusoap_client(
	'http://appserver-01.alunos.di.fc.ul.pt/~asw14/projeto2/servidor/ws_recolha_serv.php'
);

$error = $client->getError();
$result = $client->call('VolRecolhaDoacao', array('id' => $dados[0], 'id_user' => $dados[1], 'id_doacao' => $dados[2]));	//handle errors

if ($client->fault)
{	//check faults
}
else
{	$error = $client->getError();	//handle errors
	echo "<h2>O resultado é: </h2>".$result;
}

// echo "<h2>Pedido</h2>";
// echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
// echo "<h2>Resposta</h2>";
// echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";
?>