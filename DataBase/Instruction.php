<?php
	public class Instruction{
		private $entity;
		private $instruction;

		public function setEntity(string $entity){
			$this->entity = entity;
		}
		public function getEntity() : string{
			return $this->entity;
		}
		abstract function getInstruction();

	}