DROP TABLE IF EXISTS classe, eleve, passage;

CREATE TABLE IF NOT EXISTS classe (
    id_classe int NOT NULL AUTO_INCREMENT,
    nom_classe varchar(30) NOT NULL,
    PRIMARY KEY (id_classe)
);

CREATE TABLE IF NOT EXISTS eleve (
    id_eleve int NOT NULL AUTO_INCREMENT,
    id_classe int NOT NULL REFERENCES classe(id_classe),
    nom_eleve varchar(30) NOT NULL,
    prenom_eleve varchar(30) NOT NULL,
    absent boolean,
    passe boolean,
    PRIMARY KEY (id_eleve)
);

CREATE TABLE IF NOT EXISTS passage (
    id_passage int NOT NULL AUTO_INCREMENT,
    id_eleve int NOT NULL REFERENCES eleve(id_eleve),
    date_passage datetime,
    note int,
    PRIMARY KEY (id_passage)
);

INSERT INTO classe (nom_classe) VALUES
    ('SIO1'),
    ('SIO2');
    
INSERT INTO eleve (nom_eleve, prenom_eleve, id_classe) VALUES
    ('LEFEVRE', 'Paul', 1),
    ('LAMBERT', 'Zoé', 1),
    ('MONPETIT', 'Arthur', 1),
    ('REGNIER', 'Mattéo', 2),
    ('MONNIER', 'Ethan', 2),
    ('DUPONT', 'Marie', 2),
    ('MOULIN', 'Gabriel', 2);


