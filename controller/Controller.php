<?php 

namespace AppSch\Controller;

use AppSch\Core\DBConnection;

class Controller{
    private  $connection;
    private $data = [];

    

    public function __construct($dbc){
        $this->connection = $dbc;
    }

    public function getConnection(){
        return $this->connection;
    }

    public function setResultData(string $name,  $value):void{
        if(preg_match("|^[a-z][a-zA-Z0-9]+$|",$name)){
            $this->data[$name] = $value;
        }
    }

    public function getData(){
        return $this->data;
    }

    protected function redirect($path){
        ob_clean();
        header("Location:".$path);
        exit;
    }

    protected function logout(){
        session_unset();
        session_destroy();
    }
}