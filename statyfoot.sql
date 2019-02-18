-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 17 fév. 2019 à 17:56
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `statyfoot`
--

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elapsed` int(11) NOT NULL,
  `team_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `player` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fixtures_date`
--

DROP TABLE IF EXISTS `fixtures_date`;
CREATE TABLE IF NOT EXISTS `fixtures_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fixture_id` int(11) NOT NULL,
  `event_date` datetime NOT NULL,
  `league_id` int(11) NOT NULL,
  `round` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `home_team` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `away_team` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_short` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goals_home_team` int(11) NOT NULL,
  `goals_away_team` int(11) NOT NULL,
  `halftime_score` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_score` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penalty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elapsed` int(11) NOT NULL,
  `first_half_start` int(11) NOT NULL,
  `second_half_start` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

DROP TABLE IF EXISTS `joueurs`;
CREATE TABLE IF NOT EXISTS `joueurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `leagues`
--

DROP TABLE IF EXISTS `leagues`;
CREATE TABLE IF NOT EXISTS `leagues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `league_id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `season` int(11) NOT NULL,
  `season_start` datetime NOT NULL,
  `season_end` datetime NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standings` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `line_ups`
--

DROP TABLE IF EXISTS `line_ups`;
CREATE TABLE IF NOT EXISTS `line_ups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formation` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coach` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) DEFAULT NULL,
  `player` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matchdirect`
--

DROP TABLE IF EXISTS `matchdirect`;
CREATE TABLE IF NOT EXISTS `matchdirect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fixture_id` int(11) NOT NULL,
  `event_timestamp` int(11) NOT NULL,
  `event_date` datetime NOT NULL,
  `league_id` int(11) NOT NULL,
  `round` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `home_team` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `away_team` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_short` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goals_home_team` int(11) NOT NULL,
  `goals_away_team` int(11) NOT NULL,
  `halftime_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penalty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elapsed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_half_start` int(11) NOT NULL,
  `second_half_start` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `match_details`
--

DROP TABLE IF EXISTS `match_details`;
CREATE TABLE IF NOT EXISTS `match_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fixture_id` int(11) NOT NULL,
  `event_date` datetime NOT NULL,
  `league_id` int(11) NOT NULL,
  `round` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `home_team` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `away_team` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_short` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goals_home_team` int(11) NOT NULL,
  `goals_away_team` int(11) NOT NULL,
  `halftime_score` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_score` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penalty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elapsed` int(11) NOT NULL,
  `first_half_start` int(11) NOT NULL,
  `second_half_start` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `email`, `password`, `pseudo`, `roles`) VALUES
(1, 'brice', 'brice', 'brice@gmail.com', '$2y$13$A0KZ.RRiUj8AZ0lzQFu8XeuxAmY0oSAIzqkwNI7DmEq7IVkJv16qO', 'brikema', 'a:1:{i:0;s:11:\"ROLE_MEMBRE\";}');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190213072433', '2019-02-14 21:19:13'),
('20190213104928', '2019-02-14 21:19:14'),
('20190213121609', '2019-02-14 21:19:14'),
('20190213153736', '2019-02-14 21:19:14'),
('20190214070729', '2019-02-14 21:19:14'),
('20190214074054', '2019-02-14 21:19:14');

-- --------------------------------------------------------

--
-- Structure de la table `standings`
--

DROP TABLE IF EXISTS `standings`;
CREATE TABLE IF NOT EXISTS `standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `team_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matchs_played` int(11) NOT NULL,
  `win` int(11) NOT NULL,
  `draw` int(11) NOT NULL,
  `lose` int(11) NOT NULL,
  `goals_for` int(11) NOT NULL,
  `goals_against` int(11) NOT NULL,
  `goals_diff` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
