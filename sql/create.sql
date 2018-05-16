-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mer 16 Mai 2018 à 11:19
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
(12, 'marc@lemercier.fr', '$2y$10$W/58VEhnNBgdPMx378IYfeue0nfZKPUpXHU0eoMmWf/IrmmHihUWK', 2);

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
  `experience` int(11) NOT NULL,
  `candidature_valide` tinyint(1) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `babysitters`
--

INSERT INTO `babysitters` (`id`, `nom`, `prenom`, `ville`, `portable`, `age`, `experience`, `candidature_valide`, `visible`) VALUES
(3, 'Annebicque', 'Arthur', 'Paris, France', '0650913185', 23, 1, 0, 0),
(6, 'Dujardin', 'Vincent', 'Lille, France', '0678987654', 23, 1, 0, 0),
(11, 'Gaulhet', 'Valentin', 'Troyes, France', '0601020304', 20, -1, 0, 0);

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
(12, 6, '2018-05-18 11:00:00', 'reservé', 10),
(13, 6, '2018-05-18 12:00:00', 'reservé', 10),
(14, 6, '2018-05-18 13:00:00', 'reservé', 15),
(15, 6, '2018-05-18 14:00:00', 'reservé', 15),
(16, 3, '2018-05-20 18:00:00', 'disponible', NULL),
(17, 3, '2018-05-20 19:00:00', 'reservé', 9),
(18, 3, '2018-05-20 20:00:00', 'reservé', 9),
(19, 3, '2018-05-20 21:00:00', 'disponible', NULL),
(20, 6, '2018-05-20 11:00:00', 'reservé', 17),
(21, 6, '2018-05-20 12:00:00', 'reservé', 17),
(22, 6, '2018-05-20 13:00:00', 'reservé', 17),
(23, 6, '2018-05-20 14:00:00', 'reservé', 17),
(24, 6, '2018-05-20 15:00:00', 'disponible', NULL),
(25, 6, '2018-05-20 16:00:00', 'disponible', NULL),
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
(40, 11, '2018-05-17 10:00:00', 'reservé', 47),
(41, 11, '2018-05-17 11:00:00', 'reservé', 47);

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
(10, 10, 6, 1, -1, '', 0),
(15, 10, 6, 1, -1, '', 0),
(17, 10, 6, 1, -1, '', 0),
(43, 10, 3, 1, -1, '', 0),
(45, 10, 3, 1, 4, 'satisfait', 122),
(46, 10, 6, 1, 4, 'bien', 122),
(47, 12, 11, 1, -1, '', 0);

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
(61, 47, 3);

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  MODIFY `id_dispo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pour la table `enfants`
--
ALTER TABLE `enfants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `reservation_enfant`
--
ALTER TABLE `reservation_enfant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
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
  ADD CONSTRAINT `user_babysitter` FOREIGN KEY (`id`) REFERENCES `authentifiants` (`id_user`);

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
