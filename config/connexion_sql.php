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
