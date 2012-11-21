
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de dades: `incidenciesEleccions`
--
CREATE DATABASE incidenciesEleccions;
-- --------------------------------------------------------

--
-- Estructura de la taula `device_bans`
--

CREATE TABLE `device_bans` (
  `deviceid` varchar(255) NOT NULL,
  PRIMARY KEY (`deviceid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `incidencies`
--

CREATE TABLE `incidencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `deviceid` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `partit_afectat` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `coords` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `poblacio` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `collegi_electoral` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `causa` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `reportador` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contacte_reportador` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `comentari` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deviceid` (`deviceid`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `ip_bans`
--

CREATE TABLE `ip_bans` (
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
