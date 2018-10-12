<?php
    session_start();
    include('dbconnection.php');
    include('php_function.php');
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
    $password= $_SESSION['password'];
    $role= $_SESSION['role'];

    if(($role=='student') || ($role=='union') ){ ?>

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
        <h2 class="text-center">MENTOR DETAILS</h2>

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
					<th>Birthdate</th>
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
        
        <div class="col-sm-12">
            <p class="text-left"><a href="user_profile.php"><span class="glyphicon glyphicon-backward"></span> Back</a></p>
        </div>      
    </div>
  
</body>
</html>

<?php }else{
	header('location:home.php');


}?>