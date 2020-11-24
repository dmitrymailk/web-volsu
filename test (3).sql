-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Ноя 24 2020 г., 20:28
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
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `uuid` varchar(40) NOT NULL,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`uuid`, `title`, `img`, `price`) VALUES
('9832ad3b-15a1-49ed-a051-3143427e1f5c', 'Курицааа', 'http://localhost/web-volsu/backend/uploads/9832ad3b-15a1-49ed-a051-3143427e1f5c.png', 1234),
('ea6dc51b-ffac-48c5-be5f-b4031b139d30', 'qwe qwe', 'http://localhost/web-volsu/backend/uploads/ea6dc51b-ffac-48c5-be5f-b4031b139d30.png', 1233);

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
(22, 'new_user_1', 'cb92197c719411e858b9c6003b45b7d9', 'user');

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
('dimweb', '2020-11-20', 'be38cf07-18de-4746-b31e-bdeb55d057d7'),
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
('fe3ec1b9-140f-46a9-92d5-46f10c113bd7', 'http://localhost/web-volsu/backend/uploads/ea6dc51b-ffac-48c5-be5f-b4031b139d30.png', 'qwe qwe', 4, 3944, 'product', 'ea6dc51b-ffac-48c5-be5f-b4031b139d30');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
