<?php
use \DataBase\Insert;

include "../../DataBase/Instruction.php";
include "../../DataBase/Insert.php";
$insert = new Insert();
$insert->setEntity("usuarios");
$insert->setConlumnAsValue('nome', "Victor de Mattos Souza");
$insert->setConlumnAsValue("idade", 28);
$insert->setConlumnAsValue("Sexo", "Masculino");
echo $insert->getInstruction();