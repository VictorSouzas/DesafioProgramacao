<?php

use DataBase\Delete;
use DataBase\Criteria;

include "../../DataBase/Instruction.php";
include "../../DataBase/Delete.php";
include "../../DataBase/Criteria.php";

$delete = new Delete();
$delete->setEntity("usuarios");
$criteria = new Criteria();
$criteria->setCriteria("id", 7, "!=");
$delete->setCriteria($criteria->getCriteria());

echo $delete->getInstruction();