<?php
require_once '../bootstrap.php';

$loader = new Twig_Loader_Filesystem('../template/');
$twig = new Twig_Environment($loader);
$template = $twig->load('base.html');
echo $template->render();