-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 05. kvě 2022, 23:10
-- Verze serveru: 10.4.24-MariaDB
-- Verze PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `chess_online`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `player1_id` int(7) NOT NULL,
  `player2_id` int(7) NOT NULL,
  `result` tinyint(1) DEFAULT NULL,
  `game_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `move`
--

CREATE TABLE `move` (
  `move_id` bigint(13) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(7) NOT NULL,
  `piece_id` int(1) NOT NULL,
  `start_pos_let` varchar(1) NOT NULL,
  `start_pos_num` int(1) NOT NULL,
  `next_pos_let` varchar(1) NOT NULL,
  `next_pos_num` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `pieces`
--

CREATE TABLE `pieces` (
  `piece_id` int(1) NOT NULL,
  `piece_name` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `pieces`
--

INSERT INTO `pieces` (`piece_id`, `piece_name`) VALUES
(1, 'Pawn'),
(2, 'Rook'),
(3, 'Knight'),
(4, 'Bishop'),
(5, 'Queen'),
(6, 'King');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `user_id` int(7) NOT NULL,
  `username` varchar(15) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `elo` int(4) DEFAULT 1000,
  `highest_elo` int(4) DEFAULT 1000,
  `lowest_elo` int(4) DEFAULT 1000,
  `create_date` date NOT NULL,
  `status` varchar(6) NOT NULL DEFAULT 'Player'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `player1_id` (`player1_id`),
  ADD KEY `player2_id` (`player2_id`);

--
-- Indexy pro tabulku `move`
--
ALTER TABLE `move`
  ADD PRIMARY KEY (`move_id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `piece_id` (`piece_id`);

--
-- Indexy pro tabulku `pieces`
--
ALTER TABLE `pieces`
  ADD PRIMARY KEY (`piece_id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `move`
--
ALTER TABLE `move`
  MODIFY `move_id` bigint(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `pieces`
--
ALTER TABLE `pieces`
  MODIFY `piece_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(7) NOT NULL AUTO_INCREMENT;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`player1_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `games_ibfk_2` FOREIGN KEY (`player2_id`) REFERENCES `users` (`user_id`);

--
-- Omezení pro tabulku `move`
--
ALTER TABLE `move`
  ADD CONSTRAINT `move_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`),
  ADD CONSTRAINT `move_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `move_ibfk_3` FOREIGN KEY (`piece_id`) REFERENCES `pieces` (`piece_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
