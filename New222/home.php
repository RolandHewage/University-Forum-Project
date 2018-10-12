<?php
    include('dbconnection.php');
    include('php_function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>UORForum Home</title>
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

        footer .glyphicon {
            font-size: 40px;
            margin-bottom: 20px;
            color: #6f0fa3;
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

        .carousel-control.right, .carousel-control.left {
            background-image: none;
            color: #9933cc;
        }

        .carousel-indicators li {
            border-color: #6f0fa3;
        }

        .carousel-indicators li.active {
            background-color: #6f0fa3;
        }

        .item h4 {
            font-size: 19px;
            line-height: 1.375em;
            font-weight: 400;
            font-style: italic;
            margin: 70px 0;
        }

        .mypink li a{
            font-size: 19px;
            line-height: 1.375em;
            font-weight: 400;
            background-color: #f5f5f5;
            color: #9933cc;
            box-shadow:1px 2px 4px grey;
        }

        .mypink li.active a, .mypink li.active a:hover, .mypink li a:hover{
            border-color: transparent;
            color: #fff;
            background-color: #6f0fa3;
        }

        .mypink1{
            border-color: #f5f5f5;
        }

        .mypink1 .panel-heading, .mypink1 .btn-primary{
            border-color: transparent;
            color: #fff;
            background-color: #9933cc;
        }

        .mypink2{
            border-color: #f5f5f5;
            border-radius: 20px;
        }

        .mypink2 .panel-heading, .mypink2 .btn, .mypink2 h3{
            border-color: transparent;
            color: #fff;
            background-color: #9933cc;
        }

        .mypink2 .panel-body{
            border-color: transparent;
            color: #9933cc;
            background-color: #ffffff; 
        }

        /*Slide in Elements*/
        .slideanim {visibility:hidden;}
        .slide {
            /* The name of the animation */
            animation-name: slide;
            -webkit-animation-name: slide;
            /* The duration of the animation */
            animation-duration: 1s;
            -webkit-animation-duration: 1s;
            /* Make the element visible */
            visibility: visible;
        }
        /* Go from 0% to 100% opacity (see-through) and specify the percentage from when to slide in the element along the Y-axis */
        @keyframes slide {
            0% {
                opacity: 0;
                transform: translateY(70%);
            } 
            100% {
                opacity: 1;
                transform: translateY(0%);
            }
        }
        @-webkit-keyframes slide {
            0% {
                opacity: 0;
                -webkit-transform: translateY(70%);
            } 
            100% {
                opacity: 1;
                -webkit-transform: translateY(0%);
            }
        }

    </style>
</head>
<body id="myPage">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button>
                <a class="navbar-brand" href="home.php">UORForum</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> SIGN_IN</a></li>                  
                </ul>
            </div>
        </div>
    </nav>

    <div class="jumbotron text-center">
        <h1>UORForum</h1> 
        <form class="form-inline" action="home.php" method="post" name="f2">
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
        <h2 class="text-center">Latest Notices</h2>
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
                if(!empty($number)){
                    $q4="select * from new_notice where notice_id='$number'";
                    $r4=mysqli_query($conn,$q4);
                    if(mysqli_num_rows($r4)>0){
                        while ($row4=mysqli_fetch_assoc($r4)) {
                            $notice1=$row4['notice'];
                        }
                    }
                }else{
                    $notice1="...";
                }


                ?>
                <h4><span style="font-style:normal;"><?php echo $notice1 ?></span><br></h4>

            </div>
            <div class="item">
                
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

                if(!empty($number)){

                    $number=$number-1;

                    $q5="select * from new_notice where notice_id='$number'";
                    $r5=mysqli_query($conn,$q5);
                    if(mysqli_num_rows($r5)>0){
                        while ($row5=mysqli_fetch_assoc($r5)) {
                            $notice2=$row5['notice'];
                        }
                    }
                }else{
                    $notice2="...";
                }

                ?>
                <h4><span style="font-style:normal;"><?php echo $notice2 ?></span><br></h4>

            </div>
            <div class="item">
                
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

                if(!empty($number)){

                    $number=$number-2;

                    $q6="select * from new_notice where notice_id='$number'";
                    $r6=mysqli_query($conn,$q6);
                    if(mysqli_num_rows($r6)>0){
                        while ($row6=mysqli_fetch_assoc($r6)) {
                            $notice3=$row6['notice'];
                        }
                    }
                }else {
                    $notice3="...";
                }

                ?>
                <h4><span style="font-style:normal;"><?php echo $notice3 ?></span><br></h4>

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

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 slideanim">
                <ul class="nav nav-pills nav-stacked mypink">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="home.php?sub=Academic">Academic</a></li>
                    <li><a href="home.php?sub=Sport">Sport</a></li>
                    <li><a href="home.php?sub=Hostal">Hostal</a></li>
                    <li><a href="home.php?sub=Canteen">Canteen</a></li>
                    <li><a href="home.php?sub=Library">Library</a></li>
                    <li><a href="home.php?sub=Other">Other</a></li>
                </ul>
            </div>
            <div class="col-sm-6 text-center">

                <?php
                 
                    if($_SERVER['REQUEST_METHOD']=="POST" || $_SERVER['REQUEST_METHOD']=="GET" ){                     
                        if(isset($_POST['btn_search'])){
                                   
                            serach_btn();
                            // echo "ser_btn";
                        }elseif(isset($_GET['sub'])){
                            get_search_from_side_panel();   
                                    
                        }else{
                            //echo "yes";
                               
                            get_posts();
                        }
                    }

               ?>

                <ul class="pagination mypink">
                    <li><a href="home.php?page=1">1</a></li>
                    <li><a href="home.php?page=2">2</a></li>
                    <li><a href="home.php?page=3">3</a></li>
                    <li><a href="home.php?page=4">4</a></li>
                    <li><a href="home.php?page=5">5</a></li>
                </ul>
            </div>
            <div class="col-sm-4 slideanim">
                <div class="panel panel-primary mypink1">
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
                        //echo "<br>";
                        for ($i=0; $i < 5; $i++) { 
                            $j = $i + 1;
                            if(!empty($num_rows1)){

                                echo "<div class='panel-heading'>";
                                    echo "<h3>Trending ". $j."</h3>";
                                echo "</div>";

                                echo "<div class='panel-body'>";
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

                                echo "<div class='panel-footer'>";
                                    echo "<br>";
                                echo "</div>";
                            }
                        }   
                        
                    ?> 
                </div>

            </div>
        </div>
    </div>

    <footer class="container-fluid jumbotron text-center">
        <a href="#myPage" title="To Top">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
        <p>Owned by UOR</p> 
    </footer>

    <script>
        $(document).ready(function(){

            $(window).scroll(function() {
                $(".slideanim").each(function(){
                    var pos = $(this).offset().top;

                    var winTop = $(window).scrollTop();
                    if (pos < winTop + 600) {
                        $(this).addClass("slide");
                    }
                });
            });

        })
    </script>
  
</body>
</html>