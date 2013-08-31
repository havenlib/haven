-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 29 Août 2013 à 00:11
-- Version du serveur: 5.5.31
-- Version de PHP: 5.5.1-2+debphp.org~quantal+2

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `evocatio_siteweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `ApplicationFile`
--

DROP TABLE IF EXISTS `ApplicationFile`;
CREATE TABLE IF NOT EXISTS `ApplicationFile` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Area`
--

DROP TABLE IF EXISTS `Area`;
CREATE TABLE IF NOT EXISTS `Area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_77A692565DA0FB8` (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `Area`
--

INSERT INTO `Area` (`id`, `template_id`, `name`) VALUES
(1, 1, 'theatre'),
(2, 1, 'aside'),
(3, 2, 'theatre'),
(4, 2, 'footer'),
(5, 5, 'theatre'),
(6, 5, 'sidebar');

-- --------------------------------------------------------

--
-- Structure de la table `AudioFile`
--

DROP TABLE IF EXISTS `AudioFile`;
CREATE TABLE IF NOT EXISTS `AudioFile` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
CREATE TABLE IF NOT EXISTS `Categories` (
  `category_id` int(11) NOT NULL,
  `my_category_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`my_category_id`),
  KEY `IDX_75AE45B812469DE2` (`category_id`),
  KEY `IDX_75AE45B8E0D319AA` (`my_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Category`
--

DROP TABLE IF EXISTS `Category`;
CREATE TABLE IF NOT EXISTS `Category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `CategoryTranslation`
--

DROP TABLE IF EXISTS `CategoryTranslation`;
CREATE TABLE IF NOT EXISTS `CategoryTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_51241CAA3059CC60` (`trans_lang_id`),
  KEY `IDX_51241CAA12469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Company`
--

DROP TABLE IF EXISTS `Company`;
CREATE TABLE IF NOT EXISTS `Company` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Content`
--

DROP TABLE IF EXISTS `Content`;
CREATE TABLE IF NOT EXISTS `Content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) DEFAULT NULL,
  `discr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Contenu de la table `Content`
--

INSERT INTO `Content` (`id`, `status`, `discr`) VALUES
(1, NULL, 'html'),
(2, NULL, 'news_widget'),
(3, NULL, 'html'),
(4, NULL, 'html'),
(5, NULL, 'html'),
(6, NULL, 'html'),
(7, NULL, 'html'),
(8, NULL, 'html'),
(9, NULL, 'html'),
(10, NULL, 'html'),
(11, NULL, 'html'),
(12, NULL, 'html'),
(13, NULL, 'html'),
(14, NULL, 'html'),
(15, NULL, 'html'),
(16, NULL, 'html'),
(17, NULL, 'html'),
(18, NULL, 'html'),
(19, NULL, 'html'),
(20, NULL, 'html'),
(21, NULL, 'html'),
(22, NULL, 'html'),
(23, NULL, 'html'),
(24, NULL, 'html'),
(25, NULL, 'html'),
(26, NULL, 'html'),
(27, NULL, 'html'),
(28, NULL, 'html'),
(29, NULL, 'html'),
(30, NULL, 'html'),
(31, NULL, 'html'),
(32, NULL, 'html'),
(33, NULL, 'html'),
(34, NULL, 'html'),
(35, NULL, 'html'),
(36, NULL, 'news_widget'),
(37, NULL, 'news_widget'),
(38, NULL, 'html'),
(39, NULL, 'html'),
(40, NULL, 'html');

-- --------------------------------------------------------

--
-- Structure de la table `Coordinate`
--

DROP TABLE IF EXISTS `Coordinate`;
CREATE TABLE IF NOT EXISTS `Coordinate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plane` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Country`
--

DROP TABLE IF EXISTS `Country`;
CREATE TABLE IF NOT EXISTS `Country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `CountryTranslation`
--

DROP TABLE IF EXISTS `CountryTranslation`;
CREATE TABLE IF NOT EXISTS `CountryTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_41FF00ADF92F3E70` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Culture`
--

DROP TABLE IF EXISTS `Culture`;
CREATE TABLE IF NOT EXISTS `Culture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) DEFAULT NULL,
  `symbol` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7914A57782F1BAF4` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Culture`
--

INSERT INTO `Culture` (`id`, `language_id`, `symbol`, `status`) VALUES
(1, 1, 'en_DK', 1),
(2, 2, 'fr_CH', 1);

-- --------------------------------------------------------

--
-- Structure de la table `CultureTranslation`
--

DROP TABLE IF EXISTS `CultureTranslation`;
CREATE TABLE IF NOT EXISTS `CultureTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `culture_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E8AED59B3059CC60` (`trans_lang_id`),
  KEY `IDX_E8AED59BB108249D` (`culture_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `CultureTranslation`
--

INSERT INTO `CultureTranslation` (`id`, `trans_lang_id`, `culture_id`, `name`) VALUES
(1, 1, 1, 'Denmark'),
(2, 2, 1, 'Danemark'),
(3, 1, 2, 'Switzerland'),
(4, 2, 2, 'Suisse');

-- --------------------------------------------------------

--
-- Structure de la table `Employee`
--

DROP TABLE IF EXISTS `Employee`;
CREATE TABLE IF NOT EXISTS `Employee` (
  `id` int(11) NOT NULL,
  `firstname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ExternalLink`
--

DROP TABLE IF EXISTS `ExternalLink`;
CREATE TABLE IF NOT EXISTS `ExternalLink` (
  `id` int(11) NOT NULL,
  `url` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Faq`
--

DROP TABLE IF EXISTS `Faq`;
CREATE TABLE IF NOT EXISTS `Faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Faq`
--

INSERT INTO `Faq` (`id`, `status`, `rank`) VALUES
(1, 1, 3),
(2, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `FaqTranslation`
--

DROP TABLE IF EXISTS `FaqTranslation`;
CREATE TABLE IF NOT EXISTS `FaqTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `faq_id` int(11) DEFAULT NULL,
  `question` longtext COLLATE utf8_unicode_ci NOT NULL,
  `response` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_5D3870943059CC60` (`trans_lang_id`),
  KEY `IDX_5D38709481BEC8C2` (`faq_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `FaqTranslation`
--

INSERT INTO `FaqTranslation` (`id`, `trans_lang_id`, `faq_id`, `question`, `response`) VALUES
(1, 2, 1, 'test', 'test'),
(2, 1, 1, 'test', 'test'),
(3, 2, 2, 'test', 'test'),
(4, 1, 2, 'test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `File`
--

DROP TABLE IF EXISTS `File`;
CREATE TABLE IF NOT EXISTS `File` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mimeType` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pathName` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fileName` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `discr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `FilePage`
--

DROP TABLE IF EXISTS `FilePage`;
CREATE TABLE IF NOT EXISTS `FilePage` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2F66EC2BC4663E4` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `GenericProduct`
--

DROP TABLE IF EXISTS `GenericProduct`;
CREATE TABLE IF NOT EXISTS `GenericProduct` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `GenericProductTranslation`
--

DROP TABLE IF EXISTS `GenericProductTranslation`;
CREATE TABLE IF NOT EXISTS `GenericProductTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `faq_id` int(11) DEFAULT NULL,
  `name` longtext COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_64709C0B3059CC60` (`trans_lang_id`),
  KEY `IDX_64709C0B81BEC8C2` (`faq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `HtmlContent`
--

DROP TABLE IF EXISTS `HtmlContent`;
CREATE TABLE IF NOT EXISTS `HtmlContent` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `HtmlContent`
--

INSERT INTO `HtmlContent` (`id`) VALUES
(1),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(38),
(39),
(40);

-- --------------------------------------------------------

--
-- Structure de la table `HtmlContentTranslation`
--

DROP TABLE IF EXISTS `HtmlContentTranslation`;
CREATE TABLE IF NOT EXISTS `HtmlContentTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_1DA4DFD3059CC60` (`trans_lang_id`),
  KEY `IDX_1DA4DFD84A0A3ED` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=75 ;

--
-- Contenu de la table `HtmlContentTranslation`
--

INSERT INTO `HtmlContentTranslation` (`id`, `trans_lang_id`, `content_id`, `content`) VALUES
(1, 2, 1, '<p style="text-align:justify">&nbsp;</p>\r\n\r\n<p style="text-align:justify"><span style="font-family:comic sans ms,cursive"><span style="color:#3399ff"><span style="font-size:20px"><strong>Evocatio aime &ecirc;tre en avance sur la courbe! <img alt="smiley" src="http://demochampagne.evocatio.com/js/ckeditor/plugins/smiley/images/regular_smile.gif" style="height:20px; width:20px" title="smiley" /></strong></span></span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Fond&eacute;e en 2010, Evocatio IT Solutions se localise en face du World Trade Center, en plein c&oelig;ur du Vieux-Montr&eacute;al au 3e &eacute;tage du 388 St-Jacques. Evocatio est un membre actif de l&#39;APELL (Association Professionnelle des Entreprises en Logiciels Libres).</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Depuis le d&eacute;but, les mandats d&rsquo;Evocatio ont &eacute;t&eacute; de mettre en place des applications et sites web personnalis&eacute;es de diff&eacute;rentes tailles. Tous nos clients ne demandent pas les m&ecirc;mes niveaux de service. D&rsquo;un site promotionnel qui sera en ligne en deux mois en passant par une application complexe de gestion avec un nombre d&rsquo;utilisateurs externes &eacute;lev&eacute;s. Nous mettons en place les ressources qui conviennent selon les budgets allou&eacute;s au projet.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">St&eacute;phan Champagne, directeur g&eacute;n&eacute;ral d&rsquo;Evocatio, est &eacute;galement le fondateur de DEVLABmtl. Une organisation &agrave; but non lucratif qui accueille r&eacute;guli&egrave;rement des <strong>&laquo;&nbsp;GEEK de nuits &raquo;</strong> dans le but d&#39;amener les professionnels &agrave; partager leurs connaissances sur les nouvelles technologies notamment sur le d&eacute;veloppement open-source. St&eacute;phan, si&egrave;ge &eacute;galement au conseil d&#39;administration de Co-op Innov. Ces efforts sont consacr&eacute;s &agrave; l&#39;am&eacute;lioration des normes de l&#39;industrie et &agrave; repousser les limites de la technologie.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Avec plus de 15 ann&eacute;es d&#39;exp&eacute;riences de programmation et une grande passion pour l&#39;architecture, St&eacute;phan est tr&egrave;s respect&eacute; par ses pairs pour la qualit&eacute; de son code et l&rsquo;efficacit&eacute; de son travail. Il se passionne&nbsp; beaucoup pour le milieu Open Source et croit beaucoup en sa communaut&eacute; informatique.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">St&eacute;phan est un entrepreneur qui a beaucoup d&rsquo;exp&eacute;riences en termes de management, il sait que la confiance de ses clients est la cl&eacute; du succ&egrave;s de son entreprise et cherche toujours &agrave; honorer leurs investissements par des r&eacute;sultats concrets et &agrave; haute valeur ajout&eacute;e.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Evocatio en quelques mots c&rsquo;est&nbsp;:</span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Une &eacute;quipe dynamique</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Des jeunes qui arrivent &agrave; maturit&eacute; avec plusieurs projets qui ont &agrave; chaque fois permis &agrave; l&rsquo;&eacute;quipe de faire de grandes avanc&eacute;es</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Le d&eacute;veloppement d&rsquo;un processus agile</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Le d&eacute;veloppement d&rsquo;une m&eacute;thodologie coh&eacute;rente permettant la cr&eacute;ation et la conception par &eacute;tapes claires ou chaque document trouve son utilit&eacute;</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Le d&eacute;veloppement des m&eacute;thodes de communication avec les partenaires permettant d&rsquo;&eacute;claircir les demandes et les conditions avant m&ecirc;me le d&eacute;but du travail</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Une expertise et un choix de technologies de pointe</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Une &eacute;quipe &agrave; la recherche des meilleures pratiques</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Une am&eacute;lioration continuelle</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Des m&eacute;thodes de gestion de projet</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Une &eacute;ducation des clients</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Des exp&eacute;riences diverses et compl&eacute;mentaires dans plusieurs domaines&nbsp;: Automobile, Ressources Humaines, Artistique, Publique, Pharmaceutique, Technologique, Communication et Marketing</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">De la Recherche et du D&eacute;veloppement</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Un r&eacute;seau de contacts professionnels</span></span></li>\r\n</ul>\r\n\r\n<p style="text-align:justify"><span style="color:#3399ff"><span style="font-size:16px"><span style="font-family:comic sans ms,cursive">N&#39;h&eacute;sitez pas &agrave; faire appel &agrave; nous pour vos futurs projets ou si vous avez tout simplement besoin de conseils !! Evocatio est votre solution, nous sommes l&agrave; pour vous </span></span>!</span></p>'),
(2, 1, 1, NULL),
(3, 2, 3, '<p style="margin-left:0px; margin-right:0px"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-size:14px"><strong><span style="color:rgb(51, 153, 255)"><span style="font-family:comic sans ms,cursive">St&eacute;phan Champagne</span></span></strong></span></span></p>\r\n\r\n<p style="margin-left:0px; margin-right:0px"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-size:14px"><strong><span style="font-family:comic sans ms,cursive">CEO - Programmeur S&eacute;nior : </span></strong></span></span></p>\r\n\r\n<p style="margin-left:0px; margin-right:0px; text-align:justify"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-family:comic sans ms,cursive">St&eacute;phan est ce qu&rsquo;il aime appeler un &laquo;Geek professionnel&raquo;. Ses forces sont l&rsquo;architecture logicielle, la mod&eacute;lisation de bases de donn&eacute;es, la programmation en PHP/C#, l&rsquo;administration et la migration de bases de donn&eacute;es Microsoft SQL Server 2005-2008 et MySQL, la virtualisation avec VMware et l&rsquo;entretien de plusieurs centaines de serveurs en entreprise autant en Microsoft qu&rsquo;en Linux. St&eacute;phan se sp&eacute;cialise finalement dans le d&eacute;veloppement d&rsquo;applications web sur mesure, dans l&rsquo;infrastructure &agrave; haute disponibilit&eacute;, dans la virtualisation et la manipulation des technologies de pointes.</span></span></p>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<p style="margin-left:0px; margin-right:0px"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><span style="color:rgb(51, 153, 255)"><strong>Laurent Breleur</strong></span></span></span></span></p>\r\n\r\n<p style="margin-left:0px; margin-right:0px"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Programmeur - Analyste</strong> :</span></span></span></p>\r\n\r\n<p style="margin-left:0px; margin-right:0px; text-align:justify"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-family:comic sans ms,cursive">Laurent est un programmeur aussi efficace que cr&eacute;atif. M&eacute;thodique, c&nbsp;&lsquo;est sa passion pour le d&eacute;veloppement d&rsquo;applications sur les plus r&eacute;centes plateformes qui fait de lui un programmeur polyvalent. Sa passion pour le partage des connaissances l&#39;am&egrave;ne &agrave; &ecirc;tre un membre tr&egrave;s actif au sein de l&#39;&eacute;quipe. Il n&#39;h&eacute;site pas &agrave; transmettre son savoir et est tr&egrave;s attentif aux autres. C&#39;est quelqu&#39;un de passionn&eacute; qui saura prendre plaisir &agrave; travailler sur vos solutions. </span></span><br />\r\n&nbsp;</p>\r\n\r\n<p style="margin-left:0px; margin-right:0px; text-align:justify"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-size:14px"><span style="color:rgb(51, 153, 255)"><strong><span style="font-family:comic sans ms,cursive">Leslie Bride</span></strong></span></span></span></p>\r\n\r\n<h3><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-size:14px"><strong><span style="font-family:comic sans ms,cursive">Charg&eacute;e de projets</span></strong></span></span></h3>\r\n\r\n<p style="margin-left:0px; margin-right:0px; text-align:justify"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-family:comic sans ms,cursive">Leslie analyse et assure le suivi des projets informatiques. Elle travaille en &eacute;troite collaboration avec l&rsquo;&eacute;quipe de d&eacute;veloppement. Comprendre les besoins et veiller &agrave; ce que le d&eacute;veloppement respecte la demande du client est sa priorit&eacute;. Sa rigueur et sa formation de programmeur font d&rsquo;elle une formidable gestionnaire puisqu&rsquo;elle conna&icirc;t la v&eacute;ritable nature du travail et des t&acirc;ches qu&rsquo;elle confie aux programmeurs. Passionn&eacute; dans l&#39;&acirc;me, elle prend son travail tr&egrave;s &agrave; coeur &nbsp;</span><span style="font-family:comic sans ms,cursive">et assurera le suivi de vos projets avec le plus grand des plaisirs. La satisfaction du client c&#39;est son mot d&#39;ordre !</span></span></p>\r\n\r\n<p style="margin-left:0px; margin-right:0px; text-align:justify">&nbsp;</p>\r\n\r\n<p style="margin-left:0px; margin-right:0px"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="color:rgb(51, 153, 255)"><strong><span style="font-family:comic sans ms,cursive">Suzanne Charlebois</span></strong></span></span></p>\r\n\r\n<p style="margin-left:0px; margin-right:0px"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><strong><span style="font-family:comic sans ms,cursive">Directrice administrative&nbsp;</span></strong></span></p>\r\n\r\n<p style="margin-left:0px; margin-right:0px; text-align:justify"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-family:comic sans ms,cursive">Suzanne est la directrice administrative d&rsquo;Evocatio, traitant de toutes les affaires juridiques et financi&egrave;res. Avec plus de 20 ann&eacute;es d&#39;exp&eacute;riences en gestion d&#39;entreprise, son atout le plus important est de comprendre et mettre en &oelig;uvre le protocole de flux de travail pour la gestion des ressources (Temps des ressources financi&egrave;res et des ressources humaines). Sa compr&eacute;hension approfondie des affaires dans son ensemble lui donne un aper&ccedil;u unique de l&#39;&eacute;quipe de d&eacute;veloppement permettant d&rsquo;assurer la r&eacute;ussite globale d&rsquo;Evocatio.</span></span><br />\r\n&nbsp;</p>\r\n\r\n<p style="margin-left:0px; margin-right:0px"><span style="color:rgb(0, 0, 0); font-family:times new roman; font-size:13px"><span style="font-family:comic sans ms,cursive"><span style="color:rgb(51, 153, 255)"><strong>Nesrine Turki </strong></span>(il faut faire sa partie)</span></span></p>'),
(4, 1, 3, NULL),
(5, 2, 4, NULL),
(6, 1, 4, NULL),
(7, 2, 5, '<p>&nbsp;</p>\r\n\r\n<h1><span style="color:#3399ff"><span style="font-family:comic sans ms,cursive"><span style="font-size:20px"><strong>Evocatio fait des affaires, et du code</strong></span></span></span></h1>\r\n\r\n<p>Evocatio ne fait pas de graphisme, nous reproduisont fid&egrave;lement le travail des graphistes en code HTML,</p>\r\n\r\n<p>Evocatio ne fait pas de contenu, nous cr&eacute;ons des outils de communication&nbsp;et de publication,</p>\r\n\r\n<p>Evocatio ne fait pas votre image, nous lui donnons une vie,</p>\r\n\r\n<p>Evocatio ne fait pas la gestion de votre entreprise, nous automatisons vos processus,</p>\r\n\r\n<p>Evocatio ne fait pas des sites webs, nous faisons des applications,</p>\r\n\r\n<p>Evocatio ne fait pas que de l&#39;information, nous g&eacute;rons des communications,</p>\r\n\r\n<p>Evocatio ne fait pas des formulaires, nous cr&eacute;ons des interfaces,&nbsp;</p>\r\n\r\n<p>Evocatio fait du PHP, MySQL, Symfony, Doctrine, HTML5, CSS3, Javascript,</p>\r\n\r\n<p>Evocatio comprend les affaires, le retour sur investissement, la visibilit&eacute;,</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive"><span style="font-size:14px">Voici une liste de nos sp&eacute;cialit&eacute;s : </span></span></p>\r\n\r\n<ul>\r\n	<li><span style="font-family:comic sans ms,cursive"><span style="color:#FFA500">Analyse </span></span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Conception</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive"><span style="color:#FFA500">R&eacute;alisation</span></span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Programmation PHP</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive"><span style="color:#FFA500">Int&eacute;gration web</span></span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">H&eacute;bergement / Configuration DNS</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive"><span style="color:#FFA500">D&eacute;ploiement</span></span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Optimisation de site web</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive"><span style="color:#FFA500">R&eacute;seaux-Sociaux&nbsp;</span></span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Syst&egrave;me de Gestion de contenu</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive"><span style="color:#FFA500">M&eacute;thodes agiles</span></span></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive"><span style="font-size:14px">Nos outils : </span></span></p>\r\n\r\n<ul>\r\n	<li><span style="font-family:comic sans ms,cursive">Symfony / Symfony 2</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive"><span style="color:#FFA500">HTML5 / JavaScript / JQuery / CSS3 / Ajax</span></span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Vmware ESX, Asterix </span></li>\r\n</ul>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Et bien d&#39;autres choses...</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Venez nous consulter, nous nous ferons un plaisir de r&eacute;pondre &agrave; vos besoins </span><img alt="smiley" src="http://demochampagne.evocatio.com/js/ckeditor/plugins/smiley/images/regular_smile.gif" style="height:20px; width:20px" title="smiley" /></p>'),
(8, 1, 5, NULL),
(9, 2, 6, NULL),
(10, 1, 6, NULL),
(11, 2, 7, '<div class="wiki-content">\r\n<p style="text-align: justify;"><span style="font-family:comic sans ms,cursive"><span style="font-size:14px"><strong>Evocatio a su d&eacute;velopper son propre processus de r&eacute;alisation pour permettre au client un meilleur suivi du projet d&egrave;s le d&eacute;part. </strong></span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-family:comic sans ms,cursive">Un projet de toute taille doit &ecirc;tre correctement structur&eacute; afin de respecter le budget et le temps. Chez Evocatio nous commen&ccedil;ons chaque projet avec la fin &agrave; l&#39;esprit. Pour cela, nous devons cr&eacute;er correctement et minutieusement la liste compl&egrave;te des exigences. Notre flux de travail est centr&eacute; sur l&#39;analyse des objectifs pour cr&eacute;er ensuite une liste d&#39;exigences. Ceux-ci sont ensuite prioris&eacute;s et la demande de proposition ne permet qu&#39;une &eacute;valuation grossi&egrave;re de la charge de travail. Notre offre va donc &ecirc;tre pr&eacute;cise avec une marge de 80% (ce qui signifie que le co&ucirc;t pourrait atteindre jusqu&#39;&agrave; 80% de l&#39;offre actuelle). Ensuite, si nous avons l&rsquo;accord du client, nous allons en collaboration avec le propri&eacute;taire du projet, &eacute;labor&eacute; une solution plus d&eacute;taill&eacute;e, qui comprendra une liste de fonctions, une liste de r&ocirc;les, et sera suivie d&#39;un examen des co&ucirc;ts avec une marge de 50 % (Le but est d&#39;aligner les efforts de l&#39;entreprise et du client pour r&eacute;duire rapidement l&#39;&eacute;cart entre le budget et le besoin pour &eacute;viter de s&#39;embarquer dans un projet qui ne finira pas ou d&eacute;passera les d&eacute;lais ou le budget).</span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-family:comic sans ms,cursive">Le projet peut alors &ecirc;tre abandonn&eacute; rapidement en limitant les pertes ou r&eacute;ajuster pour rencontrer les contraintes prioris&eacute;es. Nous cr&eacute;ons alors une s&eacute;rie de livrable dont un plan de la navigation, une liste des types d&#39;utilisateurs et des fonctionnalit&eacute;s accessibles selon les utilisateurs, une liste des contenus classifi&eacute;s, des maquettes en fils de fers et un document &eacute;tablissant les normes. (Selon l&#39;ampleur du projet des livrables peuvent &ecirc;tre ajout&eacute;s ou retir&eacute;s pour s&#39;ajuster au budget, mais la liste pr&eacute;c&eacute;dente est le coffre d&#39;outils que nous consid&eacute;rons comme la base pour le succ&egrave;s d&#39;un projet quel qu&#39;il soit). &Agrave; cette &eacute;tape l&#39;estim&eacute; est pr&eacute;cis&eacute; pour attendre une variation maximum de 25%.</span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-family:comic sans ms,cursive">Vient ensuite la R&eacute;alisation, une liste des fonctionnalit&eacute;s est prioris&eacute;e, et les travaux commencent. Des livrables sont &eacute;tablies pour chaque p&eacute;riode de deux semaines et le suivi est fait avec le client tout au long du processus. Un plan de test est mis en place pour tester les fonctions les plus importantes du projet. Des tests sont effectu&eacute;s par les programmeurs tout au long du processus, mais le plan de test est soumis au client qui doit effectuer ses propres tests pour les fins d&#39;acceptations sur un environnement de test mis en place par Evocatio.&nbsp;</span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-family:comic sans ms,cursive">Les tests de l&#39;entreprise permettent de r&eacute;duire le co&ucirc;t &nbsp;et de s&#39;assurer aussi que l&#39;interface est ad&eacute;quate pour l&#39;utilisateur. &Agrave; ce moment des demandes de corrections sont possibles. Toutes demandes de modifications qui ne font pas partis des demandes originales seront &eacute;valu&eacute;es pour l&#39;ampleur et si b&eacute;nigne pourront &ecirc;tre ajout&eacute;es sans faire l&#39;objet d&#39;un nouvel estim&eacute; (les heures seront cumul&eacute;es dans le 25% de variation). Il est plut&ocirc;t courant d&#39;utiliser au moins 10% de cette variation. Cependant, si les demandes sont jug&eacute;es majeures, elles devront faire l&#39;objet d&#39;un budget s&eacute;par&eacute;, d&#39;une analyse, d&rsquo;une estimation et d&#39;une acceptation du client. Une telle demande pourrait faire varier les dates de livraisons, sans toutefois faire changer le calendrier de facturation, et seront facturables imm&eacute;diatement.</span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-family:comic sans ms,cursive">Lors de la livraison, (l&#39;acceptation sign&eacute;e par le client) il est possible de faire des corrections de bugs pour une p&eacute;riode de 30 jours (ou 35 heures au total, le premier &eacute;chu). Cette garantie est plut&ocirc;t standard dans l&#39;industrie.</span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-family:comic sans ms,cursive">Voici donc un r&eacute;sum&eacute; de notre m&eacute;thode de travail pour un projet r&eacute;gulier. Il est &agrave; noter qu&#39;il y a des &eacute;tapes suppl&eacute;mentaires pour des projets d&#39;envergure (l&#39;&eacute;laboration de persona pour test de simulation d&#39;un utilisateur web, analyse plus approfondis des besoins SEO, plan de marketing, etc.). Mais nous croyons que c&#39;est l&agrave; le minimum pour assurer le succ&egrave;s de votre projet.</span></p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n</div>'),
(12, 1, 7, NULL),
(13, 2, 8, '<p><span style="font-family:comic sans ms,cursive"><span style="color:rgb(0, 51, 102)"><u><strong>FORMULAIRE DE SOUMISSION :&nbsp;</strong> </u></span></span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive"><span style="color:rgb(0, 51, 102)">Veuillez remplir ce formulaire de soumission s&#39;il vous pla&icirc;t si vous &ecirc;tes int&eacute;ress&eacute;s par nos services. Il nous permettra de conna&icirc;tre vos besoins mais aussi votre connaissance sur les projets IT dans leur globalit&eacute;. Nous vous contacterons le plut&ocirc;t possible. </span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Nom :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Pr&eacute;nom :</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Fonction :</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Courriel :</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Adresse :</span></p>\r\n\r\n<p>Pays :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Province :</p>\r\n\r\n<p>T&eacute;l&eacute;phone :</p>\r\n\r\n<p>Nom de l&#39;entreprise :</p>\r\n\r\n<p>Br&egrave;ve description de l&#39;activit&eacute; de l&#39;entreprise :</p>\r\n\r\n<p>Nombre d&#39;employ&eacute;s :</p>\r\n\r\n<ul>\r\n	<li>- de 10</li>\r\n	<li>10 - 19</li>\r\n	<li>20 - 49</li>\r\n	<li>50 - 99</li>\r\n	<li>100 - 200</li>\r\n	<li>+ de 200</li>\r\n</ul>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Adresse internet du site de l&#39;entreprise (s&#39;il y en a une) : </span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quelles sont vos responsabilit&eacute;s au sein de l&#39;entreprise ?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quels sont vos connaissances des projets IT ?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Avez-vous une connaissance du march&eacute; ?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Avez-vous d&eacute;j&agrave; travaill&eacute; sur des projets IT ?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Connaissez-vous les diff&eacute;rentes phases reli&eacute;es &agrave; un projet ? (planification strat&eacute;gique, phase de conception...)</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quels sont vos besoins ?</span></p>\r\n\r\n<ul>\r\n	<li><span style="font-family:comic sans ms,cursive">nouveau site </span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">refonte de site actuel</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">syst&egrave;me de gestion de contenu</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">e-commerce</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">design web</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">syst&egrave;me de gestion de conf&eacute;rence </span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">syst&egrave;me de gestion d&#39;infolettre </span></li>\r\n</ul>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quelles sont vos attentes ?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quelles sont vos lignes de produits et quelle est leur importance relative?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quelle est la position de l&#39;entreprise dans le march&eacute;?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quel est l&#39;ordre de grandeur pour votre budget ?&nbsp;&nbsp;&nbsp;</span></p>\r\n\r\n<ul>\r\n	<li><span style="font-family:comic sans ms,cursive">5000$ - 10 000 $&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">10 000 - 25 000 $</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">25 000$ - 100 000$</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">100 000$ - 250 000$</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">250 000$ - 500 000$</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">vous ne savez pas quel budget allou&eacute; &agrave; votre projet, indiquez-nous ce que souhaitez investir, nous vous indiquerons si ce que vous pouvez investir correspond &agrave; la solution que vous souhaitez avoir.</span><br />\r\n	&nbsp;</li>\r\n</ul>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Avez-vous une connaissance des m&eacute;thodes agiles ?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quelle langue pr&eacute;f&eacute;rez-vous pour le suivi de vos projets ?</span></p>\r\n\r\n<ul>\r\n	<li><span style="font-family:comic sans ms,cursive">Anglais </span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Fran&ccedil;ais&nbsp;</span></li>\r\n</ul>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quels services souhaiteriez-vous :</span></p>\r\n\r\n<ul>\r\n	<li><span style="font-family:comic sans ms,cursive">Analyse</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Conception</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">H&eacute;bergement</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Animation web</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Int&eacute;gration</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Programmation&nbsp;</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Design </span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Conseils</span></li>\r\n</ul>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">&Ecirc;tes-vous familier avec les langages et frameworks suivants : </span></p>\r\n\r\n<ul>\r\n	<li><span style="font-family:comic sans ms,cursive">PHP5</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">HTML5</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">CSS3</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Symfony 1 et 2</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">AJAX</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">JQUERY</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">JAVASCRIPT</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Aucun</span></li>\r\n</ul>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Qu&#39;attendez-vous comme r&eacute;sultats en implantant notre solution?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Dans combien de mois ou d&#39;ann&eacute;es croyez-vous obtenir ces r&eacute;sultats?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">De quelle fa&ccedil;on allez-vous les mesurer?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quels probl&egrave;mes d&eacute;sirez-vous r&eacute;soudre?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Quand d&eacute;sirez-vous aller de l&#39;avant avec ce projet ? Indiquez-nous vos p&eacute;riodes de livraison souhait&eacute;es&nbsp; : </span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">S&#39;il&nbsp; y a lieu joingnez &agrave; votre demande un document : </span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">A part vous, qui est impliqu&eacute; dans cette demande ?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Si vous n&#39;allez pas de l&#39;avant avec cette solution, quelles en seront les cons&eacute;quences?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">&nbsp;Quels sont vos trois principaux crit&egrave;res de s&eacute;lection?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Qu&#39;est-ce qui est le plus important pour vous dans le choix d&#39;un prestataire ?</span></p>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Comment vous avez nous trouv&eacute; ? </span></p>\r\n\r\n<ul>\r\n	<li><span style="font-family:comic sans ms,cursive">recherche google</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">r&eacute;f&eacute;rence d&#39;un ami</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">twitter</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">facebook</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">linkdin</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">publicit&eacute;</span></li>\r\n	<li><span style="font-family:comic sans ms,cursive">Autres : </span></li>\r\n</ul>\r\n\r\n<p><span style="font-family:comic sans ms,cursive">Souhaitez-vous prendre un RDV avec nous pour une rencontre plus en profondeur sur votre demande ? Indiquez-nous vos disponibilit&eacute;s :</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(14, 1, 8, NULL),
(15, 2, 9, '<div class="vcard">\r\n<h3>&nbsp;</h3>\r\n\r\n<h3><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Adresse <a class="external-link" href="http://evocatio.com/evocatio.vcf" rel="nofollow" title="Carte format V.C.F."><img class="confluence-embedded-image confluence-external-resource" src="http://evocatio.com/images/carte.gif" /></a></span></span></h3>\r\n\r\n<div class="fn org"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Evocatio Solutions technologiques</span></span></div>\r\n\r\n<div class="adr">\r\n<div class="street-address"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">388, rue Saint-Jacques, 3<sup>e</sup> &eacute;tage - Quartier International</span></span></div>\r\n<span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Montr&eacute;al, Qu&eacute;bec, H2Y 1S1 Canada</span></span></div>\r\n\r\n<div class="tel" title="téléphone"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">T&eacute;l&eacute;phone : (514) 667-0559</span></span></div>\r\n\r\n<div class="tel fax" title="télécopieur"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">T&eacute;l&eacute;copieur : (514) 667-0569</span></span></div>\r\n</div>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Pour toutes informations veuillez envoyer un mail &agrave; l&#39;adresse suivante : support@evocatio.com</span></span></p>'),
(16, 1, 9, NULL),
(17, 2, 10, '<div class="entry-content">\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Si vous &ecirc;tes une agence de publicit&eacute; et que vous devez cr&eacute;ez des supports informatiques pour g&eacute;rer les communications de vos clients, voici 12 questions que vous devriez vous posez avant d engager un fournisseur de services informatiques et de remettre les dossiers sensibles de vos clients entre ses mains.</strong></span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>1- Est-ce que le fournisseur de services informatiques avec qui vous envisagez de travailler poss&egrave;de suffisamment d&rsquo;exp&eacute;rience avec des clients aussi prestigieux que les v&ocirc;tres ?</strong><br />\r\nCe n&rsquo;est pas parce qu&rsquo;ils peuvent construire un site web que cela signifie qu&rsquo;ils peuvent se charger des demandes complexes de vos clients qui n&eacute;cessitent souvent une large exp&eacute;rience et une haute compr&eacute;hension lorsqu&rsquo;il s&rsquo;agit de bases de donn&eacute;es et d applications Web.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>2- Est-ce que le fournisseur de services informatiques avec qui vous envisagez de travailler est capable de prendre les mesures n&eacute;cessaires avec son personnel pour vous garantir la non-divulgation de vos secrets professionnels?</strong> Est-il pr&ecirc;t &agrave; vous fournir en toute transparence les CVs des membres de son &eacute;quipe?<br />\r\nDes informations qui se trouvent entre de mauvaises mains n&rsquo;est jamais une bonne chose. Surtout si cela peut nuire &agrave; votre r&eacute;putation.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>3- Est-ce que le fournisseur de services informatiques avec qui vous envisagez de travailler est pr&ecirc;t &agrave; vous signer un accord de non-concurrence et de non-divulgation?</strong><br />\r\nComment pouvez-vous &ecirc;tre s&ucirc;r que vos secrets professionnels ne se vendront pas &agrave; vos concurrents?</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>4- Est-ce que le fournisseur de services informatiques avec qui vous envisagez de travailler poss&egrave;de une grosse &eacute;quipe de juniors ou plut&ocirc;t une petite &eacute;quipe exp&eacute;riment&eacute;e et hautement qualifi&eacute;e?</strong><br />\r\nUne petite &eacute;quipe de seniors est plus facile &agrave; g&eacute;rer, offre une meilleure efficacit&eacute;, cr&eacute;e du code plus propre et &eacute;volutif et vous apporte par la suite une plus grande valeur ajout&eacute;e.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>5- Avez-vous id&eacute;e de qui le fournisseur de services informatiques avec qui vous envisagez de travailler chercherait-il &agrave; satisfaire en premier? Le client? Mauvaise r&eacute;ponse&nbsp;!</strong><br />\r\nA cette question, il devrait y avoir une seule bonne r&eacute;ponse &hellip; L&rsquo;utilisateur final. Si l&rsquo;exp&eacute;rience utilisateur n&rsquo;est pas bonne personne ne gagne. Une &eacute;quipe qui est consciente de ce fait, ne chercherait pas &agrave; tout faire pour d&eacute;crocher le contrat mais plut&ocirc;t &agrave; s&rsquo;assurer qu&rsquo;elle sera capable de bien faire son travail.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>6- Est-ce que le fournisseur de services informatiques avec qui vous envisagez de travailler s&rsquo;engagera &agrave; vous fournir des rapports d&rsquo;avancement d&eacute;taill&eacute;s qui respectent les objectifs de chaque &eacute;tape du projet ?</strong><br />\r\nDes rapports d&rsquo;avancement r&eacute;guliers vous permettront de fournir des informations pertinentes et &agrave; jour &agrave; vos clients mais aussi d&rsquo;apporter des modifications au plan initial en cours de projet ce qui vous &eacute;pargnerait des changement co&ucirc;teux dans des phases ult&eacute;rieures.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>7- Quelle est la politique du fournisseur de services informatiques avec qui vous envisagez de travailler quant &agrave; l&rsquo;assurance qualit&eacute; apr&egrave;s la livraison?</strong><br />\r\nLa probl&eacute;matique majeure la est que la plupart des entreprises vous feront payer les heures de d&eacute;bogage apr&egrave;s la livraison, afin de compenser les pertes engendr&eacute;es par leur mauvaise gestion du projet.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>8- Est-ce que le fournisseur de services informatiques avec qui vous envisagez de travailler est pr&ecirc;t &agrave; travailler avec un gestionnaire de projet ind&eacute;pendant.</strong>?<br />\r\nPour les tr&egrave;s grands projets, les clients embauchent souvent leur propre chef de projet pour prot&eacute;ger leurs investissements. Une initiative intelligente de leur part, en particulier pour les projets &agrave; long terme qui pourraient prendre plusieurs mois, voire des ann&eacute;es.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>9- Est-ce que le fournisseur de services informatiques avec qui vous envisagez de travailler est capable de vous offrir des applications de e-commerce qui r&eacute;pondent aux derni&egrave;res normes internationales et ob&eacute;issent aux standards?</strong><br />\r\nLes clients internationaux travaillent g&eacute;n&eacute;ralement sur plusieurs projets en m&ecirc;me temps impliquant une multitude de parties prenantes &agrave; travers le monde tout en ayant pour objectif que les outils d&eacute;velopp&eacute;s communiquent entre eux. Alors la question est est-ce votre fournisseur en TI est en mesure de relever ce d&eacute;fi?</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>10- Est-ce que le fournisseur de services informatiques avec qui vous envisagez de travailler offre des services de l&rsquo;informatique dans les nuages (cloud computing) et de maintenance des serveurs?</strong><br />\r\n&Ecirc;tes vous certain que vos informations sont en s&eacute;curit&eacute; en cas de d&eacute;faillance des serveurs?<br />\r\nEst-ce que votre entreprise IT est capable de g&eacute;rer l&rsquo;h&eacute;bergement et la sauvegarde s&eacute;curis&eacute;e de vos donn&eacute;es?</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>11- Est-ce que le fournisseur de services informatiques avec qui vous envisagez de travailler est capable de vous offrir des services personnalis&eacute;s qui s&rsquo;adaptent &agrave; vos besoins?</strong><br />\r\nEst ce votre fournisseur de services informatiques poss&egrave;de un plan de tarification clair et qui tient compte de la durabilit&eacute; de votre collaboration et du temps de r&eacute;ponse que vous exigez?<br />\r\n&Ecirc;tes vous certain que vous n&rsquo;aurez pas de mauvaises surprises ou de cadeaux empoisonn&eacute;s lors de la r&eacute;ception de votre facture?</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>12- Est-ce que le fournisseur de services informatiques avec qui vous envisagez de travailler apporte de la valeur ajout&eacute;e &agrave; votre entreprise?</strong><br />\r\nIl est toujours int&eacute;ressant d&rsquo;offrir des tarifs pr&eacute;f&eacute;rentiels pour les services de support tels que l&rsquo;h&eacute;bergement aux clients privil&eacute;gi&eacute;s que vous referez.</span></span></p>\r\n</div>'),
(18, 1, 10, NULL),
(19, 2, 11, '<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive"><strong>E</strong><strong>V</strong><strong>OCATIO</strong> a d&eacute;j&agrave; cr&eacute;&eacute; une librairie avec beaucoup de fonctionnalit&eacute;s qui va r&eacute;pondre &agrave; vos besoins. Notre librairie est totalement personnalisable et repose sur un cadre open-source. L&#39;avantage est en deux phases&nbsp;:</span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">La premi&egrave;re &eacute;tant le temps, parce que nous ne partons pas de z&eacute;ro, nous pouvons avoir votre site pr&ecirc;t plus vite que beaucoup de nos concurrents.</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Le deuxi&egrave;me avantage est moins &eacute;vident, mais se r&eacute;v&eacute;lera au fil du temps. Certaines fonctionnalit&eacute;s seront disponibles pour vous sur votre vite, m&ecirc;me parfois sans que vous ayez conscience de la n&eacute;cessit&eacute; de les avoir.</span></span></li>\r\n</ul>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aussi, &eacute;tant open-source signifie qu&#39;il n&#39;y a pas de frais de licences annuels. Mais &eacute;tant open-source ne veut pas dire qu&#39;il est bon pour votre projet. Par exemple, un grand nombre de fournisseurs de services, offre des services bas&eacute;s sur des produits tels que WordPress, Joomla ou Drupal.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ces produits sont des CMS, ce qui signifie qu&#39;ils sont construits pour permettre &agrave; quelqu&#39;un sans connaissance en d&eacute;veloppement d&#39;ajouter du contenu &agrave; votre site. Ces CMS sont bons pour un certain moment et &eacute;conomiseur d&#39;argent, surtout lorsque vous n&#39;avez pas besoin de passer par le processus d&#39;apprendre &agrave; cr&eacute;er des contenus Web, ou demandez &agrave; quelqu&#39;un de le faire pour vous.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; D&#39;autre part quand il s&#39;agit de fonctions personnalis&eacute;es, vous devez compter sur les plugins et la fa&ccedil;on dont ils font les choses, ou vous devez les faire fabriquer sur mesure par les programmeurs tout comme d&#39;autres produits.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; L&rsquo;avantage de Symfony est qu&#39;au lieu d&#39;&ecirc;tre un CMS, c&#39;est un cadre de d&eacute;veloppement qui permet une plus grande polyvalence, car il est le code que vous utilisez pour le CMS (par exemple Drupal 8 et les autres CMS diff&eacute;rents de Symfony 2 utilisent des composants). Voir <a href="http://symfony.com/blog/symfony2-meets-drupal-8">http://symfony.com/blog/symfony2-meets-drupal-8</a>. </span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">En attendant, vous obtenez toujours les avantages d&#39;une communaut&eacute; open-source solide.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">EVOCATIO vous offre donc une touche d&rsquo;innovation pour votre business</span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Modules de paiement en ligne s&eacute;curis&eacute;s</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Outils d&rsquo;e-mailing de masse s&eacute;curis&eacute;s</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Paniers d&rsquo;achats international</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Un&nbsp; Gestionnaire d&rsquo;&eacute;v&eacute;nements</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Une conversion simple de page web</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Des bases de donn&eacute;es interactives en ligne</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Des graphiques et des pages dynamiques</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Du E-Commerce</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Des recherches internes</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Un site personnalis&eacute;</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Un syst&egrave;me de services Web</span></span></li>\r\n</ul>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">+++</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Imaginez les possibilit&eacute;s !</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">EVOCATIO s&#39;engage &agrave; un service personnalis&eacute;, utilisant les derni&egrave;res technologies avec un seul objectif &agrave; l&#39;esprit, Garantir la meilleure exp&eacute;rience utilisateur possible pour vous et vos clients !</span></span></p>\r\n\r\n<p style="text-align:justify">&nbsp;</p>'),
(20, 1, 11, NULL);
INSERT INTO `HtmlContentTranslation` (`id`, `trans_lang_id`, `content_id`, `content`) VALUES
(21, 2, 12, '<div>\r\n<h5><span style="font-size:12px"><span style="font-family:comic sans ms,cursive"><a href="https://tools.evocatio.com/confluence/display/SWE/Traduction" style="text-decoration: none;">Traduction</a></span></span></h5>\r\n</div>\r\n\r\n<div class="page view">\r\n<div class="wiki-content">\r\n<p><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">L&#39;&eacute;volution socio-&eacute;conomique repousse de plus en plus nos fronti&egrave;res ce qui a pour effet de faire tomber les barri&egrave;res de la langue. La librairie int&egrave;gre un solide syst&egrave;me d&#39;internationalisation&nbsp;qui permettra de tr&egrave;s facilement traduire un site web ou une application dans nimporte quel langue.</span></span></p>\r\n\r\n<p><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Cette internationalisation en se limite pas &agrave; la langue puisqu&#39;elle concerne aussi les formats de dates, les devises etc...&nbsp;</span></span></p>\r\n\r\n<div class="page view">\r\n<div class="wiki-content">\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:12px"><span style="font-family:comic sans ms,cursive"><a href="https://tools.evocatio.com/confluence/pages/viewpage.action?pageId=8913237" style="text-decoration: none;">Boutique en ligne (POS)</a> :</span></span></p>\r\n</div>\r\n</div>\r\n\r\n<div>\r\n<p><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">A l&#39;apog&eacute;e d&#39;internet, l&#39;e-commerce a pris une place tr&egrave;s importante. Vous d&eacute;sirez faire de l&#39;&eacute;change de biens et de services ? Avec la librairie d&#39;Evocatio c&#39;est simple : monter une boutique en ligne en quelques clics avec votre propre catalogue de produit.</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n\r\n<div class="page view">\r\n<div class="wiki-content">\r\n<p><a href="https://tools.evocatio.com/confluence/display/SWE/CMS" style="text-decoration: none;">CMS</a></p>\r\n\r\n<div class="page view">\r\n<div class="wiki-content">\r\n<p><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Vous n&#39;en pouvez plus des choses statiques : nous mettons &agrave; votre disposition un CMS puissant vous permettant de g&eacute;rer tous vos contenus audios, vid&eacute;os, textes...</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div class="page view">\r\n<div class="wiki-content">\r\n<div>\r\n<h5><span style="font-size:12px"><span style="font-family:comic sans ms,cursive"><strong>Internationalisation :</strong></span></span></h5>\r\n\r\n<p><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">Ayez sur votre site un panier capable de g&eacute;rer les devises du monde. Ne vous pr&eacute;occupez plus de la position du $.</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:12px"><span style="font-family:comic sans ms,cursive"><strong>R&eacute;seaux sociaux :</strong></span></span></p>\r\n\r\n<p><span style="font-size:12px"><span style="font-family:comic sans ms,cursive">A l&#39;heure de Twitter et Facebook, nous vous devions de vous proposez un moyen de partager vos actualit&eacute;s, vos blogs et tout ce qui vous plaira avec une grande facilit&eacute;.</span></span></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>'),
(22, 1, 12, NULL),
(23, 2, 13, '<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Evocatio s&#39;engage &agrave; : </span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border="1" cellpadding="1" cellspacing="1" style="height:359px; width:776px">\r\n	<tbody>\r\n		<tr>\r\n			<td><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">D&eacute;finir votre projet&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></td>\r\n			<td style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Nous examinerons ensemble l&rsquo;exp&eacute;rience utilisateur que vous d&eacute;sirez, nous identifierons les probl&egrave;mes potentiels, et nous discuterons avec vous de chaque aspect de votre projet en vue de formuler un plan d&rsquo;action d&eacute;taill&eacute; avec une liste de t&acirc;ches class&eacute;e par priorit&eacute;.</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Proposition&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; personnalis&eacute;e et Demande de prix</span></span></td>\r\n			<td style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Nous vous formulons une proposition personnalis&eacute;e du projet avec tous les d&eacute;tails. Une liste d&rsquo;identification de t&acirc;ches personnalis&eacute;es, un calendrier de travail pr&eacute;cis, une r&eacute;union pr&eacute;liminaire pour discuter des progr&egrave;s et des prix d&eacute;taill&eacute;es et le calendrier de paiement seront tous inclus dans votre devis.</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">La promesse d&rsquo;Evocatio pour vous</span></span></td>\r\n			<td style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Vous ne serez jamais charg&eacute; pour le travail que vous n&rsquo;avez pas autoris&eacute;.</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Gestion de projet</span></span></td>\r\n			<td style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Vous aurez un feed-back r&eacute;gulier et pr&eacute;cis quant &agrave; l&rsquo;avancement de votre projet dans le respect des objectifs de l&rsquo;&eacute;ch&eacute;ance.</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Votre approbation</span></span></td>\r\n			<td style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Votre approbation tout au long du projet est importante pour nous, ainsi &agrave; chaque &eacute;tape nous nous assurons que vous suivez et approuver le travail qui a &eacute;t&eacute; fait avant de cl&ocirc;turer et de passer &agrave; l&rsquo;&eacute;tape suivante.</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">D&eacute;ploiement</span></span></td>\r\n			<td style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Soyez en ligne &agrave; temps ! Vous verrez votre site d&eacute;ploy&eacute; &agrave; la date que nous avons fix&eacute; au d&eacute;but des travaux.</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Assurance Qualit&eacute;</span></span></td>\r\n			<td style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Vous disposez de 30 jours/35 heures (premier &eacute;chu) apr&egrave;s le d&eacute;ploiement pour identifier les &eacute;ventuels bugs. Par la suite les corrections seront apport&eacute;es sans frais suppl&eacute;mentaires, &agrave; condition que cela ait &eacute;t&eacute; pr&eacute;cis&eacute; dans l&#39;accord initial.</span></span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>'),
(24, 1, 13, NULL),
(25, 2, 14, '<div class="wiki-content">\r\n<p><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/9535569/html%205.png?version=1&amp;modificationDate=1369166325000" style="width:100px" /><strong>Quelques bonnes raisons d&rsquo;adopter l&#39;HTML5 pour un d&eacute;veloppeur:</strong></span></span></p>\r\n\r\n<ol>\r\n	<li><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Le doctype est des plus simple &agrave; d&eacute;clarer</span></span></li>\r\n	<li><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">L&rsquo;encodage est aussi simple</span></span></li>\r\n	<li><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">M&ecirc;me avec internet explorer cela marche</span></span></li>\r\n	<li><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">La structure de la page est plus simple</span></span></li>\r\n	<li><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Vous pouvez ajouter l&rsquo;attribut &laquo;&nbsp;r&ocirc;le&nbsp;&raquo; &agrave; ces nouvelles balises afin de renforcer la s&eacute;mantique de votre document</span></span></li>\r\n	<li><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Il permet l&rsquo;ajout de m&eacute;dias comme l&rsquo;audio et la vid&eacute;o sans passer par un plugin</span></span></li>\r\n	<li><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Il permet de cr&eacute;er des formulaires plus &eacute;l&eacute;gants</span></span></li>\r\n	<li><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Il y a l&#39;apparition de nouvelles balises</span></span></li>\r\n	<li><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Aucune raison de ne pas l&rsquo;adopter &hellip;il est temps de passer &agrave; l&rsquo;HTML5 <img alt="(sourire)" class="emoticon emoticon-smile" src="https://tools.evocatio.com/confluence/s/fr_FR/3393/fbf97d65fc2202c1ad8db08fef99ff488e0d596b.3/_/images/icons/emoticons/smile.png" /></span></span></li>\r\n</ol>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Voici un lien &agrave; visiter : <a class="external-link" href="http://www.alsacreations.com/article/lire/750-HTML5-nouveautes.html" rel="nofollow">http://www.alsacreations.com/article/lire/750-HTML5-nouveautes.html</a></span></span></p>\r\n</div>'),
(26, 1, 14, NULL),
(27, 2, 15, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913126/Mondialisation-300x300.png?version=1&amp;modificationDate=1365800643000" style="width:100px" title="Site Web Evocatio &gt; L''internationalisation &gt; Mondialisation-300x300.png" />Pour toucher un large public sur un site web, on pense rapidement &agrave; faire une version du site dans d&rsquo;autres langues mais aussi &agrave; utiliser d&rsquo;autres devises, mais si une simple &laquo;&nbsp;traduction&nbsp;&raquo; du site peut suffire si les besoins sont limit&eacute;s, nous pouvons aller beaucoup plus loin. Nous parlons alors d&rsquo;internationalisation ou i18n. Pour simplifier c&rsquo;est une op&eacute;ration qui rend possible l&#39;adaptation de votre site &agrave; l&#39;international, sans tout devoir d&eacute;velopper de nouveau parce que certaines cultures lisent de droite &agrave; gauche, donnent une valeur diff&eacute;rente &agrave; la couleur rouge ou n&#39;&eacute;crivent pas les dates comme nous. Cela consiste &agrave; structurer un site Web de fa&ccedil;on &agrave; ce qu&rsquo;il puisse &ecirc;tre adapt&eacute; &agrave; plusieurs cultures, langages, ou localit&eacute;s. On utilise aussi l&rsquo;acronyme, i18n pour d&eacute;signer l&rsquo;internationalisation, o&ugrave; le 18 est le nombre de lettres entre le premier I et le N final dans internationalisation. En g&eacute;n&eacute;ral, l&rsquo;internationalisation se r&eacute;alise &agrave; l&rsquo;aide d&rsquo;un site Web dynamique g&eacute;n&eacute;r&eacute; par une base de donn&eacute;es.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Si vous souhaitez exporter votre site web, l&#39;&eacute;tape qui suit l&#39;internationalisation est la localisation, et il y en aura autant qu&#39;il y a de langues et pays cibles. La traduction des contenus de votre site web ne repr&eacute;sente qu&#39;une partie du processus de localisation. Celle-ci implique plus qu&rsquo;une simple traduction. Elle prend &eacute;galement en compte, de mani&egrave;re non exhaustive, les points suivants&nbsp;: </span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">les formats des dates et des heures</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">les monnaies</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">l&rsquo;utilisation du clavier</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">l&rsquo;interpr&eacute;tation culturelle des symboles, des ic&ocirc;nes et des couleurs</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">le contenu qui peut &ecirc;tre sujet &agrave; une interpr&eacute;tation erron&eacute;e ou vu comme peu compr&eacute;hensif</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">les diff&eacute;rentes conditions l&eacute;gales.</span></span></li>\r\n</ul>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">L&#39;internationalisation est donc un &eacute;l&eacute;ment crucial &agrave; prendre en compte d&egrave;s la cr&eacute;ation de votre site, pour qu&#39;&agrave; terme un d&eacute;ploiement &agrave; l&#39;international n&#39;implique pas une refonte compl&egrave;te, et donc des co&ucirc;ts prohibitifs.&nbsp;&nbsp;</span></span></p>'),
(28, 1, 15, NULL),
(29, 2, 16, '<p><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">La gouvernance des technologies de l&rsquo;information (TI) est la structure de relations et de processus visant &agrave; diriger et contr&ocirc;ler l&rsquo;entreprise pour qu&rsquo;elle atteigne ses objectifs en g&eacute;n&eacute;rant de la valeur, tout en trouvant le bon &eacute;quilibre entre les risques et les avantages des TI et de leurs processus. En r&egrave;gle g&eacute;n&eacute;rale, bien gouverner c&rsquo;est tout simplement pr&eacute;voir.</span></span></p>'),
(30, 1, 16, NULL),
(31, 2, 17, NULL),
(32, 1, 17, NULL),
(33, 2, 18, '<p style="text-align:justify">&nbsp;</p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913124/nuage-web20.png?version=1&amp;modificationDate=1365710037000" style="width:100px" title="Site Web Evocatio &gt; Le web 2.0 &gt; nuage-web20.png" />Comme nous l&rsquo;avons vu dans la section M&eacute;dias et R&eacute;seaux sociaux, le r&eacute;seau social existe depuis plusieurs si&egrave;cles. Cependant, nous constatons une grande &eacute;volution et un d&eacute;veloppement rapide de ces derniers gr&acirc;ce au web 2.0.&nbsp; Qu&rsquo;est-ce que le web 2.0&nbsp;?</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">La d&eacute;finition propos&eacute;e par Wikip&eacute;dia correspond &agrave; notre vision :</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&laquo;&nbsp;Le <strong>Web 2.0</strong> est l&#39;&eacute;volution du Web vers plus de simplicit&eacute; (ne n&eacute;cessitant pas de grandes connaissances techniques ni informatiques pour les utilisateurs) et d&#39;interactivit&eacute; (permettant &agrave; chacun, de fa&ccedil;on individuelle ou collective, de contribuer, d&#39;&eacute;changer et de collaborer sous diff&eacute;rentes formes)&nbsp;&raquo;</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">L&#39;&Eacute;volution d&rsquo;Internet a permis la cr&eacute;ation de nouveaux outils pour l&rsquo;entreprise ou l&rsquo;utilisateur. Avec l&rsquo;arriv&eacute;e du web 2.0 en 2005, Internet a subit de nombreux changements. Gr&acirc;ce &agrave; cette &eacute;volution technologique qui&nbsp; a commenc&eacute; &agrave; r&eacute;ellement s&rsquo;imposer qu&rsquo;&agrave; partir de 2007, l&rsquo;internaute se voit maintenant proposer de la musique, des vid&eacute;os, et images en temps r&eacute;el mais aussi davantage d&rsquo;interactivit&eacute; avec les sites internet. Par ailleurs, celui-ci a amen&eacute; l&rsquo;&eacute;volution des r&eacute;seaux sociaux.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">L&#39;internaute devient, gr&acirc;ce aux outils mis &agrave; sa disposition, une personne active sur la toile.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Diff&eacute;rentes caract&eacute;ristiques fondamentales ressortent de l&rsquo;utilisation du web 2.0&nbsp;:</span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">La collaboration</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">La communication</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Le partage</span></span></li>\r\n	<li style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Les r&eacute;seaux sociaux</span></span></li>\r\n</ul>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Pour en savoir plus, nous vous conseillons de consulter ce site tr&egrave;s bien fait&nbsp;: <a href="http://www.pmtic.net/cles_web2/contenus/principes_generaux/definition.php">http://www.pmtic.net/cles_web2/contenus/principes_generaux/definition.php</a></span></span></p>\r\n\r\n<p style="text-align:justify">&nbsp;</p>'),
(34, 1, 18, NULL),
(35, 2, 19, '<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913130/images.jpg?version=1&amp;modificationDate=1365777904000" style="width:300px" title="Site Web Evocatio &gt; La visibilité sur le web &gt; images.jpg" />Comment promouvoir votre entreprise sur Internet sans perdre trop de temps ou d&eacute;penser beaucoup d&rsquo;argent ? Voici une question qui est beaucoup pos&eacute;e par l&#39;ensemble de la communaut&eacute; web. Nous tenterons de r&eacute;pondre &agrave; cette question.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">En effet, votre site Web devra se d&eacute;marquer parmi plus de 24 milliards de pages Web. L&#39;inscription de votre site sur les moteurs de recherche est primordiale. De plus, il devra se retrouver dans les premiers de sa cat&eacute;gorie.&nbsp; Pour permettre cela, vous devez am&eacute;liorer sa visibilit&eacute; sur internet.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Cela ne fait pas tr&egrave;s longtemps qu&rsquo;internet est entr&eacute; de mani&egrave;re active dans notre vie quotidienne, et s&rsquo;il y a quelques ann&eacute;es il &eacute;tait plus facile de gagner en visibilit&eacute; via la t&eacute;l&eacute;vision ou la radio, aujourd&rsquo;hui internet a pris le relais. Tout le monde s&rsquo;en sert et la plateforme devient un outil int&eacute;ressant pour offrir de la visibilit&eacute; &agrave; son entreprise.</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>&nbsp;</strong>Celle-ci se traduit simplement par le r&eacute;f&eacute;rencement de votre site. En effet, cela consiste &agrave; am&eacute;liorer la pertinence du contenu et &agrave; am&eacute;liorer la structure du site Internet en facilitant la lecture par les robots des moteurs de recherche.&nbsp;</span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>&nbsp;</strong>Cependant, avec des m&eacute;thodes simples, vous pouvez attirer de nombreux clients vers vos services ou vos produits. Voici quelques astuces simples pour muscler votre notori&eacute;t&eacute; sur la toile&nbsp;:</span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Premi&egrave;re &eacute;tape&nbsp;: <strong>avoir un site simple bien r&eacute;f&eacute;renc&eacute;</strong> dans les moteurs de recherche. Le&nbsp;r&eacute;f&eacute;rencement naturel sur Google permet de toucher un public-cible de mani&egrave;re plus pertinente. Certes, il peut prendre du temps mais il augmentera sans aucun doute votre visibilit&eacute;. Id&eacute;alement, une strat&eacute;gie d&#39;optimisation sera planifi&eacute;e et d&eacute;finie &agrave; la conception du site Web.</span></span><br />\r\n	&nbsp;</li>\r\n	<li style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Utilisez les m&eacute;dias sociaux&nbsp;:</strong> choisissez les r&eacute;seaux sociaux les plus pertinents en fonction de votre cible. Une fois votre choix fait, il ne faudra pas h&eacute;siter &agrave; communiquer avec vos membres, &agrave; fid&eacute;liser votre client&egrave;le, &agrave; publier du contenus sur vos produits, services et offres promotionnelles, &agrave; d&eacute;velopper l&#39;utilisation des r&eacute;seaux sociaux et surtout entretenir l&#39;e-reputation de votre soci&eacute;t&eacute; sur Internet, autres canaux de m&eacute;dias ou de dimension communautaire.</span></span></li>\r\n</ul>\r\n\r\n<p style="text-align:justify">&nbsp;</p>\r\n\r\n<ul>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Pour certains secteurs d&#39;activit&eacute;, <strong>une campagne publicitaire sur Google</strong> avec Google AdWords peut s&#39;av&eacute;rer efficace pour un budget faible. Pensez &quot;r&eacute;f&eacute;rencement payant&quot; pour le lancement de votre activit&eacute; sur le web. Quelques jours par mois peuvent d&eacute;j&agrave; &ecirc;tre efficaces sans trop d&#39;investissement. Choisissez donc les bons moments pour vos campagnes publicitaires.&nbsp;</span></span></span></span></li>\r\n</ul>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>&nbsp;</strong></span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>&nbsp;</strong></span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>&nbsp;</strong></span></span></p>'),
(36, 1, 19, NULL),
(37, 2, 20, '<p style="text-align: justify;"><span style="font-family:comic sans ms,cursive"><span style="font-size:14px">Nous d&eacute;finirons le marketing comme diff&eacute;rentes techniques et m&eacute;thodes permettant de mettre en valeur un produit. En entreprise il est donc important d&#39;avoir une strat&eacute;gie marketing simple et efficace pour se faire conna&icirc;tre tr&egrave;s rapidement et ainsi g&eacute;n&eacute;rer de la valeur.</span></span></p>'),
(38, 1, 20, NULL),
(39, 2, 21, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913136/ROI.jpg?version=1&amp;modificationDate=1365797158000" style="width:100px" title="Site Web Evocatio &gt; Le retour sur investissement (ROI) &gt; ROI.jpg" />Lors du d&eacute;roulement des &eacute;tapes relatives &agrave; un projet, la d&eacute;cision de lancer un projet se fait en tenant compte d&rsquo;un certain nombre de facteurs. Ainsi ces crit&egrave;res sont la faisabilit&eacute; fonctionnelle et technique. En fonction de la taille du projet et des investissements &agrave; consentir, les d&eacute;cideurs, souvent des financiers appr&eacute;cient en plus l&rsquo;approche &eacute;conomique pour appuyer leur d&eacute;cision. &nbsp;Cette approche se traduit par la mesure de l&rsquo;efficacit&eacute; d&rsquo;un investissement en termes de rentabilit&eacute; appel&eacute;e le &laquo;&nbsp;Retour sur Investissement&nbsp;&raquo;. Cependant cette approche purement financi&egrave;re ne doit en aucun cas &ecirc;tre le seul &eacute;l&eacute;ment d&eacute;terminant dans le choix de mener ou non &agrave; bien un projet. Ainsi un budget investi doit permettre de rapporter autant et surtout plus que le co&ucirc;t initial.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Ce petit site vous expliquera plus en d&eacute;tails la formule &agrave; suivre pour calculer votre retour sur investissement :</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><a href="http://www.l-expert-comptable.com/comptabilite/l-analyse-comptable-et-financiere/le-retour-sur-investissement.html">http://www.l-expert-comptable.com/comptabilite/l-analyse-comptable-et-financiere/le-retour-sur-investissement.html</a></span></span></p>'),
(40, 1, 21, NULL),
(41, 2, 22, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">V&eacute;ritable ph&eacute;nom&egrave;ne internet depuis quelques ann&eacute;es, les m&eacute;dias et r&eacute;seaux sociaux ont su se d&eacute;velopper pour toucher &agrave; travers le monde des millions d&#39;internautes. Sur internet ils sont qualifi&eacute;s de &laquo;&nbsp;la grande affaire du moment&nbsp;&raquo;.&nbsp; En effet, un public tr&egrave;s large les utilise au quotidien.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Cependant, les adolescents et &eacute;tudiants restent les pr&eacute;curseurs de ce ph&eacute;nom&egrave;ne mondial. Les internautes estiment que les r&eacute;seaux et m&eacute;dias sociaux font partie de leur quotidien, c&rsquo;est tout simplement une activit&eacute; sociale &agrave; part enti&egrave;re. Le nombre d&rsquo;utilisateurs ne cesse d&rsquo;augmenter avec un nombre actuel de 1,5 milliards d&rsquo;utilisateurs dans le monde.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Au final savons-nous vraiment ce que sont les r&eacute;seaux et m&eacute;dias sociaux ? Il y a t-il des avantages pour une entreprise &agrave; les utiliser ? Quels sont-ceux qui font partis de notre quotidien ?</span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">A propos</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Les plus utilis&eacute;s</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Avantages de ces outils</span></span></li>\r\n</ul>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Ces derni&egrave;res ann&eacute;es, nous avons assist&eacute; &agrave; une forte expansion de leur nombre mais aussi de leur type. Maintenant chaque internaute peut trouver un r&eacute;seau social qui lui correspond qu&rsquo;il soit &agrave; caract&egrave;re g&eacute;n&eacute;ral, th&eacute;matique ou professionnel. Le d&eacute;veloppement rapide de ce ph&eacute;nom&egrave;ne a amen&eacute; les entreprises &agrave; se demander si elles devaient participer &agrave; ce ph&eacute;nom&egrave;ne et si oui de quelle mani&egrave;re&nbsp;!</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Voici un petit site qui devrait int&eacute;resser bon nombre d&rsquo;entre vous professionnels ou internautes, vous y apprendrez comment r&eacute;ussir avec les r&eacute;seaux sociaux&nbsp;: </strong></span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong><a class="external-link" href="http://www.reseaux-sociaux.net/" rel="nofollow">http://www.reseaux-sociaux.net/</a></strong></span></span></p>'),
(42, 1, 22, NULL),
(43, 2, 23, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913153/Capture%20d%E2%80%99e%3Fcran%202013-04-11%20a%3F%2010.46.58.png?version=1&amp;modificationDate=1365698651000" style="width:100px" title="Site Web Evocatio &gt; A propos &gt; Capture d’e?cran 2013-04-11 a? 10.46.58.png" />Selon Michelle Blanc consultante, &quot;Les m&eacute;dias sociaux sont la rivi&egrave;re des infos dont il faut savoir s&rsquo;abreuver et apprendre &agrave; y nager pour ne pas s&rsquo;y noyer</strong>.&quot;</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Beaucoup de personnes qualifient souvent les termes &laquo;&nbsp;r&eacute;seaux sociaux&nbsp;&raquo; et &laquo;&nbsp;m&eacute;dias sociaux&nbsp;&raquo; de synonyme mais est-ce r&eacute;ellement la m&ecirc;me chose, savez-vous les diff&eacute;rencier&nbsp;?</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Les m&eacute;dias sociaux sont tous ces outils du Web 2. 0 qui vous permettent <strong>d&rsquo;entrer en relation et partager du contenu avec les autres internautes.</strong> Cet ensemble d&#39;outils regroupe des r&eacute;seaux sociaux, des blogs, des forums et bien d&rsquo;autres plateformes. En dehors des r&eacute;seaux sociaux virtuels vous retrouvez donc toutes les plateformes qui vous permettent de partager du contenu, de l&rsquo;indexer ou de le commenter : Youtube, etc...</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Selon Wikip&eacute;dia, ils repr&eacute;sentent &laquo;&nbsp;un ensemble de sites internet qui permettent aux internautes de se cr&eacute;er une page personnelle afin de partager et d&#39;&eacute;changer des informations et des photos avec leur communaut&eacute; d&#39;amis et leur r&eacute;seau de connaissances&nbsp;&raquo;. Cependant a t&rsquo;il toujours &eacute;t&eacute; le cas&nbsp;? En fait non, si nous remontons depuis des si&egrave;cles nous verrons que ce n&rsquo;est pas vraiment une nouveaut&eacute;.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">En effet, les r&eacute;seaux sociaux existaient bien avant Internet, &agrave; travers des clubs de lecture ou encore des clubs sportifs. C&rsquo;est avec la r&eacute;volution d&rsquo;internet que le terme r&eacute;seau social a beaucoup &eacute;volu&eacute;. Ils existent deux grandes cat&eacute;gories de r&eacute;seaux sociaux :</span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>online</strong> pour tout ceux qui utilisent internet pour &eacute;changer des informations ou autres&nbsp;</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>offline</strong> pour toutes les activit&eacute;s en dehors du travail qui am&egrave;nent &agrave; c&ocirc;toyer du monde et &agrave; &eacute;changer avec ces derniers (club sportif, syndicat...).</span></span><br />\r\n	&nbsp;</li>\r\n</ul>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Ce n&rsquo;est qu&rsquo;&agrave; l&rsquo;arriv&eacute;e du web 2.0 que l&#39;ensemble des m&eacute;dias sociaux a connu une popularit&eacute; grandissante que cela soit pour un usage personnel ou professionnel. &nbsp;</span></span></p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>'),
(44, 1, 23, NULL),
(45, 2, 24, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913155/14404-istock-000005611388xsmall-s-.png?version=1&amp;modificationDate=1365701861000" style="width:100px" title="Site Web Evocatio &gt; Avantages de ces outils &gt; 14404-istock-000005611388xsmall-s-.png" />Pour un particulier, nous dirons qu&rsquo;il y a diff&eacute;rents avantages &agrave; utiliser ces outils&nbsp;:</span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Rester en contact avec sa famille</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Exprimer ses opinions sur divers sujets</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">R&eacute;seautage pour trouver un emploi</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Partage</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Discussion</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Commerce</span></span></li>\r\n</ul>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Bien que les m&eacute;dias sociaux soient de plus en plus populaires et qu&rsquo;ils permettent aux entreprises d&rsquo;atteindre des millions de consommateurs de par le monde, certaines marques&nbsp;pr&eacute;f&egrave;rent&nbsp;les ignorer. En agissant de la sorte, elles se privent pourtant d&rsquo;une opportunit&eacute; int&eacute;ressante pour la r&eacute;alisation de leurs objectifs.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Un r&eacute;seau social d&rsquo;entreprise peut renforcer votre activit&eacute;, vous aider &agrave; identifier les connaissances de votre personnel et conna&icirc;tre la r&eacute;putation de votre entreprise.&nbsp; Vous pouvez utiliser les r&eacute;seaux professionnels suivants&nbsp;: Linked In, Viadeo, Xing&hellip;mais aussi Facebook et Twitter qui sont plut&ocirc;t des r&eacute;seaux sociaux grand public.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Ces r&eacute;seaux feront &eacute;voluer vos modes de communication dans l&rsquo;entreprise. Il existe un grand nombre d&#39;avantages &agrave; int&eacute;grer un r&eacute;seau social interne au sein de l&rsquo;organisation ou externe &agrave; l&#39;entreprise:</span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Une meilleure phase d&rsquo;int&eacute;gration&nbsp;:</strong> Les nouveaux employ&eacute;s cherchent des r&eacute;ponses aux questions qu&#39;ils se posent d&egrave;s le premier jour, mais &eacute;vitent d&#39;envoyer des e-mails en rafale &agrave; des coll&egrave;gues encore inconnus. Gr&acirc;ce au r&eacute;seau social, ils peuvent poser leurs questions ou chercher des informations au sein du r&eacute;seau, et ont de bonnes chances d&#39;obtenir rapidement des r&eacute;ponses dans le flux d&rsquo;&eacute;changes</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>La d&eacute;couverte de nouveaux talents&nbsp;: </strong>les r&eacute;seaux professionnels disposent de moteurs de recherches pour faciliter la recherche de centres d&rsquo;int&eacute;r&ecirc;t professionnels, de talents.. Vous pouvez trouver des membres qui vous int&eacute;ressent, consulter leurs profils, les contacter via la plateforme pour &eacute;changer des informations, des astuces et pourquoi pas faire affaires avec eux de mani&egrave;re tr&egrave;s rapide&hellip;<strong> </strong></span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Accro&icirc;tre la notori&eacute;t&eacute; de votre entreprise&nbsp;: </strong>en partageant du contenu pertinent et en nouant des relations avec des professionnels influents, une entreprise verra une augmentation de la port&eacute;e de ses messages, influencer les consommateurs, faire participer leurs membres &agrave; des conversations...</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Augmenter le trafic de votre site web&nbsp;: </strong>les m&eacute;dias sociaux deviennent des sources de trafic importantes pour les &eacute;diteurs de site internet. Ainsi il ne faut pas h&eacute;siter &agrave; ajouter des boutons de partage social sur votre site et &eacute;videmment indiquer l&rsquo;url de votre site internet sur vos profils sociaux.</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Am&eacute;liorer le r&eacute;f&eacute;rencement de votre site internet&nbsp;: </strong>les m&eacute;dias sont ouvert au r&eacute;f&eacute;rencement social. L&rsquo;entreprise doit de nos jours cr&eacute;er une page professionnelle, utiliser des bons mots-cl&eacute;s et encouragez l&rsquo;audience &agrave; partager les articles.</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Am&eacute;liorer le nombre de ventes&nbsp;: </strong>les entreprises utilisent les m&eacute;dias sociaux pour le partage des bons plans et des r&eacute;ductions entre les fans et leur r&eacute;seau. Il ne faut pas h&eacute;siter &agrave; int&eacute;grer des boutons &laquo;&nbsp;j&rsquo;aime&nbsp;&raquo; sur vos produits, porter vos efforts sur Facebook et Twitter, augmenter le nombre d&rsquo;abonn&eacute;s et de fans, r&eacute;alisez des vid&eacute;os pour promouvoir les produits&hellip;</span></span></li>\r\n</ul>\r\n\r\n<p style="text-align: justify;"><span style="font-family:comic sans ms,cursive"><span style="font-size:14px">Et bien d&rsquo;autres&hellip;donc n&rsquo;h&eacute;sitez pas &agrave; vous lancer dans les m&eacute;dias sociaux&nbsp;!</span></span></p>'),
(46, 1, 24, NULL),
(47, 2, 25, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913157/en-2012-les-americains-ont-passe-plus-de.jpg?version=1&amp;modificationDate=1365698766000" style="width:100px" title="Site Web Evocatio &gt; Les plus utilisés &gt; en-2012-les-americains-ont-passe-plus-de.jpg" />Le d&eacute;veloppement des r&eacute;seaux sociaux est diff&eacute;rent selon le pays.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Cependant, nous retrouvons quand m&ecirc;me 3 entit&eacute;s qui sont davantage mises en avant&nbsp;:</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Facebook </strong>est le r&eacute;seau social de r&eacute;f&eacute;rence o&ugrave; discuter, partager, jouer, communiquer, etc&hellip; Il a clairement perc&eacute; dans le r&eacute;el int&eacute;r&ecirc;t et d&eacute;sir de se connecter, chose &agrave; laquelle les enfants et adolescents ont adh&eacute;r&eacute; sans h&eacute;sitation. Les interactions entre membres incluent le partage de correspondance et de documents multim&eacute;dias. Un principe &eacute;galement retrouv&eacute; sur d&#39;autres r&eacute;seaux sociaux. Facebook a &eacute;t&eacute; cr&eacute;&eacute; &agrave; Harvard en 2004 et quelques ann&eacute;es plus tard conna&icirc;t un succ&egrave;s mondial avec plus d&rsquo;un milliard d&rsquo;utilisateurs.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Ensuite nous retrouvons, <strong>Twitter </strong>en 2<sup>&egrave;me</sup> position.&nbsp; Parlons de ce r&eacute;seau social un peu plus particulier que Facebook et des opportunit&eacute;s qu&rsquo;il peut cr&eacute;er au niveau des entreprises. En effet Twitter a un mode de fonctionnement bien diff&eacute;rent, un utilisateur cr&eacute;e sa page, il peut d&eacute;cider de suivre des personnes de son entourage ou encore des c&eacute;l&eacute;brit&eacute;s mais aussi des entreprises. Ce r&eacute;seau permettra aux entreprises de diffuser des liens commerciaux, faire de la publicit&eacute; et augmenter son chiffre d&rsquo;affaires de mani&egrave;re consid&eacute;rable.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Pour finir nous retrouvons <strong>LinkedIn</strong>. Cette plateforme facilite la constitution d&rsquo;un r&eacute;seau de contacts professionnels. En effet le service contient une large vari&eacute;t&eacute; d&rsquo;utilisateurs&nbsp;: PDG, &eacute;tudiants, conseillers, Directeurs G&eacute;n&eacute;raux, Vice-Pr&eacute;sidents, recruteurs et bien d&rsquo;autres provenant de plus de 120 secteurs d&rsquo;activit&eacute;s. En plus de pouvoir visualiser les informations de ces personnes, le r&eacute;seau social permet m&ecirc;me de rentrer en contact avec eux.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Si cela n&#39;est pas encore fait, nous vous conseillons fortement de cr&eacute;er votre espace que vous soyez professionnels ou particuliers pour partager vos informations avec l&rsquo;ensemble de la communaut&eacute; web et ainsi vous cr&eacute;er un portefeuille de contact ou tout simplement vous faire conna&icirc;tre.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Bien s&ucirc;r il existe beaucoup d&rsquo;autres m&eacute;dias sociaux plus ou moins connus, voici une liste des plus utilis&eacute;s dans le monde&nbsp;:</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong><a href="http://www.netguide.com/Reseaux-sociaux/">http://www.netguide.com/Reseaux-sociaux/</a></strong></span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>&nbsp;</strong></span></span></p>'),
(48, 1, 25, NULL),
(49, 2, 26, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913206/collaboration-online-300x285.jpg?version=1&amp;modificationDate=1365710223000" style="width:100px" />La collaboration&nbsp;</strong>: La collaboration se d&eacute;finit comme le fait de travailler ensemble sur un m&ecirc;me document. Dans le cadre du Web 2.0. La mise en place de nouvelles plateformes permet aux usagers de cr&eacute;er et de partager des contenus Web riches. L&#39;interactivit&eacute; est &agrave; la mode, l&#39;usager est &agrave; la fois consommateur et producteur de contenu. On voit alors appara&icirc;tre les blogues; le partage de vid&eacute;os, de photos et de musique; le syst&egrave;me de &laquo; tags &raquo;; les flux RSS; ainsi que la prolif&eacute;ration des r&eacute;seaux sociaux. La majorit&eacute; des outils donnent cette possibilit&eacute;. Ils permettent ainsi de mettre en place une collaboration n&#39;impliquant ni proximit&eacute; g&eacute;ographique ni contrainte temporelle.</span></span></p>'),
(50, 1, 26, NULL),
(51, 2, 27, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913208/6441410-entreprise-moderne-communication-internet-arriere-plan-avec-globe.jpg?version=1&amp;modificationDate=1365710262000" style="width:100px" />La communication&nbsp;: </strong>le d&eacute;veloppement du web 2.0 et de ces nouveaux outils, ont fait que la relation entre les consommateurs et les entreprises n&rsquo;est plus la m&ecirc;me. Ainsi, les consommateurs participent maintenant &agrave; la communication des marques &agrave; travers le bouche &agrave; oreille, des forums de discussion&hellip; et les entreprises doivent prendre en compte leur avis. Il s&rsquo;est cr&eacute;&eacute; un v&eacute;ritable &eacute;change entre les entreprises et les consommateurs depuis l&rsquo;av&egrave;nement du web 2.0.</span></span></p>'),
(52, 1, 27, NULL),
(53, 2, 28, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913210/PartageDInformationsEtRelationsEntreLaFamilleEtLesIntervenants-01.png?version=1&amp;modificationDate=1365710294000" style="width:100px" />Le partage&nbsp;: </strong>Le partage est la caract&eacute;ristique d&#39;un nouvel usage d&#39;Internet. &nbsp;Il conna&icirc;t un important succ&egrave;s gr&acirc;ce au d&eacute;veloppement de plateformes proposant aux internautes de publier leurs fichiers multim&eacute;dias. Globalement, il consiste &agrave; publier des ressources sur un site (musique, photo, etc.) et de laisser les utilisateurs les consulter gratuitement. La notion de partage peut aller plus loin avec le t&eacute;l&eacute;chargement de fichier. Des sites y sont consacr&eacute;s et notamment au partage de m&eacute;dias (photos, musiques, vid&eacute;os). La logique est toujours la m&ecirc;me : c&#39;est l&#39;utilisateur qui produit le contenu et le poste sur la plateforme d&#39;&eacute;change sans oublier d&#39;y associer des tags (mots-cl&eacute;s) pour mieux identifier les contenus.<br />\r\nParmi les sites les plus c&eacute;l&egrave;bres, citons : <em>FlickR</em> (<a class="external-link" href="http://www.flickr.com/" rel="nofollow">http://www.flickr.com/</a>) et <em>Riya</em> (<a class="external-link" href="http://www.riya.com/" rel="nofollow">http://www.riya.com/</a>) pour le partage de photos ; <em>YouTube</em> (<a class="external-link" href="http://www.youtube.com/" rel="nofollow">http://www.youtube.com/</a>) et <em>Dailymotion</em> (<a class="external-link" href="http://www.dailymotion.com/" rel="nofollow">http://www.dailymotion.com/</a>) pour le partage de vid&eacute;os ; <em>MySpace</em> (<a class="external-link" href="http://www.myspace.com/" rel="nofollow">http://www.myspace.com/</a>) ou encore <em>Odeo</em> (<a class="external-link" href="http://odeo.com/" rel="nofollow">http://odeo.com/</a>) pour le partage de fichiers musicaux.</span></span></p>'),
(54, 1, 28, NULL),
(55, 2, 29, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><img class="confluence-embedded-image confluence-thumbnail" src="https://tools.evocatio.com/confluence/download/thumbnails/8913212/reseaux_sociaux.jpg?version=1&amp;modificationDate=1365710316000" style="width:100px" /> <strong>Les r&eacute;seaux sociaux&nbsp;: </strong>&agrave; l&rsquo;aube du web 2.0 il est important de les utiliser pour diffuser vos contenus de mani&egrave;re continue. Outre les possibilit&eacute;s de diffusion et de fid&eacute;lisation d&rsquo;un groupe &agrave; nos publications, les m&eacute;dias sociaux sont aussi de puissants outils de r&eacute;seautage et un moyen efficace pour recevoir des commentaires et des suggestions de consommateurs.</span></span></p>');
INSERT INTO `HtmlContentTranslation` (`id`, `trans_lang_id`, `content_id`, `content`) VALUES
(56, 1, 29, NULL),
(57, 2, 30, '<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Administration de </strong><strong>la communaut&eacute;&nbsp;:</strong></span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>&nbsp;</strong>Dans le projet UDA, le site web qui &eacute;tait simplement une pr&eacute;sence en ligne, est vite devenu un incontournable d&ucirc; &agrave; la strat&eacute;gie &eacute;laborer par nos partenaires qui ont transform&eacute; le point de pr&eacute;sence, en gestion de la communaut&eacute; artistique. Avec les recherches et le partage de casting en ligne en passant par le panier d&#39;achat de la f&eacute;d&eacute;ration des artistes. En fait la solution de ce c&ocirc;t&eacute; est plus strat&eacute;gique que technique. Il faut trouver ce que la communaut&eacute; d&eacute;sire, et fabriquer l&#39;&eacute;cosyst&egrave;me dans lequel elle &eacute;voluera. L&#39;utilisation des m&eacute;dias sociaux n&#39;est qu&#39;une petite partie de l&#39;&eacute;quation et doit &ecirc;tre planifi&eacute; &agrave; partir d&#39;une strat&eacute;gie globale.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&nbsp;<strong>Exp&eacute;riences avec int&eacute;grations </strong><strong>de donn&eacute;es externes&nbsp;:</strong></span></span></p>\r\n\r\n<ul>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Dans le cas de r&eacute;seau environnement nous avons d&ucirc; cr&eacute;er un outil qu&rsquo;il a fallu int&eacute;grer &agrave; leurs CMS (Tiki Wiki) qui ne pouvait subvenir &agrave; au besoin d&rsquo;int&eacute;grer leurs donn&eacute;es</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Dans le cas de Bixi nous avons cr&eacute;&eacute; un acc&egrave;s &agrave; des informations qui viennent d&#39;une boutique externe que nous avons ajout&eacute; au profil de l&#39;utilisateur et qui (en un clic) l&#39;am&egrave;ne dans le panier de site en question. Le contenu est transf&eacute;r&eacute; depuis la boutique en format JSON.</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Aussi pour Bixi, une communication avec les services web de 8D a &eacute;t&eacute; mise en place.</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Avec UDA la communication avec les web services de l&#39;UDA</span></span></li>\r\n	<li style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">Int&eacute;gration de plusieurs modes de paiement via web services, m&eacute;thode post, Rest pour UDA, Tahua, Actumus, Bixi, etc.</span></span></li>\r\n</ul>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Exp&eacute;rience avec </strong><strong>le bilinguisme&nbsp;:</strong></span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>Dans le cadre de multiples projets nous avons du faire face &agrave; la question du bilinguisme, le site de Bixi Ottawa et Montr&eacute;al, le site d&rsquo;Actumus et de Tahua, le site d&rsquo;Americana.org, l&#39;application de Pr&eacute;-Emploi Prestige ainsi que le site applicatif de l&#39;Union des Artistes dont l&rsquo;accr&eacute;ditation de nature linguistique &agrave; soudainement eu besoin de transformer une section de son site pour qu&#39;il soit bilingue (section Artisti). Nous avons donc rapidement adapt&eacute; le CMS pour permettre l&#39;&eacute;dition bilingue de toutes les publications qui peuvent &ecirc;tre soit en fran&ccedil;ais seulement ou dans les deux langues.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Suite &agrave; toute sorte de tribulations avec des outils diff&eacute;rents qui g&eacute;raient plus ou moins bien les langues (que ce soit dans les Urls ou les diff&eacute;rents formulaires, pages etc.), nous avons d&eacute;velopp&eacute; notre propre librairie symfony2 dont la composante principale est <strong>la gestion de la langue. </strong></span></span></p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Type </strong><strong>d&#39;utilisateurs&nbsp;:</strong></span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pour <strong>Pr&eacute;-Emploi Prestige</strong> nous avons d&eacute;velopp&eacute; un syst&egrave;me qui diff&eacute;rencie les usagers selon leurs types (employer Prestige, entreprise (client), employer entreprise, contact, candidat). Il n&#39;est pas question ici de groupe mais bien d&#39;entit&eacute;s diff&eacute;rentes qui ont en commun les caract&eacute;ristiques g&eacute;n&eacute;rales d&#39;une entit&eacute; (l&#39;information de contact&nbsp;; adresse, cellulaire etc.), mais qui ont aussi des caract&eacute;ristiques particuli&egrave;res li&eacute;s &agrave; leurs types (le candidat &agrave; un CV et un profil tr&egrave;s &eacute;labor&eacute; alors que l&#39;employ&eacute; &agrave; simplement les informations de base et un compte utilisateur avec une liste de groupe et une extension t&eacute;l&eacute;phonique pour l&#39;entreprise, les clients ont aussi un compte utilisateur et&nbsp; un profil qui les lies &agrave; leur entreprise etc.) Le tout permet une gestion tr&egrave;s pr&eacute;cise et versatile des informations utile &agrave; chaque r&ocirc;le.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dans le cadre du projet <strong>UDA</strong>, nous avons eu &agrave; faire &agrave; une structure d&#39;utilisateurs qui &eacute;tait existante, mal architectur&eacute;, et complexe bas&eacute; sur une cat&eacute;gorie, un &eacute;tat et un type dans le cas des artistes, mais sur d&#39;autres caract&eacute;ristiques pour les agents, repr&eacute;sentants et producteurs. Plus une s&eacute;ries de r&egrave;gle de droit d&#39;acc&egrave;s dans le cas du dossier d&#39;un acteur repr&eacute;sent&eacute; ou non par l&#39;ayant droit, et l&#39;ajout par la suite d&#39;un nouveau type d&#39;artiste membre d&rsquo; Artisti (mais qui pouvait &ecirc;tre ou non membre de l&#39;UDA en soit).</span></span></p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>La </strong><strong>s&eacute;curit&eacute;&nbsp;:</strong></span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Il va sans dire que pour une compagnie comme Pr&eacute;-Emploi Prestige la s&eacute;curit&eacute; est tr&egrave;s importante. Tous les utilisateurs sont donc cr&eacute;&eacute;s directement par les employ&eacute;s de Prestige. Un certificat SSL EV a &eacute;t&eacute; mis en place pour s&eacute;curiser leur client&egrave;le.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nos produits sont architectur&eacute;s pour emp&ecirc;cher les m&eacute;thodes de hacking connues (sql injection, man-in-the-middle attack, cross-site request forgery).</span></span></p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Navigation </strong><strong>simple&nbsp;:</strong></span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lors de la phase d&#39;analyse nous pouvons d&eacute;finir un nombre de persona (utilisateurs types) &agrave; partir desquels nous &eacute;tablissons des mod&egrave;les de navigation directement li&eacute;s au comportement de l&#39;utilisateur, r&eacute;sultant en une interface simple et facile d&#39;utilisation. De plus nous adh&eacute;rons aux standards tels que le fil d&rsquo;Ariane et les menus contextuels.</span></span></p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>La </strong><strong>formation&nbsp;:</strong></span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dans le cas de produits g&eacute;n&eacute;rique nous pouvons cr&eacute;er ou r&eacute;cup&eacute;rer la documentation n&eacute;cessaire et fournir une formation g&eacute;n&eacute;rale. Nous avons donn&eacute; une formation de deux demi-journ&eacute;es aux int&eacute;grateurs de Morrow Communication (Bixi) sur l&#39;utilisation des interfaces et du code Apostrophe (CMS). Nous avons cr&eacute;&eacute; de la documentation et donn&eacute; une s&eacute;rie de formation &agrave; la gestion du Portail SAP aux employ&eacute;s de Rolls-Royce Canada. Cependant, au niveau de la formation, nous favorisons g&eacute;n&eacute;ralement une approche ou nous sommes les premiers r&eacute;cepteurs de la formation (durant l&#39;analyse). Puis nous d&eacute;veloppons l&rsquo;application en fonction des processus de l&rsquo;entreprise. Dans le cas de Pr&eacute;-Emploi Prestige l&#39;analyse du besoin du client nous &agrave; emmener &agrave; cr&eacute;er l&#39;application selon les m&ecirc;mes processus que ceux qu&#39;ils utilisaient sur papier. Le r&eacute;sultat est que la formation n&eacute;cessaire est minimale et que la r&eacute;sistance au changement est r&eacute;duite, ainsi les utilisateurs garde une fiert&eacute; et une responsabilit&eacute; face au produit final. C&#39;est d&#39;ailleurs pourquoi nous demandons &agrave; nos clients de nous fournir des ressources qui sont leurs utilisateurs principaux dans la phase de conception, ainsi que pour les tests d&#39;utilisateurs.</span></span></p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive"><strong>Fonctions </strong><strong>de recherche&nbsp;:</strong></span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nous avons d&eacute;velopp&eacute; pour l&#39;UDA un outil de recherche pour les artistes qui est multicrit&egrave;re et tr&egrave;s complexe. Plus de 25 crit&egrave;res tel le poids (de&nbsp;: a), l&#39;&acirc;ge apparent, le sexe, la taille, les types de danses, chants, instruments connues avec leurs niveaux d&#39;expertise etc. Aussi la recherche sur le site permet de trouver un mot cl&eacute; dans l&#39;ensemble des documents, articles, section du site. Nous avons utilis&eacute; pour cela l&#39;outil solr qui est tr&egrave;s puissant et qui nous permet de configurer les champs et fichiers qui sont index&eacute;s.</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:14px"><span style="font-family:comic sans ms,cursive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Toutes les applications ont une forme ou une autre de recherche. Par exemple pour Pr&eacute;-Emploi Prestige il est possible pour les administrateurs de rechercher des candidats, clients, utilisateurs, entreprises. Pour les entreprises de chercher des utilisateurs mais seulement dans leurs employ&eacute;s. Sur le site de Bixi nous pouvons rechercher une station sur la carte Google. Pour Mario Boies des produits sp&eacute;cifiques ou non avec des filtres pour les compagnies etc.</span></span></p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>'),
(58, 1, 30, NULL),
(59, 2, 31, NULL),
(60, 1, 31, NULL),
(61, 2, 32, NULL),
(62, 1, 32, NULL),
(63, 2, 33, NULL),
(64, 1, 33, NULL),
(65, 2, 34, '<p><span style="font-family:comic sans ms,cursive"><span style="color:rgb(0, 51, 102)"><u><strong>FORMULAIRE DE CONTACT : Prise de Rendez-vous&nbsp;</strong></u></span></span></p>\r\n\r\n<p><span style="color:#336699"><span style="font-size:12px">Veuillez remplir ce formulaire de contact s&#39;il vous pla&icirc;t si vous &ecirc;tes int&eacute;ress&eacute;s &agrave; prendre un RDV. Nous vous contacterons d&egrave;s que&nbsp;possible.&nbsp;</span></span></p>\r\n\r\n<p><span style="color:#336699"><span style="font-size:12px">Entreprise :</span></span></p>\r\n\r\n<p><span style="color:#336699">Nombre d&#39;employ&eacute;s :</span></p>\r\n\r\n<ul>\r\n	<li><span style="color:#336699">- de 10</span></li>\r\n	<li><span style="color:#336699">10 - 19</span></li>\r\n	<li><span style="color:#336699">20 - 49</span></li>\r\n	<li><span style="color:#336699">50 - 99</span></li>\r\n	<li><span style="color:#336699">100 - 200</span></li>\r\n	<li><span style="color:#336699">+ de 200</span></li>\r\n</ul>\r\n\r\n<p><span style="color:#336699"><span style="font-size:12px">Nom :</span></span></p>\r\n\r\n<p><span style="color:#336699"><span style="font-size:12px">Pr&eacute;nom :</span></span></p>\r\n\r\n<p><span style="color:#336699"><span style="font-size:12px">Adresse :</span></span></p>\r\n\r\n<p><span style="color:#336699"><span style="font-size:12px">Fonction :</span></span></p>\r\n\r\n<p><span style="color:#336699"><span style="font-size:12px">Courriel :</span></span></p>\r\n\r\n<p><span style="color:#336699"><span style="font-size:12px">Secteur d&#39;activit&eacute; :</span></span></p>\r\n\r\n<p><span style="color:#336699"><span style="font-size:12px">Br&egrave;ve description de vos besoins :</span></span></p>\r\n\r\n<p><span style="color:#336699"><span style="font-size:12px">Vos pr&eacute;f&eacute;rences pour les RDV : </span></span></p>\r\n\r\n<ul>\r\n	<li><span style="color:#336699"><span style="font-size:12px">le matin entre 9h-12h </span></span></li>\r\n	<li><span style="color:#336699"><span style="font-size:12px">l&#39;apr&egrave;s-midi 13h-16h</span></span></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(66, 1, 34, NULL),
(67, 2, 35, '<p>Si vous aimez entrependre de nouveaux d&eacute;finis, alors n&#39;h&eacute;sitez surtout pas &agrave; nous faire parvenir votre Curriculum Vitae, et peut-&ecirc;tre demain serez vous &agrave; nos c&ocirc;t&eacute;s pour participer &agrave; cette formidable aventure !</p>\r\n\r\n<p>Evocatio est actuellement &agrave; la recherche de ........................................... (mettre ici les sp&eacute;cificit&eacute;s)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Veuillez remplir ce formulaire de contact :&nbsp;</p>\r\n\r\n<p>Demande d&#39;emploi : (mettre ici une liste de sp&eacute;cialit&eacute;s)&nbsp;</p>\r\n\r\n<ul>\r\n	<li>charg&eacute; de projets&nbsp;</li>\r\n	<li>analyste&nbsp;</li>\r\n	<li>responsable des ventes et marketing</li>\r\n	<li>directrice administrative&nbsp;</li>\r\n	<li>int&eacute;grateur</li>\r\n	<li>d&eacute;veloppeur php</li>\r\n	<li>ergonome&nbsp;</li>\r\n	<li>designer web ...</li>\r\n</ul>\r\n\r\n<p>Upload de CV&nbsp;</p>\r\n\r\n<p>Nom :</p>\r\n\r\n<p>Pr&eacute;nom :</p>\r\n\r\n<p>Adresse : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Ville : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Pays : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Province :</p>\r\n\r\n<p>Courriel&nbsp;</p>\r\n\r\n<p>Num&eacute;ro de t&eacute;l&eacute;phone :</p>\r\n\r\n<p>Motivations :</p>\r\n\r\n<p>Questions ou commentaires :</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>'),
(68, 1, 35, NULL),
(69, 2, 38, '<p>La conception d&#39;un site &eacute;fficace n&eacute;sc&eacute;ssite un ensemble de connaissances touchant les technologies, les standards webs,&nbsp;la commercialisation et les produits &agrave; mettre en valeur. Pour ce faire il faut une &eacute;quipe comp&eacute;tente au niveau technique et des processus qui facilitent la collaboration avec les partenaires pour la gestion de votre image ainsi qu&#39;avec&nbsp;les vrais sp&eacute;cialiste du produit ... vous.</p>\r\n\r\n<p>Notre expertise &eacute;tant technique nous faisons appel &agrave; une banque de collaborateur en m&eacute;dias et en commercialisation pour les besoins pr&eacute;cis en cr&eacute;ation graphique et image de marque.</p>\r\n\r\n<p>Vous &ecirc;tes donc assur&eacute; d&#39;une qualit&eacute; technique sup&eacute;rieur avec la possibilit&eacute; de continuer un travail d&eacute;j&agrave; commenc&eacute; avec&nbsp;vos sp&eacute;cialiste de l&#39;image, ou de choisir l&#39;un de nos collaborateur aux styles et au r&eacute;alisation multiples pour une image et une cr&eacute;ativit&eacute; nouvelle.</p>\r\n\r\n<p>&Eacute;vocatio travail d&#39;abord avec l&#39;humain, puis avec les technologies.</p>'),
(70, 1, 38, NULL),
(71, 2, 39, '<p>Nous r&eacute;alisons de plus en plus de partenariat&nbsp;avec de grand&nbsp;sp&eacute;cialistes en commercialisation, en image de marque, en production de m&eacute;dias. Ils ont &agrave; coeur d&#39;offrir &agrave; leurs clients une qualit&eacute; de prestation technique sup&eacute;rieur. Parfois seulement comme un support &agrave; leurs &eacute;quipe interne, ou pour des mandats qui demande des innovations techniques complexes. L&#39;incroyable prend forme dans des prestations cr&eacute;atives et riches.</p>\r\n\r\n<p>Plus nos partenaires sont cr&eacute;atifs, plus les d&eacute;fis techniques sont int&eacute;ressant. Ensemble nous cherchons &agrave; pousser les limites des m&eacute;dias, serveurs, navigateurs tout en cr&eacute;ant des interfaces agr&eacute;ablement humaines.</p>\r\n\r\n<p>Sans oublier notre partenaire vedette ... vous. Tous nos efforts n&#39;ont de raison d&#39;&ecirc;tre que pour combl&eacute;s vos aspirations, qu&#39;elles soient simples ou complex. Si vous croyez que &ccedil;a ne peut &ecirc;tre fait, &ccedil;a nous int&eacute;resse.</p>'),
(72, 1, 39, NULL),
(73, 2, 40, '<p>L&#39;exp&eacute;rience nous a d&eacute;montr&eacute; qu&#39;un site web commence g&eacute;n&eacute;ralement avec peu de budget et des besoins qui sont standards. Cependant c&#39;est au moment de leur &eacute;volutions que les probl&egrave;mes surviennent. Les outils CMS tel WordPress, Joomla et Drupal offrent g&eacute;n&eacute;ralement un d&eacute;part rapide et peu couteux mais ne sont pas toujours &agrave; la hauteur lorsque vient le temps de grandir. La difficult&eacute; &agrave; maintenir les versions des modules d&#39;extensions et les limites de ses derniers obligent souvent de recommencer de z&eacute;ro ou de modifier de fa&ccedil;on importante les produits existants qui ne r&eacute;pondent pas aux besoins sp&eacute;cifiques de l&#39;entreprise. Evocatio se sp&eacute;cialise dans la cr&eacute;ation d&#39;applications personalis&eacute;s qui sont batis sur mesure au besoin de l&#39;entreprise.</p>\r\n\r\n<p>Pour &ecirc;tre &agrave; la fois comp&eacute;titif et versatile nous avons cr&eacute;er une librairie Open-Source bas&eacute;e sur le framework Symfony2. Traduire :</p>\r\n\r\n<div class="box_article" style="margin: 0px; padding: 12px 0px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: normal;">\r\n<h2>Symfony vs. CMS and packaged software</h2>\r\n\r\n<p>A framework, a CMS (Content Management System), and a packaged solution do not meet the same needs or require the same investment and/or the same expertise.</p>\r\n\r\n<p>With&nbsp;<strong>packaged software</strong>, it&#39;s simple: aside from changing a few parameters, businesses must be content with the available features, which may be more limited that the initially defined needs; or the opposite, far too large in number. Aside from integrating it into the current information system, selecting packaged software requires very little technical expertise.</p>\r\n\r\n<p>A&nbsp;<strong>CMS</strong>&nbsp;and its add-on modules can be used to design websites and applications that are fairly close to businesses&#39; needs, as long as the required modules are available and maintained!</p>\r\n\r\n<p>A&nbsp;<strong>framework</strong>&nbsp;offers all the flexibility of custom development and can be used to design an application that perfectly meets the expressed needs. It, however, requires development, integration and maintenance related technical expertise.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>voir :&nbsp;<a href="https://drupal.org/node/1039950">https://drupal.org/node/1039950</a></p>\r\n</div>\r\n\r\n<div class="box_hr" style="margin: 10px 0px; padding: 0px; height: 1px; line-height: 0; font-size: 0px; background-image: url(http://symfony.com/images/common/backgrounds/bg_hr.gif); position: relative; z-index: -1; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; background-position: 50% 0px; background-repeat: no-repeat no-repeat;">\r\n<hr /></div>\r\n\r\n<div class="box_article" style="margin: 0px; padding: 12px 0px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: normal;">\r\n<h2>Symfony: Development tools</h2>\r\n\r\n<p>Whether it is handwritten or developed using a framework, a PHP application is a PHP application. And in both cases it requires technical expertise. Nevertheless, the presence of a framework guarantees that an application complies with industry rules, is well structured, maintainable and scalable. It also saves developers time, by reusing generic modules, so they can focus on specific business features.</p>\r\n</div>'),
(74, 1, 40, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ImageFile`
--

DROP TABLE IF EXISTS `ImageFile`;
CREATE TABLE IF NOT EXISTS `ImageFile` (
  `id` int(11) NOT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `alt` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `InternalLink`
--

DROP TABLE IF EXISTS `InternalLink`;
CREATE TABLE IF NOT EXISTS `InternalLink` (
  `id` int(11) NOT NULL,
  `route` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `params` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `InternalLink`
--

INSERT INTO `InternalLink` (`id`, `route`, `params`) VALUES
(1, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";s:19:"vos-specialiste-web";s:7:"_locale";s:2:"fr";}'),
(2, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";N;s:7:"_locale";s:2:"en";}'),
(3, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";s:27:"votre-image-nos-partenaires";s:7:"_locale";s:2:"fr";}'),
(4, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";N;s:7:"_locale";s:2:"en";}'),
(5, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";s:10:"historique";s:7:"_locale";s:2:"fr";}'),
(6, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";N;s:7:"_locale";s:2:"en";}'),
(7, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";s:22:"specialites-d-evocatio";s:7:"_locale";s:2:"fr";}'),
(8, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";N;s:7:"_locale";s:2:"en";}'),
(9, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";s:25:"l-evolution-d-un-site-web";s:7:"_locale";s:2:"fr";}'),
(10, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";N;s:7:"_locale";s:2:"en";}'),
(11, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";s:9:"champagne";s:7:"_locale";s:2:"fr";}'),
(12, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";N;s:7:"_locale";s:2:"en";}'),
(13, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";s:24:"processus-de-realisation";s:7:"_locale";s:2:"fr";}'),
(14, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";N;s:7:"_locale";s:2:"en";}'),
(15, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";s:24:"processus-de-realisation";s:7:"_locale";s:2:"fr";}'),
(16, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";N;s:7:"_locale";s:2:"en";}'),
(17, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";s:6:"le-roi";s:7:"_locale";s:2:"fr";}'),
(18, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";N;s:7:"_locale";s:2:"en";}'),
(19, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";s:29:"les-medias-et-reseaux-sociaux";s:7:"_locale";s:2:"fr";}'),
(20, 'EvocatioWebBundle_PageDisplaySlug', 'a:2:{s:4:"slug";N;s:7:"_locale";s:2:"en";}');

-- --------------------------------------------------------

--
-- Structure de la table `Language`
--

DROP TABLE IF EXISTS `Language`;
CREATE TABLE IF NOT EXISTS `Language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Language`
--

INSERT INTO `Language` (`id`, `symbol`, `rank`, `status`) VALUES
(1, 'en', 2, 1),
(2, 'fr', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `LanguageTranslation`
--

DROP TABLE IF EXISTS `LanguageTranslation`;
CREATE TABLE IF NOT EXISTS `LanguageTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_372327C93059CC60` (`trans_lang_id`),
  KEY `IDX_372327C982F1BAF4` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `LanguageTranslation`
--

INSERT INTO `LanguageTranslation` (`id`, `trans_lang_id`, `language_id`, `name`) VALUES
(1, 1, 1, 'English'),
(2, 2, 1, 'anglais'),
(3, 1, 2, 'French'),
(4, 2, 2, 'français');

-- --------------------------------------------------------

--
-- Structure de la table `LibraryModule`
--

DROP TABLE IF EXISTS `LibraryModule`;
CREATE TABLE IF NOT EXISTS `LibraryModule` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `LibraryModuleTranslation`
--

DROP TABLE IF EXISTS `LibraryModuleTranslation`;
CREATE TABLE IF NOT EXISTS `LibraryModuleTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `name` longtext COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  `advantage` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_561E1F313059CC60` (`trans_lang_id`),
  KEY `IDX_561E1F31F347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Link`
--

DROP TABLE IF EXISTS `Link`;
CREATE TABLE IF NOT EXISTS `Link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Contenu de la table `Link`
--

INSERT INTO `Link` (`id`, `discr`) VALUES
(1, 'internal'),
(2, 'internal'),
(3, 'internal'),
(4, 'internal'),
(5, 'internal'),
(6, 'internal'),
(7, 'internal'),
(8, 'internal'),
(9, 'internal'),
(10, 'internal'),
(11, 'internal'),
(12, 'internal'),
(13, 'internal'),
(14, 'internal'),
(15, 'internal'),
(16, 'internal'),
(17, 'internal'),
(18, 'internal'),
(19, 'internal'),
(20, 'internal');

-- --------------------------------------------------------

--
-- Structure de la table `LinkTranslation`
--

DROP TABLE IF EXISTS `LinkTranslation`;
CREATE TABLE IF NOT EXISTS `LinkTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `link_id` int(11) DEFAULT NULL,
  `name` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_8EF1C4AB3059CC60` (`trans_lang_id`),
  KEY `IDX_8EF1C4ABADA40271` (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Map`
--

DROP TABLE IF EXISTS `Map`;
CREATE TABLE IF NOT EXISTS `Map` (
  `id` int(11) NOT NULL,
  `lng` int(11) NOT NULL,
  `lat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Menu`
--

DROP TABLE IF EXISTS `Menu`;
CREATE TABLE IF NOT EXISTS `Menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `root` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `Menu`
--

INSERT INTO `Menu` (`id`, `lft`, `rgt`, `root`, `type`) VALUES
(1, 1, 22, 1, 'root'),
(2, 2, 11, 1, 'internal'),
(3, 3, 4, 1, 'internal'),
(4, 5, 6, 1, 'internal'),
(5, 7, 8, 1, 'internal'),
(6, 12, 17, 1, 'internal'),
(7, 13, 16, 1, 'internal'),
(8, 9, 10, 1, 'internal'),
(9, 14, 15, 1, 'internal'),
(10, 18, 21, 1, 'internal'),
(11, 19, 20, 1, 'internal');

-- --------------------------------------------------------

--
-- Structure de la table `MenuTranslation`
--

DROP TABLE IF EXISTS `MenuTranslation`;
CREATE TABLE IF NOT EXISTS `MenuTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `link_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `slug` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F8D6B08CADA40271` (`link_id`),
  KEY `IDX_F8D6B08C3059CC60` (`trans_lang_id`),
  KEY `IDX_F8D6B08CCCD7E912` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Contenu de la table `MenuTranslation`
--

INSERT INTO `MenuTranslation` (`id`, `trans_lang_id`, `link_id`, `menu_id`, `slug`, `name`) VALUES
(1, 2, NULL, 1, NULL, 'Menu Principale'),
(2, 1, NULL, 1, NULL, 'Main Menu'),
(3, 2, 1, 2, 'vos-specialiste-web', 'Vos spécialiste Web'),
(4, 1, 2, 2, '', NULL),
(5, 2, 3, 3, 'vos-specialiste-web/votre-image-nos-partenaires', 'Votre image, nos partenaires'),
(6, 1, 4, 3, '/', NULL),
(7, 2, 5, 4, 'vos-specialiste-web/notre-histoire-version-web', 'Notre histoire, version Web'),
(8, 1, 6, 4, '/', NULL),
(9, 2, 7, 5, 'vos-specialiste-web/specialisation-web', 'Spécialisation Web'),
(10, 1, 8, 5, 'vos-specialiste-web/', NULL),
(11, 2, 9, 6, 'l-evolution-d-un-site-web', 'L''évolution d''un site web'),
(12, 1, 10, 6, '', NULL),
(13, 2, 11, 7, 'l-evolution-d-un-site-web/notre-alternative-a-word-press', 'Notre alternative a WordPress'),
(14, 1, 12, 7, 'l-evolution-d-un-site-web/', NULL),
(15, 2, 13, 8, 'vos-specialiste-web/comment-fait-on-une-application-web', 'Comment fait-on une application Web'),
(16, 1, 14, 8, '/', NULL),
(17, 2, 15, 9, 'notre-alternative-a-word-press/quand-word-press-ne-suffit-plus', 'Quand WordPress ne suffit plus'),
(18, 1, 16, 9, 'notre-alternative-a-word-press/', NULL),
(19, 2, 17, 10, 'le-web-des-affaires', 'Le web des affaires'),
(20, 1, 18, 10, '', NULL),
(21, 2, 19, 11, 'le-web-des-affaires/twitter-facebook-et-cie', 'Twitter, Facebook et cie'),
(22, 1, 20, 11, 'le-web-des-affaires/', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `NewsWidget`
--

DROP TABLE IF EXISTS `NewsWidget`;
CREATE TABLE IF NOT EXISTS `NewsWidget` (
  `id` int(11) NOT NULL,
  `maximum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `NewsWidget`
--

INSERT INTO `NewsWidget` (`id`, `maximum`) VALUES
(2, NULL),
(36, 0),
(37, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `NewsWidgetTranslation`
--

DROP TABLE IF EXISTS `NewsWidgetTranslation`;
CREATE TABLE IF NOT EXISTS `NewsWidgetTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `widget_id` int(11) DEFAULT NULL,
  `string` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B1B569FF3059CC60` (`trans_lang_id`),
  KEY `IDX_B1B569FFFBE885E2` (`widget_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `NewsWidgetTranslation`
--

INSERT INTO `NewsWidgetTranslation` (`id`, `trans_lang_id`, `widget_id`, `string`) VALUES
(1, 2, 2, NULL),
(2, 1, 2, NULL),
(3, 2, 36, 'test'),
(4, 1, 36, NULL),
(5, 2, 37, NULL),
(6, 1, 37, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Page`
--

DROP TABLE IF EXISTS `Page`;
CREATE TABLE IF NOT EXISTS `Page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B438191E5DA0FB8` (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Contenu de la table `Page`
--

INSERT INTO `Page` (`id`, `template_id`) VALUES
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `PageContent`
--

DROP TABLE IF EXISTS `PageContent`;
CREATE TABLE IF NOT EXISTS `PageContent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `area` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2101977FC4663E4` (`page_id`),
  KEY `IDX_2101977F84A0A3ED` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Contenu de la table `PageContent`
--

INSERT INTO `PageContent` (`id`, `page_id`, `content_id`, `area`) VALUES
(1, 3, 1, 'theatre'),
(2, 3, 2, NULL),
(3, 1, 3, 'theatre'),
(4, 6, 4, NULL),
(5, 5, 5, 'theatre'),
(6, 5, 6, NULL),
(7, 4, 7, 'theatre'),
(8, 7, 8, 'theatre'),
(9, 8, 9, 'theatre'),
(10, 9, 10, 'theatre'),
(11, 10, 11, 'theatre'),
(12, 11, 12, 'theatre'),
(13, 12, 13, 'theatre'),
(14, 13, 14, 'theatre'),
(15, 14, 15, 'theatre'),
(16, 15, 16, 'theatre'),
(17, 16, 17, 'theatre'),
(18, 17, 18, 'theatre'),
(19, 18, 19, 'theatre'),
(20, 19, 20, 'theatre'),
(21, 20, 21, 'theatre'),
(22, 21, 22, 'theatre'),
(23, 22, 23, 'theatre'),
(24, 23, 24, 'theatre'),
(25, 24, 25, 'theatre'),
(26, 25, 26, 'theatre'),
(27, 26, 27, 'theatre'),
(28, 27, 28, 'theatre'),
(29, 28, 29, 'theatre'),
(30, 29, 30, 'theatre'),
(31, 30, 31, 'theatre'),
(32, 7, 32, NULL),
(33, 7, 33, NULL),
(34, 31, 34, 'theatre'),
(35, 32, 35, 'theatre'),
(36, 6, 36, 'test'),
(37, 6, 37, NULL),
(38, 33, 38, 'theatre'),
(39, 34, 39, 'theatre'),
(40, 35, 40, 'theatre');

-- --------------------------------------------------------

--
-- Structure de la table `PageTranslation`
--

DROP TABLE IF EXISTS `PageTranslation`;
CREATE TABLE IF NOT EXISTS `PageTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_unique` (`trans_lang_id`,`slug`),
  KEY `IDX_D29B35C03059CC60` (`trans_lang_id`),
  KEY `IDX_D29B35C0C4663E4` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

--
-- Contenu de la table `PageTranslation`
--

INSERT INTO `PageTranslation` (`id`, `trans_lang_id`, `page_id`, `title`, `slug`, `status`) VALUES
(1, 2, 1, 'Equipe', 'equipe', 1),
(2, 1, 1, 'Evocatio', 'evocatio', 1),
(3, 2, 2, 'Portfolio', 'portfolio', 1),
(4, 1, 2, NULL, NULL, 1),
(5, 2, 3, 'Historique', 'historique', 1),
(6, 1, 3, NULL, NULL, 1),
(7, 2, 4, 'Processus de réalisation', 'processus-de-realisation', 1),
(8, 1, 4, NULL, NULL, 1),
(9, 2, 5, 'Spécialités d''Evocatio', 'specialites-d-evocatio', 1),
(10, 1, 5, NULL, NULL, 1),
(11, 2, 6, 'test', 'test', 1),
(12, 1, 6, NULL, NULL, 1),
(13, 2, 7, 'Demande de soumission', 'demande-de-soumission', 1),
(14, 1, 7, NULL, NULL, 1),
(15, 2, 8, 'Contact', 'contact', 1),
(16, 1, 8, NULL, NULL, 1),
(17, 2, 9, '12 Questions', 'questions', 1),
(18, 1, 9, NULL, NULL, 1),
(19, 2, 10, 'Champagne', 'champagne', 1),
(20, 1, 10, NULL, NULL, 1),
(21, 2, 11, 'Librairie', 'librairie', 1),
(22, 1, 11, NULL, NULL, 1),
(23, 2, 12, 'Engagement', 'engagement', 1),
(24, 1, 12, NULL, NULL, 1),
(25, 2, 13, 'HTML5', 'html5', 1),
(26, 1, 13, NULL, NULL, 1),
(27, 2, 14, 'Internationalisation', 'internationalisation', 1),
(28, 1, 14, NULL, NULL, 1),
(29, 2, 15, 'la gouvernance', 'la-gouvernance', 1),
(30, 1, 15, NULL, NULL, 1),
(31, 2, 16, 'la stratégie', 'la-strategie', 1),
(32, 1, 16, NULL, NULL, 1),
(33, 2, 17, 'le web 2.0', 'le-web-2-0', 1),
(34, 1, 17, NULL, NULL, 1),
(35, 2, 18, 'la visibilité sur le web', 'la-visibilite-sur-le-web', 1),
(36, 1, 18, NULL, NULL, 1),
(37, 2, 19, 'le marketing', 'le-marketing', 1),
(38, 1, 19, NULL, NULL, 1),
(39, 2, 20, 'le ROI', 'le-roi', 1),
(40, 1, 20, NULL, NULL, 1),
(41, 2, 21, 'les médias et réseaux sociaux', 'les-medias-et-reseaux-sociaux', 1),
(42, 1, 21, NULL, NULL, 1),
(43, 2, 22, 'A propos', 'a-propos', 1),
(44, 1, 22, NULL, NULL, 1),
(45, 2, 23, 'Avantage', 'avantage', 1),
(46, 1, 23, NULL, NULL, 1),
(47, 2, 24, 'les plus utilisés', 'les-plus-utilises', 1),
(48, 1, 24, NULL, NULL, 1),
(49, 2, 25, 'la collaboration', 'la-collaboration', 1),
(50, 1, 25, NULL, NULL, 1),
(51, 2, 26, 'la communication', 'la-communication', 1),
(52, 1, 26, NULL, NULL, 1),
(53, 2, 27, 'le partage', 'le-partage', 1),
(54, 1, 27, NULL, NULL, 1),
(55, 2, 28, 'les réseaux sociaux', 'les-reseaux-sociaux', 1),
(56, 1, 28, NULL, NULL, 1),
(57, 2, 29, 'expériences pertinentes', 'experiences-pertinentes', 1),
(58, 1, 29, NULL, NULL, 1),
(59, 2, 30, 'Actualités', 'actualites-', 1),
(60, 1, 30, NULL, NULL, 1),
(61, 2, 31, 'Formulaire de contact', 'formulaire-de-contact', 1),
(62, 1, 31, NULL, NULL, 1),
(63, 2, 32, 'Emplois', 'emplois', 1),
(64, 1, 32, NULL, NULL, 1),
(65, 2, 33, 'Vos spécialiste Web', 'vos-specialiste-web', 1),
(66, 1, 33, NULL, NULL, 0),
(67, 2, 34, 'Votre image, nos partenaires', 'votre-image-nos-partenaires', 1),
(68, 1, 34, NULL, NULL, 0),
(69, 2, 35, 'L''évolution d''un site web', 'l-evolution-d-un-site-web', 1),
(70, 1, 35, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Person`
--

DROP TABLE IF EXISTS `Person`;
CREATE TABLE IF NOT EXISTS `Person` (
  `id` int(11) NOT NULL,
  `firstname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `sex` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Persona`
--

DROP TABLE IF EXISTS `Persona`;
CREATE TABLE IF NOT EXISTS `Persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `discr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `PersonaCoordinate`
--

DROP TABLE IF EXISTS `PersonaCoordinate`;
CREATE TABLE IF NOT EXISTS `PersonaCoordinate` (
  `persona_id` int(11) NOT NULL,
  `coordinate_id` int(11) NOT NULL,
  PRIMARY KEY (`persona_id`,`coordinate_id`),
  KEY `IDX_E6C58832F5F88DB9` (`persona_id`),
  KEY `IDX_E6C5883298BBE953` (`coordinate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Portfolio`
--

DROP TABLE IF EXISTS `Portfolio`;
CREATE TABLE IF NOT EXISTS `Portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `PortfolioTranslation`
--

DROP TABLE IF EXISTS `PortfolioTranslation`;
CREATE TABLE IF NOT EXISTS `PortfolioTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `portfolio_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7964AEB93059CC60` (`trans_lang_id`),
  KEY `IDX_7964AEB9B96B5643` (`portfolio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Post`
--

DROP TABLE IF EXISTS `Post`;
CREATE TABLE IF NOT EXISTS `Post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `postbegin_at` datetime DEFAULT NULL,
  `postend_at` date DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Post`
--

INSERT INTO `Post` (`id`, `created_at`, `updated_at`, `status`, `postbegin_at`, `postend_at`, `rank`) VALUES
(1, '2013-07-12 17:11:03', '2013-07-12 17:11:03', 0, NULL, NULL, 1),
(2, '2013-07-12 17:12:14', '2013-07-12 17:12:14', 0, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Postal`
--

DROP TABLE IF EXISTS `Postal`;
CREATE TABLE IF NOT EXISTS `Postal` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B4BEF1A3F92F3E70` (`country_id`),
  KEY `IDX_B4BEF1A35D83CC1` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `PostsCatgories`
--

DROP TABLE IF EXISTS `PostsCatgories`;
CREATE TABLE IF NOT EXISTS `PostsCatgories` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`category_id`),
  KEY `IDX_653E62A24B89032C` (`post_id`),
  KEY `IDX_653E62A212469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `PostTranslation`
--

DROP TABLE IF EXISTS `PostTranslation`;
CREATE TABLE IF NOT EXISTS `PostTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `title` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `excerpt` longtext COLLATE utf8_unicode_ci,
  `Post_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FA030D9F3059CC60` (`trans_lang_id`),
  KEY `IDX_FA030D9F84343AB0` (`Post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `PostTranslation`
--

INSERT INTO `PostTranslation` (`id`, `trans_lang_id`, `slug`, `content`, `title`, `subtitle`, `excerpt`, `Post_id`, `status`) VALUES
(1, 2, 'Premier post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lacinia neque sit amet diam feugiat elementum. Aenean dignissim turpis in libero eleifend pellentesque eget eget est.', 'Premier post', NULL, NULL, 1, 0),
(2, 1, 'First post', NULL, 'First post', NULL, NULL, 1, 0),
(3, 2, 'nouveau-site-d-evocatio', 'Le nouveau site d''Evocatio est désormais disponible !', 'Nouveau site d''Evocatio', 'Nouveau site d''Evocatio', NULL, 2, 0),
(4, 1, 'new-evocatio-website', NULL, 'New Evocatio website', NULL, NULL, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Product`
--

DROP TABLE IF EXISTS `Product`;
CREATE TABLE IF NOT EXISTS `Product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `plane` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Profile`
--

DROP TABLE IF EXISTS `Profile`;
CREATE TABLE IF NOT EXISTS `Profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4EEA93938C03F15C` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ProfileTranslation`
--

DROP TABLE IF EXISTS `ProfileTranslation`;
CREATE TABLE IF NOT EXISTS `ProfileTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_CB93B5AD3059CC60` (`trans_lang_id`),
  KEY `IDX_CB93B5ADCCFA12B8` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Project`
--

DROP TABLE IF EXISTS `Project`;
CREATE TABLE IF NOT EXISTS `Project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ProjectFile`
--

DROP TABLE IF EXISTS `ProjectFile`;
CREATE TABLE IF NOT EXISTS `ProjectFile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7521D5E04584665A` (`product_id`),
  KEY `IDX_7521D5E093CB796C` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ProjectTranslation`
--

DROP TABLE IF EXISTS `ProjectTranslation`;
CREATE TABLE IF NOT EXISTS `ProjectTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `foglio_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_145EF9C23059CC60` (`trans_lang_id`),
  KEY `IDX_145EF9C29FFB0D96` (`foglio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Projet`
--

DROP TABLE IF EXISTS `Projet`;
CREATE TABLE IF NOT EXISTS `Projet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ProjetTranslation`
--

DROP TABLE IF EXISTS `ProjetTranslation`;
CREATE TABLE IF NOT EXISTS `ProjetTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `foglio_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FE80E0103059CC60` (`trans_lang_id`),
  KEY `IDX_FE80E0109FFB0D96` (`foglio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Purchase`
--

DROP TABLE IF EXISTS `Purchase`;
CREATE TABLE IF NOT EXISTS `Purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `status` int(11) NOT NULL,
  `memo` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_address1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_address2` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_telephone` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_city` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_postal_code` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_state` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_country` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoicing_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoicing_address1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoicing_address2` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoicing_telephone` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoicing_city` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoicing_postal_code` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoicing_state` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoicing_country` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchase_total_raw` decimal(10,2) DEFAULT NULL,
  `purchase_tax` decimal(10,2) DEFAULT NULL,
  `purchase_total_charges` decimal(10,2) DEFAULT NULL,
  `delivery_charge` decimal(10,2) DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmation` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `PurchaseProduct`
--

DROP TABLE IF EXISTS `PurchaseProduct`;
CREATE TABLE IF NOT EXISTS `PurchaseProduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B66EE679558FBEB9` (`purchase_id`),
  KEY `IDX_B66EE6794584665A` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `PurchaseTax`
--

DROP TABLE IF EXISTS `PurchaseTax`;
CREATE TABLE IF NOT EXISTS `PurchaseTax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT NULL,
  `name` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `applied_on` decimal(10,2) NOT NULL,
  `applied_amount` decimal(10,2) NOT NULL,
  `rank` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_39E08C8558FBEB9` (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Route`
--

DROP TABLE IF EXISTS `Route`;
CREATE TABLE IF NOT EXISTS `Route` (
  `id` int(11) NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `options` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Sheet`
--

DROP TABLE IF EXISTS `Sheet`;
CREATE TABLE IF NOT EXISTS `Sheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portfolio_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_46FDBEE6B96B5643` (`portfolio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `SheetTranslation`
--

DROP TABLE IF EXISTS `SheetTranslation`;
CREATE TABLE IF NOT EXISTS `SheetTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `foglio_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E501F7713059CC60` (`trans_lang_id`),
  KEY `IDX_E501F7719FFB0D96` (`foglio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `State`
--

DROP TABLE IF EXISTS `State`;
CREATE TABLE IF NOT EXISTS `State` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `Country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6252FDFFB6723DA0` (`Country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `StateTranslation`
--

DROP TABLE IF EXISTS `StateTranslation`;
CREATE TABLE IF NOT EXISTS `StateTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_316900D5D83CC1` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Tax`
--

DROP TABLE IF EXISTS `Tax`;
CREATE TABLE IF NOT EXISTS `Tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) DEFAULT NULL,
  `name` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `rang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6CCFC965D83CC1` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Telephone`
--

DROP TABLE IF EXISTS `Telephone`;
CREATE TABLE IF NOT EXISTS `Telephone` (
  `id` int(11) NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `type` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Template`
--

DROP TABLE IF EXISTS `Template`;
CREATE TABLE IF NOT EXISTS `Template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `Template`
--

INSERT INTO `Template` (`id`, `path`, `name`) VALUES
(1, 'OwnerSiteBundle:Page:template/5div.html.twig', '5div'),
(2, 'OwnerSiteBundle:Page:template/first_layout.html.twig', 'First_layout'),
(3, 'OwnerSiteBundle:Page:template/first_layout.html.twig', 'Testname'),
(4, 'OwnerSiteBundle:Page/template:two-columns.html.twig', 'Two columns'),
(5, 'OwnerSiteBundle:Page/template:three-columns.html.twig', 'Three columns'),
(6, 'OwnerSiteBundle:Page/template:realisation-process.html.twig', 'Realisation process');

-- --------------------------------------------------------

--
-- Structure de la table `TextContent`
--

DROP TABLE IF EXISTS `TextContent`;
CREATE TABLE IF NOT EXISTS `TextContent` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `TextContentTranslation`
--

DROP TABLE IF EXISTS `TextContentTranslation`;
CREATE TABLE IF NOT EXISTS `TextContentTranslation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_lang_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_485E7E7B3059CC60` (`trans_lang_id`),
  KEY `IDX_485E7E7B84A0A3ED` (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Time`
--

DROP TABLE IF EXISTS `Time`;
CREATE TABLE IF NOT EXISTS `Time` (
  `id` int(11) NOT NULL,
  `moment` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `UnknowFile`
--

DROP TABLE IF EXISTS `UnknowFile`;
CREATE TABLE IF NOT EXISTS `UnknowFile` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Uri`
--

DROP TABLE IF EXISTS `Uri`;
CREATE TABLE IF NOT EXISTS `Uri` (
  `id` int(11) NOT NULL,
  `link` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA17977F85E0677` (`username`),
  UNIQUE KEY `UNIQ_2DA17977E7927C74` (`email`),
  UNIQUE KEY `UNIQ_2DA17977F5F88DB9` (`persona_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`id`, `username`, `email`, `password`, `salt`, `locked`, `status`, `created_at`, `created_by`, `persona_id`) VALUES
(1, 'siegfried', 'scevocatio.com', 'qO7Enkf6E/eq7E7kVoEbcSx3fSS7pPetNSjhj4RHuzBOJS2ZELgsJroXbOklU2lJNjdjtytWe2itaaTifieLWw==', 'i9kaaizf3bk8gk40c0cswgk04cs8w8c', 0, 1, '2013-06-13 12:19:40', 0, NULL),
(3, 'siegfried1e', 'sc@evocatio.com', 'FpCKfpZ7EqrEldH2lwA7QX5DHJck0BQVFFtoJ8hjVnSRzj+HZX1m1lSYoqdl7s38WkwYrVZxtUf1ghJiKHN3UA==', 'if4u426ros8wgc48cksw08w44g4g48c', 0, 1, '2013-06-13 12:20:26', 0, NULL),
(4, 'leslie', 'lbride@evocatio.com', 'SmBMQXWyOjVrIMrlUVG3d/+7RuSvF4PQaD2AEyhZudD/BbKuqnlU4e3IjD/lzNDv9xD3zPfGxexNdRu9t1YWXQ==', 'j2ecxyp86ps08co4k808go8ccgk8gss', 0, 1, '2013-07-12 14:13:26', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `UserReset`
--

DROP TABLE IF EXISTS `UserReset`;
CREATE TABLE IF NOT EXISTS `UserReset` (
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `confirmation` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uuid`),
  UNIQUE KEY `UNIQ_34092E38483D123C` (`confirmation`),
  UNIQUE KEY `UNIQ_34092E38A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `UserReset`
--

INSERT INTO `UserReset` (`uuid`, `user_id`, `confirmation`) VALUES
('26e607f478c88ee1698786eb73509da0', 4, '51e0474648ab5');

-- --------------------------------------------------------

--
-- Structure de la table `Web`
--

DROP TABLE IF EXISTS `Web`;
CREATE TABLE IF NOT EXISTS `Web` (
  `id` int(11) NOT NULL,
  `web` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Widget`
--

DROP TABLE IF EXISTS `Widget`;
CREATE TABLE IF NOT EXISTS `Widget` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Widget`
--

INSERT INTO `Widget` (`id`) VALUES
(2),
(36),
(37);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ApplicationFile`
--
ALTER TABLE `ApplicationFile`
  ADD CONSTRAINT `FK_673C6BDEBF396750` FOREIGN KEY (`id`) REFERENCES `File` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Area`
--
ALTER TABLE `Area`
  ADD CONSTRAINT `FK_77A692565DA0FB8` FOREIGN KEY (`template_id`) REFERENCES `Template` (`id`);

--
-- Contraintes pour la table `AudioFile`
--
ALTER TABLE `AudioFile`
  ADD CONSTRAINT `FK_8DD90CD4BF396750` FOREIGN KEY (`id`) REFERENCES `File` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Categories`
--
ALTER TABLE `Categories`
  ADD CONSTRAINT `FK_75AE45B8E0D319AA` FOREIGN KEY (`my_category_id`) REFERENCES `Category` (`id`),
  ADD CONSTRAINT `FK_75AE45B812469DE2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`);

--
-- Contraintes pour la table `CategoryTranslation`
--
ALTER TABLE `CategoryTranslation`
  ADD CONSTRAINT `FK_51241CAA12469DE2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_51241CAA3059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Company`
--
ALTER TABLE `Company`
  ADD CONSTRAINT `FK_800230D3BF396750` FOREIGN KEY (`id`) REFERENCES `Persona` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `CountryTranslation`
--
ALTER TABLE `CountryTranslation`
  ADD CONSTRAINT `FK_41FF00ADF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `Country` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Culture`
--
ALTER TABLE `Culture`
  ADD CONSTRAINT `FK_7914A57782F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `CultureTranslation`
--
ALTER TABLE `CultureTranslation`
  ADD CONSTRAINT `FK_E8AED59BB108249D` FOREIGN KEY (`culture_id`) REFERENCES `Culture` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E8AED59B3059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Employee`
--
ALTER TABLE `Employee`
  ADD CONSTRAINT `FK_A4E917F7BF396750` FOREIGN KEY (`id`) REFERENCES `Persona` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ExternalLink`
--
ALTER TABLE `ExternalLink`
  ADD CONSTRAINT `FK_63EE5A05BF396750` FOREIGN KEY (`id`) REFERENCES `Link` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `FaqTranslation`
--
ALTER TABLE `FaqTranslation`
  ADD CONSTRAINT `FK_5D3870943059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5D38709481BEC8C2` FOREIGN KEY (`faq_id`) REFERENCES `Faq` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `FilePage`
--
ALTER TABLE `FilePage`
  ADD CONSTRAINT `FK_2F66EC2BBF396750` FOREIGN KEY (`id`) REFERENCES `File` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2F66EC2BC4663E4` FOREIGN KEY (`page_id`) REFERENCES `Page` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `GenericProduct`
--
ALTER TABLE `GenericProduct`
  ADD CONSTRAINT `FK_DB70EF9ABF396750` FOREIGN KEY (`id`) REFERENCES `Product` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `GenericProductTranslation`
--
ALTER TABLE `GenericProductTranslation`
  ADD CONSTRAINT `FK_64709C0B81BEC8C2` FOREIGN KEY (`faq_id`) REFERENCES `GenericProduct` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_64709C0B3059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `HtmlContent`
--
ALTER TABLE `HtmlContent`
  ADD CONSTRAINT `FK_7ED269E8BF396750` FOREIGN KEY (`id`) REFERENCES `Content` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `HtmlContentTranslation`
--
ALTER TABLE `HtmlContentTranslation`
  ADD CONSTRAINT `FK_1DA4DFD84A0A3ED` FOREIGN KEY (`content_id`) REFERENCES `HtmlContent` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1DA4DFD3059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ImageFile`
--
ALTER TABLE `ImageFile`
  ADD CONSTRAINT `FK_BBDDD224BF396750` FOREIGN KEY (`id`) REFERENCES `File` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `InternalLink`
--
ALTER TABLE `InternalLink`
  ADD CONSTRAINT `FK_20A7190CBF396750` FOREIGN KEY (`id`) REFERENCES `Link` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `LanguageTranslation`
--
ALTER TABLE `LanguageTranslation`
  ADD CONSTRAINT `FK_372327C982F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_372327C93059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `LibraryModule`
--
ALTER TABLE `LibraryModule`
  ADD CONSTRAINT `FK_16B5658BF396750` FOREIGN KEY (`id`) REFERENCES `Product` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `LibraryModuleTranslation`
--
ALTER TABLE `LibraryModuleTranslation`
  ADD CONSTRAINT `FK_561E1F313059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_561E1F31F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `LibraryModule` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `LinkTranslation`
--
ALTER TABLE `LinkTranslation`
  ADD CONSTRAINT `FK_8EF1C4AB3059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8EF1C4ABADA40271` FOREIGN KEY (`link_id`) REFERENCES `Link` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Map`
--
ALTER TABLE `Map`
  ADD CONSTRAINT `FK_ABE0EC5BBF396750` FOREIGN KEY (`id`) REFERENCES `Coordinate` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `MenuTranslation`
--
ALTER TABLE `MenuTranslation`
  ADD CONSTRAINT `FK_F8D6B08CCCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `Menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F8D6B08C3059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F8D6B08CADA40271` FOREIGN KEY (`link_id`) REFERENCES `Link` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `NewsWidget`
--
ALTER TABLE `NewsWidget`
  ADD CONSTRAINT `FK_3D8F73F4BF396750` FOREIGN KEY (`id`) REFERENCES `Content` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `NewsWidgetTranslation`
--
ALTER TABLE `NewsWidgetTranslation`
  ADD CONSTRAINT `FK_B1B569FFFBE885E2` FOREIGN KEY (`widget_id`) REFERENCES `NewsWidget` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B1B569FF3059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Page`
--
ALTER TABLE `Page`
  ADD CONSTRAINT `FK_B438191E5DA0FB8` FOREIGN KEY (`template_id`) REFERENCES `Template` (`id`);

--
-- Contraintes pour la table `PageContent`
--
ALTER TABLE `PageContent`
  ADD CONSTRAINT `FK_2101977FC4663E4` FOREIGN KEY (`page_id`) REFERENCES `Page` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2101977F84A0A3ED` FOREIGN KEY (`content_id`) REFERENCES `Content` (`id`);

--
-- Contraintes pour la table `PageTranslation`
--
ALTER TABLE `PageTranslation`
  ADD CONSTRAINT `FK_D29B35C03059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D29B35C0C4663E4` FOREIGN KEY (`page_id`) REFERENCES `Page` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Person`
--
ALTER TABLE `Person`
  ADD CONSTRAINT `FK_3370D440BF396750` FOREIGN KEY (`id`) REFERENCES `Persona` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `PersonaCoordinate`
--
ALTER TABLE `PersonaCoordinate`
  ADD CONSTRAINT `FK_E6C5883298BBE953` FOREIGN KEY (`coordinate_id`) REFERENCES `Coordinate` (`id`),
  ADD CONSTRAINT `FK_E6C58832F5F88DB9` FOREIGN KEY (`persona_id`) REFERENCES `Persona` (`id`);

--
-- Contraintes pour la table `PortfolioTranslation`
--
ALTER TABLE `PortfolioTranslation`
  ADD CONSTRAINT `FK_7964AEB9B96B5643` FOREIGN KEY (`portfolio_id`) REFERENCES `Portfolio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7964AEB93059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Postal`
--
ALTER TABLE `Postal`
  ADD CONSTRAINT `FK_B4BEF1A3BF396750` FOREIGN KEY (`id`) REFERENCES `Coordinate` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B4BEF1A35D83CC1` FOREIGN KEY (`state_id`) REFERENCES `State` (`id`),
  ADD CONSTRAINT `FK_B4BEF1A3F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `Country` (`id`);

--
-- Contraintes pour la table `PostsCatgories`
--
ALTER TABLE `PostsCatgories`
  ADD CONSTRAINT `FK_653E62A212469DE2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_653E62A24B89032C` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `PostTranslation`
--
ALTER TABLE `PostTranslation`
  ADD CONSTRAINT `FK_FA030D9F3059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FA030D9F84343AB0` FOREIGN KEY (`Post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Profile`
--
ALTER TABLE `Profile`
  ADD CONSTRAINT `FK_4EEA93938C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `Employee` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ProfileTranslation`
--
ALTER TABLE `ProfileTranslation`
  ADD CONSTRAINT `FK_CB93B5ADCCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `Profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CB93B5AD3059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ProjectFile`
--
ALTER TABLE `ProjectFile`
  ADD CONSTRAINT `FK_7521D5E093CB796C` FOREIGN KEY (`file_id`) REFERENCES `File` (`id`),
  ADD CONSTRAINT `FK_7521D5E04584665A` FOREIGN KEY (`product_id`) REFERENCES `Project` (`id`);

--
-- Contraintes pour la table `ProjectTranslation`
--
ALTER TABLE `ProjectTranslation`
  ADD CONSTRAINT `FK_145EF9C29FFB0D96` FOREIGN KEY (`foglio_id`) REFERENCES `Project` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_145EF9C23059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ProjetTranslation`
--
ALTER TABLE `ProjetTranslation`
  ADD CONSTRAINT `FK_FE80E0109FFB0D96` FOREIGN KEY (`foglio_id`) REFERENCES `Projet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FE80E0103059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `PurchaseProduct`
--
ALTER TABLE `PurchaseProduct`
  ADD CONSTRAINT `FK_B66EE6794584665A` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`),
  ADD CONSTRAINT `FK_B66EE679558FBEB9` FOREIGN KEY (`purchase_id`) REFERENCES `Purchase` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `PurchaseTax`
--
ALTER TABLE `PurchaseTax`
  ADD CONSTRAINT `FK_39E08C8558FBEB9` FOREIGN KEY (`purchase_id`) REFERENCES `Purchase` (`id`);

--
-- Contraintes pour la table `Route`
--
ALTER TABLE `Route`
  ADD CONSTRAINT `FK_C3050F7DBF396750` FOREIGN KEY (`id`) REFERENCES `Link` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Sheet`
--
ALTER TABLE `Sheet`
  ADD CONSTRAINT `FK_46FDBEE6B96B5643` FOREIGN KEY (`portfolio_id`) REFERENCES `Portfolio` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `SheetTranslation`
--
ALTER TABLE `SheetTranslation`
  ADD CONSTRAINT `FK_E501F7719FFB0D96` FOREIGN KEY (`foglio_id`) REFERENCES `Sheet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E501F7713059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `State`
--
ALTER TABLE `State`
  ADD CONSTRAINT `FK_6252FDFFB6723DA0` FOREIGN KEY (`Country_id`) REFERENCES `Country` (`id`);

--
-- Contraintes pour la table `StateTranslation`
--
ALTER TABLE `StateTranslation`
  ADD CONSTRAINT `FK_316900D5D83CC1` FOREIGN KEY (`state_id`) REFERENCES `State` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Tax`
--
ALTER TABLE `Tax`
  ADD CONSTRAINT `FK_B6CCFC965D83CC1` FOREIGN KEY (`state_id`) REFERENCES `State` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Telephone`
--
ALTER TABLE `Telephone`
  ADD CONSTRAINT `FK_C7FE72B3BF396750` FOREIGN KEY (`id`) REFERENCES `Coordinate` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `TextContent`
--
ALTER TABLE `TextContent`
  ADD CONSTRAINT `FK_5B5BF892BF396750` FOREIGN KEY (`id`) REFERENCES `Content` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `TextContentTranslation`
--
ALTER TABLE `TextContentTranslation`
  ADD CONSTRAINT `FK_485E7E7B84A0A3ED` FOREIGN KEY (`content_id`) REFERENCES `TextContent` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_485E7E7B3059CC60` FOREIGN KEY (`trans_lang_id`) REFERENCES `Language` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Time`
--
ALTER TABLE `Time`
  ADD CONSTRAINT `FK_CFA6377BBF396750` FOREIGN KEY (`id`) REFERENCES `Coordinate` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `UnknowFile`
--
ALTER TABLE `UnknowFile`
  ADD CONSTRAINT `FK_C1A7337BBF396750` FOREIGN KEY (`id`) REFERENCES `File` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Uri`
--
ALTER TABLE `Uri`
  ADD CONSTRAINT `FK_BC51F7C1BF396750` FOREIGN KEY (`id`) REFERENCES `Link` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `FK_2DA17977F5F88DB9` FOREIGN KEY (`persona_id`) REFERENCES `Persona` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `UserReset`
--
ALTER TABLE `UserReset`
  ADD CONSTRAINT `FK_34092E38A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Web`
--
ALTER TABLE `Web`
  ADD CONSTRAINT `FK_2D847EB1BF396750` FOREIGN KEY (`id`) REFERENCES `Coordinate` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Widget`
--
ALTER TABLE `Widget`
  ADD CONSTRAINT `FK_82551BE6BF396750` FOREIGN KEY (`id`) REFERENCES `Content` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
