<?php
    /* 
        Possible errors:
        1: invalid first name
        2: invalid middle name
        3: invalid last name
        4: invalid workplace
        5: invalid position
        6: invalid e-mail
        7: invalid phone number
        8: invalid login
        9: invalid password
        10: passwords do not match
        11: login already exists
        12: server-side error: error on adding a new user
        13: server-side error: error on retrieving user ID
        14: server-side error: for some reason, an invalid activity ID was submitted
        15: server-side error: error on adding a new parent; corresponding user deleted successfully
        16: server-side error: for some reason, user ID doesn't exist
        17: server-side error: error on adding a new parent; corresponding user not deleted
    */
    if (isset($_POST['submit_form'])) {
        //Server-side validation

        $err_redirect = "Location: /cabinet/registration.php?err_code=";

        $fields = array(
            'first_name',
            'middle_name',
            'last_name',
            'workplace',
            'position',
            'email',
            'phone_number',
            'login',
            'password'
        );

        $field_info = array(
			'first_name' => array(
				'pattern' => "/^[а-яА-ЯёЁ\-]+$/ui",
				'errcode' => "1",
				'required' => true
			),
			'middle_name' => array(
				'pattern' => "/^[а-яА-ЯёЁ\-]+$/ui",
				'errcode' => "2",
				'required' => false
			),
			'last_name' => array(
				'pattern' => "/^[а-яА-ЯёЁ\-]+$/ui",
				'errcode' => "3",
				'required' => true
			),
			'workplace' => array(
				'pattern' => "/^[а-яА-ЯёЁa-zA-Z \-]+$/ui",
				'errcode' => "4",
				'required' => false
            ),
            'position' => array(
				'pattern' => "/^[а-яА-ЯёЁa-zA-Z \-]+$/ui",
				'errcode' => "5",
				'required' => false
            ),
			'email' => array(
				'pattern' => "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",
				'errcode' => "6",
				'required' => true
			),
			'phone_number' => array(
				'pattern' => "/^\+7\d{10}$/",
				'errcode' => "7",
				'required' => true
            ),
            'login' => array(
				'pattern' => "/^(?!_)(?!.*_{2})\w+(?<![_.])$/",
				'errcode' => "8",
				'required' => true
            ),
            'password' => array(
				'pattern' => "/^(?!_)(?!.*_{2})\w+(?<![_.])$/",
				'errcode' => "9",
				'required' => true
            )
        );
        
        foreach ($fields as $field) {
			$pattern = $field_info[$field]['pattern'];
			if (!preg_match($pattern,$_POST[$field]) && !(($_POST[$field] === '') && !($field_info[$field]['required']))) {
				header($err_redirect.$field_info[$field]['errcode']);
				exit;
			}
        }
        
        if ($_POST['confirm_password'] !== $_POST['password']) {
            header($err_redirect.'10');
            exit;
        }

        include_once($_SERVER['DOCUMENT_ROOT'].'/cabinet/activity_data_db_operations.php');
        if (get_user_data($_POST['login']) !== 2) {
            header($err_redirect.'11');
            exit;
        }
        
        //End of server-side validation

        $user_id = register_new_user($_POST['login'], $_POST['password'], 'parent', NULL);
        if (-1 === $user_id) {
            header($err_redirect.'12');
            exit;
        }
        else if (-2 === $user_id) {
            header($err_redirect.'13');
            exit;
        }
        else if (-3 === $user_id) {
            header($err_redirect.'14');
            exit;
        }
        $name = $_POST['last_name']." ".$_POST['first_name'];
		if ($_POST['middle_name'])
            $name .= " ".$_POST['middle_name'];

        $error_code = add_parent($user_id, $name, $_POST['workplace'], $_POST['position'], $_POST['email'], $_POST['phone_number']);

        if (-1 === $error_code) {
            $aborted_successfully = delete_user($user_id);
            if (0 === $aborted_successfully)
                header($err_redirect.'15');
            else
                header($err_redirect.'17');
            exit;
        }
        else if (-2 === $user_id) {
            header($err_redirect.'16');
            exit;
        }
        session_start();
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['viewed_table'] = 'my_apply_requests';
        header("Location: /cabinet/my_cabinet.php");
    }
    else {
        header("Location: /main.html");
    }
?>