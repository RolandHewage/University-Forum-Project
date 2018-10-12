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
<html lang="en">
<head>
    <title>Add Mentor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            background-color: #6f0fa3;
        }

        .jumbotron { 
            background-color: #9933cc; 
            color: #ffffff;
            font-family: Montserrat, sans-serif;
        }

        .jumbotron .btn-default{
            background-color: #6f0fa3;
            color: #fff;
        }

        .jumbotron .btn:hover{
            border: 1px solid #6f0fa3;
            background-color: #fff !important;
            color: #6f0fa3;
        }

        .jumbotron a{
            color: #c0c0c0;
        }

        .jumbotron a:hover{
            color: #6f0fa3;
        }

        table,th,td{
		    border: 1px solid #fff;
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

        .mypink select, .mypink input{
            color: #6f0fa3;
        }

    </style>
</head>
<body>

    <div class="container"><br><br></div>

    <div class="container jumbotron">
        <h2 class="text-center">ASSIGN MENTOR</h2>

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
								<td class="mypink">
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
        
        <div class="col-sm-12">
            <p class="text-left"><a href="user_profile.php"><span class="glyphicon glyphicon-backward"></span> Back</a></p>
        </div>      
    </div>
  
</body>
</html>

<?php }else{
	header('location:home.php');


}?>