-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Sam 09 Juin 2018 à 10:41
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

-- --------------------------------------------------------

--
-- Structure de la table `babysitter_langue`
--

CREATE TABLE `babysitter_langue` (
  `id` int(11) NOT NULL,
  `id_babysitter` int(11) NOT NULL,
  `id_langue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE `langues` (
  `id` int(11) NOT NULL,
  `langue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
