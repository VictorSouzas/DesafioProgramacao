<?php
namespace DataBase;
use PDO;
class Connection{
	
	private function __construct(): void{}

	public function open(string $name): \PDO{
		
		$db;
		$connStm = "";

		if(file_exists("../config/{$name}.init")){
			$db = parse_ini_file("../config/{$name}.init");
		}else {
			throw new \Exception("File not found!");
		}
		
		$database = $db['database'];
		$type = $db['type'];
		$host = $db['host'];
		$user = $db['user'];
		$password = $db['password'];
		$port = $db['port'];
		
		if($type === "mysql"){
			$connStm = "{$type}:dbname={$database};host={$host}:{$port}";
		}
		$conn = new \PDO($connStm, $user, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}



	}