<!DOCTYPE html>
<html>
<head>
	<title>Add new user</title>
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
	<script type="text/javascript">
		function validate(){
			var x=document.forms['f1']['name'].value;
			var y=document.forms['f1']['number'].value;
			var z=document.forms['f1']['email'].value;
			var p=document.forms['f1']['bday'].value;
			var q=document.forms['f1']['pass'].value;


			if((x=="") || (y=="")|| (z=="") || (p=="") || (q=="")){
				alert("Please Completly fill the form!!!");
				return false;
			}
			
		}
	</script>
</head>
<body>
	<div class="con">
		<div class="mid">
			<h1><i>CREATE NEW ACCOUNT</i></h1>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="f1" method="post" onsubmit="return validate()">
				<table>
					<tr>
						<th>Enter User Name: </th>
						<td><input type="text" name="name" placeholder="NAME"></td>
					</tr>
					<tr>
						<th>SC Number: </th>
						<td><input type="text" name="number" placeholder="SC NUMBER"></td>
					</tr>
					<tr>
						<th>Password: </th>
						<td><input type="Password" name="pass" placeholder="PASSWORD"></td>
					</tr>
					<tr>
						<th>Email: </th>
						<td><input type="text" name="email" placeholder="EMAIL"></td>
					</tr>
					<tr>
						<th>Birth Day: </th>
						<td><input type="text" name="bday" placeholder="BIRTH DAY"></td>
					</tr>
					<tr>
						<th></th>
						<td><input type="submit" name="sub1" value="Create Account">    <input type="reset" name="Cansal"></td>
					</tr>
				</table>
			</form>
			<?php
				include('dbconnection.php');
				if(isset($_POST['sub1'])){

					//echo "hey!!";
					$name=$_POST['name'];
					$number=$_POST['number'];
					$email=$_POST['email'];
					$bday=$_POST['bday'];
					$pass=$_POST['pass'];
					$ch=0;



					//=============cheack user is already exist!!!===========================
					$q1="select * from user";
					$r1=mysqli_query($conn,$q1);
					if(mysqli_num_rows($r1)>0){
						while ($row1=mysqli_fetch_assoc($r1)) {
							if(($name==$row1['user_name']) && ($number==$row1['sc_number'])){
								$ch=1;
								break;
							}
						}
					}

					

					//====================update user table=====================================
					
					if($ch==0){
						$q2="insert into user(user_name,sc_number,password,role,email,birth_date,profile_pic) values('$name','$number','$pass','student','$email','$bday','default.jpg')";
						$r2=mysqli_query($conn,$q2);
						if($r2){
							echo "New account is created!!";
						}
						//=========update mentor table========================
						$q5="select * from user where role='student' order by user_id desc limit 1";
						$r5=mysqli_query($conn,$q5);
						while ($row5=mysqli_fetch_assoc($r5)) {
							$user_table_id=$row5['user_id'];
							$student_name=$row5['user_name'];
						}
						$q6="insert into mentor(user_table_id,student_name) values($user_table_id,'$student_name')";
						mysqli_query($conn,$q6);

					}elseif ($ch==1) {
						echo "Account is already exist!!<br>";
					}

					//header('refresh:1');
				}

			?>

			<p style="text-align: left;"><a href="login.php">Back</a></p>
			
		</div>
	</div>

</body>
</html>