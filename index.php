<?php

require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);

$viewtype = $_GET["viewtype"];

if ($viewtype == "rtl") {
    echo $twig->render('base.rtl.twig');
}
else {
    echo $twig->render('base.twig');
}

