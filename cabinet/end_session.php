<?php
	session_start();
	if (isset($_SESSION['login'])) {
		session_destroy();
		$_SESSION = array();
	}
	header("Location: /main.html");
?>