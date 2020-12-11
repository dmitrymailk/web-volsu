-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 11 2020 г., 19:48
-- Версия сервера: 8.0.22-0ubuntu0.20.04.3
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
-- Структура таблицы `drinks`
--

CREATE TABLE `drinks` (
  `uuid` varchar(40) NOT NULL,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `price` int NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'drinks'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `fruits`
--

CREATE TABLE `fruits` (
  `uuid` varchar(40) NOT NULL,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `price` int NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'fruits'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `fruits`
--

INSERT INTO `fruits` (`uuid`, `title`, `img`, `price`, `type`) VALUES
('568cccbb-0e7b-4683-bad2-0d95d4bf6717', 'apple w2323', 'http://localhost/web-volsu/backend/uploads/568cccbb-0e7b-4683-bad2-0d95d4bf6717.jpg', 2, 'fruits'),
('c8501ffa-95f9-4c45-beab-7b843273b92e', 'another apple', 'http://localhost/web-volsu/backend/uploads/c8501ffa-95f9-4c45-beab-7b843273b92e.jpg', 9999, 'fruits');

-- --------------------------------------------------------

--
-- Структура таблицы `meat`
--

CREATE TABLE `meat` (
  `uuid` varchar(40) NOT NULL,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `price` int NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'meat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `meat`
--

INSERT INTO `meat` (`uuid`, `title`, `img`, `price`, `type`) VALUES
('99499cbd-e8bc-489e-af66-53c59e65c1b3', 'Meat type 3', 'http://localhost/web-volsu/backend/uploads/99499cbd-e8bc-489e-af66-53c59e65c1b3.png', 45, 'meat');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `uuid` varchar(40) NOT NULL,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `price` int NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'products'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`uuid`, `title`, `img`, `price`, `type`) VALUES
('9832ad3b-15a1-49ed-a051-3143427e1f5c', 'Курицааа 47', 'http://localhost/web-volsu/backend/uploads/9832ad3b-15a1-49ed-a051-3143427e1f5c.png', 1234, 'products'),
('ea6dc51b-ffac-48c5-be5f-b4031b139d30', 'qwe qwe', 'http://localhost/web-volsu/backend/uploads/ea6dc51b-ffac-48c5-be5f-b4031b139d30.png', 1233, 'products');

-- --------------------------------------------------------

--
-- Структура таблицы `sweets`
--

CREATE TABLE `sweets` (
  `uuid` varchar(40) NOT NULL,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `price` int NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'sweets'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` text,
  `role` varchar(100) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`) VALUES
(4, 'qwe', '76d80224611fc919a5d54f0ff9fba446', 'admin'),
(10, 'asd', '7815696ecbf1c96e6894b779456d330e', 'user'),
(13, 'dimweb', '202cb962ac59075b964b07152d234b70', 'user'),
(18, 'dimweb2', '202cb962ac59075b964b07152d234b70', 'user'),
(19, 'qwe2', '516b5d9924c123fecc22e0eff6c3e179', 'user'),
(21, 'qweqwe', '5bacd9f25613659b2fbd2f3a58822e5c', 'user'),
(22, 'new_user_1', 'cb92197c719411e858b9c6003b45b7d9', 'user'),
(23, 'new_user_2', 'c85a9d7ff2fea37d927b0423ca8d992c', 'user'),
(24, 'new_user_3', '37e11fa2085b66a66d2c01ed7183a5a6', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `user_log`
--

CREATE TABLE `user_log` (
  `type` varchar(100) NOT NULL,
  `action_time` datetime NOT NULL,
  `user_login` varchar(50) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_log`
--

INSERT INTO `user_log` (`type`, `action_time`, `user_login`, `info`) VALUES
('logged', '2020-12-09 00:00:00', 'qwe', 'User logged successfully!'),
('visit page', '2020-12-09 00:00:00', 'qwe', 'visit menu page'),
('logout', '2020-12-09 00:00:00', 'qwe', 'loooogout'),
('logged', '2020-12-09 20:58:15', 'qwe', 'User logged successfully!'),
('visit page', '2020-12-09 20:58:30', 'qwe', 'visit menu page'),
('logout', '2020-12-09 20:58:48', 'qwe', 'loooogout'),
('logged', '2020-12-09 21:01:04', 'qwe', 'User logged successfully!'),
('visit page', '2020-12-09 21:01:04', 'qwe', 'visit profile page'),
('visit page', '2020-12-09 21:01:08', 'qwe', 'visit menu page'),
('visit page', '2020-12-09 21:01:09', 'qwe', 'visit lab-7-page page'),
('visit page', '2020-12-09 21:01:11', 'qwe', 'visit busket page'),
('visit page', '2020-12-09 21:01:12', 'qwe', 'visit profile page'),
('visit page', '2020-12-09 21:01:14', 'qwe', 'visit menu page'),
('visit page', '2020-12-09 21:01:15', 'qwe', 'visit lab-7-page page'),
('visit page', '2020-12-09 21:01:17', 'qwe', 'visit lab-7-page page'),
('visit page', '2020-12-09 21:03:30', 'qwe', 'visit product-info page'),
('upload item', '2020-12-09 21:03:49', 'qwe', 'upload another apple 9999 fruits ');

-- --------------------------------------------------------

--
-- Структура таблицы `user_orders`
--

CREATE TABLE `user_orders` (
  `user` varchar(50) NOT NULL,
  `date` date DEFAULT NULL,
  `order_uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_orders`
--

INSERT INTO `user_orders` (`user`, `date`, `order_uuid`) VALUES
('dimweb', '2020-12-09', '880a010e-c299-4363-827b-7e14d62faf6d'),
('dimweb', '2020-11-20', 'be38cf07-18de-4746-b31e-bdeb55d057d7'),
('new_user_2', '2020-11-24', 'c6c7d42c-a177-4db2-8256-3c3ccb7e9454'),
('qweqwe', '2020-11-20', 'fe3ec1b9-140f-46a9-92d5-46f10c113bd7');

-- --------------------------------------------------------

--
-- Структура таблицы `user_orders_products`
--

CREATE TABLE `user_orders_products` (
  `order_uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img` text NOT NULL,
  `title` text NOT NULL,
  `amount` int NOT NULL,
  `price` int NOT NULL,
  `type` varchar(100) NOT NULL,
  `product_uuid` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_orders_products`
--

INSERT INTO `user_orders_products` (`order_uuid`, `img`, `title`, `amount`, `price`, `type`, `product_uuid`) VALUES
('fe3ec1b9-140f-46a9-92d5-46f10c113bd7', 'http://localhost/web-volsu/backend/uploads/ea6dc51b-ffac-48c5-be5f-b4031b139d30.png', 'qwe qwe', 4, 3944, 'product', 'ea6dc51b-ffac-48c5-be5f-b4031b139d30'),
('c6c7d42c-a177-4db2-8256-3c3ccb7e9454', 'http://localhost/web-volsu/backend/uploads/9832ad3b-15a1-49ed-a051-3143427e1f5c.png', 'Курицааа', 9, 11106, 'product', '9832ad3b-15a1-49ed-a051-3143427e1f5c');

-- --------------------------------------------------------

--
-- Структура таблицы `vegetables`
--

CREATE TABLE `vegetables` (
  `uuid` varchar(40) NOT NULL,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `price` int NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'vegetables'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Индексы таблицы `fruits`
--
ALTER TABLE `fruits`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Индексы таблицы `meat`
--
ALTER TABLE `meat`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Индексы таблицы `sweets`
--
ALTER TABLE `sweets`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `uuid` (`uuid`);

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
  ADD PRIMARY KEY (`order_uuid`),
  ADD KEY `user_order` (`user`);

--
-- Индексы таблицы `user_orders_products`
--
ALTER TABLE `user_orders_products`
  ADD KEY `on_order_delete` (`order_uuid`),
  ADD KEY `on_product_delete` (`product_uuid`);

--
-- Индексы таблицы `vegetables`
--
ALTER TABLE `vegetables`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  ADD CONSTRAINT `on_order_delete` FOREIGN KEY (`order_uuid`) REFERENCES `user_orders` (`order_uuid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `on_product_delete` FOREIGN KEY (`product_uuid`) REFERENCES `products` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
