<?php
	session_start();
	session_destroy(); // Supprimer la session
	header('location:index.php');
	exit();
?>