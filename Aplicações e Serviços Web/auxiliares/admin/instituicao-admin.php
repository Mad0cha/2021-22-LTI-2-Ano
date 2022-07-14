<?php

$q = $_REQUEST["q"];
$dbhost = "appserver-01.alunos.di.fc.ul.pt";
$dbuser = "asw14";
$dbpass = "grupo14asw";
$dbname = "asw14";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_error()) {
    die("Database connection failed:".mysqli_connect_error());
}

$query2 = "SELECT nome, tipo, descricao, email, telefone, concelho, freguesia, distrito, nome_cont, tel_cont
FROM instituicao";


$dados_instituicao = array();
$res2 = mysqli_query($conn, $query2);
while ($row = mysqli_fetch_assoc($res2)) {
    $b['nome'] = $row["nome"];
    $b['tipo'] = $row["tipo"];
    $b['descricao'] = $row["descricao"];
    $b['email'] = $row["email"];
    $b['telefone'] = $row["telefone"];
    $b['concelho'] = $row["concelho"];
    $b['freguesia'] = $row["freguesia"];
    $b['distrito'] = $row["distrito"];
    $b['nome_cont'] = $row["nome_cont"];
    $b['tel_cont'] = $row["tel_cont"];
    $b['horario'] = 'Horario ainda não definido';

    $dados_instituicao[] = $b;
}

$query3 = "SELECT email, dia, hora_ini, hora_fim FROM disp_instituicao";


$disp_instituicao = array();
$horarios = array();
$instituicoes = array();
$res3 = mysqli_query($conn, $query3);
while ($linha = mysqli_fetch_assoc($res3)) {
    
    if ( !in_array($linha['email'], $inst)) {
        $c['email'] = $linha['email'];

        if ($linha["dia"] == "Segunda") {
            if($linha["hora_ini"] == None){
                $c['segunda'] = 'Indisponível';
            } else {
                $c['segunda'] = 'Disponível das ' . substr($linha["hora_ini"],0,5) . 'h, às ' . substr($linha["hora_fim"],0,5) . 'h';
            }
        } elseif ($linha["dia"] == "Terca") {
            if($linha["hora_ini"] == None){
                $c['terca'] = 'Indisponível';
            } else {
                $c['terca'] = 'Disponível das ' . substr($linha["hora_ini"],0,5) . 'h, às ' . substr($linha["hora_fim"],0,5) . 'h';
            }
        } elseif ($linha["dia"] == "Quarta") {
            if($linha["hora_ini"] == None){
                $c['quarta'] = 'Indisponível';
            } else {
                $c['quarta'] = 'Disponível das ' . substr($linha["hora_ini"],0,5) . 'h, às ' . substr($linha["hora_fim"],0,5) . 'h';
            }
        } elseif ($linha["dia"] == "Quinta") {
            if($linha["hora_ini"] == None){
                $c['quinta'] = 'Indisponível';
            } else {
                $c['quinta'] = 'Disponível das ' . substr($linha["hora_ini"],0,5) . 'h, às ' . substr($linha["hora_fim"],0,5) . 'h';
            }
        } elseif ($linha["dia"] == "Sexta") {
            if($linha["hora_ini"] == None){
                $c['sexta'] = 'Indisponível';
            } else {
                $c['sexta'] = 'Disponível das ' . substr($linha["hora_ini"],0,5) . 'h, às ' . substr($linha["hora_fim"],0,5) . 'h';
            }
        } elseif ($linha["dia"] == "Sabado") {
            if($linha["hora_ini"] == None){
                $c['sabado'] = 'Indisponível';
            } else {
                $c['sabado'] = 'Disponível das ' . substr($linha["hora_ini"],0,5) . 'h, às ' . substr($linha["hora_fim"],0,5) . 'h';
            }
        } elseif ($linha["dia"] == "Domingo") {
            if($linha["hora_ini"] == None){
                $c['domingo'] = 'Indisponível';
            } else {
                $c['domingo'] = 'Disponível das ' . substr($linha["hora_ini"],0,5) . 'h, às ' . substr($linha["hora_fim"],0,5) . 'h';
            }
        }
    
        $horarios[] = $c;
    }

    if (count($c) % 8 == 0) {
        array_push($instituicoes, $linha["email"]);
    }
}

if ($res3) {
    // echo "sucesso";
} else {
    echo "Erro: failed" . $query . " | " . mysqli_error($conn);
}

// Termina a ligação com a base de dados
mysqli_close($conn);

$horarios = array_slice($horarios,6);

$a = $dados_instituicao;
for ($x = 0; $x < count($a); $x++) {
    for ($y = 0; $y < count($horarios); $y++) {
        if ($a[$x]["email"] == $horarios[$y]["email"]) {
            $dados_instituicao[$x]["horario"] = array_slice($horarios[$y], 1);
        }
    }
}

$json_data['instituicao'] = $dados_instituicao;

echo json_encode($json_data, JSON_UNESCAPED_UNICODE);
?>
