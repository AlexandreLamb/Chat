-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 15 nov. 2018 à 11:26
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `lu` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `message`, `lu`) VALUES
(19, 'a', 'b', 'salut ', NULL),
(20, 'a', 'b', 'ca va ', NULL),
(21, 'a', 'b', 'adz ', NULL),
(22, 'a', 'b', 'az ', NULL),
(23, 'a', 'b', 'az ', NULL),
(24, 'a', 'b', 'az ', NULL),
(25, 'a', 'b', 'az ', NULL),
(26, 'a', 'b', 'az ', NULL),
(27, 'a', 'b', 'za ', NULL),
(28, 'basile', 'a@a.fr', 'test', NULL),
(29, 'basile', 'a@a.fr', 'test2', 1),
(30, 'az', 'a@a.fr', 'zadazdzadzad', 1),
(31, 'az', 'a@a.fr', 'zadazdzadzad', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`) VALUES
(48, 'a', 'a', 'alexandre.l.lambert@hotmail.com', 'a'),
(52, 'alex', 'az', 'alexandre.l@hotmail.com', 'a'),
(53, 'a', 'a', 'lambert@hotmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(54, 'a', 'a', 'lambert1@hotmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(55, 'a', 'a', 'lambert2@hotmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(56, 'a', 'a', 'lambert3@hotmail.com', '92eb5ffee6ae2fec3ad71c777531578f'),
(57, 'a', 'a', 'lamber5t@hotmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(58, 'a', 'a', 'test@gmail.com', '0cc175b9c0f1b6a831c399e269772661'),
(59, 'a', 'a', 'a@a.con', '0cc175b9c0f1b6a831c399e269772661'),
(60, 'a', 'az', '1@test.com', '0cc175b9c0f1b6a831c399e269772661'),
(61, 'a', 'a', 'az@hotmail.c', '0cc175b9c0f1b6a831c399e269772661'),
(62, 'LoveBrook', 'Bjorn', 'a@a.fr', '2510c39011c5be704182423e3a695e91'),
(63, 'a', 'a', 'test@a.com', '0cc175b9c0f1b6a831c399e269772661'),
(64, 'a', 'a', 'a1@a.com', '0cc175b9c0f1b6a831c399e269772661'),
(65, 'a', 'a', 'eza@a.c', '0cc175b9c0f1b6a831c399e269772661');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
