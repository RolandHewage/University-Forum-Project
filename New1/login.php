<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
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

    </style>
</head>
<body>

    <div class="container"><br><br></div>

    <div class="container jumbotron">
        <h2 class="text-center">SIGN IN</h2>
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" name="f1" method="post">
          <div class="form-group">
            <label class="control-label col-sm-2" for="uname">User Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="uname" placeholder="Enter User Name" name="uname">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pass">Password:</label>
            <div class="col-sm-10">          
              <input type="password" class="form-control" id="pass" placeholder="Enter password" name="pass">
            </div>
          </div>
          <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default" name="sub1">Sign_In</button>
              <button type="reset" class="btn btn-default">Cancel</button>
            </div>
          </div>
        </form>
        <p class="text-center">If you are a new user click <a href="add_user.php">Here.</a></p>

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
					    <span id="li" class="text-center">
						    <p >Invalid username or password!!<br></p>
					    </span>
							
				    <?php }

						
			    }


			    header('refresh:1');
		    }

		    //	mysqli_close($conn);
				
        ?>

        <div class="col-sm-12">
            <p class="text-left"><a href="home22.php"><span class="glyphicon glyphicon-backward"></span> Back</a></p>
        </div>      
    </div>
  
</body>
</html>