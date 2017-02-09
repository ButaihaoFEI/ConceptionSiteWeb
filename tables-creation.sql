CREATE TABLE IF NOT EXISTS `objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `couleur` varchar(45) DEFAULT NULL,
  `etat` int(10) unsigned zerofill DEFAULT 0,
  `date_ajout` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `identifiant` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `droits` int(10) unsigned zerofill DEFAULT 0,
  PRIMARY KEY (`identifiant`),
  UNIQUE KEY `identifiant_UNIQUE` (`identifiant`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

