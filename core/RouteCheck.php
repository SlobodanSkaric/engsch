<?php 

namespace AppSch\Core;

class RouteCheck{

    private string $urlMethod;
    private string $pattern;
    private string $controller;
    private string $method;


    private function __construct(string $urlMethod, string $pattern, string $controller, string $method){
        $this->urlMethod   = $urlMethod;
        $this->pattern     = $pattern;
        $this->controller  = $controller;
        $this->method      = $method;
    }

    public static function get(string $pattern, string $controller, string $method): RouteCheck{
        return new RouteCheck("GET",$pattern,$controller,$method);
    }

    public static function post(string $pattern, string $controller, string $method): RouteCheck{
        return new RouteCheck("POST",$pattern,$controller,$method);
    }

    public function metchControllerAndModel(string $url,string $urlMethod):bool{
        if(!preg_match($this->pattern, $url)){
            return false;
        }

        if(!preg_match("/^{$this->urlMethod}$/", $urlMethod)){
            return false;
        }

        return true;
    }

    public function getController(){
        return $this->controller;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getArguments($url){
        $match = [];

        preg_match($this->pattern, $url, $match);

        return $match[1];
    }
}