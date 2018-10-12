<?php
	$host="localhost";
	$user="roland1";
	$password="alianza2";

	$conn=mysqli_connect($host,$user,$password);
	if($conn){
		//echo "connection successfully!!!<br>";
	}else{
		echo "connection error".mysqli_error($conn);
	}

	$q1="use project1";
	$r1=mysqli_query($conn,$q1);
	if(empty($r1)){
		//echo "database is not exist!!!<br>";

		//================create database=================
		$q2="create database project1";
		mysqli_query($conn,$q2);
		if(mysqli_query($conn,$q1)){
			//echo "database changed!<br>";
		}
		
	}else{
		//echo "database is exist!!<br>";
	}

	//============create user table======================
	$q3="select * from user";
	$r3=mysqli_query($conn,$q3);
	if(empty($r3)){
		//echo "user table does not exist!!<br>";
		$q4="create table user(user_id int(10) auto_increment,user_name char(30),sc_number char(8),password char(15),role char(20),email char(30),birth_date DATE,profile_pic varchar(255),primary key(user_id))";
		
		if(mysqli_query($conn,$q4)){
			//echo "user table is created!!!!<br>";
			$s1="insert into user(user_name,password,role,email,birth_date,profile_pic) values('admin1','admin1123','administrator','admin1@gmail.com','1964-5-23','default.jpg')";
			$s2="insert into user(user_name,password,role,email,birth_date,profile_pic) values('admin2','admin2123','administrator','admin2@gmail.com','1977-7-3','default.jpg')";
			$s3="insert into user(user_name,password,role,email,birth_date,profile_pic) values('admin3','admin3123','administrator','admin3@gmail.com','1988-1-2','default.jpg')";
			$s4="insert into user(user_name,password,role,email,birth_date,profile_pic) values('admin4','admin4123','administrator','admin4@gmail.com','1985-10-30','default.jpg')";
			$s5="insert into user(user_name,password,role,email,birth_date,profile_pic) values('admin5','admin5123','administrator','admin5@gmail.com','1975-2-3','default.jpg')";
			mysqli_query($conn,$s1);
			mysqli_query($conn,$s2);
			mysqli_query($conn,$s3);
			mysqli_query($conn,$s4);
			mysqli_query($conn,$s5);
		}else{
			echo "error".mysqli_error($conn);
		}
		
	}else{
		//echo "user table is exist!!!<br>";
	}

	//====================create question table================================================
	$q5="select * from question";
	$r5=mysqli_query($conn,$q5);
	if(empty($r5)){
		//echo "question table does not exist!!<br>";
		$q6="create table question(q_id int(100) auto_increment primary key, user_id int(10),category char(30),question varchar(500),submit_date DATE,submit_time char(12), num_views int(50),num_reply int(50))";
		
		if(mysqli_query($conn,$q6)){
			//echo "question table is created!!!!<br>";
		}else{
			echo "error".mysqli_error($conn);
		}
		
	}else{
		//echo "question table is exist!!!<br>";
	}

	//=====================create reply table==========================================

	$q7="select * from reply";
	$r7=mysqli_query($conn,$q7);
	if(empty($r7)){
		//echo "reply table does not exist!!<br>";
		$q8="create table reply(reply_id int(100) auto_increment primary key,q_id int(100),reply varchar(500),user_id int(100),submit_date DATE,time char(12),replyer_name char(50))";
		
		if(mysqli_query($conn,$q8)){
			//echo "reply table is created!!!!<br>";
		}else{
			echo "error".mysqli_error($conn);
		}
		
	}else{
		//echo "reply table is exist!!!<br>";
	}

	
	
	//=============create usageinfo table===========================
	$q9="select * from usageinfo";
	$r9=mysqli_query($conn,$q9);
	if(empty($r9)){
		//echo "usageinfo table does not exist!!<br>";
		$q10="create table usageinfo(usage_id int(100) auto_increment primary key,user_id int(100),login DATE,login_time char(10),logout_time char(10))";
		
		if(mysqli_query($conn,$q10)){
			//echo "usageinfo table is created!!!!<br>";
		}else{
			echo "error".mysqli_error($conn);
		}
		
	}else{
		//echo "usageinfo table is exist!!!<br>";
	}

	//==================create newnotice table==============================
	$q10="select * from new_notice";
	$r10=mysqli_query($conn,$q10);
	if(empty($r10)){
		// echo "new_notice table does not exist!!!<br>";
		$q11="create table new_notice (notice_id int(100) auto_increment primary key, user_id int(100),notice varchar(500),submit_date DATE, submit_time char(20))";

		if(mysqli_query($conn,$q11)){
			//echo "new_notice table is created!!!<br>";
		}else{
			echo "error1".mysql_error($conn);
		}

		
		$q12="insert into new_notice(user_id,notice,submit_date,submit_time) values(1,'Notice1!!','2017:12:5','11:21:AM')";
		$q13="insert into new_notice(user_id,notice,submit_date,submit_time) values(1,'Notice2!!','2017:12:5','11:21:AM')";
		$q14="insert into new_notice(user_id,notice,submit_date,submit_time) values(1,'Notice3!!','2017:12:5','11:21:AM')";
		mysqli_query($conn,$q12);
		mysqli_query($conn,$q13);
		mysqli_query($conn,$q14);
		

	}else{
		//echo "new_notice table is exist!!<br>";
	}

	//=========================create mentor table=======================================
	$q15="select * from mentor";
	$r15=mysqli_query($conn,$q15);
	if(empty($r15)){
		// echo "mentor table is does not exist!!!"
		$q16="create table mentor (id int(100) auto_increment primary key,user_table_id int(100), student_name varchar(100), mentor_id int(100))";
		if(mysqli_query($conn,$q16)){
			//echo "mentor table is created!!!";
			$q17="select * from user where role='student'";
			$r17=mysqli_query($conn,$q17);
			//$q18="select * from user where role='administrator'";
			//$r18=mysqli_query($conn,$q18);
			//=======update mentor table part1=========
			while ($row19=mysqli_fetch_assoc($r17)) {
				$st_id=$row19['user_id'];
				$student_name=$row19['user_name'];
				$q20="insert into mentor(user_table_id,student_name) values($st_id,'$student_name')";
				if(mysqli_query($conn,$q20)){
					//entered!!
					echo "okkk";
				}else{
					echo "er3".mysqli_error($conn);
				}
				
			}	
		}else{
			echo "error1".mysql_error($conn);
		}
	}else{
		//echo "mentor table is exist!!";
		
	}


	
?>