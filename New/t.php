<!DOCTYPE html>
<html>
<head>
	<title>fff</title>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
	<div id="ee">
		<?php
		echo rand(0,100);
		?>
	</div>
	
	<script type="text/javascript">
		
		setInterval(
			function (){
				$('#ee').load('#ee');
			},1000

		);
	</script>
	
</body>
</html>