<?php
namespace DataBase;
	class Criteria{
		
		private $instruction;
		private $index;

		public function __construct(){
			$this->instruction = array();
			$this->index = -1;
		}

		public function setCriteria(string $field, $value, string $compare,string $glue = "AND") {
			$criteria = array("field" => $field, "value" => $value, "compare"=> $compare, "glue"=> $glue);
			array_push($this->instruction, $criteria);
			$this->index++;
		}

		public function getCriteria() : string {
			$instruct = "WHERE ";
			for ($i=0; $i <= $this->index ; $i++) { 
				$instruct .= $this->instruction[$i]['field']; 
				$instruct .= " ".$this->instruction[$i]['compare']." ";
				$value = $this->instruction[$i]['value'];
				if(is_numeric($value)){
					$instruct .= "$value";
				}else{
					$instruct .= "'{$value}'";
				}

				if($i == $this->index){
					return $instruct;
				}else {
					$instruct .= " " .$this->instruction[$i]['glue'] ." ";
				}
			}
		}


	}
