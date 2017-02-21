<?php
namespace DataBase;
class Transaction{
	static private $conn;
	private function __construct(){}
	public static function open(string $database): void{
		if(empty(self::$conn)){
			self::$conn = Connection::open($database);
			self::$conn->beginTransaction();
		}
	}
	
	public static function get() {
		return self::$conn;
	}
	
	public static function rollback(){
		if(self::$conn){
			self::$conn->rollBack();
			self::$conn =  null;
		}
	}
	
	public static function close(){
		if(self::$conn){
			self::$conn->commit();
			self::$conn = null;
		}
	}
}