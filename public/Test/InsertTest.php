<?php
use \DataBase\Insert;
include '../../bootstrap.php';
$insert = new Insert();
$insert->setEntity("usuarios");
$insert->setConlumnAsValue('nome', "Victor de Mattos Souza");
$insert->setConlumnAsValue("idade", 28);
$insert->setConlumnAsValue("Sexo", "Masculino");
echo $insert->getInstruction();