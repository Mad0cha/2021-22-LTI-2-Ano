<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$con = mysqli_connect("appserver-01.alunos.di.fc.ul.pt", "asw14", "grupo14asw", "asw14");

if(isset($_POST['save_select']))
{
    $seg1 = $_POST['seg1'];
    $seg2 = $_POST['seg2'];
    $ter1 = $_POST['ter1'];
    $ter2 = $_POST['ter2'];
    $qua1 = $_POST['qua1'];
    $qua2 = $_POST['qua2'];
    $qui1 = $_POST['qui1'];
    $qui2 = $_POST['qui2'];
    $sex1 = $_POST['sex1'];
    $sex2 = $_POST['sex2'];
    $sab1 = $_POST['sab1'];
    $sab2 = $_POST['sab2'];
    $dom1 = $_POST['dom1'];
    $dom2 = $_POST['dom2'];

    $segunda = $_POST['segunda'];
    $terca = $_POST['terca'];
    $quarta = $_POST['quarta'];
    $quinta = $_POST['quinta'];
    $sexta = $_POST['sexta'];
    $sabado = $_POST['sabado'];
    $domingo = $_POST['domingo'];
    
    $email = $_SESSION['login'];
    echo $segunda;
    //===================================================================
    $varSeg1 = (explode("-",$seg1));
    $seg11 = $varSeg1[1];
    echo $seg11;

    $varSeg2 = (explode("-",$seg2));
    $seg22 = $varSeg2[1];
    echo $seg22;

    //===================================================================~
    $varTer1 = (explode("-",$ter1));
    $ter11 = $varTer1[1];
    echo $ter11;

    $varTer2 = (explode("-",$ter2));
    $ter22 = $varTer2[1];
    echo $ter22;

    //===================================================================
    $varQuar1 = (explode("-",$qua1));
    $qua11 = $varQuar1[1];
    echo $qua11;

    $varQuar2 = (explode("-",$qua2));
    $qua22 = $varQuar2[1];
    echo $qua22;

    //===================================================================
    $varQui1 = (explode("-",$qui1));
    $qui11 = $varQui1[1];
    echo $qui11;

    $varQui2 = (explode("-",$qui2));
    $qui22 = $varQui2[1];
    echo $qui22;

    //===================================================================
    $varSex1 = (explode("-",$sex1));
    $sex11 = $varSex1[1];
    echo $sex11;

    $varSex2 = (explode("-",$sex2));
    $sex22 = $varSex2[1];
    echo $sex22;

    //===================================================================
    $varSab1 = (explode("-",$sab1));
    $sab11 = $varSab1[1];
    echo $sab11;

    $varSab2 = (explode("-",$sab2));
    $sab22 = $varSab2[1];
    echo $sab22;

    //===================================================================
    $varDom1 = (explode("-",$dom1));
    $dom11 = $varDom1[1];
    echo $dom11;

    $varDom2 = (explode("-",$dom2));
    $dom22 = $varDom2[1];
    echo $dom22;

    //===================================================================
    
    echo $email;

    $res = mysqli_query($con, "SELECT * FROM disp_instituicao WHERE email ='$email'");

    $non = "None";
    if (mysqli_num_rows($res) > 0) {
        if($seg11 == $non or $seg22 == $non) {
            $query1 = "UPDATE disp_instituicao SET hora_ini = '$seg11', hora_fim = '$seg22', disponibilidade = NULL WHERE email='$email' AND dia='$segunda'" ;
        }else{
            $query1 = "UPDATE disp_instituicao SET hora_ini = '$seg11', hora_fim = '$seg22', disponibilidade = 'livre' WHERE email='$email' AND dia='$segunda'" ;
        } 

        if($ter11 == $non or $ter22 == $non) {
            $query2 = "UPDATE disp_instituicao SET hora_ini = '$ter11', hora_fim = '$ter22', disponibilidade = NULL WHERE email='$email' AND dia='$terca'" ;
        }else{
            $query2 = "UPDATE disp_instituicao SET hora_ini = '$ter11', hora_fim = '$ter22', disponibilidade = 'livre' WHERE email='$email' AND dia='$terca'" ;
        }  
        
        if($qua11 == $non or $qua22 == $non) {
            $query3 = "UPDATE disp_instituicao SET hora_ini = '$qua11', hora_fim = '$qua22', disponibilidade = NULL WHERE email='$email' AND dia='$quarta'" ;
        }else{ 
            $query3 = "UPDATE disp_instituicao SET hora_ini = '$qua11', hora_fim = '$qua22', disponibilidade = 'livre' WHERE email='$email' AND dia='$quarta'" ;
        }  
        
        if($qui11 == $non or $qui22 == $non) {
            $query4 = "UPDATE disp_instituicao SET hora_ini = '$qui11', hora_fim = '$qui22', disponibilidade = NULL WHERE email='$email' AND dia='$quinta'" ;
        }else{ 
            $query4 = "UPDATE disp_instituicao SET hora_ini = '$qui11', hora_fim = '$qui22', disponibilidade = 'livre' WHERE email='$email' AND dia='$quinta'" ;
        }  
        
        if($sex11 == $non or $sex22 == $non) {
            $query5 = "UPDATE disp_instituicao SET hora_ini = '$sex11', hora_fim = '$sex22', disponibilidade = NULL WHERE email='$email' AND dia='$sexta'" ;
        }else{   
            $query5 = "UPDATE disp_instituicao SET hora_ini = '$sex11', hora_fim = '$sex22', disponibilidade = 'livre' WHERE email='$email' AND dia='$sexta'" ;
        }    
        
        if($sab11 == $non or $sab22 == $non) {
            $query6 = "UPDATE disp_instituicao SET hora_ini = '$sab11', hora_fim = '$sab22', disponibilidade = NULL WHERE email='$email' AND dia='$sabado'" ;
        }else{  
            $query6 = "UPDATE disp_instituicao SET hora_ini = '$sab11', hora_fim = '$sab22', disponibilidade = 'livre' WHERE email='$email' AND dia='$sabado'" ;
        }    

        if($dom11 == $non or $dom22 == $non) {
            $query7 = "UPDATE disp_instituicao SET hora_ini = '$dom11', hora_fim = '$dom22', disponibilidade = NULL WHERE email='$email' AND dia='$domingo'" ;
        }else{
            $query7 = "UPDATE disp_instituicao SET hora_ini = '$dom11', hora_fim = '$dom22', disponibilidade = 'livre' WHERE email='$email' AND dia='$domingo'" ;
        }

          $query_run1 = mysqli_query($con, $query1);
          $query_run2 = mysqli_query($con, $query2);
          $query_run3 = mysqli_query($con, $query3);
          $query_run4 = mysqli_query($con, $query4);
          $query_run5 = mysqli_query($con, $query5);
          $query_run6 = mysqli_query($con, $query6);
          $query_run7 = mysqli_query($con, $query7);
        

      } else {
        if($seg11 == $non or $seg22 == $non) {
          $query1 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim) VALUES ('$email','$segunda','$seg11','$seg22')";
        }else{
          $query1 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim,disponibilidade) VALUES ('$email','$segunda','$seg11','$seg22','livre')";  
        }

        if($ter11 == $non or $ter22 == $non) {
            $query2 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim) VALUES ('$email','$terca','$ter11','$ter22')";
        }else{
            $query2 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim,disponibilidade) VALUES ('$email','$terca','$ter11','$ter22','livre')";
        }

        if($qua11 == $non or $qua22 == $non) {
            $query3 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim) VALUES ('$email','$quarta','$qua11','$qua22')";
        }else{
            $query3 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim,disponibilidade) VALUES ('$email','$quarta','$qua11','$qua22','livre')";
        }

        if($qui11 == $non or $qui22 == $non) {
            $query4 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim) VALUES ('$email','$quinta','$qui11','$qui22')";
        }else{
            $query4 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim,disponibilidade) VALUES ('$email','$quinta','$qui11','$qui22','livre')";
        }

        if($sex11 == $non or $sex22 == $non) {
            $query5 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim) VALUES ('$email','$sexta','$sex11','$sex22')";
        }else{
            $query5 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim,disponibilidade) VALUES ('$email','$sexta','$sex11','$sex22','livre')";
        }

        if($sab11 == $non or $sab22 == $non) {
            $query6 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim) VALUES ('$email','$sabado','$sab11','$sab22')";
        }else{
            $query6 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim,disponibilidade) VALUES ('$email','$sabado','$sab11','$sab22','livre')";
        }


        if($dom11 == $non or $dom22 == $non) {
            $query7 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim) VALUES ('$email','$domingo','$dom11','$dom22')";
        }else{
            $query7 = "INSERT INTO disp_instituicao (email,dia,hora_ini,hora_fim,disponibilidade) VALUES ('$email','$domingo','$dom11','$dom22','livre')";
        }

        $query_run1 = mysqli_query($con, $query1);
        $query_run2 = mysqli_query($con, $query2);
        $query_run3 = mysqli_query($con, $query3);
        $query_run4 = mysqli_query($con, $query4);
        $query_run5 = mysqli_query($con, $query5);
        $query_run6 = mysqli_query($con, $query6);
        $query_run7 = mysqli_query($con, $query7);
         
      }

    if($query_run1 or $query_run2 or $query_run3 or $query_run4 or $query_run5 or $query_run6 or $query_run7)
    {
        $_SESSION['status'] = "Inserted Succesfully";
        header("Location: area_instituicao.php");
    }
    else
    {
        $_SESSION['status'] = "Not Inserted";
        header("Location: area_instituicao.php");
    }
}
?>