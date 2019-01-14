-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 14 2019 г., 06:54
-- Версия сервера: 5.7.16
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `student`
--

-- --------------------------------------------------------

--
-- Структура таблицы `abiturients`
--

CREATE TABLE `abiturients` (
  `abiturient_id` int(11) NOT NULL,
  `abiturient_fullname` text NOT NULL,
  `abiturient_exam_type` text NOT NULL,
  `abiturient_reg_id` int(11) NOT NULL,
  `abiturient_private_score` int(11) NOT NULL,
  `abiturient_choose_speciality_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `abiturients`
--

INSERT INTO `abiturients` (`abiturient_id`, `abiturient_fullname`, `abiturient_exam_type`, `abiturient_reg_id`, `abiturient_private_score`, `abiturient_choose_speciality_id`) VALUES
(1, 'Быков Павел Андреевич', 'КТ', 123456, 10, 1),
(2, 'Иванов Иван Иванович', 'ЕГЭ', 234567, 5, 3),
(3, 'Сидоров Сидор Сидорович', 'ЕГЭ', 345678, 0, 2),
(4, 'Николаев Николай Николаевич', 'КТ', 456789, 6, 1),
(5, 'Петров Петр Петрович', 'КТ', 567890, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `choose_specialities`
--

CREATE TABLE `choose_specialities` (
  `id` int(11) NOT NULL,
  `speciality_id` int(11) NOT NULL,
  `student_reg_id` int(11) NOT NULL,
  `total_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `choose_specialities`
--

INSERT INTO `choose_specialities` (`id`, `speciality_id`, `student_reg_id`, `total_score`) VALUES
(1, 1, 123456, 220),
(2, 2, 123456, 202),
(3, 3, 123456, 202),
(4, 1, 234567, 220),
(5, 2, 345678, 210),
(6, 2, 456789, 257);

-- --------------------------------------------------------

--
-- Структура таблицы `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `abiturient_reg_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `exam`
--

INSERT INTO `exam` (`exam_id`, `abiturient_reg_id`, `subject_id`, `score`) VALUES
(1, 123456, 1, 90),
(2, 123456, 2, 70),
(3, 123456, 3, 70),
(4, 123456, 4, 63),
(5, 234567, 1, 90),
(6, 234567, 2, 70),
(7, 234567, 3, 70),
(8, 345678, 1, 60),
(9, 345678, 2, 70),
(10, 345678, 4, 80),
(11, 456789, 1, 55),
(12, 456789, 2, 90),
(13, 456789, 4, 96);

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `likes` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`likes`) VALUES
(1);

-- --------------------------------------------------------

--
-- Структура таблицы `specialities`
--

CREATE TABLE `specialities` (
  `speciality_id` int(11) NOT NULL,
  `speciality_name` text NOT NULL,
  `subject1_id` int(11) NOT NULL,
  `subject2_id` int(11) NOT NULL,
  `subject3_id` int(11) NOT NULL,
  `subject1_min` int(11) NOT NULL,
  `subject2_min` int(11) NOT NULL,
  `subject3_min` int(11) NOT NULL,
  `budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `specialities`
--

INSERT INTO `specialities` (`speciality_id`, `speciality_name`, `subject1_id`, `subject2_id`, `subject3_id`, `subject1_min`, `subject2_min`, `subject3_min`, `budget`) VALUES
(1, '01.01.01 Информатика и вычислительная техника', 1, 2, 3, 36, 55, 55, 60),
(2, '09.09.09 Ядерная физика', 1, 2, 4, 36, 55, 55, 20),
(3, '08.08.08 Прикладная математика', 1, 2, 4, 36, 60, 60, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(1, 'Русский язык'),
(2, 'Математика'),
(3, 'Информатика'),
(4, 'Физика'),
(5, 'Химия'),
(6, 'История');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `abiturients`
--
ALTER TABLE `abiturients`
  ADD PRIMARY KEY (`abiturient_id`);

--
-- Индексы таблицы `choose_specialities`
--
ALTER TABLE `choose_specialities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Индексы таблицы `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`speciality_id`);

--
-- Индексы таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `abiturients`
--
ALTER TABLE `abiturients`
  MODIFY `abiturient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `choose_specialities`
--
ALTER TABLE `choose_specialities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `specialities`
--
ALTER TABLE `specialities`
  MODIFY `speciality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
