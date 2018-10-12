<?php
   session_start();
   include('dbconnection.php');
  $name=$_SESSION['name'];
  $id=$_SESSION['id'];
  $password= $_SESSION['password'];
  $role= $_SESSION['role'];

    if(($role=='administrator') || ($role=='student') || ($role=='union')){ ?>



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
		<h1><i>Enter Your Question</i></h1>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="f1" method="post">
				<table>
					<tr>
						<th>Category:</th>
						<td><select name="type">
							<option value="Academic">Academic</option>
							<option value="Sport">Sport</option>
							<option value="Hostal">Hostal</option>
							<option value="Canteen">Canteen</option>
							<option value="library">library</option>
							<option value="Other">Other</option>
						</select></td>
					</tr>
					<tr>
						<th>Question: </th>
						<td><textarea name="ques" cols="70" rows="10" ></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="sub1" value="submit_question">   <input type="reset" name="re" value="Cansal"></td>
					</tr>
				</table>
			</form>

			<?php
				if(isset($_POST['sub1'])){
						//echo "hey!!!";
					$ques=$_POST['ques'];
					$type=$_POST['type'];
					$today=date('Y-m-d');
					date_default_timezone_set('Asia/Colombo');
					$ti=date('h:i:sa');

					//====================update question table===============================
					$q1="insert into question(user_id,category,question,submit_date,submit_time) values($id,'$type','$ques','$today','$ti')";
					if(mysqli_query($conn,$q1)){
						echo "Your Question is submitted Successfully!!<br>";
					}else{
						echo "submit error".mysqli_error($conn);
					}

						header('refresh:1');
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