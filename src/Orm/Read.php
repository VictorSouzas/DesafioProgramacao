<?php
namespace ORM;
use DataBase\Criteria;
use DataBase\Select;
use DataBase\Transaction;

final class Read{
	private $class;
	
	function __construct($class){
		$this->class = $class;
	}
	
	public function load(Criteria $criteria): array{
		$select = new Select();
		$select->setEntity($this->class);
		$select->setColumn("*");
		$select->setCriteria($criteria->getCriteria());
		
		if($conn = Transaction::get()){
			$result = $conn->query($select->getInstruction());
			$results = array();
			if($result){
				foreach ($result->fetchObject() as $row){
					array_push($results, $row);
				}
			}
			return $results;
		}else{
			throw new \Exception("The connection does not exist");
		}
	}
	
	public function count(Criteria $criteria): int{
		$select = new Select();
		$select->setEntity($this->class);
		$select->setColumn('count(*)');
		$select->setCriteria($criteria->getCriteria());
		if($conn = Transaction::get()){
			$result = $conn->query($select->getInstruction());
			$results = array();
			if($result){
				foreach ($result->fetchObject() as $row){
					array_push($results, $row);
				}
			}
			return $results;
		}else{
			throw new \Exception("The connection does not exist");
		}
	}
	
}