<?php

namespace DataBase;

use DataBase\Instruction;
class Select extends Instruction {
	private $columns;
	protected $columnStm;
	private $criteria;
	
	function __construct(){
		$this->columns = array();
		$this->criteria = "";
	}
	public function setColumn(string $column){
		array_push ( $this->columns, $column );
	}
	
	protected function makeColumns(){
		$this->columnStm = "";
		foreach ($this->columns as $column){
			$this->columnStm .= "{$column},";
		}
		$this->columnStm = substr($this->columnStm, 0, -1);
	}
	
	public function setCriteria(string $criteria){
		$this->criteria = $criteria;
	}
	
	public function getInstruction(): string{
		self::makeColumns();
		$stm = "SELECT {$this->columnStm} FROM ";
		$stm .= parent::getEntity();
		if($this->criteria != ""){
			$stm .= " {$this->criteria}";
		}
		$stm .= ";";
		return $stm;
		
	}
}
