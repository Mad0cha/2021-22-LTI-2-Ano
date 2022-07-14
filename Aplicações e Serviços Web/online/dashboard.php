<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
include('database.inc.php');

$email = $_SESSION['login'];

	$count=mysqli_num_rows($res);
	if($count>0){
		
		$time=time()+10;
		$res=mysqli_query($con,"update voluntario set last_login=$time where email='$email'");
	}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>User Status Dashboard</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      
   </head>
   <body>
      <div class="container">
         <h2 class="text-center text-info">User Status Dashboard</h2>
		 
         <table class="table table-striped table-bordered">
            <thead>
               <tr>
                  <th width="15%">Status</th>
               </tr>
            </thead>
            <tbody id="user_grid">
			
            </tbody>
         </table>
      </div>
	  <script>
		console.log("Hello world!");
		function updateUserStatus(){
			jQuery.ajax({
				url:'update_user_status.php',
				success:function(){
					console.log("Hello world2!");
				}
			});
		}
		
		function getUserStatus(){
			jQuery.ajax({
				url:'get_user_status.php',
				success:function(result){
					jQuery('#user_grid').html(result);
				}
			});
		}
		getUserStatus();
		setInterval(function(){
			updateUserStatus();
		},3000);
		
		setInterval(function(){
			getUserStatus();
		},7000);
	  </script>
   </body>
</html>

<style type="text/css">
	body {
		margin: 0;
		padding: 0;
		background-color: #17a2b8;
		height: 100vh;
	}
	.container  {
		margin-top: 100px;
		border: 1px solid #9C9C9C;
		background-color: #fff;
		padding:30px;
	}    
	.container h2{
		margin-bottom:25px;
	}
	.text-info {
		color: #000 !important;
	}
</style>