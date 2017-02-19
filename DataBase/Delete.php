<?php
namespace DataBase;
use DataBase\Instruction;
class Delete extends Instruction{
	private $criteria;
	
	public function setCriteria($criteria): void{
		$this->criteria = $criteria;
	}
	
	public function getInstruction(): string {
		$stm = "DELETE FROM ";
		$stm .= parent::getEntity();
		$stm .= " {$this->criteria};";
		return $stm;
	}
}