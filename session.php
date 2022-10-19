
<?php
	session_start();
	if(!isset($_SESSION['user'])) {			
		header("location:authentification.php");
		exit();
	}
?>



