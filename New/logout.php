<?php
	session_start();
	include('dbconnection.php');

	$name=$_SESSION['name'];
	$id=$_SESSION['id'];

//=============update usage table logout_time column=============================
	$q1="select * from usageinfo where user_id='$id'";
	$r1=mysqli_query($conn,$q1);
	date_default_timezone_set('Asia/Colombo');
	$ti=date('h:i:sa');
	if(mysqli_num_rows($r1)>0){
		while ($row1=mysqli_fetch_assoc($r1)) {
			//echo "heyyyy";
			$q2="update usageinfo set logout_time='$ti' where user_id='$id'";
			if(mysqli_query($conn,$q2)){
				echo "set logout time";
			}
			break;
		}
	}

									

	session_destroy();
	session_unset();
	header('location:home.php');
?>