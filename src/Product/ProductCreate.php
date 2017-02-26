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
	public function setCodProd(string $codProd){
			try{
				Transaction::open($this->class);
				$type = new ReadTable("product");
				$criteria = new Criteria();
				$criteria->setCriteria("cod_prod", $codProd, "=");
				if($type->count($criteria) < 0){
					throw new \Exception("Product code already exists");
				}
				
				Transaction::close();
				$this->codProd = $codProd;
			}catch(\Exception $ex){
				Transaction::rollback();
				throw $ex;
			}
		}
	

	public function setEntity($entity){
		$this->entity = $entity;
	}
	
	public function setName(string $name){
			$this->name = $name;
	}
	public function setAmount(int $amount){
			$this->amount = $amount;
		
	}
	public function setValue(float $value){
			$this->value = $value;
	}
	public function setTypeProd(int $id){
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
			Transaction::rollback();
			throw $ex;
		}
	}
	public function setTypeOp(int $id){
		try{
			$type = new ReadTable("type_operations");
			$criteria = new Criteria();
			Transaction::open($this->class);
			$criteria->setCriteria("id", $id, "=");
			if($type->count($criteria) > 0){
				$this->typeOp = $id;
			}else{
				throw new \Exception("Invalid operation");
			}	
			Transaction::close();
		}catch(\Exception $ex){
			Transaction::rollback();
			throw $ex;

		}
	}
	public function store(){
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
				Transaction::rollback();
				throw $ex;
			}
		
	}
}
