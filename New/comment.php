<?php			
		
			
			$get_id = $_GET['post_id'];
			
			$get_com = "select * from reply where q_id=$get_id";
		    $run_com = mysqli_query($con,$get_com);
			
						
			while($row=mysqli_fetch_array($run_com)){
				$com = $row['reply'];
				$com_name = $row['replyer_name'];
				$date = $row['submit_date'];
				
				echo "
				<div id='comment'>
				<h4>$com_name</h4><span><i>Said</i> on $date</span>
				<p>$com</p>
				</div><br>";
			
			}	
?>