-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mer 30 Mai 2018 à 16:56
-- Version du serveur :  5.6.34
-- Version de PHP :  7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `sitties`
--

-- --------------------------------------------------------

--
-- Structure de la table `authentifiants`
--

CREATE TABLE `authentifiants` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `authentifiants`
--

INSERT INTO `authentifiants` (`id_user`, `email`, `password`, `type`) VALUES
(3, 'arthur@annebicque.com', '$2y$10$aQOr80xYzy2gQvx5ShCCF.iA.1GUglE7RKVQqMB8YAkbPua5S802a', 1),
(4, 'gaston@annebicque.com', '$2y$10$RxB7EePxOucRN23loB/3I.BTFzJwhTjp7gQRn2UZCxEB8UU2WwDAC', 2),
(6, 'vincent@dujardin.com', '$2y$10$fSOQH6/ACfV64kAuOI1xU.v6GfG7ZYbcV2/msVeqF9tuB33BzQiPq', 1),
(10, 'marine@delorme.fr', '$2y$10$y8h.s5rsch8pZKj/98SE1e8JOWEwMmn1FNtSkhCZlVExLwVne5C36', 2),
(11, 'valentin@gaulhet.fr', '$2y$10$QPfQI0sVpzfv0j6GX6gHyObNODcjzLkqSFq0PILRE4HbNTGK0dtbq', 1),
(12, 'marc@lemercier.fr', '$2y$10$W/58VEhnNBgdPMx378IYfeue0nfZKPUpXHU0eoMmWf/IrmmHihUWK', 2),
(14, 'anouk@harel.fr', '$2y$10$bglVdFB/kK0JpLQSD24UOeHahcwvqOrMO4ZPRwGS.JR7kvsI68UwS', 1),
(15, 'phuc@nguyen.fr', '$2y$10$z1vhB57elI7HdXbWlpEI2eNgsS1aovVd8x8RYLgZ4A6KnY2XryUtS', 1),
(16, 'admin@sitties.com', '$2y$10$.MJoYSHUAQn4lPuZ1aRMN.QArzNLAcsljYZWzM/sGgu.TqsyyOOGO', 3),
(19, 'juliette@faron.com', '$2y$10$IAgMh.oDSw04B48Na.WNFer7DiRKn7oxqUVWEDTgCk5Pi2AaNTdDa', 1),
(25, 'sonarine@trem.com', '$2y$10$VOYhSNstgiaqxXRwIYgcy.Q3riJPPodCKCogtU5g7FJiGkjiRAWre', 1);

-- --------------------------------------------------------

--
-- Structure de la table `babysitters`
--

CREATE TABLE `babysitters` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `portable` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `presentation` text NOT NULL,
  `candidature_valide` tinyint(1) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `babysitters`
--

INSERT INTO `babysitters` (`id`, `nom`, `prenom`, `ville`, `portable`, `age`, `experience`, `photo`, `presentation`, `candidature_valide`, `visible`) VALUES
(3, 'Annebicque', 'Arthur', 'Paris, France', '0650913185', 23, '1', '', '', 1, 1),
(6, 'Dujardin', 'Vincent', 'Lille, France', '0678987654', 23, '1', '', '', 1, 1),
(11, 'Gaulhet', 'Valentin', 'Troyes, France', '0601020304', 20, '-1', '', '', 1, 1),
(14, 'Harel', 'Anouk', 'Strasbourg, France', '0659384958', 20, '1', '', '', 1, 1),
(15, 'Nguyen', 'Phuc', 'Antony, France', '0659382059', 24, '-1', '', '', 1, 1),
(19, 'Faron', 'Juliette', 'Le Plessis-Trévise, France', '0659384059', 23, '1', '19.jpg', '', 0, 0),
(25, 'Trem', 'Sonarine', 'Cachan, France', '0612233445', 24, 'moins d\' 1 an', '25.jpg', '', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `babysitter_langue`
--

CREATE TABLE `babysitter_langue` (
  `id` int(11) NOT NULL,
  `id_babysitter` int(11) NOT NULL,
  `id_langue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `babysitter_langue`
--

INSERT INTO `babysitter_langue` (`id`, `id_babysitter`, `id_langue`) VALUES
(1, 14, 1),
(2, 14, 2),
(3, 14, 3),
(4, 15, 2),
(8, 19, 2),
(14, 25, 2);

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites`
--

CREATE TABLE `disponibilites` (
  `id_dispo` int(11) NOT NULL,
  `id_babysitter` int(11) NOT NULL,
  `creneau` datetime NOT NULL,
  `statut` varchar(255) NOT NULL,
  `id_reservation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `disponibilites`
--

INSERT INTO `disponibilites` (`id_dispo`, `id_babysitter`, `creneau`, `statut`, `id_reservation`) VALUES
(1, 3, '2018-05-18 11:00:00', 'reservé', 8),
(2, 3, '2018-05-18 12:00:00', 'reservé', 8),
(3, 3, '2018-05-18 13:00:00', 'reservé', 8),
(4, 3, '2018-05-18 14:00:00', 'disponible', 0),
(5, 3, '2018-05-19 08:00:00', 'disponible', 0),
(6, 3, '2018-05-19 09:00:00', 'disponible', 0),
(9, 3, '2018-05-20 14:00:00', 'disponible', 0),
(10, 3, '2018-05-20 15:00:00', 'disponible', 0),
(11, 3, '2018-05-20 16:00:00', 'disponible', 0),
(12, 6, '2018-05-18 11:00:00', 'expiré', 10),
(13, 6, '2018-05-18 12:00:00', 'expiré', 10),
(14, 6, '2018-05-18 13:00:00', 'expiré', 15),
(15, 6, '2018-05-18 14:00:00', 'expiré', 15),
(16, 3, '2018-05-20 18:00:00', 'disponible', NULL),
(17, 3, '2018-05-20 19:00:00', 'reservé', 9),
(18, 3, '2018-05-20 20:00:00', 'reservé', 9),
(19, 3, '2018-05-20 21:00:00', 'disponible', NULL),
(20, 6, '2018-05-20 11:00:00', 'expiré', 17),
(21, 6, '2018-05-20 12:00:00', 'expiré', 17),
(22, 6, '2018-05-20 13:00:00', 'expiré', 17),
(23, 6, '2018-05-20 14:00:00', 'expiré', 17),
(24, 6, '2018-05-20 15:00:00', 'expiré', 60),
(25, 6, '2018-05-20 16:00:00', 'expiré', 60),
(26, 6, '2018-05-20 17:00:00', 'disponible', NULL),
(27, 6, '2018-05-20 18:00:00', 'disponible', NULL),
(28, 6, '2018-05-20 19:00:00', 'disponible', NULL),
(29, 3, '2018-05-21 08:00:00', 'reservé', 43),
(30, 3, '2018-05-21 09:00:00', 'reservé', 43),
(31, 3, '2018-05-21 10:00:00', 'reservé', 43),
(32, 3, '2018-05-21 11:00:00', 'reservé', 43),
(33, 3, '2018-05-16 08:00:00', 'expiré', 45),
(34, 3, '2018-05-16 09:00:00', 'expiré', 45),
(35, 6, '2018-05-16 12:00:00', 'expiré', 46),
(36, 6, '2018-05-16 13:00:00', 'expiré', 46),
(37, 6, '2018-05-16 14:00:00', 'disponible', NULL),
(38, 11, '2018-05-17 08:00:00', 'disponible', NULL),
(39, 11, '2018-05-17 09:00:00', 'disponible', NULL),
(40, 11, '2018-05-17 10:00:00', 'expiré', 47),
(41, 11, '2018-05-17 11:00:00', 'expiré', 47),
(45, 14, '2018-05-18 13:00:00', 'disponible', NULL),
(46, 14, '2018-05-18 14:00:00', 'disponible', NULL),
(47, 14, '2018-05-18 15:00:00', 'disponible', NULL),
(48, 14, '2018-05-18 16:00:00', 'disponible', NULL),
(49, 15, '2018-05-19 10:00:00', 'expiré', 51),
(50, 15, '2018-05-19 11:00:00', 'expiré', 51),
(51, 15, '2018-05-19 12:00:00', 'expiré', 51),
(52, 3, '2018-05-23 12:00:00', 'reservé', 53),
(53, 3, '2018-05-23 13:00:00', 'reservé', 53),
(54, 3, '2018-05-23 20:00:00', 'disponible', NULL),
(55, 3, '2018-05-23 21:00:00', 'disponible', NULL),
(56, 3, '2018-05-23 22:00:00', 'disponible', NULL),
(57, 3, '2018-05-30 12:00:00', 'reservé', 53),
(58, 3, '2018-05-30 13:00:00', 'reservé', 53),
(59, 3, '2018-05-30 20:00:00', 'disponible', NULL),
(60, 3, '2018-05-30 21:00:00', 'disponible', NULL),
(61, 3, '2018-05-30 22:00:00', 'disponible', NULL),
(66, 14, '2018-05-21 12:00:00', 'reservé', 54),
(67, 14, '2018-05-21 13:00:00', 'reservé', 54),
(68, 14, '2018-05-22 12:00:00', 'reservé', 54),
(69, 14, '2018-05-22 13:00:00', 'reservé', 54),
(70, 14, '2018-05-23 12:00:00', 'disponible', NULL),
(71, 14, '2018-05-23 13:00:00', 'disponible', NULL),
(72, 14, '2018-05-24 12:00:00', 'disponible', NULL),
(73, 14, '2018-05-24 13:00:00', 'disponible', NULL),
(74, 14, '2018-05-25 12:00:00', 'disponible', NULL),
(75, 14, '2018-05-25 13:00:00', 'disponible', NULL),
(76, 14, '2018-05-28 12:00:00', 'reservé', 54),
(77, 14, '2018-05-28 13:00:00', 'reservé', 54),
(78, 14, '2018-05-29 12:00:00', 'disponible', NULL),
(79, 14, '2018-05-29 13:00:00', 'disponible', NULL),
(80, 14, '2018-05-30 12:00:00', 'disponible', NULL),
(81, 14, '2018-05-30 13:00:00', 'disponible', NULL),
(82, 14, '2018-05-31 12:00:00', 'disponible', NULL),
(83, 14, '2018-05-31 13:00:00', 'disponible', NULL),
(84, 14, '2018-06-01 12:00:00', 'disponible', NULL),
(85, 14, '2018-06-01 13:00:00', 'disponible', NULL),
(86, 14, '2018-06-04 12:00:00', 'disponible', NULL),
(87, 14, '2018-06-04 13:00:00', 'disponible', NULL),
(88, 15, '2018-05-21 12:00:00', 'reservé', 57),
(89, 15, '2018-05-21 13:00:00', 'reservé', 59),
(90, 15, '2018-06-04 12:00:00', 'reservé', 55),
(91, 15, '2018-06-04 13:00:00', 'reservé', 55),
(92, 15, '2018-06-04 14:00:00', 'reservé', 55),
(93, 15, '2018-06-04 15:00:00', 'reservé', 55),
(94, 15, '2018-06-04 16:00:00', 'reservé', 55),
(95, 15, '2018-06-04 17:00:00', 'reservé', 55),
(96, 15, '2018-06-04 18:00:00', 'reservé', 55),
(97, 15, '2018-06-04 19:00:00', 'reservé', 55),
(98, 15, '2018-06-05 12:00:00', 'reservé', 55),
(99, 15, '2018-06-05 13:00:00', 'reservé', 55),
(100, 15, '2018-06-05 14:00:00', 'reservé', 55),
(101, 15, '2018-06-05 15:00:00', 'reservé', 55),
(102, 15, '2018-06-05 16:00:00', 'reservé', 55),
(103, 15, '2018-06-05 17:00:00', 'reservé', 55),
(104, 15, '2018-06-05 18:00:00', 'reservé', 55),
(105, 15, '2018-06-05 19:00:00', 'reservé', 55),
(106, 15, '2018-06-11 12:00:00', 'reservé', 55),
(107, 15, '2018-06-11 13:00:00', 'reservé', 55),
(108, 15, '2018-06-11 14:00:00', 'reservé', 55),
(109, 15, '2018-06-11 15:00:00', 'reservé', 55),
(110, 15, '2018-06-11 16:00:00', 'reservé', 55),
(111, 15, '2018-06-11 17:00:00', 'reservé', 55),
(112, 15, '2018-06-11 18:00:00', 'reservé', 55),
(113, 15, '2018-06-11 19:00:00', 'reservé', 55),
(114, 15, '2018-06-12 12:00:00', 'reservé', 55),
(115, 15, '2018-06-12 13:00:00', 'reservé', 55),
(116, 15, '2018-06-12 14:00:00', 'reservé', 55),
(117, 15, '2018-06-12 15:00:00', 'reservé', 55),
(118, 15, '2018-06-12 16:00:00', 'reservé', 55),
(119, 15, '2018-06-12 17:00:00', 'reservé', 55),
(120, 15, '2018-06-12 18:00:00', 'reservé', 55),
(121, 15, '2018-06-12 19:00:00', 'reservé', 55),
(122, 25, '2018-05-24 08:00:00', 'reservé', 64),
(123, 25, '2018-05-24 09:00:00', 'reservé', 64),
(124, 25, '2018-05-24 10:00:00', 'disponible', NULL),
(125, 25, '2018-05-24 11:00:00', 'disponible', NULL),
(126, 25, '2018-05-24 12:00:00', 'disponible', NULL),
(127, 25, '2018-05-24 13:00:00', 'disponible', NULL),
(128, 25, '2018-05-24 14:00:00', 'disponible', NULL),
(129, 25, '2018-05-24 15:00:00', 'disponible', NULL),
(130, 25, '2018-05-24 16:00:00', 'disponible', NULL),
(131, 25, '2018-05-24 17:00:00', 'disponible', NULL),
(132, 25, '2018-05-24 18:00:00', 'disponible', NULL),
(133, 25, '2018-05-24 19:00:00', 'disponible', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `enfants`
--

CREATE TABLE `enfants` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `restrictions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `enfants`
--

INSERT INTO `enfants` (`id`, `id_parent`, `prenom`, `date_naissance`, `restrictions`) VALUES
(1, 10, 'Clément', '2002-04-05', 'aucun'),
(2, 10, 'Arthur', '1994-05-26', 'aucun'),
(3, 12, 'Alfred', '2004-01-01', 'aucune');

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE `langues` (
  `id` int(11) NOT NULL,
  `langue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `langues`
--

INSERT INTO `langues` (`id`, `langue`) VALUES
(1, 'Allemand'),
(2, 'Anglais'),
(3, 'Tchèque'),
(4, 'Espagnol'),
(5, 'Portugais');

-- --------------------------------------------------------

--
-- Structure de la table `parents`
--

CREATE TABLE `parents` (
  `id_parent` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `presentation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `parents`
--

INSERT INTO `parents` (`id_parent`, `nom`, `ville`, `presentation`) VALUES
(4, 'Annebicque', 'Le Plessis-Trévise, France', 'Famille de 2 enfants vivant en banlieue parisienne'),
(10, 'Delorme', 'Le Plessis-Trévise, France', 'Mère de deux enfants'),
(12, 'Lemercier', 'Troyes, France', 'Prof');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `id_babysitter` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `note` int(11) NOT NULL DEFAULT '-1',
  `evaluation` text NOT NULL,
  `revenu` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `reservations`
--

INSERT INTO `reservations` (`id`, `id_parent`, `id_babysitter`, `type`, `note`, `evaluation`, `revenu`) VALUES
(8, 4, 3, 1, -1, '', 0),
(9, 4, 3, 1, -1, '', 0),
(10, 10, 6, 1, 5, 'Très bien', 6),
(15, 10, 6, 1, 5, 'Très satisfaisant, Vincent est ponctuel et serieux', 6),
(17, 10, 6, 1, 4, 'Vincent est sérieux, je recommande', 44),
(43, 10, 3, 1, -1, '', 0),
(45, 10, 3, 1, 4, 'satisfait', 22),
(46, 10, 6, 1, 4, 'bien', 22),
(47, 12, 11, 1, 4, 'Satisfaisant', 14),
(48, 10, 15, 1, -1, '', 0),
(51, 10, 15, 2, 5, 'Très bonne maitrise de l\'anglais', 45),
(53, 10, 3, 3, -1, '', 0),
(54, 12, 14, 3, -1, '', 0),
(55, 10, 15, 3, -1, '', 0),
(56, 10, 15, 1, -1, '', 0),
(57, 10, 15, 1, -1, '', 0),
(58, 10, 15, 1, -1, '', 0),
(59, 10, 15, 1, -1, '', 0),
(60, 10, 6, 1, 4, 'Super ! Je recommande Vincent, très ponctuel et sérieux !', 14),
(61, 12, 25, 1, -1, '', 0),
(62, 12, 25, 1, -1, '', 0),
(63, 12, 25, 1, -1, '', 0),
(64, 12, 25, 1, -1, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_enfant`
--

CREATE TABLE `reservation_enfant` (
  `id` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_enfant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `reservation_enfant`
--

INSERT INTO `reservation_enfant` (`id`, `id_reservation`, `id_enfant`) VALUES
(1, 17, 1),
(2, 17, 2),
(3, 18, 1),
(4, 18, 2),
(5, 19, 1),
(6, 19, 2),
(7, 20, 1),
(8, 20, 2),
(9, 21, 1),
(10, 21, 2),
(11, 22, 1),
(12, 22, 2),
(13, 23, 1),
(14, 23, 2),
(15, 24, 1),
(16, 24, 2),
(17, 25, 1),
(18, 25, 2),
(19, 26, 1),
(20, 26, 2),
(21, 27, 1),
(22, 27, 2),
(23, 28, 1),
(24, 28, 2),
(25, 29, 1),
(26, 29, 2),
(27, 30, 1),
(28, 30, 2),
(29, 31, 1),
(30, 31, 2),
(31, 32, 1),
(32, 32, 2),
(33, 33, 1),
(34, 33, 2),
(35, 34, 1),
(36, 34, 2),
(37, 35, 1),
(38, 35, 2),
(39, 36, 1),
(40, 36, 2),
(41, 37, 1),
(42, 37, 2),
(43, 38, 1),
(44, 38, 2),
(45, 39, 1),
(46, 39, 2),
(47, 40, 1),
(48, 40, 2),
(49, 41, 1),
(50, 41, 2),
(51, 42, 1),
(52, 42, 2),
(53, 43, 1),
(54, 43, 2),
(55, 44, 1),
(56, 44, 2),
(57, 45, 1),
(58, 45, 2),
(59, 46, 1),
(60, 46, 2),
(61, 47, 3),
(64, 51, 1),
(66, 53, 1),
(67, 54, 3),
(68, 55, 1),
(69, 56, 2),
(70, 57, 2),
(71, 58, 1),
(72, 59, 1),
(73, 60, 1),
(74, 61, 3),
(75, 62, 3),
(76, 63, 3),
(77, 64, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `surname`, `name`, `email`, `password`, `city`, `latitude`, `longitude`, `description`) VALUES
(4, 'Annebicque', 'Clement', 'clement@annebicque.com', '$2y$10$QosdRQYg7SM.09zfCG0J4ukX8AfXuWIKJIZv8fJYeQeNBJ.qW.9aS', '94420 Le Plessis-Trévise, France', 48.808589935302734, 2.5739030838012695, ''),
(5, 'Delorme', 'François', 'francois@delorme.com', '$2y$10$ykirpd7xFnHqye2t95P0Dumhpazw0qeXUUGhUj3d8EXdfWrUuuT6C', '59310 Orchies, France', 50.4745, 3.2428, ''),
(6, 'Paul', 'Robert', 'paul@robert.com', '$2y$10$Xn0uyY.occl.RsO0/W9Q1Oh0i3AWwS8j7wxSDfbtG9g2fB/8eUR3.', '22380 Saint-Cast-le-Guildo, France', 48.632091, -2.259804, ''),
(7, 'Annebicque', 'Gaston', 'gastpn@annebicque.com', '$2y$10$08Nd.Gsv0I6r.hb/oHHeXu0vZ3lqpYUOjw45LxZ9h4CGDQkUKbLDy', 'Paris, France', 48.856614, 2.3522219, ''),
(8, 'Delorme', 'Marine', 'marine@delorme.com', '$2y$10$1m2XK5CmBHCNUWTOKFe3fej0XNHhl5d7TmpK7MqFJFie0f/dBYzQy', 'Paris, France', 48.856614, 2.3522219, ''),
(9, 'Collomb', 'Gerard', 'gerard@collomb.com', '$2y$10$s8SgzFMuSVqicnnRv1Z7gusjOvrwiZSpwS9b7qD2cZsTkt2hilno2', 'Lyon, France', 45.764043, 4.835659, ''),
(10, 'Aubry', 'Martine', 'martine@aubry.com', '$2y$10$yDF9dzr/Hj4beH.p7z0HjO3T8e8UsznBpKyvoZqxHeyDm7Xg4fDyi', 'Lille, France', 50.62925, 3.057256, ''),
(11, 'Robert', 'Bertrand', 'bertrand@robert.com', '$2y$10$dk6JR1xiws4OalQuQzJP8.kHqO0wxptv9tbGUgsKEnIuTMOgLW9tC', '69100 Villeurbanne, France', 45.771944, 4.8901709, ''),
(12, 'Paul', 'Jean', 'jean@paul.com', '$2y$10$LSzH79TseG.hO0a4/w1QTOXemasBxvDPIc7z1q8ZZkECaCFX/p9Wu', '10000 Troyes, France', 48.2973451, 4.0744009, ''),
(13, 'Vuitton', 'Louis', 'louis@vuitton.com', '$2y$10$ZBSNYy/NZeM3z6qTpu/1eethZN1dfR5VZjvYSbJGxn8Qiu8cAgfyu', 'Rosières-près-Troyes, France', 48.262698, 4.062959, ''),
(14, 'Harel', 'Anouk', 'anouk@harel.com', '$2y$10$27n7VayIRJBF9xFeW2ckHuDBE7ifzHX5PpFGIvkcGPYonMrAvYovK', 'Saint-Julien-les-Villas, France', 48.273427, 4.098905, ''),
(15, 'Verrier', 'Marguerite', 'marguerite@verrier.com', '$2y$10$6Sh22oDUxMUtD6qsM./sGOOQkKOyJ8S4888IFiSFVAgKaryjIShpa', '10600 La Chapelle-Saint-Luc, France', 48.312011, 4.047818, '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `authentifiants`
--
ALTER TABLE `authentifiants`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `babysitters`
--
ALTER TABLE `babysitters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_babysitter` (`id`);

--
-- Index pour la table `babysitter_langue`
--
ALTER TABLE `babysitter_langue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `babysitter_deletion` (`id_babysitter`);

--
-- Index pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  ADD PRIMARY KEY (`id_dispo`);

--
-- Index pour la table `enfants`
--
ALTER TABLE `enfants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_enfant` (`id_parent`);

--
-- Index pour la table `langues`
--
ALTER TABLE `langues`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id_parent`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation_enfant`
--
ALTER TABLE `reservation_enfant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `authentifiants`
--
ALTER TABLE `authentifiants`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `babysitter_langue`
--
ALTER TABLE `babysitter_langue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  MODIFY `id_dispo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT pour la table `enfants`
--
ALTER TABLE `enfants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `langues`
--
ALTER TABLE `langues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT pour la table `reservation_enfant`
--
ALTER TABLE `reservation_enfant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `babysitters`
--
ALTER TABLE `babysitters`
  ADD CONSTRAINT `user_babysitter` FOREIGN KEY (`id`) REFERENCES `authentifiants` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `babysitter_langue`
--
ALTER TABLE `babysitter_langue`
  ADD CONSTRAINT `babysitter_deletion` FOREIGN KEY (`id_babysitter`) REFERENCES `babysitters` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `enfants`
--
ALTER TABLE `enfants`
  ADD CONSTRAINT `parent_enfant` FOREIGN KEY (`id_parent`) REFERENCES `parents` (`id_parent`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `user_parent` FOREIGN KEY (`id_parent`) REFERENCES `authentifiants` (`id_user`) ON DELETE CASCADE;
