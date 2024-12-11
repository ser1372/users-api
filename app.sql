-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 11 2024 г., 13:22
-- Версия сервера: 8.0.24
-- Версия PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `app`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241210154619', '2024-12-10 18:46:38', 992),
('DoctrineMigrations\\Version20241210185920', '2024-12-10 21:59:36', 1487);

-- --------------------------------------------------------

--
-- Структура таблицы `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `refresh_tokens`
--

CREATE TABLE `refresh_tokens` (
  `id` int NOT NULL,
  `refresh_token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `refresh_tokens`
--

INSERT INTO `refresh_tokens` (`id`, `refresh_token`, `username`, `valid`) VALUES
(1, 'a7618684b2731ce9f16936695ef148bf26d7d6fe681f47acef473cf947deab700195f1c87bc64cfe835726cba340dc437e19a069550304c17032b00d712ea392', '3aasdas', '2025-01-09 21:59:42'),
(2, '75f06f1f4c7f83183d825b6a3a748f281943d080a6021c5519ba50fe37c917653ecfa7ee737414ab985544ec5c83b97c9beae260e7400451b33e6e8527463b73', '3aasdas', '2025-01-09 22:18:10'),
(3, 'ca2d55a7ec59dc44fcf38ecf954e8012e48455c13d8b5748e07fecaae40b1a4052bd8240429d5e057791d1082005abb993749b79f69415b229fd2e13e9ce26cf', '1111', '2025-01-09 23:33:50'),
(4, '3f41f96ae11c9b4d3b13ce91bbfbfb80a3859c613078be2c3082f84f0aa7170273e1223c971b9ca4871e0d7569712ad73188c5a3c9e1e0310404f2d1bcb9d0dc', '1', '2025-01-10 00:59:25'),
(5, 'd9ad95892611028819bbfa7b42a9d6c3b71c2e5432c94b8051fa4c3f8b1dc974a29c63ee985e6f0446aad38dbfb4eee2b4f7a445be257733597d251fce1dc37e', '11211', '2025-01-10 00:59:32'),
(6, '4857e97da9a3e02f6101ea0c43bbee757545053fed01a0b8b6dcf280bf78469cc52f8cd4dae46070c2f8a8288d516a850991173fdd1e02eb56434472b686fcb8', '1', '2025-01-10 01:10:47'),
(7, 'cf7d08f80751ca12e40ad68c76a4c4cf71a5bc1be593829fc90ee011b6417ff00f3b5a701328eace172b3b60da1de9916d3b8b81a01f70144bdc9c8dac2352c0', '1', '2025-01-10 01:12:30');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `login` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `phone`, `pass`, `roles`) VALUES
(15, '1', '12345678', '$2y$13$B8dAaKmk0tQDiGMqqEvtV.gHckYk8uzq5CxtOv6HXthlh5N1iQir6', '[\"ROLE_TEST_ADMIN\"]'),
(17, '3aasdass', '12345678', '$2y$13$/ijCSO3RI6p3MkCGOlabIeK72QUvOFoFw5kPFYJ/gvmGE5S0QdVX6', '[\"ROLE_TEST_USER\"]'),
(18, 'asdasd', '12345678', '$2y$13$iJFo/CA1qZ8nbInzvDJAJOLwN6k9dF8.pM6/o3ySRm9jEAQKBajhG', '[\"ROLE_TEST_USER\"]'),
(19, '12345', '12345678', '$2y$13$iDPNGa7h5P5pTOZxLCp8aeUMHp/Pm09j9MsbKiBgC5iG1WUXfobNS', '[\"ROLE_TEST_USER\"]'),
(20, '123123', '12345678', '$2y$13$7G2kRcdXWCPUrAPWyzYje.DmwqehHxt0XCSx4awzyXV9ntzZqB3oi', '[\"ROLE_TEST_USER\"]'),
(21, '112111', '1111', '$2y$13$zGe4rzyivKlb61SAO5h5LeAx.Zgrhhd3xxXs2te92R34ULKmdTNne', '[\"ROLE_TEST_USER\"]');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Индексы таблицы `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9BACE7E1C74F2195` (`refresh_token`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649AA08CB10` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

