<?php
namespace DataBase;
use PDO;
class Connection{
	
	private function __construct(){}

	public function open(string $name){
		
		$db;
		$connStm = "";

		if(file_exists("../../config/{$name}.ini")){
			$db = parse_ini_file("../../config/{$name}.ini");
		}else {
			throw new \Exception("File not found!");
		}
		
		$type = $db['type'];
		$host = $db['host'];
		$user = $db['user'];
		$password = $db['password'];
		$port = $db['port'];
		
		if($type === "mysql"){
			$connStm = "{$type}:dbname={$name};host={$host}:{$port}";
		}
		$conn = new \PDO($connStm, $user, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}



	}
