
<?php
  session_start();
  if(isset($_SESSION['name'])){
    $name=$_SESSION['name'];
  }
  
  $id=$_SESSION['id'];
  $password= $_SESSION['password'];
  $role= $_SESSION['role'];
  
    include 'php_function.php';
	include 'dbconnection.php';
	$host="localhost";
	$user="roland1";
	$password="alianza2";
	$database = "project";

	$con=mysqli_connect($host,$user,$password,$database);

    if(($role=='administrator') || ($role=='student') || ($role=='union')){


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forum</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>

        .jumbotron { 
            background-color: #9933cc; 
            color: #ffffff;
        }

        .jumbotron .btn-default{
            background-color: #6f0fa3;
            color: #fff;
        }

        .navbar {
            margin-bottom: 0;
            background-color: #6f0fa3;
            z-index: 9999;
            border: 0;
            font-size: 12px !important;
            line-height: 1.42857143 !important;
            letter-spacing: 4px;
            border-radius: 0;
        }

        .navbar li a, .navbar .navbar-brand {
            color: #fff !important;
        }

        .navbar-nav li a:hover, .navbar-nav li.active a {
            color: #6f0fa3 !important;
            background-color: #fff !important;
        }

        .navbar-default .navbar-toggle {
            border-color: transparent;
            color: #fff !important;
        }

        .mypink li.active a, .mypink li.active a:hover, .mypink li a:hover{
            color: #fff;
            background-color: #6f0fa3;
        }

    </style>
</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button>
                <a class="navbar-brand" href="#">UORForum</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="home22.php">HOME</a></li>
                    <li><a href="question.php">SUBMIT_QUESTION</a></li>
                    <?php
                        if($role=="administrator"){ ?>
                             <li><a href="notice.php">ENTER NEW_NOTICE</a></li>
                      <?php  }else{ ?>
                             <li class="disabled"><a href="#">ENTER NEW_NOTICE</a></li>
                      <?php  }
                    ?>
                   
                    <li><a href="login.php">SIGN_IN</a></li>
                    <li><a href="logout.php">SIGN_OUT</a></li>                  
                </ul>
                 <li class="nav-item active">
                  <p class="nav-link">Hello : <?php echo $name; ?></p>
                </li>
            </div>
        </div>
    </nav>

    <div class="jumbotron text-center">
        <h1>UORForum</h1> 
        <form class="form-inline" action="#" method="post" name="f1">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                <input type="text" name="txt_search" class="form-control" size="50" placeholder="Search" required>
                <div class="input-group-btn">
                    <button type="submit" name="btn_search" class="btn btn-default">Search</button>
                </div>
            </div>
        </form>

       
    </div>

    <div class="header">
        <h2 class="text-center">What our customers say</h2>
    	<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
    
        <!-- Wrapper for slides -->
        <div class="carousel-inner slideanim" role="listbox">
            <div class="item active">
               <!-- <h4>"This company is the best. I am so happy with the result!"<br><span style="font-style:normal;">Michael Roe, Vice President, Comment Box</span></h4>  -->
               <?php

                    //===========get last notice id=================
                    $q3="select * from new_notice order by notice_id desc";
                    $r3=mysqli_query($conn,$q3);
                    if(mysqli_num_rows($r3)>0){
                        while ($row3=mysqli_fetch_assoc($r3)) {
                            $number=$row3['notice_id'];
                            break;
                        }
                    }

                    //============get notice============
                    $q4="select * from new_notice where notice_id='$number'";
                    $r4=mysqli_query($conn,$q4);
                    if(mysqli_num_rows($r4)>0){
                        while ($row4=mysqli_fetch_assoc($r4)) {
                            $notice1=$row4['notice'];
                        }
                    }


               ?>
                <h4><?php echo $notice1 ?><br><span style="font-style:normal;">Michael Roe, Vice President, Comment Box</span></h4> 

            </div>
            <div class="item">
               <!-- <h4>"One word... WOW!!"<br><span style="font-style:normal;">John Doe, Salesman, Rep Inc</span></h4> -->
               <?php

                      //===========get last notice id=================
                    $q3="select * from new_notice order by notice_id desc";
                    $r3=mysqli_query($conn,$q3);
                    if(mysqli_num_rows($r3)>0){
                        while ($row3=mysqli_fetch_assoc($r3)) {
                            $number=$row3['notice_id'];
                            break;
                        }
                    }

                    $number=$number-1;

                    $q5="select * from new_notice where notice_id='$number'";
                    $r5=mysqli_query($conn,$q5);
                    if(mysqli_num_rows($r5)>0){
                        while ($row5=mysqli_fetch_assoc($r5)) {
                            $notice2=$row5['notice'];
                        }
                    }

               ?>
               <h4><?php echo $notice2 ?><br><span style="font-style:normal;">John Doe, Salesman, Rep Inc</span></h4>
            </div>
            <div class="item">
              <!--  <h4>"Could I... BE any more happy with this company?"<br><span style="font-style:normal;">Chandler Bing, Actor, FriendsAlot</span></h4> -->

              <?php

                      //===========get last notice id=================
                    $q3="select * from new_notice order by notice_id desc";
                    $r3=mysqli_query($conn,$q3);
                    if(mysqli_num_rows($r3)>0){
                        while ($row3=mysqli_fetch_assoc($r3)) {
                            $number=$row3['notice_id'];
                            break;
                        }
                    }

                    $number=$number-2;

                    $q6="select * from new_notice where notice_id='$number'";
                    $r6=mysqli_query($conn,$q6);
                    if(mysqli_num_rows($r6)>0){
                        while ($row6=mysqli_fetch_assoc($r6)) {
                            $notice3=$row6['notice'];
                        }
                    }

               ?>
               <h4><?php echo $notice3 ?><br><span style="font-style:normal;">John Doe, Salesman, Rep Inc</span></h4>



            </div>
        </div>
    
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    	</div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <ul class="nav nav-pills nav-stacked mypink">
                    <li class="active"><a href="home22.php">Home</a></li>
                    <li><a href="home22.php?sub=Academic">Academic</a></li>
                    <li><a href="home22.php?sub=Sport">Sport</a></li>
                    <li><a href="home22.php?sub=Hostal">Hostal</a></li>
                    <li><a href="home22.php?sub=Canteen">Canteen</a></li>
                    <li><a href="home22.php?sub=library">library</a></li>
                    <li><a href="home22.php?sub=Other">Other</a></li>
                </ul>
            </div>
            <div class="col-sm-6 text-center" >
                <?php single_post();?>
				
            </div>
			<div class="col-sm-4">
                <div class="panel panel-primary">
                    <?php
                    //include 'dbconnection.php'; 
                        $sql1 = "SELECT * FROM question";
                        $result = mysqli_query($conn,$sql1);
                        $num_rows = mysqli_num_rows($result);
                        //echo "Number Of Questions ".$num_rows."<br>";
                        for($i =1 ; $i<= $num_rows ; $i++){
                            $c[$i] = "SELECT * FROM reply WHERE q_id = $i";
                            $result1[$i]= mysqli_query($conn,$c[$i]);
                            $num_rows1[$i] = mysqli_num_rows($result1[$i]);
                           // echo "Number of Replies in ".$i." : ".$num_rows1[$i]."<br>";
                        }
                        echo "<br>";
                        for ($i=0; $i < 5; $i++) { 
                            $j = $i + 1;

                            if(!empty($num_rows1)){

                            echo "<div class='panel-body'>";
                            echo "<h3>Trending ". $j."</h3>";
                            echo "<form class='form-control'>";
                            $maxindex[$i] = array_search(max($num_rows1), $num_rows1);
                            //echo "Quetion Number ".$maxindex[$i]." ";
                            $sql2 = "SELECT * FROM question WHERE q_id= $maxindex[$i]";
                            $result2 = mysqli_query($conn,$sql2);
                            while($row = mysqli_fetch_assoc($result2)){
                                echo $row['question']."<br>";    
                            }
                            unset($num_rows1[$maxindex[$i]]);
                            echo "
                                <br>
                                <a href='#' class='btn btn-primary' style='float:right'>SEE</a>
                                </form>
                                </div>
                            ";

                            }
                        }   
                        
                  
                
                        ?>
                </div>
            </div>
		</div>
    </div>
    
</body>
</html>
<?php }else{
    header('location:home.php');


        /*========================selaa........

        11111111111111111====display related post=============(for searching)===
        2222222222222222=======display normal post with reply============


        */

 } ?>


