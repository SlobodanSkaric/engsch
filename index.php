<?php 

include_once ("vendor/autoload.php");

use AppSch\Core\DBConnection;

$dbConnection = DBConnection::getConnection();

$url    = filter_input(INPUT_GET, "URL");
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

echo $url . "   " . $method;


/*$loader = new \Twig\Loader\FilesystemLoader("./views");
$twig   =  new \Twig\Environment($loader, [
    "cache" => "./twig_cache",
    "auto_reload" => true
]);

echo $twig->render();*/