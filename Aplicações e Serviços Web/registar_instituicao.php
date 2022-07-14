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
                    <img src="assets/img/hero/bici.png" id ="esq" alt="">
                    <div class="signup-img-content">
                        <h2>Registe a sua instituição</h2>
                        <p>Venha fazer parte desta família</p>
                    </div>
                </div>
                <div class="signup-form">
                    <form action="auxiliares/formulario_instituicao.php" method="post" class="register-form" id="register-form">
                        <div class="form-row">
                            <div class="form-group">

                                <div class="form-input">
                                    <div id="err_"></div>
                                    <label for="nome_inst" class="required">Nome da Instituição</label>
                                    <input type="text" name="nome_inst" id="nome_inst" />
                                </div>

                                <div class="form-input">
                                    <div id="err_6"></div>
                                    <label for="telefone_instituicao" class="required">Telefone da instituição</label>
                                    <input type="number" name="telefone_instituicao" id="telefone_instituicao" />
                                </div>

                                <div class="form-input">
                                    <div id="err_1"></div>
                                    <label for="nome_pessoa" class="required">Nome da pessoa responsável</label>
                                    <input type="text" name="nome_pessoa" id="nome_pessoa" />
                                </div>

                                <div class="form-input">
                                    <div id="err_8"></div>
                                    <label for="telefone_pessoa" class="required">Telefone da pessoa responsável</label>
                                    <input type="number" name="telefone_pessoa" id="telefone_pessoa" >
                                </div>

                                <div class="form-input">
                                <div id="err_7"></div>
                                    <label for="email" class="required">E-mail</label>
                                    <input type="email" name="email" id="email">
                                </div>

                            </div>
                            <div class="form-group">
                                
                                <div class="form-input">
                                    <label for="morada" class="required">Morada</label>
                                    <input type="text" name="morada" id="morada">
                                </div>

                                <div class="form-input">
                                    <div id="err_3"></div>
                                    <label for="distrito" class="required">Distrito</label>
                                    <input type="text" name="distrito" id="distrito">
                                </div>

                                <div class="form-input">
                                    <div id="err_4"></div>
                                    <label for="concelho" class="required">Concelho</label>
                                    <input type="text" name="concelho" id="concelho">
                                </div>

                                <div class="form-input">
                                    <div id="err_5"></div>
                                    <label for="freguesia" class="required">Freguesia</label>
                                    <input type="text" name="freguesia" id="freguesia">
                                </div>


                                <div class="form-input">
                                    <label for="pass" class="required">Password</label>
                                    <input type="password" name="pass" id="pass">
                                </div>

                            </div>
                        </div>

                        <div class="form-group d-block mx-auto text-center">
                            <label for="descricao" class="required">Breve descrição da instituição</label>
                            <textarea name = "descricao" id="descricao"></textarea>
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
                    document.getElementById(div).innerHTML = '<p style="color:red;">'+"O nome da pessoa responsável não pode conter digitos"+'</p>';
                }
                else if (div == 'err_2'){
                    document.getElementById(div).innerHTML = '<p style="color:red;">'+"A morada é demasiado grande. O máximo é de 50 caracteres"+'</p>';
                }
                else if (div == 'err_3'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O nome do distrito é demasiado grande. O máximo é de 50 caracteres"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O distrito não pode conter digitos"+'</p>';
                    }
                }
                else if (div == 'err_4'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O nome do concelho é demasiado grande. O máximo é de 50 caracteres"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O concelho não pode conter digitos"+'</p>';
                    }
                }   
                else if (div == 'err_5'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O nome da freguesia é demasiado grande. O máximo é de 50 caracteres"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"A freguesia não pode conter digitos"+'</p>';
                    }
                }
                else if (div == 'err_6'){
                
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"Tem números a menos no telefone da instituição"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+ "Tem números a mais no telefone da instituição"+'</p>';
                    }
                }
                else if (div == 'err_7'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"O email digitado é demasiado grande. O máximo é de 50 caracteres"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+ "O e-mail digitado já está registado"+'</p>';
                    }
                }
                else if (div == 'err_8'){
                    if (descricao == '0'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"Tem números a menos no telefone da pessoa responsável"+'</p>';
                    }
                    else if (descricao == '1'){
                        document.getElementById(div).innerHTML = '<p style="color:red;">'+"Tem números a mais no telefone da pessoa responsável"+'</p>';
                    }
                }
            }
        </script>
        <?php
        exit();
    }
?> 