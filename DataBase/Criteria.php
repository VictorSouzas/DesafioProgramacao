<?php
namespace \DataBase\Criteria;
	class Criteria{
		
		private $instruction;
		private $index;

		public function __construct(){
			$instruction = array();
			$index = 0;
		}

		public function setCriteria(string $field, $value, string $compare,
						string $glue = ($glue != "") ? "AND": "OR"): void {
			$instruction[$index]['field'] = $field;
			$instruction[$index]['value'] = $value;
			$instruction[$index]['compare'] = $compare;
			$instruction[$index]['glue'] = $glue;
			$index++;
		}

		public function getCriteria() : string {
			$instruct = "WHERE ";
			for ($i=0; $i <= $index ; $i++) { 
				$instruct += $this->instruction[$i]['field']; 
				$instruct += $this->instruction[$i]['comapre'];
				$value = $this->instruction[$i]['value'];
				if(is_numeric($value)){
					$instruct += $value;
				}else{
					$instruct += "'{$value}'";
				}

				if($i == $index){
					return $instruct;
				}else {
					$instruct += " " +$this->instruction[$i]['glue'];
				}
			}
		}


	}