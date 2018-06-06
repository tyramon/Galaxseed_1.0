-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 06 juin 2018 à 07:59
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `galaxseed`
--

-- --------------------------------------------------------

--
-- Structure de la table `authorization`
--

DROP TABLE IF EXISTS `authorization`;
CREATE TABLE IF NOT EXISTS `authorization` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(25) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `capacity`
--

DROP TABLE IF EXISTS `capacity`;
CREATE TABLE IF NOT EXISTS `capacity` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(25) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `capacity`
--

INSERT INTO `capacity` (`c_id`, `c_name`) VALUES
(1, 'guest'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `card_game`
--

DROP TABLE IF EXISTS `card_game`;
CREATE TABLE IF NOT EXISTS `card_game` (
  `cg_id` int(11) NOT NULL AUTO_INCREMENT,
  `cg_name` varchar(255) DEFAULT NULL,
  `cg_health_point` int(11) DEFAULT NULL,
  `cg_attack` int(11) DEFAULT NULL,
  `cg_mana` int(11) DEFAULT NULL,
  `cg_shield` tinyint(1) DEFAULT NULL,
  `t_id` int(11) NOT NULL,
  `cg_description` varchar(255) DEFAULT NULL,
  `ht_id` varchar(50) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ic_id` int(11) DEFAULT NULL,
  `l_id` int(11) NOT NULL,
  PRIMARY KEY (`cg_id`),
  KEY `FK_card_game_i_id` (`ic_id`) USING BTREE,
  KEY `FK-card_game_ht_id` (`ht_id`) USING BTREE,
  KEY `FK_card_game_s_id` (`s_id`) USING BTREE,
  KEY `FK_card_game_t_id` (`t_id`) USING BTREE,
  KEY `FK_card_game_l_id` (`l_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `card_template`
--

DROP TABLE IF EXISTS `card_template`;
CREATE TABLE IF NOT EXISTS `card_template` (
  `ct_id` int(11) NOT NULL AUTO_INCREMENT,
  `ct_name` varchar(200) NOT NULL,
  `ct_health_point` int(11) DEFAULT NULL,
  `ct_attack` int(11) DEFAULT NULL,
  `ct_mana` int(11) DEFAULT NULL,
  `ct_shield` tinyint(4) NOT NULL,
  `t_id` int(11) NOT NULL,
  `ct_description` text,
  `ht_id` varchar(50) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ic_id` int(11) DEFAULT NULL,
  `l_id` int(11) NOT NULL,
  PRIMARY KEY (`ct_id`),
  KEY `FK_card_template_t_id` (`t_id`),
  KEY `FK_card_template_s_id` (`s_id`) USING BTREE,
  KEY `FK-card_template_ht_id` (`ht_id`) USING BTREE,
  KEY `FK_card_template_i_id` (`ic_id`) USING BTREE,
  KEY `FK_card_template_l_id` (`l_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `card_template`
--

INSERT INTO `card_template` (`ct_id`, `ct_name`, `ct_health_point`, `ct_attack`, `ct_mana`, `ct_shield`, `t_id`, `ct_description`, `ht_id`, `s_id`, `ic_id`, `l_id`) VALUES
(1, 'carte1', 0, 1, 1, 0, 2, NULL, '1', 0, NULL, 0),
(2, 'carte2', 0, 4, 3, 0, 2, NULL, '1', 0, NULL, 0),
(3, 'carte 3', 0, 6, 5, 0, 2, NULL, '2', 0, NULL, 0),
(4, 'carte4', 3, 1, 1, 1, 3, NULL, '2', 0, NULL, 0),
(5, '', 6, 3, 3, 1, 3, NULL, '', 0, NULL, 0),
(6, '', 1, 2, 1, 0, 3, NULL, '', 0, NULL, 0),
(7, '', 3, 2, 2, 0, 3, NULL, '', 0, NULL, 0),
(8, '', 3, 5, 3, 0, 3, NULL, '', 0, NULL, 0),
(9, '', 4, 2, 4, 0, 3, NULL, '', 0, NULL, 0),
(10, '', 5, 7, 5, 0, 3, NULL, '', 0, NULL, 0),
(11, '', 6, 8, 7, 0, 3, NULL, '', 0, NULL, 0),
(12, '', 9, 9, 9, 0, 1, NULL, '', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_date` date NOT NULL,
  `g_round_count` int(11) NOT NULL,
  `u_id_p1` int(11) NOT NULL,
  `hg_id_p1` int(11) NOT NULL,
  `u_id_p2` int(11) NOT NULL,
  `hg_id_p2` int(11) NOT NULL,
  PRIMARY KEY (`g_id`),
  KEY `FK_game_u_id` (`u_id_p1`),
  KEY `FK_game_hg_id` (`hg_id_p1`),
  KEY `FK_game_u_id_user` (`u_id_p2`),
  KEY `FK_game_hg_id_hero_game` (`hg_id_p2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `give_authorization`
--

DROP TABLE IF EXISTS `give_authorization`;
CREATE TABLE IF NOT EXISTS `give_authorization` (
  `c_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  PRIMARY KEY (`c_id`,`a_id`),
  KEY `FK_give_authorization_a_id` (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `hero_game`
--

DROP TABLE IF EXISTS `hero_game`;
CREATE TABLE IF NOT EXISTS `hero_game` (
  `hg_id` int(11) NOT NULL AUTO_INCREMENT,
  `hg_name` varchar(255) NOT NULL,
  `hg_health_point` int(11) NOT NULL,
  `hg_mana_count` int(11) NOT NULL,
  `hg_board` varchar(255) NOT NULL,
  `ih_id` int(11) NOT NULL,
  PRIMARY KEY (`hg_id`),
  KEY `FK_hero_game_i_id` (`ih_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `hero_template`
--

DROP TABLE IF EXISTS `hero_template`;
CREATE TABLE IF NOT EXISTS `hero_template` (
  `ht_id` int(11) NOT NULL AUTO_INCREMENT,
  `ht_name` varchar(50) NOT NULL,
  `ht_health_point` int(11) DEFAULT NULL,
  `ht_mana_count` int(11) NOT NULL,
  `ht_board` varchar(50) NOT NULL,
  `ih_id` int(11) NOT NULL,
  PRIMARY KEY (`ht_id`),
  KEY `FK_hero_template_i_id` (`ih_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `hero_template`
--

INSERT INTO `hero_template` (`ht_id`, `ht_name`, `ht_health_point`, `ht_mana_count`, `ht_board`, `ih_id`) VALUES
(1, 'diskor', 20, 1, 'diskor', 0),
(2, 'reine_sadida', 20, 1, 'sadida', 0);

-- --------------------------------------------------------

--
-- Structure de la table `illustration_card`
--

DROP TABLE IF EXISTS `illustration_card`;
CREATE TABLE IF NOT EXISTS `illustration_card` (
  `ic_id` int(11) NOT NULL,
  `ic_url` varchar(255) NOT NULL,
  PRIMARY KEY (`ic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `illustration_hero`
--

DROP TABLE IF EXISTS `illustration_hero`;
CREATE TABLE IF NOT EXISTS `illustration_hero` (
  `ih_id` int(11) NOT NULL,
  `ih_url` varchar(255) NOT NULL,
  PRIMARY KEY (`ih_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_name` varchar(25) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`l_id`, `l_name`) VALUES
(1, 'deck'),
(2, 'hand'),
(3, 'board'),
(4, 'discard');

-- --------------------------------------------------------

--
-- Structure de la table `sign_up_news`
--

DROP TABLE IF EXISTS `sign_up_news`;
CREATE TABLE IF NOT EXISTS `sign_up_news` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_email` varchar(50) NOT NULL,
  `s_date` date NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sign_up_news`
--

INSERT INTO `sign_up_news` (`s_id`, `s_email`, `s_date`) VALUES
(1, 'demcel83@gmail.com', '2018-03-28'),
(2, 'sebastien.caillault@gmail.com', '2018-03-28'),
(3, 'vignau.raphael@gmail.com', '2018-03-28'),
(4, 'skandernabli34@gmail.com', '2018-03-28');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(25) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`s_id`, `s_name`) VALUES
(1, 'endormie'),
(2, 'eveil');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(25) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`t_id`, `t_name`) VALUES
(1, 'legendary'),
(2, 'spell'),
(3, 'creature');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_login` varchar(200) NOT NULL,
  `u_nom` varchar(50) NOT NULL,
  `u_prenom` varchar(50) NOT NULL,
  `u_password` varchar(200) NOT NULL,
  `u_email` varchar(200) NOT NULL,
  `u_registration_date` date DEFAULT NULL,
  `u_game_count` int(11) DEFAULT NULL,
  `u_victory_count` int(11) DEFAULT NULL,
  `u_connect` tinyint(1) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `g_id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`u_id`),
  KEY `FK_user_c_id` (`c_id`),
  KEY `FK_user_g_id` (`g_id`),
  KEY `FK_user_s_id` (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`u_id`, `u_login`, `u_nom`, `u_prenom`, `u_password`, `u_email`, `u_registration_date`, `u_game_count`, `u_victory_count`, `u_connect`, `c_id`, `g_id`, `s_id`) VALUES
(4, 'Injaze', 'azer@aze.deazeaze', 'azeaze', '$2y$10$vS6iZ0FAXGeOB3A/gYvYsO/fSJylhUP1wzQ3kRHV.Czqn23KU7Qza', 'azeaze', '2018-03-28', 0, 0, NULL, 1, NULL, NULL),
(6, '', '', '', '', '', '2018-05-09', 0, 0, NULL, 1, NULL, NULL),
(7, '', '', '', '', '', '2018-01-01', 1, 1, NULL, 1, NULL, NULL),
(8, 'Shibalba', 'Skander', 'Skander', '$2y$10$D1ZwSoyT1.zxkq.RqVLKnuVgLGluYCg.BJZdMXDjBYudezfUgEqMa', 'azer@aze.de', '2018-05-02', 1, 1, NULL, 1, NULL, NULL),
(9, 'azfa', 'nabli', 'aze', '$2y$10$M7bZbduZs4C/xzYcFVBTuOIT8w84qIMV9SUoENv2XSsrpqhI.g4x.', 'aze@aze.azea', '2018-05-02', 1, 1, NULL, 1, NULL, NULL),
(10, 'Shiblba', 'Skander', 'Skander', '$2y$10$pqSu9JAZ4H6oW5VGPc8yDOyeNnIfdBFzmAmUjUEjyIPY4u8/Lt4J.', 'azer@ze.de', '2018-05-02', NULL, NULL, NULL, 1, NULL, NULL),
(11, 'sqf4418', 'Merah', 'Jordan', '$2y$10$7fB4g41oNXkKaLFz/qO4UuxSUvH3.CoYRZEGos7JJUvQvjuntGuZe', 'XiTiD.Gamer@gmail.com', '2018-05-02', NULL, NULL, NULL, 1, NULL, NULL),
(12, 'test', 'test', 'test', '$2y$10$oFdIZczQrJHV74z0m3wifO42weakNdXa0OqxCRBPwn8X5Sx57OBtG', 'test@test.test', '2018-05-02', NULL, NULL, NULL, 1, NULL, NULL),
(13, 'azefqsdf', 'Merah', 'Jordan', '$2y$10$vJoglZD8j63oKryGrl7O7eU0AWGkAtktxj1EdUOy1jM9ykF23iwAC', 'XiTiD.Gamer@gmail.com', '2018-05-02', NULL, NULL, NULL, 1, NULL, NULL),
(14, 'sqf4418aze', 'Merah', 'Jordan', '$2y$10$SAVRyNAkB.G/kjEDUbiSPufn9Ok824ARSjsWwlluWQrX02fVOp1bm', 'XiTiD.Gamer@gmail.com', '2018-05-02', NULL, NULL, NULL, 1, NULL, NULL),
(15, 'azfaazeaze', 'Merah', 'Jordan', '$2y$10$vrepPzW0sciAmkqJosR76u1OsIXTAlELR3h.Xdo50tipCfPjxiu8e', 'XiTiD.Gamer@gmail.com', '2018-05-02', NULL, NULL, NULL, 1, NULL, NULL),
(16, 'aze', 'aze', 'aze', '$2y$10$oIIqEyrBeG51aZmojogTPOtyxlqTfmOaLNWWL3TufgzPFPDWg79ES', 'aze@aze.aze', '2018-05-02', NULL, NULL, NULL, 1, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `card_template`
--
ALTER TABLE `card_template`
  ADD CONSTRAINT `FK_card_template_t_id` FOREIGN KEY (`t_id`) REFERENCES `type` (`t_id`);

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `FK_game_hg_id` FOREIGN KEY (`hg_id_p1`) REFERENCES `hero_game` (`hg_id`),
  ADD CONSTRAINT `FK_game_hg_id_hero_game` FOREIGN KEY (`hg_id_p2`) REFERENCES `hero_game` (`hg_id`),
  ADD CONSTRAINT `FK_game_u_id` FOREIGN KEY (`u_id_p1`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `FK_game_u_id_user` FOREIGN KEY (`u_id_p2`) REFERENCES `user` (`u_id`);

--
-- Contraintes pour la table `give_authorization`
--
ALTER TABLE `give_authorization`
  ADD CONSTRAINT `FK_give_authorization_a_id` FOREIGN KEY (`a_id`) REFERENCES `authorization` (`a_id`),
  ADD CONSTRAINT `FK_give_authorization_c_id` FOREIGN KEY (`c_id`) REFERENCES `capacity` (`c_id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_c_id` FOREIGN KEY (`c_id`) REFERENCES `capacity` (`c_id`),
  ADD CONSTRAINT `FK_user_g_id` FOREIGN KEY (`g_id`) REFERENCES `game` (`g_id`),
  ADD CONSTRAINT `FK_user_s_id` FOREIGN KEY (`s_id`) REFERENCES `sign_up_news` (`s_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
