<?php
namespace Orm;
use DataBase\Update;
use DataBase\Criteria;
use DataBase\Insert;
use DataBase\Transaction;
use DataBase\Delete;

//Active Record
class WriteTable{
	private $entity;
	private $data;
	private $id;
	
	function __construct(int $id = null){
		$data = array();
		if($id){
			if($data){
				$this->id = $id;
			}
		}
	}
	
	public function __set(string $prop, $value){
		$this->data[$prop] = $value;
	}

	private function getEntity(){
		return $this->entity;
	}
	public function setEntity($entity){
		$this->entity = $entity;
	}
	
	public function store(): int{
		$stm = "";
		if($this->id){
			$update = new Update();
			$update->setEntity(self::getEntity());
			foreach ($this->data as $column => $value){
				if($column !== 'id'){
					$update->setSetter($column, $value);
				}
			}
			$criteria = new Criteria();
			$criteria->setCriteria('id', $id, '=');
			$update->setCriteria($criteria->getCriteria());
			$stm = $update->getInstruction();
		}else{
			$insert = new Insert();
			$insert->setEntity(self::getEntity());
			foreach ($this->data as $column => $value){
				$insert->setConlumnAsValue($column, $value);
			}
			$stm = $insert->getInstruction();
		}
		if($conn = Transaction::get()){
			$result = $conn->exec($stm);
			return $result;
		}
	}
	public function delete(int $id): int{
		$delete = new Delete();
		$delete->setEntity(self::getEntity());
		$criteria = new Criteria();
		$criteria->setCriteria('id', $id, "=");
		$delete->setCriteria($criteria->getCriteria());
		$stm = $delete->getInstruction();
		if($conn = Transaction::get()){
			$result = $conn->exec($stm);
			return $result;
		}
	}
}
