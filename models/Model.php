<?php 

namespace AppSch\Models;
use Exception;
abstract class Model{
    private $dbc;

    public function __construct($connection){
        $this->dbc = $connection;
    }

    public function getConnection(){
        return $this->dbc;
    }

    protected function getFields(){
        return [];
    }

    public function getTableName(){
        $className = static::class;
        $match = [];

        preg_match("|^.*\\\(([A-Z][a-z]+)+)Model$|", $className, $match);
        $clsmetch = $match[1] ?? "";
        $classUndeescore = preg_replace("|[A-Z]|", "_$0", $clsmetch);
        $classToLowercase = strtolower($classUndeescore);
        $tableName = substr($classToLowercase,1);

        return $tableName;
    }

    final public function getAll(){
        $table = $this->getTableName();

        $sql = "SELECT * FROM {$table}";
        $prep = $this->getConnection()->prepare($sql);
        $exe = $prep->execute();
        $res = [];

        if($exe){
            $res = $prep->fetchAll(\PDO::FETCH_OBJ);
        }

        return $res;
    }

    final public function getFildName($fildname, $value){
        $this->isFildeValide($fildname, $value);
        $table = $this->getTableName();

        $sql = "SELECT * FROM {$table} WHERE {$fildname}=?";
        $prep = $this->getConnection()->prepare($sql);
        $exc = $prep->execute([$value]);
        $res = NULL;

        if($exc){
            $res = $prep->fetch(\PDO::FETCH_OBJ);
        }

        return $res;

    }

    final public function  isFildeValide($field, $value){
        $suportedField = $this->getFields();
        $suportedKey = array_keys($suportedField);

        if(!in_array($field, $suportedKey)){
            return false;
        }

        if(!$suportedField[$field]->isValid($value)){
            return false;
        }

        return true;
    }

    final public function checkFildsList($data){
        $fildList = $this->getFields();

        $supFieldNames = array_keys($fildList);
        $reqFieldNames = array_keys($data);

        foreach($reqFieldNames as $reqFieldName){
            if(!in_array($reqFieldName,$supFieldNames)){
                throw new \Exception($reqFieldName . " is not suported");
            }

            if(!$fildList[$reqFieldName]->isEditable()){
                throw new \Exception($reqFieldName . " is not editable");
            }

            if(!$fildList[$reqFieldName]->isValid($data[$reqFieldName])){
                throw new \Exception($data[$reqFieldName] . " value is not valid");
            }
        }
    }

    final public function add($data){
        $this->checkFildsList($data);
        $table = $this->getTableName();

        $dataImlode = implode(",", array_keys($data));
        $questionmark = str_repeat("?,", count($data));
        $questionmarksub = substr($questionmark,0,-1);

        $sql  = "INSERT INTO {$table} ({$dataImlode}) VALUES ({$questionmarksub})";
        $prep = $this->getConnection()->prepare($sql);
        $exe = $prep->execute(array_values($data));
        
        if(!$exe){
            return false;
        }

        return true;
    }
}