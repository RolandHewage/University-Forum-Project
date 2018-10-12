<?php
   session_start();
   include('dbconnection.php');
  $name=$_SESSION['name'];
  $id=$_SESSION['id'];
  $password= $_SESSION['password'];
  $role= $_SESSION['role'];

    if( ($role=='student') || ($role=='union')){ ?>



<!DOCTYPE html>
<html>
<head>
	<title>submit_question</title>
	<style type="text/css">
		div.con{
			width: 60%;
			margin: 50px auto;
			border: 1px solid gray;
			padding: 20px 20px;
			background-color: #DCDCDC;
			
		}
		div.mid{
			width: 87%;
			margin: 10px auto;
			padding: 10px 20px;
			background-color: #F0FFFF;
			text-align: center; 
			
			
		}
		table,th,td{
			/*border: 1px solid black;*/
			border-collapse: collapse;
		}
		th,td{
			padding: 12px;
		}
		table{
			margin: 0px auto;
			width: 50%;
			text-align: left;
		}
		#li p{
			color: red;
		}
	</style>
</head>
<body>
<div class="con">
	<div class="mid">
		<h2>Menter Details</h2>
			

		<p style="text-align: left;"><a href="user_profile.php">Back</a> </p>
	</div>
</div>

</body>
</html>

<?php }else{
		header('location:home.php');


	}?>