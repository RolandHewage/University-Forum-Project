
<?php
	 session_start();
   include('dbconnection.php');
  $name=$_SESSION['name'];
  $id=$_SESSION['id'];
  $password= $_SESSION['password'];
  $role= $_SESSION['role'];

    if(($role=='administrator')){ 

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
			<h2><i><u>Enter Your Notice!</u></i></h2>
			<form action="#" name="f1" method="post">
				<table>
					<tr>
						<td><b>Enter Notice: </b></td>
						<td><textarea name="note" cols="60" rows="10" ></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="sub1" value="Enter">  <input type="reset" name="re" value="Cansel"></td>
					</tr>
				</table>

			</form>

			<?php
				if(isset($_POST['sub1'])){
						$note=$_POST['note'];
						$today=date('Y-m-d');
						date_default_timezone_set('Asia/Colombo');
						$ti=date('h:i:sa');

						$q1="insert into new_notice(user_id,notice,submit_date,submit_time) values('$id','$note','$today','$ti')";
						if(mysqli_query($conn,$q1)){
							echo "Notice is submited successfully!!<br>";
							header('refresh:1');
						}else{
							echo "Cannot submit!!".mysqli_error($conn);
						}
				}

			?>
			

			<p style="text-align: left;"><a href="home22.php">Back</a></p>
			
		</div>
	</div>
	

</body>
</html>
<?php
	 }else{
		header('location:home.php');


	}
?>