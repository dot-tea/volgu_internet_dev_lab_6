<?php
	session_start();
	include_once($_SERVER['DOCUMENT_ROOT'].'/cabinet/activity_data_db_operations.php');
	if (isset($_POST['submit'])) {
		$login = $_POST['login'];
		$entered_password = $_POST['password'];
		$user_data = get_user_data($login);
		if (1 === $user_data) {
			header("Location: /cabinet/error_message.php?err=3"); //server-side error
			exit;
		}
		else if (2 === $user_data) {
			header("Location: /cabinet/error_message.php?err=1"); //non-existent user
			exit;
		}
		else if (md5(md5($entered_password).$user_data['salt']) === $user_data['md5']) {
			$_SESSION['login'] = $login;
			switch ($user_data['permission']) {
				case 'director':
					$_SESSION['viewed_table'] = 'activities';
					break;
				case 'teacher':
					$_SESSION['viewed_table'] = 'students_of_my_activity';
					break;
				case 'parent':
					$_SESSION['viewed_table'] = 'my_apply_requests';
					break;
			}
			header("Location: /cabinet/my_cabinet.php");
		}
		else {
			header("Location: /cabinet/error_message.php?err=2"); //incorrect password
		}
	}
	else
		header("Location: /main.html");
?>