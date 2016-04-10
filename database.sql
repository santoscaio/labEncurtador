CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `UnicoUser` (`id`),
  KEY `BuscaUser` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


CREATE TABLE `url` (
  `id_url` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `id` varchar(45) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_url`),
  KEY `BuscaUrl` (`id`),
  KEY `user_url_idx` (`id_user`),
  CONSTRAINT `user_url` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=123456 DEFAULT CHARSET=latin1;


CREATE TABLE `stats` (
  `id_stats` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_url` int(11) NOT NULL,
  `qtd` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_stats`),
  KEY `stats_user_idx` (`id_user`),
  KEY `stats_url_idx` (`id_url`),
  CONSTRAINT `stats_url` FOREIGN KEY (`id_url`) REFERENCES `url` (`id_url`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `stats_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;