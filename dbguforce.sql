-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 04 Avril 2017 à 17:08
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `dbguforce`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `pseudo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `typeavis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pseudo`,`nom`),
  KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `avis`
--

INSERT INTO `avis` (`pseudo`, `nom`, `typeavis`) VALUES
('guforce', 'Blood like gasoline', 'Aimer'),
('guforce', 'Bronies must die', 'Aimer'),
('guforce', 'you reposted in the wrong neighborhood', 'Neutre'),
('guforce', 'You touch my tralala', 'PasAimer'),
('ThiBei', 'Blood like gasoline', 'Neutre'),
('ThiBei', 'Stay High', 'Aimer');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `idCom` int(11) NOT NULL,
  `pseudo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `dateParution` datetime NOT NULL,
  PRIMARY KEY (`idCom`),
  KEY `fk_nomMusique` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`idCom`, `pseudo`, `nom`, `contenu`, `dateParution`) VALUES
(1, 'ThiBei', 'Blood like gasoline', '2', '2017-01-11 18:17:14'),
(2, 'ThiBei', 'Blood like gasoline', '3', '2017-01-11 18:17:16'),
(3, 'guforce', 'Blood like gasoline', 'un commentaire', '2017-01-12 20:50:38'),
(4, 'guforce', 'You touch my tralala', 'Il y a beaucoup trop de commentaires', '2017-02-23 15:55:07'),
(5, 'ThiBei', 'You touch my tralala', 'Je suis d''accord', '2017-02-23 15:55:46'),
(6, 'guforce', 'You touch my tralala', 'J''aime les kiwis', '2017-02-23 15:56:46');

-- --------------------------------------------------------

--
-- Structure de la table `music`
--

CREATE TABLE IF NOT EXISTS `music` (
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `couvertureAlbum` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `dateMiseLigne` date NOT NULL,
  `avisFavorable` int(11) NOT NULL,
  `avisNegatif` int(11) NOT NULL,
  `avisIndifferent` int(11) NOT NULL,
  `dureeEcoute` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `music`
--

INSERT INTO `music` (`nom`, `couvertureAlbum`, `dateMiseLigne`, `avisFavorable`, `avisNegatif`, `avisIndifferent`, `dureeEcoute`) VALUES
('Blood like gasoline', 'http://s.mxmcdn.net/images-storage/albums4/2/8/5/8/3/5/33538582_350_350.jpg', '2017-01-09', 1, 0, 1, '3:18'),
('Bronies must die', 'http://vignette1.wikia.nocookie.net/desencyclopedie/images/3/30/Poney-singe.JPG/revision/latest?cb=20080430142543', '2017-02-23', 1, 0, 0, '3:25'),
('Stay High', 'http://s.mxmcdn.net/images-storage/albums/8/3/2/7/8/8/30887238_350_350.jpg', '2017-01-09', 1, 0, 0, '3:19'),
('you reposted in the wrong neighborhood', 'Image/reposted.jpg', '2017-01-10', 0, 0, 1, '3:39'),
('You touch my tralala', 'http://cdn.meme.am/instances/50225688.jpg', '2017-02-23', 0, 1, 0, '6:66');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pseudo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `token` int(11) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email`, `pseudo`, `password`, `token`) VALUES
('guillaume.force@toto.fr', 'titi', 'pomme', 1),
('guillaume.force@udamail.fr', 'guforce', 'force', 2),
('laure.merle@lol.fr', 'Laure', 'troll', 1),
('thibault.beignier@laposte.fr', 'ThiBei', 'beignier', 1),
('vicoste@lol.fr', 'coste', 'troll', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`nom`) REFERENCES `music` (`nom`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_nomMusique` FOREIGN KEY (`nom`) REFERENCES `music` (`nom`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
