<?php
namespace Product;

use Orm\ReadTable;
use Orm\WriteTable;
use DataBase\Criteria;
use DataBase\Transaction;

class ProductCreate{
	
	private $class;
	private $entity;
	private $codProd;
	private $name;
	private $amount;
	private $value;
	private $typeProd;
	private $typeOp;
	
	public function __construct(string $class){
		$this->class = $class;
	}
	public function setCodProd(string $codProd): void{
		if ($codProd != "" && strlen($codProd) <= 20){
			try{
				Transaction::open($this->class);
				$type = new ReadTable("product");
				$criteria = new Criteria();
				$criteria->setCriteria("cod_prod", $codProd, "=");
				if($type->count($criteria) != 0){
					throw new \Exception("Product code already exists");
				}else{
					$this->$codProd = $codProd;
				}
				Transaction::close();
				$this->codProd = $codProd;
			}catch(\Exception $ex){
				echo $ex->getMessage();
				Transaction::rollback();
			}
		}else{
			throw new \Exception("Cod prod does not match parametres");
		}
	}

	public function setEntity($entity){
		$this->entity = $entity;
	}
	
	public function setName(string $name): void{
		if ($name != "" && strlen($name) <= 150){
			$this->name = $name;
		}else{
			throw new \Exception("String does not match parametres");
		}
	}
	public function setAmount(int $amount): void{
		if ($amount > 0){
			$this->amount = $amount;
		}else{
			throw new \Exception("the amount must be greater tham 0");
		}
	}
	public function setValue(float $value): void{
		if ($value > 0){
			$this->value = $value;
		}else{
			throw new \Exception("the value must be greater tham 0");
		}
	}
	public function setTypeProd(int $id): void{
		try{
			Transaction::open($this->class);
			$type = new ReadTable("type_product");
			$criteria = new Criteria();
			$criteria->setCriteria("id", $id, "=");
			if($type->count($criteria) > 0){
				$this->typeProd = $id;
			}else{
				throw new \Exception("Invalid product type");
			}
			Transaction::close();
		}catch(\Exception $ex){
			echo $ex->getMessage();
			Transaction::rollback();
		}
	}
	public function setTypeOp(int $id): void{
		try{
			$type = new ReadTable("type_operations");
			$criteria = new Criteria();
			Transaction::open($this->class);
			$criteria->setCriteria("id", $id, "=");
			if($type->count($criteria) > 0){
				$this->typeOp = $id;
			}else{
				throw new \Exception("Invalid product type");
			}	
			Transaction::close();
		}catch(\Exception $ex){
			echo $ex->getMessage();
			Transaction::rollback();
		}
	}
	public function store(){

		if(isset($this->codeProd) && isset($this->entity)
				&& isset($this->name)&& isset($this->amount)
				&& isset($this->value)&& isset($this->typeProd)
				&& isset($this->typeOp)){
			try {
				Transaction::open($this->class);
				$product = new WriteTable();
				$product->id_type_prod = $this->typeProd;
				$product->id_type_op = $this->typeOp;
				$product->cod_prod = $this->codProd;
				$product->prod_name = $this->name;
				$product->amount = $this->amount;
				$product->price = $this->value;
				$product->setEntity("product");
				$product->store();
						
				Transaction::close();
			}catch(\Exception $ex){
				echo $ex->getMessage();
				Transaction::rollback();
			}
		}
	}
}