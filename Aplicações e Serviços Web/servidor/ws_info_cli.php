<?php
$id = $_POST["id"];
$id_user = $_POST["id_user"];

require_once "lib/nusoap.php";
$client = new nusoap_client(
	'http://appserver-01.alunos.di.fc.ul.pt/~asw14/projeto2/servidor/ws_info_serv.php'
);
$error = $client->getError();
$result = $client->call('getInfoInst', array('id' => $id, 'id_user' => $id_user));	//handle errors


if ($client->fault)
{	//check faults
}
else
{	$error = $client->getError();	//handle errors
	$stringSeparada = explode("-", $result);
	$disps = explode("!", $stringSeparada[0]);
}

// echo "<h2>Pedido</h2>";
// echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
// echo "<h2>Resposta</h2>";
// echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>REFOOD UMinho Edition</title>
    <link href="assets/img/brand/icon.png" rel="icon">

    <!-- Font Icon -->
    <link rel="stylesheet" href="../assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../assets/vendor/nouislider/nouislider.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../assets/css/style_registo.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="register-body">

    <div class="main">

        <div class="container">
            <div class="signup-content ">
                <div class="signup-img">
                    <img src="../assets/img/institutions/instituicao.jpg" id ="esq" alt="">
                    <div class="signup-img-content">
                        <h2>Instituição</h2>
                        <p><?php echo $id;?></p>
                    </div>
                </div>
                <div class="signup-form">
                    <form action="ws_recolha_cli.php" enctype="multipart/form-data" method="post" class="register-form" id="register-form">
                      
                        <div class="form-row">
                            <div class="form-group">
                                <?php echo "<h2>Informação sobre a instituição: </h2>".$stringSeparada[1];?>
                            </div>
                        </div>
                        <div class="form-row">   
                            <div class="form-group">
                                <?php
                                    echo "<h2>Dias em que é preciso voluntários: </h2><hr>";
                                    
                                    if(empty($disps[0])){
                                        echo "Esta instituição ainda não definiu horários em que precisa de voluntários";
                                    }
                                    else{
                                        for ($i = 0; $i < count($disps); $i++) {
                                            $indice = $i + 1; 
                                            echo $disps[$i];
                                        }
                                    }                          
                                ?>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/nouislider/nouislider.min.js"></script>
    <script src="assets/vendor/wnumb/wNumb.js"></script>
    <script src="assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="assets/vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="assets/js/main_registo.js"></script>
</body>
</html>

<style>
    .form-row .form-group {
        width: 80%;
    }  

	span{
		font-family: "Open Sans", sans-serif !important;
    	color: #434343 !important;
        font-size:14px;
        font-weight:500;
	}

    hr{
        border-top: 1px solid grey;
    }
</style>