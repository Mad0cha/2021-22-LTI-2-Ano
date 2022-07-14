<?php
require_once "lib/nusoap.php";

function getInfoInst($id, $id_user)
{	
	include "abreconexao.php";

	// Informacao da instituicao
    $query = "SELECT * FROM instituicao WHERE email='$id'";
    $res = mysqli_query($conn, $query);

	while($row = $res-> fetch_assoc()){
		$tipo = $row['tipo'];
		$telefone = $row['telefone'];
		$concelho = $row['concelho'];
		$freguesia = $row['freguesia'];
		$distrito = $row['distrito'];
	}

	$query2 = "SELECT * FROM disp_instituicao WHERE email='$id'";
    $res2 = mysqli_query($conn, $query2);

	$stringDisp = array();

	while($row1 = $res2-> fetch_assoc()){
	
		$idDisp =  $row1['id']; 
		$dia = $row1['dia'];
		$hora_ini = $row1['hora_ini'];
		$hora_fim = $row1['hora_fim'];

		$action = "ws_recolha_cli.php";
		$metodo = "POST";

		array_push($stringDisp, "<h3>Dia: <span>".$dia."</span></h3>
								 <h3>Das: <span>".$hora_ini." </span> 
								 às: <span>".$hora_fim."</span></h3>
								 <form action=".$action." method=".$metodo.">
								 	<input type='hidden' name='dados[]' value='$id'/>
									<input type='hidden' name='dados[]' value='$id_user'/>
									<input type='hidden' name='dados[]' value='$idDisp'/>
								 	<input type = 'submit' class='submit' value='aceitar'></input>
								 </form>
								 <hr>");
	}
	$disps = implode("!", $stringDisp);
	$inst = "<h3>Tipo de instituição: <span>".$tipo."</span></h3> 
			 <h3>Telefone: <span>".$telefone."</span></h3>
			 <h3>Distrito: <span>".$distrito."</span></h3>
			 <h3>Concelho: <span>".$concelho."</span></h3>
			 <h3>Freguesia: <span>".$freguesia."</span></h3>";
	
	$s = $disps."-".$inst;

	return $s;
}

$server = new soap_server();

$server->configureWSDL('InfoInstDoacoes', 'urn:InfoInstDoacoes');

$server->register("getInfoInst", // nome metodo
	array('id' => 'xsd:string',
	      'id_user' => 'xsd:string'), // input
	array('return' => 'xsd:string'), // output
	'uri:InfoInstDoacoes', // namespace
	'urn:InfoInstDoacoes#getInfoInst', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>
