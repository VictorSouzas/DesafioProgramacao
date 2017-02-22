<?php
require_once '../../bootstrap.php';
use Product\ProductCreate;
$cod = trim(filter_input(INPUT_POST, "cod", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$amount = trim(filter_input(INPUT_POST, "amount", FILTER_SANITIZE_NUMBER_INT));
$value = filter_input(INPUT_POST, "value", FILTER_SANITIZE_NUMBER_FLOAT);
$typeProd = filter_input(INPUT_POST, "typeProd", FILTER_SANITIZE_NUMBER_INT);
$typeOp = filter_input(INPUT_POST, "typeOp", FILTER_SANITIZE_NUMBER_INT);
if(($cod == "" || strlen($cod) < 3) || $cod >20 ){
	echo "O Codigo do produto deve ter mais de 3 caracteres";
	exit();
}
if ($name == ""){
	echo "O nome do produto não pode ser vazio";
	exit();
}
if ($amount <= 0){
	echo "A quantidade deve ser maior que zero";
	exit();
}
if($value <= 0){
	echo "O valor deve ser maior que zero";
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
	echo 1;
}catch (Exception $ex){
	echo $ex->getMessage();
}catch (Error $ex){
	echo $ex->getMessage();
}