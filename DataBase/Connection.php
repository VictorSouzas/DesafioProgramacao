<?php
namespace \DataBase\Connection;
use PDO;
	public class Connection{
		private $database;
		private $type;
		private $host;
		private $user;
		private $password;
		private $door;
		private $conn;

		public function __construct(string $database, string $type, string host, string $user, string $password, string $door){
			$this->database = $database;
			$this->type = $type;
			$this->host = $host;
			$this->user = $user;
			$this->password = $password;
			$this->door = $door;
		}

		public function setConn(): void {
			$connStm = "";
			if($type === "mysql"){
				$connStm = "{$type}:dbname={$database};host={$host}:{$door}";
			}
			try{
				$conn = new \PDO($connStm, $user, $password);
			} catch(\PDO_Exception $e){
				/**
				 * Log Association here
				 */
			}
		}

		public function getConn() {
			if($conn != null){
				return $conn;
			}
			setConn();
			getConn();
		}

		public function __desctruct(){
			$conn = null;
			/**
			 * Log Association here
			 */
		}



	}