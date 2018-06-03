-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 03 2018 г., 23:30
-- Версия сервера: 5.6.38
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `applied_materials`
--

CREATE TABLE `applied_materials` (
  `id_applied_material` int(11) NOT NULL,
  `id_good` int(11) NOT NULL,
  `id_material` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `applied_materials`
--

INSERT INTO `applied_materials` (`id_applied_material`, `id_good`, `id_material`) VALUES
(1, 13, 3),
(2, 14, 3),
(3, 15, 1),
(4, 15, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `category_status` int(11) NOT NULL DEFAULT '1',
  `category_name` varchar(256) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `category_status`, `category_name`, `parent_id`) VALUES
(1, 1, 'Эксклюзивные украшения', 0),
(2, 1, 'Броши', 1),
(3, 1, 'Колье и бусы', 1),
(4, 1, 'Оригинальные аксессуары', 0),
(5, 1, 'Кошельки', 4),
(6, 1, 'Комплекты', 1),
(7, 1, 'Серьги', 1),
(8, 1, 'Косметички', 4),
(9, 1, 'Детская бижутерия', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `collections`
--

CREATE TABLE `collections` (
  `id_collection` int(11) NOT NULL,
  `collection_name` text NOT NULL,
  `collection_description` text NOT NULL,
  `season` varchar(15) NOT NULL,
  `collection_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `collections`
--

INSERT INTO `collections` (`id_collection`, `collection_name`, `collection_description`, `season`, `collection_status`) VALUES
(1, 'Натуральная кожа 2018', 'Коллекция эксклюзивных украшений из кожи Лето 2018.', 'summer', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id_good` int(11) NOT NULL,
  `good_code` varchar(15) NOT NULL,
  `good_name` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `size` text NOT NULL,
  `description` text NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_collection` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id_good`, `good_code`, `good_name`, `price`, `size`, `description`, `id_category`, `id_collection`, `status`) VALUES
(1, '3-1-1', 'Рассветная Земляника. Колье из натуральной кожи.', 5990, 'Длина колье 58-66 см.,\r\nдиаметр цветов 10-25 мм.', 'Колье из натуральной кожи.\r\nБусины - белый коралл.\r\nМеталл цвета серебра.', 3, 1, 1),
(2, '2-0-2', 'Good 2', 120, '', '', 2, 0, 2),
(3, '3-0-3', 'Good 3', 47.79999923706055, '', '', 3, 0, 1),
(4, '5-0-4', 'Good 4', 100500, '', '', 5, 0, 1),
(5, '9-0-5', 'Good 5', 2001, '', '', 9, 0, 1),
(6, '6-0-6', 'Good 6', 1020.2000122070312, '', '', 6, 0, 1),
(7, '7-0-7', 'Good 7', 1.2000000476837158, '', '', 7, 0, 1),
(8, '8-0-8', 'Good 8', 800.0999755859375, '', '', 8, 0, 1),
(9, '3-1-9', 'qqeqwe', 1123, 'qweqweqw', 'qweqweqwe', 3, 1, 1),
(10, '6-1-1', 'asdf', 753, 'zxfczxcb', 'sdgfafdg', 6, 1, 2),
(11, '7-0-11', 'zxc', 741, '.jhn,.kjhn', 'hjkjk.  ', 7, 0, 0),
(12, '5-1-12', 'wsx', 345, 'rfv', 'edc', 5, 1, 2),
(13, '8-1-13', 'xsw', 654, 'vfr', 'cde', 8, 1, 0),
(14, '5-1-14', 'qaz', 345, '234', '123', 5, 1, 2),
(15, '5-0-15', 'cde', 654, '              ', 'vfr', 5, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `id_good` int(11) NOT NULL,
  `image_name` text NOT NULL,
  `queue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE `materials` (
  `id_material` int(11) NOT NULL,
  `material_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`id_material`, `material_name`) VALUES
(1, 'кожа'),
(2, 'натуральная кожа'),
(3, 'фурнитура под серебро'),
(4, 'кожаный шнур'),
(5, 'коралл'),
(6, 'металлическая фурнитура');

-- --------------------------------------------------------

--
-- Структура таблицы `ordered_goods`
--

CREATE TABLE `ordered_goods` (
  `id_order` int(11) NOT NULL,
  `id_good` int(11) NOT NULL,
  `quantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ordered_goods`
--

INSERT INTO `ordered_goods` (`id_order`, `id_good`, `quantity`) VALUES
(1, 1, 10),
(2, 2, 17),
(3, 3, 63),
(4, 4, 0.04),
(5, 5, 2),
(5, 1, 10),
(6, 6, 4),
(6, 5, 1),
(7, 7, 100),
(7, 5, 3),
(7, 8, 1),
(7, 3, 2),
(8, 8, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `amount` double NOT NULL,
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `amount`, `datetime_create`, `id_order_status`) VALUES
(1, 4, 1000, '2018-03-25 20:44:47', 6),
(2, 1, 2000, '2018-03-25 20:49:07', 6),
(3, 2, 3000, '2018-03-25 20:50:34', 6),
(4, 3, 4000, '2018-03-25 20:50:37', 4),
(5, 1, 5000, '2018-03-25 20:44:47', 3),
(6, 1, 6000, '2018-03-25 20:44:47', 2),
(7, 1, 7000, '2018-03-25 20:44:47', 2),
(8, 1, 8000, '2018-03-25 20:44:47', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id_order_status` int(11) NOT NULL,
  `order_status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id_order_status`, `order_status_name`) VALUES
(1, 'Принят'),
(2, 'Обработка'),
(3, 'Доставка'),
(4, 'Выдан'),
(5, 'Завершен'),
(6, 'Архив');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `url` varchar(512) NOT NULL,
  `footer` int(4) DEFAULT '0',
  `admin` int(11) NOT NULL DEFAULT '2',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `footer`, `admin`, `status`) VALUES
(1, 'Главная', '?path=index/index', 0, 2, 1),
(2, 'О Магазине', '?path=about/index', 1, 2, 1),
(3, 'Каталог', '?path=catalog/index', 0, 2, 1),
(4, 'Контакты', '?path=contacts/index', 1, 2, 1),
(5, 'Корзина', '?path=basket/index', 0, 2, 1),
(7, 'Отзывы', '?path=review/index', 1, 2, 1),
(8, 'Вверх', '#', 1, 2, 1),
(9, 'Админка', '?path=admin/index', 0, 0, 1),
(10, 'Заказы', '?path=admin/orders', 0, 0, 1),
(11, 'Отзывы', '?path=admin/review', 0, 0, 1),
(12, 'Пользователи', '?path=admin/users', 1, 0, 1),
(13, 'Новости', '?path=admin/news', 1, 0, 1),
(14, 'Отчеты', '?path=admin/reports', 1, 0, 1),
(15, 'Товары', '?path=admin/goods', 0, 0, 1),
(16, 'Категории', '?path=admin/catagories', 1, 0, 1),
(17, 'Страницы', '?path=admin/pages', 1, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id_role`, `role_name`) VALUES
(1, 'operator'),
(2, 'client'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `role` int(11) NOT NULL DEFAULT '2',
  `user_last_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `email`, `pwd`, `name`, `phone`, `address`, `role`, `user_last_action`) VALUES
(1, 'admin@ad.min', 'ddf5fc9c620b22a3d87c8e28ee6ac5fe', 'Admin', '', '', 0, '2018-03-11 14:28:01'),
(2, 'cli@en.t', 'ddf5fc9c620b22a3d87c8e28ee6ac5fe', '', '', '', 2, '2018-03-09 13:41:58'),
(3, 'ope@ra.tor', 'ddf5fc9c620b22a3d87c8e28ee6ac5fe', 'Operator', '+7(000)000-00-00', 'На деревню к бабушке', 1, '2018-03-11 14:28:18'),
(4, 'opt@opt.cl', 'ddf5fc9c620b22a3d87c8e28ee6ac5fe', '', '', '', 2, '2018-03-11 14:26:41');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `applied_materials`
--
ALTER TABLE `applied_materials`
  ADD PRIMARY KEY (`id_applied_material`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id_collection`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id_good`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Индексы таблицы `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id_material`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id_order_status`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `applied_materials`
--
ALTER TABLE `applied_materials`
  MODIFY `id_applied_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `collections`
--
ALTER TABLE `collections`
  MODIFY `id_collection` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id_good` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `materials`
--
ALTER TABLE `materials`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id_order_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
