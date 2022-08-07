<?php 

include_once ("vendor/autoload.php");

use AppSch\Core\DBConnection;
use AppSch\Core\Router;

$dbConnection = DBConnection::getConnection();

$url    = filter_input(INPUT_GET, "URL");
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");

if($url == null) $url = "";

$routes = require_once("Routes.php");
$router = new Router();

foreach($routes as $route){
    $router->addRoute($route);
}

$findRoute = $router->findRoute($url,$method);

$controlleName = "\\AppSch\\Controller\\" . $findRoute->getController() . "Controller";
$controllerInsatnce = new $controlleName($dbConnection);

$methodName = $findRoute->getMethod();
$args =  [];
call_user_func_array([$controllerInsatnce, $methodName],$args);
$data = $controllerInsatnce->getData();
$loader = new \Twig\Loader\FilesystemLoader("./views");
$twig   =  new \Twig\Environment($loader, [
    "cache" => "./twig_cache",
    "auto_reload" => true
]);

echo $twig->render($findRoute->getController() . "/" . $findRoute->getMethod() . ".html", $data);