CREATE TABLE IF NOT EXISTS `classe` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nom` varchar(30) NOT NULL,
    `moyenne` int(10) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `eleve` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_classe` int(11) NOT NULL REFERENCES classe(`id`),
    `nom` varchar(30) NOT NULL,
    `prenom` varchar(30) NOT NULL,
    `absent` boolean NOT NULL,
    `passe` boolean NOT NULL,
    `nb_passages` int(2) NOT NULL DEFAULT 0,
    `nb_notes` int(2) NOT NULL DEFAULT 0,
    `total_notes` int(10) NOT NULL DEFAULT 0,
    `moyenne` int(10) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;



