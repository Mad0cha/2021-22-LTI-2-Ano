<?php

session_start();
// print_r($_SESSION);
include('../online/database.inc.php');
// $pk = $_REQUEST["q"];

$email = $_SESSION['login'];
$valor_disp = 'ocupado por: ';
$valor_disp.=$email;
// echo $valor_disp;

// if ($_SESSION['tipo_login'] == "voluntario"){
//     $valor_disp = 'ocupado por: ';
// }
if ($_SESSION["tipo_login"] == "voluntario"){
    $pk = $_POST["id"];
    $selt=mysqli_query($con,"SELECT * FROM disp_instituicao WHERE id='$pk'");
    while($row = $selt-> fetch_assoc()){
        $disp = $row["disponibilidade"];
    }

    if($disp == 'livre'){
       
        // na instituicao vai o valor_disp
        // buscar infos da instituicao e por
        $res=mysqli_query($con,"UPDATE disp_instituicao SET disponibilidade='$valor_disp' WHERE id='$pk'");
        $valor_disp_vol = 'ocupado por: ';


        $res2=mysqli_query($con,"SELECT * FROM disp_instituicao WHERE disponibilidade = '$valor_disp' AND id = '$pk'");
        while($row2 = $res2-> fetch_assoc()){
            $email_inst = $row2["email"];
            $dia_inst = $row2["dia"];
            $hora_ini_inst = $row2["hora_ini"];
            $hora_fim_inst = $row2["hora_fim"];
            
        } 
        
        $cc_vol = "";
        $res3=mysqli_query($con,"SELECT * FROM voluntario WHERE email='$email'");
        while($row3 = $res3-> fetch_assoc()){
            $cc_vol = $row3["cc"];
        }

        $valor_disp_vol .= $email_inst;
        $res4=mysqli_query($con,"UPDATE disp_voluntario SET disponibilidade='$valor_disp_vol' WHERE dia = '$dia_inst' AND hora_ini='$hora_ini_inst' AND hora_fim = '$hora_fim_inst' AND cc = '$cc_vol'");



    }else{
        $res=mysqli_query($con,"UPDATE disp_instituicao SET disponibilidade='livre' WHERE id='$pk'");
    // $res=mysqli_query($con,"UPDATE disp_voluntario SET disponibilidade='livre' WHERE id='$pk'");

        $res2=mysqli_query($con,"SELECT * FROM disp_instituicao WHERE id = '$pk'");
        while($row2 = $res2-> fetch_assoc()){
            $dia_inst = $row2["dia"];
            $hora_ini_inst = $row2["hora_ini"];
            $hora_fim_inst = $row2["hora_fim"];
        
        } 

        $cc_vol = "";
        $res3=mysqli_query($con,"SELECT * FROM voluntario WHERE email='$email'");
        while($row3 = $res3-> fetch_assoc()){
            $cc_vol = $row3["cc"];
        }

        $res4=mysqli_query($con,"UPDATE disp_voluntario SET disponibilidade='livre' WHERE dia = '$dia_inst' AND hora_ini='$hora_ini_inst' AND hora_fim = '$hora_fim_inst' AND cc = '$cc_vol'");
    }




}else{

    $infos = $_POST["id"];
	$pk = explode("/", $infos)[0];
	$email_inst = explode("/", $infos)[1];
    echo $pk;
    echo $email_inst;

    $res2=mysqli_query($con,"SELECT * FROM disp_voluntario WHERE id = '$pk'");
    while($row2 = $res2-> fetch_assoc()){
        $dia_vol = $row2["dia"];
        $hora_ini_vol = $row2["hora_ini"];
        $hora_fim_vol = $row2["hora_fim"];
    
    } 


    $selt=mysqli_query($con,"SELECT * FROM disp_instituicao WHERE email='$email_inst' AND dia = '$dia_vol' AND hora_ini='$hora_ini_vol' AND hora_fim = '$hora_fim_vol'");
    while($row = $selt-> fetch_assoc()){
        $disp = $row["disponibilidade"];
    }

    if ($disp == 'livre'){
        $res=mysqli_query($con,"UPDATE disp_voluntario SET disponibilidade='$valor_disp' WHERE id='$pk'");

        $valor_disp_inst = 'ocupado por: ';
    
        $res=mysqli_query($con,"SELECT * FROM disp_voluntario WHERE disponibilidade = '$valor_disp' AND id='$pk'");
        while($row = $res-> fetch_assoc()){
            $cc_vol = $row["cc"];
        } 
    
        // echo $cc_vol;
        $res2=mysqli_query($con,"SELECT email FROM voluntario WHERE cc='$cc_vol'");
        while($row = $res2-> fetch_assoc()){
            $email_vol = $row["email"];
        }
    
        $valor_disp_inst .= $email_vol;
        // echo $valor_disp_inst;
        $res3=mysqli_query($con,"UPDATE disp_instituicao SET disponibilidade='$valor_disp_inst' WHERE email='$email_inst' AND dia = '$dia_vol' AND hora_ini='$hora_ini_vol' AND hora_fim = '$hora_fim_vol'");
    }else{
        $res=mysqli_query($con,"UPDATE disp_voluntario SET disponibilidade='livre' WHERE id='$pk'");
        // $res=mysqli_query($con,"UPDATE disp_voluntario SET disponibilidade='livre' WHERE id='$pk'");

        $res2=mysqli_query($con,"SELECT * FROM disp_voluntario WHERE id = '$pk'");
        while($row2 = $res2-> fetch_assoc()){
            $dia_inst = $row2["dia"];
            $hora_ini_inst = $row2["hora_ini"];
            $hora_fim_inst = $row2["hora_fim"];
        
        } 


        $res4=mysqli_query($con,"UPDATE disp_instituicao SET disponibilidade='livre' WHERE dia = '$dia_inst' AND hora_ini='$hora_ini_inst' AND hora_fim = '$hora_fim_inst' AND email = '$email_inst'");
    }

   
}

?>