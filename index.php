<?php 
use AppSch\Core\Fingerprint\FingerprintFactory;

include_once ("vendor/autoload.php");

use AppSch\Core\ApiController;
use AppSch\Core\DBConnection;
use AppSch\Core\Router;
ob_start();
session_start();
$dbConnection = DBConnection::getConnection();

if(isset($_SESSION["fingerprint"])){
    $fingerprintFactory = new FingerprintFactory();
    $fingerprintInstance = $fingerprintFactory->getInstance("SERVER");
    $fingerprint = $fingerprintInstance->fingerprint();

    if("www" != $_SESSION["fingerprint"]){
        echo "<script>alert('Session hj')</script>";//in this place implement js alert and redirect
    }
}

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


$args =  $findRoute->getArguments($url);
call_user_func_array([$controllerInsatnce, $findRoute->getMethod()],$args);

(object)$data = $controllerInsatnce->getData();
$controllerInsatnce->_pre();
if($controllerInsatnce instanceof ApiController){
    ob_clean();
    header("Content-type: application/json; charset=utf-8");
    header("Access-Control-Allow-Origin: *");
    echo json_encode($data);
    exit;
}

$loader = new \Twig\Loader\FilesystemLoader("./views");
$twig   =  new \Twig\Environment($loader, [
    "cache" => "./twig_cache",
    "auto_reload" => true
]);
$twig->addGlobal('session', $_SESSION);

echo $twig->render($findRoute->getController() . "/" . $findRoute->getMethod() . ".html", $data);