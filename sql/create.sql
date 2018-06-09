-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Sam 09 Juin 2018 à 10:40
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
(1, 'admin@sitties.com', '$2y$10$DN.75gHQr3FHbUB9l1PyhuhgBOxzYuWpI2mNSEa9iwDm3GUKy7tx6', 3),
(3, 'peter@parker.com', '$2y$10$eoViRxDZJUAoJfrrUxyCTuNIs1WS6RtI0Cvv6DSDtGcFGDHiEH6Vu', 1),
(4, 'tony@stark.com', '$2y$10$bnR5dA4fllxoNRE96yfrB.K1baLQVyNS3Y3dQBhXDcFfkvy4oLaom', 1),
(5, 'natasha@romanoff.com', '$2y$10$uciB98LVuCm3g7Vi6ECmn.NH62SXeeVkq/6LAd2WxFa/pBAAFq3Yi', 1),
(6, 'clint@barton.com', '$2y$10$fv60C1VGLB1G4DdTBpOUOOfamAFxWcFo.9Bf0yTMReShwIUzO2bzq', 1),
(7, 'pietro@maximoff.com', '$2y$10$sC1RtJohpPEQ58RRHJVE3.B4Va59Dkggk0sfZ.wmwY3A3UrBT7CCq', 1),
(8, 'wanda@maximoff.com', '$2y$10$rZen/1cy3gwqQhLEexrki.aKzVB0UFKkzrRqLBTJYqifPo2I0XIJm', 1),
(9, 'bruce@banner.com', '$2y$10$E81M9teKojBxdSijue7TvO1kH9EN/TvwfYaJAHwlzjEKFYAgBfMaO', 1),
(10, 'the@vision.com', '$2y$10$a0vb0VfqIV50ro78ajkDA.sr/6P0QGuMt4Wp2/v./E6wxfdf/N8g2', 1),
(11, 'steve@rogers.com', '$2y$10$VX4HIf7dM97SIaCYUHXvluVC1sgg0XQGFg7A5yRC./ZDAB3XiOOZq', 1),
(12, 'peter@quill.com', '$2y$10$z1bQNTNPVsSLgmWJG57amubN8FMt88gh17WpePI6p/PV00Qj5APM6', 1),
(13, 'wade@wilson.com', '$2y$10$zQGCkurPSksyDJY2iv6uH.53wJfNmDgg7aAdsQN.s53erbjd.jWOO', 1),
(14, 'thor@odinson.com', '$2y$10$PXEYgLngRAeMVWXsRtmTkuhwDF7j.TZm8JNSyteuGrCtCdqaFwG1y', 1),
(15, 'maria@hill.com', '$2y$10$logyzTkYT4QytVmaAs5rYu3wPbLsubaF8Obhc1A1HYTojnpy7rgjO', 1),
(16, 'stark@family.com', '$2y$10$kHyoBZSX1Lqg120hyXfuBOd51qG.pg3hq8SkT6Cf/U8nRix/m3EN6', 2),
(17, 'lannister@family.com', '$2y$10$lFzPutkl3qM3DQuZYaB0h.dmfaC6UCaS5bJv4vIFcw7Y3cehb23NK', 2),
(18, 'bolton@family.com', '$2y$10$D8IY3bIKnAxKyrk8QzYpVueMIUTG/Gm2IX.ONKfG5pqwm5ZuxJojm', 2);

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
(3, 'Parker', 'Peter', 'Saint-Julien-les-Villas, France', '0612233445', 18, 'moins d\' 1 an', '3.jpg', 'Étudiant sérieux et impliqué, j\'accorde beaucoup d\'importance au développement des enfants. Comme disait mon oncle, un grand pouvoir implique de grandes responsabilités.', 0, 0),
(4, 'Stark', 'Tony', 'Troyes, France', '0623344556', 32, 'plus de 3 ans', '4.jpg', 'Génie, milliardaire, playboy philanthrope et PDG de Stark Industries. J\'adore m\'occuper des enfants, voir un héro leur fait toujours plaisir.', 1, 1),
(5, 'Romanoff', 'Natasha', 'Rosières-prés-Troyes, France', '0634455667', 28, '1 à 3 ans', '5.jpg', 'Agent du S.H.I.E.L.D et pratiquante de danse classique dès mon plus jeune age, je suis très à l\'aise avec les enfants.', 1, 1),
(6, 'Barton', 'Clint', 'La Chapelle-Saint-Luc, France', '0645566778', 28, '1 à 3 ans', '6.jpg', 'Agent du S.H.I.E.L.D et professeur de tir à l\'arc.', 1, 1),
(7, 'Maximoff', 'Pietro', 'Saint-Germain, France', '0656677889', 21, 'moins d\' 1 an', '7.png', 'Athlète et voyageur intrépide. Je suis toujours ponctuel et possède bons réflexes. ', 1, 1),
(8, 'Maximoff', 'Wanda', 'Saint-Germain, France', '0667788990', 21, '1 à 3 ans', '8.jpg', 'Jeune étudiante expérimentée, je fais preuve d\'une certaine aisance pour me faire écouter par les enfants.', 1, 1),
(9, 'Banner', 'Bruce', 'Troyes, France', '0678899012', 32, 'plus de 3 ans', '9.jpg', 'Enseignant chercheur en biochimie et physique nucléaire à l\'UTT. Je donne également des cours de yoga, très efficace pour les enfants turbulents.', 0, 0),
(10, 'Vision', 'The', 'Troyes, France', '0689901223', 34, 'plus de 3 ans', '10.jpg', 'Enseignant chercheur à l\'UTT spécialisé dans le big data. Véritable encyclopédie vivante, je saurai occuper vos enfants.', 1, 1),
(11, 'Rogers', 'Steve', 'Saint-Julien-les-Villas, France', '0690122334', 36, 'plus de 3 ans', '11.jpg', 'Sportif, porte drapeau aux JO de 96 et ancien militaire. Je n\'ai pas de problème pour garder les enfants même les plus difficiles.', 1, 1),
(12, 'Quill', 'Peter', 'Pont-Sainte-Marie, France', '0601233445', 27, '1 à 3 ans', '12.jpg', 'Astronaute et fan de Five Stairsteps. Aventurier dans l\'âme mais j\'aime aussi me poser et aider les familles dans le besoin.', 1, 1),
(13, 'Wilson', 'Wade', 'Troyes, France', '0609988776', 26, 'plus de 3 ans', '13.jpg', 'J\'ai beaucoup d\'expérience avec les enfants, je suis danseur, humoriste et cascadeur. Je fais souvent des actions de charité dans les hôpitaux, les enfants m\'adorent.', 1, 1),
(14, 'Odinson', 'Thor', 'Pont-Sainte-Marie, France', '0698877665', 31, '1 à 3 ans', '14.jpg', 'Fils d\'Odin, Dieu du tonnerre et des orages d\'Asgard, ancien prince puis roi d\'Asgard, membre des Vengeurs, des Dieux d\'Asgard, ancien leader du Godpack, ancien membre de la Vengeance royale et citoyen honoraire des Etats-Unis.', 1, 1),
(15, 'Hill', 'Maria', 'Troyes, France', '0687766554', 35, 'plus de 3 ans', '15.jpg', 'Directrice du S.H.I.E.L.D, j\'aime occuper mon temps libre et gardant des enfants.', 1, 1);

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
(1, 3, 1),
(2, 3, 2),
(3, 4, 1),
(4, 4, 2),
(5, 4, 3),
(6, 4, 4),
(7, 5, 2),
(8, 5, 3),
(9, 5, 5),
(10, 6, 2),
(11, 7, 2),
(12, 7, 3),
(13, 8, 2),
(14, 8, 3),
(15, 9, 1),
(16, 9, 2),
(17, 10, 1),
(18, 10, 2),
(19, 10, 6),
(20, 10, 3),
(21, 11, 1),
(22, 11, 2),
(23, 12, 2),
(24, 13, 2),
(25, 14, 1),
(26, 14, 2),
(27, 15, 1),
(28, 15, 2),
(29, 15, 3);

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
(1, 4, '2018-06-13 14:00:00', 'disponible', NULL),
(2, 4, '2018-06-13 15:00:00', 'disponible', NULL),
(3, 4, '2018-06-13 16:00:00', 'disponible', NULL),
(4, 4, '2018-06-13 17:00:00', 'disponible', NULL),
(5, 4, '2018-06-13 18:00:00', 'disponible', NULL),
(6, 4, '2018-06-13 19:00:00', 'disponible', NULL),
(7, 4, '2018-06-13 20:00:00', 'disponible', NULL),
(8, 4, '2018-06-13 21:00:00', 'disponible', NULL),
(9, 12, '2018-06-13 14:00:00', 'disponible', NULL),
(10, 12, '2018-06-13 15:00:00', 'disponible', NULL),
(11, 12, '2018-06-13 16:00:00', 'disponible', NULL),
(12, 12, '2018-06-13 17:00:00', 'disponible', NULL),
(13, 12, '2018-06-13 18:00:00', 'disponible', NULL),
(14, 12, '2018-06-13 19:00:00', 'disponible', NULL),
(15, 12, '2018-06-13 20:00:00', 'disponible', NULL),
(16, 12, '2018-06-13 21:00:00', 'disponible', NULL),
(17, 13, '2018-06-14 14:00:00', 'disponible', NULL),
(18, 13, '2018-06-14 15:00:00', 'disponible', NULL),
(19, 13, '2018-06-14 16:00:00', 'disponible', NULL),
(20, 13, '2018-06-21 14:00:00', 'disponible', NULL),
(21, 13, '2018-06-21 15:00:00', 'disponible', NULL),
(22, 13, '2018-06-21 16:00:00', 'disponible', NULL),
(23, 13, '2018-06-28 14:00:00', 'disponible', NULL),
(24, 13, '2018-06-28 15:00:00', 'disponible', NULL),
(25, 13, '2018-06-28 16:00:00', 'disponible', NULL),
(26, 5, '2018-06-14 14:00:00', 'disponible', NULL),
(27, 5, '2018-06-14 15:00:00', 'disponible', NULL),
(28, 5, '2018-06-14 16:00:00', 'disponible', NULL),
(29, 5, '2018-06-21 14:00:00', 'disponible', NULL),
(30, 5, '2018-06-21 15:00:00', 'disponible', NULL),
(31, 5, '2018-06-21 16:00:00', 'disponible', NULL),
(32, 5, '2018-06-28 14:00:00', 'disponible', NULL),
(33, 5, '2018-06-28 15:00:00', 'disponible', NULL),
(34, 5, '2018-06-28 16:00:00', 'disponible', NULL),
(35, 14, '2018-06-15 14:00:00', 'disponible', NULL),
(36, 14, '2018-06-15 15:00:00', 'disponible', NULL),
(37, 14, '2018-06-15 16:00:00', 'disponible', NULL),
(38, 14, '2018-06-15 17:00:00', 'disponible', NULL),
(39, 14, '2018-06-15 18:00:00', 'disponible', NULL),
(40, 14, '2018-06-15 19:00:00', 'disponible', NULL),
(41, 10, '2018-06-15 11:00:00', 'disponible', NULL),
(42, 10, '2018-06-15 12:00:00', 'disponible', NULL),
(43, 10, '2018-06-15 13:00:00', 'disponible', NULL),
(44, 10, '2018-06-15 14:00:00', 'disponible', NULL),
(45, 10, '2018-06-15 15:00:00', 'disponible', NULL),
(46, 15, '2018-06-15 14:00:00', 'disponible', NULL),
(47, 15, '2018-06-15 15:00:00', 'disponible', NULL),
(48, 14, '2018-05-09 10:00:00', 'expiré', 2),
(49, 14, '2018-05-09 11:00:00', 'expiré', 2),
(50, 14, '2018-05-09 12:00:00', 'expiré', 3),
(51, 14, '2018-05-09 13:00:00', 'expiré', 3),
(52, 14, '2018-05-09 14:00:00', 'disponible', NULL),
(53, 14, '2018-05-09 15:00:00', 'disponible', NULL),
(54, 14, '2018-05-09 16:00:00', 'disponible', NULL),
(55, 14, '2018-05-09 17:00:00', 'expiré', 1),
(56, 14, '2018-05-09 18:00:00', 'expiré', 1),
(57, 14, '2018-05-09 19:00:00', 'expiré', 1),
(58, 5, '2018-05-18 18:00:00', 'expiré', 4),
(59, 5, '2018-05-18 19:00:00', 'expiré', 4),
(60, 5, '2018-06-04 16:00:00', 'expiré', 5),
(61, 5, '2018-06-04 17:00:00', 'expiré', 5),
(62, 5, '2018-06-04 18:00:00', 'expiré', 5),
(63, 5, '2018-06-04 19:00:00', 'expiré', 5),
(64, 5, '2018-06-02 12:00:00', 'expiré', 6),
(65, 5, '2018-06-02 13:00:00', 'expiré', 6),
(66, 4, '2018-05-01 14:00:00', 'expiré', 8),
(67, 4, '2018-05-01 15:00:00', 'expiré', 8),
(68, 4, '2018-05-01 16:00:00', 'expiré', 8),
(69, 4, '2018-05-03 14:00:00', 'expiré', 8),
(70, 4, '2018-05-03 15:00:00', 'expiré', 8),
(71, 4, '2018-05-03 16:00:00', 'expiré', 8),
(72, 4, '2018-05-08 14:00:00', 'expiré', 8),
(73, 4, '2018-05-08 15:00:00', 'expiré', 8),
(74, 4, '2018-05-08 16:00:00', 'expiré', 8),
(75, 4, '2018-05-10 14:00:00', 'expiré', 8),
(76, 4, '2018-05-10 15:00:00', 'expiré', 8),
(77, 4, '2018-05-10 16:00:00', 'expiré', 8),
(78, 4, '2018-05-15 14:00:00', 'expiré', 8),
(79, 4, '2018-05-15 15:00:00', 'expiré', 8),
(80, 4, '2018-05-15 16:00:00', 'expiré', 8),
(81, 4, '2018-05-23 12:00:00', 'expiré', 9),
(82, 4, '2018-05-23 13:00:00', 'expiré', 9),
(83, 4, '2018-06-01 17:00:00', 'expiré', 10),
(84, 4, '2018-06-01 18:00:00', 'expiré', 10),
(85, 10, '2018-06-02 12:00:00', 'expiré', 12),
(86, 10, '2018-06-02 13:00:00', 'expiré', 12),
(87, 10, '2018-06-02 14:00:00', 'expiré', 12),
(88, 10, '2018-06-02 15:00:00', 'expiré', 12),
(89, 10, '2018-06-02 16:00:00', 'expiré', 11),
(90, 10, '2018-06-02 17:00:00', 'expiré', 11),
(91, 10, '2018-06-12 12:00:00', 'reservé', 13),
(92, 10, '2018-06-12 13:00:00', 'reservé', 13),
(93, 10, '2018-06-06 12:00:00', 'expiré', 14),
(94, 10, '2018-06-06 13:00:00', 'expiré', 14),
(95, 12, '2018-06-06 14:00:00', 'expiré', 15),
(96, 12, '2018-06-06 15:00:00', 'expiré', 15),
(97, 12, '2018-06-06 16:00:00', 'expiré', 15),
(98, 12, '2018-06-06 17:00:00', 'expiré', 15),
(99, 12, '2018-06-06 18:00:00', 'expiré', 15),
(100, 12, '2018-06-06 19:00:00', 'expiré', 15),
(101, 12, '2018-06-01 12:00:00', 'expiré', 16),
(102, 12, '2018-06-01 13:00:00', 'expiré', 16),
(103, 12, '2018-06-08 12:00:00', 'expiré', 16),
(104, 12, '2018-06-08 13:00:00', 'expiré', 16),
(105, 12, '2018-06-08 16:00:00', 'expiré', 17),
(106, 12, '2018-06-08 17:00:00', 'expiré', 17),
(107, 13, '2018-06-02 08:00:00', 'expiré', 18),
(108, 13, '2018-06-02 09:00:00', 'expiré', 18),
(109, 13, '2018-06-02 10:00:00', 'expiré', 18),
(110, 13, '2018-06-02 11:00:00', 'expiré', 18),
(111, 13, '2018-05-30 12:00:00', 'expiré', 19),
(112, 13, '2018-05-30 13:00:00', 'expiré', 19),
(113, 13, '2018-05-31 12:00:00', 'expiré', 19),
(114, 13, '2018-05-31 13:00:00', 'expiré', 19),
(115, 13, '2018-06-01 12:00:00', 'expiré', 19),
(116, 13, '2018-06-01 13:00:00', 'expiré', 19),
(117, 13, '2018-06-06 12:00:00', 'expiré', 19),
(118, 13, '2018-06-06 13:00:00', 'expiré', 19),
(119, 13, '2018-06-07 12:00:00', 'expiré', 19),
(120, 13, '2018-06-07 13:00:00', 'expiré', 19),
(121, 13, '2018-06-08 12:00:00', 'expiré', 19),
(122, 13, '2018-06-08 13:00:00', 'expiré', 19),
(123, 13, '2018-06-05 12:00:00', 'expiré', 20),
(124, 13, '2018-06-05 13:00:00', 'expiré', 20),
(125, 15, '2018-05-28 14:00:00', 'expiré', 22),
(126, 15, '2018-05-28 15:00:00', 'expiré', 22),
(127, 15, '2018-05-28 16:00:00', 'expiré', 22),
(128, 15, '2018-06-06 15:00:00', 'expiré', 21),
(129, 15, '2018-06-07 12:00:00', 'disponible', NULL),
(130, 15, '2018-06-07 13:00:00', 'disponible', NULL),
(131, 14, '2018-06-18 09:00:00', 'disponible', NULL),
(132, 14, '2018-06-18 10:00:00', 'disponible', NULL),
(133, 14, '2018-06-18 11:00:00', 'disponible', NULL),
(134, 10, '2018-06-16 17:00:00', 'disponible', NULL),
(135, 10, '2018-06-16 18:00:00', 'disponible', NULL),
(136, 15, '2018-06-22 14:00:00', 'disponible', NULL),
(137, 15, '2018-06-22 15:00:00', 'disponible', NULL),
(138, 15, '2018-06-22 16:00:00', 'disponible', NULL);

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
(1, 16, 'Sansa', '2010-05-05', 'Aucun'),
(2, 16, 'Arya', '2012-01-27', 'Aucun'),
(3, 16, 'Bran', '2012-09-04', 'Allergique aux noix'),
(4, 17, 'Myrcella', '2011-10-12', 'Aucune'),
(5, 17, 'Tommen', '2013-07-20', 'Aucune'),
(6, 18, 'Ramsay', '2007-12-27', 'Végétarien');

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
(3, 'Chinois'),
(4, 'Espagnol'),
(5, 'Japonais'),
(6, 'Arabe');

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
(16, 'Stark', 'Pont-Sainte-Marie, France', 'Grande famille venant du Nord, chaque enfant possède un loup, attention à ne pas laisser les loups s\'approcher des voisins Lannister'),
(17, 'Lannister', 'Troyes, France', 'Un Lannister paie toujours ses dettes.'),
(18, 'Bolton', 'Creney-près-Troyes, France', 'Ne pas oublier de donner à manger aux chiens');

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
(1, 18, 14, 2, 3, 'Sympathique, attention un marteau n\'est pas fait pour jouer.', 45),
(2, 17, 14, 1, 5, 'Aucun souci, nous recommandons Thor !', 22),
(3, 16, 14, 1, 5, 'Ponctuel, bons réflexes auprès des enfants, je recommande.', 14),
(4, 17, 5, 2, 5, 'Excellent niveau de japonais !', 60),
(5, 16, 5, 1, 5, 'Très ponctuelle, sérieuse et agréable, nous recommandons.', 30),
(6, 18, 5, 1, 5, 'Ponctuelle, sérieuse et agréable, nous recommandons.', 14),
(8, 17, 4, 3, 3, 'Sympathique', 225),
(9, 18, 4, 1, 3, 'Sympa', 14),
(10, 16, 4, 2, 5, 'Parfait, Mr Stark enseigne très bien le chinois !', 30),
(11, 16, 10, 2, 5, 'Très bien, Vision maitrise parfaitement l\'arabe !', 60),
(12, 18, 10, 1, 4, 'Pas de problème à signaler', 28),
(13, 17, 10, 2, -1, '', 0),
(14, 17, 10, 2, 5, 'Vision est très pédagogue et possède un excellent niveau', 60),
(15, 16, 12, 1, 4, 'Babysitter sérieux et fort sympathique', 90),
(16, 18, 12, 3, 5, 'Aucun souci à signaler avec Peter, mon enfant l\'a adoré !', 40),
(17, 17, 12, 1, 4, 'Je recommande Peter ! Très charmant et très souriant', 22),
(18, 17, 13, 1, 3, 'Un peu maladroit, mais ne manque pas de bonne volonté', 44),
(19, 16, 13, 3, 3, 'Babysitter efficace, manque de sérieux par moment', 240),
(20, 18, 13, 1, 3, 'Réservations OK', 14),
(21, 16, 15, 2, 5, 'Experte en chinois, les enfants en redemandent', 45),
(22, 18, 15, 2, 5, 'Bilingue en anglais, Maria est une superbe babysitter !', 45);

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
(1, 1, 6),
(2, 2, 4),
(3, 2, 5),
(4, 3, 3),
(5, 4, 4),
(6, 4, 5),
(7, 5, 1),
(8, 5, 2),
(9, 5, 3),
(10, 6, 6),
(13, 8, 4),
(14, 8, 5),
(15, 9, 6),
(16, 10, 2),
(17, 11, 2),
(18, 11, 3),
(19, 12, 6),
(20, 13, 4),
(21, 13, 5),
(22, 14, 4),
(23, 14, 5),
(24, 15, 1),
(25, 15, 2),
(26, 15, 3),
(27, 16, 6),
(28, 17, 4),
(29, 17, 5),
(30, 18, 4),
(31, 18, 5),
(32, 19, 1),
(33, 19, 2),
(34, 19, 3),
(35, 20, 6),
(36, 21, 1),
(37, 21, 2),
(38, 21, 3),
(39, 22, 6);

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
  ADD KEY `babysitter_deletion_langue` (`id_babysitter`),
  ADD KEY `langue_deletion_langue` (`id_langue`);

--
-- Index pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  ADD PRIMARY KEY (`id_dispo`),
  ADD KEY `reservation_deletion_dispo` (`id_reservation`),
  ADD KEY `babysitter_deletion_dispo` (`id_babysitter`);

--
-- Index pour la table `enfants`
--
ALTER TABLE `enfants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_deletion_enfant` (`id_parent`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `babysitter_deletion_reservations` (`id_babysitter`),
  ADD KEY `parents_deletion_reservations` (`id_parent`);

--
-- Index pour la table `reservation_enfant`
--
ALTER TABLE `reservation_enfant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enfant_deletion_reservationenfant` (`id_enfant`),
  ADD KEY `reservations_deletion_reservationenfants` (`id_reservation`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `authentifiants`
--
ALTER TABLE `authentifiants`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `babysitter_langue`
--
ALTER TABLE `babysitter_langue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  MODIFY `id_dispo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
--
-- AUTO_INCREMENT pour la table `enfants`
--
ALTER TABLE `enfants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `langues`
--
ALTER TABLE `langues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `reservation_enfant`
--
ALTER TABLE `reservation_enfant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
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
  ADD CONSTRAINT `babysitter_deletion_langue` FOREIGN KEY (`id_babysitter`) REFERENCES `babysitters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `langue_deletion_langue` FOREIGN KEY (`id_langue`) REFERENCES `langues` (`id`);

--
-- Contraintes pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  ADD CONSTRAINT `babysitter_deletion_dispo` FOREIGN KEY (`id_babysitter`) REFERENCES `babysitters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_deletion_dispo` FOREIGN KEY (`id_reservation`) REFERENCES `reservations` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `enfants`
--
ALTER TABLE `enfants`
  ADD CONSTRAINT `parent_deletion_enfant` FOREIGN KEY (`id_parent`) REFERENCES `parents` (`id_parent`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `user_parent` FOREIGN KEY (`id_parent`) REFERENCES `authentifiants` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `babysitter_deletion_reservations` FOREIGN KEY (`id_babysitter`) REFERENCES `babysitters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parents_deletion_reservations` FOREIGN KEY (`id_parent`) REFERENCES `parents` (`id_parent`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservation_enfant`
--
ALTER TABLE `reservation_enfant`
  ADD CONSTRAINT `enfant_deletion_reservationenfant` FOREIGN KEY (`id_enfant`) REFERENCES `enfants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_deletion_reservationenfants` FOREIGN KEY (`id_reservation`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;
