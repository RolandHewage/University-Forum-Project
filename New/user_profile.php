<?php
   session_start();
   include('dbconnection.php');
   include('php_function.php');
  $name=$_SESSION['name'];
  $id=$_SESSION['id'];
  $password= $_SESSION['password'];
  $role= $_SESSION['role'];

    if(($role=='administrator') || ($role=='student') || ($role=='union')){ ?>



<!DOCTYPE html>
<html>
<head>
	<title>submit_question</title>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
			border: 1px solid black;
			border-collapse: collapse;

		}
		th,td{
			padding: 12px;
		}
		table{
			margin: 0px auto;
			width: 90%;
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
		
			<u><h2>Hello : <?php echo $name ?></h2></u>

			<?php
				if($role=="student"){?>
					<a href="user_profile.php?name=mentor">View Mentor</a>  <a href="user_profile.php">Home</a>
					<br><br>

			<?php	}
			?>
			
			<form action="#" method="post" name="f1">

				<input type="submit" name="ch_pass" value="Change password">
				<input type="submit" name="ch_picture" value="Change profile picture">
				<input type="submit" name="ch_email" value="Change email">

				<?php
					if($role=="administrator"){ ?>
						<input type="submit" name="add_user" value="add_user">
				<?php	}else{ ?>
						<input type="submit" name="add_user" value="add_user" disabled>
				<?php	}

				?>

				<?php
					if($role=="administrator" && $name=="admin1"){ ?>
						<a href="add_mentor.php"> <input type="button" name="add_mentor" value="Assign_mentor"></a>
				<?php	}else{ ?>
						<input type="submit" name="add_mentor" value="Assign_mentor" disabled>
				<?php	}
				?>
				


				
					
			</form>

			<?php

				if($_SERVER['REQUEST_METHOD']=="POST"){
					if(isset($_POST['add_mentor'])){
						//echo "add mentor";
						//add_mentor();
					}
				}




					if($_SERVER['REQUEST_METHOD']=="POST"){
							if(isset($_POST['ch_pass'])){//=================change password==========
								//echo "pass";
								 ?>
								<form action="#" method="post" name="f2">
									<table>
										<tr>
											<td>Enter New Password:</td>
											<td><input type="text" name="newpassword" ></td>
											<td><input type="submit" name="sub1" value="submit"></td>
										</tr>
									</table>
									
								</form>
								
						<?php	}
							if(isset($_POST['ch_picture'])){//============change profile picture========
								echo "picture";
							}
							if(isset($_POST['ch_email'])){//=============change email==================
								//echo "ch_email"; ?>
								<form action="#" method="post" name="f3">
									<table>
										<tr>
											<td>Enter New Email:</td>
											<td><input type="text" name="newEmail" ></td>
											<td><input type="submit" name="sub2" value="submit"></td>
										</tr>
									</table>
									
								</form>

						<?php	}

							//header("refresh:1");
					}	


//==========================updatin user table ==========(new password,new email,add new administrators=====)==============
					if($_SERVER['REQUEST_METHOD']=="POST"){
						if(isset($_POST['sub1'])){
								//echo "sub1";
								$newpassword=$_POST['newpassword'];
							$q1="update user set password='$newpassword' where user_id='$id'";
							if(mysqli_query($conn,$q1)){
									echo "Password changed Successfully!!!";		
							}else{
								echo "not changed!".mysqli_error($conn);
							}
							header("refresh:1");
						}
						if(isset($_POST['sub2'])){
								//echo "sub2";
							$newEmail=$_POST['newEmail'];
							$q2="update user set email='$newEmail' where user_id='$id'";
							if(mysqli_query($conn,$q2)){
									echo "email changed Successfully!!!";		
							}else{
								echo "not changed!".mysqli_error($conn);
							}
							header("refresh:1");

						}

						if(isset($_POST['submit4'])){
							//echo "enterrd!!";
							$username=$_POST['uname'];
							$Password=$_POST['pass'];
							$email=$_POST['email'];
							$bday=$_POST['bday'];

							$q3="insert into user(user_name,password,role,email,birth_date) values('$username','$Password','administrator','$email','$bday')";
							if(mysqli_query($conn,$q3)){
								echo "adding Successfully!!<br>";
							}else{
								echo "error1".mysqli_error($conn);
							}


							header('refresh:1');
						}

					}

			?>

	
		

	<?php
	//===================add new addminitore=============(only for adminitratotrss)================

		if($_SERVER['REQUEST_METHOD']=="POST"){
			if(isset($_POST['add_user'])){ ?>
					<form action="#" name="f4" method="post">
						<table>
							<tr>
								<td><b>Enter user name:</b></td>
								<td><input type="text" name="uname"></td>
							</tr>
							<tr>
								<td><b>Password:</b></td>
								<td><input type="password" name="pass"></td>
							</tr>
							<tr>
								<td><b>Email:</b></td>
								<td><input type="text" name="email"></td>
							</tr>
							<tr>
								<td><b>Birth date:</b></td>
								<td><input type="text" name="bday"></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="submit4" value="Enter">  <input type="reset" name="re" value="Cansal"></td>
							</tr>
						</table>
					</form>


			<?php }
		}

	?>	



			

		<p style="text-align: left;"><a href="home22.php">Back</a> </p>
	</div>
</div>

</body>
</html>

<?php }else{
		header('location:home.php');


	}?>

