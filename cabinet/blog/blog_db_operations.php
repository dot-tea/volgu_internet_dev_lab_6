<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/cabinet/activity_data_db_operations.php");

    function show_unreleased_blogposts() {
        $db = connect_to_activity_database();

        $query_result = $db->query("SELECT * FROM `blogposts` WHERE `posted` = FALSE");
        while ($post = $query_result->fetch(PDO::FETCH_ASSOC)) {
            $login_get = $db->query("SELECT `login` FROM `users` WHERE `id` = ".$post['user_id']);
            $temp = $login_get->fetch(PDO::FETCH_NUM);
            $login = $temp[0];
            if (NULL === $post['text_uid'])
                $post['text_uid'] = '';
            echo '
                <h1 class="mt-4">'.$post['title'].'</h1>
	            <hr>
                <p>'.$post['date'].', by '.$login.'</p>
                <hr>
                <p>'.$post['content'].'</p>
                <hr>
                <form method="post" action="/cabinet/blog/post_handler.php">
                    <input type="text" name="id" hidden value="'.$post['id'].'">
                    <button type="submit" name="action" value="post" class="btn btn-primary">Опубликовать</button>
                    <button type="submit" name="action" value="delete" class="btn btn-primary">Удалить</button>
            ';
            if ('' !== $post['text_uid'])
                echo '<button type="submit" name="action" value="view_results" class="btn btn-primary">Просмотр результата проверки</button>';
            else
                echo '<button type="submit" name="action" value="check_for_errors" class="btn btn-primary">Проверить на орфографию с помощью Text.ru</button>
                (Размер текста: '.mb_strlen($post['content']).', мин. требуемый размер: 100)';
            echo '
                </form>
                <hr>
                <br>
            ';
        }
    }

    function show_released_blogposts() {
        $db = connect_to_activity_database();
        
        $query_result = $db->query("SELECT * FROM `blogposts` WHERE `posted` = TRUE");
        while ($post = $query_result->fetch(PDO::FETCH_ASSOC)) {
            echo '
                <h1 class="mt-4">'.$post['title'].'</h1>
	            <hr>
                <p>'.$post['date'].'</p>
                <hr>
                <p>'.$post['content'].'</p>
                <hr>
                <br>
            ';
        }
    }

    function release_blogpost($id) {
        $db = connect_to_activity_database();

        $ids = get_ids_from('blogposts');
        if (!in_array($id,$ids)) {
            return -2;
        }

        $query_result = $db->prepare("UPDATE `blogposts` SET `posted` = TRUE, `date` = CURRENT_DATE() WHERE `blogposts`.`id` = :id");
        $query_result->execute(array(
            ':id' => $id
        ));

        if ('00000' !== $query_result->errorCode())
			return -1;
		else
			return 0;
    }

    function add_draft($user_id, $title, $content) {
        $db = connect_to_activity_database();

        $ids = get_ids_from('users');
        if (!in_array($user_id,$ids)) {
            return -2;
        }
        $query_result = $db->prepare("INSERT INTO `blogposts` (`id`, `user_id`, `title`, `date`, `content`, `text_uid`, `posted`) 
        VALUES (NULL, :user_id_placeholder, :title, CURRENT_DATE(), :content, NULL, FALSE)");

        $query_result->execute(array(
            ':user_id_placeholder' => $user_id,
            ':title' => $title,
            ':content' => $content
        ));

        if ('00000' !== $query_result->errorCode())
			return -1;
		else
			return 0;
    }

    function delete_draft($id) {
        $db = connect_to_activity_database();

        $query_result = $db->prepare("DELETE FROM `blogposts` WHERE `blogposts`.`id` = :id");

        $query_result->execute(array(
            ':id' => $id
        ));

        if ('00000' !== $query_result->errorCode())
			return -1;
		else
			return 0;
    }

    function check_for_errors($id) {
        $db = connect_to_activity_database();

        $query_result = $db->prepare("SELECT `content` FROM `blogposts` WHERE `id` = :id");
        $query_result->execute(array(
            ':id' => $id
        ));

        if ('00000' !== $query_result->errorCode())
            return array('code' => -3);
        
        $temp = $query_result->fetch(PDO::FETCH_NUM);
        $content = $temp[0];

        include_once($_SERVER['DOCUMENT_ROOT']."/cabinet/blog/text_ru_api.php");

        $success_array = addPost($content);
        if (isset($success_array['text_uid'])) {
            $query_result = $db->prepare("UPDATE `blogposts` SET `text_uid` = :text_uid WHERE `blogposts`.`id` = :id");
            $query_result->execute(array(
                ':text_uid' => $success_array['text_uid'],
                ':id' => $id
            ));
        }
        return $success_array;
    }

    function view_check_results($id) {
        $db = connect_to_activity_database();

        $query_result = $db->prepare("SELECT `text_uid` FROM `blogposts` WHERE `id` = :id");
        $query_result->execute(array(
            ':id' => $id
        ));

        if ('00000' !== $query_result->errorCode())
            return array('code' => -3);
        
        $temp = $query_result->fetch(PDO::FETCH_NUM);
        $text_uid = $temp[0];

        include_once($_SERVER['DOCUMENT_ROOT']."/cabinet/blog/text_ru_api.php");

        $success_array = getResultPost($text_uid);
        return $success_array;
    }
?>