<?php
require_once "lib/nusoap.php";

function VolRecolhaDoacao($idInst, $idVol, $idDoacao)
{	
	include "abreconexao.php";

	// Vê a disponibilidade da instituicao
	$query2 = "SELECT * FROM disp_instituicao WHERE email='$idInst' AND id='$idDoacao'";
	$res2 = mysqli_query($conn, $query2);

	while($row2 = $res2-> fetch_assoc()){
		$dispInst = $row2['disponibilidade'];
		$diaInst = $row2['dia'];
		$hora_iniInst =  $row2['hora_ini'];
		$hora_fimInst =  $row2['hora_fim'];
	}

	// Vê a disponibilidade do voluntário na base de dados
	$query = "SELECT * FROM disp_voluntario WHERE cc IN    
	(SELECT cc FROM voluntario WHERE email='$idVol' AND dia='$diaInst' AND disponibilidade IS NOT NULL)";
	 	   
	$res = mysqli_query($conn, $query);

	$s = array();

	while($row = $res-> fetch_assoc()){
		$dispVol = $row['disponibilidade'];
		$hora_ini = $row['hora_ini'];
		$hora_fim = $row['hora_fim'];
	
		// Vê se a disponibilidade da instituição
		if(is_null($dispInst)){
			array_push($s, "A instituição ainda não definiu a sua disponibilidade para este dia <br> 
							Não aceite! <br>");
		}
		else{
			// Se as horas forem iguais nas duas partes (match)
			if($hora_ini == $hora_iniInst and $hora_fim == $hora_fimInst){

				array_push($s, "Dia: ".$diaInst. "<br>
								Disponibilidade do voluntário: Das: ".$hora_ini." às ".$hora_fim."<br>
								Disponibilidade da instituição: Das: ".$hora_iniInst." às ".$hora_fimInst."<br>
								Situação do voluntário: ".$dispVol." <br>
								Situação da instituição: ".$dispInst."<br><br>
								Os horários são compatíveis <br>");

				// verifica disponibilidade do utilizador 
				if(strcmp($dispVol, 'livre') == 0){
					array_push($s, "O voluntário ainda tem o horário indicado livre <br>");

					// verifica disponibilidade da instituicao
					if(strcmp($dispInst, 'livre') == 0){
						array_push($s, "A instituição ainda tem o horário indicado livre <br> 
										Aceite!");
					}
					else{
						array_push($s, "A instituição já aceitou outro voluntário para o horário indicado <br>
										Não aceite!");
					}

				}
				else{
					//Verifica se os dois já são match
					if(strpos($dispVol, $idInst) !== false and strpos($dispInst, $idVol) !== false){
						array_push($s, "O voluntário já aceitou este horário nesta instituição <br> 
										Não aceite!");
					}
					else{
						array_push($s, "O voluntário já está ocupado neste horário <br>
									Não Aceite!");
					
					}
				}
			}
			else{
				array_push($s, "Dia:".$diaInst."<br>
								Disponibilidade do voluntário: Das: ".$hora_ini." às ".$hora_fim."<br>
								Disponibilidade da instituição: Das: ".$hora_iniInst." às ".$hora_fimInst."<br>
								Situação do voluntário: ".$dispVol." <br>
								Situação da instituição: ".$dispInst."<br><br>
								Os horários não são compatíveis! <br>
								Não aceite!");
			}
		}
	}
	// Se for null
	if(empty($s)){
		array_push($s, "O voluntário ainda não definiu a sua disponibilidade para este dia");
	}
	return implode(" ",$s);
}

	
$server = new soap_server();

$server->configureWSDL('VolRecolhaDoacao', 'urn:VolRecolhaDoacao');

$server->register("VolRecolhaDoacao", // nome metodo
	array ('id' => 'xsd:string',
		   'id_user' => 'xsd:string',
		   'id_doacao' => 'xsd:string'),  // input
		
	array('return' => 'xsd:string'), // output
	'uri:VolRecolhaDoacao', // namespace
	'urn:VolRecolhaDoacao#getInfoInst', // SOAPAction
	'rpc', // estilo
	'encoded' // uso
);

@$server->service(file_get_contents("php://input"));

?>

