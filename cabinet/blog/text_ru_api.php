<?php
	/*
		2 функции для взаимодействия с API Text.ru посредством POST-запросов.
		Ответы с сервера приходят в формате JSON. 
	*/

	//-----------------------------------------------------------------------
	
	/**
	 * Добавление текста на проверку
	 *
	 * @param string $text - проверяемый текст
	 * @param string $user_key - пользовательский ключ
	 * @param string $exceptdomain - исключаемые домены
	 *
	 * @return string $text_uid - uid добавленного текста 
	 * @return int $error_code - код ошибки
	 * @return string $error_desc - описание ошибки
	 */
	function addPost($content)
	{
		$postQuery = array();
		$postQuery['text'] = $content;
		$postQuery['userkey'] = "4d5d983f7d11327b422520c69642fdfa";
		// домены разделяются пробелами либо запятыми. Данный параметр является необязательным.
		//$postQuery['exceptdomain'] = "site1.ru, site2.ru, site3.ru";
		// Раскомментируйте следующую строку, если вы хотите, чтобы результаты проверки текста были по-умолчанию доступны всем пользователям
		//$postQuery['visible'] = "vis_on";
		// Раскомментируйте следующую строку, если вы не хотите сохранять результаты проверки текста в своём архиве проверок
		//$postQuery['copying'] = "noadd";
		// Указывать параметр callback необязательно
		//$postQuery['callback'] = "Введите ваш URL-адрес, который примет наш запрос";

		$postQuery = http_build_query($postQuery, '', '&');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://api.text.ru/post');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postQuery);
		$json = curl_exec($ch);
        $errno = curl_errno($ch);
        
        $text_uid = '';
        $error_code = '';
        $error_desc = '';
        $errmsg = '';

		// если произошла ошибка
		if (!$errno)
		{
			$resAdd = json_decode($json);
			if (isset($resAdd->text_uid))
			{
				$text_uid = $resAdd->text_uid;
			}
			else
			{
				$error_code = $resAdd->error_code;
				$error_desc = $resAdd->error_desc;
			}
		}
		else
		{
			$errmsg = curl_error($ch);
        }

        curl_close($ch);
        
        $success_array = array();
        if ($error_code !== '') {
            $success_array['code'] = -1;
            $success_array['error_code'] = $error_code;
            $success_array['error_desc'] = $error_desc;
        }
        else if ($errmsg !== '') {
            $success_array['code'] = -2;
        }
        else {
            $success_array['code'] = 0;
            $success_array['text_uid'] = $text_uid;
        }

        return $success_array;
	}

	/**
	 * Получение статуса и результатов проверки текста в формате json
	 *
	 * @param string $text_uid - uid проверяемого текста
	 * @param string $user_key - пользовательский ключ
	 *
	 * @return float $unique - уникальность текста (в процентах)
	 * @return string $result_json - результат проверки текста в формате json
	 * @return int $error_code - код ошибки
	 * @return string $error_desc - описание ошибки
	 */
	function getResultPost($text_uid)
	{
		$postQuery = array();
		$postQuery['uid'] = $text_uid;
		$postQuery['userkey'] = "4d5d983f7d11327b422520c69642fdfa";
		// Раскомментируйте следующую строку, если вы хотите получить более детальную информацию в результатах проверки текста на уникальность
		$postQuery['jsonvisible'] = "detail";

		$postQuery = http_build_query($postQuery, '', '&');			 

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://api.text.ru/post');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postQuery);
		$json = curl_exec($ch);
		$errno = curl_errno($ch);

        $spell_check = '';
        $error_code = '';
        $error_desc = '';
        $errmsg = '';

		if (!$errno)
		{
			$resCheck = json_decode($json);
			if (isset($resCheck->text_unique))
			{
				$text_unique = $resCheck->text_unique;
                $result_json = $resCheck->result_json;
                $spell_check = $resCheck->spell_check;
			}
			else
			{
				$error_code = $resCheck->error_code;
				$error_desc = $resCheck->error_desc;
			}
		}
		else
		{
			$errmsg = curl_error($ch);
		}

        curl_close($ch);
        
        $success_array = array();
        if ($error_code !== '') {
            $success_array['code'] = -1;
            $success_array['error_code'] = $error_code;
            $success_array['error_desc'] = $error_desc;
        }
        else if ($errmsg !== '') {
            $success_array['code'] = -2;
        }
        else {
            $success_array['code'] = 0;
            $success_array['spell_check'] = $spell_check;
        }

        return $success_array;
    }
    
    function check_balance() {
        $postQuery = array();
        $postQuery['method'] = 'get_packages_info';
        $postQuery['userkey'] = '4d5d983f7d11327b422520c69642fdfa';

        $postQuery = http_build_query($postQuery, '', '&');			 

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://api.text.ru/account');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postQuery);
		$json = curl_exec($ch);
        $errno = curl_errno($ch);
        
        if (!$errno)
		{
			$balanceCheck = json_decode($json);
			if (isset($balanceCheck->size))
			{
				return $balanceCheck->size;
			}
			else
			{
				return -1;
			}
		}
		else
		{
			return -2;
		}
    }