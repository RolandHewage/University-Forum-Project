<?php
session_start();
include('dbconnection.php');
include('php_function.php');
$name=$_SESSION['name'];
$id=$_SESSION['id'];
$password= $_SESSION['password'];
$role= $_SESSION['role'];

if(($role=='administrator') && ($name=='admin1') ){ ?>



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
		border: 1px solid black;
		border-collapse: collapse;

	}
	th,td{
		padding: 12px;
	}
	table{
		margin: 0px auto;
		width: 80%;
		text-align: left;
	}
	#li p{
		color: red;
	}
</style>

</head>
<body>
	<div class="con">
		<div class="mid" >
			<h2><u>Assign_Mentor</u></h2>
			<?php
				$q1="select * from user where role='student'";
				$r1=mysqli_query($conn,$q1);

			?>
		<!--	<form action="#" method="post" name="f1"> -->
			<table>
				<tr>
					<th>Student_id</th>
					<th>Student_Name</th>
					<th>select Mentor</th>
					<th>selected mentor</th>
				</tr>
				<?php
					while ($row1=mysqli_fetch_assoc($r1)){
						$st_name=$row1['user_name'];
						$st_id=$row1['user_id'];?>

						
							<tr>
								<td><?php echo $st_id; ?></td>
								<td><?php echo $st_name; ?></td>
								<td>
									<form action="#" method="post" name="f1">
									<select name='<?php echo $st_name; ?>'>
										<?php
										$q2="select * from user where role='administrator'";
										$r2=mysqli_query($conn,$q2);

										while ($row2=mysqli_fetch_assoc($r2)) {
											$Mentor_id=$row2['user_id'];
											$Mentor_name=$row2['user_name']; ?>
											<option value='<?php echo $Mentor_id;?>'><?php echo $Mentor_name;  ?></option>
											
								<?php	}

										?>
									</select>
									<input type="submit"  name='<?php echo $st_id; ?>' value="SET">
									</form>
								</td>
								<td>
									<?php
										$q6="select * from user,mentor where mentor.mentor_id=user.user_id and mentor.user_table_id=$st_id";
										$r6=mysqli_query($conn,$q6);
										while ($row6=mysqli_fetch_assoc($r6)) { 
											
												$Mentor_name=$row6['user_name'];
												echo "$Mentor_name"; 
											
											

										}

									?>


								</td>
							</tr>
						
				<?php	}
				?>

				
		<!--	</form> -->

		<?php
			//============update mentor table ================
			if($_SERVER['REQUEST_METHOD']=="POST"){
				$q3="select * from user where role='student'";
				$r3=mysqli_query($conn,$q1);
				while ($row3=mysqli_fetch_assoc($r3)) {
					if(isset($_POST[$row3['user_id']])){
						$s_id=$row3['user_id'];
						$s_name=$row3['user_name'];
						$m_id=$_POST[$s_name];
						//echo $s_id;
						//echo $_POST[$s_name];
						$q4="select * from mentor";
						$r4=mysqli_query($conn,$q4);
						while ($row4=mysqli_fetch_assoc($r4)) {
							if($row4['user_table_id']==$s_id){
								$q5="update mentor set mentor_id=$m_id where user_table_id=$s_id";
								if(mysqli_query($conn,$q5)){
									//echo "update mentordable";
								}else{
									echo "error2".mysqli_error($conn);
								}
							}
						}
					}
				}

			}



		?>

			

		</table>
		<a href="user_profile.php"><p style="text-align: left;">Back</p></a>
	</div>

	</div>




</body>
</html>
<?php }else{
	header('location:home.php');


}?>


