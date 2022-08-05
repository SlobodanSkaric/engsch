<?php 

namespace AppSch\Core;

class DBConfiguration{
    private string $hostname;
    private string $username;
    private string $password;
    private string $dbname;
    private string $utf;

    public function __construct(string $hostname, string $username, string $password, string $dbname){
        $this->setHostname($hostname);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setDBname($dbname);
        $this->utf = "utf8mb4";
    }

    private function setHostname(string $hostname): void{
        if(preg_match("/^[a-zA-Z][a-zA-Z]+$/",$hostname) && strlen($hostname) > 3){
            $this->hostname = $hostname;
        }
    }

    private function setUsername(string $username): void{
        if(preg_match("/^[a-zA-Z][a-zA-Z0-9]+$/",$username) && strlen($username) > 3){
            $this->username = $username;
        }
    }

    private function setPassword(string $password): void{
        if(preg_match("/^[a-zA-Z][a-zA-Z0-9]+$/",$password) && strlen($password) > 3){
            $this->password = $password;
        }
    }

    private function setDBname(string $dbname): void{
        if(preg_match("/^[a-zA-Z][a-zA-Z]+$/",$dbname) && strlen($dbname) > 3){
            $this->dbname = $dbname;
        }
    }

    public function getSource(){
        return "mysql:hostname={$this->hostname};dbname={$this->dbname};charset={$this->utf}";
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }
}