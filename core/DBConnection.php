<?php 

namespace AppSch\Core;


class DBConnection{
    private static $instance;

    private static $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_EMULATE_PREPARES   => false
    ];
    private function __construct(){ }

    public static function getConnection(){
        if(self::$instance == null){
            $instConf = new DBConfiguration(Params::HOST_NAME,Params::USERNAME,Params::PASSWORD,Params::DB_NAME);
            self::$instance = new \PDO($instConf->getSource(),$instConf->getUsername(),$instConf->getPassword(),self::$options);
        }

        return self::$instance;
    }
}