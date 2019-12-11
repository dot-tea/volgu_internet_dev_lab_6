-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 11 2019 г., 10:46
-- Версия сервера: 10.4.6-MariaDB
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `activity_data`
--

-- --------------------------------------------------------

--
-- Структура таблицы `activities`
--

CREATE TABLE `activities` (
  `id` int(4) NOT NULL,
  `activity_name` varchar(100) NOT NULL,
  `date_of_creation` date NOT NULL,
  `teacher_name` varchar(225) NOT NULL,
  `activity_plan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `activities`
--

INSERT INTO `activities` (`id`, `activity_name`, `date_of_creation`, `teacher_name`, `activity_plan`) VALUES
(1, 'Бумажное искусство', '2019-09-01', 'Лампов Лампа Лампович', ''),
(2, 'Рисование', '2019-08-01', 'Валентинов Валентин Валентиновн', ''),
(10, 'Тест', '2020-01-01', 'Пушкина Александра', '');

-- --------------------------------------------------------

--
-- Структура таблицы `blogposts`
--

CREATE TABLE `blogposts` (
  `id` int(3) NOT NULL,
  `user_id` int(4) NOT NULL,
  `title` varchar(70) NOT NULL,
  `date` date NOT NULL,
  `content` varchar(500) NOT NULL,
  `text_uid` varchar(100) DEFAULT NULL,
  `posted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `blogposts`
--

INSERT INTO `blogposts` (`id`, `user_id`, `title`, `date`, `content`, `text_uid`, `posted`) VALUES
(2, 1, 'А оно работает?', '2019-12-11', 'Интересно.', NULL, 0),
(3, 1, 'Первый пост', '2019-12-11', ' Я хачу скозать, что праверка арфаграфии – это бесусловно полезная вещь. Без неё мы бы так и продолжале песать бесграмотно.', '5df0839892b41', 0),
(5, 1, 'Тестируем анализатор орфографии на Text.ru', '2019-12-11', 'Этат текст я хачу посвятить пабедителю паследнего конкурса по аригами, я очень рада, што мы вышли пабедителями, в будущем мы станим непабедимыми', '5df0a30169728', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `parents`
--

CREATE TABLE `parents` (
  `id` int(4) NOT NULL,
  `user_id` int(4) DEFAULT NULL,
  `parent_name` varchar(255) NOT NULL,
  `workplace` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parents`
--

INSERT INTO `parents` (`id`, `user_id`, `parent_name`, `workplace`, `position`, `email`, `phone_number`) VALUES
(4, 7, 'Марио Марио', 'Грибное Королевство', 'Сантехник', 'welly@wow.ru', '+79999999999'),
(6, 9, 'Человек Разумный', 'Пещеры', 'Охотник', 'welly@wow.ru', '+79999999999');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(4) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `activity_id` int(4) NOT NULL,
  `date_of_entry` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `attended_lessons` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `student_name`, `activity_id`, `date_of_entry`, `email`, `phone_number`, `attended_lessons`) VALUES
(1, 'Иванова Наталья Николаевна', 1, '2019-09-03', 'nata@somewhere.ru', '+74268361612', 5),
(2, 'Александрова Ольга Анатольевна', 1, '2019-09-03', 'whatever@luchshayapochta.ru', '+73289423433', 4),
(3, 'Соколов Антон Валерьевич', 1, '2019-09-03', 'yep@yep.ru', '+73243124132', 3),
(4, 'Кузнецова Елизавета Сергеева', 1, '2019-09-01', 'well@wow.ru', '+79376643423', 8),
(5, 'Пушкина Александра Сергеевна', 1, '2019-11-02', 'welly@wow.ru', '+79999999997', 4),
(6, 'Буянов Ладно Океевич', 1, '2008-02-29', 'ladno@vk.com', '+79999999999', 1),
(7, 'Сильвесторов Василий', 1, '2019-09-01', 'pust.budet@ya.ru', '', 3),
(12, 'Новый Студент', 2, '2019-11-01', '', '', 12),
(13, 'Некто Некто Некто', 2, '2019-10-01', 'nani@omaewa.ru', '+74268361612', 3),
(24, 'Редактирую Без Проблем', 10, '2000-11-03', '', '', 3),
(25, 'мда мда', 2, '2019-11-01', '', '', 3),
(26, 'Лел Кек', 1, '2019-11-11', '', '', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `login` varchar(255) NOT NULL,
  `permission` varchar(60) NOT NULL,
  `activity_id` int(2) DEFAULT NULL,
  `md5` varchar(255) NOT NULL,
  `salt` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `permission`, `activity_id`, `md5`, `salt`) VALUES
(1, 'important_person', 'director', 2, '203189128b654f68ba0d8d8ad6c7b8c5', '8IRSTtYBnG'),
(5, 'lamp', 'teacher', 1, 'c5c7c2d19f5ad7c0f5b64ce3b3df4a86', 'WjDpNF75mD'),
(7, 'mario', 'parent', NULL, '496f0495e75b50b3b4ad847984340a9d', 'mACJ8Rz0fl'),
(9, 'nope_nope', 'parent', NULL, 'afd564c215a40baa1eba0235ae8ea6da', '75Nb4RlzcU');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blogposts`
--
ALTER TABLE `blogposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_post` (`user_id`);

--
-- Индексы таблицы `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_parent_user` (`user_id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_students_activity_id` (`activity_id`);
ALTER TABLE `students` ADD FULLTEXT KEY `all_student_char_fields` (`student_name`,`email`,`phone_number`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `FK_user_activity` (`activity_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `blogposts`
--
ALTER TABLE `blogposts`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `blogposts`
--
ALTER TABLE `blogposts`
  ADD CONSTRAINT `FK_user_post` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `FK_parent_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK_students_activity_id` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user_activity` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
