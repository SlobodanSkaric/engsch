<?php 

include_once ("vendor/autoload.php");

use AppSch\Core\DBConnection;
use AppSch\Core\Router;

$dbConnection = DBConnection::getConnection();

$url    = filter_input(INPUT_GET, "URL");
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

$routes = require_once("Routes.php");
$router = new Router();

foreach($routes as $route){
    $router->addRoute($route);
}

$findRoute = $router->findRoute($url,$method);

print_r($findRoute);

/*$loader = new \Twig\Loader\FilesystemLoader("./views");
$twig   =  new \Twig\Environment($loader, [
    "cache" => "./twig_cache",
    "auto_reload" => true
]);

echo $twig->render();*/