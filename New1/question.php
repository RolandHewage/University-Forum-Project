<?php
    session_start();
    include('dbconnection.php');
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
    $password= $_SESSION['password'];
    $role= $_SESSION['role'];

    if(($role=='administrator') || ($role=='student') || ($role=='union')){ 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Submit Question</title>
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
        <h2 class="text-center">ENTER YOUR QUESTION</h2>
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" name="f1" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="type">Category:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="type">
                        <option value="Academic">Academic</option>
                        <option value="Sport">Sport</option>
                        <option value="Hostal">Hostal</option>
                        <option value="Canteen">Canteen</option>
                        <option value="library">library</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="ques">Question:</label>
                <div class="col-sm-10">          
                    <textarea class="form-control" rows="5" name="ques"></textarea>
                </div>
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="sub1">Submit_Question</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>
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
					echo "<p>Your Question is submitted Successfully!!</p><br>";
				}else{
					echo "submit error".mysqli_error($conn);
				}

				header('refresh:1');
			}

		?>

        <div class="col-sm-12">
            <p class="text-left"><a href="home22.php"><span class="glyphicon glyphicon-backward"></span> Back</a></p>
        </div>      
    </div>
  
</body>
</html>

<?php }else{
	header('location:home.php');
}?>