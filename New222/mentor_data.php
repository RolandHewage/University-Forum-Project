<?php
    session_start();
    include('dbconnection.php');
    include('php_function.php');
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
    $password= $_SESSION['password'];
    $role= $_SESSION['role'];

    if(($role=='student') || ($role=='union')){ 
        
?>



<!DOCTYPE html>
<html>
<head>
	<title>Mentor_details</title>
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
			<h2><u>Mentor Details</u></h2>
			<?php
				
				$q1="select * from mentor where student_name='$name'";
				$r1=mysqli_query($conn,$q1);
				while ($row1=mysqli_fetch_assoc($r1)) {
					if($row1['mentor_id']==NULL){
						echo "still You have Not Assinged Mentor!!";
						break;
					}else{
						//echo "you have mentor";
						$mentor_id=$row1['mentor_id'];
						//echo $mentor_id;
						$q2="select * from user where user_id=$mentor_id";
						$r2=mysqli_query($conn,$q2);
						while ($row2=mysqli_fetch_assoc($r2)) {
							$mentor_name=$row2['user_name'];
							$mentor_email=$row2['email'];
							$mentor_birthday=$row2['birth_date'];
							break;
						} ?>

						<table>
							<tr>
								<th>Mentor_Id</th>
								<th>Mentor_Name</th>
								<th>Mentor_Email</th>
								<th>Birhdate</th>
							</tr>
							<tr>
								<td><?php echo "$mentor_id"; ?></td>
								<td><?php echo "$mentor_name"; ?></td>
								<td><?php echo "$mentor_email"; ?></td>
								<td><?php echo "$mentor_birthday"; ?></td>
							</tr>
						</table>


					<?php }
				}
				
			?>	


			<p style="text-align: left;"><a href="user_profile.php">Back</a></p>			
		</div>
	</div>

</body>
</html>
<?php }else{
		header('location:home.php');
}?>