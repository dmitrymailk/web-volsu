-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Ноя 02 2020 г., 20:38
-- Версия сервера: 8.0.22-0ubuntu0.20.04.2
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(4, 'qwe', '76d80224611fc919a5d54f0ff9fba446'),
(10, 'asd', '7815696ecbf1c96e6894b779456d330e'),
(13, 'dimweb', '202cb962ac59075b964b07152d234b70'),
(18, 'dimweb2', '202cb962ac59075b964b07152d234b70'),
(19, 'qwe2', '516b5d9924c123fecc22e0eff6c3e179');

-- --------------------------------------------------------

--
-- Структура таблицы `user_orders`
--

CREATE TABLE `user_orders` (
  `user` varchar(50) NOT NULL,
  `date` date DEFAULT NULL,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_orders`
--

INSERT INTO `user_orders` (`user`, `date`, `uuid`) VALUES
('qwe', '2020-11-02', '53af4d65-66da-43f1-b8bd-106b6dae060f'),
('qwe', '2020-11-01', 'c4223ae5-f34a-4c7e-b1a1-951baf32c2a7'),
('qwe', '2020-11-01', 'c908e23b-5e89-4e8d-af61-4784476cb341'),
('qwe', '2020-11-01', 'eb41b103-7fd0-4b1a-b74a-4a4883ca662c');

-- --------------------------------------------------------

--
-- Структура таблицы `user_orders_products`
--

CREATE TABLE `user_orders_products` (
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img` text NOT NULL,
  `title` text NOT NULL,
  `amount` int NOT NULL,
  `price` int NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_orders_products`
--

INSERT INTO `user_orders_products` (`uuid`, `img`, `title`, `amount`, `price`, `type`) VALUES
('eb41b103-7fd0-4b1a-b74a-4a4883ca662c', '../img/products/meat/1.png', 'Сосиски баварские на гриле', 2, 798, 'product'),
('eb41b103-7fd0-4b1a-b74a-4a4883ca662c', '../img/products/vegetables/1.png', 'Сильно прожаренный картофель', 9, 1143, 'product'),
('eb41b103-7fd0-4b1a-b74a-4a4883ca662c', '../img/products/meat/3.png', 'Стейк с кровью', 2, 1398, 'product'),
('c908e23b-5e89-4e8d-af61-4784476cb341', '../img/products/vegetables/1.png', 'Сильно прожаренный картофель', 1, 127, 'product'),
('c4223ae5-f34a-4c7e-b1a1-951baf32c2a7', '../img/products/meat/1.png', 'Сосиски баварские на гриле', 2, 638, 'product'),
('53af4d65-66da-43f1-b8bd-106b6dae060f', '../img/products/meat/1.png', 'Сосиски баварские на гриле', 2, 798, 'product'),
('53af4d65-66da-43f1-b8bd-106b6dae060f', '../img/products/meat/3.png', 'Стейк с кровью', 9, 5031, 'product');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `user_order` (`user`);

--
-- Индексы таблицы `user_orders_products`
--
ALTER TABLE `user_orders_products`
  ADD KEY `on_order_delete` (`uuid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_orders`
--
ALTER TABLE `user_orders`
  ADD CONSTRAINT `user_order` FOREIGN KEY (`user`) REFERENCES `users` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_orders_products`
--
ALTER TABLE `user_orders_products`
  ADD CONSTRAINT `on_order_delete` FOREIGN KEY (`uuid`) REFERENCES `user_orders` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
