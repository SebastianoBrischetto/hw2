-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 13, 2021 alle 20:57
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_laravel`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'TYPE',
  `description` varchar(2048) DEFAULT NULL COMMENT 'LONG_TEXT',
  `image` varchar(255) DEFAULT 'http://localhost/hw2/public/images/icons/no_image.png' COMMENT 'IMAGE',
  `duration` int(11) NOT NULL DEFAULT 90,
  `intensity` int(11) NOT NULL DEFAULT 3,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `course`
--

INSERT INTO `course` (`course_id`, `name`, `type`, `description`, `image`, `duration`, `intensity`, `created_at`, `updated_at`) VALUES
(1, 'G100', 'fitness', 'Allenamento sotto una forza di gravita 100 volte più alta rispetto a quella della terra.', 'http://localhost/hw2/public/images/uploads/EOkPmoUcwm59UbcPat5kDE48keDGhIxm3aje59D8.jpg', 180, 3, '2021-06-13 16:25:20', '2021-06-13 16:25:20'),
(2, 'Spirito e del tempo', 'martial_arts', 'La Stanza dello Spirito e del Tempo  (精神と時の部屋 Seishin to Toki no Heya) è una stanza situata al Tempio di Dio. Un anno dentro in quella stanza equivale a un solo giorno all\'esterno. La gravità è dieci volte superiore alla norma (la stessa del Pianeta Vegeta e del Pianeta del Re Kaioh del Nord); l\'aria è più densa e la temperatura ha grandi sbalzi.', 'http://localhost/hw2/public/images/uploads/87QAclf86YQlOh2NNXCfClgm5LtL4KaXccuqOsRp.png', 1440, 3, '2021-06-13 16:30:13', '2021-06-13 16:30:13'),
(3, 'Nuoto libero', 'swimming', 'Considerato uno sport completo e salutare, che distribuisce il movimento omogeneamente su tutto il corpo, favorisce la salute, la longevità e il benessere fisico e psicologico. Esso spesso comporta benefici estetici e fisici: solitamente si ottiene un aumento della massa magra e una riduzione di quella grassa, lo sviluppo dell\'impalcatura ossea e l\'espansione della gabbia toracica, il miglioramento della coordinazione motoria ,respiratoria.', 'http://localhost/hw2/public/images/uploads/tZ7SsGVSwK4W1IcUeQpSwkH2Z37iE9OhH92jtBU3.jpg', 60, 2, '2021-06-13 16:34:51', '2021-06-13 16:34:51'),
(4, 'Sollevamento pesi', 'fitness', 'Lo scopo di questa attività è di allenare i muscoli dell\'individuo aumentando la loro massa o cercando di mantenere la massa già ottenuta.', 'http://localhost/hw2/public/images/uploads/JqaZV4cbtjWZVaLgCZJlI96oB3WnDLx7b7c69gFy.jpg', 60, 2, '2021-06-13 16:36:45', '2021-06-13 16:36:45'),
(5, 'Yoga', 'wellness', 'Ristabilisci il tuo equilibrio con posture rilassanti che si concentrano sullo stretching, il recupero e il lavoro sul respiro.', 'http://localhost/hw2/public/images/uploads/ihYZBZ2gQJEvFl9XmxGNCcOldFy7eFAddYjiDNyk.jpg', 30, 1, '2021-06-13 16:40:15', '2021-06-13 16:40:15');

-- --------------------------------------------------------

--
-- Struttura della tabella `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `description` varchar(2048) DEFAULT NULL COMMENT 'LONG_TEXT',
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location_image` varchar(255) DEFAULT 'http://localhost/hw2/public/images/icons/no_image.png' COMMENT 'IMAGE',
  `trainers_image` varchar(255) DEFAULT 'http://localhost/hw2/public/images/icons/no_image.png' COMMENT 'IMAGE',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `location`
--

INSERT INTO `location` (`location_id`, `address`, `city`, `description`, `phone_number`, `email`, `location_image`, `trainers_image`, `created_at`, `updated_at`) VALUES
(1, 'Terra di mezzo', 'Arda', 'La Terra di Mezzo, conosciuta anche comee Endor in Quenya, è il nome con la quale si indica generalmente il grande continente di Arda dove si svolgono la maggior parte delle vicende storiche narrate nelle opere di J.R.R. Tolkien.\nEssa è popolata principalmente dai Figli di Ilúvatar (ovverosia gli Elfi e gli Uomini) e dai Nani, i quali hanno conteso per millenni il dominio della Terra di Mezzo a Morgoth e Sauron e alle loro immense schiere di Orchi e Uomini Neri sottomessi ai due Oscuri Signori. Tali vicende all\'inizio avvennero principalmente in quella parte nota come Beleriand ma, a seguito del suo inabissamento nel Belegaer, poi si spostarono nelle terre ad est degli Ered Luin.\n<br>\nNei primi secoli della Quarta Era gli Elfi abbandonarono definitivamente la Terra di Mezzo, inaugurando così il dominio degli Uomini.', '479415347', 'middleearth@fiction.lotr', 'http://localhost/hw2/public/images/uploads/MlQFriwEOu199Qo9rcuWSDgUW4U7nK9zb8a670iO.jpg', 'http://localhost/hw2/public/images/uploads/VDdozFveeF5g03xnMKzarS4hVRW2UIcNDcS3E6v6.jpg', '2021-06-13 16:01:37', '2021-06-13 16:02:11'),
(2, 'Terra (db)', 'Universo 7', 'La Terra presentata in Dragon Ball è radicalmente differente dalla sua controparte reale sotto la quasi totalità degli aspetti, dalla geografia superficiale alla fauna e la flora, la tecnologia e la società. Si tratta infatti di un pianeta nel quale coesistono, oltre agli esseri umani, animali antropomorfi (come Oolong o il Re della Terra Furry), fantasmi, spiriti, vampiri, zombie, demoni, dinosauri e mammiferi preistorici. Il pianeta diventa, nel corso degli anni, anche la patria adottiva di alcune specie aliene, come i Saiyan, i cui due ultimi esemplari Son Goku e Vegeta trovano rifugio dopo la distruzione del loro mondo, dei Namecciani e, alla fine, dell\'antico demone Majin Bu.', '42519', 'earth@fiction.db', 'http://localhost/hw2/public/images/uploads/onO1gX9v5xuy6IM5E3hPlls4Mc9mWvZBXInqfLg4.png', 'http://localhost/hw2/public/images/uploads/dFN1TEL3O1mn1ZHeznBqYVCa3tM4FN83mkUFVobC.jpg', '2021-06-13 16:21:06', '2021-06-13 16:48:54'),
(3, 'via Etnea', 'Catania', 'Sede di via etnea', '095123456', 'viaetneatriscele@gmail.com', 'http://localhost/hw2/public/images/uploads/cHIeVZQDIHTXbA8bELjAAzJYeeBFIPjyzBHMdsp7.jpg', 'http://localhost/hw2/public/images/uploads/xUEjnlLukKvPnj9djvLggMZl24JQ0W3UQJI3f41Z.jpg', '2021-06-13 16:44:51', '2021-06-13 16:44:51');

-- --------------------------------------------------------

--
-- Struttura della tabella `location_courses`
--

CREATE TABLE `location_courses` (
  `id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `location_id` int(11) DEFAULT NULL COMMENT 'INDEX_OF location',
  `course_id` int(11) DEFAULT NULL COMMENT 'INDEX_OF course',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `location_courses`
--

INSERT INTO `location_courses` (`id`, `location_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2021-06-13 16:30:38', '2021-06-13 16:30:38'),
(2, 2, 2, '2021-06-13 16:30:40', '2021-06-13 16:30:40'),
(3, 3, 3, '2021-06-13 16:45:43', '2021-06-13 16:45:43'),
(4, 3, 4, '2021-06-13 16:45:44', '2021-06-13 16:45:44'),
(5, 3, 5, '2021-06-13 16:45:46', '2021-06-13 16:45:46');

-- --------------------------------------------------------

--
-- Struttura della tabella `location_images`
--

CREATE TABLE `location_images` (
  `id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `location_id` int(11) DEFAULT NULL COMMENT 'INDEX_OF location',
  `image` varchar(255) DEFAULT 'http://localhost/hw2/public/images/icons/no_image.png' COMMENT 'IMAGE',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `location_images`
--

INSERT INTO `location_images` (`id`, `location_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 3, 'http://localhost/hw2/public/images/uploads/oEMgELpUJO1f83dUPJEAqLUiNJdKuzDPyA5vuXxR.jpg', '2021-06-13 16:45:19', '2021-06-13 16:45:19'),
(2, 3, 'http://localhost/hw2/public/images/uploads/a9uzgvgryIRpawQS0oObSnbTPdw9jjKNukpFBmFV.jpg', '2021-06-13 16:45:22', '2021-06-13 16:45:22'),
(3, 3, 'http://localhost/hw2/public/images/uploads/EqFKFDGdHMbtRhWJi3wKxpjuj6ZNnJdSnJxtvL85.jpg', '2021-06-13 16:45:26', '2021-06-13 16:45:26');

-- --------------------------------------------------------

--
-- Struttura della tabella `location_times`
--

CREATE TABLE `location_times` (
  `id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `location_id` int(11) DEFAULT NULL COMMENT 'INDEX_OF location',
  `days` varchar(255) NOT NULL,
  `times` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `location_times`
--

INSERT INTO `location_times` (`id`, `location_id`, `days`, `times`, `created_at`, `updated_at`) VALUES
(1, 3, 'LUN - VEN', '7:30 - 22:00', '2021-06-13 16:47:35', '2021-06-13 16:47:35'),
(2, 3, 'SAB', '8:00 - 20:00', '2021-06-13 16:47:47', '2021-06-13 16:47:47');

-- --------------------------------------------------------

--
-- Struttura della tabella `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `name` varchar(255) NOT NULL,
  `cost` decimal(6,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `subscription`
--

INSERT INTO `subscription` (`subscription_id`, `name`, `cost`, `created_at`, `updated_at`) VALUES
(1, 'Saiyan', '99.00', '2021-06-13 16:28:27', '2021-06-13 16:28:27'),
(3, 'Sollevamento Pesi', '20.00', '2021-06-13 16:41:43', '2021-06-13 16:41:43'),
(4, 'Yoga', '30.00', '2021-06-13 16:41:50', '2021-06-13 16:41:50'),
(5, 'Nuoto', '30.00', '2021-06-13 16:41:55', '2021-06-13 16:41:55'),
(6, 'All Inclusive', '120.00', '2021-06-13 16:46:26', '2021-06-13 16:46:26');

-- --------------------------------------------------------

--
-- Struttura della tabella `subscription_courses`
--

CREATE TABLE `subscription_courses` (
  `id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `subscription_id` int(11) DEFAULT NULL COMMENT 'INDEX_OF subscription',
  `course_id` int(11) DEFAULT NULL COMMENT 'INDEX_OF course',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `subscription_courses`
--

INSERT INTO `subscription_courses` (`id`, `subscription_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-06-13 16:41:14', '2021-06-13 16:41:14'),
(2, 1, 2, '2021-06-13 16:41:16', '2021-06-13 16:41:16'),
(3, 3, 4, '2021-06-13 16:42:29', '2021-06-13 16:42:29'),
(4, 4, 5, '2021-06-13 16:42:44', '2021-06-13 16:42:44'),
(5, 5, 3, '2021-06-13 16:42:47', '2021-06-13 16:42:47'),
(6, 6, 3, '2021-06-13 16:46:34', '2021-06-13 16:46:34'),
(7, 6, 4, '2021-06-13 16:46:35', '2021-06-13 16:46:35'),
(8, 6, 5, '2021-06-13 16:46:37', '2021-06-13 16:46:37');

-- --------------------------------------------------------

--
-- Struttura della tabella `trainer`
--

CREATE TABLE `trainer` (
  `trainer_id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `location_id` int(11) NOT NULL COMMENT 'INDEX_OF location',
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `description` varchar(2048) DEFAULT NULL COMMENT 'LONG_TEXT',
  `image` varchar(255) DEFAULT 'http://localhost/hw2/public/images/icons/no_image.png' COMMENT 'IMAGE',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `trainer`
--

INSERT INTO `trainer` (`trainer_id`, `location_id`, `name`, `surname`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gandalf', 'il Grigio', 'Per circa 2,000 anni, Gandalf lavorò accuratamente e senza sosta contro i crescenti poteri del male nella Terra di Mezzo girovagando in tutta le terre dove sembrava essere necessario il suo aiuto. Grande amico di tutte le razze, prese particolarmente a cuore il popolo degli Hobbit, dai quali imparò a fumare l\'Erba Pipa. Fu l\'ideatore dell\'Avventura della Montagna Solitaria, coinvolgendo Bilbo nella compagnia di Thorin e durante la Guerra dell\'Anello aiutò Frodo e gli altri Popoli Liberi a combattere contro il potere di Sauron.', 'http://localhost/hw2/public/images/uploads/kbkBrmjXpqrIMU15Ml3ksMCslnQzA2iZH0HEfSJi.jpg', '2021-06-13 16:06:30', '2021-06-13 16:06:30'),
(2, 1, 'Aragorn', 'Grampasso', 'Rinomato guerriero e Capitano, portatore dell spada Andúril (riforgiata da Narsil, l\'arma di Elendil) durante gli eventi della Guerra dell\'Anello fu un importante membro della Compagnia formata per accompagnare l\'hobbit Frodo nell\'impresa di raggiungere Mordor e distruggere l\'Unico Anello, così da sconfiggere una volta per tutte Sauron e liberare i Popoli Liberi della Terra di Mezzo dalla sua minaccia.', 'http://localhost/hw2/public/images/uploads/cD9vx9Kzglqzl5hQT0Ydg3WoDb60YXlzRAgYaCfM.jpg', '2021-06-13 16:09:14', '2021-06-13 16:09:14'),
(3, 1, 'Gimli', 'Figlio di Glóin', 'Fu scelto da Elrond come membro della Compagnia dell\'anello e, unico del suo popolo, durante la Guerra dell\'Anello combatté sia a Rohan che a Gondor contro le armate di Saruman e Sauron. Nel corso della sua avventura strinse una solida amicizia con Legolas, elfo originario di Bosco Atro, che perdurò anche al termine della guerra.', 'http://localhost/hw2/public/images/uploads/mk87XBSwqORw0GJbpvvhvMhYSnickvowGPtVbDme.jpg', '2021-06-13 16:11:37', '2021-06-13 16:11:37'),
(4, 1, 'Legolas', 'Verdefoglia', 'È un elfo della stirpe dei Sindar che fu membro della Compagnia dell\'Anello durante la Guerra dell\'Anello, alla fine della Terza Era. Figlio di Thranduil e nipote di Oropher, fondatore del Reame Boscoso, era un arciere formidabile che venne scelto da Elrond come membro della Compagnia dell\'Anello in rappresentanza degli Elfi.', 'http://localhost/hw2/public/images/uploads/TY5Mm2heTGIltjrogp5SJVE4Vkck62K3bYU8519L.jpg', '2021-06-13 16:12:59', '2021-06-13 16:12:59'),
(5, 1, 'Melkor', 'L\'oscuro signore', 'Melkor, conosciuto anche come Morgoth o Oscuro Signore, è un potente Ainur appartenente alla schiera dei Valar e un tempo annoverato tra gli Aratar. Tuttavia, a differenza dei suoi fratelli, s\'insuperbì deviando dalla Grande Musica e inserendovi temi che solo lui aveva pensato e gettando così il germe della corruzione nell\'opera di Ilúvatar. Nacque in lui il desiderio di divenire il Signore di Arda ed impadronirsi del potere della Fiamma Imperitura, scalzando Eru dal suo trono.', 'http://localhost/hw2/public/images/uploads/cqOVq01btP4Qt74ZHD4YWYUm7161FavE1ZfkTcii.jpg', '2021-06-13 16:15:31', '2021-06-13 16:16:14'),
(6, 2, 'Goku', 'Son', 'Sempre solitario, a volte un po\' timido ed anche gentile, Son Goku appartiene al popolo guerriero dei Saiyan ed era stato inviato sulla Terra con la missione di distruggerne gli abitanti e conquistare il pianeta. Tuttavia, cadendo in un burrone e battendo violentemente la testa da bambino, perse la memoria dimenticando tutto, infatti divenne il protettore della Terra, insieme ai Guerrieri Z. Si allena costantemente al fine di essere il guerriero più forte e far trionfare il bene sul male.', 'http://localhost/hw2/public/images/uploads/iGA79OPYdbFta3zoemQYuoR1InW4yAuCkmgYnqTp.png', '2021-06-13 16:23:03', '2021-06-13 16:23:03');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `admin`, `name`, `surname`, `birth_date`, `created_at`, `updated_at`) VALUES
(1, 'sebybrischetto@gmail.com', '$2y$10$bEiCnskV7/t2FAgFhwq5q.tErDj3cCeD3OX6hZ7bR9FLUp8Lc6AWi', 1, 'Sebastiano', 'Brischetto', '1995-09-30', '2021-06-13 15:56:25', '2021-06-13 15:56:25');

-- --------------------------------------------------------

--
-- Struttura della tabella `user_courses`
--

CREATE TABLE `user_courses` (
  `id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `user_id` int(11) DEFAULT NULL COMMENT 'INDEX_OF user',
  `course_id` int(11) DEFAULT NULL COMMENT 'INDEX_OF course',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user_courses`
--

INSERT INTO `user_courses` (`id`, `user_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2021-06-13 18:42:00', '2021-06-13 18:42:00'),
(2, 1, 3, '2021-06-13 18:46:42', '2021-06-13 18:46:42'),
(3, 1, 5, '2021-06-13 18:46:43', '2021-06-13 18:46:43');

-- --------------------------------------------------------

--
-- Struttura della tabella `user_subscriptions_active`
--

CREATE TABLE `user_subscriptions_active` (
  `id` int(11) NOT NULL COMMENT 'AUTO_INCREMENT',
  `user_id` int(11) DEFAULT NULL COMMENT 'INDEX_OF user',
  `subscription_id` int(11) DEFAULT NULL COMMENT 'INDEX_OF subscription',
  `duration_months` int(11) NOT NULL,
  `start_date` date NOT NULL DEFAULT curtime(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user_subscriptions_active`
--

INSERT INTO `user_subscriptions_active` (`id`, `user_id`, `subscription_id`, `duration_months`, `start_date`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, '2021-06-13', '2021-06-13 18:46:50', '2021-06-13 18:46:50');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indici per le tabelle `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `address` (`address`);

--
-- Indici per le tabelle `location_courses`
--
ALTER TABLE `location_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `location_id` (`location_id`,`course_id`),
  ADD KEY `idx_location` (`location_id`),
  ADD KEY `idx_course` (`course_id`);

--
-- Indici per le tabelle `location_images`
--
ALTER TABLE `location_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_location` (`location_id`);

--
-- Indici per le tabelle `location_times`
--
ALTER TABLE `location_times`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `location_id` (`location_id`,`days`),
  ADD KEY `idx_location` (`location_id`);

--
-- Indici per le tabelle `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indici per le tabelle `subscription_courses`
--
ALTER TABLE `subscription_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_id` (`subscription_id`,`course_id`),
  ADD KEY `idx_subscription` (`subscription_id`),
  ADD KEY `idx_course` (`course_id`);

--
-- Indici per le tabelle `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`trainer_id`),
  ADD KEY `idx_location` (`location_id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`course_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_course` (`course_id`);

--
-- Indici per le tabelle `user_subscriptions_active`
--
ALTER TABLE `user_subscriptions_active`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`subscription_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_subscription` (`subscription_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `location_courses`
--
ALTER TABLE `location_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `location_images`
--
ALTER TABLE `location_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `location_times`
--
ALTER TABLE `location_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `subscription_courses`
--
ALTER TABLE `subscription_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `user_courses`
--
ALTER TABLE `user_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `user_subscriptions_active`
--
ALTER TABLE `user_subscriptions_active`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `location_courses`
--
ALTER TABLE `location_courses`
  ADD CONSTRAINT `location_courses_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `location_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `location_images`
--
ALTER TABLE `location_images`
  ADD CONSTRAINT `location_images_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `location_times`
--
ALTER TABLE `location_times`
  ADD CONSTRAINT `location_times_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `subscription_courses`
--
ALTER TABLE `subscription_courses`
  ADD CONSTRAINT `subscription_courses_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`subscription_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscription_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `trainer`
--
ALTER TABLE `trainer`
  ADD CONSTRAINT `trainer_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_courses`
--
ALTER TABLE `user_courses`
  ADD CONSTRAINT `user_courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_subscriptions_active`
--
ALTER TABLE `user_subscriptions_active`
  ADD CONSTRAINT `user_subscriptions_active_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_subscriptions_active_ibfk_2` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`subscription_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
