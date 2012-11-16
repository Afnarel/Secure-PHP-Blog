-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 16 Novembre 2012 à 04:29
-- Version du serveur: 5.5.25a
-- Version de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `wasp`
--

-- --------------------------------------------------------

--
-- Structure de la table `accountrecovery`
--

CREATE TABLE IF NOT EXISTS `accountrecovery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` set('1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `identifier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `accountvalidation`
--

CREATE TABLE IF NOT EXISTS `accountvalidation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` set('1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `identifier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `persistentlogin`
--

CREATE TABLE IF NOT EXISTS `persistentlogin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` set('1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `identifier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `persistentlogin`
--

INSERT INTO `persistentlogin` (`id`, `user_id`, `identifier`, `token`, `expiration_date`) VALUES
(1, '1', 'a8a83fb7ee41528c13480bd5d17ac15c', '69b09d9637e875962b4b66545c243b716cbcb7ad', '2012-11-23 04:27:42');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `creation_time` datetime DEFAULT NULL,
  `author` set('1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `update_time` set('1') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`id`, `creation_time`, `author`, `title`, `content`, `update_time`) VALUES
(2, '2012-11-16 04:16:25', '1', 'Un deuxième texte peu compréhensible...', '<div>\n	<h1 style="color:#0000FF;">\n		Lorem</h1>\n	<p>\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in scelerisque neque. Nunc mattis lacus in augue faucibus ornare. Fusce iaculis eros vitae ipsum fringilla faucibus. Donec risus neque, sodales et lacinia vitae, euismod eget tortor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam non libero urna. Sed lacus felis, elementum a <strong>sodales</strong> eget, pellentesque sed lectus. Etiam ut dignissim massa. Maecenas non lorem turpis, commodo pretium ligula. Sed vel ligula lectus, et aliquam libero. Nunc blandit nibh at purus sollicitudin vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas velit neque, accumsan sit amet adipiscing eu, mollis sit amet libero. Ut dignissim quam eget magna faucibus et suscipit est mollis. Aliquam egestas elementum orci ut viverra.</p>\n	<p>\n		Sed scelerisque nibh ut nisl vestibulum fermentum. Vestibulum vitae lacus quis ipsum ornare dapibus. Mauris semper molestie arcu, eu porttitor neque gravida at. Integer molestie mauris id sem pulvinar interdum. <em>Aliquam sodales tortor eget metus semper et ultrices nulla vestibulum. Ut at ullamcorper lorem. Suspendisse ac blandit elit. Integer lacus nisi, porta ut dignissim eget, bibendum nec est. Suspendisse id metus in nisi tristique dapibus. In hac habitasse platea dictumst. Etiam quis sodales sapien.</em></p>\n	<blockquote>\n		<p>\n			<strike>Praesent dignissim nisi venenatis lectus laoreet non ultrices</strike> lorem imperdiet. Mauris pellentesque pharetra eros non posuere. In vulputate velit ultrices odio accumsan eleifend. Proin tincidunt porttitor justo. Maecenas quis tortor nisl. Morbi vestibulum laoreet faucibus. Aliquam ipsum mi, eleifend nec consequat id, pulvinar vitae odio. Nullam at eleifend enim.</p>\n		<p>\n			n hac habitasse platea dictumst. Quisque non semper justo. Sed sed sollicitudin quam. Donec urna metus, rhoncus vel facilisis nec, molestie quis arcu. Phasellus ut dolor non nulla egestas dictum. Nulla facilisi. Morbi iaculis sagittis bibendum. Praesent eget venenatis arcu. Nam adipiscing facilisis sem vitae bibendum. Nulla tincidunt urna vel sem mattis non luctus mauris convallis. Pellentesque a lorem metus, vitae pharetra mi. Etiam cursus dolor id lorem blandit quis adipiscing libero Iporta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis faucibus nisi quis luctus. Aenean cursus iaculis quam, sit amet aliquet ante porttitor nec.</p>\n	</blockquote>\n	<p>\n		Mauris nec metus sapien, sit amet adipiscing lectus. Integer interdum vehicula lacus ac ultrices. Donec tempor, turpis in hendrerit egestas, leo lectus rutrum nibh, in lobortis nisl erat a mauris. Curabitur vel blandit nibh. Fusce id erat ac nisl gravida placerat. Nulla eget turpis sed urna aliquam aliquet sed eu mauris. Phasellus at erat felis. Nulla facilisi.</p>\n</div>\n<p>\n	 </p>\n', NULL),
(3, '2012-11-16 04:17:32', '1', 'Lorem ipsum sit amet', '<div>\n	<p>\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in scelerisque neque. Nunc mattis lacus in augue faucibus ornare. Fusce iaculis eros vitae ipsum fringilla faucibus. Donec risus neque, sodales et lacinia vitae, euismod eget tortor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam non libero urna. Sed lacus felis, elementum a sodales eget, pellentesque sed lectus. Etiam ut dignissim massa. Maecenas non lorem turpis, commodo pretium ligula. Sed vel ligula lectus, et aliquam libero. Nunc blandit nibh at purus sollicitudin vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas velit neque, accumsan sit amet adipiscing eu, mollis sit amet libero. Ut dignissim quam eget magna faucibus et suscipit est mollis. Aliquam egestas elementum orci ut viverra.</p>\n	<p>\n		Sed scelerisque nibh ut nisl vestibulum fermentum. Vestibulum vitae lacus quis ipsum ornare dapibus. Mauris semper molestie arcu, eu porttitor neque gravida at. Integer molestie mauris id sem pulvinar interdum. Aliquam sodales tortor eget metus semper et ultrices nulla vestibulum. Ut at ullamcorper lorem. Suspendisse ac blandit elit. Integer lacus nisi, porta ut dignissim eget, bibendum nec est. Suspendisse id metus in nisi tristique dapibus. In hac habitasse platea dictumst. Etiam quis sodales sapien.</p>\n	<p>\n		Praesent dignissim nisi venenatis lectus laoreet non ultrices lorem imperdiet. Mauris pellentesque pharetra eros non posuere. In vulputate velit ultrices odio accumsan eleifend. Proin tincidunt porttitor justo. Maecenas quis tortor nisl. Morbi vestibulum laoreet faucibus. Aliquam ipsum mi, eleifend nec consequat id, pulvinar vitae odio. Nullam at eleifend enim.</p>\n	<p>\n		In hac habitasse platea dictumst. Quisque non semper justo. Sed sed sollicitudin quam. Donec urna metus, rhoncus vel facilisis nec, molestie quis arcu. Phasellus ut dolor non nulla egestas dictum. Nulla facilisi. Morbi iaculis sagittis bibendum. Praesent eget venenatis arcu. Nam adipiscing facilisis sem vitae bibendum. Nulla tincidunt urna vel sem mattis non luctus mauris convallis. Pellentesque a lorem metus, vitae pharetra mi. Etiam cursus dolor id lorem blandit quis adipiscing libero porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis faucibus nisi quis luctus. Aenean cursus iaculis quam, sit amet aliquet ante porttitor nec.</p>\n	<p>\n		Mauris nec metus sapien, sit amet adipiscing lectus. Integer interdum vehicula lacus ac ultrices. Donec tempor, turpis in hendrerit egestas, leo lectus rutrum nibh, in lobortis nisl erat a mauris. Curabitur vel blandit nibh. Fusce id erat ac nisl gravida placerat. Nulla eget turpis sed urna aliquam aliquet sed eu mauris. Phasellus at erat felis. Nulla facilisi.</p>\n</div>\n<p>\n	 </p>\n', NULL),
(4, '2012-11-16 04:18:11', '1', 'Lorem ipsum sit amet', '<div>\n	<p>\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in scelerisque neque. Nunc mattis lacus in augue faucibus ornare. Fusce iaculis eros vitae ipsum fringilla faucibus. Donec risus neque, sodales et lacinia vitae, euismod eget tortor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam non libero urna. Sed lacus felis, elementum a sodales eget, pellentesque sed lectus. Etiam ut dignissim massa. Maecenas non lorem turpis, commodo pretium ligula. Sed vel ligula lectus, et aliquam libero. Nunc blandit nibh at purus sollicitudin vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas velit neque, accumsan sit amet adipiscing eu, mollis sit amet libero. Ut dignissim quam eget magna faucibus et suscipit est mollis. Aliquam egestas elementum orci ut viverra.</p>\n	<p>\n		<strong>Sed scelerisque nibh ut nisl vestibulum fermentum. Vestibulum vitae lacus quis ipsum ornare dapibus. Mauris semper molestie arcu, eu porttitor neque gravida at. Integer molestie mauris id sem pulvinar interdum. Aliquam sodales tortor eget metus semper et ultrices nulla vestibulum. Ut at ullamcorper lorem. Suspendisse ac blandit elit. Integer lacus nisi, porta ut dignissim eget, bibendum nec est. Suspendisse id metus in nisi tristique dapibus. In hac habitasse platea dictumst. Etiam quis sodales sapien.</strong></p>\n	<p>\n		Praesent dignissim nisi venenatis lectus laoreet non ultrices lorem imperdiet. Mauris pellentesque pharetra eros non posuere. In vulputate velit ultrices odio accumsan eleifend. Proin tincidunt porttitor justo. Maecenas quis tortor nisl. Morbi vestibulum laoreet faucibus. Aliquam ipsum mi, eleifend nec consequat id, pulvinar vitae odio. Nullam at eleifend enim.</p>\n	<p>\n		I<strike>n hac habitasse platea dictumst. Quisque non semper justo. Sed sed sollicitudin quam. Donec urna metus, rhoncus vel facilisis nec, molestie quis arcu. Phasellus ut dolor non nulla egestas dictum. Nulla facilisi. Morbi iaculis sagittis bibendum. Praesent eget venenatis arcu. Nam adipiscing facilisis sem vitae bibendum. Nulla tincidunt urna vel sem </strike>mattis non luctus mauris convallis. Pellentesque a lorem metus, vitae pharetra mi. Etiam cursus dolor id lorem blandit quis adipiscing libero porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis faucibus nisi quis luctus. Aenean cursus iaculis quam, sit amet aliquet ante porttitor nec.</p>\n	<p>\n		Mauris nec metus sapien, sit amet adipiscing lectus. Integer interdum vehicula lacus ac ultrices. Donec tempor, turpis in hendrerit egestas, leo lectus rutrum nibh, in lobortis nisl erat a mauris. Curabitur vel blandit nibh. Fusce id erat ac nisl gravida placerat. Nulla eget turpis sed urna aliquam aliquet sed eu mauris. Phasellus at erat felis. Nulla facilisi.</p>\n</div>\n<p>\n	 </p>\n', NULL),
(5, '2012-11-16 04:19:17', '1', 'Un texte pas trop long', '<p>\n	Bla bla bla</p>\n<p>\n	efez</p>\n<p>\n	ezfez</p>\n<p>\n	efezfez</p>\n', NULL),
(6, '2012-11-16 04:24:42', '1', 'Un post avec une image', '<p>\n	Il était une fois...</p>\n<p>\n	 </p>\n<p>\n	<img alt="" src="https://www.owasp.org/images/3/34/Owasp_logo_normal.jpg" style="width:216px;height:216px;" /></p>\n<p>\n	fefrzgregzrgzrgzrzrgrz</p>\n', NULL),
(7, '2012-11-16 04:25:36', '1', 'C''est la fin !', '<p>\n	Et ainsi, une nouvelle page de l''histoire se referme...</p>\n', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `validated` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_connection_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `registration_date`, `validated`, `last_connection_date`) VALUES
(1, 'waspblog2@gmail.com', 'WaspUser', 'a1062333fec4f20af86743259c4abf8e45386939', '2012-11-16 04:09:24', '2012-11-16 04:10:34', '2012-11-16 04:27:43');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
