<?php

use DataBase\Update;
use DataBase\Criteria;

include "../../DataBase/Instruction.php";
include "../../DataBase/Update.php";
include "../../DataBase/Criteria.php";

$update = new Update();
$update->setEntity("usuarios");
$update->setSetter("nome", "Thiago");
$update->setSetter("idade", 32);
$criteria = new Criteria();
$criteria->setCriteria("id", 7, "=");
$update->setCriteria($criteria->getCriteria());

echo $update->getInstruction();