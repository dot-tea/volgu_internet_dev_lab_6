<?php
    session_start();
    if (isset($_SESSION['login'])) {
        require_once($_SERVER['DOCUMENT_ROOT']."/cabinet/activity_data_db_operations.php");
        $user_data = get_user_data($_SESSION['login']);
        if ('director' !== $user_data['permission']) {
            header("Location: /cabinet/my_cabinet.php");
            exit;
        }
        include_once($_SERVER['DOCUMENT_ROOT'].'/cabinet/blog/blog_db_operations.php');
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add_draft':
                    add_draft($user_data['id'], $_POST['title'], $_POST['content']);
                    break;
                case 'post':
                    release_blogpost($_POST['id']);
                    break;
                case 'delete':
                    delete_draft($_POST['id']);
                    break;
                case 'check_for_errors':
                    $success_array = check_for_errors($_POST['id']);
                    if ($success_array['code'] === -3) {
                        header("Location: /cabinet/my_cabinet.php?unreleased_posts=view&check_error=3");
                        exit;
                    }
                    if ($success_array['code'] === -2) {
                        header("Location: /cabinet/my_cabinet.php?unreleased_posts=view&check_error=2");
                        exit;
                    }
                    else if ($success_array['code'] === -1) {
                        header("Location: /cabinet/my_cabinet.php?unreleased_posts=view&check_error=1");
                        $_SESSION['check_err_code'] = $success_array['error_code'];
                        $_SESSION['check_err_desc'] = $success_array['error_desc'];
                        exit;
                    }
                    break;
                case 'view_results':
                    $success_array = view_check_results($_POST['id']);
                    if ($success_array['code'] === -3) {
                        header("Location: /cabinet/my_cabinet.php?unreleased_posts=view&check_error=3");
                        exit;
                    }
                    if ($success_array['code'] === -2) {
                        header("Location: /cabinet/my_cabinet.php?unreleased_posts=view&check_error=2");
                        exit;
                    }
                    else if ($success_array['code'] === -1) {
                        $_SESSION['check_err_code'] = $success_array['error_code'];
                        $_SESSION['check_err_desc'] = $success_array['error_desc'];
                        header("Location: /cabinet/my_cabinet.php?unreleased_posts=view&check_error=1");
                        exit;
                    }
                    else if ($success_array['code'] === 0) {
                        $_SESSION['spell_check'] = $success_array['spell_check'];
                        header("Location: /cabinet/my_cabinet.php?unreleased_posts=view&view_check=true");
                        exit;
                    }
                    break;
                default:
                    break;
            }
        }
        header("Location: /cabinet/my_cabinet.php?unreleased_posts=view");
    }
?>