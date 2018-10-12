<?php
    session_start();
    include('dbconnection.php');
    include('php_function.php');
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
    $password= $_SESSION['password'];
    $role= $_SESSION['role'];

    if(($role=='administrator') || ($role=='student') || ($role=='union')){ 
        
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile</title>
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
           
            

            var x=document.forms['f4']['uname'].value;
            var y=document.forms['f4']['pass'].value;
            var z=document.forms['f4']['email'].value;
            var p=document.forms['f4']['bday'].value;
                     

            ch_empty=check_Empty(x,y,z,p);
            ch_email=check_email(z);
           

            if(ch_empty==0){
                alert("Please complete the form!!!");
                return false;
            }

            if(ch_email==0){
                alert("Invalid Email!!");
                return false;
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

        function check_Empty(x,y,z,p){
            if(x=="" || y=="" || z=="" || p==""){
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
        <h2 class="text-center">HELLO : <?php echo $name ?></h2>

        <?php
			if($role=="student"){ ?>
        <div class="col-sm-12">  
            <p class="text-center"><a href="mentor_data.php">[ View Mentor ]</a><a href="user_profile.php">[ Home ]</a></p>
        </div>
        <?php	}  ?>
        
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" name="f1" method="post">
            <div class="form-group">        
                <div class='text-center'>
                    <button type="submit" class="btn btn-default" name="ch_pass">Change Password</button>
                    <button type="submit" class="btn btn-default" name="ch_picture">Change Profile Picture</button>
                    <button type="submit" class="btn btn-default" name="ch_email">Change Email</button>

                    <?php
					if($role=="administrator" && $name=="admin1"){ ?>
                    <button type="submit" class="btn btn-default" name="add_user">Add User</button>
                    <?php	}  ?>

                    <?php
					if($role=="administrator" && $name=="admin1"){ ?>
                    <a class="btn btn-default" href="add_mentor.php">Assign Mentor</a>
                    <?php	}  ?>

                </div>
            </div>
        </form>

        <?php

			if($_SERVER['REQUEST_METHOD']=="POST"){
				if(isset($_POST['add_mentor'])){
					//echo "add mentor";
					//add_mentor();
				}
			}




			if($_SERVER['REQUEST_METHOD']=="POST"){
				if(isset($_POST['ch_pass'])){//=================change password==========
					//echo "pass";
		?>
				    <form class="form-horizontal" action="#" method="post" name="f2">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="uname">Enter New Password:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Password" name="newpassword">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="sub1" class="btn btn-default">Submit</button>
                            </div>
                        </div>
				    </form>
								
        <?php	}
        
				if(isset($_POST['ch_picture'])){//============change profile picture========
                    //echo "picture"; ?>
                    <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="fileToUpload">Select image to upload:</label>
                            <div class="col-sm-7">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-7">
                                <input style="color:#6f0fa3" type="submit" value="Upload Image" name="sub3">
                            </div>
                        </div>
                    </form>
        <?php   }
                
				if(isset($_POST['ch_email'])){//=============change email==================
                    //echo "ch_email"; ?>
                    
				    <form class="form-horizontal" action="#" method="post" name="f3">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="uname">Enter New Email:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Email" name="newEmail">
                            </div>
                        </div>	
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="sub2" class="btn btn-default">Submit</button>
                            </div>
                        </div>						
					</form>

		<?php	}

					//header("refresh:1");
			}	


        //==========================updatin user table ==========(new password,new email,add new administrators=====)==============
			if($_SERVER['REQUEST_METHOD']=="POST"){
				if(isset($_POST['sub1'])){
					//echo "sub1";
					$newpassword=$_POST['newpassword'];
					$q1="update user set password='$newpassword' where user_id='$id'";
					if(mysqli_query($conn,$q1)){
						echo "Password changed Successfully!!!";		
					}else{
						echo "not changed!".mysqli_error($conn);
					}
					header("refresh:1");
                }
                
				if(isset($_POST['sub2'])){
					//echo "sub2";
					$newEmail=$_POST['newEmail'];
					$q2="update user set email='$newEmail' where user_id='$id'";
					if(mysqli_query($conn,$q2)){
						echo "email changed Successfully!!!";		
					}else{
						echo "not changed!".mysqli_error($conn);
					}
					header("refresh:1");

                }
                
                if(isset($_POST['sub3'])){

                    //Upload Images to images/ folder

					$target_dir = "images/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
                    // Check file size
                    if ($_FILES["fileToUpload"]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

                    //Update user table with prfile_pic
                    
					$newPic=basename($_FILES["fileToUpload"]["name"]);
					$q4="update user set profile_pic='$newPic' where user_id='$id'";
					if(mysqli_query($conn,$q4)){
						echo "<br>Profile picture changed Successfully!!!";		
					}else{
						echo "not changed!".mysqli_error($conn);
					}
					header("refresh:1");

                }

				if(isset($_POST['submit4'])){
					//echo "enterrd!!";
					$username=$_POST['uname'];
					$Password=$_POST['pass'];
					$email=$_POST['email'];
					$bday=$_POST['bday'];

					$q3="insert into user(user_name,password,role,email,birth_date,profile_pic) values('$username','$Password','administrator','$email','$bday','default.jpg')";
					if(mysqli_query($conn,$q3)){
						echo "adding Successfully!!<br>";
					}else{
						echo "error1".mysqli_error($conn);
					}


					//header('refresh:1');
				}

			}

		?>

	
		

	    <?php
	    //===================add new addminitore=============(only for adminitratotrss)================

		    if($_SERVER['REQUEST_METHOD']=="POST"){
			    if(isset($_POST['add_user'])){ ?>
					<form class="form-horizontal" action="#" name="f4" method="post"  onsubmit="return validate()">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="uname">User Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter User Name" name="uname">
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
                                <button type="submit" class="btn btn-default" name="submit4">Create Account</button>
                                <button type="reset" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
					</form>


		        <?php }
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