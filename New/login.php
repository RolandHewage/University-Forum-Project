
<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>login page</title>
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
			text-align: center;
		}
		#li p{
			color: red;
		}
	</style>
</head>
<body>
	
	<div class="con">
		<div class="mid">
			<h1><i>Sign_IN</i></h1>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" name="f1" method="post">
				
					<table>
						<tr>
							<th>Use Name: </th>
							<td><input type="text" name="uname" placeholder="NAME" ></td>
						</tr>
						<tr>
							<th>Password: </th>
							<td><input type="Password" name="pass" placeholder="PASSWORD" ></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="sub1" value="Sign_IN">   <input type="reset" name="reset" value="Cansel"></td>
						</tr>
					</table>
				
			</form>
			<p>If you are a new user click <a href="add_user.php">Here.</a></p>

			
			<?php
				if (isset($_POST['sub1'])) {
					include('dbconnection.php');
					$name=$_POST['uname'];
					$pass=$_POST['pass'];
					$ch=0;
					$q1="select * from user";
					$r1=mysqli_query($conn,$q1);
					if(mysqli_num_rows($r1)>0){
						while ($row1=mysqli_fetch_assoc($r1)) {
							//==========login as an administrator==============================
							$id=$row1['user_id'];
							if(($name==$row1['user_name'])&&($pass==$row1['password'])&&($row1['role']=='administrator')){
									$_SESSION['name']=$name;
									$_SESSION['id']=$id;
									$_SESSION['password']=$pass;
									$_SESSION['role']='administrator';
									$ch=1; //=======valid user name & pass================
									//==========update usageinfo table===========================
									$today=date('Y-m-d');
									date_default_timezone_set('Asia/Colombo');
									$ti=date('h:i:sa');
									$q2="insert into usageinfo(user_id,login,login_time) value($id,'$today','$ti')";
									mysqli_query($conn,$q2);
									//echo "heyy";									

									header("location:home22.php");
									break;
							}
							//=================login as an union================================================							
							if(($name==$row1['user_name'])&&($pass==$row1['password'])&&($row1['role']=='union')){
									$_SESSION['name']=$name;
									$_SESSION['id']=$id;
									$_SESSION['password']=$pass;
									$_SESSION['role']='union';
									$ch=1; //=======valid user name & pass================
									//==========update usageinfo table===========================
									$today=date('Y-m-d');
									date_default_timezone_set('Asia/Colombo');
									$ti=date('h:i:sa');
									$q3="insert into usageinfo(user_id,login,login_time) value($id,'$today','$ti')";
									mysqli_query($conn,$q3);									
									//echo "heyy";	
									header("location:home22.php");
									break;
							}

							//============================login as student===========================================

							if(($name==$row1['user_name'])&&($pass==$row1['password'])&&($row1['role']=='student')){
									$_SESSION['name']=$name;
									$_SESSION['id']=$id;
									$_SESSION['password']=$pass;
									$_SESSION['role']='student';
									$ch=1; //=======valid user name & pass================
									//==========update usageinfo table===========================
									$today=date('Y-m-d');
									date_default_timezone_set('Asia/Colombo');
									$ti=date('h:i:sa');
									$q4="insert into usageinfo(user_id,login,login_time) value($id,'$today','$ti')";
									mysqli_query($conn,$q4);									
									//echo "heyy";	
									header("location:home22.php");
									break;
							}
						}

						if($ch==1){
							
						}else{ ?>
							<span id="li">
								<p >Invalid username or password!!<br></p>
							</span>
							
					<?php }

						
					}


					header('refresh:1');
				}

			//	mysqli_close($conn);
				
			?>
			<p style="text-align: left;"><a href="home22.php">Back</a></p>
			
		</div>
	</div>
	

</body>
</html>