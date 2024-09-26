<?php
	require_once 'config.php';

	class ConnexionPDO{
		protected $conn = NULL;
		protected $login = NULL;
		protected $mdp = NULL;
		protected $bd = NULL;
		protected $serveur = NULL;
		
		public function __construct($login= DB_USER, $mdp =DB_PWD, $bd= DB_NAME, $serveur= DB_HOST) {
			$this->login = $login;
			$this->mdp = $mdp;
			$this->bd = $bd;
			$this->serveur = $serveur;
			$this->connexion();
		}
	
		public function connexion() {
			try {
				$this->conn = new PDO("mysql:host=$this->serveur;dbname=$this->bd;charset=UTF8", $this->login, $this->mdp); 
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $this->conn;
			} catch (PDOException $e) {
				print "Connexion à la base de données impossible";
				die();
			}
		}
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