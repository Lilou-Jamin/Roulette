<?php

	require_once 'config.php';

	try
	{
		$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	$datafeed = "INSERT INTO `classe` (`nom`) VALUES
    ('SIO1'),
    ('SIO2');
    
    INSERT INTO `eleve` (`nom`, `prenom`, `id_classe`) VALUES
	('MASSON', 'Pol', 1),
	('JAMIN', 'Lilou', 1),
	('REGNIER', 'Mattéo', 2),
	('MONNIER', 'Ethan', 2),
	('DUPONT', 'Marie', 2),
	('MOULIN', 'Gabriel', 2);";
?>