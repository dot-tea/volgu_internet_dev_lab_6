<?php
	session_start();
	if (isset($_SESSION['login']))
		header("Location: /cabinet/my_cabinet.php");
	else
		header("Location: /cabinet/login.html");
?>