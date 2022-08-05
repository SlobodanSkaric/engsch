<?php 

namespace AppSch\Core;


class DBConnection{
    private static $instance;

    private function __construct(){ }

    public static function getConnection(){
        if(self::$instance == null){
            $instConf = new DBConfiguration(Params::HOST_NAME,Params::USERNAME,Params::PASSWORD,Params::DB_NAME);
            self::$instance = new \PDO($instConf->getSource(),$instConf->getUsername(),$instConf->getPassword());

            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);  
			/*self::$instance->query('SET NAMES utf8');
			self::$instance->query('SET CHARACTER SET utf8');*/

        }

        return self::$instance;
    }
}