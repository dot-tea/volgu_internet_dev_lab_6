# Лабораторная работа №6

Скринкаст находится в Гугл-папке.

Релевантные файлы:
* В **activity_data_db_operations.php** находятся функции поиска по полям БД, **search_students_of($activity, $query_elements)**, в которой по ID кружка и данным поиска ищутся ученики, и **search_activities($query_elements)**, в которой производится поиск по кружкам.
* В том же файле есть функционал работы с таблицей пользователей: **get_user_data($login)** позволяет проверить существование пользователя с данным логином в БД и получить всю информацию об этом пользователе; **register_new_user($login, $password, $permission, $activity_id)** позволяет зарегистрировать пользователя с указанными данными; **delete_user($id)** удаляет пользоваетля по id.
* Также там есть функция добавления нового родителя **add_parent()**.
* **search_interface.php** содержит код, который по данному разрешению и данной таблице выводит интерфейс для поиска нужной сущности. Он вызывается в **my_cabinet.php**. Шаблоны форм поиска для соответствующих типов данных находится в **/cabinet/search_table_interface_elements.
* В **search_handler.js** содержится функция, которая по get-запросу восстанавливает в соответствующих полях формы поиска заданные в поиске значения - чтобы пользователь не вбивал поле по несколько раз.
* В **my_cabinet.php** содержится код, который обрабатывает показ неопубликованных постов директора.
* В **/cabinet/blog** содержится код, отвечающий за работу с таблицей постов. 
* * **blog_db_operations.php** содержит функции работы с таблицей постов директора. Можно просматривать нерелизнутые посты, добавлять и удалять черновики, а также проверять орфографию и получать информацию о проверенной орфографии.
* * **text_ru_api.php** содержит функции, которые как раз и взаимодействуют с сайтом.
* * **post_handler.php** обрабатывает нажатия всех функциональных клавиш в кабинете при режиме просмотра постов.
