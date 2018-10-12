<!DOCTYPE html>
<html>
<head>
	<title>Forum</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php
	//include 'dbconnection.php';
	$con=mysqli_connect("localhost", "root", "","project");
// insert post.....
	function insertpost($user_id){
		if(isset($_POST['sub'])){
			global $con;
			
			
			$topic = $_POST['topic'];
			$question = $_POST['content'];
			$today=date('Y-m-d');
			date_default_timezone_set('Asia/Colombo');
			$time=date('h:i:sa');
			
			
			if($question==''){
				echo "<script>alert('Please enter Question')</script>";
				exit();
			}
			else{
					
			$insert = "insert into question (user_id,category,question,submit_date,submit_time) values ($user_id,'$topic','$question','$today','$time')";
			
			$run = mysqli_query($con,$insert);
			}
			if($run){
				echo "Your Question is submitted Successfully!!<br>";
				
							
				}
			
			
			else{
				echo "submit error".mysqli_error($conn);
			}
			
			header('refresh:1');
		}
	}
	
	
	//view postss..............
	
	function get_posts(){
		global $con;
		
		$per_page=5;
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		else{
			$page=1;
		}
		$start_from = ($page-1) * $per_page;
		$get_posts = "select * from question order by 1 desc limit $start_from, $per_page";
		$run_posts = mysqli_query($con,$get_posts);
		
		echo "<div class='panel-group'>";
		
		while($row_posts=mysqli_fetch_array($run_posts)){
			$q_id = $row_posts['q_id'];
			$user_id = $row_posts['user_id'];
			
			$que_title = $row_posts['category'];
			$question= $row_posts['question'];
			$post_date = $row_posts['submit_date'];
			
			$user = "select * from user where user_id='$user_id'";
			
			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['user_name'];
			
			$user_image = $row_user['profile_pic'];
			
			echo "<div class='panel panel-primary'>
					<div class='panel-body'>
					<p><img src = 'images/$user_image' width='50' height='50'></p>
					<h3><a href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
					<h3>$que_title</h3>
					<p>$post_date</p>
					<p>$question</p>
					<a href='single.php?post_id=$q_id' style='float:right;'>
					<button>See Replies or Reply to this</button></a>
					</div></div>";
						
		}
			echo "</div>";
		include('pagination.php');
	
	}
	
	//single post..............
	
	function single_post(){
		if(isset($_GET['post_id'])){
			global $con;
			$q_id = $_GET['post_id'];
			
			$get_posts = "select * from question where q_id='$q_id'";
		    $run_posts = mysqli_query($con,$get_posts);
			$row_posts=mysqli_fetch_array($run_posts);
			$user_id = $row_posts['user_id'];
			$post_id = $row_posts['q_id'];
			//$user_email = $row_posts['user_email'];
			$post_title = $row_posts['category'];
			$content = $row_posts['question'];
			$post_date = $row_posts['submit_date'];
			
			$user = "select * from user where user_id='$user_id'";
			
			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['user_name'];
			$user_image = $row_user['profile_pic'];
			
			// user secssion
			
			$user_id_now = $_SESSION['id'];
			$get_com = "select * from user where user_id='$user_id_now'";
			$run_com = mysqli_query($con,$get_com);
			$row_com = mysqli_fetch_array($run_com);
			$user_com_id = $row_com['user_id'];
			$user_com_name = $row_com['user_name'];
			
			
			echo "<div id='posts'>
					<p><img src = 'images/$user_image' width='50' height='50'></p>
					<h3><a href='user_profile.php?user_id=$user_com_id'>$user_name</a></h3>
					<h3>$post_title</h3>
					<p>$post_date</p>
					<p>$content</p>
					
					</div><br>
					";
					include('comment.php');
					echo "
					<form action='' method='post' id='reply'>
						<textarea cols='50' name='comment' rows='5' placeholder='write your reply'></textarea><br>
						 <input type='submit' name='reply_btn' value='Reply to this'>
					</form>
					";
					
					if(isset($_POST['reply_btn'])){

									$today=date('Y-m-d');
									date_default_timezone_set('Asia/Colombo');
									$ti=date('h:i:sa');
						
						$reply = $_POST['comment'];
						$insert = "insert into reply(q_id,reply,user_id,submit_date,time,replyer_name) values ('$user_id','$reply','$post_id','$today','$ti','$user_name')";
						
						$run = mysqli_query($con,$insert);
											
						if($run){
							echo "<h2>Your reply was added!</h2>";
							header('refresh:1');
						}
						else{
							echo "<h2>Your reply was  not added!</h2>";
						}
						
						
					}
		
		}
	}
	
	
?>				
</body>
</html>
		
	