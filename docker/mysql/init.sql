-- Landing Institut - Esquema inicial
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Seccions de la landing (hero, sobre nosaltres, oferta, contacte, etc.)
CREATE TABLE IF NOT EXISTS `seccions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `clau` varchar(64) NOT NULL,
  `titol` varchar(255) DEFAULT NULL,
  `subtitol` varchar(255) DEFAULT NULL,
  `cos` text,
  `imatge` varchar(255) DEFAULT NULL,
  `ordre` int NOT NULL DEFAULT 0,
  `actiu` tinyint(1) NOT NULL DEFAULT 1,
  `creat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualitzat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clau` (`clau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Blocs reutilitzables (text + imatge, CTA, etc.)
CREATE TABLE IF NOT EXISTS `blocs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `seccio_id` int unsigned DEFAULT NULL,
  `tipus` varchar(32) NOT NULL DEFAULT 'text',
  `titol` varchar(255) DEFAULT NULL,
  `cos` text,
  `enllac` varchar(500) DEFAULT NULL,
  `imatge` varchar(255) DEFAULT NULL,
  `ordre` int NOT NULL DEFAULT 0,
  `actiu` tinyint(1) NOT NULL DEFAULT 1,
  `creat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualitzat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `seccio_id` (`seccio_id`),
  CONSTRAINT `blocs_seccio_fk` FOREIGN KEY (`seccio_id`) REFERENCES `seccions` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Oferta educativa (estudis, cicles, etc.)
CREATE TABLE IF NOT EXISTS `oferta_educativa` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `titol` varchar(255) NOT NULL,
  `descripcio` text,
  `imatge` varchar(255) DEFAULT NULL,
  `enllac` varchar(500) DEFAULT NULL,
  `ordre` int NOT NULL DEFAULT 0,
  `actiu` tinyint(1) NOT NULL DEFAULT 1,
  `creat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualitzat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Configuració general (nom centre, adreça, telèfon, xarxes, etc.)
CREATE TABLE IF NOT EXISTS `config` (
  `clau` varchar(64) NOT NULL,
  `valor` text,
  `actualitzat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`clau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuaris admin (per al panell)
CREATE TABLE IF NOT EXISTS `usuaris` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `actiu` tinyint(1) NOT NULL DEFAULT 1,
  `creat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualitzat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- Dades inicials
INSERT INTO `seccions` (`clau`, `titol`, `subtitol`, `cos`, `ordre`, `actiu`) VALUES
('hero', 'Benvinguts al nostre institut', 'Educació de qualitat per al futur', 'Som un centre compromès amb l\'excel·lència acadèmica i la formació integral del nostre alumnat.', 1, 1),
('sobre_nosaltres', 'Sobre nosaltres', NULL, 'El nostre institut té una llarga tradició educativa. Oferim un entorn inclusiu i motivador perquè cada alumne desenvolupi el seu potencial.', 2, 1),
('oferta', 'Oferta educativa', 'Estudis que oferim', NULL, 3, 1),
('contacte', 'Contacte', 'Ens podeu trobar aquí', 'Horari secretaria: Dilluns a Dijous 9:00 - 14:00. Enviu-nos un missatge o truqueu-nos.', 4, 1);

INSERT INTO `config` (`clau`, `valor`) VALUES
('nom_centre', 'Institut Example'),
('adreca', 'Carrer de l\'Educació, 1'),
('cp_ciutat', '08001 Barcelona'),
('telefon', '+34 93 123 45 67'),
('email', 'secretaria@institut.example.cat'),
('facebook', ''),
('twitter', ''),
('instagram', ''),
('linkedin', '');

-- Contrasenya per defecte: admin123 (hash bcrypt)
INSERT INTO `usuaris` (`email`, `password`, `nom`, `actiu`) VALUES
('admin@institut.cat', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 1);

-- Oferta educativa d'exemple
INSERT INTO `oferta_educativa` (`titol`, `descripcio`, `ordre`, `actiu`) VALUES
('ESO', 'Educació Secundària Obligatòria. 1r a 4t d\'ESO.', 1, 1),
('Batxillerat', 'Batxillerat en les modalitats de Ciències i Humanitats i Ciències Socials.', 2, 1),
('Cicles Formatius', 'FP de Grau Mitjà i Superior en diverses famílies professionals.', 3, 1);
