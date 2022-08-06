<?php 

namespace AppSch\Core;

class Router{
    private $route = [];

    public function addRoute(RouteCheck $route):void{
        $this->route[] = $route;
    }

    public function findRoute(string $url, string $urlMethod):RouteCheck{
        foreach($this->route as $rout){
            if($rout->metchControllerAndModel($url,$urlMethod)){
                return $rout;
            }
        }
       // return null;
    }
}