<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New User</title>
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
    <script type="text/javascript">
        function validate(){
            var ch_empty=1;
            var ch_email=1;
            var ch_sc=1;
            

            var x=document.forms['f1']['name'].value;
            var y=document.forms['f1']['number'].value;
            var z=document.forms['f1']['email'].value;
            var p=document.forms['f1']['bday'].value;
            var q=document.forms['f1']['pass'].value;           

            ch_empty=check_Empty(x,y,z,p,q);
            ch_email=check_email(z);
            ch_sc=check_sc(y);

            if(ch_empty==0){
                alert("Please complete the form!!!");
                return false;
            }

            if(ch_email==0){
                alert("Invalid EMail!!");
                return false;
            }

            if(ch_sc==0){
                alert("Invalid SC NUmber!!");
                return false;
            }
            
        }

        function check_sc(y){
            var re=/^sc\/\d{4}\/\d{4}$/;
            //alert(s);
            if(y.match(re)){
                
            }else{
                //alert('invalid sc number');
                return 0;
            }
        }

        function check_email(z){
            emailID=z;
            atpos = emailID.indexOf("@");
            dotpos = emailID.lastIndexOf(".");

            if (atpos < 1 || ( dotpos - atpos < 2 )){
                //alert("Please enter correct email ID")
                //document.myForm.EMail.focus() ;
                return 0;//invalid email
            }
        }

        function check_Empty(x,y,z,p,q){
            if(x=="" || y=="" || z=="" || p=="" || q==""){
                //=======empty===
                return 0;
            }
        }

        function is_true_sc_number(s){
            var re=/^sc\/\d{4}\/\d{4}/;
            //alert(s);
            if(s.match(re)){
                return true;
            }else{
                //alert('invalid sc number');
                return false;
            }
        }

        

    </script>
</head>
<body>

    <div class="container"><br><br></div>

    <div class="container jumbotron">
        <h2 class="text-center">CREATE NEW ACCOUNT</h2>
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" name="f1" method="post" onsubmit="return validate()">
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">User Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter User Name" name="name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="number">SC Number:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="Enter SC Number" name="number">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pass">Password:</label>
                <div class="col-sm-10">          
                    <input type="password" class="form-control"  placeholder="Enter password" name="pass">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="bday">Birth Date:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Birth Date" name="bday">
                </div>
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="sub1">Create Account</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </form>

        <?php
		include('dbconnection.php');
		if(isset($_POST['sub1'])){

			//echo "hey!!";
			$name=$_POST['name'];
			$number=$_POST['number'];
			$email=$_POST['email'];
			$bday=$_POST['bday'];
			$pass=$_POST['pass'];
			$ch=0;



			//=============cheack user is already exist!!!===========================
			$q1="select * from user";
			$r1=mysqli_query($conn,$q1);
			if(mysqli_num_rows($r1)>0){
				while ($row1=mysqli_fetch_assoc($r1)) {
					if(($name==$row1['user_name']) && ($number==$row1['sc_number'])){
						$ch=1;
						break;
					}
				}
			}

					

			//====================update user table=====================================
					
			if($ch==0){
			    $q2="insert into user(user_name,sc_number,password,role,email,birth_date,profile_pic) values('$name','$number','$pass','student','$email','$bday','default.jpg')";
				$r2=mysqli_query($conn,$q2);
				if($r2){
					echo "New account is created!!";
				}
			    //=========update mentor table========================
			    $q5="select * from user where role='student' order by user_id desc limit 1";
				$r5=mysqli_query($conn,$q5);
				while ($row5=mysqli_fetch_assoc($r5)) {
					$user_table_id=$row5['user_id'];
					$student_name=$row5['user_name'];
				}
				$q6="insert into mentor(user_table_id,student_name) values($user_table_id,'$student_name')";
				mysqli_query($conn,$q6);

			}elseif ($ch==1) {
				echo "Account is already exist!!<br>";
			}

			//header('refresh:1');
		}

	    ?>

        <div class="col-sm-12">
            <p class="text-left"><a href="login.php"><span class="glyphicon glyphicon-backward"></span> Back</a></p>
        </div>      
    </div>

</body>
</html>