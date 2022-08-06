<?php 

namespace AppSch\Controller;

use AppSch\Core\DBConnection;

class Controller{
    private  $connection;
    private $data = [];

    public function __construct($dbc){
        $this->connection = $dbc;
    }

    public function setResultData(string $name, string $value):void{
        if(preg_match("|^[a-z][a-zA-Z0-9]+$|",$name)){
            $this->data[$name] = $value;
        }
    }

    public function getData(){
        return $this->data;
    }
}