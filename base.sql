-- --------------------------------------------------------
-- Host:                         163.10.35.34
-- Versión del servidor:         5.6.14 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla conexion_reciclado.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla conexion_reciclado.categoria: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `contenido`) VALUES
	(1, 'PlÃ¡sticos'),
	(2, 'Textiles y Fibras'),
	(3, 'Papel y CartÃ³n'),
	(4, 'Goma y Caucho'),
	(5, 'Metales'),
	(7, 'Escombros y Materiales de ConstrucciÃ³n'),
	(8, 'ElÃ©ctricos y ElectrÃ³nica'),
	(9, 'OrgÃ¡nicos'),
	(10, 'Vidrio'),
	(11, 'Minerales'),
	(12, 'Madera'),
	(13, 'Cuero y Piel'),
	(14, 'Envases y Embalajes'),
	(15, 'Aceites');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;


-- Volcando estructura para tabla conexion_reciclado.subcategoria
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(150) DEFAULT NULL,
  `id_categoria` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria_idx` (`id_categoria`),
  CONSTRAINT `subcategoria_id_categoria_categoria_id` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla conexion_reciclado.subcategoria: ~56 rows (aproximadamente)
/*!40000 ALTER TABLE `subcategoria` DISABLE KEYS */;
INSERT INTO `subcategoria` (`id`, `contenido`, `id_categoria`) VALUES
	(1, 'Polietileno Tereftalato (PET)', 1),
	(2, 'Polietileno de alta densidad (PEAD/HDPE)', 1),
	(3, 'Policloruro de vinilico (PVC)', 1),
	(4, 'Polietileno de baja densidad (PEBD/LDPE)', 1),
	(5, 'Polipropileno (PP)', 1),
	(6, 'Poliestireno (PS)', 1),
	(7, 'Mezclado', 1),
	(8, 'Otros', 1),
	(9, 'RayÃ³n', 2),
	(10, 'AcrÃ­lico', 2),
	(11, 'Alfombra', 2),
	(12, 'AlgodÃ³n', 2),
	(13, 'Cuero y gamuza', 2),
	(14, 'Lino', 2),
	(15, 'Nylon', 2),
	(16, 'PET', 2),
	(17, 'Polyester', 2),
	(18, 'Viscosa', 2),
	(19, 'Lana', 2),
	(20, 'Seda', 2),
	(21, 'Mezclado', 2),
	(22, 'Otros', 2),
	(23, 'CartÃ³n', 3),
	(24, 'Papel de diario', 3),
	(25, 'Papel de Oficina', 3),
	(26, 'Mezclado', 3),
	(27, 'Otros', 3),
	(28, 'NeumÃ¡ticos', 4),
	(29, 'Neoprene', 4),
	(30, 'Latex', 4),
	(31, 'Silicona', 4),
	(32, 'Manguera', 4),
	(33, 'Impermeables', 4),
	(34, 'Mezclado', 4),
	(35, 'Otros', 4),
	(36, 'Ferrosos', 5),
	(37, 'No ferrosos', 5),
	(38, 'Aleaciones', 5),
	(39, 'Mezclado', 5),
	(40, 'Otros', 5),
	(42, 'AlbaÃ±ilerÃ­a', 7),
	(43, 'Pisos', 7),
	(44, 'Puertas y ventanas', 7),
	(45, 'Techos', 7),
	(46, 'Terminaciones', 7),
	(47, 'MecÃ¡nica', 7),
	(48, 'Electricidad', 7),
	(49, 'Otros', 7),
	(50, 'ElectrÃ³nicos', 8),
	(51, 'Comida y OrgÃ¡nicos', 9),
	(52, 'Vidrio Blanco', 10),
	(53, 'Vidrio MarrÃ³n', 10),
	(54, 'Vidrio Verde', 10),
	(55, 'Minerales', 11),
	(56, 'Madera', 12),
	(57, 'Aceites', 15);
/*!40000 ALTER TABLE `subcategoria` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
