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
<html lang="en">
<head>
    <title>Enter Notice</title>
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
        <h2 class="text-center">ENTER YOUR NOTICE</h2>
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" name="f1" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="note">Enter Notice:</label>
                <div class="col-sm-10">          
                    <textarea class="form-control" rows="5" name="note"></textarea>
                </div>
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="sub1">Enter</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>
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

        <div class="col-sm-12">
            <p class="text-left"><a href="home22.php"><span class="glyphicon glyphicon-backward"></span> Back</a></p>
        </div>      
    </div>
  
</body>
</html>
<?php
	}else{
		header('location:home.php');
    }
?>