<?php			
		
			
			$get_id = $_GET['post_id'];
			
			$get_com = "select * from reply where q_id=$get_id";
		    $run_com = mysqli_query($con,$get_com);
			
						
			while($row=mysqli_fetch_array($run_com)){
				$com = $row['reply'];
				$com_id = $row['replyer_name'];

				$reply_name="select user_name from user where user_id='$com_id'";
				$run_reply_name=mysqli_query($con,$reply_name);
				$get_reply_name=mysqli_fetch_array($run_reply_name);
				$name=$get_reply_name['user_name'];

				$date = $row['submit_date'];
				
				echo "
				<div id='comment'>
				<h4 style='background-color:#c0c0c0'>$name</h4><span><i>Said</i> on $date</span><br>
				<p>$com</p>
				</div><br>";
			
			}	
?>