<?php
require_once '../../bootstrap.php';
$cod = trim(filter_input(INPUT_POST, "cod", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$amount = trim(filter_input(INPUT_POST, "amount", FILTER_SANITIZE_NUMBER_INT));
$value = trim(filter_input(INPUT_POST, "value", FILTER_SANITIZE_NUMBER_FLOAT));
$typeProd = trim(filter_input(INPUT_POST, "typeProd", FILTER_SANITIZE_NUMBER_INT));
$typeOp = trim(filter_input(INPUT_POST, "typeOp", FILTER_SANITIZE_NUMBER_INT));
if($cod = "" || $name == "" || $amount == 0 
		|| $value == 0 || $typeProd == 0 || $typeOp == 0 ){
	echo "Todos os campos são obrigatorios!";
	exit();
}

try{
	$product = new ProductCreate("trade_products");
	$product->setCodProd($cod);
	$product->setName($name);
	$product->setAmount($amount);
	$product->setValue($value);
	$product->setTypeProd($typeProd);
	$product->setTypeOp($typeOp);
	$product->store();
}catch (Exception $ex){
	echo $ex->getMessage();
	exit();
}catch (Error $ex){
	echo $ex->getMessage();
	exit();
}