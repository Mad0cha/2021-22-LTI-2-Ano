<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>REGISTAR - REFOOD FCUL Edition</title>
    <link href="assets/img/brand/icon.png" rel="icon">

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets/vendor/nouislider/nouislider.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/style_registo.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>

<body class="register-body">

    <div class="main">

        <div class="container">
            <div class="signup-content ">
                <div class="signup-img">
                    <img src="assets/img/hero/volunt.jpg" id ="esq" alt="">
                    <div class="signup-img-content">
                        <h2>Regista-te como voluntário </h2>
                        <p>Vem fazer parte desta família</p>
                    </div>
                </div>
                <div class="signup-form">
                    <form action="auxiliares/formulario_voluntario.php" enctype="multipart/form-data" method="post" class="register-form" id="register-form">
                        <div id="div_erros" class="div_erros">
                        </div>    
                        <div class="form-row">
                            <div class="form-group">

                                <div class="form-input">
                                    <label for="first_name" class="required">Primeiro Nome</label> 
                                    <div id="err_2"></div>
                                    <input type="text" name="first_name" id="first_name" />
                                </div>

                                <div class="form-input">
                                    <label for="last_name" class="required">Último Nome</label>
                                    <input type="text" name="last_name" id="last_name" />
                                </div>

                                <div class="form-input">
                                    <label for="birthdayDate" class="required">Data de nascimento</label>
                                    <div id="err_10"></div>
                                    <input type="date" name ="birthdayDate" id="birthdayDate" >
                                </div>

                                <div class="form-input">
                                    <label for="cartao_cidadao" class="required">Cartão de Cidadão</label>
                                    <div id="err_7"></div>
                                    <input type="number" name="cartao_cidadao" id="cartao_cidadao" >
                                </div>

                                <div class="form-input">
                                    <label for="carta_conducao" class="required"> Carta de Condução </label>
                                    <div id="err_8"></div>
                                    <input type="number" name="carta_conducao" id="carta_conducao" >
                                </div>

                                <div class="form-input">
                                    <label for="email" class="required">E-mail</label>
                                    <input type="email" name="email" id="email">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="form-radio">
                                    <div class="label-flex">
                                        <label for="genero" class="required"> Género </label>
                                    </div>
                                    <div class="form-radio-group" name="genero">            
                                        <div class="form-radio-item">
                                            <input type="radio" name="genero" id="feminino" value="F">
                                            <label for="feminino">Feminino</label>
                                            <span class="check"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="genero" id="masculino" value="M">
                                            <label for="masculino">Masculino</label>
                                            <span class="check"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="genero" id="outro" value="O">
                                            <label for="outro">Outro</label>
                                            <span class="check"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-input">
                                    <label for="distrito" class="required">Distrito</label>
                                    <div id="err_3"></div>
                                    <input type="text" name="distrito" id="distrito">
                                </div>

                                <div class="form-input">
                                    <label for="concelho" class="required">Concelho</label>
                                    <div id="err_4"></div>
                                    <input type="text" name="concelho" id="concelho">
                                </div>

                                <div class="form-input">
                                    <label for="freguesia" class="required">Freguesia</label>
                                    <div id="err_5"></div>
                                    <input type="text" name="freguesia" id="freguesia">
                                </div>

                                <div class="form-input">
                                    <label for="telefone" class="required">Telefone</label>
                                    <div id="err_9"></div>
                                    <input type="number" name="telefone" id="telefone" >
                                </div>

                                <div class="form-input">
                                    <label for="pass" class="required">Password</label>
                                    <input type="password" name="pass" id="pass">
                                </div>

                            </div>
                        </div>

                        <div class="form-input d-block mx-auto text-center">
                            <label for="imagem" class="required">Escolha uma fotografia de perfil</label>
                            <div id="err_1"></div>
                            <input  type="file" name="file" id="imagem">
                        </div>

                        <div class="form-submit">
                            <input type="submit" value="Registar" class="submit" id="submit" name="submit" />
                            <input type="submit" value="Cancelar" class="submit" id="cancela" name="cancela" />
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

<?php 
    session_start();
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(strpos($fullUrl,"signup=empty") == true){
        $erros =  $_SESSION['erros'];
        ?>
        <script>
            var php_erros = "<?php echo implode(",", $erros) ?>";
            var php_erros_lista = php_erros.split(',');
            console.log("Erros:",php_erros_lista)

            for (let i = 0; i < php_erros_lista.length; i++) {
                
                if(php_erros_lista[i].length > 1){
                    
                    novo_id = php_erros_lista[i].split('_')[0];
                    descricao = php_erros_lista[i].split('_')[1];
                    var div = 'err_'+novo_id
                    console.log(div)
                }
                else{
        
                    var div = 'err_'+php_erros_lista[i]
                    descricao = 'None'
                }
                
                if(div == 'err_1'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"Apenas a extensão .jpeg é valida"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"A imagem é demasiado grande. O máximo é de 2 MB"+'</p>';
                    }
                }
                else if (div == 'err_2'){
                    document.getElementById(div).innerHTML = '<p style="color:red;">'+"O seu nome não pode conter digitos"+'</p>';
                }
                else if (div == 'err_3'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O distrito não pode conter digitos"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O nome do distrito é demasiado grande. O máximo é de 50 caracteres"+'</p>';
                    }
                }
                else if (div == 'err_4'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O concelho não pode conter digitos"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O nome do concelho é demasiado grande. O máximo é de 50 caracteres"+'</p>';
                    }
                }   
                else if (div == 'err_5'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"A freguesia não pode conter digitos"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O nome da freguesia é demasiado grande. O máximo é de 50 caracteres"+'</p>';
                    }
                }
                else if (div == 'err_6'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O email digitado é demasiado grande. O máximo é de 50 caracteres"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+ "O e-mail digitado já está registado"+'</p>';
                    }
                }
                else if (div == 'err_7'){
                    
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"Tem números a mais no seu cartão de cidadão"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+ "Tem números a menos no seu cartão de cidadão"+'</p>';
                    }
                    else if (descricao == '2'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O cartão de cidadão inserido já está registado"+'</p>';
                    }
                }   
                else if (div == 'err_8'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"Tem números a mais na sua carta de condução"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+ "Tem números a menos na sua carta de condução"+'</p>';
                    }
                }
                else if (div == 'err_9'){
                    if (descricao  == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"Tem números a menos no seu telefone"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+ "Tem números a mais no seu telefone"+'</p>';
                    }
                }
                else if (div == 'err_10'){
                    document.getElementById(div).innerHTML = '<p style="color:red;">'+ "Tem de ter mais de 16 anos para poder participar como voluntário"+'</p>';
                }   
            }
        </script>
        <?php
        exit();
    }
?> 