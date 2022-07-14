<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
include('database.inc.php');
$msg='';
$email = $_SESSION['login'];

	$count=mysqli_num_rows($res);
	if($count>0){

		$time=time()+10;
		$res=mysqli_query($con,"update voluntario set last_login=$time where email='$email'");
		header('location:dashboard.php');
		die();
	}else{
		echo "Ninguém está logado";
      header('location:dashboard.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Login Form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      
   </head>
   
</html>

<style type="text/css">
      body {
         margin: 0;
         padding: 0;
         background-color: #17a2b8;
         height: 100vh;
      }
      .text-info {
         color: #000 !important;
		}
      #login .container #login-row #login-column #login-box {
         margin-top: 120px;
         max-width: 600px;
         height: 320px;
         border: 1px solid #9C9C9C;
         background-color: #fff;
      }
      #login .container #login-row #login-column #login-box #login-form {
         padding: 20px;
      }
      #login .container #login-row #login-column #login-box #login-form #register-link {
         margin-top: -85px;
      }    
		 .container h2{
			margin-bottom:25px;
		 }
</style>