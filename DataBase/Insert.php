<?php
	namespace DataBase;
	use DataBase\Instruction;
	
	class Insert extends Instruction {
		
		private $columns;
		private $values;
		private $valueStm;
		private $columnStm;
		
		function __construct(){
			$this->columns = array();
			$this->values = array();
			$this->valueStm = "";
			$this->columnStm = "";
		}
		
		public function setConlumnAsValue(string $column, string $value): void{
			array_push($this->columns, $column);
			array_push($this->values, $value);
		}
		
		protected function createConlumns(): void {
			$this->columnStm .= "(";
			foreach ($this->columns as $column){
				$this->columnStm .= "{$column},";
			}
			$this->columnStm = substr($this->columnStm, 0, -1);
			$this->columnStm .= ")";
		}
		
		protected function createValues(): void {
			$this->valueStm .= "VALUES (";
			foreach ($this->values as $value){
				if(is_numeric($value)){
					$this->valueStm .= "{$value},";
				}else{
					$this->valueStm .= "'{$value}',";
				}
			}
			$this->valueStm = substr($this->valueStm, 0, -1);
			$this->valueStm .= ")";
		}
		
		public function getInstruction(): string{
			self::createConlumns();
			self::createValues();
			$sqlStm = "INSERT INTO ";
			$sqlStm .= parent::getEntity();
			$sqlStm .= "{$this->columnStm} {$this->valueStm};";
			return $sqlStm;
		}
	}