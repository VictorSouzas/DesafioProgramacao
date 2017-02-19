<?php
use DataBase\Select;
use DataBase\Criteria;

include "../../DataBase/Instruction.php";
include "../../DataBase/Select.php";
include "../../DataBase/Criteria.php";

$select = new Select();
$select->setEntity("Usuarios");
$select->setColumn("*");
$criteria = new Criteria();
$criteria->setCriteria("id", 35, "=", "AND");
$criteria->setCriteria("nome", "victor", "!=", "OR");
$select->setCriteria($criteria->getCriteria());
echo $select->getInstruction();