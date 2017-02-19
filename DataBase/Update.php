<?php
namespace DataBase;
use DataBase\Instruction;
class Update extends Instruction{
	
	private $fieldsAndValues;
	protected $fields;
	private $criteria;
	
	function __construct(){
		$this->fieldsAndValues = array();
	}
	
	public function setSetter(string $column, string $value): void{
		$sett = array("column"=>$column, "value"=> $value);
		array_push($this->fieldsAndValues, $sett);
	}
	
	protected function makeSett(): void {
		$this->fields = "";
		foreach ($this->fieldsAndValues as $field){
			$this->fields .= " {$field['column']} = ";
			if(is_numeric($field['value'])){
				$this->fields .= "{$field['value']},";
			}else{
				$this->fields .= "'{$field['value']}',";
			}
		}
		$this->fields = substr($this->fields, 0, -1);
	}
	
	public function setCriteria(string $criteria){
		$this->criteria = $criteria;
	}
	
	public function getInstruction(): string {
		self::makeSett();
		$stm = "UPDATE";
		$stm .= parent::getEntity();
		$stm .= " SET {$this->fields} ";
		$stm .= "{$this->criteria};";
		return $stm;
	}
}